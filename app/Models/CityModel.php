<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CityModel extends Model
{
    protected $table = 'cities';


    static public function get_record()
    {
        return self::orderBy('order_by','asc')->where('is_delete','=','0')->get();
    }

    static public function get_state_city($state_id)
    {
        return self::orderBy('order_by','asc')->where('is_delete','=','0')->where('state_id','=',$state_id)->get();
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
        return self::select('cities.*')->orderBy('cities.order_by','asc')
            ->join('states','states.id','=','cities.state_id')
            ->where('states.country_id','=','44')
            ->where('cities.is_delete','=','0')->count();
    }

    static public function get_record_pagi($offset,$perpage)
    {
        return self::select('cities.*')->orderBy('cities.order_by','asc')
            ->join('states','states.id','=','cities.state_id')
            ->where('states.country_id','=','44')
            ->where('cities.is_delete','=','0')->offset($offset)->limit($perpage)->get();
    }

    public function getstate()
    {
        return $this->belongsTo(StateModel::class, "state_id");
    }

    public function city_profile()
    {
        return $this->belongsTo(CityProfileModel::class, "id", "city_id");
    }

}
