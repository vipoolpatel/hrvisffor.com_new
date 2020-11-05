<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsersModel;
use Auth;
use Str;

class APIController extends Controller
{

	public $token;

	public function __construct(Request $request) {
		$this->token = !empty($request->header('token'))?$request->header('token'):'';
	}

	public function app_login(Request $request) {
		
	

		if(!empty($request->username) && !empty($request->password)) {
			if (Auth::attempt(['username' => $request->username, 'password' => $request->password], true)) {
				
				$this->updateToken(Auth::user()->id);

				$json['status'] = true;
				$json['message'] = 'Successfully login';

				$json['result'] = $this->getProfileUser(Auth::user()->id);
				
		    } else {
		        $json['status'] = false;
				$json['message'] = 'Username and password wrong.';
		    }
		}
		else {
			$json['status'] = false;
			$json['message'] = 'Due to some error please try again.';
		}
		echo json_encode($json);
	}



	public function getProfileUser($id) {

		$user 				  = UsersModel::get_single($id);
		$json['id']    		  = $user->id;
		$json['staff_id']     = !empty($user->staff_id) ? $user->staff_id : '';
		$json['name']    	  = !empty($user->name) ? $user->name : '';
		$json['last_name']    = !empty($user->last_name) ? $user->last_name : '';
		$json['email']  	  = !empty($user->email) ? $user->email : '';
		$json['username']     = !empty($user->username) ? $user->username : '';
		$json['user_type']    = !empty($user->is_admin) ? $user->is_admin : '';
		$json['token']    	  = !empty($user->token) ? $user->token : '';
		$json['profile_pic']  = $user->getImage();		
		return $json;	
					
	}


	public function updateToken($user_id) {
		$randomStr 		   = Str::random(40).$user_id;
		$save_token 	   = UsersModel::get_single($user_id);
		$save_token->token = $randomStr;
		$save_token->save();
	}

}
