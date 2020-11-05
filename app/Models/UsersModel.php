<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Notifications\Notifiable;
use DB;
use Auth;
use Cache;

class UsersModel extends Model
{
    use Notifiable;

    protected $table = 'users';

    public function OnlineUser() {

        if(!empty(Cache::has('OnlineUser' . $this->id)))
        {
            return Cache::has('OnlineUser' . $this->id);
        }
        else
        {
            if(!empty($this->is_online))
            {
                return  true;
            }
            else
            {
                return Cache::has('OnlineUser' . $this->id);        
            }
        }    
    }
    

    static public function get_single_username($username)
    {
        return self::where('username','=',$username)->first();
    }
    
    static public function get_single($id)
    {
        return self::find($id);
    }

    // search 

    static function get_seach_member($search) {
        if(!empty($search)) {

            return self::whereIn('is_admin',array('3','4'))
                    ->where(function($query) use ($search){
                        $query->where('teacher_id','like','%'.$search.'%')
                        ->orWhere('school_id','like','%'.$search.'%')
                        ->orWhere('name','like','%'.$search.'%')
                        ->orWhere('school_name','like','%'.$search.'%');
                    })
                ->get();    
        }
        else
        {
            return '';
        }        
    }

    // end search 

    static public function getTotalTeacher($date = '', $type) {
         $getTotalTeacher = self::where('is_admin','=',$type)->where('is_delete','=',0);   
         if(!empty($date)) {
            $getTotalTeacher = $getTotalTeacher->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"),"=", $date);
         }
         $getTotalTeacher = $getTotalTeacher->count();
         return $getTotalTeacher;
    }

    static public function getTotalGoldTeacher($teacher_type_id, $type) {
        return self::where('is_admin','=',$type)->where('is_delete','=',0)
                    ->where('teacher_type_id','=',$teacher_type_id)
                    ->count();   
    }

    static public function get_today_teachers() {
        $result = self::where('is_delete','=',0)
                ->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"),"=", date('Y-m-d'))
                ->where('is_admin','=',4)
                ->orderBy('id','desc')
                ->get();
        return $result;
    }

