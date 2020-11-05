<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
class VisaModel extends Model
{
    protected $table = 'visa';

    static public function get_teacher_record($id)
    {
        return self::orderBy('order_by','asc')->where('user_id', '=', $id)->where('is_delete','=','0')->get();
    }

    static public function get_record()
    {
        return self::orderBy('order_by','asc')->where('user_id', '=', '0')->where('is_delete','=','0')->get();
    }

    static public function get_common_teacher_record($id)
    {
        return self::orderBy('order_by','asc')
                    ->where(function($q) use ($id) {
                        $q->where('type','=','teacher')
                        ->orWhere('user_id','=',$id);
                    })   
                    ->where('is_delete','=','0')
                    ->get();
    }


    // school data

    static public function get_common_school_record($id)
    {
        return self::orderBy('order_by','asc')
            ->where(function($q) use ($id) {
                $q->where('type','=','school')
                ->orWhere('user_id','=',$id);
            }) 
            ->where('is_delete','=','0')
            ->get();
    }






    static public function get_single($id)
    {
        return self::find($id);
    }

    static public function get_record_count()
    {
        return self::get_record()->where('user_id', '=', '0')->count();
    }

    static public function get_record_pagi($offset,$perpage)
    {
        return self::orderBy('order_by','asc')->where('user_id', '=', '0')->where('is_delete','=','0')->offset($offset)->limit($perpage)->get();
    }

    public function getName()
    {
    	return $this->name;
    }

    public function visa_info() {
        return $this->hasMany(VisaInformationModel::class, "visa_id");
    }

    public function count_teacher_document() {
        return $this->hasMany(UserVisaModel::class,'visa_id','id')->where('user_id','=',Auth::user()->id)->count();
    }

    public function get_teacher_document() {
        return $this->hasMany(UserVisaModel::class,'visa_id','id')->where('user_id','=',Auth::user()->id)->first();
    }


}
