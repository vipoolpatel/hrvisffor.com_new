<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInstantMessengerModel extends Model
{
    protected $table = 'user_instant_messenger';

     static public function delete_user($id) {
     	self::where('user_id','=',$id)->delete();
     }

     public function instant_messenger() {
         return $this->belongsTo(InstantMessengerModel::class,'instant_messenger_id');
     }
    
}
