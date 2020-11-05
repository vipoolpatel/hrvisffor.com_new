<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CityProfileLivingCostModel extends Model
{
    protected $table = 'city_profile_living_cost';

    static public function delete_data($id) {
     	return self::where('city_profile_id','=',$id)->delete();
    }

    static public function living_cost($living_cost_id, $city_profile_id) {
         return self::where('living_cost_id','=',$living_cost_id)->where('city_profile_id','=',$city_profile_id)->first();
    }


}
