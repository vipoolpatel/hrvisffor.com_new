<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 8/3/2020
 * Time: 2:55 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class JobWelfare extends Model
{
    protected $table = 'job_welfare';
    protected $fillable =[
      'job_id',
      'welfare_id'
    ];


    static public function delete_job($job_id)
    {
    	self::where('job_id','=',$job_id)->delete();
    }

    public function welfare()
    {
        return $this->belongsTo(Welfare::class, 'welfare_id', 'id');
    }
}
