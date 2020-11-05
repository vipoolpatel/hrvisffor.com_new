<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 8/3/2020
 * Time: 2:55 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class JobTeacherAccommodation extends Model
{
    protected $table = "job_teacher_accommodations";
    protected $fillable = [
      'job_id',
      'image_name'
    ];

    static public function get_single($id)
    {
        return self::find($id);
    }


    public function getImage() {
        if(!empty($this->image_name) && file_exists('upload/school/'.$this->image_name)) {
            return url('upload/school/'.$this->image_name);
        }
        else {
            return '';
        }
    }



}
