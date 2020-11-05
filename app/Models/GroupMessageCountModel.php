<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
class GroupMessageCountModel extends Model
{
     protected $table = 'group_message_count';

     static public function update_messsage_count($group_id, $user_id, $chat_id)
     {
 			$checkMessagecheck = self::where('group_id','=',$group_id)->where('user_id','=',$user_id)->first();

            if(!empty($checkMessagecheck))
            {
                $checkMessagecheck->chat_id = $chat_id;
                $checkMessagecheck->save();
            }
            else
            {
                $count_message       = new GroupMessageCountModel;
                $count_message->chat_id  = $chat_id;
                $count_message->user_id  = $user_id;
                $count_message->group_id = $group_id;
                $count_message->save();
            }
     }

}
