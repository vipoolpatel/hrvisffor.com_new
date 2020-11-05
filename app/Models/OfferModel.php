<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Request;
class OfferModel extends Model
{
    protected $table = 'offer';



    static public function get_single($id)
    {
        return self::find($id);
    }


    static public function getTotalOffer($date = '') {
         $getTotalOffer = self::select('id');
         if(!empty($date)) {
          $getTotalOffer = $getTotalOffer->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"),"=", $date);
         }
         $getTotalOffer = $getTotalOffer->count();
         return $getTotalOffer;
    }


    static public function getTotalOfferTeacher($user_id) {
        return self::select('offer.*')
				->join('job_apply','job_apply.id','=','offer.job_apply_id')
				->join('jobs','jobs.id','=','job_apply.job_id')
				->join('users','users.id','=','job_apply.user_id')
				->where('job_apply.user_id','=',$user_id)
				->where('offer.status','=',2)
				->orderBy('offer.id','desc')
				->count();
				
    }


    static public function getTotalOfferSchool($user_id) {
      return self::select('offer.*')
					->join('job_apply','job_apply.id','=','offer.job_apply_id')
					->join('jobs','jobs.id','=','job_apply.job_id')
					->join('users','users.id','=','job_apply.user_id')
					->where('offer.school_id','=',$user_id)
					->orderBy('offer.id','desc')
					->count();				
				
    }

    
    static public function get_today_offer($date)
    {
		return self::select('offer.*')
			->join('job_apply','job_apply.id','=','offer.job_apply_id')
			->join('jobs','jobs.id','=','job_apply.job_id')
			->join('users','users.id','=','job_apply.user_id')
			->join('users as school','school.id','=','offer.school_id')
			->where(DB::raw("(DATE_FORMAT(offer.created_at,'%Y-%m-%d'))"),"=", $date)
			->orderBy('offer.id','desc')
			->get();			
    }




    static public function get_offer_school($user_id)
    {
		return self::select('offer.*')
					->join('job_apply','job_apply.id','=','offer.job_apply_id')
					->join('jobs','jobs.id','=','job_apply.job_id')
					->join('users','users.id','=','job_apply.user_id')
					->where('offer.school_id','=',$user_id)
					->orderBy('offer.id','desc')
					->paginate(12);					
    }


    static public function get_offer_admin($user_id)
    {
		$result = self::select('offer.*')
					->join('job_apply','job_apply.id','=','offer.job_apply_id')
					->join('jobs','jobs.id','=','job_apply.job_id')
					->join('users','users.id','=','job_apply.user_id')
					->join('users as school','school.id','=','offer.school_id');

			if(!empty(Request::get('user_id'))) {
                $result = $result->where('job_apply.user_id','=',Request::get('user_id'));
            }

		$result = $result->orderBy('offer.id','desc')
					->paginate(12);

		return	$result;
					
    }


    static public function get_offer_teacher($user_id)
    {
		return self::select('offer.*')
					->join('job_apply','job_apply.id','=','offer.job_apply_id')
					->join('jobs','jobs.id','=','job_apply.job_id')
					->join('users','users.id','=','job_apply.user_id')
					->where('job_apply.user_id','=',$user_id)
					->where('offer.status','=',2)
					->orderBy('offer.id','desc')
					->paginate(12);
					
    }



    public function school() {
        return $this->belongsTo(UsersModel::class, 'school_id', 'id');
    }

    public function job_apply() {
        return $this->belongsTo(JobApply::class, 'job_apply_id', 'id');
    }

    public function status() {
        return $this->belongsTo(OfferStatusModel::class, 'status', 'id');
    }

    public function confirm() {
        return $this->belongsTo(OfferStatusModel::class, 'is_confirm', 'id');
    }

    public function tax() {
    	return $this->belongsTo(TaxSalaryModel::class,'tax_salary_id','id');
    }

}
