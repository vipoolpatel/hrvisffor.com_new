<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfileViewModel extends Model
{
    protected $table = 'user_profile_view';

    static public function get_record_count($teacher_id)
    {
        return self::where('teacher_id','=',$teacher_id)->where('school_id','!=',0)->count();
    }

    static public function get_record_pagi($offset,$perpage,$teacher_id)
    {
        return self::orderBy('id','desc')->where('school_id','!=',0)->where('teacher_id','=',$teacher_id)->offset($offset)->limit($perpage)->get();
    }

    public function school() {
    	 return $this->belongsTo(UsersModel::class, 'school_id', 'id');
    }

}


