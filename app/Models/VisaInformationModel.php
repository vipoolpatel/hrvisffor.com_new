<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisaInformationModel extends Model
{
    protected $table = 'visa_information';

    static public function get_record()
    {
        return self::orderBy('order_by','asc')->where('is_delete','=','0')->get();
    }

    static public function get_single($id)
    {
        return self::find($id);
    }


    static public function get_record_count()
    {
        return self::get_record()->count();
    }

    static public function get_record_pagi($offset,$perpage)
    {
        return self::orderBy('order_by','asc')->where('is_delete','=','0')->offset($offset)->limit($perpage)->get();
    }

    static public function delete_record($id) {
        return self::where('visa_id','=',$id)->delete();
    }

    

    public function getName()
    {
    	return $this->name;
    }
}