    static public function getTeacher($request)
    {
        $user = self::select('users.*')->where('users.is_admin','=','4')->where('users.is_delete','=','0');
        
                if(!empty($request->school_type_id)) {
                    $user = $user->join('user_school_type','user_school_type.user_id','=','users.id');
                    $user = $user->where('user_school_type.school_type_id','=',$request->school_type_id);                      
                }   
                if(!empty($request->current_location_id)) {
                        $user = $user->where('users.current_location_id','=',$request->current_location_id);                      
                }   
                if(!empty($request->educaton_level_id)) {
                    $user = $user->where('users.educaton_level_id','=',$request->educaton_level_id);                      
                }
                if(!empty($request->minimum_salary_id)) {
                    $user = $user->where('users.minimum_salary_id','>=',$request->minimum_salary_id);                      
                }
                if(!empty($request->maximum_salary_id)) {
                    $user = $user->where('users.maximum_salary_id','<=',$request->maximum_salary_id);                      
                }
                if(!empty($request->educaton_level_id)) {
                    $user = $user->where('users.educaton_level_id','=',$request->educaton_level_id);                      
                }
                
                if(!empty($request->is_native_english)) {
                    $user = $user->where('users.is_native_english','=',$request->is_native_english);                      
                }
                if(!empty($request->is_education_english)) {
                    $user = $user->where('users.is_education_english','=',$request->is_education_english);                      
                }
                if(!empty($request->color_id)) {
                    $user = $user->where('users.color_id','=',$request->color_id);                      
                }
                if(!empty($request->job_type_id)) {
                    $user = $user->where('users.job_type_id','=',$request->job_type_id);                      
                }


                if(!empty($request->state_id) || !empty($request->city_id)) {                  
                    $user = $user->join('user_location','user_location.user_id','=','users.id');
                    if(!empty($request->state_id)) {
                        $user = $user->where('user_location.state_id','=',$request->state_id);                      
                    }

                    if(!empty($request->city_id)) {
                        $user = $user->where('user_location.city_id','=',$request->city_id);                      
                    }
                }

                if(!empty($request->area_id)) {
                    $user = $user->where('users.area_id','=',$request->area_id);                      
                }
                if(!empty($request->start_date_id)) {
                    $user = $user->where('users.start_date_id','=',$request->start_date_id);                      
                }
                if(!empty($request->is_native_english_speaking)) {
                    $user = $user->where('users.is_native_english_speaking','=',$request->is_native_english_speaking);                      
                }
                if(!empty($request->teacher_type_id)) {
                    $user = $user->where('users.teacher_type_id','=',$request->teacher_type_id);                      
                }
                if(!empty($request->card_colour_id)) {
                    $user = $user->where('users.card_colour_id','=',$request->card_colour_id);                      
                }
                if(!empty($request->staff_id)) {
                    $user = $user->where('users.staff_id','=',$request->staff_id);                      
                }
                if(!empty($request->teacher_id)) {
                    $user = $user->where('users.teacher_id', 'like', '%' . $request->teacher_id . '%');             
                }
                if(!empty($request->teacher_name)) {
                    $user = $user->where('users.name', 'like', '%' . $request->teacher_name . '%');             
                }
         
                if(!empty($request->note)) {
                    $user = $user->where('users.note', 'like', '%' . $request->note . '%');             
                }

                if(!empty($request->created_at)) {

                    $start_date   = date('Y-m-d', strtotime(' - '.$request->created_at.' days'));
                    $end_date = date('Y-m-d');

                    $user = $user->where(DB::raw("(DATE_FORMAT(users.created_at,'%Y-%m-%d'))"), '>=' , $start_date);
                    $user = $user->where(DB::raw("(DATE_FORMAT(users.created_at,'%Y-%m-%d'))"), '<=' , $end_date);

                    $user = $user->whereNotIn('users.id', function($q) {
                         $q->select('offer_contract.teacher_id')->from('offer_contract')
                         ->where('offer_contract.teacher_status','=',2);
                    }); 

                }

                if(!empty($request->status)) {
                    $status = $request->status;
                    if($request->status == 100) {
                        $status = 0;
                    }
                    $user = $user->where('users.status', '=', $status);             
                }

                if(!empty($request->verify)) {
                    $verify = $request->verify;
                    if($request->verify == 100) {
                        $verify = 0;
                    }
                    $user = $user->where('users.verify', '=', $verify);             
                }

                if(!empty($request->register_date)) {
                    if($request->register_date == 'Latest')
                    {
                        $user = $user->orderBy('users.id', 'desc');
                    }
                    else
                    {
                        $user = $user->orderBy('users.id', 'asc');
                    }
                }
                else
                {
                    $user = $user->orderBy('users.id', 'desc');
                }
                
                $user = $user->groupBy('users.id');
                
                
        $user = $user->paginate(10);

        return $user;
    }

    static public function get_single_user($id)
    {
        return self::whereIn('is_admin',array(1,2))->where('id','=',$id)->first();
    }


    static public function get_record_staff_pagi()
    {
        return self::where('is_delete','=','0')->whereIn('is_admin',array(1,2))->orderBy('id','desc')->paginate(30);
    }


    static public function get_record_staff()
    {
        return self::where('is_delete','=','0')->whereIn('is_admin',array(1,2))->get();
    }




    static public function timezone() {
        $timezone = '';
        try {
            $ip     = $_SERVER['REMOTE_ADDR'];
            $json   = file_get_contents( 'http://ip-api.com/json/' . $ip);
            $ipData = json_decode( $json, true);
            $timezone = !empty($ipData['timezone']) ? $ipData['timezone'] : '';
        }
        catch (\Exception $e) {

        }
        return $timezone;

    }


    public function getName() {
        $name = '';
        $name .= ucfirst($this->name);
        if(!empty($this->last_name))
        {
            $name .= ' '.ucfirst($this->last_name);
        }
        return $name;
    }

    static public function getTeacherID()
    {
        $digits = 7;
        $rule_id =  'A'.rand(pow(10, $digits-1), pow(10, $digits)-1);
        return $rule_id;
    }

    public function getImage() {
        if(!empty($this->profile_pic) && file_exists('upload/profile/'.$this->profile_pic)) {
            return url('upload/profile/'.$this->profile_pic);
        }
        else {
            return url('upload/profile/profile.png');
        }
    }


    public function getCV() {
        if(!empty($this->cv_upload) && file_exists('upload/profile/'.$this->cv_upload)) {
            return url('upload/profile/'.$this->cv_upload);
        }
        else {
            return '';
        }
    }

