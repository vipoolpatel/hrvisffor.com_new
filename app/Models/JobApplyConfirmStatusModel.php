<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplyConfirmStatusModel extends Model
{
     protected $table = 'job_apply_confirm_status';

    static public function get_record()
	{
        return self::get();
    }
}
