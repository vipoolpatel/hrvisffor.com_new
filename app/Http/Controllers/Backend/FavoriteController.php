<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SaveTeacherModel;
use App\Models\SaveJobModel;

use Auth;

class FavoriteController extends Controller
{
    public function list()
    {
		if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
    	{
          
    	}
    	elseif(Auth::user()->is_admin == 3)
    	{	
    		$data['getRecord'] = SaveTeacherModel::getTeacher(Auth::user()->id);
    		return view('backend.school.favorite.list',$data);
    	}
		elseif(Auth::user()->is_admin == 4)
    	{
    		$data['getRecord'] = SaveJobModel::getJob(Auth::user()->id);
	        return view('backend.teacher.favorite.list',$data);
    	}
    }


    public function favorite_teacher_delete($id)
    {
		$delete =  SaveTeacherModel::get_single($id);
		$delete->delete();
		return redirect('school/favorite-teacher')->with('success', __("message.Record successfully Deleted"));
    }

    
    public function favorite_job_delete($id)
    {
		$delete =  SaveJobModel::get_single($id);
		$delete->delete();
		return redirect('teacher/favorite-job')->with('success', __("message.Record successfully Deleted"));
    }

    
}
