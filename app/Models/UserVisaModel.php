<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserVisaModel extends Model
{

	protected $table = 'user_visa';

    static public function get_record()
    {
        return self::orderBy('id','asc')->get();
    }

    static public function get_single($id)
    {
        return self::find($id);
    }

    static function get_user_visa($id) {
    	return self::where('user_id','=',$id)->get();	
    }


    static public function get_assign_visa($user_id)
    {
        return self::where('user_assign_id','=',$user_id)->where('status','=',2)->get();        
    }

    public function visa(){
        return $this->belongsTo(VisaModel::class,'visa_id','id');
    }

    public function user(){
        return $this->belongsTo(UsersModel::class,'user_id','id');
    }

    public function getstatus(){
        return $this->belongsTo(VisaStatusModel::class,'status');
    }

    public function getDocument() {
        if(!empty($this->document) && file_exists('upload/visa/'.$this->document)) {
            return url('upload/visa/'.$this->document);
        }
        else {
            return '';
        }
    }


}
