<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\GeneralLocation;
use App\Models\VisaType;
use App\Models\Welfare;
use App\Models\WorkingSchedule;
use Illuminate\Http\Request;
use App\Models\UsersModel;
use App\Models\NationalityModel;
use App\Models\StateModel;
use App\Models\CityModel;
use App\Models\SalaryModel;
use App\Models\CurrentLocationModel;
use App\Models\EducationLevelModel;
use App\Models\PositionModel;
use App\Models\JobTypeModel;
use App\Models\StartDateModel;
use App\Models\SchoolTypeModel;
use App\Models\AreaModel;
use App\Models\CurrentVisaTypeModel;
use App\Models\UserSchoolTypeModel;
use App\Models\UserLocationModel;
use App\Models\CountryModel;
use App\Models\UserEducation;
use App\Models\UserExperience;
use App\Models\InstantMessengerModel;
use App\Models\UserInstantMessengerModel;
use App\Models\UserProfileViewModel;
use App\Models\JobProfileViewModel;
use App\Models\GenderModel;
use App\Models\SaveTeacherModel;


use App\Models\UserVideoModel;
use App\Models\SaveJobModel;

use Hash;


use Image;
use Str;
use File;
use Auth;



class ProfileController extends Controller {

	public function profile() {

    	$data['user'] 			 	    = UsersModel::get_single(Auth::user()->id);
    	$data['get_nationality'] 		= NationalityModel::get_record();
    	$data['get_state']       		= StateModel::get_state_country(44);
    	$data['get_salary'] 			= SalaryModel::get_record();
    	$data['get_current_location'] 	= CurrentLocationModel::get_record();
    	$data['get_educaton_level'] 	= EducationLevelModel::get_record();
    	$data['get_position'] 			= PositionModel::get_record();
    	$data['get_job_type'] 			= JobTypeModel::get_record();
    	$data['get_start_date'] 		= StartDateModel::get_record();
    	$data['get_school_type'] 		= SchoolTypeModel::get_record();
    	$data['get_area'] 				= AreaModel::get_record();
    	$data['get_current_visa_type']  = CurrentVisaTypeModel::get_record();
    	$data['get_visa_type'] 			= VisaType::get_record();
    	$data['get_general_location'] 	= GeneralLocation::get_record();
    	$data['get_working_schedule']   = WorkingSchedule::get_record();
    	$data['get_welfare'] 			= Welfare::get_record();
    	$data['get_country'] 			= CountryModel::get_record();
    	$data['get_instant_messenger'] 	= InstantMessengerModel::get_record();
    	$data['get_gender'] 			= GenderModel::get_record();
    	

		if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
		{

		}
		else if(Auth::user()->is_admin == 3)
		{
			return view('backend.school.profile.profile',$data);
		}
		else if(Auth::user()->is_admin == 4)
		{
			return view('backend.teacher.profile.profile', $data);
		}
	}


	public function profile_view(Request $request)
	{
		if(Auth::user()->is_admin == 3)			
		{
			if($request->ajax()) {

				$user_id = Auth::user()->id;
                
                $perpage = $request->pagination['perpage'];
                $page = $request->pagination['page'];
                $offset = ($page - 1) * $perpage;

                $get_record_count = JobProfileViewModel::get_record_count($user_id);
                $lastPage = ceil($get_record_count / $perpage);

                $get_area = JobProfileViewModel::get_record_pagi($offset, $perpage,$user_id);
                $result = array();

                foreach ($get_area as $key => $value) {
                    $data['id'] 		= $value->id;
                    $data['name'] = !empty($value->teacher) ? $value->teacher->name : '';
                    $data['teacher_id'] = !empty($value->teacher) ? $value->teacher->teacher_id : '';
                    $result[] = $data;
                }

                $meta['page'] = $page;
                $meta['pages'] = $lastPage;
                $meta['perpage'] = $perpage;
                $meta['total'] = $get_record_count;
                $json['meta'] = $meta;
                $json['data'] = $result;

                echo json_encode($json);    
			}
			else {

				return view('backend.school.profile.list_profile_view');					

			}			
		}
		else if(Auth::user()->is_admin == 4)			
		{

			if($request->ajax()) {

				$user_id = Auth::user()->id;
                
                $perpage = $request->pagination['perpage'];
                $page = $request->pagination['page'];
                $offset = ($page - 1) * $perpage;

                $get_record_count = UserProfileViewModel::get_record_count($user_id);
                $lastPage = ceil($get_record_count / $perpage);

                $get_area = UserProfileViewModel::get_record_pagi($offset, $perpage,$user_id);
                $result = array();
                foreach ($get_area as $key => $value) {
                    $data['id'] 		= $value->id;
                    $data['school_id'] = !empty($value->school) ? $value->school->school_id : '';
                    $result[] = $data;
                }

                $meta['page'] = $page;
                $meta['pages'] = $lastPage;
                $meta['perpage'] = $perpage;
                $meta['total'] = $get_record_count;
                $json['meta'] = $meta;
                $json['data'] = $result;

                echo json_encode($json);                
            }
            else 
            {
            	return view('backend.teacher.profile.list_profile_view');	
            }
		}
	}

