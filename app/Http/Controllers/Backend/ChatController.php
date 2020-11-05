<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UsersModel;
use App\Models\ChatModel;
use App\Models\GroupMemberDetailModel;
use App\Models\GroupChatModel;
use App\Models\GroupMasterModel;
use App\Models\GroupMessageCountModel;
use App\Models\PrivateChatModel;


use Auth;

class ChatController extends Controller
{

    // private chat


    public function privatechat($username = '', Request $request)
    { 
        $user = UsersModel::get_single_username($username);

        if((Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2) && empty($request->history))
        {
            if(!empty($user))
            {
                $countMessage = PrivateChatModel::getChatAppCount($user->id, Auth::user()->id);            
                if(empty($countMessage))
                {
                    PrivateChatModel::SendMessage(Auth::user()->id, $user->id);            
                }
            }
        }
        

        if(Auth::user()->is_admin == 3 || Auth::user()->is_admin == 4)
        {
            if(!empty(Auth::user()->staff_id))
            {
                $countMessage = PrivateChatModel::getChatAppCount(Auth::user()->staff_id, Auth::user()->id);            
                if(empty($countMessage))
                {
                    PrivateChatModel::SendMessage(Auth::user()->id, Auth::user()->staff_id);            
                }
            }
        }



        $data['user_id']  = !empty($user->id) ? $user->id : '';
        $data['history']  = !empty($request->history) ? $request->history : '';

        $user_id = Auth::user()->id;

        if(!empty($request->history))
        {
            $user_id = !empty($user->id) ? $user->id : Auth::user()->id;
        }

        $data['sender_id'] = $user_id;

        $data['getUser'] = PrivateChatModel::getChatUser($user_id);  

        return view('backend.privatechat.list',$data);
    }

    public function getprivatechatdata(Request $request) {
        $receiver_id      = $request->receiver_id;
        $sender_id        = $request->sender_id;
        $history        = $request->history;
        
        if(empty($history)) {
            PrivateChatModel::updateMessage($receiver_id,$sender_id);
        }


        $chat = PrivateChatModel::getChatApp($receiver_id,$sender_id);

        $user = UsersModel::get_single($receiver_id);

        return response()->json([
          "status"  => true,
          "success" => view("backend.privatechat._all_chat", [
            "chat" => $chat,
            "user" => $user,  
            "receiver_id" => $receiver_id,  
            "sender_id" => $sender_id,  
            "history" => $history,  
          ])->render(),
        ], 200);
    }


    public function update_private_message_count(Request $request) {
        $receiver_id    = $request->receiver_id;
        PrivateChatModel::updateMessage($receiver_id,Auth::user()->id);
        $json['sucess'] = true;
        echo json_encode($json);
    }


    public function get_private_chat_user(Request $request) {

        $name = !empty($request->name) ? $request->name : '';
        $sender_id = $request->sender_id;

        $getUser = PrivateChatModel::getChatUser($sender_id); 

        $messagecount = PrivateChatModel::countdashabordmessage(Auth::user()->id);

        return response()->json([
          "status"    => true,
          "page"      => $getUser['page'],
          "messagecount"    => $messagecount,
          "success"   => view("backend.privatechat._user", [
            "getUser" => $getUser, 
            "name"    => $name,
            "sender_id"    => $sender_id,
          ])->render(),
        ], 200);

    }   


    // end private chat

    // group part

    public function groupchat()
    {
        $data['getUser'] = GroupMemberDetailModel::getGroupUserList(Auth::user()->id);
        // dd($data['getUser']);

        $data['get_record_staff'] = UsersModel::get_record_staff();
        return view('backend.groupchat.list',$data);
    }


    

   public function getgroupchatdata(Request $request) {

    

        $getMember  = GroupMemberDetailModel::getMember($request->group_id);
        $html = '';
        foreach ($getMember as $key => $value) {
            $html .= '<div class="symbol symbol-35 symbol-circle" data-toggle="tooltip" title="'.$value['name'].'">
                <img alt="'.$value['name'].'" src="'.$value['profile_pic'].'"/>
            </div>';
        }


        $getGroupMessage = GroupChatModel::getGroupMessageList($request->group_id, Auth::user()->id);
        $group = GroupMasterModel::get_single($request->group_id);

        return response()->json([
          "status"  => true,
          "member"  => $html,
          "success" => view("backend.groupchat._all_chat", [
            "chat" => $getGroupMessage,  
            "group_id" => $request->group_id,  
            'group' => $group,
          ])->render(),
        ], 200);
    }


    public function get_chat_group(Request $request) {

        $getUser = GroupMemberDetailModel::getGroupUserList(Auth::user()->id, $request->group_name);

        return response()->json([
          "status"  => true,
          "page"  => $getUser['page'],
          "success" => view("backend.groupchat._group", [
            "getUser" => $getUser
          ])->render(),
        ], 200);

    }   



