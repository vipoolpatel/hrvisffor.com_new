<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UsersModel;
use App\Models\NotificationModel;
use App\Models\TaskStatusModel;

use App\Notifications\SuperAdminTaskAdminNotification;

use App\Models\TaskModel;
use App\Models\TaskReplyModel;
use Auth;
use Str;



class TaskController extends Controller
{
    public function list($user_id = '',Request $request)
    {			

    	$data['user_id'] = $user_id;
		
		if(Auth::user()->is_admin == 2)
		{
			if(empty($user_id))
	    	{
	    		$user_id = Auth::user()->id;
	    	}	
		}

    	$data['user']	  = UsersModel::get_single($user_id);

    	$data['get_task'] = TaskModel::get_task($user_id, Auth::user()->is_admin);

    	$data['get_status'] = TaskStatusModel::get_record();

    	return view('backend.admin.task.list',$data);
    }


    public function detail($task_id)
    {

		$value 		= TaskModel::get_single($task_id);
    	if(Auth::user()->is_admin == 2)
    	{
    		$connect_user_id = $value->created_by;
    	}
    	else
    	{
    		$connect_user_id = 	$value->user_id;
    	}
    	
		$count = TaskReplyModel::updateMessage($connect_user_id, Auth::user()->id, $task_id);
				

    	$data['get_status'] = TaskStatusModel::get_record();
		$data['value']		= $value;
    	return view('backend.admin.task.detail',$data);	
    }

    public function add($user_id) {

    	$data['user'] = UsersModel::get_single($user_id);
    	$data['get_status'] = TaskStatusModel::get_record();

    	return view('backend.admin.task.add',$data);		

    }

    public function create($user_id, Request $request)
    {
    	$task 			   = new TaskModel;
    	$task->user_id 	   = $user_id;
    	$task->created_by  = Auth::user()->id;
    	$task->title 	   = $request->title;
    	$task->is_urgent   = !empty($request->is_urgent) ? 1 : 0;
    	$task->end_date    = $request->end_date;
    	$task->status  	   = $request->status;
    	$task->description = $request->description;
    	
    	$task->save();
    		

		$subject = 'You have receive new task';

	    $insert_data = array(
            'type'      => 'task',
            'common_id' => $task->id,
            'message'   => $subject,
        );


	    NotificationModel::insert_data_staff(Str::random(36),'App\Notifications\SuperAdminTaskAdminNotification','App\Models\UsersModel', $user_id, $insert_data, $user_id);

    	return redirect('admin/staff/task/'.$user_id)->with("success", __("message.Task Created successfully"));

    }


    public function change_status(Request $request)
    {
    		$task = TaskModel::get_single($request->id);
    		$task->status = $request->status;
    		$task->save();

    		$json['success'] = __("message.Task status successfully change");
    		echo json_encode($json);
    }


   	public function reply($task_id, Request $request)
   	{
   		$taskuser = TaskModel::get_single($task_id);

   		$task 			   	= new TaskReplyModel;
   		$task->task_id     	= $task_id;
   		$task->sender_id    = Auth::user()->id;
   		if(Auth::user()->is_admin == 2) {
   			$task->receiver_id = $taskuser->created_by;
   		}
   		else {
   			$task->receiver_id = $taskuser->user_id;	
   		}
   		
   		
   		$task->description = $request->description;
   		$task->save();

   		$taskuser = TaskModel::get_single($task_id);

   		if(Auth::user()->is_admin == 2)
   		{
   			$subject = 'You have received reply task';

		    $insert_data = array(
	            'type'      => 'task',
	            'common_id' => $taskuser->id,
	            'message'   => $subject,
	        );

		    NotificationModel::insert_data(Str::random(36),'App\Notifications\SuperAdminTaskAdminNotification','App\Models\UsersModel', '1', $insert_data);

   		}
   		else
   		{
   			$subject = 'You have received reply task';

		    $insert_data = array(
	            'type'      => 'task',
	            'common_id' => $taskuser->id,
	            'message'   => $subject,
	        );

		    NotificationModel::insert_data_staff(Str::random(36),'App\Notifications\SuperAdminTaskAdminNotification','App\Models\UsersModel', $taskuser->user_id, $insert_data, $taskuser->user_id);
	
   		}
   		
   		return redirect()->back()->with("success", __("message.Task Reply successfully"));
   	}

   	public function delete_task($task_id)
   	{
    		$delete = TaskModel::get_single($task_id);
    		$delete->delete();

     		TaskReplyModel::where('task_id','=',$task_id)->delete();

     		return redirect()->back()->with("success", __("message.Task deleted successfully"));	
   	}

}
