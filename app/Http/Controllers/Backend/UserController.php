<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UsersModel;
use App\Models\GeneralLocation;
use App\Models\VisaType;
use App\Models\Welfare;
use App\Models\WorkingSchedule;
use App\Models\NationalityModel;
use App\Models\StateModel;
use App\Models\CityModel;
use App\Models\CityLineModel;
use App\Models\NativeEnglishModel;
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
use App\Models\CardColourModel;
use App\Models\TeacherTypeModel;
use App\Models\ColourModel;
use App\Models\EmergencyLevelModel;
use App\Models\ClassSizeModel;
use App\Models\VisaQualificationModel;
use App\Models\CountryModel;
use App\Models\Job;
use App\Models\JobSchoolEnvironment;
use App\Models\JobTeacherAccommodation;
use App\Models\JobWelfare;
use App\Models\CreditLevelModel;
use App\Models\InstantMessengerModel;
use App\Models\UserInstantMessengerModel;
use App\Models\RecommendedTeachersModel;


use App\Models\PermissionModel;
use App\Models\AdminPermissionModel;
use App\Models\UserProfileViewModel;
use App\Models\GenderModel;

use App\Models\VisaModel;
use App\Models\VisaStatusModel;
use App\Models\UserVisaModel;
use App\Models\VisaInformationModel;
use App\Models\OfferContractModel;
use App\Models\PrivateChatModel;
use App\Models\ChatModel;
use App\Models\UserRegisterModel;




use App\Models\UserVideoModel;

use App\Notifications\AdminSendVisaUserNotification;


use App\Notifications\TeacherRecommendNotification;
use App\Notifications\SchoolRecommendNotification;



use Hash;
use File;
use Image;
use Str;
use Auth;

class UserController extends Controller
{

    public function check_user_name(Request $request)
    {
        if(!empty($request->user_id)) {
           $count =  UsersModel::where('id','!=',$request->user_id)->where('username','=',$request->username)->count();

        }
        else {
            $count =  UsersModel::where('username','=',$request->username)->count();
        }

        if($count == 0)
        {
            $json['success'] = true;
        }
        else
        {
            $json['success'] = false;
        }

        echo json_encode($json);
    }


    // staff start
    public function staff() {

        
        $check_permission = AdminPermissionModel::getPermission('staff');
        if(empty($check_permission)) {
            return redirect('admin/dashboard');
        }

        $data['get_record'] = UsersModel::get_record_staff_pagi();

    	return view('backend.admin.staff.list',$data);
    }



    public function add_staff()
    {
        $check_permission = AdminPermissionModel::getPermission('staff');
        if(empty($check_permission)) {
            return redirect('admin/dashboard');
        }

    	return view('backend.admin.staff.add');
    }

    public function edit_staff($id)
    {
        $check_permission = AdminPermissionModel::getPermission('staff');
        if(empty($check_permission)) {
            return redirect('admin/dashboard');
        }
        
        $data['user'] = UsersModel::get_single_user($id);
        if(!empty($data['user']))
        {
            return view('backend.admin.staff.edit',$data);
        }
        else
        {
            return redirect('admin/staff');
        }        
    }


