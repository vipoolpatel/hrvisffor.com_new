<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskModel extends Model
{
    protected $table = 'task';

    static public function get_single($id) 
    {
    	return self::find($id);
    }

    static public function get_task($user_id, $is_admin) 
    {
    	$result =  self::select('task.*');
            if($is_admin == 2) {
                $result = $result->where('user_id','=',$user_id);
            }
            elseif($is_admin == 1 && !empty($user_id)) {
                $result = $result->where('user_id','=',$user_id);
            }

        $result = $result->orderBy('id','desc')->paginate(20);

        return $result;
    }

    public function user()
    {
    	 return $this->belongsTo(UsersModel::class,'user_id','id');
    }

    public function created_user()
    {
    	 return $this->belongsTo(UsersModel::class,'created_by','id');
    }

    

    public function get_status()
    {
	   return $this->belongsTo(TaskStatusModel::class,'status','id');
    }

    public function reply()
    {
    	return TaskReplyModel::select('task_reply.*')
    			->join('users', 'users.id', '=', 'task_reply.sender_id')
    			->where('task_reply.task_id','=',$this->id)
    			->orderBy('task_reply.id','asc')
    			->get();
    }


}
