<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ChatModel;
use App\Models\UsersModel;
use App\Models\UserBlockModel;
use App\Models\GroupMemberDetailModel;
use App\Models\GroupChatModel;
use App\Models\GroupMessageCountModel;


use Hash;
use File;
use Image;
use DateTimeZone;
use DateTime;
use Str;


class APIAuthController extends Controller
{
   
    public $token;
	public $setApiKey;

	public function __construct(Request $request) {
		$this->token = !empty($request->header('token'))?$request->header('token'):'';
		$user_id = $this->checkToken();
		if(empty($user_id))
		{
			$json['status']  = false;
			$json['message'] = 'Token expire';
			$json['code'] 	 = 400;
			echo json_encode($json);
			die;
		}
		
		$this->setApiKey = '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';		
	}


	public function checkToken()
	{
		$checkToken = UsersModel::where('token','=',$this->token)->first();
		if(!empty($checkToken))
		{
			return $checkToken->id;
		}
		else
		{
			return '';
		}	
	}

	// Char Part

    public function app_get_chat_user(Request $request) {
    	$user_id = $this->checkToken();
        $json = ChatModel::getChatUser($user_id);
        echo json_encode($json);
	}

    public function app_get_chat_message(Request $request) {
    	$sender_id 			= $this->checkToken();
		if(!empty($request->user_id) && !empty($request->main_connect_id))
		{
			$receiver_id  		= $request->user_id;
	    	$main_connect_id    = $request->main_connect_id;

	    	ChatModel::updateMessage($receiver_id,$sender_id,$main_connect_id);

	        $getChatApp = ChatModel::getChatApp($receiver_id,$sender_id,$main_connect_id);

	        ChatModel::where('sender_id','=',$sender_id)->where('receiver_id','=',$receiver_id)->where('status','=',0)->update(['status' => '1']);

	        $result = array();

	        foreach ($getChatApp as $key => $value) {
	        	
	    		$data['id'] = $value->id;
				$data['sender_id'] = $value->sender_id;
				$data['receiver_id'] = $value->receiver_id;
				$data['main_connect_id'] = $value->main_connect_id;
				$data['message'] = $value->message;
				$data['timestamp'] = $value->created_date;
				$result[] = $data;

	        }

	        $is_block = UserBlockModel::where('user_id','=',$sender_id)->where('connect_id','=',$receiver_id)->count();

			if($is_block > 0) {

				$json['is_block'] = true;
			}
			else {
				$json['is_block'] = false;	
			}


	    	$json['status'] = true;
			$json['message'] = 'Success';
	    	$json['result'] = $result;
		}
		else
		{
			$json['status']  = false;
			$json['message'] = 'Due to some error please try again.';
		}
  		echo json_encode($json);
	}


	public function app_update_message_count(Request $request) {
		if(!empty($request->user_id) && !empty($request->main_connect_id)) {

			$receiver_id = $request->user_id;
			$sender_id  = $this->checkToken();
			$main_connect_id = $request->main_connect_id;
			
    		ChatModel::updateMessage($receiver_id,$sender_id,$main_connect_id);

	        $json['status'] = true;
	        $json['message'] = 'Success';
		}
		else {
			$json['status'] = false;
	        $json['message'] = 'Due to some error please try again.';
		}
    	echo json_encode($json);
	}


	public function app_get_group_user_list()
	{
    	$user_id = $this->checkToken();
        $json = GroupMemberDetailModel::getGroupUserList($user_id);
        echo json_encode($json);
	}


	public function app_get_group_message_list(Request $request)
	{
		if(!empty($request->group_id))
		{
		 	$user_id = $this->checkToken();
	        $getGroupMessage = GroupChatModel::getGroupMessageList($request->group_id,$user_id);

	        $result = array();
	        foreach ($getGroupMessage as $key => $value) {
	    
	        	$data['id'] = $value->id;
	        	$data['sender_id'] = $value->sender_id;
	        	$data['sender_name'] = $value->sender_name;
	        	$data['message'] = $value->message;
	        	$data['group_name'] = $value->group_name;
	        	$data['group_id'] = $value->group_id;
	        	$data['created_date'] = $value->created_at;
	        	$data['timestamp'] = $value->created_date;

	        	$result[] = $data;
	        }

	        $main_array['member']  = GroupMemberDetailModel::getMember($request->group_id);
	        $main_array['message'] = $result;

	        $json['status'] = true;
	        $json['message'] = 'Success';
	        $json['result'] = $main_array;
	        
		}
		else
		{
			$json['status'] = false;
	        $json['message'] = 'Due to some error please try again.';
		}

	    echo json_encode($json);
   
	}


	public function app_get_member_group(Request $request)
	{
		$group_id = '';
		if(!empty($request->group_id))
		{
			$group_id = $request->group_id;
		}
		
		$member  = UsersModel::get_member_group($group_id);
		$result = array();
		foreach ($member as  $value) {
			$data['id'] 		 = $value->id;
        	$data['name'] 		 = !empty($value->name) ? $value->name : '';
        	$data['profile_pic'] = $value->getImage();
        	$result[] = $data;
		}

		$json['status'] = true;
        $json['message'] = 'Success';
        $json['result'] = $result;
		

		echo json_encode($json);
	}

	public function app_get_member_group_list(Request $request)
	{
		if(!empty($request->group_id))
		{
			$result  = GroupMemberDetailModel::getMember($request->group_id);

			$json['status'] = true;
	        $json['message'] = 'Success';
	        $json['result'] = $result;
		}
		else
		{
			$json['status'] = false;
	        $json['message'] = 'Due to some error please try again.';	
		}

		echo json_encode($json);	 
	}


	public function app_update_group_message_count(Request $request)
	{
		if(!empty($request->group_id) && !empty($request->chat_id))
		{
			
			$user_id = $this->checkToken();

			$checkMessagecheck = GroupMessageCountModel::where('group_id','=',$request->group_id)->where('user_id','=',$user_id)->first();

            if(!empty($checkMessagecheck))
            {
                $checkMessagecheck->chat_id = $request->chat_id;
                $checkMessagecheck->save();
            }
            else
            {
                $count_message			 = new GroupMessageCountModel;
                $count_message->chat_id  = $request->chat_id;
                $count_message->user_id  = $user_id;
                $count_message->group_id = $request->group_id;
                $count_message->save();
            }

			$json['status'] = true;
	        $json['message'] = 'Success';
	        
		}
		else
		{
			$json['status'] = false;
	        $json['message'] = 'Due to some error please try again.';	
		}

		echo json_encode($json);	 
	}



	public function app_chat_block_user(Request $request)
	{
		$user_id  = $this->checkToken();
		if(!empty($request->user_id)) {
			$count = UserBlockModel::where('user_id','=',$user_id)->where('connect_id','=',$request->user_id)->count();
			if($count == 0)
			{
				$user = new UserBlockModel;
				$user->user_id = $user_id;
				$user->connect_id = $request->user_id;
				$user->status = 1;
				$user->save();

				$json['status'] = true;
				$json['is_block'] = true;	
	        	$json['message'] = "Successfully user block";
			}
			else
			{
				UserBlockModel::where('user_id','=',$user_id)->where('connect_id','=',$request->user_id)->delete();

				$json['status'] = true;
				$json['is_block'] = false;	
	        	$json['message'] = "Successfully user Unblock";
			}	
		}
		else
		{
			$json['status'] = false;
	        $json['message'] = 'Due to some error please try again.';
		}

		echo json_encode($json);

		

	}


	


}
