<?php

namespace App\Http\Controllers;

use App\Models\Job;
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
use App\Models\JobSchoolEnvironment;
use App\Models\JobTeacherAccommodation;
use App\Models\JobWelfare;
use App\Models\CreditLevelModel;


use App\Models\LivingCostModel;
use App\Models\ClimateModel;

use App\Models\FaqModel;
use App\Models\FaqCategoryModel;
use App\Models\UserProfileViewModel;
use App\Models\JobProfileViewModel;
use App\Models\RecommendedTeachersModel;





use Illuminate\Http\Request;
use App\Models\ContactUsModel;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUsMail;
use Auth;
use Str;
use Session;

class HomeController extends Controller
{
	public function home(Request $request)
  	{
        $data['get_faq_category'] = FaqCategoryModel::get_record();
    	return view('home',$data);
	}

	public function contact_us(Request $request) {
      	return view('page.contact_us');
	}


	public function contact_insert(Request $request)
	{
		$this->validate($request, [
			'full_name'		=> 'required|max:120',
			'email'			=> 'required',
			'CaptchaCode'   => 'required_with:current_captcha|same:current_captcha'
		]);

		$record 				= new ContactUsModel;
		$record->full_name		= trim($request->full_name);
		$record->email			= trim($request->email);
		$record->phone			= trim($request->phone);
		$record->subject		= trim($request->subject);
		$record->message		= trim($request->message);
		$record->save();

		Mail::to('eduvisffor@gmail.com')->send(new ContactUsMail($record));

		return redirect()->back()->with('success', __("message.Thank you! Your information successfully sent."));
	}


	public function faq()
	{
		return view('page.faq');
	}

