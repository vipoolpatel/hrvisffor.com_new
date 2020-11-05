<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DateTimeZone;
use DateTime;
use App\Models\UsersModel;
use App\Models\JobApply;
use App\Models\TeacherJobInterviewTime;
use App\Models\Job;
use App\Models\NotificationModel;

use Auth;
use App\Notifications\SchoolApplyTeacherAdminNotification;
use Illuminate\Support\Facades\Notification;

use Str;

class TeacherApplyController extends Controller
{
    public function applyTeacher(Request $request, $slug, $job_slug)
    {
        $school  = UsersModel::get_single(Auth::user()->id);
        $teacher = UsersModel::get_single_username($slug);
        $job 	 = Job::get_single_slug($job_slug);


        $job_id = Job::get_job_id(Auth::user()->id);
        $JobApplyCount = JobApply::JobApplyCount($job_id);
       
        if($JobApplyCount > 2) {
            return redirect()->back()->with('error', __("message.You can only invite for three interviews at the same time. Please complete any previous interview first, and then you can invite or accept a new interview."));   
        }

        $JobApplyCountTeacher = JobApply::JobApplyTeacherCount($teacher->id,'teacher');
        if($JobApplyCountTeacher > 2) {

            return redirect()->back()->with('error', __("message.This teacher’s interview time has been fully reserved. There are still three interviews for this teacher that have not been completed."));   
        }

        if(!empty($teacher) && !empty($job)) {
            $data['teacher']   = $teacher;
            $data['school']  = $school;
            return view('frontend.school.apply',$data);    
        }
        else {
            return redirect(url(''));
        }
        
    }

    public function postApplyTeacher(Request $request, $slug, $job_slug)
    {

        $user_id = Auth::user()->id;
        $teacher = UsersModel::get_single_username($slug);
        $job = Job::get_single_slug($job_slug);

        if(!empty($teacher) && !empty($job) && !empty($request->addmore)) {
            $jobApply           = new JobApply();
            $jobApply->user_id  = $teacher->id;
            $jobApply->job_id   = $job->id;
            $jobApply->type   	= 'school';
            $jobApply->note     = $request->note;
            $jobApply->save();

            foreach ($request->addmore as $key => $r) {

                if(!empty($r['date']) && !empty($r['time']) && !empty($r['duration'])) {

                    $GMT   = new DateTimeZone("GMT");
                    $date  = new DateTime($r['date'].' '.$r['time'], $GMT);
                    $date  = $date->format('Y-m-d h:i:s A');
                    $interview_date_time = strtotime($date);

                    $interview                  = new TeacherJobInterviewTime;
                    $interview->apply_id        = $jobApply->id;
                    $interview->interview_date_time = $interview_date_time;
                    $interview->interview_date  = $r['date'];
                    $interview->interview_time  = $r['time'];
                    $interview->duration        = $r['duration'];
                    $interview->save();

                }
            }


           // school apply teacher: gmeugamer@gmail.com

            $job_apply = JobApply::get_single($jobApply->id);

            $subject = $job_apply->job->user->school_name.'('.$job_apply->job->user->school_id.') invited '.$job_apply->user->name.'('.$job_apply->user->teacher_id.') for interview.';

            // Notification::route('mail', 'gmeugamer@gmail.com')->notify(new SchoolApplyTeacherAdminNotification($job_apply,$subject));

            $insert_data = array(
                'type' => 'interview',
                'common_id' => $job_apply->id,
                'message' => $subject,
            );

            NotificationModel::insert_data(Str::random(36),'App\Notifications\SchoolApplyTeacherAdminNotification','App\Models\UsersModel','1',$insert_data);

            return redirect('school/interview')->with('success', __("message.You have successfully applied for this teacher"));
        }
        else
        {
             return redirect()->back()->with('error', __("message.Due to some error please try again."));
        }
    }


}
