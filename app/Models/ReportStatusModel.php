<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportStatusModel extends Model
{
    protected $table = 'report_status';

    static public function get_record()
    {
        return self::get();
    }

}
