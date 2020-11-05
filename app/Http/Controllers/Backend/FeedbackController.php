<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\UsersModel;
use App\Models\OfferContractModel;
use App\Models\FeedbackModel;
use App\Models\FeedbackImageModel;
use App\Models\NotificationModel;

use App\Models\AdminPermissionModel;


use Auth;
use File;
use Str;
use Image;


class FeedbackController extends Controller
{
    	
	public function list(Request $request)
	{		
  		if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)  
  		{ 
          $check_permission = AdminPermissionModel::getPermission('feedback');
          if(empty($check_permission)) {
               return redirect('admin/dashboard');
          }

         $data['get_feedback'] = FeedbackModel::get_feed_admin(Auth::user()->id);
	       return view('backend.admin.feedback.list',$data);
  		}  	
  		elseif(Auth::user()->is_admin == 4)
  		{
  			$data['get_feedback'] = FeedbackModel::get_feed_teacher(Auth::user()->id);
  			return view('backend.teacher.feedback.list',$data);
  		}
	}

	public function add()
	{
		$data['get_contract_school'] = OfferContractModel::visa_contract_school(Auth::user()->id);
		return view('backend.teacher.feedback.add',$data);
	}


	public function insert(Request $request) {
		$feedback = new FeedbackModel;
		$feedback->user_id = Auth::user()->id;
		$feedback->title = $request->title;
		$feedback->review = $request->review;

        if(!empty($request->file('video_url'))) {
           $ext           = $request->file('video_url')->extension();
           $file          = $request->file('video_url');
           $randomStr     = date('YmdHis').Str::random(30);
           $filename      = strtolower($randomStr) . '.' . $ext;
           $file->move('upload/feedback/', $filename);
           $feedback->video_url = $filename;
        }

   	$feedback->save();



        if(!empty($request->file('photo')))
        {
            foreach($request->file('photo') as $photo)
            {
             
                if(!empty($photo))   
                {
                    $image          = new FeedbackImageModel;
                    $image->feedback_id = $feedback->id;

                    $ext            = $photo->extension();
                    $file           = $photo;
                    $randomStr      = date('YmdHis').Str::random(30);
                    $filename       = strtolower($randomStr) . '.' . $ext;
                    $file->move('upload/feedback/', $filename); 

                    $image->name = $filename;
                    $image->save();
                }

            }
        }



        $subject = ''.$feedback->user->name.' ('.$feedback->user->teacher_id.') send new feedback';

        $insert_data = array(
            'type'      => 'feedback',
            'common_id' => $feedback->id,
            'message'   => $subject,
        );

        NotificationModel::insert_data(Str::random(36),'App\Notifications\TeacherSendFeedbackAdminNotification','App\Models\UsersModel','1',$insert_data);

		    return redirect('teacher/feedback')->with('success', __("message.Feedback successfully created"));

	}

  // admin side

  public function edit(Request $request)
  {
      $feedback = FeedbackModel::find($request->id);
      return response()->json([
          "status"    => true,
          "success"   => view('backend.admin.feedback._edit', [
              "feedback" => $feedback,
          ])->render(),
      ], 200);
  }


  public function update(Request $request) {
      $feedback = FeedbackModel::get_single($request->id);
      $feedback->title = $request->title;
      $feedback->review = $request->review;

      if(!empty($request->file('video_url'))) {
         $ext           = $request->file('video_url')->extension();
         $file          = $request->file('video_url');
         $randomStr     = date('YmdHis').Str::random(30);
         $filename      = strtolower($randomStr) . '.' . $ext;
         $file->move('upload/feedback/', $filename);
         $feedback->video_url = $filename;
      }

      $feedback->save();



      if(!empty($request->file('photo')))
      {
          foreach($request->file('photo') as $photo)
          {
           
              if(!empty($photo))   
              {
                  $image          = new FeedbackImageModel;
                  $image->feedback_id = $feedback->id;

                  $ext            = $photo->extension();
                  $file           = $photo;
                  $randomStr      = date('YmdHis').Str::random(30);
                  $filename       = strtolower($randomStr) . '.' . $ext;
                  $file->move('upload/feedback/', $filename); 

                  $image->name = $filename;
                  $image->save();
              }

          }
      }

      return redirect('admin/feedback')->with('success', __("message.Feedback successfully updated"));

  }



  public function delete($id)
  {
      $feedback =  FeedbackModel::get_single($id);
      if(!empty($feedback->video_url) && file_exists('upload/feedback/'.$feedback->video_url)){
          unlink('upload/feedback/'.$feedback->video_url);
      }

      foreach ($feedback->get_image as $key => $value) {
          if(!empty($value->name) && file_exists('upload/feedback/'.$value->name)){
              unlink('upload/feedback/'.$value->name); 
          }  
          $value->delete();
      }

      $feedback->delete();

      return redirect('admin/feedback')->with('success', __("message.Feedback deleted successfully"));
  }






}
