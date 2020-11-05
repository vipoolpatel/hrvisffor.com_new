<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobProfileViewModel extends Model
{
    protected $table = 'job_profile_view';


    static public function get_record_count($school_id)
    {
		  return self::select('job_profile_view.*')
        		->join('jobs','jobs.id','=','job_profile_view.job_id')
        		->join('users','users.id','=','jobs.user_id')
    			->orderBy('job_profile_view.id','desc')
        		->where('users.id','=',$school_id)->count();
    }

    static public function get_record_pagi($offset,$perpage,$school_id)
    {
        return self::select('job_profile_view.*')
        		->join('jobs','jobs.id','=','job_profile_view.job_id')
        		->join('users','users.id','=','jobs.user_id')
    			->orderBy('job_profile_view.id','desc')
        		->where('users.id','=',$school_id)->offset($offset)->limit($perpage)->get();
    }

    public function teacher() {
    	 return $this->belongsTo(UsersModel::class, 'teacher_id', 'id');
    }



}
