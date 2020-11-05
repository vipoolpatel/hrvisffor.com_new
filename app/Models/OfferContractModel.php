<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class OfferContractModel extends Model
{
    protected $table = 'offer_contract';


    static public function get_single($id)
    {
        return self::find($id);
    }


    // visa part

    static public function visa_contract_school($user_id) {

        return self::select('offer_contract.*')
                ->join('offer','offer.id','=','offer_contract.offer_id')
                ->join('job_apply','job_apply.id','=','offer.job_apply_id')
                ->join('users','users.id','=','offer_contract.school_id')
                ->join('users as teacher','teacher.id','=','offer_contract.teacher_id')
                ->where('offer_contract.teacher_id','=',$user_id)
                ->where('offer_contract.school_status','=',2)
                ->groupBy('offer_contract.school_id')
                ->get();
    }


    static public function visa_contract_teacher($user_id) {

        return self::select('offer_contract.*')
            ->join('offer','offer.id','=','offer_contract.offer_id')
            ->join('job_apply','job_apply.id','=','offer.job_apply_id')
            ->join('users','users.id','=','offer_contract.school_id')
            ->join('users as teacher','teacher.id','=','offer_contract.teacher_id')
            ->where('offer_contract.school_id','=',$user_id)
            ->where('offer_contract.school_status','=',2)
            ->orderBy('offer_contract.id','desc')
            ->paginate('12');
            
    }

    

    // end visa part



    // admin part

    static public function getTotalContract($date = '') {
          $getTotalContract = self::select('offer_contract.*')
                ->join('offer','offer.id','=','offer_contract.offer_id')
                ->join('job_apply','job_apply.id','=','offer.job_apply_id')
                ->join('users','users.id','=','offer_contract.school_id')
                ->join('users as teacher','teacher.id','=','offer_contract.teacher_id');

                if(!empty($date)) {
                    $getTotalContract = $getTotalContract->where(DB::raw("(DATE_FORMAT(offer_contract.created_at,'%Y-%m-%d'))"),"=", $date);
                }

                $getTotalContract = $getTotalContract->orderBy('offer_contract.id','desc')
                ->count();

        return $getTotalContract;
    }


    static function get_contract_admin($user_id) {
        return self::select('offer_contract.*')
                ->join('offer','offer.id','=','offer_contract.offer_id')
                ->join('job_apply','job_apply.id','=','offer.job_apply_id')
                ->join('users','users.id','=','offer_contract.school_id')
                ->join('users as teacher','teacher.id','=','offer_contract.teacher_id')
                ->orderBy('offer_contract.id','desc')
                ->paginate('12');
    }


    // school part
    static public function get_contract_school($user_id)
    {
    	return self::select('offer_contract.*')
			->join('offer','offer.id','=','offer_contract.offer_id')
			->join('job_apply','job_apply.id','=','offer.job_apply_id')
            ->join('users','users.id','=','offer_contract.school_id')
            ->join('users as teacher','teacher.id','=','offer_contract.teacher_id')
			->where('offer_contract.school_id','=',$user_id)
			->orderBy('offer_contract.id','desc')
			->paginate('12');
    }


    // teacher part    
    static public function get_contract_teacher($user_id) {

    	return self::select('offer_contract.*')
			->join('offer','offer.id','=','offer_contract.offer_id')
			->join('job_apply','job_apply.id','=','offer.job_apply_id')
            ->join('users','users.id','=','offer_contract.school_id')
            ->join('users as teacher','teacher.id','=','offer_contract.teacher_id')
			->where('offer_contract.teacher_id','=',$user_id)
			->where('offer_contract.school_status','=',2)
			->orderBy('offer_contract.id','desc')
			->paginate('12');
                        
    }



   public function school_document() {
        if(!empty($this->school_document) && file_exists('upload/contract/'.$this->school_document)) {
            return url('upload/contract/'.$this->school_document);
        }
        else {
            return '';
        }
    }


    public function teacher_document() {
        if(!empty($this->teacher_document) && file_exists('upload/contract/'.$this->teacher_document)) {
            return url('upload/contract/'.$this->teacher_document);
        }
        else {
            return '';
        }
    }

    public function admin_document() {
        if(!empty($this->admin_document) && file_exists('upload/contract/'.$this->admin_document)) {
            return url('upload/contract/'.$this->admin_document);
        }
        else {
            return '';
        }
    }


    public function school_admin_document() {
        if(!empty($this->school_admin_document) && file_exists('upload/contract/'.$this->school_admin_document)) {
            return url('upload/contract/'.$this->school_admin_document);
        }
        else {
            return '';
        }
    }


    



    public function offer() {
        return $this->belongsTo(OfferModel::class, 'offer_id', 'id');
    }

    public function school() {
        return $this->belongsTo(UsersModel::class, 'school_id', 'id');
    }

    public function teacher() {
        return $this->belongsTo(UsersModel::class, 'teacher_id', 'id');
    }

    public function contract_type() {
        return $this->belongsTo(ContractTypeModel::class, 'contract_type_id', 'id');
    }

    public function school_status_type() {
        return $this->belongsTo(ContractStatusModel::class, 'school_status', 'id');
    }

    public function teacher_status_type() {
        return $this->belongsTo(ContractStatusModel::class, 'teacher_status', 'id');
    }

   public function school_admin_status_type() {
        return $this->belongsTo(ContractStatusModel::class, 'school_admin_status', 'id');
    }

    

    


}
