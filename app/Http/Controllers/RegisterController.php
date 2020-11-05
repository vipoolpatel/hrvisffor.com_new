<?php

namespace App\Http\Controllers;


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

use App\Models\Job;
use App\Models\JobSchoolEnvironment;
use App\Models\JobTeacherAccommodation;
use App\Models\JobWelfare;
use App\Models\GenderModel;
use App\Models\UserVideoModel;



use App\Mail\RegisterMail;
use Mail;

use Image;
use Str;
use File;
use Auth;
use Hash;



class RegisterController extends Controller
{

	public function teacher_register(Request $request) {

        

        $data['header_title']           = __('profile.Teacher Register Profile');
        $data['get_nationality']        = NationalityModel::get_record();
        $data['get_state']              = StateModel::get_state_country(44);
        $data['get_salary']             = SalaryModel::get_record();
        $data['get_current_location']   = CurrentLocationModel::get_record();
        $data['get_educaton_level']     = EducationLevelModel::get_record();
        $data['get_position']           = PositionModel::get_record();
        $data['get_job_type']           = JobTypeModel::get_record();
        $data['get_start_date']         = StartDateModel::get_record();
        $data['get_school_type']        = SchoolTypeModel::get_record();
        $data['get_area']               = AreaModel::get_record();
        $data['get_current_visa_type']  = CurrentVisaTypeModel::get_record();
        $data['get_visa_type']          = VisaType::all();
        $data['get_general_location']   = GeneralLocation::all();
        $data['get_working_schedule']   = WorkingSchedule::all();
        $data['get_welfare']            = Welfare::all();
        $data['get_country']            = CountryModel::all();
        $data['get_instant_messenger']  = InstantMessengerModel::get_record();
        $data['get_gender']             = GenderModel::get_record();

    	return view('frontend.teacher.public_register',$data);
	}


    public function insert_teacher_register(Request $request) {

        $user = request()->validate([
            'name'              => 'required|max:120',
            'username'          => 'required|alpha_dash|unique:users',
            'email'             => 'required',
            'password'          => 'required',
        ]);

        $user               = new UsersModel;
        $user->name         = trim($request->name);
        $user->username     = trim($request->username);
        $user->email        = trim($request->email);
        $user->country_id   = trim($request->country_id);
        $user->phone_number = trim($request->phone_number);
        $user->password     = Hash::make($request->password);
        $user->timezone             = UsersModel::timezone();
        $user->remember_token       = Str::random(50);
        $user->is_admin             = 4;
        $user->teacher_id           = UsersModel::getTeacherID();
        $user->created_date         = time();
        $user->last_name            = $request->last_name;
        $user->current_location_id  = $request->current_location_id;
        $user->nationality_id       = $request->nationality_id;
        $user->area_id              = $request->area_id;
        $user->age                  = $request->age;
        $user->experience           = $request->experience;
        $user->is_native_english    = $request->is_native_english;
        $user->educaton_level_id    = $request->educaton_level_id;
        $user->is_graduated         = $request->is_graduated;
        $user->is_education_english = $request->is_education_english;
        $user->is_native_english_speaking = $request->is_native_english_speaking;
        $user->bio                  = $request->bio;
        $user->position_id          = $request->position_id;
        $user->job_type_id          = $request->job_type_id;
        $user->start_date_id        = $request->start_date_id;
        $user->current_visa_type_id = $request->current_visa_type_id;
        $user->minimum_salary_id    = $request->minimum_salary_id;
        $user->maximum_salary_id    = $request->maximum_salary_id;
        // $user->interview_time       = $request->interview_time;
        $user->visa_id              = $request->visa_id;
        $user->gender_id            = $request->gender_id;
        
        

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


        UserSchoolTypeModel::delete_user($user->id);

        if(!empty($request->school_type))
        {
            foreach($request->school_type as $school_type_id)
            {
                $school = new UserSchoolTypeModel;
                $school->user_id        = $user->id;
                $school->school_type_id = $school_type_id;
                $school->save();
            }
        }

        UserLocationModel::delete_user($user->id);
        if(!empty($request->state_id))
        {
            foreach ($request->state_id as $key => $state_id) {
                if (!empty($state_id) && !empty($request->city_id[$key])) {

                    $location           = new UserLocationModel;
                    $location->user_id  = $user->id;
                    $location->state_id = $state_id;
                    $location->city_id  = $request->city_id[$key];
                    $location->save();
                }
            }
        }

        UserInstantMessengerModel::delete_user($user->id);
        if(!empty($request->instant_messenger_id))
        {
            foreach ($request->instant_messenger_id as $key => $instant_messenger_id) {
                if (!empty($instant_messenger_id) && !empty($request->instant_messenger_name[$key])) {
                    $messenger                       = new UserInstantMessengerModel;
                    $messenger->user_id              = $user->id;
                    $messenger->instant_messenger_id = $instant_messenger_id;
                    $messenger->name                 = $request->instant_messenger_name[$key];
                    $messenger->save();
                }
            }
        }


        if(!empty($request->file('multi_user_video'))) {   
            foreach($request->file('multi_user_video') as $multi_user_video) {
                if(!empty($multi_user_video)) {

                    $video          = new UserVideoModel;
                    $video->user_id = $user->id;

                    $ext            = $multi_user_video->extension();
                    $file           = $multi_user_video;
                    $randomStr      = date('YmdHis').Str::random(30);
                    $filename       = strtolower($randomStr) . '.' . $ext;
                    $file->move('upload/profile/', $filename); 

                    $video->name    = $filename;
                    $video->save();
                }
            }
        }       


        $this->updateToken($user->id);
        
        $this->send_verification_mail($user);

        return redirect('login')->with('success', __("message.This email is not verified yet, please check your inbox to activate your account!"));

    }



