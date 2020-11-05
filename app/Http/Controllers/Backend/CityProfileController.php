<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CityModel;
use App\Models\CityProfileModel;
use App\Models\ClimateModel;
use App\Models\LivingCostModel;
use App\Models\CityProfileLivingCostModel;

use App\Models\CityProfileClimateModel;




use File;
use Image;
use Auth;
use Str;

class CityProfileController extends Controller
{
    public function city_profile($city_id = '',Request $request) {

    	$data['getCity'] = CityModel::get_single($city_id);

    	if(!empty($data['getCity']))
    	{
            $data['get_living_cost'] = LivingCostModel::get_record();
            $data['get_climate']     = ClimateModel::get_record();
    		$data['profile_city']    = CityProfileModel::where('city_id','=',$city_id)->first();

    		return view('backend.admin.city.manage',$data);  		
    	}
    	else
    	{
    		return redirect('admin/dashboard');
    	}

    }


    public function update_city_profile($city_id, Request $request)
    {
    	$checkRecord = CityProfileModel::where('city_id','=',$city_id)->count();
    	if($checkRecord == 0) {
    		$record = new CityProfileModel;
    	}
    	else {
    		$record = CityProfileModel::where('city_id','=',$city_id)->first();;
    	}

    	$record->title 			= $request->title;
    	$record->city_id 		= $city_id;
    	$record->about_city 	= $request->about_city;
    	$record->info_title 	= $request->info_title;
    	$record->more_info_city = $request->more_info_city;
        $record->living_cost_title  = $request->living_cost_title;
        $record->living_cost_info   = $request->living_cost_info;
        $record->climate_title      = $request->climate_title;


        


    	if (!empty($request->file('city_image'))) {

            if(!empty($record->city_image) && file_exists('upload/city/'.$record->city_image)) {
                unlink('upload/city/'.$record->city_image);
            }

            $ext 		= 'jpg';
            $file 		= $request->file('city_image');
            $randomStr  = Str::random(50);
            $filename 	= strtolower($randomStr) . '.' . $ext;
            $file->move('upload/city/', $filename);

            $record->city_image = $filename;

            $thumb_img 	= Image::make('upload/city/'.$filename)->resize(360, 360);
            $thumb_img->save('upload/city/' . $filename, 100);
        }


        if(!empty($request->file('city_video'))) {
            if(!empty($record->city_video) && file_exists('upload/city/'.$record->city_video)) {
                unlink('upload/city/'.$user->city_video);
            }

            $ext        = $request->file('city_video')->extension();
            $file       = $request->file('city_video');
            $randomStr  = date('YmdHis').Str::random(30);
            $filename   = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/city/', $filename);
            $record->city_video = $filename;
        }

    	
    	$record->save();

        CityProfileLivingCostModel::delete_data($record->id);

        if(!empty($request->living_cost))
        {
            foreach ($request->living_cost as $key => $value) {
                if(!empty($value))
                {
                    $new = new CityProfileLivingCostModel;
                    $new->living_cost_id  = $request->living_cost_id[$key];
                    $new->city_profile_id = $record->id;
                    $new->rmb_name        = $value;
                    $new->save();    
                }                
            }
        }

        CityProfileClimateModel::delete_data($record->id);

        if(!empty($request->climate_id))
        {
            foreach ($request->climate_id as $keys => $climate_id) {
                if(!empty($value)) {
                    if(!empty($request->low_high[$keys]) || !empty($request->rain[$keys]) || !empty($request->strom[$keys]))
                    {
                        $new = new CityProfileClimateModel;
                        $new->climate_id      = $climate_id;
                        $new->city_profile_id = $record->id;
                        $new->low_high        = !empty($request->low_high[$keys]) ? $request->low_high[$keys] : '';
                        $new->rain            = !empty($request->rain[$keys]) ? $request->rain[$keys] : '';
                        $new->strom           = !empty($request->strom[$keys]) ? $request->strom[$keys] :'';
                        $new->save();        
                    }
                }                
            }
        }

    	return redirect()->back()->with("success", __("message.Profile City Updated"));
    }



    


}
