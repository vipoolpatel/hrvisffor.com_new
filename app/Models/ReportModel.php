<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
class ReportModel extends Model
{
    protected $table = 'report';

    static public function get_record()
    {
        return self::get();
    }


    static public function get_single($id)
    {
        return self::find($id);
    }





    //teacher part

    static public function get_teacher_report($user_id)
    {
        return self::select('report.*')
            ->where('user_id','=',$user_id)
            ->orderBy('report.id','desc')
            ->paginate(12);
    }


    //school part

    static public function get_school_report($user_id)
    {
        return self::select('report.*')
            ->where('user_id','=',$user_id)
            ->orderBy('report.id','desc')
            ->paginate(12);
    }



    //admin part

    static public function get_report($user_id)
    {
        return self::select('report.*')
            ->join('users','users.id','=','report.user_id')
            ->orderBy('report.id','desc')
            ->paginate(12);
    }



    static public function getTotalReport($date = '') {
          $getTotalReport = self::select('report.*');
                if(!empty($date)) {
                    $getTotalReport = $getTotalReport->where(DB::raw("(DATE_FORMAT(report.created_at,'%Y-%m-%d'))"),"=", $date);
                }
                $getTotalReport = $getTotalReport->orderBy('report.id','desc')
                ->count();
        return $getTotalReport;
    }












    static public function get_record_count()
    {
        return self::get_record()->count();
    }

    static public function get_record_pagi($offset,$perpage)
    {
        return self::offset($offset)->limit($perpage)->get();
    }

    public function user()
    {
        return $this->belongsTo(UsersModel::class, "user_id");
    }

    public function get_status()
    {
        return $this->belongsTo(ReportStatusModel::class, "status");
    }


}