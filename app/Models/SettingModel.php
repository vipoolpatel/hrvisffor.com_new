<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingModel extends Model
{
     protected $table = 'setting';

    static public function get_single($id)
    {
        return self::find($id);
    }


    public function get_contract_document() {
        if(!empty($this->contract_document) && file_exists('upload/setting/'.$this->contract_document)) {
            return url('upload/setting/'.$this->contract_document);
        }
        else {
            return '';
        }
    }

    public function get_handbook() {
        if(!empty($this->handbook) && file_exists('upload/setting/'.$this->handbook)) {
            return url('upload/setting/'.$this->handbook);
        }
        else {
            return '';
        }
    }


}
