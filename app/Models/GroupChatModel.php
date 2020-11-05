<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupChatModel extends Model
{
    protected $table = 'group_chat';

    static public function get_single($id)
    {
        return self::find($id);
    }

    static public function getGroupMessageList($group_id,$user_id)
    {
    	$return =  self::select('group_chat.*','group_master.group_name','users.name as sender_name')
				->join('users','users.id','=','group_chat.sender_id')
				->join('group_master','group_master.id','=','group_chat.group_id')
				->where('group_master.id','=',$group_id)
				->orderBy('group_chat.id','asc')
				->get();
		// dd($return->toSql());


       if($return->count() > 0)
        {
                $chat_id = $return->last()->id;

                $checkMessagecheck = GroupMessageCountModel::where('group_id','=',$group_id)->where('user_id','=',$user_id)->first();

                if(!empty($checkMessagecheck))
                {
                    $checkMessagecheck->chat_id = $chat_id;
                    $checkMessagecheck->save();
                }
                else
                {
                    $count_message = new GroupMessageCountModel;
                    $count_message->chat_id = $chat_id;
                    $count_message->user_id = $user_id;
                    $count_message->group_id = $group_id;
                    $count_message->save();
                }
        }


		return $return;


    }

}
