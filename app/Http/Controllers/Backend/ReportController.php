<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReportModel;
use App\Models\ReportStatusModel;
use App\Models\NotificationModel;
use App\Models\UsersModel;
use App\Models\AdminPermissionModel;

use App\Notifications\AdminSendReportUserNotification;

use Str;
use Auth;

class ReportController extends Controller
{
    
    // Teacher Report start
    public function report(Request $request) {


        if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
        {
            $check_permission = AdminPermissionModel::getPermission('report');
            if(empty($check_permission)) {
                 return redirect('admin/dashboard');
            }


            $data['get_status'] = ReportStatusModel::get_record();
            $data['get_report'] = ReportModel::get_report(Auth::user()->id);
            return view('backend.admin.report.list',$data);
        }
        else if(Auth::user()->is_admin == 3)
        {
            $data['get_report'] = ReportModel::get_school_report(Auth::user()->id);
            return view('backend.school.report.list',$data);  
        }   
        else if(Auth::user()->is_admin == 4)
        {
            $data['get_report'] = ReportModel::get_teacher_report(Auth::user()->id);
            return view('backend.teacher.report.list',$data);
        }
        
    }
   

    public function insert_report(Request $request)
    {
         $recoder               = new ReportModel;
         $recoder->user_id      = Auth::user()->id;
         $recoder->name         = trim($request->name);
         $recoder->email        = trim($request->email);
         $recoder->phone        = trim($request->phone);
         $recoder->title        = trim($request->title);
         $recoder->description  = $request->description;         
         $recoder->save();  


         if(Auth::user()->is_admin == 3)
         {
            $subject = ''.$recoder->user->school_name.' ('.$recoder->user->school_id.') send an report to Admin';
         }
         else if(Auth::user()->is_admin == 4)
         {
            $subject = ''.$recoder->user->name.' ('.$recoder->user->teacher_id.') send an report to Admin';
         }
                 
        $insert_data = array(
              'type'      => 'report',
              'common_id' => $recoder->id,
              'message'   => $subject,
        );

        NotificationModel::insert_data(Str::random(36),'App\Notifications\UserSendReportAdminNotification','App\Models\UsersModel','1',$insert_data);



         return redirect()->back()->with('success', __("message.Report successfully sent."));
    }


    public function change_report_status(Request $request)
    {
        $update          = ReportModel::get_single($request->id);
        $update->status  = $request->status;
        $update->save();
        

        $report = ReportModel::get_single($request->id);
        $user    = UsersModel::find($report->user_id);
        $subject = 'Your report have been '.$report->get_status->name.'';
        $user->notify(new AdminSendReportUserNotification($subject,$report));  


        $json['success'] = __("message.Status successfully changed");
        echo json_encode($json);
    }


    public function report_reject(Request $request)
    {
        $update          = ReportModel::get_single($request->id);
        $update->status  = 3;
        $update->reason  = $request->reason;
        $update->save();
        
        $report = ReportModel::get_single($request->id);
        $user    = UsersModel::find($report->user_id);
        $subject = 'Your report have been '.$report->get_status->name.' please check reason';
        $user->notify(new AdminSendReportUserNotification($subject,$report));  

        return redirect()->back()->with('success', __("message.Report successfully rejected."));
    }

    public function delete($id)
    {
        $delete =  ReportModel::get_single($id);
        $delete->delete();

        return redirect()->back()->with('success', __("message.Report successfully deleted.")); 
    }

// Admin Report End
   
}