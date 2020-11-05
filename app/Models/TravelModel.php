<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class TravelModel extends Model
{
    protected $table = 'travel';


    static public function get_single($id)
    {
        return self::find($id);
    }

    //admin part

     static public function getTotalTravel($date = '') {
          $getTotalTravel = self::select('travel.*')
				->join('users','users.id','=','travel.school_id')
        		->join('users as teacher','teacher.id','=','travel.teacher_id');
                if(!empty($date)) {
                    $getTotalTravel = $getTotalTravel->where(DB::raw("(DATE_FORMAT(travel.created_at,'%Y-%m-%d'))"),"=", $date);
                }

                $getTotalTravel = $getTotalTravel->orderBy('travel.id','desc')
                ->count();

        return $getTotalTravel;
    }

    static public function get_travel_admin() {
    	return self::select('travel.*')
			->join('users','users.id','=','travel.school_id')
            ->join('users as teacher','teacher.id','=','travel.teacher_id')
            ->orderBy('travel.id','desc')
            ->paginate(12);
    }

    // school part

    static public function get_travel_school($user_id) {
    	return self::select('travel.*')
			->join('users','users.id','=','travel.school_id')
            ->join('users as teacher','teacher.id','=','travel.teacher_id')
            ->where('travel.school_id','=',$user_id)
            ->orderBy('travel.id','desc')
            ->paginate(12);
   }

     // teacher part

    static public function get_travel_teacher($user_id) {
    	return self::select('travel.*')
			->join('users','users.id','=','travel.school_id')
            ->join('users as teacher','teacher.id','=','travel.teacher_id')
            ->where('travel.teacher_id','=',$user_id)
            ->where('travel.school_status','=',2)
            ->orderBy('travel.id','desc')
            ->paginate(12);
   }


   

    public function school() {
        return $this->belongsTo(UsersModel::class, 'school_id', 'id');
    }

    public function teacher() {
        return $this->belongsTo(UsersModel::class, 'teacher_id', 'id');
    }

    public function country() {
        return $this->belongsTo(CountryModel::class, 'country_id', 'id');
    }


    public function getImage() {
        if(!empty($this->profile_pic) && file_exists('upload/travel/'.$this->profile_pic)) {
            return url('upload/travel/'.$this->profile_pic);
        }
        else {
            return url('upload/profile/profile.svg');
        }
    }


    public function get_flight_ticket() {
        if(!empty($this->flight_ticket) && file_exists('upload/travel/'.$this->flight_ticket)) {
            return url('upload/travel/'.$this->flight_ticket);
        }
        else {
            return '';
        }
    }



    public function school_status_type() {
        return $this->belongsTo(TravelStatusModel::class, 'school_status', 'id');
    }

    public function teacher_status_type() {
        return $this->belongsTo(TravelStatusModel::class, 'teacher_status', 'id');
    }


}
