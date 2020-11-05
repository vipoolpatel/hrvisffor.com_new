<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherJobInterviewTime extends Model
{
    protected $table ='teacher_job_interview_times'; 

    

    static public function get_single($id)
    {
        return self::find($id);
    } 

    static public function delete_record($id)
    {
    	self::where('apply_id','=',$id)->delete();
    }

}
