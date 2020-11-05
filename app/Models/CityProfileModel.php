<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CityProfileModel extends Model
{
    protected $table = 'city_profile';

    static public function get_single($id)
    {
        return self::find($id);
    }

    public function getImage() {
        if(!empty($this->city_image) && file_exists('upload/city/'.$this->city_image)) {
            return url('upload/city/'.$this->city_image);
        }
        else {
            return '';
        }
    }

    public function getVideo() {
        if(!empty($this->city_video) && file_exists('upload/city/'.$this->city_video)) {
            return url('upload/city/'.$this->city_video);
        }
        else {
            return '';
        }
    }

}