    public function school_register() {

        $data['header_title']           = __('position.School Register Profile');

        $data['get_nationality']        = NationalityModel::get_record();
        $data['get_state']              = StateModel::get_state_country(44);
        $data['get_salary']             = SalaryModel::get_record();
        $data['get_current_location']   = CurrentLocationModel::get_record();
        $data['get_educaton_level']     = EducationLevelModel::get_record();
        $data['get_position']           = PositionModel::get_record();
        $data['get_job_type']           = JobTypeModel::get_record();
        $data['get_start_date']         = StartDateModel::get_record();
        $data['get_school_type']        = SchoolTypeModel::get_record();
        $data['get_area']               = AreaModel::get_record();
        $data['get_current_visa_type']  = CurrentVisaTypeModel::get_record();
        $data['get_visa_type']          = VisaType::get_record();
        $data['get_general_location']   = GeneralLocation::get_record();
        $data['get_working_schedule']   = WorkingSchedule::get_record();
        $data['get_welfare']            = Welfare::get_record();
        $data['get_country']            = CountryModel::get_record();
        return view('frontend.school.public_register',$data);

    }



   public function insert_school_register(Request $request) {

        $user = request()->validate([
            'name'              => 'required|max:120',
            'username'          => 'required|alpha_dash|unique:users',
            'email'             => 'required',
            'password'          => 'required',
        ]);

        $user  = new UsersModel;
        $user->username     = $request->username;
        $user->password     = Hash::make($request->password);       
        $user->name         = $request->name;
        $user->phone_number = $request->phone_number;
        $user->wechat_id    = $request->wechat_id;
        $user->school_name  = $request->school_name;
        $user->email        = $request->email;
        $user->timezone             = UsersModel::timezone();
        $user->remember_token       = Str::random(50);
        $user->is_admin             = 3;
        $user->save();

        $update = UsersModel::get_single($user->id);
        $update->school_id = $user->id.date('Ymd');
        $update->save();



        $job = Job::create([
            'user_id'           =>  $user->id,
            'position_id'       =>  $request->position,
            'type_of_school_id' =>  $request->type_of_school,
            'job_type_id'       =>  $request->job_type,
            'country_id'        =>  44,
            'state_id'          =>  $request->state_id,
            'city_id'           =>  $request->city_id,
            'is_english_speaker'=>  $request->is_english_speaker,
            'visa_type_id'      =>  $request->visa_type_id,
            'general_location_id'=> $request->general_location,
            'teacher_start_id'  =>  $request->teacher_start,
            'salary_minimum_id' =>  $request->salary_minimum,
            'salary_maximum_id' =>  $request->salary_maximum,
            'working_hours_per_week'=>$request->working_hours_per_week,
            'working_schedule_id' => $request->working_schedule,
            'class_size'    =>  $request->class_size,
            'maximum_age'   =>  $request->minimum_age,
            'minimum_age'   =>  $request->maximum_age,
            'expiry_date'   => $request->expiry_date,
        ]);

        $get_position = PositionModel::get_single($request->position);

        $title          = Job::slugify($get_position->name);
        $slug           = $title.'-'.$job->id;
        $job_update     = Job::find($job->id);
        $job_update->slug = $slug;
        $job_update->save();

        if(!empty($request->welfare))
        {
            foreach ($request->welfare as $welfare_id) {
                if(!empty($welfare_id)) {
                    $welfare = JobWelfare::create([
                        'job_id'=>$job->id,
                        'welfare_id'=>$welfare_id
                    ]);
                }        
            }    
        }
        


        if(!empty($request->file('school_environment')))
        {
            $i = 0;
            $destinationPaths = 'upload/school/';
            foreach($request->file('school_environment') as $img) {

                $profileImage = $i.date('YmdHis').'.jpg';
                $img->move($destinationPaths, $profileImage);

                $imagemodel= new JobSchoolEnvironment();
                $imagemodel->job_id = $job->id;
                $imagemodel->image_name = $profileImage;
                $imagemodel->save();
                $i++;

            }
        }

        if(!empty($request->file('teachers_accommodation')))
        {
            $i = 100;
            $destinationPaths = 'upload/school/'; // upload path
            foreach($request->file('teachers_accommodation') as $imgs) {

                $profileImages = $i.date('YmdHis').'.jpg';
                $imgs->move($destinationPaths, $profileImages);
                
                $imagemodelda = new JobTeacherAccommodation();
                $imagemodelda->job_id = $job->id;
                $imagemodelda->image_name = $profileImages;
                $imagemodelda->save();
                $i++;

            }
        }


        $this->updateToken($user->id);
        
        $this->send_verification_mail($user);

        return redirect('login')->with('success', __("message.This email is not verified yet, please check your inbox to activate your account!"));

    }










     public function updateToken($user_id) {
          $randomStr       = Str::random(40).$user_id;
          $save_token      = UsersModel::find($user_id);
          $save_token->token = $randomStr;
          $save_token->save();
    }


    public function send_verification_mail($user) {      
        Mail::to($user->email)->send(new RegisterMail($user));
    }


}

?>