	public function update_profile(Request $request)
	{

		$user = UsersModel::get_single(Auth::user()->id);

		if(Auth::user()->is_admin == 3)
		{
			$user->name 			= $request->name;
			$user->email 			= $request->email;
			$user->phone_number 	= $request->phone_number;
			$user->wechat_id 		= $request->wechat_id;
			$user->school_name 		= $request->school_name;
			$user->save();
		}
		else
		{
			$user->name 				= $request->name;
			$user->last_name 			= $request->last_name;
			$user->current_location_id 	= $request->current_location_id;
			$user->nationality_id 		= $request->nationality_id;
			$user->area_id 				= $request->area_id;
			$user->age 					= $request->age;
			$user->experience 			= $request->experience;
			$user->is_native_english 	= $request->is_native_english;
			$user->educaton_level_id 	= $request->educaton_level_id;
			$user->is_graduated 		= $request->is_graduated;
			$user->is_education_english = $request->is_education_english;
			$user->is_native_english_speaking = $request->is_native_english_speaking;
			$user->bio 					= $request->bio;
			$user->position_id 			= $request->position_id;
			$user->job_type_id 			= $request->job_type_id;
			$user->start_date_id 		= $request->start_date_id;
			$user->current_visa_type_id = $request->current_visa_type_id;
			$user->minimum_salary_id 	= $request->minimum_salary_id;
			$user->maximum_salary_id 	= $request->maximum_salary_id;
			// $user->interview_time 		= $request->interview_time;
			$user->phone_number 		= $request->phone_number;
			$user->country_id 			= $request->country_id;
			$user->visa_id 				= $request->visa_id;
			$user->gender_id 			= $request->gender_id;
			
			
		    if (!empty($request->file('profile_pic'))) {

	            if(!empty($user->profile_pic) && file_exists('upload/profile/'.$user->profile_pic)) {
	                unlink('upload/profile/'.$user->profile_pic);
	            }

	            $ext = 'jpg';
	            $file = $request->file('profile_pic');
	            $randomStr = Str::random(30);
	            $filename = strtolower($randomStr) . '.' . $ext;
	            $file->move('upload/profile/', $filename);

	            $user->profile_pic = $filename;

	            $thumb_img = Image::make('upload/profile/'.$filename)->resize(400, 400);
	            $thumb_img->save('upload/profile/' . $filename, 100);
	        }


	        if(!empty($request->file('user_video'))) {

	        	if(!empty($user->user_video) && file_exists('upload/profile/'.$user->user_video)) {
	                unlink('upload/profile/'.$user->user_video);
	            }

	           $ext           = $request->file('user_video')->extension();
	           $file          = $request->file('user_video');
	           $randomStr     = date('YmdHis').Str::random(30);
	           $filename      = strtolower($randomStr) . '.' . $ext;
	           $file->move('upload/profile/', $filename);
	           $user->user_video = $filename;

	        }

	        if(!empty($request->file('cv_upload'))) {

	        	if(!empty($user->cv_upload) && file_exists('upload/profile/'.$user->cv_upload)) {
	                unlink('upload/profile/'.$user->cv_upload);
	            }

	           $ext           = $request->file('cv_upload')->extension();
	           $file          = $request->file('cv_upload');
	           $randomStr     = date('YmdHis').Str::random(30);
	           $filename      = strtolower($randomStr) . '.' . $ext;
	           $file->move('upload/profile/', $filename);
	           $user->cv_upload = $filename;

	        }

			$user->save();

			UserSchoolTypeModel::delete_user(Auth::user()->id);

			if(!empty($request->school_type))
			{
				foreach($request->school_type as $school_type_id)
				{
					$school = new UserSchoolTypeModel;
					$school->user_id = Auth::user()->id;
					$school->school_type_id = $school_type_id;
					$school->save();
				}
			}

			UserLocationModel::delete_user(Auth::user()->id);
			if(!empty($request->state_id))
			{
				foreach ($request->state_id as $key => $state_id) {
					if (!empty($state_id) && !empty($request->city_id[$key])) {
						$location = new UserLocationModel;
						$location->user_id = Auth::user()->id;
						$location->state_id = $state_id;
						$location->city_id = $request->city_id[$key];
						$location->save();
					}
				}
			}


			UserInstantMessengerModel::delete_user(Auth::user()->id);
			if(!empty($request->instant_messenger_id))
			{
				foreach ($request->instant_messenger_id as $key => $instant_messenger_id) {

					if (!empty($instant_messenger_id) && !empty($request->instant_messenger_name[$key])) {
						$messenger = new UserInstantMessengerModel;
						$messenger->user_id = Auth::user()->id;
						$messenger->instant_messenger_id = $instant_messenger_id;
						$messenger->name = $request->instant_messenger_name[$key];
						$messenger->save();
					}

				}
			}


			if(!empty($request->file('multi_user_video')))
	        {	
	            foreach($request->file('multi_user_video') as $multi_user_video) {

	                if(!empty($multi_user_video)) {

	                    $video          = new UserVideoModel;
	                    $video->user_id = $user->id;

	                    $ext            = $multi_user_video->extension();
	                    $file           = $multi_user_video;
	                    $randomStr      = date('YmdHis').Str::random(30);
	                    $filename       = strtolower($randomStr) . '.' . $ext;
	                    $file->move('upload/profile/', $filename); 

	                    $video->name 	= $filename;
	                    $video->save();

	                }
	            }
	        }			
		}
		
		return redirect()->back()->with('success', __("message.Profile successfully update"));
	}


