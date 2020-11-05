<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

use Auth;
class AdminPermissionModel extends Model
{
    protected $table = 'admin_permission';

    static public function get_permission($staff_id) {
    	return self::where('staff_id','=',$staff_id)->get();
    }


    static public function delete_user($staff_id) {
        return self::where('staff_id','=',$staff_id)->delete();
    }

    

 	static public function getPermission($slug)
    {
    	if(Auth::user()->is_admin == 1)
    	{
    		return 1;
    	}
    	else
    	{
    		return self::select('admin_permission.*')
					->join('permission','permission.id','=','admin_permission.permission_id')
					->where('admin_permission.staff_id','=',Auth::user()->id)
					->where('permission.slug','=',$slug)
					->count();	
    	}
    	
    	
    }	



}
