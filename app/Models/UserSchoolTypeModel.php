<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSchoolTypeModel extends Model
{
     protected $table = 'user_school_type';

     static public function delete_user($id) {
     	self::where('user_id','=',$id)->delete();
     }
    public function school_type(){
        return $this->belongsTo(SchoolTypeModel::class,'school_type_id');
    }
}
