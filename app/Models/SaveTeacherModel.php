<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaveTeacherModel extends Model
{
    protected $table = 'save_teacher';

    // school side

    static public function getTeacher($school_id) {
        return self::select('save_teacher.*')
                        ->join('users','users.id','=','save_teacher.teacher_id')
                        ->where('save_teacher.school_id','=',$school_id)
                        ->orderBy('save_teacher.id','desc')
                        ->paginate(24);
    }

    public function teacher()
    {
        return $this->belongsTo(UsersModel::class,'teacher_id','id');
    }

    public function school()
    {
        return $this->belongsTo(UsersModel::class,'teacher_id','id');
    }

    // end school side


  	static public function get_record()
    {
        return self::get();
    }

    static public function get_single($id)
    {
        return self::find($id);
    }

    static function save_teacher_school($teacher_id, $school_id)
    {
    	$check = self::where('teacher_id','=',$teacher_id)->where('school_id','=',$school_id)->count();
    	if($check == 0)
    	{
			$save = new self;
			$save->school_id = $school_id;
			$save->teacher_id = $teacher_id;
			$save->save();
			return true;
    	}
    	else
    	{
			self::where('teacher_id','=',$teacher_id)->where('school_id','=',$school_id)->delete();
			return false;
    	}
    	
    }
}
