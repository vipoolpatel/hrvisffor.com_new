<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VipulController extends Controller
{
    public function vipul()
    {
    	return view('backend.teacher.vipul.vipul');
    }
}