    public function video_delete($id)
    {
        $video = UserVideoModel::get_single($id);

        if(!empty($video->name) && file_exists('upload/profile/'.$video->name)) {
            unlink('upload/profile/'.$video->name);
        }

        $video ->delete();

        return redirect()->back()->with('success', __("message.Video deleted successfully"));           
    }


	public function add_education(Request $request)
	{
		
		if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
		{
			if(!empty($request->id))
			{
				$save = UserEducation::find($request->id);
			}
			else
			{
				$save = new UserEducation;
				$save->user_id 	= $request->user_id;
			}
		}	
		else
		{
			if(!empty($request->id))
			{
				$save = UserEducation::where('user_id','=',Auth::user()->id)->where('id','=',$request->id)->first();
			}
			else
			{
				$save = new UserEducation;
				$save->user_id 	= Auth::user()->id;
			}
		}
		
		$save->start_date 	= $request->start_date;
		$save->end_date 	= $request->end_date;
		$save->school_name 	= $request->school_name;
		$save->country_id 	= $request->country_id;
		$save->major 		= $request->major;
		$save->degree 		= $request->degree;
		$save->save();

		return redirect()->back()->with('success', __("message.Information successfully save"));

	}

	public function edit_education(Request $request)
	{
		$education = UserEducation::find($request->id);
		$json['id'] = $education->id;
		$json['country_id'] = $education->country_id;
		$json['school_name'] = $education->school_name;
		$json['start_date'] = $education->start_date;
		$json['end_date'] = $education->end_date;
		$json['major'] = $education->major;
		$json['degree'] = $education->degree;
		echo json_encode($json);

	}

	public function delete_education($id, Request $request)
	{
		if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
		{
			UserEducation::where('id','=',$id)->delete();	
		}
		else
		{
			UserEducation::where('user_id','=',Auth::user()->id)->where('id','=',$id)->delete();
		}

		return redirect()->back()->with('success', __("message.Education successfully deleted"));
	}


