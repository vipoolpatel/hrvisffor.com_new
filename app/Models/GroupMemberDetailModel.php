<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
class GroupMemberDetailModel extends Model
{
    protected $table = 'group_member_detail';

    public function user(){
        return $this->belongsTo(UsersModel::class,'user_id','id');
    }

    public function connect_user(){
        return $this->belongsTo(UsersModel::class,'connect_user_id','id');
    }
    



    static public function getMemberStaffAdmin($group_id)
    {
    	$getMember =  self::select('group_member_detail.*','users.name','users.school_name','users.teacher_id','users.school_id','users.is_admin')
			->join('users','users.id','=','group_member_detail.user_id')
			->where('group_member_detail.group_id','=',$group_id)
			->where('group_member_detail.status','=','1')
			->get();

		return $getMember;
    }





    static public function getMember($group_id)
    {
    	$getMember =  self::select('group_member_detail.*')
			->join('users','users.id','=','group_member_detail.user_id')
			->where('group_member_detail.group_id','=',$group_id)
			->where('group_member_detail.status','=','1')
			->get();


		$member_result = array();

        foreach($getMember as $member)
        {
        	$m_data['id'] = $member->id;
        	$m_data['user_id'] = $member->user_id;
        	$m_data['name'] = !empty($member->user) ? $member->user->name : '';
			$m_data['profile_pic'] = !empty($member->user) ? $member->user->getImage() : '';	        
			$m_data['user_type'] = $member->user->is_admin;	
			$m_data['main_user_id']	= '';
        	$member_result[] = $m_data;
        }


        $getMemberTeacherSchool =  self::select('group_member_detail.*')
			->join('users','users.id','=','group_member_detail.connect_user_id')
			->where('group_member_detail.group_id','=',$group_id)
			->where('group_member_detail.status','=','1')
			->get();

        foreach($getMemberTeacherSchool as $member_s_t)
        {
        	$m_s_t_data['id'] 		= $member_s_t->id;
        	$m_s_t_data['user_id'] 	= $member_s_t->connect_user_id;

        	if($member_s_t->connect_user->is_admin == 3)
        	{
        		$m_s_t_data['name'] 	= !empty($member_s_t->connect_user) ? $member_s_t->connect_user->school_name : '';
        		$m_s_t_data['main_user_id'] 	= !empty($member_s_t->connect_user) ? $member_s_t->connect_user->school_id : '';
        	}
        	else
        	{
        		$m_s_t_data['name'] 	= !empty($member_s_t->connect_user) ? $member_s_t->connect_user->name : '';
        		$m_s_t_data['main_user_id'] 	= !empty($member_s_t->connect_user) ? $member_s_t->connect_user->teacher_id : '';
        	}
        	
			$m_s_t_data['profile_pic'] = !empty($member_s_t->connect_user) ? $member_s_t->connect_user->getImage() : '';

		    $m_s_t_data['user_type'] = $member_s_t->connect_user->is_admin;	
			$member_result[] = $m_s_t_data;
			
        }

        return $member_result;

        
    }




    static public function getGroupUserList($user_id, $group_name = '')
    {
    	$getGroupUser = self::select('group_member_detail.*','group_master.group_name','group_chat.message',  DB::raw('MAX(group_chat.id) AS chat_id'))
			->join('group_master','group_master.id','=','group_member_detail.group_id')
			->join('users','users.id','=','group_member_detail.user_id')
			->join('group_chat','group_chat.group_id','=','group_master.id','left')
			->where('group_member_detail.user_id','=',$user_id)
			->where('group_member_detail.status','=',"1");
			if(!empty($group_name))
			{
				$getGroupUser = $getGroupUser->where('group_master.group_name','like','%'.$group_name.'%');
			}

			$getGroupUser = $getGroupUser->groupBy('group_master.id');
			$getGroupUser = $getGroupUser->orderBy('group_master.updated_at','desc');

			if(!empty(Auth::check()))
			{
				$getGroupUser = $getGroupUser->paginate(100);
			}
			else
			{
				$getGroupUser = $getGroupUser->get();
			}
			
			// $getGroupUser->toSql();
		$result = array();


		

		foreach ($getGroupUser as $key => $value) {
			
			 $chat_id = 0;
			 $checkMessagecheck = GroupMessageCountModel::where('group_id','=',$value->group_id)->where('user_id','=',$user_id)->first();

			 if(!empty($checkMessagecheck))
			 {
			 	if(!empty($checkMessagecheck->chat_id))
			 	{
			 		$chat_id = $checkMessagecheck->chat_id;	
			 	}
			 }
			 

			 $messagecount  = GroupChatModel::where('group_id','=',$value->group_id)->where('id', '>', $chat_id)->count();


			$data['id']			= $value->id;
			$data['group_id']	= $value->group_id;
			$data['group_name']	= $value->group_name;
			$data['messagecount']	= $messagecount;

			$data['chat_id']	= !empty($value->chat_id) ? $value->chat_id : '';
	
			// $data['user_id']	= $value->user_id;
			// $data['connect_user_id'] = !empty($value->connect_user_id) ? $value->connect_user_id : '';

			if(!empty($value->chat_id))
			{
				$chat = GroupChatModel::find($value->chat_id);

				$data['message']	= !empty($chat->message) ? $chat->message : '';	
				$data['timestamp']	= $chat->created_date;
			}
			else
			{
				$data['message']	=  '';
				$data['timestamp']	= $value->created_date;	
			}


			$result[] = $data;
		}


		if(!empty(Auth::check()))
		{
			$page = 0;
			if(!empty($getGroupUser->nextPageUrl())) {

	              $parse_url =parse_url($getGroupUser->nextPageUrl()); 
	              if(!empty($parse_url['query']))
	              {
	                   parse_str($parse_url['query'], $get_array);     
	                   $page = !empty($get_array['page']) ? $get_array['page'] : 0;
	              }
	 	    }

	 	    $json['page'] 	 = intval($page);
		}

		$json['status']  = true;
		$json['message'] = 'Success';
		$json['result']  = $result;	
		return $json;

    }
}
