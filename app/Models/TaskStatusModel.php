<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskStatusModel extends Model
{
     protected $table = 'task_status';

    static public function get_record()
    {
        return self::get();
    }

    public function getName()
    {
    	return $this->name;
    }
}
