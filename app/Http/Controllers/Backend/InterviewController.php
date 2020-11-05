<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobApply;
use App\Models\Job;
use App\Models\UsersModel;
use App\Models\TeacherJobInterviewTime;
use App\Models\InterviewStatusModel;
use App\Models\JobApplyConfirmStatusModel;
use App\Models\TaxSalaryModel;

use Auth;

use App\Models\NotificationModel;
use App\Models\AdminPermissionModel;

use App\Notifications\SchoolApplyTeacherNotification;
use App\Notifications\TeacherApplySchoolNotification;

use App\Notifications\TeacherAcceptSchoolInterview;
use App\Notifications\SchoolAcceptTeacherInterview;


use Illuminate\Support\Facades\Notification;
use Str;


class InterviewController extends Controller
{
    public function index() {

		$data['user'] = UsersModel::get_single(Auth::user()->id);
        $data['get_tax_salary'] = TaxSalaryModel::get_record();
        
    	if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
    	{
            $check_permission = AdminPermissionModel::getPermission('interview');
            if(empty($check_permission)) {
                 return redirect('admin/dashboard');
            }

    		$data['get_status'] 	= InterviewStatusModel::get_record();
			$data['get_apply_job'] 	= JobApply::get_apply_job(Auth::user()->id);
	        return view('backend.admin.interview.list',$data);
    	}
    	elseif(Auth::user()->is_admin == 3)
    	{	
    		$data['get_status'] 	= JobApplyConfirmStatusModel::get_record();
    		$data['get_apply_job'] = JobApply::get_apply_job_school(Auth::user()->id);
    		return view('backend.school.interview.list',$data);
    	}
		elseif(Auth::user()->is_admin == 4)
    	{
            $data['get_status']     = JobApplyConfirmStatusModel::get_record();
	    	$data['get_apply_job'] = JobApply::get_apply_job_teacher(Auth::user()->id);
	        return view('backend.teacher.interview.list',$data);
    	}
    }



    public function interview_change_status(Request $request)
    {
    	$job_apply         = JobApply::get_single($request->id);
		$job_apply->status = $request->status;
		$job_apply->save();

        if($request->status == 2)
        {
            if($job_apply->type == "school") 
            {
                $user = UsersModel::find($job_apply->user_id);
                $subject = $job_apply->job->user->school_name.'('.$job_apply->job->user->school_id.') invited for interview.';
                $user->notify(new SchoolApplyTeacherNotification($subject,$job_apply));  
            }
            else
            {
                $user    = UsersModel::find($job_apply->job->user_id);
                $subject = $job_apply->user->name.'('.$job_apply->user->teacher_id.') invited for interview.';
                $user->notify(new TeacherApplySchoolNotification($subject,$job_apply));  
            }
        }


		$json['success'] = __("message.Interview status sucessfully change");
    	echo json_encode($json);
    }

    public function note_update(Request $request)
    {
    	$apply = JobApply::get_single($request->id);
		$apply->note = $request->note;
		$apply->save();

		$json['note'] = $apply->note;
		$json['id'] = $apply->id;
		$json['success'] = __("message.Note sucessfully updated");
    	echo json_encode($json);
    }

    public function change_confirm_status(Request $request)
    {
        $job_apply = JobApply::get_single($request->id);

        if(Auth::user()->is_admin == 3)
        {
            $job_id = Job::get_job_id(Auth::user()->id);
            $JobApplyCount = JobApply::JobApplyCount($job_id);    
        }
        else
        {
            $JobApplyCount = JobApply::JobApplyCount(Auth::user()->id);       
        }

        $process = 1;

        if($request->status == 2)
        {
            if($JobApplyCount > 2)
            {
                $process = 0;
            }
        }

        if(!empty($process))
        {
            
            $job_apply->is_confirm = $request->status;
            $job_apply->save();

            if($request->status == 2)
            {   
                if($job_apply->type == 'school')
                {
                    $subject = ''.$job_apply->user->name.' ('.$job_apply->user->teacher_id.') has accepted your interview.';
                    $user = UsersModel::find($job_apply->job->user_id);
                    $user->notify(new TeacherAcceptSchoolInterview($subject,$job_apply));  
                }
                else
                {
                    $subject = ''.$job_apply->job->user->school_name.' ('.$job_apply->job->user->school_id.') has accepted your interview.';
                    $user = UsersModel::find($job_apply->user_id);
                    $user->notify(new SchoolAcceptTeacherInterview($subject,$job_apply));  
                }
            }

            $json['success'] = __("message.Interview status sucessfully change"); 
        }
        else
        {
            $json['success'] = __("message.You can only invite for three interviews at the same time. Please complete any previous interview first, and then you can invite or accept a new interview.");  
        }

    	echo json_encode($json);
    }


    public function common_confirm_status($id, $status)
    {
        $job_apply = JobApply::get_single($id);
        $job_apply->is_confirm = $status;
        $job_apply->save();

        if($status == 2)
        {   
            if($job_apply->type == 'school')
            {
                $subject = ''.$job_apply->user->name.' ('.$job_apply->user->teacher_id.') has accepted your interview.';
                $user = UsersModel::find($job_apply->job->user_id);
                $user->notify(new TeacherAcceptSchoolInterview($subject,$job_apply));  
            }
            else
            {
                $subject = ''.$job_apply->job->user->school_name.' ('.$job_apply->job->user->school_id.') has accepted your interview.';
                $user = UsersModel::find($job_apply->user_id);
                $user->notify(new SchoolAcceptTeacherInterview($subject,$job_apply));  
            }
        }
    }


    public function change_interview_time_status(Request $request)
    {
        if(Auth::user()->is_admin == 3)
        {
            $job_id = Job::get_job_id(Auth::user()->id);
            $JobApplyCount = JobApply::JobApplyCount($job_id);    
        }
        else
        {
            $JobApplyCount = JobApply::JobApplyCount(Auth::user()->id);       
        }
        

        if($JobApplyCount > 2) {
             $json['success'] = __("message.You can only invite for three interviews at the same time. Please complete any previous interview first, and then you can invite or accept a new interview.");        
        }
        else
        {
            $time_status = TeacherJobInterviewTime::get_single($request->id);
            $time_status->status = $request->status;
            $time_status->save();

            $this->common_confirm_status($time_status->apply_id,'2');

            $json['success'] = __("message.Interview Time status sucessfully change");    
        }
    	
    	echo json_encode($json);
    }


  	public function delete_interview($id) {
    	$delete = JobApply::find($id);
    	$delete->delete();
        TeacherJobInterviewTime::delete_record($id);
        return redirect()->back()->with('success', __("message.Interview sucessfully deleted"));
    }
}
