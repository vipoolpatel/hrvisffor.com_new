<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
class FeedbackModel extends Model
{
    protected $table = 'feedback';

    static public function get_single($id)
    {
        return self::find($id);
    }


    static public function getTotalFeedback($date = '') {
          $getTotalFeedback = self::select('feedback.*');
				if(!empty($date)) {
                    $getTotalFeedback = $getTotalFeedback->where(DB::raw("(DATE_FORMAT(feedback.created_at,'%Y-%m-%d'))"),"=", $date);
                }
                $getTotalFeedback = $getTotalFeedback->orderBy('feedback.id','desc')
                ->count();
        return $getTotalFeedback;
    }


    
      static public function get_feed_admin($user_id)
    {
	    return self::select('feedback.*')
	    	->join('users','users.id','=','feedback.user_id')
	    	->orderBy('feedback.id','desc')->paginate(12);	
    }

    // teacher side

    static public function get_feed_teacher($user_id)
    {
	    return self::where('user_id','=',$user_id)->orderBy('id','desc')->paginate(12);	
    }


	  public function user()
	  {
	      return $this->belongsTo(UsersModel::class,'user_id','id');
	  }


    public function getVideo() {
        if(!empty($this->video_url) && file_exists('upload/feedback/'.$this->video_url)) {
            return url('upload/feedback/'.$this->video_url);
        }
        else {
            return '';
        }
    }

    public function get_image()
    {
    	  return $this->hasMany(FeedbackImageModel::class, 'feedback_id', 'id');
    }


  

}
