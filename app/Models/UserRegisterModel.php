<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRegisterModel extends Model
{
    protected $table = 'user_register';


    static public function get_record()
    {
        return self::orderBy('order_by','asc')->where('is_delete','=','0')->get();
    }

    static public function get_single($id)
    {
        return self::find($id);
    }
    
    public function getName()
    {
    	return $this->name;
    }


}
