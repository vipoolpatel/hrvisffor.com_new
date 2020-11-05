<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
class PrivateChatModel extends Model
{
   protected $table = 'private_chat';



   public function getconnectuser() {
       return $this->belongsTo(UsersModel::class, "connect_user_id");
   }

   static public function SendMessage($sender_id, $receiver_id)
   {
        $message = new PrivateChatModel;
        $message->sender_id    = $sender_id;
        $message->receiver_id  = $receiver_id;
        $message->message      = '';
        $message->created_date = time();
        $message->save();
   }



    static public function getChatUserDashboard($user_id) {

        $getuserchat = self::select("*",'sender_id as connect_user_id')
                ->where('receiver_id','=',$user_id)
                ->where('status','=',0)
                ->orderBy('id','desc')
                ->groupBy('sender_id')
                ->get();
        return $getuserchat;          
    }




   // message get

    static function getChatAppCount($receiver_id,$sender_id) {

        $query =  self::select('private_chat.*')
           ->where(function($q) use ($receiver_id,$sender_id) {
                $q->where(function($q) use ($receiver_id,$sender_id) {

                $q->where('receiver_id', $receiver_id)
                  ->where('sender_id', $sender_id)
                  ->where('status','>','-1');

                })->orWhere(function ($q) use ($sender_id,$receiver_id) {
                    $q->where('receiver_id', $sender_id)
                      ->where('sender_id', $receiver_id);
                });
            })
          ->orderBy('id','asc')
          ->count();
       return $query;

    }


   static function getChatApp($receiver_id,$sender_id) {

        $query =  self::select('private_chat.*')
	         ->where(function($q) use ($receiver_id,$sender_id) {
	              $q->where(function($q) use ($receiver_id,$sender_id) {

	              $q->where('receiver_id', $receiver_id)
	                ->where('sender_id', $sender_id)
	                ->where('status','>','-1');

	              })->orWhere(function ($q) use ($sender_id,$receiver_id) {
	                  $q->where('receiver_id', $sender_id)
	                    ->where('sender_id', $receiver_id);
	              });
	          })
	        ->where('message','!=','')
	        ->orderBy('id','asc')
	        ->get();

	     return $query;

    }


    // user get
    
    static public function getChatUser($user_id) {

  	    $getuserchat = self::select("*",
	           \DB::raw('(CASE WHEN sender_id = "'.$user_id.'" THEN receiver_id ELSE sender_id END) AS connect_user_id'))    
	         ->whereIn('id', function($query) use($user_id) { 
	            $query->selectRaw('max(id)')->from('private_chat')
	              ->where('status', '<', 2)
	              ->where(function ($query)  use($user_id) {
	                 $query->where('sender_id', '=', $user_id)
	                 ->orWhere(function ($query) use($user_id) {
	                     $query->where('receiver_id', '=', $user_id)
	                      ->where('status', '>', '-1');
	               });
	             })
			     	->groupBy(\DB::raw('CASE WHEN sender_id = "'.$user_id.'" THEN receiver_id ELSE sender_id END'));	             
	        })
	        ->orderBy('id','desc');

        if(!empty(Auth::check())) {
            $getuserchat = $getuserchat->paginate(100);
        }
        else {
            $getuserchat = $getuserchat->get();  
        }

        $result = array();

        foreach ($getuserchat as $value) {

          	$data['id'] 	    = $value->id;
            $data['message']    = $value->message;
            $data['user_id'] 	= $value->connect_user_id;
         	$data['is_online']  = $value->getconnectuser->is_online;

            if($value->getconnectuser->is_admin == 3) {
				$data['name'] = !empty($value->getconnectuser->school_name) ? $value->getconnectuser->school_name : '';   
    		}
    		else {
				$data['name'] = !empty($value->getconnectuser->name) ? $value->getconnectuser->name : '';   	
    		}
            $data['profile_pic']  = $value->getconnectuser->getImage();
            $data['messagecount'] = $value->app_countmessage($value->connect_user_id,$user_id);
            $data['timestamp']    = strtotime($value->created_at);
            $result[] = $data;

        }     

        if(!empty(Auth::check())) {
            $page = 0;
            if(!empty($getuserchat->nextPageUrl())) {
                $parse_url =parse_url($getuserchat->nextPageUrl()); 
                if(!empty($parse_url['query'])) {
                    parse_str($parse_url['query'], $get_array);     
                    $page = !empty($get_array['page']) ? $get_array['page'] : 0;
                }
            }

            $json['page'] = intval($page);
        }


        $json['status'] = true;
        $json['message'] = 'Success';
        $json['result'] = $result;
        
        return $json;          
    }


    static public function app_countmessage($connect_user_id,$user_id) {
        return self::where('sender_id','=',$connect_user_id)->where('receiver_id','=',$user_id)->where('status','=',0)->where('message','!=','')->count();
    }




    static function updateMessage($receiver_id,$sender_id) {
          self::where('sender_id','=',$receiver_id)->where('receiver_id','=',$sender_id)->where('status','=','0')->update(['status' => '1']);
    }


    static public function countdashabordmessage($user_id) {
        $i = 0;
        $getdata = PrivateChatModel::getChatUser($user_id);
        if(!empty($getdata['result']))
        {
            foreach ($getdata['result'] as $key => $value) {
              $count = PrivateChatModel::app_countmessage($value['user_id'],$user_id);
              if(!empty($count))
              {
                $i = $i + $count;
              }
            }  
        }
        
        return $i;
     }



     public function getName()
     {
          if($this->getconnectuser->is_admin == 3)
          {
              $name = $this->getconnectuser->school_name;
          }
          else
          {
              $name = $this->getconnectuser->name;
          }
          return $name;
     }





}
