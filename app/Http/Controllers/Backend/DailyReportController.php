<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DailyReportModel;
use Auth;

class DailyReportController extends Controller
{

    public function list()
    {
    	return view('backend.admin.daily_report.list');
    }

    public function add(Request $request)
    {
    	return view('backend.admin.daily_report.add');	
    }

    public function insert(Request $request)
    {

    	$report 			 = new DailyReportModel;
    	$report->user_id 	 = Auth::user()->id;
    	$report->title 		 = $request->title;
    	$report->description = $request->description;
    	$report->save();


    	return redirect('admin/daily-report')->with('success', "Daily Report Successfully created");

    }

}