    public function insert_update_staff($id = '', Request $request)
    {
    	
        if(empty($id))
        {
            $record = request()->validate([
                'name'              => 'required|max:120',
                'username'          => 'required|alpha_dash|unique:users',
                'email'             => 'required',
                'password'          => 'required|password',
            ]);    
        }

        if(!empty($id))
        {
            $record = UsersModel::find($id);

            if (!empty($request->file('profile_pic'))) {

                if(!empty($record->profile_pic) && file_exists('upload/profile/'.$record->profile_pic))
                {
                    unlink('upload/profile/'.$record->profile_pic);
                }

                $ext = 'jpg';
                $file = $request->file('profile_pic');
                $randomStr = Str::random(50);
                $filename = strtolower($randomStr) . '.' . $ext;
                $file->move('upload/profile/', $filename);

                $record->profile_pic = $filename;
             
                $thumb_img = Image::make('upload/profile/'.$filename)->resize(400, 400);
                $thumb_img->save('upload/profile/' . $filename, 100);
            }

            if(!empty($request->password))
            {
                $record->password   = Hash::make($request->password);
            }
        }
        else
        {
            $record = new UsersModel;  

            if (!empty($request->file('profile_pic'))) {

                $ext = 'jpg';
                $file = $request->file('profile_pic');
                $randomStr = Str::random(50);
                $filename = strtolower($randomStr) . '.' . $ext;
                $file->move('upload/profile/', $filename);

                $record->profile_pic = $filename;
                $record->status      = 1;

                $thumb_img = Image::make('upload/profile/'.$filename)->resize(400, 400);
                $thumb_img->save('upload/profile/' . $filename, 100);
            }

            $record->username   = trim($request->username);
            $record->remember_token = Str::random(50);
            $record->token        = Str::random(40);
            $record->timezone   = UsersModel::timezone();
            $record->password   = Hash::make($request->password);

        }

		
        $record->name       = trim($request->name);
        $record->last_name  = trim($request->last_name);
        $record->email      = trim($request->email);
        $record->is_admin      = trim($request->is_admin);
        $record->save();
        return redirect('admin/staff')->with('success', __("message.User successfully save."));

    }

    public function staff_delete($user_id) {

        $record             = UsersModel::get_single($id);
        $record->is_delete  = 1;
        $record->save();
        
        return redirect()->back()->with('success', __("message.Record successfully deleted"));
        
    }

    public function user_permission(Request $request)
    {
        $user_id = $request->user_id;
        $permission = PermissionModel::getpermission();
        return response()->json([
            "status" => true,
            "success" => view('backend.admin.staff._permission', [
                "permission" => $permission,
                "user_id" => $user_id
            ])->render(),
        ], 200);
    }

    public function save_permission(Request $request)
    {
        $staff_id = $request->user_id;
        
        AdminPermissionModel::delete_user($staff_id);
        if(!empty($request->permission_id))
        {
            foreach($request->permission_id as $permission_id)
            {
                $permission = new AdminPermissionModel;
                $permission->permission_id  = $permission_id;
                $permission->staff_id       = $staff_id;
                $permission->save();
            }
        }

        $json['success'] = true;
        echo json_encode($json);

    }

    // end staff


      // Visa Part

    public function user_visa($id) {

        $user = UsersModel::get_single($id);
        if(!empty($user)) {

            $data['get_contract_school'] = OfferContractModel::visa_contract_school($id);
            $data['get_contract_teacher'] = OfferContractModel::visa_contract_teacher($id);
            

            $data['user'] = $user;
            $data['get_teacher_record'] = VisaModel::get_teacher_record($id);
            $data['visa']           = VisaModel::get_record(); 
            $data['get_status']     = VisaStatusModel::get_record(); 
            $data['get_user_visa']  = UserVisaModel::get_user_visa($id); 
            return view('backend.admin.common.visa.list',$data);
        }
        else
        {
            return redirect('admin/dashboard');
        }
    }

    public function user_visa_add($id)
    {   
        $user = UsersModel::get_single($id);
        if(!empty($user)) {
            $data['user'] = $user;

            return view('backend.admin.common.visa.add',$data);  
        }
        else {
            return redirect('admin/dashboard');
        }
    }

    public function user_visa_edit($id)
    {   
        $record = VisaModel::get_single($id);
        $user = UsersModel::get_single($record->user_id);

        $data['record'] = $record;
        $data['user']   = $user;

        return view('backend.admin.common.visa.edit',$data);  
    }

    


