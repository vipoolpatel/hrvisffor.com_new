<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEducation extends Model
{
    protected $table = 'user_education';

    public function country(){
        return $this->belongsTo(CountryModel::class,'country_id','id');
    }

}
