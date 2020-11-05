<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NationalityModel extends Model
{
    protected $table = 'nationality';

    static public function get_record()
    {
        return self::where('is_delete','=','0')->get();
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
        return self::where('is_delete','=','0')->offset($offset)->limit($perpage)->get();
    }

    public function getName()
    {
        return $this->name;
    }


    public function getImage() {
        if(!empty($this->image_name) && file_exists('upload/country/'.$this->image_name)) {
            return url('upload/country/'.$this->image_name);
        }
        else {
            return '';
        }
    }



}
