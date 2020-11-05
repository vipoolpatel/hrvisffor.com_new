<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskReplyModel extends Model
{
    protected $table = 'task_reply';

    public function sender() {
    	 return $this->belongsTo(UsersModel::class,'sender_id','id');
    }

    public function receiver() {
    	 return $this->belongsTo(UsersModel::class,'receiver_id','id');
    }

    static public function totalMessageCount($user_id) {
    	return self::where('receiver_id', '=', $user_id)->where('status', '=', '0')->where('description', '!=','')->count();
    }

    static public function count_message_task($connect_user_id,$user_id,$task_id)
    {
          return self::where('sender_id','=',$connect_user_id)->where('receiver_id','=',$user_id)->where('task_id','=',$task_id)->where('status','=',0)->where('description','!=','')->count();
    }

	static function updateMessage($receiver_id,$sender_id,$task_id) {
      	self::where('sender_id','=',$receiver_id)->where('receiver_id','=',$sender_id)->where('task_id','=',$task_id)->where('status','=','0')->update(['status' => '1']);
   	}

}
