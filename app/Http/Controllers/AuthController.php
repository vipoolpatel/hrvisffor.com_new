<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\UsersModel;
use App\User;
use App\Http\Requests\ResetPassword;
use Hash;
use Auth;
use App\Mail\ForgotPasswordMail;
use App\Mail\RegisterMail;
use App\Mail\ForgotUsernameMail;

use Session;
use Mail;
use Validate;
use Str;

class AuthController extends Controller {

	public function login()
	{

		$data['meta_title'] = "Sign In";
		return view('auth.login',$data);
	}

	public function register()
	{
		$data['meta_title'] = "Sign Up";
		return view('auth.register',$data);
	}

	public function forgot()
	{
		$data['meta_title'] = "Forgot Password";
		return view('auth.forgot',$data);
	}

	public function forgot_username()
	{
		$data['meta_title'] = "Forgot Username";
		return view('auth.forgot_username',$data);
	}

	public function login_auth(Request $request)
	{

		if (Auth::attempt(['username' => $request->username, 'password' => $request->password], true)) {
			if(!empty(Auth::User()->status))
			{
		        if(Auth::User()->is_admin =='1' || Auth::User()->is_admin =='2'){
		            return redirect()->intended('admin/dashboard');
		        } else if (Auth::User()->is_admin =='3'){
		            return redirect()->intended('school/dashboard');
		        } else if (Auth::User()->is_admin =='4'){
		          return redirect()->intended('teacher/dashboard');
		        }
			}
			else
			{
				$user_id = Auth::user()->id;
	            Auth::logout();
	            $user = User::find($user_id);

				$this->send_verification_mail($user);

				return redirect('login')->with('success', __("message.This email is not verified yet, please check your inbox to activate your account!"));
			}

        } else {
            return redirect()->back()->with('error', __("message.Please enter the correct credentials"));
        }

	}


	public function register_auth(Request $request) {
		
		$record = request()->validate([
			'username'			=> 'required|alpha_dash|unique:users',
			'email'				=> 'required',
			'type'				=> 'required',
			'password'			=> 'required_with:confirm_password|same:confirm_password',
			'CaptchaCode'   	=> 'required_with:current_captcha|same:current_captcha'
		]);

		if($request->type == 'teacher' || $request->type == 'school') {
			$is_admin = ($request->type == 'school') ? 3 : 4;

			$user				= new UsersModel;
			if($is_admin == 4)
			{
				$user->teacher_id = UsersModel::getTeacherID();
			}
			$user->username   = trim($request->username);
			$user->email		= trim($request->email);
			$user->password   = Hash::make($request->password);
			$user->timezone   = UsersModel::timezone();
			$user->remember_token = Str::random(50);
			$user->is_admin   = $is_admin;
			$user->created_date = time();
      		$user->save();

      		if($is_admin == 3)
			{
				$update = UsersModel::get_single($user->id);
				$update->school_id = $user->id.date('Ymd');
				$update->save();
			}

      		$this->updateToken($user->id);

      		$this->send_verification_mail($user);

			return redirect('login')->with('success', __("message.This email is not verified yet, please check your inbox to activate your account!"));
		}
		else
		{
			return redirect()->back()->with('error', __("message.Due to some error please try again."));
		}
	}




    public function send_verification_mail($user) {      
        Mail::to($user->email)->send(new RegisterMail($user));
    }


    public function forgot_auth(Request $request)
    {
	      $user = User::where('username','=',$request->username)->first();
	      if (empty($user)) {
	          return redirect()->back()->with(['error' => __("message.Username not found in the system.")]);
	      }

	      $user->remember_token = Str::random(50);
	      $user->save();
	      Mail::to($user->email)->send(new ForgotPasswordMail($user));
	      return redirect()->back()->with('success', __("message.Password has been reset. and sent to you mailbox"));
    }

  // Forgot Passoword end

    // Username Passoword 
    

    public function forgot_username_auth(Request $request)
    {
	      $user = User::where('email','=',$request->email)->first();
	      if (empty($user)) {
	          return redirect()->back()->with(['error' => __("message.Email not found in the system.")]);
	      }

	      $user->remember_token = Str::random(50);
	      $user->save();

	      Mail::to($user->email)->send(new ForgotUsernameMail($user));
	      return redirect('login')->with('success', __("message.Username has been sent please check your mailbox"));
    }


    // End Username Passoword 


    public function reset($token,Request $request)
    {
        $data['meta_title'] = 'Reset Password';
        $user = User::where('remember_token', '=', $token);
        if ($user->count() == 0) {
          abort(403);
        }
        $user = $user->first();
        
        $data['token'] = $token;
        return view('auth.reset', $data);
   }


   public function reset_auth($token,ResetPassword $request)
   {
        $user = User::where('remember_token', '=', $token);
        if ($user->count() == 0) {
          abort(403);
        }

        $user = $user->first();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('login')->with('success', __("message.Password has been reset."));
   }

    public function updateToken($user_id) {
	    $randomStr       = Str::random(40).$user_id;
	    $save_token      = UsersModel::find($user_id);
	    $save_token->token = $randomStr;
	    $save_token->save();
    }



    public function activate($token)
    {
        $user = User::where('remember_token', '=', $token);
        if ($user->count() == '0') {
          abort(403);
        }


        $user = $user->first();
        $user->status = 1;
        $user->is_delete = 0;
        $user->save();

        if (Auth::loginUsingId($user->id)) {
            if(Auth::User()->is_admin =='1' || Auth::User()->is_admin =='2'){
	            return redirect()->intended('admin/dashboard')->with('success', __("message.Thank you. your account has been verified."));
	        } else if (Auth::User()->is_admin =='3'){
	            return redirect()->intended('school/dashboard')->with('success', __("message.Thank you. your account has been verified."));
	        } else if (Auth::User()->is_admin =='4'){
	          return redirect()->intended('teacher/dashboard')->with('success', __("message.Thank you. your account has been verified."));
	        }
        }
        else
        {
        	 abort(403);
        }

        // return redirect('login')->with('success', 'Thank you. your account has been verified.');
    }


    public function logout()
    {
	    Auth::logout();
	    return redirect(url('login'));
    }



}

?>
