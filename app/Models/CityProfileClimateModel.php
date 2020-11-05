<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CityProfileClimateModel extends Model
{
    
    protected $table = 'city_profile_climate';

    static public function delete_data($id) {
     	return self::where('climate_id','=',$id)->delete();
    }

    static public function climate($climate_id, $city_profile_id) {
         return self::where('climate_id','=',$climate_id)->where('city_profile_id','=',$city_profile_id)->first();
    }
    
}