   public function getStaffCVUpload() {
        if(!empty($this->staff_cv_upload) && file_exists('upload/profile/'.$this->staff_cv_upload)) {
            return url('upload/profile/'.$this->staff_cv_upload);
        }
        else {
            return '';
        }
    }

    

    public function getVideo() {
        if(!empty($this->user_video) && file_exists('upload/profile/'.$this->user_video)) {
            return url('upload/profile/'.$this->user_video);
        }
        else {
            return '';
        }
    }

    public function get_job() {
        return $this->hasMany(Job::class, "user_id")->where('is_delete','=',0)->orderBy('id','desc');
    }

    public function get_school_type() {
        return $this->hasMany(UserSchoolTypeModel::class, "user_id");
    }

    public function get_location() {
        return $this->hasMany(UserLocationModel::class, "user_id");
    }
    
    public function get_instant_messenger() {
        return $this->hasMany(UserInstantMessengerModel::class, "user_id");
    }


    public function get_education() {
        return $this->hasMany(UserEducation::class, "user_id");
    }

    public function get_experience() {
        return $this->hasMany(UserExperience::class, "user_id");
    }

    public function nationality(){
        return $this->belongsTo(NationalityModel::class,'nationality_id','id');
    }

    public function start_date(){
        return $this->belongsTo(StartDateModel::class,'start_date_id','id');
    }

    public function area() {
        return $this->belongsTo(AreaModel::class,'area_id','id');
    }

    public function education_level(){
        return $this->belongsTo(EducationLevelModel::class,'educaton_level_id');
    }

    public function teacher_type(){
        return $this->belongsTo(TeacherTypeModel::class,'teacher_type_id');
    }

    public function colour(){
        return $this->belongsTo(ColourModel::class,'color_id');
    }

    public function card_colour(){
        return $this->belongsTo(CardColourModel::class,'card_colour_id');
    }

    public function staff(){
        return $this->belongsTo(UsersModel::class,'staff_id');
    }


    public function minimum_salary(){
        return $this->belongsTo(SalaryModel::class,'minimum_salary_id','id');
    }

    public function maximum_salary(){
        return $this->belongsTo(SalaryModel::class,'maximum_salary_id','id');
    }

    public function current_location(){
        return $this->belongsTo(CurrentLocationModel::class,'current_location_id','id');
    }

    public function position(){
        return $this->belongsTo(PositionModel::class,'position_id','id');
    }
    
    public function job_type(){
        return $this->belongsTo(JobTypeModel::class, 'job_type_id','id');
    }

    public function current_visa_type(){
        return $this->belongsTo(CurrentVisaTypeModel::class,'current_visa_type_id','id');
    }

    public function gender(){
        return $this->belongsTo(GenderModel::class,'gender_id','id');
    }


    function get_total_interview() {
        return $this->hasMany(JobApply::class, 'user_id', 'id')->where('status','=',2)->count();
    }

    public function get_video() {
        return $this->hasMany(UserVideoModel::class, "user_id");
    }

    function get_total_offer() {
        $count =  OfferModel::select('offer.id')
                ->join('job_apply','job_apply.id','=','offer.job_apply_id')
                ->where('job_apply.user_id','=',$this->id)
                ->where('offer.status','=',2)
                ->count();
        return $count;
    }



    function profile_view() {
        return $this->hasMany(UserProfileViewModel::class, 'teacher_id', 'id')->count();
    }

    function position_view_school() {
        return  self::join('jobs','jobs.user_id','=','users.id')
            ->join('job_profile_view','job_profile_view.job_id','=','jobs.id')
            ->where('jobs.user_id','=',$this->id)
            ->count();
    }


   static public function get_member_group($group_id) {

       $return =  self::select('users.name','users.id','users.profile_pic','users.school_name','users.teacher_id','users.school_id');

       if(!empty($group_id))
       {
            $return = $return->whereNotIn('id', function($q) use ($group_id) {
                 $q->select('user_id')->from('group_member_detail')
                 ->where('group_id','=',$group_id)
                 ->where('status','=','1');
            }); 
       }
       
        $return = $return->whereIn('users.is_admin',array(1,2))
        ->where('users.is_delete',"=","0")
        ->get();

         return $return;
    }


    public function save_teacher_school()
    {
        return $this->hasMany(SaveTeacherModel::class, 'teacher_id', 'id')->where('school_id','=',Auth::user()->id)->count();
    }


    public function get_total_invoice()
    {
        return $this->hasMany(InvoiceModel::class, 'user_id', 'id')->sum('total');   
    }
}
