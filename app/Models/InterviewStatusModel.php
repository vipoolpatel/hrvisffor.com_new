<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterviewStatusModel extends Model
{
    protected $table = 'interview_status';

    static public function get_record()
    {
        return self::get();
    }

}
