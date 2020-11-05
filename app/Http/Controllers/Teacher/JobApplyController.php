<?php

namespace App\Http\Controllers\Teacher;


use App\Http\Controllers\Controller;
use App\Models\JobApply;
use App\Models\UsersModel;
use App\Models\Job;
use App\Models\TeacherJobInterviewTime;
use App\Models\NotificationModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTimeZone;
use DateTime;

use App\Notifications\TeacherApplySchoolAdminNotification;
use Illuminate\Support\Facades\Notification;
use Str;


class JobApplyController extends Controller
{
    public function applyJob(Request $request, $slug)
    {
        $user = UsersModel::get_single(Auth::user()->id);
        $job = Job::get_single_slug($slug);

        $JobApplyCount = JobApply::JobApplyCount(Auth::user()->id);
     
        if($JobApplyCount > 2) {
            return redirect()->back()->with('error','You can only invite for three interviews at the same time. Please complete any previous interview first, and then you can invite or accept a new interview.');   
        }

        $job_id = Job::get_job_id($job->user_id);

        $JobApplyCountSchool = JobApply::JobApplySchoolCount($job_id,'school');
        if($JobApplyCountSchool > 2) {

            return redirect()->back()->with('error','This schools interview time has been fully reserved. There are still three interviews for this school that have not been completed.');   
        }
        

        if(!empty($job)) {
            $data['job']   = $job;
            $data['user']  = $user;
            return view('frontend.teacher.apply',$data);    
        }
        else {
            return redirect(url(''));
        }
        
    }


    public function postApplyJob(Request $request, $slug)
    {

        $user_id = Auth::user()->id;
        $job = Job::get_single_slug($slug);

        if(!empty($job) && !empty($request->addmore)) {
            $jobApply           = new JobApply();
            $jobApply->user_id  = $user_id;
            $jobApply->job_id   = $job->id;
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

            // teacher apply school: chenglongmauk@gmail.com

            $job_apply = JobApply::get_single($jobApply->id);
            
            $subject = $job_apply->user->name.'('.$job_apply->user->teacher_id.') invited '.$job_apply->job->user->school_name.'('.$job_apply->job->user->school_id.') for interview.';

            // Notification::route('mail', 'chenglongmauk@gmail.com')->notify(new TeacherApplySchoolAdminNotification($job_apply,$subject));

            $insert_data = array(
                'type' => 'interview',
                'common_id' => $job_apply->id,
                'message' => $subject,
            );

            NotificationModel::insert_data(Str::random(36),'App\Notifications\TeacherApplySchoolAdminNotification','App\Models\UsersModel','1',$insert_data);

            return redirect('teacher/interview')->with('success','You have successfully applied for this interview');
        }
        else
        {
             return redirect()->back()->with('error','Due to some error please try again.');
        }
    }



}
