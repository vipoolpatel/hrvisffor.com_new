<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassSizeModel extends Model
{
    protected $table = 'class_size';

    static public function get_record()
    {
        return self::where('is_delete','=','0')->get();
    }

    static public function get_single($id)
    {
        return self::find($id);
    }

    public function getName()
    {
        return $this->name;
    }
    static public function get_record_count()
    {
        return self::get_record()->count();
    }

    static public function get_record_pagi($offset,$perpage)
    {
        return self::where('is_delete','=','0')->offset($offset)->limit($perpage)->get();
    }

}
