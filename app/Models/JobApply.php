<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use Request;
class JobApply extends Model
{
    protected $table = 'job_apply';

    static public function get_single($id)
    {
        return self::find($id);
    }

    static public function JobApplyCount($id)
    {
        if(Auth::user()->is_admin == 3)
        {
            return self::whereIn('job_id',$id)
                    ->where('is_confirm','=',2)
                    ->count();
        }
        else
        {
            return self::where('user_id','=',$id)
                    ->where('is_confirm','=',2)
                    ->count();    
        }
        
    }

    static public function JobApplyTeacherCount($id,$type) {
        return self::where('user_id','=',$id)
                ->where('is_confirm','=',2)
                ->where('type','=',$type)
                ->count();    
    }

    static public function JobApplySchoolCount($id,$type) {
        return self::whereIn('job_id',$id)
                ->where('is_confirm','=',2)
                ->where('type','=',$type)
                ->count();    
    }
    


    

    static public function getTotalInterview($date = '') {
        $result = self::select('id');
        if(!empty($date)) {
            $result = $result->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"),"=", $date);
        }
        return $result = $result->count();
    }

    static function get_today_interview() {

        $result = self::select('job_apply.*')
            ->join('jobs','jobs.id','=','job_apply.job_id')
            ->join('users','users.id','=','jobs.user_id')
            ->where(DB::raw("(DATE_FORMAT(job_apply.created_at,'%Y-%m-%d'))"),"=", date('Y-m-d'))
            ->orderBy('job_apply.id','desc')
            ->get();

        return $result;
    }


    static function get_apply_job($user_id)
    {
    	$result = self::select('job_apply.*')
    		->join('jobs','jobs.id','=','job_apply.job_id')
    		->join('users','users.id','=','jobs.user_id');
            if(!empty(Request::get('user_id')))
            {
                $result = $result->where('job_apply.user_id','=',Request::get('user_id'));
            }
            if(!empty(Request::get('job_id')))
            {
                $result = $result->where('job_apply.job_id','=',Request::get('job_id'));
            }
            
    		$result = $result->orderBy('job_apply.id','desc')
    		->paginate(12);

        return $result;
    }

    
    // school part


    static function get_apply_job_school($user_id)
    {
        $result = self::select('job_apply.*')
            ->join('jobs','jobs.id','=','job_apply.job_id')
            ->where('jobs.user_id','=',$user_id)
            ->where(function($q) {
                $q->where('job_apply.status','=',2)
                ->orWhere('job_apply.type','=','school');
             })   
            ->orderBy('job_apply.id','desc')
            ->groupBy('job_apply.id')
            ->paginate(12);

        return $result;
    }

    static function get_total_job_school_interview($user_id)
    {
        return  $result = self::select('job_apply.*')
            ->join('jobs','jobs.id','=','job_apply.job_id')
            ->where('jobs.user_id','=',$user_id)
            ->where(function($q) {
                $q->where('job_apply.status','=',2)
                ->orWhere('job_apply.type','=','school');
            })   
            ->orderBy('job_apply.id','desc')
            ->count();

       
    }

    static public function get_today_school_interview($user_id)
    {
          $result = self::select('job_apply.*','teacher_job_interview_times.interview_date_time')
            ->join('jobs','jobs.id','=','job_apply.job_id')
            ->join('teacher_job_interview_times','teacher_job_interview_times.apply_id','=','job_apply.id')
            ->where('jobs.user_id','=',$user_id)
            ->where('job_apply.status','=',2)
            ->where('teacher_job_interview_times.interview_date','=',date('Y-m-d'))
            ->where('teacher_job_interview_times.status','=',2)
            ->orderBy('job_apply.id','desc')
            ->get();

        return $result;
    }


    // teacher part 


    static function get_total_job_teacher_interview($user_id)
    {
        $result = self::select('job_apply.*')
            ->join('jobs','jobs.id','=','job_apply.job_id')
            ->join('users','users.id','=','jobs.user_id')
            ->where('job_apply.user_id','=',$user_id)
            ->where(function($q) {
                $q->where('job_apply.status','=',2)
                ->orWhere('job_apply.type','=','teacher');
            })  
            ->orderBy('job_apply.id','desc')
            ->count();
        return $result;
    }


    static public function get_today_teacher_interview($user_id)
    {
          $result = self::select('job_apply.*','teacher_job_interview_times.interview_date_time')
            ->join('jobs','jobs.id','=','job_apply.job_id')
            ->join('users','users.id','=','jobs.user_id')
            ->join('teacher_job_interview_times','teacher_job_interview_times.apply_id','=','job_apply.id')
            ->where('job_apply.user_id','=',$user_id)
            ->where('job_apply.status','=',2)
            ->where('teacher_job_interview_times.interview_date','=',date('Y-m-d'))
            ->where('teacher_job_interview_times.status','=',2)
            ->orderBy('job_apply.id','desc')
            ->get();

        return $result;
    }



    static function get_apply_job_teacher($user_id)
    {
        $result = self::select('job_apply.*')
            ->join('jobs','jobs.id','=','job_apply.job_id')
            ->join('users','users.id','=','jobs.user_id')
            ->where('job_apply.user_id','=',$user_id)
            ->where(function($q) {
                $q->where('job_apply.status','=',2)
                ->orWhere('job_apply.type','=','teacher');
            })  
            ->orderBy('job_apply.id','desc')
            ->groupBy('job_apply.id')
            ->paginate(12);

        return $result;
    }

  // end teacher part 


    public function user() {
        return $this->belongsTo(UsersModel::class, 'user_id', 'id');
    }

    public function job() {
        return $this->belongsTo(Job::class, 'job_id', 'id');
    }

    public function get_interview_time() {

        $count = self::interview_time_book_count();
        if(!empty($count))
        {
            return $this->hasMany(TeacherJobInterviewTime::class, "apply_id")->where('status','=',2);
        }
        else
        {
            return $this->hasMany(TeacherJobInterviewTime::class, "apply_id");    
        }
    }

    public function interview_time_book_count() {
        return $this->hasMany(TeacherJobInterviewTime::class, "apply_id")->where('status','=',2)->count();
    }

    public function confirm(){
        return $this->belongsTo(JobApplyConfirmStatusModel::class,'is_confirm');
    }

    public function getstatus(){
        return $this->belongsTo(InterviewStatusModel::class,'status');
    }

}
