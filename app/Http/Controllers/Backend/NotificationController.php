<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UsersModel;
use App\Models\NotificationModel;
use Auth;

class NotificationController extends Controller
{
    public function notification(Request $request) {

		$data['user'] = UsersModel::get_single(Auth::user()->id);
		$data['notifications'] = NotificationModel::get_record(Auth::user()->id);

		if(!empty($request->id)) {
			NotificationModel::update_date($request->id);
		}

		if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
		{
			return view('backend.admin.notification',$data);
		}
		else if(Auth::user()->is_admin == 3)
		{
			return view('backend.school.notification',$data);	
		}	
		else if(Auth::user()->is_admin == 4)
		{
			return view('backend.teacher.notification',$data);
		}
		
	}
}
