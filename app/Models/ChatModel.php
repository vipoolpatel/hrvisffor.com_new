<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
class ChatModel extends Model
{
    protected $table = 'chat';



   static public function countdashabordmessage($user_id) {
      $i = 0;
      $getdata = ChatModel::getChatUser($user_id);
      foreach ($getdata['result'] as $key => $value) {
        $count = ChatModel::app_countmessage($value['user_id'],$user_id,$value['main_connect_id']);
        if(!empty($count))
        {
          $i = $i + $count;
        }
      }
      return $i;
   }


   public function getconnectuser()
   {
       return $this->belongsTo(UsersModel::class, "connect_user_id");
   }


   public function get_main_connect_user()
   {
       return $this->belongsTo(UsersModel::class, "main_connect_id");
   }

   
   static function updateMessage($receiver_id,$sender_id,$main_connect_id) {
      self::where('sender_id','=',$receiver_id)->where('receiver_id','=',$sender_id)->where('main_connect_id','=',$main_connect_id)->where('status','=','0')->update(['status' => '1']);
   }

    static function getChatApp($receiver_id,$sender_id,$main_connect_id) {

          $query =  self::select('chat.*')
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
            ->where('main_connect_id','=',$main_connect_id)
            ->orderBy('id','asc')
            ->get();

	     return $query;

    }



      // static function getChatUser($id) {

      //       $getuserchat = self::select("*",
      //          \DB::raw('(CASE WHEN sender_id = "'.$id.'" THEN receiver_id ELSE sender_id END) AS connect_user_id'))    
      //        ->whereIn('id', function($query) use($id) { 
      //           $query->selectRaw('max(id)')->from('chat')
      //             ->where('status', '<', 2)
      //             ->where(function ($query)  use($id) {
      //                $query->where('sender_id', '=', $id)
      //                ->orWhere(function ($query) use($id) {
      //                    $query->where('receiver_id', '=', $id)
      //                     ->where('status', '>', '-1');
      //              });
      //            })

      //             // ->groupBy(\DB::raw('CASE WHEN sender_id = "'.$id.'" THEN receiver_id ELSE sender_id END'));

      //             ->groupBy('main_connect_id');
      //       })
      //       ->orderBy('id','desc')
      //       ->get();
      //         // dd($getuserchat->toSql());
      //       return $getuserchat;



      //   }


        
       static public function app_countmessage($connect_user_id,$user_id,$main_connect_id)
       {
          return self::where('sender_id','=',$connect_user_id)->where('receiver_id','=',$user_id)->where('main_connect_id','=',$main_connect_id)->where('status','=',0)->where('message','!=','')->count();
       }






      static public function getChatUser($user_id) {

            $getuserchat = self::select("*",
                   \DB::raw('(CASE WHEN sender_id = "'.$user_id.'" THEN receiver_id ELSE sender_id END) AS connect_user_id'))    
                 ->whereIn('id', function($query) use($user_id) { 
                    $query->selectRaw('max(id)')->from('chat')
                      ->where('status', '<', 2)
                      ->where(function ($query)  use($user_id) {
                         $query->where('sender_id', '=', $user_id)
                         ->orWhere(function ($query) use($user_id) {
                             $query->where('receiver_id', '=', $user_id)
                              ->where('status', '>', '-1');
                       });
                     })

                      // ->groupBy(\DB::raw('CASE WHEN sender_id = "'.$id.'" THEN receiver_id ELSE sender_id END'));

                      ->groupBy('main_connect_id');
                })
                ->orderBy('id','desc');


                if(!empty(Auth::check()))
                {
                    $getuserchat = $getuserchat->paginate(100);
                }
                else
                {
                    $getuserchat = $getuserchat->get();  
                }

                



       

          $user_type = UsersModel::get_single($user_id);
       

          $result = array();

        foreach ($getuserchat as $value) {

           // var sender_id = $(this).attr('data-senderid');
        //     var receiver_id = $(this).attr('data-receiverid');

        //     var school_id        = $(this).attr('data-schoolid');
        //     var teacher_id       = $(this).attr('data-teacherid');
        //     var school_staff_id  = $(this).attr('data-schoolstaffid');
        //     var teacher_staff_id = $(this).attr('data-teacherstaffid');

          
            $data['message']    = $value->message;
            $data['user_id']    = $value->connect_user_id;

            $data['main_connect_id']  = $value->main_connect_id;


            



            if($user_type->is_admin == 4 || $user_type->is_admin == 3)
            {

              // teacher  and school 

              // super admin = 1
              // staff     = 2
              // school      = 3
              // teacher     = 4



              $data['is_online']    = $value->get_main_connect_user->is_online;
              if($value->get_main_connect_user->is_admin == 4)  
              {
                // teacher 

                  $data['school_id']      = $user_type->id;
                  $data['school_staff_id']  = $user_type->staff_id;

                  $data['teacher_id']     = $value->main_connect_id;
                  $data['teacher_staff_id'] = $value->get_main_connect_user->staff_id;


                  $data['name'] = !empty($value->get_main_connect_user->name) ? $value->get_main_connect_user->name : ''; 
              }
              else
              {
                // school 

                  $data['teacher_id']   = $user_type->id;
                  $data['teacher_staff_id']  = $user_type->staff_id;

                  $data['school_id']    = $value->main_connect_id;
                  $data['school_staff_id'] = $value->get_main_connect_user->staff_id;


                  $data['name'] = !empty($value->get_main_connect_user->school_name) ? $value->get_main_connect_user->school_name : '';   
              }
              
              $data['profile_pic']  = $value->get_main_connect_user->getImage();
            }
            else
            {

              // staff part  ad,in or staff  2

              $data['is_online']    = $value->getconnectuser->is_online;

              if($value->getconnectuser->is_admin == 4) 
              {

                // teacher 

                $data['teacher_id']     = $value->getconnectuser->id;
                $data['teacher_staff_id'] = $value->getconnectuser->staff_id;


                $data['school_id']      = $value->get_main_connect_user->id;
                $data['school_staff_id']  = $value->get_main_connect_user->staff_id;


                if(!empty($value->getconnectuser->name))
                {
                    $school_name = !empty($value->get_main_connect_user->school_name) ? $value->get_main_connect_user->school_name : '';
                    $data['name'] = $value->getconnectuser->name .'('.$school_name.')'; 
                }
                else
                {
                    $data['name'] = '';
                }
                
              }
              else
              {

                // school 

                $data['school_id']    = $value->getconnectuser->id;
                $data['school_staff_id'] = $value->getconnectuser->staff_id;

                $data['teacher_id']      = $value->get_main_connect_user->id;
                $data['teacher_staff_id']  = $value->get_main_connect_user->staff_id;


                if(!empty($value->getconnectuser->school_name))
                {
                    $teacher_name = !empty($value->get_main_connect_user->name) ? $value->get_main_connect_user->name : '';

                    $data['name'] = $value->getconnectuser->school_name .'('.$teacher_name.')';
                }
                else
                {
                    $data['name'] = '';
                }             
              }

               $data['profile_pic']   = $value->getconnectuser->getImage();
            }


            $data['messagecount']  = $value->app_countmessage($value->connect_user_id,$user_id,$value->main_connect_id);
            $data['timestamp']     = strtotime($value->created_at);
            $result[] = $data;

          }     



        if(!empty(Auth::check()))
        {
            $page = 0;
            if(!empty($getuserchat->nextPageUrl())) {
                $parse_url =parse_url($getuserchat->nextPageUrl()); 
                if(!empty($parse_url['query']))
                {
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



}
