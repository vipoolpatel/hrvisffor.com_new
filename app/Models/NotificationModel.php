<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
class NotificationModel extends Model
{
    protected $table = 'notifications';

    static public function get_record($user_id)
    {
        if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
        {
            $result = self::orderBy('created_at','desc');
            if(Auth::user()->is_admin == 2) {
                $result = $result->where('staff_id','=',Auth::user()->id);   
            }
            else
            {
                $result = $result->where('notifiable_id','=',1);  
            }
            $result = $result->paginate(15);
            return $result;
        }
        else
        {
            return self::orderBy('created_at','desc')->where('notifiable_id','=',$user_id)->paginate(15);
        }
        
    }


    static public function get_staff_notification()
    {
         $result = self::select('notifications.*','notifications.id as notification_id')
                ->orderBy('created_at','desc')->where('read_at','=', null);

         if(Auth::user()->is_admin == 2) {
            $result = $result->where('staff_id','=',Auth::user()->id);   
         }
         else
         {
            $result = $result->where('notifiable_id','=',1);   
         }

         $result = $result->get();
         return $result;
    }

    static public function getRecommendedTeachers($user_id)
    {
        return self::orderBy('created_at','desc')->where('type','=','App\Notifications\SchoolRecommendNotification')->where('notifiable_id','=',$user_id)->get();
    }

    static public function getRecommendedJobs($user_id)
    {
        return self::orderBy('created_at','desc')->where('type','=','App\Notifications\TeacherRecommendNotification')->where('notifiable_id','=',$user_id)->get();
    }

    
    static public function insert_data($id,$type,$notifiable_type,$notifiable_id,$data)
    {
        $save = new NotificationModel;
        $save->id = $id;
        $save->type = $type;
        $save->notifiable_type = $notifiable_type;
        $save->notifiable_id = $notifiable_id;
        $save->staff_id = !empty(Auth::user()->staff_id) ? Auth::user()->staff_id : '';
        $save->data = json_encode($data);
        $save->save();
    }

    static public function insert_data_staff($id,$type,$notifiable_type,$notifiable_id,$data, $staff_id) {

        $save = new NotificationModel;
        $save->id               =  $id;
        $save->type             = $type;
        $save->notifiable_type  = $notifiable_type;
        $save->notifiable_id    = $notifiable_id;
        $save->staff_id         = $staff_id;
        $save->data             = json_encode($data);
        $save->save();
    }

    
    static public function get_single($id)
    {
        return self::find($id);
    }

    static public function update_date($id)
    {
        $data = self::find($id);
        $data->read_at = date('Y-m-d H:i:s');
        $data->save();
    }
}
