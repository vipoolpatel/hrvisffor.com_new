<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 8/3/2020
 * Time: 2:54 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
class Job extends Model
{
    protected $table = "jobs";
    protected $fillable =[
      'user_id',
      'position_id',
      'type_of_school_id',
      'job_type_id',
      'country_id',
      'state_id',
      'city_id',
      'is_english_speaker',
      'visa_type_id',
      'general_location_id',
      'teacher_start_id',
      'salary_minimum_id',
      'salary_maximum_id',
      'working_hours_per_week',
      'working_schedule_id',
      'class_size',
      'maximum_age',
      'minimum_age',
      'slug',
      'expiry_date',
      'is_active',
      'is_delete',
      'is_approve',
      'is_publish'
    ];


    static public function get_single_slug($slug) {
        return self::where('slug','=',$slug)->first();
    }

    static public function get_single_job($id) {
        return self::find($id);
    }

    static public function get_single_user($id) {
        return self::where('user_id','=',Auth::user()->id)->where('id','=',$id)->first();
    }

    
    static public function getTotalJob($date = '') {
         $getTotalJob = self::where('is_delete','=',0);
         if(!empty($date)) {
          $getTotalJob = $getTotalJob->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"),"=", $date);
         }
         $getTotalJob = $getTotalJob->count();
         return $getTotalJob;
    }


    static public function get_today_job() {
         $result = self::where('is_delete','=',0)
                ->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"),"=", date('Y-m-d'))
                ->get();
         return $result;
    }


    static public function get_job_id($user_id)
    {   
        $job = array();
        $result = self::select('id')->where('user_id','=',$user_id)->get();
        foreach ($result as $key => $value) {
            $job[] = $value->id;
        }
        return $job;
    }
    
    

    static public function get_job($request) {

         $get_job = self::select('jobs.*')
                      ->join('users','users.id','=','jobs.user_id')
                      ->where('jobs.is_delete','=','0');
                    if(!empty($request->school_id)) {
                        // $get_job = $get_job->where('users.school_id', 'like', '%' . $request->school_id . '%');   
                        $get_job = $get_job->where('users.school_id', '=', $request->school_id);                                   
                    }

                    if(!empty($request->school_name)) {
                        $get_job = $get_job->where('users.school_name', 'like', '%' . $request->school_name . '%');                              
                    }

                    if(!empty($request->staff_id)) {
                        $get_job = $get_job->where('users.staff_id','=',$request->staff_id);                      
                    }
                    
                    if(!empty($request->note)) {
                        
                        $get_job = $get_job->where('jobs.note', 'like', '%' . $request->note . '%');                 
                    }


                    
                    if(!empty($request->type_of_school_id)) {
                        $get_job = $get_job->where('jobs.type_of_school_id','=',$request->type_of_school_id);                      
                    }
                    if(!empty($request->credit_level_id)) {
                        $get_job = $get_job->where('jobs.credit_level_id','=',$request->credit_level_id);                      
                    }
                    if(!empty($request->general_location_id)) {
                        $get_job = $get_job->where('jobs.general_location_id','=',$request->general_location_id);                      
                    }
                    if(!empty($request->is_english_speaker)) {
                        $get_job = $get_job->where('jobs.is_english_speaker','=',$request->is_english_speaker);                      
                    }
                    if(!empty($request->working_schedule_id)) {
                        $get_job = $get_job->where('jobs.working_schedule_id','=',$request->working_schedule_id);                      
                    }
                    if(!empty($request->teacher_start_id)) {
                        $get_job = $get_job->where('jobs.teacher_start_id','=',$request->teacher_start_id);                      
                    }
                    if(!empty($request->position_id)) {
                        $get_job = $get_job->where('jobs.position_id','=',$request->position_id);                      
                    }
                    if(!empty($request->emergency_level_id)) {
                        $get_job = $get_job->where('jobs.emergency_level_id','=',$request->emergency_level_id);                      
                    }
                    if(!empty($request->state_id)) {
                        $get_job = $get_job->where('jobs.state_id','=',$request->state_id);                      
                    }
                    if(!empty($request->city_id)) {
                        $get_job = $get_job->where('jobs.city_id','=',$request->city_id);                      
                    }
                    if(!empty($request->class_size)) {
                        $get_job = $get_job->where('jobs.class_size','=',$request->class_size);                      
                    }
                    if(!empty($request->working_schedule_id)) {
                        $get_job = $get_job->where('jobs.working_schedule_id','=',$request->working_schedule_id);                      
                    }
                    
                    if(!empty($request->salary_minimum_id)) {
                        $get_job = $get_job->where('jobs.salary_minimum_id','>=',$request->salary_minimum_id);                      
                    }

                    if(!empty($request->salary_maximum_id)) {
                        $get_job = $get_job->where('jobs.salary_maximum_id','<=',$request->salary_maximum_id);                      
                    }

                    if(!empty($request->minimum_age)) {
                        $get_job = $get_job->where('jobs.minimum_age','>=',$request->minimum_age);                      
                    }

                    if(!empty($request->maximum_age)) {
                        $get_job = $get_job->where('jobs.maximum_age','<=',$request->maximum_age);                      
                    }

                    if(!empty($request->register_date)) {
                        if($request->register_date == 'Latest')
                        {
                            $get_job = $get_job->orderBy('jobs.id', 'desc');
                        }
                        else
                        {
                            $get_job = $get_job->orderBy('jobs.id', 'asc');
                        }
                    }
                    else
                    {
                        $get_job = $get_job->orderBy('jobs.id', 'desc');
                    }

         $get_job = $get_job->paginate(10);
         return $get_job;
    }

