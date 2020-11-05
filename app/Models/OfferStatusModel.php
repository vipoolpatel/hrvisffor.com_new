<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferStatusModel extends Model
{
    protected $table = 'offer_status';

    static public function get_record()
    {
        return self::get();
    }

}

