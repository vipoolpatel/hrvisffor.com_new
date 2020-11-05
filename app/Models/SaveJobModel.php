<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaveJobModel extends Model
{
    protected $table = 'save_job';

    static public function getJob($teacher_id)
    {
        return self::select('save_job.*')
                        ->join('jobs','jobs.id','=','save_job.job_id')
                        ->join('users','users.id','=','jobs.user_id')
                        ->where('save_job.teacher_id','=',$teacher_id)
                        ->orderBy('save_job.id','desc')
                        ->paginate(24);
    }

  	static public function get_record()
    {
        return self::get();
    }

    static public function get_single($id)
    {
        return self::find($id);
    }

    public function job()
    {
        return $this->belongsTo(Job::class,'job_id','id');
    }


    static function save_job_teacher($job_id, $teacher_id)
    {
    	$check = self::where('job_id','=',$job_id)->where('teacher_id','=',$teacher_id)->count();
    	if($check == 0)
    	{
			$save = new self;
			$save->job_id = $job_id;
			$save->teacher_id = $teacher_id;
			$save->save();
			return true;
    	}
    	else
    	{
			self::where('job_id','=',$job_id)->where('teacher_id','=',$teacher_id)->delete();
			return false;
    	}
    	
    }

}