    public function insert_user_visa($user_id, Request $request)
    {
        if(!empty($request->id))
        {
            $record = VisaModel::get_single($request->id);
        }
        else
        {
            $record          = new VisaModel;    
            $record->user_id = trim($user_id);
        }

       
        $record->name       = trim($request->name);
        $record->ch_name    = trim($request->ch_name);
        $record->save();

        VisaInformationModel::delete_record($record->id);

        // dd($request->rule);

        if(!empty($request->rule)) {

            foreach ($request->rule as $key => $rule) {
                if(!empty($rule)) {

                    $info           = new VisaInformationModel;
                    $info->visa_id  = $record->id;
                    $info->name     = $rule;
                    $info->ch_name  = !empty($request->ch_rule[$key]) ? $request->ch_rule[$key] : '';
                    $info->save();

                }
            }
        }

        return redirect('admin/user/visa/'.$record->user_id)->with('success', __("message.Record successfully save"));

    }


    public function user_visa_delete($id)
    {
        $record             = VisaModel::get_single($id);
        $record->is_delete  = 1;
        $record->save();
        
        return redirect('admin/user/visa/'.$record->user_id)->with('success', __("message.Record successfully deleted"));
    }

    public function user_visa_reject(Request $request)
    {
        $visa          = UserVisaModel::get_single($request->visa_id);
        $visa->status  = 3;
        $visa->reason  = $request->reason;
        $visa->save();


        $subject = "Admin has been ".$visa->getstatus->name." your Visa";
        $user = UsersModel::get_single($visa->user_id);
        $user->notify(new AdminSendVisaUserNotification($subject,$visa));  
        
        return redirect()->back()->with('success', __("message.Status successfully change"));   
    }

    public function change_visa_status(Request $request)
    {
        $visa           = UserVisaModel::get_single($request->id);
        $visa->status   = $request->status;
        $visa->save();

        $subject = "Admin has been ".$visa->getstatus->name." your Visa";

        $user = UsersModel::get_single($visa->user_id);

        $user->notify(new AdminSendVisaUserNotification($subject,$visa));  

        $json['success'] = __("message.Status successfully change");
        echo json_encode($json);
    }


    public function user_visa_assign(Request $request)
    {
        $visa = UserVisaModel::get_single($request->id); 
        $visa->user_assign_id = $request->user_id;
        $visa->save();

        $user_visa = UsersModel::get_single($visa->user_id);   

        if($user_visa->is_admin == 3)
        {
            $subject = "School (".$user_visa->school_id.") send visa document";
        }
        else
        {
            $subject = "".$user_visa->name."(".$user_visa->teacher_id.") send visa document";
        }

        if(!empty($visa->user_assign_id))
        {
            $user = UsersModel::get_single($visa->user_assign_id);    
            $user->notify(new AdminSendVisaUserNotification($subject,$visa));  
        }
        
        $json['success'] = __("message.User successfully assign");
        echo json_encode($json);
    }



     // End  Visa Part


    public function teacher(Request $request)
    {

        $check_permission = AdminPermissionModel::getPermission('teacher');
        if(empty($check_permission)) {
            return redirect('admin/dashboard');
        }


        $data['teachers'] = UsersModel::getTeacher($request);

       if($request->ajax()) {

            $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

            if($request->type == 'card')
            {
                $name = 'backend.admin.teacher._list_card';
            }
            else
            {
                $name = 'backend.admin.teacher._list';     
            }



            return response()->json([
                "status"    => true,
                "url"       => $actual_link,
                "success"   => view($name, [
                    "teachers" => $data['teachers'],
                ])->render(),
            ], 200);

            
        }
        else
        {
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
            $data['get_visa_type']           = VisaType::all();
            $data['get_general_location']    = AreaModel::get_record();
            $data['get_working_schedule']    = WorkingSchedule::all();
            $data['get_welfare']             = Welfare::all();
            $data['get_record_staff']        = UsersModel::get_record_staff();
            $data['get_card_colour']         = CardColourModel::get_record();
            $data['get_teacher_type']        = TeacherTypeModel::get_record();
            $data['get_colour']              = ColourModel::get_record();
            $data['get_user_register']       = UserRegisterModel::get_record();
            
            

        	return view('backend.admin.teacher.list',$data);

         }
    }

