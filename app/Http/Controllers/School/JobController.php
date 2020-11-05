<?php

namespace App\Http\Controllers\School;


use App\Http\Controllers\Controller;
use App\Models\AreaModel;
use App\Models\CurrentLocationModel;
use App\Models\CurrentVisaTypeModel;
use App\Models\EducationLevelModel;
use App\Models\GeneralLocation;
use App\Models\Job;
use App\Models\JobSchoolEnvironment;
use App\Models\JobTeacherAccommodation;
use App\Models\JobTypeModel;
use App\Models\JobWelfare;
use App\Models\NationalityModel;
use App\Models\PositionModel;
use App\Models\SalaryModel;
use App\Models\SchoolTypeModel;
use App\Models\StartDateModel;
use App\Models\StateModel;
use App\Models\UsersModel;
use App\Models\VisaType;
use App\Models\Welfare;
use App\Models\WorkingSchedule;
use App\Services\MediaService;
use Illuminate\Http\Request;
use Auth;

class JobController extends Controller
{
    public function index(){

       

        $data['user'] = UsersModel::get_single(Auth::user()->id);

        return view('backend.school.position.list',$data);
    }

    public function add() {

        $data['user']                  =  UsersModel::get_single(Auth::user()->id);
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

        return view('backend.school.position.add',$data);
    }

    public function edit($id) {

        $data['user']                  =  UsersModel::get_single(Auth::user()->id);
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

        $data['job']                    = Job::get_single_user($id);
        if(!empty($data['job']))
        {
            return view('backend.school.position.edit',$data);
        }
        else
        {
            return redirect('school/position');
        }
    }


    public function store(Request $request) {

        $this->validate($request,[
           'position'=>'required',
           'type_of_school'=>'required',
           'job_type'=>'required'
        ]);

        $job = Job::create([
            'user_id'           =>  Auth::user()->id,
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
            'minimum_age'   =>  $request->minimum_age,
            'maximum_age'   =>  $request->maximum_age,
            'expiry_date'   => $request->expiry_date,
        ]);

        $get_position = PositionModel::get_single($request->position);
        $title = Job::slugify($get_position->name);
        $slug = $title.'-'.$job->id;
        $job_update = Job::get_single_user($job->id);
        $job_update->slug = $slug;
        $job_update->save();

        foreach ($request->welfare as $welfare_id) {

            if(!empty($welfare_id)) {
                $welfare = JobWelfare::create([
                    'job_id'=>$job->id,
                    'welfare_id'=>$welfare_id
                ]);
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


        $user               = UsersModel::get_single(Auth::user()->id);
        $user->name         = $request->contact_name;
        $user->phone_number = $request->phone_number;
        $user->wechat_id    = $request->wechat_id;
        $user->school_name  = $request->school_name;
        $user->email        = $request->email_address;
        $user->save();
        
        return redirect('school/position')->with('success', __("message.Position successfully created."));

    }


    public function update($id, Request $request) {

        $this->validate($request,[
            'position'       => 'required',
            'type_of_school' => 'required',
            'job_type'       => 'required'
        ]);

        $get_position = PositionModel::get_single($request->position);
        $title = Job::slugify($get_position->name);
        $slug = $title.'-'.$id;
        
        
        $job = Job::get_single_user($id);
        $job->position_id       = $request->position;
        $job->type_of_school_id = $request->type_of_school;
        $job->job_type_id       = $request->job_type;
        $job->state_id          = $request->state_id;
        $job->city_id           = $request->city_id;
        $job->is_english_speaker = $request->is_english_speaker;
        $job->visa_type_id      = $request->visa_type_id;
        $job->general_location_id = $request->general_location;
        $job->is_english_speaker = $request->is_english_speaker;
        $job->is_english_speaker = $request->is_english_speaker;

        $job->teacher_start_id  = $request->teacher_start;
        $job->salary_minimum_id = $request->salary_minimum;
        $job->salary_maximum_id = $request->salary_maximum;

        $job->working_hours_per_week = $request->working_hours_per_week;
        $job->working_schedule_id   = $request->working_schedule;
        $job->class_size            = $request->class_size;

        $job->minimum_age   = $request->minimum_age;
        $job->maximum_age   = $request->maximum_age;
        $job->expiry_date   = $request->expiry_date;
        $job->slug          = $slug;

        $job->save();


        JobWelfare::delete_job($job->id);

        foreach ($request->welfare as $welfare_id) {
            $welfare = JobWelfare::create([
                'job_id'=>$job->id,
                'welfare_id'=>$welfare_id
            ]);
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

        $user               = UsersModel::get_single(Auth::user()->id);
        $user->name         = $request->contact_name;
        $user->phone_number = $request->phone_number;
        $user->wechat_id    = $request->wechat_id;
        $user->school_name  = $request->school_name;
        $user->email        = $request->email_address;
        $user->save();

        return redirect('school/position')->with('success', __("message.Position successfully updated."));
    }

    public function delete($id) 
    {
        $job = Job::get_single_user($id);
        $job->is_delete = 1;
        $job->save();

        return redirect('school/position')->with('success', __("message.Record successfully deleted."));
    }


    public function environment_delete($job_id, $id) {

        $get = JobSchoolEnvironment::get_single($id);

        if(!empty($get->image_name) && file_exists('upload/school/'.$get->image_name)) {
            unlink('upload/school/'.$get->image_name);
        }

        $get->delete();
        return redirect()->back()->with('success', __("message.Record successfully deleted."));

    }



    
    public function accommodation_delete($job_id, $id) {

        $get = JobTeacherAccommodation::get_single($id);

        if(!empty($get->image_name) && file_exists('upload/school/'.$get->image_name)) {
            unlink('upload/school/'.$get->image_name);
        }

        $get->delete();
        return redirect()->back()->with('success', __("message.Record successfully deleted."));

    }


}
