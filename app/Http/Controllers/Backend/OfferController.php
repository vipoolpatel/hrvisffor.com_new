<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OfferModel;
use App\Models\UsersModel;
use App\Models\OfferStatusModel;
use App\Models\TaxSalaryModel;
use App\Models\NotificationModel;
use App\Models\ContractTypeModel;
use App\Notifications\SchoolSendOfferTeacherNotification;
use App\Notifications\TeacherAcceptRejectOfferSchoolNotification;
use App\Models\SettingModel;
use App\Models\AdminPermissionModel;
use Auth;
use Str;


class OfferController extends Controller
{
    	
	public function list(Request $request)
	{
		$data['user'] = UsersModel::get_single(Auth::user()->id);
		$data['get_status'] = OfferStatusModel::get_record();
		$data['get_contract_type'] = ContractTypeModel::get_record();
 		$data['get_setting'] = SettingModel::get_single(1);     
		

		if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
    	{

		    $check_permission = AdminPermissionModel::getPermission('offer');
		    if(empty($check_permission)) {
	            return redirect('admin/dashboard');
		    }



    		$data['getOffer'] = OfferModel::get_offer_admin(Auth::user()->id);
    		return view('backend.admin.offer.list',$data);
    	}
    	elseif(Auth::user()->is_admin == 3)
    	{	
    		$data['getOffer'] = OfferModel::get_offer_school(Auth::user()->id);	
    		return view('backend.school.offer.list',$data);
    	}
		elseif(Auth::user()->is_admin == 4)
    	{
    		$data['getOffer'] = OfferModel::get_offer_teacher(Auth::user()->id);
	        return view('backend.teacher.offer.list',$data);
    	}
	}


 	public function offer_change_status(Request $request)
    {
    	$offer = OfferModel::get_single($request->id);
		$offer->status = $request->status;
		$offer->save();

		if($request->status == 2)
		{

			$user    = UsersModel::find($offer->job_apply->user_id);

           	$subject = ''.$offer->school->school_id.' send you a new offer. The offer will be expired on '.$offer->expired_date;
            $user->notify(new SchoolSendOfferTeacherNotification($subject,$offer));  

		}

		$json['success'] = __("message.Offer status sucessfully change");
    	echo json_encode($json);
    }


 	public function offer_change_staus_teacher($status,$id)
    {
    	$get_offer = OfferModel::get_single($id);
		$get_offer->is_confirm = $status;
		$get_offer->save();

		if($status == 2)
		{
			
			$school_body = 'Congratulations! '.$get_offer->job_apply->user->name.' ('.$get_offer->job_apply->user->teacher_id.') accepted your offer. Please go process with "Contract"';
			$status_name = 'accepted';
		}
		else if($status == 3)
		{

			$school_body = ''.$get_offer->job_apply->user->name.' ('.$get_offer->job_apply->user->teacher_id.') rejected your offer';

			$status_name = 'rejected';
		}


		$subject = ''.$get_offer->job_apply->user->name.' ('.$get_offer->job_apply->user->teacher_id.') '.$status_name.' the offer of '.$get_offer->school->school_name.' ('.$get_offer->school->school_id.')';


	    $insert_data = array(
            'type' => 'offer',
            'common_id' => $get_offer->id,
            'message' => $subject,
        );

        NotificationModel::insert_data(Str::random(36),'App\Notifications\SchoolSendOfferTeacherAdminNotification','App\Models\UsersModel','1',$insert_data);

        $user  = UsersModel::find($get_offer->school_id);
        $user->notify(new TeacherAcceptRejectOfferSchoolNotification($school_body,$get_offer));  

		return redirect()->back()->with('success', __("message.Offer status sucessfully change"));
    }


    public function update(Request $request)
    {
    	$offer 					= OfferModel::find($request->id);
		$offer->salary 			= $request->salary;
		$offer->tax_salary_id 	= $request->tax_salary_id;
		$offer->holiday 		= $request->holiday;
		$offer->flights 		= $request->flights;
		$offer->contract_length = $request->contract_length;
		$offer->insurance 		= $request->insurance;
		$offer->start_date 		= $request->start_date;
		$offer->apartment 		= $request->apartment;
		$offer->bonus 			= $request->bonus;
		$offer->expired_date 	= $request->expired_date;
		$offer->note 			= $request->note;
		$offer->save();
		
		return redirect('admin/offer')->with('success', __("message.Offer updated successfully"));
    }

    

	public function offer_submit(Request $request)
	{

		$offer 					= new OfferModel;
		$offer->school_id 		= Auth::user()->id;
		$offer->job_apply_id 	= $request->job_apply_id;
		$offer->salary 			= $request->salary;
		$offer->tax_salary_id 	= $request->tax_salary_id;
		$offer->holiday 		= $request->holiday;
		$offer->flights 		= $request->flights;
		$offer->contract_length = $request->contract_length;
		$offer->insurance 		= $request->insurance;
		$offer->start_date 		= $request->start_date;
		$offer->apartment 		= $request->apartment;
		$offer->bonus 			= $request->bonus;
		$offer->expired_date 	= $request->expired_date;
		$offer->note 			= $request->note;
		$offer->save();
		

		$get_offer = OfferModel::get_single($offer->id);

	    $subject = $get_offer->school->school_name.'('.$get_offer->school->school_id.') send an offer to '.$get_offer->job_apply->user->name.'('.		$get_offer->job_apply->user->teacher_id.')';

        $insert_data = array(
            'type' => 'offer',
            'common_id' => $get_offer->id,
            'message' => $subject,
        );

        NotificationModel::insert_data(Str::random(36),'App\Notifications\SchoolSendOfferTeacherAdminNotification','App\Models\UsersModel','1',$insert_data);

		return redirect('school/offer')->with('success', __("message.Offer successfully sent"));

	}

	public function edit(Request $request) {

		$offer = OfferModel::find($request->id);
		$user 	= UsersModel::find($offer->school_id);
	 	 $get_tax_salary = TaxSalaryModel::get_record();

	     return response()->json([
	        "status"    => true,
	        "success"   => view('backend.admin.offer._edit', [
	            "offer" => $offer,
	            "user" => $user,
	            "get_tax_salary" => $get_tax_salary,
	            
	        ])->render(),
	    ], 200);

	}

	public function delete_offer($id) {
		$delete = OfferModel::find($id);
    	$delete->delete();
    	return redirect()->back()->with('success', __("message.Offer sucessfully deleted"));
	}

}


