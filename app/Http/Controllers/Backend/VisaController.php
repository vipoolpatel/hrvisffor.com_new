<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UsersModel;
use App\Models\CountryModel;

use App\Models\VisaModel;
use App\Models\UserVisaModel;
use App\Models\NotificationModel;

use Auth;
use Str;
use File;

class VisaController extends Controller
{
    public function visa(Request $require)
    {
        $data['user']         = UsersModel::get_single(Auth::user()->id);
        $data['get_country']  = CountryModel::get_record();

        if(Auth::user()->is_admin == 3)
        {
            $data['get_assign_visa'] = UserVisaModel::get_assign_visa(Auth::user()->id);
            $data['visa'] = VisaModel::get_common_school_record(Auth::user()->id);
            return view('backend.school.visa.list', $data);    
        }
        else if(Auth::user()->is_admin == 4)
        {
            $data['get_assign_visa'] = UserVisaModel::get_assign_visa(Auth::user()->id);
            $data['visa'] = VisaModel::get_common_teacher_record(Auth::user()->id);
            return view('backend.teacher.visa.list', $data);    
        }
    }

    public function visa_update(Request $request)
    {
    	if(!empty($request->file('document')))
    	{
    		$check = UserVisaModel::where('visa_id','=',$request->visa_id)->where('user_id','=',Auth::user()->id)->first();

    		if(!empty($check))
    		{
    			$visa =  UserVisaModel::get_single($check->id);
    		}
    		else
    		{
    			$visa = new UserVisaModel;	
    			$visa->user_id = Auth::user()->id;
    			$visa->visa_id = $request->visa_id;
    		}
			
            $ext           = $request->file('document')->extension();
            $file          = $request->file('document');
            $randomStr     = date('YmdHis').Str::random(30);
            $filename      = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/visa/', $filename);
            $visa->document = $filename;
			$visa->save();

            if(Auth::user()->is_admin == 3)
            {
                $subject = ''.$visa->user->school_name.' ('.$visa->user->school_id.') send an Visa to Admin';
            }
            else
            {
                $subject = ''.$visa->user->name.' ('.$visa->user->teacher_id.') send an Visa to Admin';                
            }

            $insert_data = array(
                'type'      => 'visa',
                'common_id' => $visa->id,
                'message'   => $subject,
            );


            NotificationModel::insert_data(Str::random(36),'App\Notifications\TeacherSchoolSendVisaAdminNotification','App\Models\UsersModel','1',$insert_data);

			return redirect()->back()->with('success', __("message.Document successfully save."));

    	}
    	else
    	{
    		return redirect()->back()->with('error', __("message.Due to some error pelase try again"));	
    	}
    }

    // school part

    public function china_system_update(Request $request)
    {
        $user = UsersModel::get_single(Auth::user()->id);
        $user->china_system = $request->china_system;

        if($request->china_system == 'Yes')
        {
            $user->account_info  = $request->account_info;
            $user->password_info = $request->password_info;    
        }
        else
        {
            $user->account_info  = '';
            $user->password_info = ''; 
        }

        $user->save();

        return redirect()->back()->with('success', __("message.Information successfully save."));
    }

}