    /**
     * Teacher Profile
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function teacherProfile($slug,$job_slug = ''){

  	    $teacher = UsersModel::get_single_username($slug);
        if(!empty($teacher))
        {
            
            $profile                = new UserProfileViewModel;
            $profile->teacher_id    = $teacher->id;

            if(Auth::check())
            {   
                if(Auth::user()->is_admin == 3)
                {
                    $profile->school_id = Auth::user()->id;    
                }                
            }
            
            $profile->save();
    
            return view('frontend.teacher.teacher_details',['teacher'=>$teacher,'job_slug' => $job_slug]);    
        }
        else
        {
            return redirect(url(''));
        }

	    
    }

    public function schoolProfile($slug) {
        $job = Job::get_single_slug($slug);
        if(!empty($job))
        {
            $data['get_living_cost'] = LivingCostModel::get_record();
            $data['get_climate']     = ClimateModel::get_record();

            $data['job'] = $job;

            
                    $profile                = new JobProfileViewModel;
                    
                    if(Auth::check())
                    {
                        if(Auth::user()->is_admin == 4)
                        {
                            $profile->teacher_id    = Auth::user()->id;
                        }
                    }

                    $profile->job_id        = $job->id;
                    $profile->save();
                

            return view('frontend.school.profile',$data);    
        }
        else
        {
            return redirect(url(''));
        }    
    }

    public function matchedPosition($slug = '', Request $request) {

        $query = Job::select('jobs.*');
        $query =  $query->join('users','users.id','=','jobs.user_id');

        if(Auth::user()->is_admin == 4 || Auth::user()->is_admin == 3) {
            $getuser = UsersModel::get_single(Auth::user()->id);
        }
        else {
            $getuser = UsersModel::get_single_username($slug);    
        }

        if(!empty($getuser)) {
            if(!empty($getuser->visa_id) && $getuser->visa_id != 1) {
                $query->where('jobs.visa_type_id','=',$getuser->visa_id);
            }

            // $state = !empty($getuser->state_id)?$getuser->state->name:'';
            // if($state=='All' || $state=='All States' || empty($state))
            // {

            // }
            // else
            // {
            //     $query->where('jobs.state_id','=',$getuser->state_id);
            // }

            // $city = (!empty($getuser->city_id))?$getuser->city->city:'';

            // if($city=='All' || $city =='All Cities' || empty($city)){

            // }   
            // else
            // {
            //     $query->where('jobs.city_id','=',$getuser->city_id);
            // }

            // if($getuser->is_native_english =='Yes' && $getuser->educaton_level_id != 4) {
            //     $query->where('jobs.visa_type_id','=',1);
            // }
            // else {
            //     $query->where('jobs.visa_type_id','=',2);
            // }


            $state_name = array();
            $city_name  = array();
            foreach($getuser->get_location as $location) {
                $state_name[] = $location->state->name;
                $city_name[] = $location->city->name;
            }

            $state = array();
            $city  = array();

            foreach($getuser->get_location as $location) {
                $state[] = $location->state_id;
                $city[] = $location->city_id;
            }


            if(!in_array('All', $state_name)) {
                if(!empty($state)) {
                    $query->whereIn('jobs.state_id',$state);   
                } 
            }


            if(!in_array('All', $city_name)) {
                if(!empty($city)) {
                    $query->whereIn('jobs.city_id',$city);    
                }
            }

            if(empty($state_name) && empty($city_name)) {
                if($getuser->area_id != 3) {
                     $query->where('jobs.general_location_id','=',$getuser->area_id);
                }     
            }

           
            //$query->where('jobs.r_position_looking_id','=',$getuser->r_position_looking_id);
            //$query->where('jobs.r_work_type_id','=',$getuser->r_work_type_id);

            $type_of_school_id = array();

            foreach($getuser->get_school_type as $school_id) {
                $type_of_school_id[] = $school_id->school_type_id;
            }

            if(!in_array(5, $type_of_school_id)) {
                if(!empty($type_of_school_id)) {
                    $query->whereIn('jobs.type_of_school_id',$type_of_school_id);
                }
            }

        }

        if(!empty($request->school_id)) {
            $query = $query->where('users.school_id', '=', $request->school_id);                                   
        }
        if(!empty($request->school_name)) {
            $query = $query->where('users.school_name', 'like', '%' . $request->school_name . '%');                              
        }
        if(!empty($request->staff_id)) {
            $query = $query->where('users.staff_id','=',$request->staff_id);                      
        }
        if(!empty($request->type_of_school_id)) {
            $query = $query->where('jobs.type_of_school_id','=',$request->type_of_school_id);                      
        }
        if(!empty($request->credit_level_id)) {
            $query = $query->where('jobs.credit_level_id','=',$request->credit_level_id);                      
        }
        if(!empty($request->general_location_id)) {
            $query = $query->where('jobs.general_location_id','=',$request->general_location_id);                      
        }
        if(!empty($request->is_english_speaker)) {
            $query = $query->where('jobs.is_english_speaker','=',$request->is_english_speaker);                      
        }
        if(!empty($request->working_schedule_id)) {
            $query = $query->where('jobs.working_schedule_id','=',$request->working_schedule_id);                      
        }
        if(!empty($request->teacher_start_id)) {
            $query = $query->where('jobs.teacher_start_id','=',$request->teacher_start_id);                      
        }
        if(!empty($request->position_id)) {
            $query = $query->where('jobs.position_id','=',$request->position_id);                      
        }
        if(!empty($request->emergency_level_id)) {
            $query = $query->where('jobs.emergency_level_id','=',$request->emergency_level_id);                      
        }
        if(!empty($request->state_id)) {
            $query = $query->where('jobs.state_id','=',$request->state_id);                      
        }
        if(!empty($request->city_id)) {
            $query = $query->where('jobs.city_id','=',$request->city_id);                      
        }
        if(!empty($request->class_size)) {
            $query = $query->where('jobs.class_size','=',$request->class_size);                      
        }
        if(!empty($request->working_schedule_id)) {
            $query = $query->where('jobs.working_schedule_id','=',$request->working_schedule_id);                      
        }
        
        if(!empty($request->salary_minimum_id)) {
            $query = $query->where('jobs.salary_minimum_id','>=',$request->salary_minimum_id);                      
        }

        if(!empty($request->salary_maximum_id)) {
            $query = $query->where('jobs.salary_maximum_id','<=',$request->salary_maximum_id);                      
        }

        if(!empty($request->minimum_age)) {
            $query = $query->where('jobs.minimum_age','>=',$request->minimum_age);                      
        }

        if(!empty($request->maximum_age)) {
            $query = $query->where('jobs.maximum_age','<=',$request->maximum_age);                      
        }

        if(!empty($request->register_date)) {
            if($request->register_date == 'Latest') {
                $query = $query->orderBy('jobs.id', 'desc');
            }
            else {
                $query = $query->orderBy('jobs.id', 'asc');
            }
        }
        else {
            $query = $query->orderBy('jobs.id', 'DESC');
        }

        $query->groupBy('jobs.id');        
        $query = $query->paginate(10);
        $data['jobs'] = $query;


        $page_id = 0;
        if(!empty($query->nextPageUrl())) {
            $parse_url =parse_url($query->nextPageUrl()); 
            if(!empty($parse_url['query']))
            {
                 parse_str($parse_url['query'], $get_array);     
                 $page_id = !empty($get_array['page']) ? $get_array['page'] : 0;
            }
        }

        $data['page_id'] = intval($page_id);

        if($request->ajax()) {

            $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

            return response()->json([
                "status" => true,
                "url" => $actual_link,
                "success" => view('frontend.teacher._matched_position', [
                    "jobs" => $data['jobs'],
                    "page_id" => $page_id,
                ])->render(),
            ], 200);            
        }
        else
        {
            $data['getuser']                = $getuser;
            $data['slug']                   = $slug;
            $data['get_credit_level']       = CreditLevelModel::get_record();    
            $data['get_emergency_level']    = EmergencyLevelModel::get_record();
            $data['get_state']              = StateModel::get_state_country(44);
            $data['get_nationality']        = NationalityModel::get_record();
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
            $data['get_general_location']   = GeneralLocation::get_record();
            $data['get_working_schedule']   = WorkingSchedule::get_record();
            $data['get_welfare']            = Welfare::get_record();
            $data['get_record_staff']       = UsersModel::get_record_staff();
            $data['get_card_colour']        = CardColourModel::get_record();
            $data['get_teacher_type']       = TeacherTypeModel::get_record();
            $data['get_colour']             = ColourModel::get_record();

            return view('frontend.teacher.matched_position',$data);

        }
    }


    public function matchTeacher($slug = '', Request $request){


        
        $teachers = UsersModel::select('users.*')->where('is_admin','=','4');
        $teachers = $teachers->join('user_location','user_location.user_id','=','users.id','left');

        if(Auth::user()->is_admin == 4) {
            $teachers = $teachers->where('users.id','=',Auth::user()->id);
        }


        if(!empty($request->user_id))
        {
             $teachers = $teachers->where('users.id','=',$request->user_id);
        }
        else
        {
             $teachers = $teachers->where('users.verify','=',1);   
        }


        if(!empty($request->recommended))
        {
            $recommendedTeacherID = RecommendedTeachersModel::getTeacherID(Auth::user()->id);
            $teachers = $teachers->whereIn('users.id',$recommendedTeacherID);
        }


        $jobs = Job::get_single_slug($slug);

        if(!empty($jobs)) {

            if ($jobs->is_english_speaker == "Yes") {
                $teachers = $teachers->where('users.is_native_english', '=', $jobs->is_english_speaker);
            }

            $teachers = $teachers->where('users.position_id', '=', $jobs->position_id);
            $teachers = $teachers->where('users.job_type_id', '=', $jobs->job_type_id);

            if ($jobs->visa_type_id == 1) {
                $teachers = $teachers->where('users.visa_id','=',$jobs->visa_type_id);
            }

           
            if(!empty($jobs->type_of_school_id)) {
                $teachers = $teachers->join('user_school_type','users.id','=','user_school_type.user_id');
                $type_of_school_id = $jobs->type_of_school_id;
                $teachers = $teachers->where(function($q) use ($type_of_school_id) {
                    $q->where('user_school_type.school_type_id','=',$type_of_school_id)
                        ->orWhere('user_school_type.school_type_id','=',5);
                });
            }


            $general_location_id = array();

            if (!empty($jobs->general_location_id)) {
                $general_location_id = array($jobs->general_location_id, 3);
                if ($jobs->general_location_id == 3) {
                    $general_location_id = array(1, 2, 3);
                }
            }
      

            if(!empty($jobs->state_id) && !empty($jobs->city_id)) {


                $city_id = $jobs->city_id;
                $state_id = $jobs->state_id;

                $teachers = $teachers->join('states','states.id','=','user_location.state_id','left');



                $teachers = $teachers->where(function($q) use ($state_id) {
                    $q->where('user_location.state_id','=',$state_id)
                        ->orWhere('states.name','=','All');
                });

                $teachers = $teachers->join('cities','cities.id','=','user_location.city_id','left');
                $teachers = $teachers->where(function($q) use ($city_id) {
                    $q->where('user_location.city_id','=',$city_id)
                        ->orWhere('cities.name','=','All');
                });


                
                // $state_id = $jobs->state_id;
                // $city_id = $jobs->city_id;

                // $teachers = $teachers->join('states','states.id','=','user_location.state_id','left');
                // $teachers = $teachers->join('cities','cities.id','=','user_location.city_id','left');


                // $teachers = $teachers->where(function($q) use ($state_id,$city_id, $general_location_id) {

                //     $q->where(function($q) use ($state_id,$city_id) {
                //             $q->where(function($q) use ($state_id) {
                //                 $q->where('user_location.state_id','=',$state_id)
                //                     ->orWhere('states.name','=','All');
                //             });

                            
                //             $q->where(function($q) use ($city_id) {
                //                 $q->where('user_location.city_id','=',$city_id)
                //                     ->orWhere('cities.name','=','All');
                //             });
                //     })
                //     ->orWhereIn('users.area_id',$general_location_id);
                  
                // });
            }
            

             $teachers = $teachers->whereIn('users.area_id', $general_location_id);

        }

        if(!empty($request->school_type_id)) {
            $teachers = $teachers->join('user_school_type','user_school_type.user_id','=','users.id');
            $teachers = $teachers->where('user_school_type.school_type_id','=',$request->school_type_id);                      
        }   
        if(!empty($request->current_location_id)) {
                $teachers = $teachers->where('users.current_location_id','=',$request->current_location_id);                      
        }   
        if(!empty($request->educaton_level_id)) {
            $teachers = $teachers->where('users.educaton_level_id','=',$request->educaton_level_id);                      
        }
        if(!empty($request->minimum_salary_id)) {
            $teachers = $teachers->where('users.minimum_salary_id','>=',$request->minimum_salary_id);                      
        }
        if(!empty($request->maximum_salary_id)) {
            $teachers = $teachers->where('users.maximum_salary_id','<=',$request->maximum_salary_id);                      
        }
        if(!empty($request->educaton_level_id)) {
            $teachers = $teachers->where('users.educaton_level_id','=',$request->educaton_level_id);                      
        }    
        if(!empty($request->is_native_english)) {
            $teachers = $teachers->where('users.is_native_english','=',$request->is_native_english);                      
        }
        if(!empty($request->is_education_english)) {
            $teachers = $teachers->where('users.is_education_english','=',$request->is_education_english);                      
        }
        if(!empty($request->color_id)) {
            $teachers = $teachers->where('users.color_id','=',$request->color_id);                      
        }
        if(!empty($request->job_type_id)) {
            $teachers = $teachers->where('users.job_type_id','=',$request->job_type_id);                      
        }


        if(!empty($request->state_id) || !empty($request->city_id)) {                  
            if(!empty($request->state_id)) {
                $teachers = $teachers->where('user_location.state_id','=',$request->state_id);                      
            }

            if(!empty($request->city_id)) {
                $teachers = $teachers->where('user_location.city_id','=',$request->city_id);                      
            }
        }

        if(!empty($request->area_id)) {
            $teachers = $teachers->where('users.area_id','=',$request->area_id);                      
        }
        if(!empty($request->start_date_id)) {
            $teachers = $teachers->where('users.start_date_id','=',$request->start_date_id);                      
        }
        if(!empty($request->is_native_english_speaking)) {
            $teachers = $teachers->where('users.is_native_english_speaking','=',$request->is_native_english_speaking);                      
        }
        if(!empty($request->teacher_type_id)) {
            $teachers = $teachers->where('users.teacher_type_id','=',$request->teacher_type_id);                      
        }
        if(!empty($request->card_colour_id)) {
            $teachers = $teachers->where('users.card_colour_id','=',$request->card_colour_id);                      
        }
        if(!empty($request->staff_id)) {
            $teachers = $teachers->where('users.staff_id','=',$request->staff_id);                      
        }
        if(!empty($request->teacher_id)) {
            $teachers = $teachers->where('users.teacher_id', 'like', '%' . $request->teacher_id . '%');             
        }
        if(!empty($request->teacher_name)) {
            $teachers = $teachers->where('users.name', 'like', '%' . $request->teacher_name . '%');             
        }
        if(!empty($request->note)) {
            $teachers = $teachers->where('users.note', 'like', '%' . $request->note . '%');             
        }
        if(!empty($request->register_date)) {
            if($request->register_date == 'Latest')
            {
                $teachers = $teachers->orderBy('users.id', 'desc');
            }
            else
            {
                $teachers = $teachers->orderBy('users.id', 'asc');
            }
        }
        else
        {
            $teachers = $teachers->orderBy('users.id', 'desc');
        }

        $teachers = $teachers->where('users.is_delete', '=', 0);
        $teachers = $teachers->where('users.status', '=', 1);
        $teachers = $teachers->groupBy('users.id');
        $teachers = $teachers->paginate(10);

// $teachers = $teachers->toSql();

// dd($teachers);

// select `users`.* from `users` left join `user_location` on `user_location`.`user_id` = `users`.`id` 

// inner join `user_school_type` on `users`.`id` = `user_school_type`.`user_id` 
// inner join `states` on `states`.`id` = `user_location`.`state_id` 
// inner join `cities` on `cities`.`id` = `user_location`.`city_id` 

// where `is_admin` = 4 and `users`.`is_native_english` = 'Yes' and `users`.`position_id` = '1' 
// and (`user_school_type`.`school_type_id` = 1 or `user_school_type`.`school_type_id` = 5) 


// and (((`user_location`.`state_id` = '1' or `states`.`name` = "All") 
// and (`user_location`.`city_id` = '1' or `cities`.`name` = "All") )
// or `users`.`area_id` in (1,2,3) )


// and `users`.`is_delete` = 0 and `users`.`status` = 1 group by `users`.`id` order by `users`.`id` desc 


// select `users`.* from `users` 

// left join `user_location` on `user_location`.`user_id` = `users`.`id` 
// inner join `user_school_type` on `users`.`id` = `user_school_type`.`user_id`
// left join `states` on `states`.`id` = `user_location`.`state_id` 
// left join `cities` on `cities`.`id` = `user_location`.`city_id`
// where `is_admin` = 4 and `users`.`is_native_english` = 'Yes' and `users`.`position_id` = 1 
// and (`user_school_type`.`school_type_id` = 1 or `user_school_type`.`school_type_id` = 5)
// and 

// (((`user_location`.`state_id` = 1 or `states`.`name` = 'All') 
// and (`user_location`.`city_id` = 1 or `cities`.`name` = 'All') )
// or `users`.`area_id` in (1,2,3))



// and `users`.`is_delete` = 0 and `users`.`status` = 1 group by `users`.`id` order by `users`.`id` desc









// select `users`.* from `users` left join `user_location` on `user_location`.`user_id` = `users`.`id` 

// inner join `user_school_type` on `users`.`id` = `user_school_type`.`user_id` 
// inner join `states` on `states`.`id` = `user_location`.`state_id` 
// inner join `cities` on `cities`.`id` = `user_location`.`city_id` 

// where `is_admin` = 4 and `users`.`is_native_english` = 'Yes' and `users`.`position_id` = '1'  and (`user_school_type`.`school_type_id` = ? or `user_school_type`.`school_type_id` = ?) and (`user_location`.`state_id` = ? or `states`.`name` = ?) and (`user_location`.`city_id` = ? or `cities`.`name` = ?) and `users`.`area_id` in (1,2,3) and `users`.`is_delete` = 0 and `users`.`status` = 1 group by `users`.`id` order by `users`.`id` desc 



        $data['teachers'] = $teachers;

        $data['slug'] = $slug;

        $data['recommended'] = !empty($request->recommended) ? $request->recommended : '';

        


        $page_id = 0;
        if(!empty($teachers->nextPageUrl())) {
            $parse_url =parse_url($teachers->nextPageUrl()); 
            if(!empty($parse_url['query']))
            {
                 parse_str($parse_url['query'], $get_array);     
                 $page_id = !empty($get_array['page']) ? $get_array['page'] : 0;
            }
        }

        $data['page_id'] = intval($page_id);



        if($request->ajax()) {

            $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

            return response()->json([
                "status" => true,
                "url" => $actual_link,
                "success" => view('frontend.school._teacher_matched', [
                    "teachers" => $data['teachers'],
                    "slug" => $slug,
                    "page_id" => $page_id,
                    "jobs"    => $jobs,
                ])->render(),
            ], 200);            
        }
        else
        {

            $data['slug'] = $slug;
            $data['jobs'] = $jobs;

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


            return view('frontend.school.teacher_matched',$data);
        }
    }



}

?>
