<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
class PermissionModel extends Model
{
     protected $table = 'permission';

     static public function getpermission()
     {
     	return self::get();
     }

     public function count($user_id) {
     	
     	return self::select('admin_permission.*')
					->join('admin_permission','admin_permission.permission_id','=','permission.id')
					->where('admin_permission.staff_id','=',$user_id)
					->where('admin_permission.permission_id','=',$this->id)
					->count();
     }


}