    public function teacher_profile_view(Request $request)
    {
        $user = UsersModel::get_single($request->user_id);
        if(!empty($user))
        {
            if($request->ajax()) {
                $user_id = $request->user_id;

                $perpage = $request->pagination['perpage'];
                $page = $request->pagination['page'];
                $offset = ($page - 1) * $perpage;

                $get_record_count = UserProfileViewModel::get_record_count($user_id);
                $lastPage = ceil($get_record_count / $perpage);

                $get_area = UserProfileViewModel::get_record_pagi($offset, $perpage,$user_id);
                $result = array();
                foreach ($get_area as $key => $value) {
                    $data['id'] = $value->id;
                    $data['school_name'] = !empty($value->school) ? $value->school->school_name : '';
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
                $data['user'] = $user;
                return view('backend.admin.teacher.profile_view_list',$data);        
            }
            
        }
        else
        {
            return redirect('admin/teacher');
        }        
    }



    public function add_teacher()
    {
        $check_permission = AdminPermissionModel::getPermission('teacher');
        if(empty($check_permission)) {
            return redirect('admin/dashboard');
        }

        $data['getTeacherID']           = UsersModel::getTeacherID();
        $data['get_gender']             = GenderModel::get_record();
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
        $data['get_general_location']   = AreaModel::get_record();
        $data['get_working_schedule']   = WorkingSchedule::get_record();
        $data['get_welfare']            = Welfare::get_record();
        $data['get_card_colour']        = CardColourModel::get_record();
        $data['get_record_staff']       = UsersModel::get_record_staff();
        $data['get_teacher_type']       = TeacherTypeModel::get_record();
        $data['get_colour']             = ColourModel::get_record();
        $data['get_country']            = CountryModel::get_record();
        $data['get_instant_messenger']  = InstantMessengerModel::get_record();
        

    	return view('backend.admin.teacher.add',  $data);
    }

    public function edit_teacher($id)
    {
        $check_permission = AdminPermissionModel::getPermission('teacher');
        if(empty($check_permission)) {
            return redirect('admin/dashboard');
        }
        $data['get_gender']             = GenderModel::get_record();
        $data['user']                   = UsersModel::get_single($id);    
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
        $data['get_general_location']   = AreaModel::get_record();
        $data['get_working_schedule']   = WorkingSchedule::get_record();
        $data['get_welfare']            = Welfare::get_record();
        $data['get_card_colour']        = CardColourModel::get_record();
        $data['get_record_staff']       = UsersModel::get_record_staff();
        $data['get_teacher_type']       = TeacherTypeModel::get_record();
        $data['get_colour']             = ColourModel::get_record();
        $data['get_country']            = CountryModel::get_record();
        $data['get_instant_messenger']  = InstantMessengerModel::get_record();
        

        return view('backend.admin.teacher.edit',  $data);
    }


    

    public function insert_update_teacher($id = '',Request $request)
    {
        $page = !empty($request->page) ? $request->page : '';

        if(empty($id))
        {
        	$record = request()->validate([
    			'name'				=> 'required|max:120',
    			'username'			=> 'required|alpha_dash|unique:users',
    			'password'			=> 'required|password',
    		]);
        }
        else
        {
            $record = request()->validate([
                'name'              => 'required|max:120',
                'username'          => 'required|alpha_dash||unique:users,username,' . $id,
            ]);
        }

        if(!empty($id))
        {
            $user = UsersModel::get_single($id);    
        }
        else
        {
            $user = new UsersModel;   
            
            $user->teacher_id           = $request->teacher_id;
            $user->timezone             = UsersModel::timezone();
            $user->remember_token       = Str::random(50);
            $user->is_admin             = 4; 
            $user->token                = Str::random(40);
        }
        
        $user->name         = trim($request->name);
        $user->username     = trim($request->username);   
        $user->email        = trim($request->email);
        $user->country_id   = trim($request->country_id);
        $user->phone_number = trim($request->phone_number);
        if(!empty($request->password)){
            $user->password     = Hash::make($request->password);
        }

        $user->last_name            = $request->last_name;
        $user->gender_id            = $request->gender_id;
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
        $user->teacher_type_id      = $request->teacher_type_id;
        $user->color_id             = $request->color_id;
        $user->card_colour_id       = $request->card_colour_id;
        $user->status               = $request->status;
        $user->staff_id             = $request->staff_id;
        $user->verify               = $request->verify;
        $user->others               = $request->others;
        $user->note                 = $request->note;
        
        

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

        
        if(!empty($request->file('staff_cv_upload'))) {

            if(!empty($user->staff_cv_upload) && file_exists('upload/profile/'.$user->staff_cv_upload)) {
                unlink('upload/profile/'.$user->staff_cv_upload);
            }

           $ext           = $request->file('staff_cv_upload')->extension();
           $file          = $request->file('staff_cv_upload');
           $randomStr     = date('YmdHis').Str::random(30);
           $filename      = strtolower($randomStr) . '.' . $ext;
           $file->move('upload/profile/', $filename);
           $user->staff_cv_upload = $filename;

        }

        $user->save();


        if(!empty($request->file('multi_user_video')))
        {
            foreach($request->file('multi_user_video') as $multi_user_video)
            {
             
                if(!empty($multi_user_video))   
                {
                    $video          = new UserVideoModel;
                    $video->user_id = $user->id;

                    $ext            = $multi_user_video->extension();
                    $file           = $multi_user_video;
                    $randomStr      = date('YmdHis').Str::random(30);
                    $filename       = strtolower($randomStr) . '.' . $ext;
                    $file->move('upload/profile/', $filename); 

                    $video->name = $filename;
                    $video->save();
                }

            }
        }


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

        if(!empty($request->instant_messenger_id)) {

            foreach ($request->instant_messenger_id as $key => $instant_messenger_id) {

                if (!empty($instant_messenger_id) && !empty($request->instant_messenger_name[$key])) {
                    $messenger          = new UserInstantMessengerModel;
                    $messenger->user_id = $user->id;
                    $messenger->instant_messenger_id = $instant_messenger_id;
                    $messenger->name    = $request->instant_messenger_name[$key];
                    $messenger->save();
                }
            }
            
        }


        return redirect('admin/teacher?page='.$page)->with('success', __("message.Teacher successfully save."));

    }

    public function delete_teacher($id) {

        $user = UsersModel::get_single($id);    
        $user->is_delete = 1;
        $user->save();
        
        return redirect('admin/teacher')->with('success', __("message.Teacher deleted successfully"));        
    }

    public function video_delete($id)
    {
        $video = UserVideoModel::get_single($id);

        if(!empty($video->name) && file_exists('upload/profile/'.$video->name)) {
            unlink('upload/profile/'.$video->name);
        }

        $video ->delete();

        return redirect()->back()->with('success', __("Video deleted successfully"));           
    }

    
   public function match_status_teacher(Request $request) {

        $user = UsersModel::get_single($request->id);    
        if($request->column == 'verify')
        {
            $user->verify = $request->status;
        }
        else if($request->column == 'status')
        {
            $user->status = $request->status;
        }
        
        $user->save();
            
        $json['success'] = __("message.Status successfully updated");
        echo json_encode($json);
    }


    public function note_update(Request $request) {

        $user = UsersModel::get_single($request->id);    
        $user->note = $request->note;
        $user->save();
            
        $json['success'] = __("message.Note successfully updated");
        $json['note']    = $request->note;
        $json['id']      = $request->id;

        echo json_encode($json);
    }


    
    


    // end teacher


    // start job

    
    public function credit_level_update(request $request) {

        $job = Job::get_single_job($request->id);
        $job->credit_level_id = $request->value;
        $job->save();

        $json['success'] = "Credit Level Updated.";
        echo json_encode($json);
    }

    public function emergency_level_update(request $request) {

        $job = Job::get_single_job($request->id);
        $job->emergency_level_id = $request->value;
        $job->save();

        $json['success'] = __("message.Emergency Level Updated");
        echo json_encode($json);

    }


    public function job_teacher_recommend(Request $request)
    {       

        $user = UsersModel::get_single($request->user_id);
        $job  = Job::get_single_job($request->job_id);
    
        $message = "School(ID ".$job->user->school_id.") matched your requirements. Please click the notification to apply the position or send message to this school.";

        $user->notify(new TeacherRecommendNotification('job',$message,$job,$user));  

        $json['success'] = __("message.Job Successfully Recommend");

        echo json_encode($json);
    }


    public function teacher_school_recommend(Request $request)
    {   

        RecommendedTeachersModel::recommend_teacher_school($request->teacher_id, $request->school_id);

        $school     = UsersModel::get_single($request->school_id);    
        $teacher    = UsersModel::get_single($request->teacher_id);
        
        $message = "Teacher(ID ".$teacher->teacher_id.") matched your requirements. Please click the notification to apply the teacher or send message to this teacher.";

        $school->notify(new SchoolRecommendNotification('teacher',$message,$school,$teacher));  

        $json['success'] = __("message.Teacher Successfully Recommend");

        echo json_encode($json);
    }






    public function job(Request $request)
    {   
        $check_permission = AdminPermissionModel::getPermission('jobs');
        if(empty($check_permission)) {
            return redirect('admin/dashboard');
        }

        $data['get_job']                = Job::get_job($request);		
        $data['get_credit_level']       = CreditLevelModel::get_record();    
        $data['get_emergency_level']    = EmergencyLevelModel::get_record();
        $data['get_state']              = StateModel::get_state_country(44);

        if($request->ajax()){



            $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            if($request->type == 'card')
            {
                $name = 'backend.admin.school.job._list_card';
            }
            else
            {
                $name = 'backend.admin.school.job._list';     
            }
            
           return response()->json([
                "status" => true,
                "url" => $actual_link,
                "success" => view($name, [
                    "get_job" => $data['get_job'],
                    "get_credit_level" => $data['get_credit_level'],
                    "get_emergency_level" => $data['get_emergency_level'],
                    "get_state" => $data['get_state'],
                ])->render(),
            ], 200);

            
        }
        else {

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
        $data['get_city']               = CityModel::get_record();
        $data['get_city_line']          = CityLineModel::get_record();
        $data['get_class_size']         = ClassSizeModel::get_record();
        $data['get_visa_qualification'] = VisaQualificationModel::get_record();
        
        $data['get_native_english']     = NativeEnglishModel::get_record();
        $data['get_current_visa_type']  = CurrentVisaTypeModel::get_record();
        $data['get_visa_type']          = VisaType::get_record();
        $data['get_general_location']   = AreaModel::get_record();
        $data['get_working_schedule']   = WorkingSchedule::get_record();
        $data['get_welfare']            = Welfare::get_record();
        $data['get_record_staff']       = UsersModel::get_record_staff();
        $data['get_card_colour']        = CardColourModel::get_record();
        $data['get_teacher_type']       = TeacherTypeModel::get_record();
        $data['get_colour']             = ColourModel::get_record();


            return view('backend.admin.school.job.list',$data);    
        }    
    }



    public function add_job()
    {
        $check_permission = AdminPermissionModel::getPermission('jobs');
        if(empty($check_permission)) {
            return redirect('admin/dashboard');
        }

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
        $data['get_general_location']   = AreaModel::get_record();
        $data['get_working_schedule']   = WorkingSchedule::get_record();
        $data['get_welfare']            = Welfare::get_record();
        $data['get_record_staff']       = UsersModel::get_record_staff();

    	return view('backend.admin.school.job.add',$data);
    }

    public function edit_job($id)
    {
        $check_permission = AdminPermissionModel::getPermission('jobs');
        if(empty($check_permission)) {
            return redirect('admin/dashboard');
        }


        $data['job']                    = Job::find($id);
        $data['user']                   = UsersModel::get_single($data['job']->user_id);
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
        $data['get_general_location']   = AreaModel::get_record();
        $data['get_working_schedule']   = WorkingSchedule::get_record();
        $data['get_welfare']            = Welfare::get_record();
        $data['get_record_staff']       = UsersModel::get_record_staff();

        return view('backend.admin.school.job.edit',$data);
    }


    


    public function insert_update_job($id = '', Request $request)
    {

        $page = !empty($request->page) ? $request->page : '';

        if(empty($id))
        {
            $record = request()->validate([
                'name'              => 'required|max:120',
                'username'          => 'required|alpha_dash|unique:users',
                'password'          => 'required|password',
            ]);    
        }
        else
        {
            $job  = Job::find($id);
            $user  = UsersModel::get_single($job->user_id);

            $record = request()->validate([
                'name'              => 'required|max:120',
                'username'          => 'required|alpha_dash||unique:users,username,' . $user->id,
            ]);
        }
    	

        if(!empty($id))
        {
            $job  = Job::find($id);
            $user  = UsersModel::get_single($job->user_id);
        }
        else
        {
           
            $user  = new UsersModel;
          
            $user->timezone             = UsersModel::timezone();
            $user->remember_token       = Str::random(50);
            $user->token                = Str::random(40);
            $user->is_admin             = 3;
            $job  = new Job;

        }


        if(!empty($request->password))
        {
            $user->password     = Hash::make($request->password);           
        }
        $user->username     = $request->username;
        $user->staff_id     = $request->staff_id;
        $user->name         = $request->name;
        $user->phone_number = $request->phone_number;
        $user->wechat_id    = $request->wechat_id;
        $user->school_name  = $request->school_name;
        $user->email        = $request->email;      
        $user->status       = 1;
        $user->save();


        if(empty($id))
        {
            $update = UsersModel::get_single($user->id);
            $update->school_id = $user->id.date('Ymd');
            $update->save();
        }
       
        $job->user_id = $user->id;
        $job->position_id = $request->position_id;
        $job->type_of_school_id = $request->type_of_school_id;
        $job->job_type_id = $request->job_type_id;
        $job->country_id = 44;
        $job->state_id = $request->state_id;
        $job->city_id = $request->city_id;
        $job->is_english_speaker = $request->is_english_speaker;

        $job->visa_type_id = $request->visa_type_id;
        $job->general_location_id = $request->general_location_id;
        $job->teacher_start_id = $request->teacher_start_id;
        $job->salary_minimum_id = $request->salary_minimum_id;
        $job->salary_maximum_id = $request->salary_maximum_id;

        $job->working_hours_per_week = $request->working_hours_per_week;
        $job->working_schedule_id = $request->working_schedule_id;
        $job->class_size = $request->class_size;
        $job->maximum_age = $request->maximum_age;
        $job->minimum_age = $request->minimum_age;
        $job->expiry_date = $request->expiry_date;
        $job->note      = $request->note;
        $job->save();
      


        $get_position = PositionModel::get_single($request->position_id);

        $title          = Job::slugify($get_position->name);
        $slug           = $title.'-'.$job->id;
        $job_update     = Job::find($job->id);
        $job_update->slug = $slug;
        $job_update->save();

        JobWelfare::delete_job($job->id);

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


        return redirect('admin/job?page='.$page)->with('success', __("message.Job successfully save"));

    }

    public function delete_job($id) {

        $job = Job::get_single_job($id);
        $job->is_delete = 1;
        $job->save();
        
        return redirect('admin/job')->with('success', __("message.Job deleted successfully"));        
    }



    public function match_status_job(Request $request) {

        $job = Job::get_single_job($request->id);
        $job->is_match = $request->status;
        $job->save();
        
        $json['success'] = __("message.Match Status successfully change");
        echo json_encode($json);
    }


    


}
