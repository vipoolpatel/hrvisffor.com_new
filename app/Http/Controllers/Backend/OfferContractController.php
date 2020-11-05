<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OfferContractModel;
use App\Models\UsersModel;
use App\Models\ContractStatusModel;
use App\Models\NotificationModel;
use App\Models\ContractTypeModel;



use App\Notifications\SchoolSendContractTeacherNotification;
use App\Notifications\TeacherSendContractSchoolNotification;

use App\Notifications\AdminSendContractSchoolNotification;
use App\Notifications\AdminSendContractTeacherNotification;


use App\Notifications\AdminUploadContractSchoolNotification;

use App\Models\SettingModel;
use App\Models\AdminPermissionModel;



use Auth;
use Str;
use File;



class OfferContractController extends Controller
{

	public function list()
	{

		$data['user'] = UsersModel::get_single(Auth::user()->id);
		$data['get_status'] = ContractStatusModel::get_record();
    $data['get_setting'] = SettingModel::get_single(1);      
    $data['get_contract_type'] = ContractTypeModel::get_record();
		
		if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
    	{

        $check_permission = AdminPermissionModel::getPermission('contract');
        if(empty($check_permission)) {
              return redirect('admin/dashboard');
        }

    		$data['getContract'] = OfferContractModel::get_contract_admin(Auth::user()->id);
    		return view('backend.admin.contract.list',$data);
    	}
    	elseif(Auth::user()->is_admin == 3)
    	{	
    		$data['getContract'] = OfferContractModel::get_contract_school(Auth::user()->id);	
    		return view('backend.school.contract.list',$data);
    	}
		  elseif(Auth::user()->is_admin == 4)
    	{
    		$data['getContract'] = OfferContractModel::get_contract_teacher(Auth::user()->id);
	        return view('backend.teacher.contract.list',$data);
    	}
	}

  // school part

	public function contract_submit(Request $request)
	{

  		$contract = new OfferContractModel;

  		$contract->offer_id 	= $request->offer_id;
  		$contract->school_id 	= Auth::user()->id;
  		$contract->teacher_id 	= $request->teacher_id;
  		$contract->contract_type_id = $request->contract_type_id;
  	  	if(!empty($request->file('document'))) {

             $ext           = $request->file('document')->extension();
             $file          = $request->file('document');
             $randomStr     = date('YmdHis').Str::random(30);
             $filename      = strtolower($randomStr) . '.' . $ext;
             $file->move('upload/contract/', $filename);
             $contract->school_document = $filename;

        }

      $contract->save();

      $get_contract = OfferContractModel::get_single($contract->id);

      $subject = ''.$get_contract->school->school_name.' ('.$get_contract->school->school_id.') send an contract to '.$get_contract->teacher->name.' ('.$get_contract->teacher->teacher_id.')';

      $insert_data = array(
          'type'      => 'contract',
          'common_id' => $get_contract->id,
          'message'   => $subject,
      );

      NotificationModel::insert_data(Str::random(36),'App\Notifications\SchoolSendContractTeacherAdminNotification','App\Models\UsersModel','1',$insert_data);

      
  		return redirect('school/contract')->with('success', __("message.Contract successfully sent"));
	}



  public function school_admin_contract_submit(Request $request)
  {

      $get_contract = OfferContractModel::get_single($request->contract_id);

      if(!empty($request->file('document'))) {
         $ext           = $request->file('document')->extension();
         $file          = $request->file('document');
         $randomStr     = date('YmdHis').Str::random(30);
         $filename      = strtolower($randomStr) . '.' . $ext;
         $file->move('upload/contract/', $filename);
         $get_contract->school_admin_document = $filename;
      }
      $get_contract->school_admin_status = 1;
      
      $get_contract->save();
     
      $subject = ''.$get_contract->school->school_name.' ('.$get_contract->school->school_id.') send an contract to Admin';

      $insert_data = array(
          'type'      => 'contract',
          'common_id' => $get_contract->id,
          'message'   => $subject,
      );

      NotificationModel::insert_data(Str::random(36),'App\Notifications\SchoolSendContractAdminNotification','App\Models\UsersModel','1',$insert_data);



       return redirect('school/contract')->with('success', __("message.Contract successfully sent"));
  }



// teacher part

	public function teacher_contract_submit(Request $request)
	{

	    	$get_contract = OfferContractModel::get_single($request->contract_id);

	    	if(!empty($request->file('document'))) {
		       $ext           = $request->file('document')->extension();
           $file          = $request->file('document');
           $randomStr     = date('YmdHis').Str::random(30);
           $filename      = strtolower($randomStr) . '.' . $ext;
           $file->move('upload/contract/', $filename);
           $get_contract->teacher_document = $filename;

        }
        
        $get_contract->teacher_status = 1;
        $get_contract->teacher_sign_status = 2;
        $get_contract->save();


        $subject = ''.$get_contract->teacher->name.' ('.$get_contract->teacher->teacher_id.') send an contract to '.$get_contract->school->school_name.' ('.$get_contract->school->school_id.')';

        $insert_data = array(
            'type'      => 'contract',
            'common_id' => $get_contract->id,
            'message'   => $subject,
        );

        NotificationModel::insert_data(Str::random(36),'App\Notifications\TeacherSendContractSchoolAdminNotification','App\Models\UsersModel','1',$insert_data);

		    return redirect('teacher/contract')->with('success', __("message.Contract successfully sent"));
	}




