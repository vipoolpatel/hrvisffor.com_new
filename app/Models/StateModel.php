<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StateModel extends Model
{
    protected $table = 'states';

    static public function get_record()
    {
        return self::orderBy('order_by','asc')->where('is_delete','=','0')->get();
    }

    static public function get_state_country($country_id)
    {
        return self::orderBy('order_by','asc')->where('is_delete','=','0')->where('country_id','=',$country_id)->get();
    }

    static public function get_single($id)
    {
        return self::find($id);
    }

    public function getName()
    {
        return $this->name;
    }
      public function getcountry()
    {
        return $this->belongsTo(CountryModel::class, "country_id");
    }
    static public function get_record_count()
    {
        return self::where('is_delete','=','0')->where('country_id','=','44')->count();
    }

    static public function get_record_pagi($offset,$perpage)
    {
        return self::orderBy('order_by','asc')->where('is_delete','=','0')->where('country_id','=','44')->offset($offset)->limit($perpage)->get();
    }
}
