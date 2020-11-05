<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TravelStatusModel extends Model
{
    protected $table = 'travel_status';

    static public function get_record()
    {
        return self::get();
    }

}
