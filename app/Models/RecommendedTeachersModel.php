<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecommendedTeachersModel extends Model
{
    protected $table = 'recommended_teachers';


    static public function get_record()
    {
        return self::get();
    }

    static public function getRecommendedTeachers($school_id)
    {
    	return self::select('recommended_teachers.*')
    		->join('users','users.id','=','recommended_teachers.teacher_id')
    		->where('users.verify','=','1')
    		->where('users.status','=','1')
    		->where('users.is_delete','=','0')
    		->orderby('recommended_teachers.id','desc')
    		->get();
    }

    public function teacher(){
        return $this->belongsTo(UsersModel::class,'teacher_id','id');
    }

    static public function getTeacherID($school_id)
    {
    	$get = self::getRecommendedTeachers($school_id);

    	$result = array();

    	foreach ($get as $key => $value) {
			$result[] = $value->teacher_id;
    	}

    	return $result;
    }


    //add data
    static function recommend_teacher_school($teacher_id, $school_id)
    {
    	$check = self::where('teacher_id','=',$teacher_id)->where('school_id','=',$school_id)->count();
    	if($check == 0)
    	{
			$save = new self;
			$save->school_id = $school_id;
			$save->teacher_id = $teacher_id;
			$save->save();
    	}
    	return true;
    }




}