  // admin change status

  public function contract_change_status(Request $request) {
      
      $contract = OfferContractModel::get_single($request->id);
      if($request->type == 'school_status')
      {
          $contract->school_status = $request->status;
      }
      else if($request->type == 'teacher_status')
      {
          $contract->teacher_status = $request->status;  
      }
      else if($request->type == 'school_admin_status')
      {
          $contract->school_admin_status = $request->status;  
      }
      
      $contract->save();



      if($request->status == 2)
      {
          if($request->type == 'school_status')
          {   
              $user = UsersModel::get_single($contract->teacher_id);
              $subject = ''.$contract->school->school_id.' sent a contract';
              $user->notify(new SchoolSendContractTeacherNotification($subject,$contract));                
          }
          elseif($request->type == 'teacher_status')
          {

              $user = UsersModel::get_single($contract->school_id);
              $subject = ''.$contract->teacher->name.' ('.$contract->teacher->teacher_id.') sent a contract';
              $user->notify(new TeacherSendContractSchoolNotification($subject,$contract));  
          }
      }

      if($request->status != 1)
      {
          if($request->type == 'school_admin_status')
          { 

              if($request->status == 2)
              {
                  $approve_reject = 'Approved';
              }
              else
              {
                  $approve_reject = 'Rejected';
              }
            

              $user = UsersModel::get_single($contract->school_id);
              $subject = 'Admin has been '.$approve_reject.' your contract';
              $user->notify(new AdminSendContractSchoolNotification($subject,$contract));  
          }
      }

      $json['success'] = __("message.Contract status sucessfully change");
      echo json_encode($json);
  }


  public function change_status_reject(Request $request)
  {
      $contract = OfferContractModel::get_single($request->id);
      if($request->type == 'school_status')
      {
          $contract->school_status = 3;
          $contract->school_reason = $request->reason;
      }
      else if($request->type == 'teacher_status')
      {
          $contract->teacher_status = 3;  
          $contract->teacher_reason = $request->reason;
      }
      else if($request->type == 'school_admin_status')
      {
          $contract->school_admin_status = 3;  
          $contract->school_admin_reason = $request->reason;
      }
      
      $contract->save();

      if($request->type == 'school_status' || $request->type == 'school_admin_status')
      {
            $user = UsersModel::get_single($contract->school_id);
            $subject = 'Your contract document has been Rejected';
            $user->notify(new AdminSendContractSchoolNotification($subject,$contract));    
      }
      else
      {
            $user = UsersModel::get_single($contract->teacher_id);
            $subject = 'Your contract document has been Rejected';
            $user->notify(new AdminSendContractTeacherNotification($subject,$contract));     
      }
    
      return redirect('admin/contract')->with('success', __("message.Contract status sucessfully change"));
  }




  public function admin_contract_submit(Request $request)
  {
      $get_contract = OfferContractModel::get_single($request->contract_id);

      if(!empty($request->file('document'))) {
         $ext           = $request->file('document')->extension();
         $file          = $request->file('document');
         $randomStr     = date('YmdHis').Str::random(30);
         $filename      = strtolower($randomStr) . '.' . $ext;
         $file->move('upload/contract/', $filename);
         $get_contract->admin_document = $filename;
         $get_contract->save();
         
      }
      

      $user = UsersModel::get_single($get_contract->school_id);
      $subject = 'Admin has been upload new contract';
      $user->notify(new AdminUploadContractSchoolNotification($subject,$get_contract));  


      return redirect('admin/contract')->with('success', __("message.School Contract successfully sent"));
        
  }


  public function  contract_delete($id)
  {
      $delete = OfferContractModel::find($id);
      $delete->delete();
      return redirect()->back()->with('success', __("message.Contract sucessfully deleted"));
  }


	// school_admin_document


  public function school_again_submit(Request $request)
  {
      $contract =  OfferContractModel::get_single($request->id);

      $contract->contract_type_id = $request->contract_type_id;
        if(!empty($request->file('document'))) {

             $ext           = $request->file('document')->extension();
             $file          = $request->file('document');
             $randomStr     = date('YmdHis').Str::random(30);
             $filename      = strtolower($randomStr) . '.' . $ext;
             $file->move('upload/contract/', $filename);
             $contract->school_document = $filename;

        }
      $contract->school_status = 1;
      $contract->save();

      $get_contract = OfferContractModel::get_single($contract->id);

      $subject = ''.$get_contract->school->school_name.' ('.$get_contract->school->school_id.') send an contract to '.$get_contract->teacher->name.' ('.$get_contract->teacher->teacher_id.')';

      $insert_data = array(
          'type'      => 'contract',
          'common_id' => $get_contract->id,
          'message'   => $subject,
      );

      NotificationModel::insert_data(Str::random(36),'App\Notifications\SchoolSendContractTeacherAdminNotification','App\Models\UsersModel','1',$insert_data);

      
      return redirect('school/contract')->with('success', __("message.Contract successfully sent"));
  }


}