    public function user() {
        return $this->belongsTo(UsersModel::class, 'user_id', 'id');
    }

    public function job_welfare()
    {
        return $this->hasMany(JobWelfare::class, 'job_id', 'id');
    }

    public function job_teachers_accommodation()
    {
        return $this->hasMany(JobTeacherAccommodation::class, 'job_id', 'id');
    }

    public function job_school_environment()
    {
        return $this->hasMany(JobSchoolEnvironment::class, 'job_id', 'id');
    }

    public function get_position()
    {
        return $this->belongsTo(PositionModel::class, 'position_id', 'id');
    }

    public function get_school_type(){
         return $this->belongsTo(SchoolTypeModel::class,'type_of_school_id','id');
    }
    public function get_job_type(){
        return $this->belongsTo(JobTypeModel::class,'job_type_id','id');
    }

    public function get_visa_type() {
        return $this->belongsTo(VisaType::class, 'visa_type_id', 'id');
    }

    public function get_general_location() {
        return $this->belongsTo(GeneralLocation::class, 'general_location_id', 'id');
    }

    public function get_salary_minimum() {
        return $this->belongsTo(SalaryModel::class, 'salary_minimum_id', 'id');
    }

    public function get_salary_maximum() {
        return $this->belongsTo(SalaryModel::class, 'salary_maximum_id', 'id');
    }

    public function get_working_schedule() {
        return $this->belongsTo(WorkingSchedule::class, 'working_schedule_id', 'id');
    }

    public function get_teacher_start() {
        return $this->belongsTo(StartDateModel::class, 'teacher_start_id', 'id');
    }
    
    public function creditlevel() {
        return $this->belongsTo(CreditLevelModel::class, 'credit_level_id', 'id');
    }

    public function emergencylevel() {
        return $this->belongsTo(EmergencyLevelModel::class, 'emergency_level_id', 'id');
    }

    public function state() {
        return $this->belongsTo(StateModel::class, 'state_id', 'id');
    }

    public function city() {
        return $this->belongsTo(CityModel::class, 'city_id', 'id');
    }


    public function get_location() {

        $location = '';
        if(!empty($this->city))
        {
            $location .= $this->city->getName().', ';
        }

        if(!empty($this->state))
        {
            $location .= $this->state->getName();  
        }
        
        return $location;
    }


    function get_total_interview() {
        return $this->hasMany(JobApply::class, 'job_id', 'id')->where('status','=',2)->count();
    }


    public function save_job_teacher()
    {
        return $this->hasMany(SaveJobModel::class, 'job_id', 'id')->where('teacher_id','=',Auth::user()->id)->count();
    }


    public function save_teacher()
    {
        return $this->hasMany(SaveJobModel::class, 'job_id', 'id')->count();
    }


    public function job_profile_view()
    {
        return $this->hasMany(JobProfileViewModel::class, 'job_id', 'id')->count();
    }


   function get_total_offer() {
        $count = OfferModel::select('offer.id')
                ->join('job_apply','job_apply.id','=','offer.job_apply_id')
                ->where('job_apply.job_id','=', $this->id)
                ->count();
        return $count;
    }





    static public function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
          return 'n-a';
        }

        return $text;
    }


}
