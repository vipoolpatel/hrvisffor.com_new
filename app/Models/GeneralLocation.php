<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 8/2/2020
 * Time: 9:56 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class GeneralLocation extends Model
{
    protected $table = "general_locations";

    protected $fillable =[
      'name'
    ];

    public static function get_record()
    {
        return self::all();
    }

    public static function get_single($id)
    {
        return self::find($id);
    }

    public function getName()
    {
        return $this->name;
    }

    public static function get_record_count()
    {
        return self::get_record()->count();
    }

    public static function get_record_pagination($offset,$perpage)
    {
        return self::offset($offset)->limit($perpage)->get();
    }
}
