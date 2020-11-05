<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedbackImageModel extends Model
{
     protected $table = 'feedback_image';

    static public function get_single($id)
    {
        return self::find($id);
    }


    public function getImage() {
        if(!empty($this->name) && file_exists('upload/feedback/'.$this->name)) {
            return url('upload/feedback/'.$this->name);
        }
        else {
            return '';
        }
    } 

}
