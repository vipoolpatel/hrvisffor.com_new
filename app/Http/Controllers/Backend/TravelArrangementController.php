<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CountryModel;
use App\Models\TravelModel;

use App\Models\OfferContractModel;
use App\Models\TravelStatusModel;
use App\Models\SettingModel;
use App\Models\UsersModel;
use App\Models\NotificationModel;
use App\Models\AdminPermissionModel;





use App\Notifications\SchoolSendTravelTeacherNotification;
use App\Notifications\TeacherSendTravelSchoolNotification;


use Auth;
use File;
use Str;
use Image;


class TravelArrangementController extends Controller
{
    public function list(Request $request)
    {
    	$data['get_country'] = CountryModel::get_record();
        $data['get_setting'] = SettingModel::get_single(1);    	

		if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)  
		{

             $check_permission = AdminPermissionModel::getPermission('travel');
            if(empty($check_permission)) {
                 return redirect('admin/dashboard');
            }


			$data['get_status'] = TravelStatusModel::get_record();
			$data['get_travel'] = TravelModel::get_travel_admin();
            return view('backend.admin.travel.list',$data);
		}  	
		elseif(Auth::user()->is_admin == 3)
		{
			$data['get_travel'] = TravelModel::get_travel_school(Auth::user()->id);
			return view('backend.school.travel.list',$data);
		}
		elseif(Auth::user()->is_admin == 4)
		{
			$data['get_travel'] = TravelModel::get_travel_teacher(Auth::user()->id);
			return view('backend.teacher.travel.list',$data);
		}
    }

    public function add()
    {
    	$data['get_country'] = CountryModel::get_record();
    	$data['get_contract_teacher'] = OfferContractModel::visa_contract_teacher(Auth::user()->id);
    	return view('backend.school.travel.add',$data);
    }

    public function edit($id)
    {
    	$data['get_country'] = CountryModel::get_record();
    	$data['get_contract_teacher'] = OfferContractModel::visa_contract_teacher(Auth::user()->id);
		$data['travel'] = TravelModel::get_single($id);	
    	return view('backend.school.travel.edit',$data);
    }

    

    public function insert_update($id = '', Request $request)
    {	
    	if(!empty($id))
    	{
    		$travel = TravelModel::get_single($id);	
    	}
    	else
    	{
    		$travel = new TravelModel;
    	}
    	
    	$travel->school_id	 	= Auth::user()->id;
    	$travel->teacher_id 	= $request->teacher_id;
    	$travel->picked_up_by 	= $request->picked_up_by;
    	$travel->country_id 	= $request->country_id;
    	$travel->phone_number 	= $request->phone_number;
    	$travel->email 			= $request->email;
    	$travel->skype 			= $request->skype;
    	$travel->wechat 		= $request->wechat;
    	$travel->metting_point 	= $request->metting_point;
    	$travel->picked_school 	= $request->picked_school;
    	$travel->note 			= $request->note;
        $travel->school_status  = 1;
    
	    if (!empty($request->file('profile_pic'))) {

            if(!empty($travel->profile_pic) && file_exists('upload/travel/'.$travel->profile_pic)) {
                unlink('upload/travel/'.$travel->profile_pic);
            }

            $ext = 'jpg';
            $file = $request->file('profile_pic');
            $randomStr = Str::random(30);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/travel/', $filename);

            $travel->profile_pic = $filename;

            $thumb_img = Image::make('upload/travel/'.$filename)->resize(400, 400);
            $thumb_img->save('upload/travel/' . $filename, 100);
        }


        if(!empty($request->file('flight_ticket'))) {

        	if(!empty($travel->flight_ticket) && file_exists('upload/travel/'.$travel->flight_ticket)) {
                unlink('upload/travel/'.$travel->flight_ticket);
            }

            $ext       = $request->file('flight_ticket')->extension();
            $file      = $request->file('flight_ticket');
            $randomStr = date('YmdHis').Str::random(30);
            $filename  = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/travel/', $filename);
            $travel->flight_ticket = $filename;
        }

	  	$travel->save();      



        $subject = $travel->school->school_name.'('.$travel->school->school_id.') send an Travel Arrangement to '.$travel->teacher->name.'('.       $travel->teacher->teacher_id.')';


        $insert_data = array(
            'type' => 'travel',
            'common_id' => $travel->id,
            'message' => $subject,
        );



        NotificationModel::insert_data(Str::random(36),'App\Notifications\SchoolSendTravelTeacherAdminNotification','App\Models\UsersModel','1',$insert_data);


	  	return redirect('school/travel')->with('success', __("message.Travel arrangement successfully save"));

    }


    public function travel_delete($id)
    {
    	$travel = TravelModel::get_single($id);	

	  	if(!empty($travel->flight_ticket) && file_exists('upload/travel/'.$travel->flight_ticket)) {
            unlink('upload/travel/'.$travel->flight_ticket);
        }

        if(!empty($travel->profile_pic) && file_exists('upload/travel/'.$travel->profile_pic)) {
            unlink('upload/travel/'.$travel->profile_pic);
        }

    	$travel->delete();

    	return redirect()->back()->with('success', __("message.Travel arrangement successfully deleted"));

    }


    // teacher part

    public function teacher_upload_flight_ticket(Request $request)
    {
        $travel = TravelModel::get_single($request->id); 

        if(!empty($request->file('flight_ticket'))) {

            if(!empty($travel->flight_ticket) && file_exists('upload/travel/'.$travel->flight_ticket)) {
                unlink('upload/travel/'.$travel->flight_ticket);
            }

            $ext       = $request->file('flight_ticket')->extension();
            $file      = $request->file('flight_ticket');
            $randomStr = date('YmdHis').Str::random(30);
            $filename  = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/travel/', $filename);
            $travel->flight_ticket = $filename;

        }
        $travel->teacher_status = 1;
        $travel->save();     


        $subject = $travel->teacher->name.'('.$travel->teacher->teacher_id.') send an Travel Arrangement to '.$travel->school->school_name.'('.       $travel->school->school_id.')';


        $insert_data = array(
            'type' => 'travel',
            'common_id' => $travel->id,
            'message' => $subject,
        );

    
        NotificationModel::insert_data(Str::random(36),'App\Notifications\TeacherSendTravelSchoolAdminNotification','App\Models\UsersModel','1',$insert_data);



        return redirect()->back()->with('success', __("message.Travel arrangement successfully save"));
    }


    // admin side


    public function travel_change_status(Request $request) {
      
            $travel = TravelModel::get_single($request->id);

            if($request->type == 'school_status')
            {
                $travel->school_status = $request->status;
            }
            else if($request->type == 'teacher_status')
            {
                $travel->teacher_status = $request->status;
            }
              
            $travel->save();


            $school  = UsersModel::get_single($travel->school_id);
            $teacher = UsersModel::get_single($travel->teacher_id);


            if($request->status == 2) 
            {
                if($request->type == 'school_status')
                {
                    $body = $travel->school->school_id.' sent a Travel Arrangement';
                    $teacher->notify(new SchoolSendTravelTeacherNotification($body,$travel));      
                }
                else if($request->type == 'teacher_status')
                {
                    $body = $travel->teacher->name.'('.$travel->teacher->teacher_id.') sent a Travel Arrangement';
                    $school->notify(new TeacherSendTravelSchoolNotification($body,$travel));  
                }
            }
        
            if($request->type == 'school_status')
            {
                $body = 'Travel arrangement: Approved';
                $school->notify(new TeacherSendTravelSchoolNotification($body,$travel));  
            }
            elseif($request->type == 'teacher_status')
            {
                $body = 'Travel arrangement: Approved';
                $teacher->notify(new SchoolSendTravelTeacherNotification($body,$travel));  
            }


            $json['success'] = __("message.Travel status sucessfully change");
            echo json_encode($json);
    }


    public function travel_change_status_reject(Request $request)
    {
        $travel = TravelModel::get_single($request->id);

        if($request->type == 'school_status')
        {
            $travel->school_status = 3;
            $travel->school_reason = $request->reason;
        }
        else if($request->type == 'teacher_status')
        {
            $travel->teacher_status = 3;
            $travel->teacher_reason = $request->reason;
        }

        $travel->save();

        $school  = UsersModel::get_single($travel->school_id);
        $teacher = UsersModel::get_single($travel->teacher_id);

        if($request->type == 'school_status')
        {
            $body =  'Travel arrangement rejected please check reason';
            $school->notify(new TeacherSendTravelSchoolNotification($body,$travel));  
        }
        elseif($request->type == 'teacher_status')
        {
            $body =  'Travel arrangement rejected please check reason';
            $teacher->notify(new SchoolSendTravelTeacherNotification($body,$travel));  
        }

        return redirect()->back()->with('success', __("message.Travel arrangement status sucessfully rejected"));
    }


    public function admin_edit(Request $request)
    {
        $travel = TravelModel::get_single($request->id); 
        $get_country = CountryModel::get_record();
        $get_contract_teacher = OfferContractModel::visa_contract_teacher($travel->school_id);
         
        return response()->json([
            "status"    => true,
            "success"   => view('backend.admin.travel._edit', [
                "travel" => $travel,
                "get_country" => $get_country,
                "get_contract_teacher" => $get_contract_teacher,
                
            ])->render(),
        ], 200);
    }

    public function admin_update(Request $request)
    {
        $travel = TravelModel::get_single($request->id); 

        $travel->teacher_id     = $request->teacher_id;
        $travel->picked_up_by   = $request->picked_up_by;
        $travel->country_id     = $request->country_id;
        $travel->phone_number   = $request->phone_number;
        $travel->email          = $request->email;
        $travel->skype          = $request->skype;
        $travel->wechat         = $request->wechat;
        $travel->metting_point  = $request->metting_point;
        $travel->picked_school  = $request->picked_school;
        $travel->note           = $request->note;
    

        if (!empty($request->file('profile_pic'))) {

            if(!empty($travel->profile_pic) && file_exists('upload/travel/'.$travel->profile_pic)) {
                unlink('upload/travel/'.$travel->profile_pic);
            }

            $ext = 'jpg';
            $file = $request->file('profile_pic');
            $randomStr = Str::random(30);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/travel/', $filename);

            $travel->profile_pic = $filename;

            $thumb_img = Image::make('upload/travel/'.$filename)->resize(400, 400);
            $thumb_img->save('upload/travel/' . $filename, 100);
        }


        if(!empty($request->file('flight_ticket'))) {

            if(!empty($travel->flight_ticket) && file_exists('upload/travel/'.$travel->flight_ticket)) {
                unlink('upload/travel/'.$travel->flight_ticket);
            }

            $ext       = $request->file('flight_ticket')->extension();
            $file      = $request->file('flight_ticket');
            $randomStr = date('YmdHis').Str::random(30);
            $filename  = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/travel/', $filename);
            $travel->flight_ticket = $filename;
        }

        $travel->save();      

        return redirect('admin/travel')->with('success', __("message.Travel arrangement successfully save"));
    }



}
