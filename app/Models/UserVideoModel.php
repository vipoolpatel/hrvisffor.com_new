<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserVideoModel extends Model
{
    protected $table = 'user_video';

    static public function get_single($id)
    {
        return self::find($id);
    }

    public function getVideo() {
        if(!empty($this->name) && file_exists('upload/profile/'.$this->name)) {
            return url('upload/profile/'.$this->name);
        }
        else {
            return '';
        }
    }

}