    public function add_new_member_group(Request $request)
    {
        $group_id = $request->group_id;
        $getUser = UsersModel::get_member_group($group_id);
        $group   = GroupMasterModel::get_single($group_id);
        return response()->json([
          "status"  => true,
          "success" => view("backend.groupchat._add_member_group", [
            "getUser" => $getUser, 
            "group_id" => $group_id,
            "group" => $group,
          ])->render(),
        ], 200);
    }


    public function leave_member_group(Request $request)
    {
        $group_id = $request->group_id;

        $getUser = GroupMemberDetailModel::getMemberStaffAdmin($group_id);
        $group   = GroupMasterModel::get_single($group_id);

        return response()->json([
          "status"  => true,
          "success" => view("backend.groupchat._leave_member_group", [
            "getUser" => $getUser, 
            "group_id" => $group_id,
            "group" => $group,
          ])->render(),
        ], 200);


    }

    public function update_group_message_count(Request $request)
    {
          $user_id = Auth::user()->id;
          GroupMessageCountModel::update_messsage_count($request->group_id, $user_id, $request->chat_id);

          $json['message'] = 'Success';
          echo json_encode($json);
    }


    // chat 

	public function chat($username = '', Request $request)
	{
        $user = UsersModel::get_single_username($username);

        $data['user_id']  = !empty($user->id) ? $user->id : '';
        $data['history']  = !empty($request->history) ? $request->history : '';

        $user_id = Auth::user()->id;

        if(!empty($request->history))
        {
            $user_id = !empty($user->id) ? $user->id : Auth::user()->id;
        }

        $data['sender_id'] = $user_id;

        $data['getUser'] = ChatModel::getChatUser($user_id);  
	
        // dd($data['getUser']);
		return view('backend.chat.list',$data);
	}


    public function getchatdata(Request $request) {
    	
        $receiver_id      = $request->receiver_id;
        
        $sender_id        = $request->sender_id;
        $school_id        = $request->school_id;
        $teacher_id       = $request->teacher_id;
        $school_staff_id  = $request->school_staff_id;
        $teacher_staff_id = $request->teacher_staff_id;
        $main_connect_id  = $request->main_connect_id;
        $history          = $request->history;

        if(empty($history)) {
            ChatModel::updateMessage($receiver_id,$sender_id,$main_connect_id);    
        }
                 
        $chat = ChatModel::getChatApp($receiver_id,$sender_id,$main_connect_id);
        $user = UsersModel::get_single($receiver_id);
        return response()->json([
          "status"  => true,
          "success" => view("backend.chat._all_chat", [
            "chat" => $chat,
            "user" => $user,  
            "receiver_id" => $receiver_id,  
            "sender_id" => $sender_id,  
            "school_id" => $school_id,  
            "teacher_id" => $teacher_id,        
            "school_staff_id" => $school_staff_id,        
            "teacher_staff_id" => $teacher_staff_id,        
            "main_connect_id" => $main_connect_id,        
            "history" => $history,
          ])->render(),
        ], 200);

    }


    public function get_chat_user(Request $request) {
        $name = !empty($request->name) ? $request->name : '';
        $sender_id = $request->sender_id;

        $getUser = ChatModel::getChatUser($sender_id);

        $messagecount = ChatModel::countdashabordmessage(Auth::user()->id);

        return response()->json([
          "status"  => true,
          "page"    => $getUser['page'],
          "messagecount" => $messagecount,
          "success"     => view("backend.chat._user", [
            "getUser"   => $getUser, 
            "name"      => $name,
            "sender_id" => $sender_id,
          ])->render(),
        ], 200);

    }   


     public function update_message_count(Request $request) {
        $receiver_id    = $request->receiver_id;
        $main_connect_id    = $request->main_connect_id;
        ChatModel::updateMessage($receiver_id,Auth::user()->id,$main_connect_id);
        $json['sucess'] = true;
        echo json_encode($json);
    }



    public function get_seach_member(Request $request) 
    {
        $getRecord = UsersModel::get_seach_member($request->search);

        return response()->json([
          "status"  => true,
          "success"     => view("backend.groupchat._search_member", [
            "getRecord"   => $getRecord, 
          ])->render(),
        ], 200);

    }

    public function get_seach_member_group_already(Request $request) 
    {
        $getRecord = UsersModel::get_seach_member($request->search);

        return response()->json([
          "status"  => true,
          "success"     => view("backend.groupchat._search_member_already", [
            "getRecord"   => $getRecord, 
          ])->render(),
        ], 200);

    }

    

}
