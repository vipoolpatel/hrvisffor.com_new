<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLocationModel extends Model
{
     protected $table = 'user_location';

     static public function delete_user($id) {
     	self::where('user_id','=',$id)->delete();
     }
     public function state(){
         return $this->belongsTo(StateModel::class,'state_id');
     }
     public function city(){
         return $this->belongsTo(CityModel::class, 'city_id');
     }


    public function get_location() {

        $location = '';
        if(!empty($this->city))
        {
            $location .= $this->city->getName().', ';
        }

        if(!empty($this->state))
        {
            $location .= $this->state->getName();  
        }
        
        return $location;
    }

}