	public function add_experience(Request $request)
	{
		if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
		{
			if(!empty($request->id))
			{
				$save = UserExperience::find($request->id);
			}
			else
			{
				$save = new UserExperience;
				$save->user_id 	= $request->user_id;
			}
		}
		else
		{
			if(!empty($request->id))
			{
				$save = UserExperience::where('user_id','=',Auth::user()->id)->where('id','=',$request->id)->first();
			}
			else
			{
				$save = new UserExperience;
				$save->user_id 	= Auth::user()->id;
			}
		}

		
		
		$save->start_date 	= $request->start_date;
		$save->end_date 	= $request->end_date;
		$save->company_name = $request->company_name;
		$save->position 	= $request->position;
		$save->title 		= $request->title;
		$save->duty 		= $request->duty;
		$save->save();

		return redirect()->back()->with('success', __("message.Information successfully save"));

	}

	public function delete_experience($id, Request $request)
	{
		if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
		{
			UserExperience::where('id','=',$id)->delete();
		}
		else
		{
			UserExperience::where('user_id','=',Auth::user()->id)->where('id','=',$id)->delete();	
		}
		
		return redirect()->back()->with('success', __("message.Experience successfully deleted"));
	}

	public function edit_experience(Request $request)
	{
		$experience = UserExperience::find($request->id);

		$json['id'] 		  = $experience->id;
		$json['start_date']   = $experience->start_date;
		$json['end_date'] 	  = $experience->end_date;
		$json['company_name'] = $experience->company_name;
		$json['position'] 	  = $experience->position;
		$json['duty'] 		  = $experience->duty;
		$json['title'] 		  = $experience->title;
		echo json_encode($json);

	}


	public function location_delete($id) {
		if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
		{
			UserLocationModel::where('id','=',$id)->delete();
		}
		else
		{
			UserLocationModel::where('id','=',$id)->where('user_id','=',Auth::user()->id)->delete();	
		}
		return redirect()->back()->with('success', __("message.Location successfully deleted"));
	}


	public function instant_messenger_delete($id) {

		if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2) {
			UserInstantMessengerModel::where('id','=',$id)->delete();
		}
		else {
			UserInstantMessengerModel::where('id','=',$id)->where('user_id','=',Auth::user()->id)->delete();	
		}

		return redirect()->back()->with('success', __("message.Instant Messenger successfully deleted"));

	}


	public function getStateCity(Request $request)
	{
		$getCity = CityModel::get_state_city($request->state_id);
		$html = '';
		$html .= '<option value="">Select</option>';
		foreach ($getCity as $key => $value) {
			$html .= '<option value="'.$value->id.'">'.$value->getName().'</option>';
		}

		$json['html'] = $html;
		echo json_encode($json);

	}




	public function change_password(){

    	$data['user'] = UsersModel::get_single(Auth::user()->id);
    	
		if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
		{
			return view('backend.admin.profile.change_password',$data);
		}
		else if(Auth::user()->is_admin == 3)
		{
			return view('backend.school.profile.change_password',$data);
		}
		else if(Auth::user()->is_admin == 4) 
		{
			return view('backend.teacher.profile.change_password', $data);
		}
	}

	public function update_password(Request $request)
	{
		$user = UsersModel::get_single(Auth::user()->id);
		if(trim($request->new_password) == trim($request->confirm_password))
        {
            if (Hash::check($request->old_password, $user->password)) {

                $user->password = Hash::make($request->new_password);
                $user->save();
                return redirect()->back()->with('success', __("message.Password successfully change."));

            }
            else
            {
                return redirect()->back()->with('error', __("message.Old password does not match."));
            }
        }
        else
        {
            return redirect()->back()->with('error', __("message.Confirm password does not updated."));
        }
	}



	// Save Job Teacher

	public function save_job_teacher(Request $request)
	{
		$job_id 	 = $request->job_id;
		$teacher_id  = Auth::user()->id;
		$json['success'] = SaveJobModel::save_job_teacher($job_id, $teacher_id);
		echo json_encode($json);
	}

	// Save Job School

	public function save_teacher_school(Request $request)
	{
		$teacher_id  = $request->teacher_id;
		$school_id 	 = Auth::user()->id;
		$json['success'] = SaveTeacherModel::save_teacher_school($teacher_id, $school_id);
		echo json_encode($json);
	}

	public function change_tutorial_status()
	{
		$tutorial_status = UsersModel::get_single(Auth::user()->id);
		if($tutorial_status->is_tutorial == 0)
		{
			$tutorial_status->is_tutorial = 1;
		}
		else
		{
			$tutorial_status->is_tutorial = 0;
		}
		$tutorial_status->save();

		$json['success'] = true;
		echo json_encode($json);
		
	}

	


	

}
