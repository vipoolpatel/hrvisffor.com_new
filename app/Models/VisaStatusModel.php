<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisaStatusModel extends Model
{
    protected $table = 'visa_status';

    static public function get_record()
    {
        return self::get();
    }
}
