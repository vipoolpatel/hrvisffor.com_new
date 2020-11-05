<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UsersModel;
use App\Models\NationalityModel;
use App\Models\StateModel;
use App\Models\CountryModel;
use App\Models\CityModel;
use App\Models\SalaryModel;
use App\Models\CurrentLocationModel;
use App\Models\EducationLevelModel;
use App\Models\PositionModel;
use App\Models\JobTypeModel;
use App\Models\StartDateModel;
use App\Models\SchoolTypeModel;
use App\Models\AreaModel;
use App\Models\LivingCostModel;
use App\Models\CurrentVisaTypeModel;
use App\Models\CardColourModel;
use App\Models\TeacherTypeModel;
use App\Models\ColourModel;
use App\Models\CreditLevelModel;
use App\Models\EmergencyLevelModel;
use App\Models\AdminPermissionModel;
use App\Models\FaqCategoryModel;
use App\Models\FaqModel;
use App\Models\VisaModel;
use App\Models\VisaInformationModel;
use App\Models\SettingModel;
use File;
use Str;
use Image;




class PageController extends Controller {

	
	public function manage() {

		$check_permission = AdminPermissionModel::getPermission('manage');
        if(empty($check_permission)) {
            return redirect('admin/dashboard');
        }

		return view('backend.admin.page.manage');
	}

	// setting start

	public function setting() {
		$data['record'] = SettingModel::get_single(1);
		return view('backend.admin.page.setting.list',$data);
	}

	public function update_setting(Request $request)
	{
		$record = SettingModel::get_single(1);


	   if(!empty($request->file('contract_document'))) {

            if(!empty($record->contract_document) && file_exists('upload/setting/'.$record->contract_document)) {
                unlink('upload/setting/'.$record->contract_document);
            }

           $ext           = $request->file('contract_document')->extension();
           $file          = $request->file('contract_document');
           $randomStr     = date('YmdHis').Str::random(30);
           $filename      = strtolower($randomStr) . '.' . $ext;
           $file->move('upload/setting/', $filename);
           $record->contract_document = $filename;

        }

	   if(!empty($request->file('handbook'))) {

            if(!empty($Record->handbook) && file_exists('upload/setting/'.$record->handbook)) {
                unlink('upload/setting/'.$record->handbook);
            }

           $ext           = $request->file('handbook')->extension();
           $file          = $request->file('handbook');
           $randomStr     = date('YmdHis').Str::random(30);
           $filename      = strtolower($randomStr) . '.' . $ext;
           $file->move('upload/setting/', $filename);
           $record->handbook = $filename;

        }


        $record->save();
        
        return redirect('admin/setting')->with('success', __("message.Record successfully save"));

	}

	// end setting start


	// Area Start
	public function area() {
		return view('backend.admin.page.area.list');
	}

	public function get_area_list(Request $request) {
		$perpage = $request->pagination['perpage'];
		$page = $request->pagination['page'];
		$offset = ($page - 1) * $perpage;

		$get_record_count = AreaModel::get_record_count();
		$lastPage = ceil($get_record_count / $perpage);

		$get_area = AreaModel::get_record_pagi($offset, $perpage);
		$result = array();
		foreach ($get_area as $key => $value) {
			$data['id'] = $value->id;
			$data['name'] = $value->name;
			$data['ch_name'] = !empty($value->ch_name) ? $value->ch_name : '';

			$data['action'] = '<a href="' . url('admin/area/edit/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon-edit-1"></i>
                     </a>
                     <a href="' . url('admin/area/delete/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon2-trash"></i>
                     </a>   ';
			$result[] = $data;
		}

		$meta['page'] = $page;
		$meta['pages'] = $lastPage;
		$meta['perpage'] = $perpage;
		$meta['total'] = $get_record_count;
		$json['meta'] = $meta;
		$json['data'] = $result;

		echo json_encode($json);

	}
	public function add_area() {
		return view('backend.admin.page.area.add');
	}

	public function insert_update_area($id = '', Request $request) {
		$record = request()->validate([
			'name' => 'required|max:120',
		]);

		if(!empty($id))
		{
			$record = AreaModel::find($id);
		}
		else
		{
			$record = new AreaModel;	
		}

		
		$record->name = trim($request->name);
		$record->ch_name = trim($request->ch_name);
		$record->save();
		return redirect('admin/area')->with('success', __("message.Record successfully save"));
	}

	public function edit_area($id)
	{
		$data['record'] = AreaModel::get_single($id);
		return view('backend.admin.page.area.edit', $data);
	}

	public function delete_area($id)
	{
		echo "<h1>Delete Area</h1>";
		die();
	}
	// area End


	// Living Cost Start
	public function livingcost() {
		return view('backend.admin.page.livingcost.list');
	}

	public function get_livingcost_list(Request $request) {
		$perpage = $request->pagination['perpage'];
		$page = $request->pagination['page'];
		$offset = ($page - 1) * $perpage;

		$get_record_count = LivingCostModel::get_record_count();
		$lastPage = ceil($get_record_count / $perpage);

		$get_livingcost = LivingCostModel::get_record_pagi($offset, $perpage);
		$result = array();
		foreach ($get_livingcost as $key => $value) {
			$data['id'] = $value->id;
			$data['name'] = $value->name;
			$data['ch_name'] = !empty($value->ch_name) ? $value->ch_name : '';

			$data['action'] = '<a href="' . url('admin/livingcost/edit/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon-edit-1"></i>
                     </a>
                     <a href="' . url('admin/livingcost/delete/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon2-trash"></i>
                     </a>   ';
			$result[] = $data;
		}

		$meta['page'] = $page;
		$meta['pages'] = $lastPage;
		$meta['perpage'] = $perpage;
		$meta['total'] = $get_record_count;
		$json['meta'] = $meta;
		$json['data'] = $result;

		echo json_encode($json);

	}
	public function add_livingcost() {
		return view('backend.admin.page.livingcost.add');
	}

	public function insert_update_livingcost($id = '', Request $request) {
		$record = request()->validate([
			'name' => 'required|max:120',
		]);

		if(!empty($id))
		{
			$record = LivingCostModel::find($id);
		}
		else
		{
			$record = new LivingCostModel;	
		}

		
		$record->name = trim($request->name);
		$record->ch_name = trim($request->ch_name);
		$record->save();
		return redirect('admin/livingcost')->with('success', __("message.Record successfully save"));
	}

	public function edit_livingcost($id)
	{
		$data['record'] = LivingCostModel::get_single($id);
		return view('backend.admin.page.livingcost.edit', $data);
	}

	public function delete_livingcost($id)
	{
		$record = LivingCostModel::get_single($id);
		$record->is_delete = 1;
		$record->save();

		return redirect('admin/livingcost')->with('success', __("message.Record successfully deleted"));	
	}
	// Living Cost End



	// Emergency Level Start
	public function emergencylevel() {
		return view('backend.admin.page.emergencylevel.list');
	}

	public function get_emergencylevel_list(Request $request) {
		$perpage = $request->pagination['perpage'];
		$page = $request->pagination['page'];
		$offset = ($page - 1) * $perpage;

		$get_record_count = EmergencyLevelModel::get_record_count();
		$lastPage = ceil($get_record_count / $perpage);

		$get_area = EmergencyLevelModel::get_record_pagi($offset, $perpage);
		$result = array();
		foreach ($get_area as $key => $value) {
			$data['id'] = $value->id;
			$data['name'] = $value->name;
			$data['ch_name'] = !empty($value->ch_name) ? $value->ch_name : '';

			$data['action'] = '<a href="' . url('admin/emergencylevel/edit/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon-edit-1"></i>
                     </a>
                     <a href="' . url('admin/emergencylevel/delete/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon2-trash"></i>
                     </a>   ';
			$result[] = $data;
		}

		$meta['page'] = $page;
		$meta['pages'] = $lastPage;
		$meta['perpage'] = $perpage;
		$meta['total'] = $get_record_count;
		$json['meta'] = $meta;
		$json['data'] = $result;

		echo json_encode($json);

	}
	public function add_emergencylevel() {
		return view('backend.admin.page.emergencylevel.add');
	}

	public function insert_update_emergencylevel($id = '', Request $request) {
		$record = request()->validate([
			'name' => 'required|max:120',
		]);

		if(!empty($id))
		{
			$record = EmergencyLevelModel::find($id);
		}
		else
		{
			$record = new EmergencyLevelModel;	
		}

		
		$record->name = trim($request->name);
		$record->ch_name = trim($request->ch_name);
		$record->save();
		return redirect('admin/emergencylevel')->with('success', __("message.Record successfully save"));
	}

	public function edit_emergencylevel($id)
	{
		$data['record'] = EmergencyLevelModel::get_single($id);
		return view('backend.admin.page.emergencylevel.edit', $data);
	}

	public function delete_emergencylevel($id)
	{
	
		$record = EmergencyLevelModel::get_single($id);
		$record->is_delete = 1;
		$record->save();

		return redirect('admin/emergencylevel')->with('success', __("message.Record successfully deleted"));	

	}
	// area End






	// Area Start
	public function creditlevel() {
		return view('backend.admin.page.creditlevel.list');
	}

	public function get_creditlevel_list(Request $request) {
		$perpage = $request->pagination['perpage'];
		$page = $request->pagination['page'];
		$offset = ($page - 1) * $perpage;

		$get_record_count = CreditLevelModel::get_record_count();
		$lastPage = ceil($get_record_count / $perpage);

		$get_area = CreditLevelModel::get_record_pagi($offset, $perpage);
		$result = array();
		foreach ($get_area as $key => $value) {
			$data['id'] = $value->id;
			$data['name'] = $value->name;
			$data['ch_name'] = !empty($value->ch_name) ? $value->ch_name : '';

			$data['action'] = '<a href="' . url('admin/creditlevel/edit/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon-edit-1"></i>
                     </a>
                     <a href="' . url('admin/creditlevel/delete/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon2-trash"></i>
                     </a>   ';
			$result[] = $data;
		}

		$meta['page'] = $page;
		$meta['pages'] = $lastPage;
		$meta['perpage'] = $perpage;
		$meta['total'] = $get_record_count;
		$json['meta'] = $meta;
		$json['data'] = $result;

		echo json_encode($json);

	}
	public function add_creditlevel() {
		return view('backend.admin.page.creditlevel.add');
	}

	public function insert_update_creditlevel($id = '', Request $request) {
		$record = request()->validate([
			'name' => 'required|max:120',
		]);

		if(!empty($id))
		{
			$record = CreditLevelModel::find($id);
		}
		else
		{
			$record = new CreditLevelModel;	
		}

		
		$record->name = trim($request->name);
		$record->ch_name = trim($request->ch_name);
		$record->save();
		return redirect('admin/creditlevel')->with('success', __("message.Record successfully save"));
	}

	public function edit_creditlevel($id)
	{
		$data['record'] = CreditLevelModel::get_single($id);
		return view('backend.admin.page.creditlevel.edit', $data);
	}

	public function delete_creditlevel($id)
	{
		$record = CreditLevelModel::get_single($id);
		$record->is_delete = 1;
		$record->save();

		return redirect('admin/creditlevel')->with('success', __("message.Record successfully deleted"));	
	}

	// Creditlevel End




	// Cardcolour Start
	public function cardcolour() {
		return view('backend.admin.page.cardcolour.list');
	}

	public function get_cardcolour_list(Request $request) {
		$perpage = $request->pagination['perpage'];
		$page = $request->pagination['page'];
		$offset = ($page - 1) * $perpage;

		$get_record_count = CardColourModel::get_record_count();
		$lastPage = ceil($get_record_count / $perpage);

		$get_area = CardColourModel::get_record_pagi($offset, $perpage);
		$result = array();
		foreach ($get_area as $key => $value) {
			$data['id'] = $value->id;
			$data['name'] = $value->name;
			$data['ch_name'] = !empty($value->ch_name) ? $value->ch_name : '';

			$data['action'] = '<a href="' . url('admin/cardcolour/edit/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon-edit-1"></i>
                     </a>
                     <a href="' . url('admin/cardcolour/delete/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon2-trash"></i>
                     </a>   ';
			$result[] = $data;
		}

		$meta['page'] = $page;
		$meta['pages'] = $lastPage;
		$meta['perpage'] = $perpage;
		$meta['total'] = $get_record_count;
		$json['meta'] = $meta;
		$json['data'] = $result;

		echo json_encode($json);

	}
	public function add_cardcolour() {
		return view('backend.admin.page.cardcolour.add');
	}

	public function insert_update_cardcolour($id = '', Request $request) {
		$record = request()->validate([
			'name' => 'required|max:120',
		]);

		if(!empty($id))
		{
			$record = CardColourModel::find($id);
		}
		else
		{
			$record = new CardColourModel;	
		}

		
		$record->name = trim($request->name);
		$record->ch_name = trim($request->ch_name);
		$record->save();
		return redirect('admin/cardcolour')->with('success', __("message.Record successfully save"));
	}

	public function edit_cardcolour($id)
	{
		$data['record'] = CardColourModel::get_single($id);
		return view('backend.admin.page.cardcolour.edit', $data);
	}

	public function delete_cardcolour($id)
	{
		$save = CardColourModel::get_single($id);
		$save->is_delete = 1;
		$save->save();
		return redirect('admin/cardcolour')->with('success', __("message.Record successfully deleted"));
	}
	// Card Colour End





	// Teacher Type Start

	public function teachertype() {
		return view('backend.admin.page.teachertype.list');
	}

	public function get_teachertype_list(Request $request) {
		$perpage = $request->pagination['perpage'];
		$page = $request->pagination['page'];
		$offset = ($page - 1) * $perpage;

		$get_record_count = TeacherTypeModel::get_record_count();
		$lastPage = ceil($get_record_count / $perpage);

		$get_area = TeacherTypeModel::get_record_pagi($offset, $perpage);
		$result = array();
		foreach ($get_area as $key => $value) {
			$data['id'] = $value->id;
			$data['name'] = $value->name;
			$data['ch_name'] = !empty($value->ch_name) ? $value->ch_name : '';

			$data['action'] = '<a href="' . url('admin/teachertype/edit/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon-edit-1"></i>
                     </a>
                     <a href="' . url('admin/teachertype/delete/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon2-trash"></i>
                     </a>   ';
			$result[] = $data;
		}

		$meta['page'] = $page;
		$meta['pages'] = $lastPage;
		$meta['perpage'] = $perpage;
		$meta['total'] = $get_record_count;
		$json['meta'] = $meta;
		$json['data'] = $result;

		echo json_encode($json);

	}
	public function add_teachertype() {
		return view('backend.admin.page.teachertype.add');
	}

	public function insert_update_teachertype($id = '', Request $request) {
		$record = request()->validate([
			'name' => 'required|max:120',
		]);

		if(!empty($id))
		{
			$record = TeacherTypeModel::find($id);
		}
		else
		{
			$record = new TeacherTypeModel;	
		}

		
		$record->name = trim($request->name);
		$record->ch_name = trim($request->ch_name);
		$record->save();
		return redirect('admin/teachertype')->with('success', __("message.Record successfully save"));
	}

	public function edit_teachertype($id)
	{
		$data['record'] = TeacherTypeModel::get_single($id);
		return view('backend.admin.page.teachertype.edit', $data);
	}

	public function delete_teachertype($id)
	{
		$save = TeacherTypeModel::get_single($id);
		$save->is_delete = 1;
		$save->save();
		return redirect('admin/teachertype')->with('success', __("message.Record successfully deleted"));
	}

	// Teacher Type End


	// Colour Start

	public function colour() {
		return view('backend.admin.page.colour.list');
	}

	public function get_colour_list(Request $request) {
		$perpage = $request->pagination['perpage'];
		$page = $request->pagination['page'];
		$offset = ($page - 1) * $perpage;

		$get_record_count = ColourModel::get_record_count();
		$lastPage = ceil($get_record_count / $perpage);

		$get_area = ColourModel::get_record_pagi($offset, $perpage);
		$result = array();
		foreach ($get_area as $key => $value) {
			$data['id'] = $value->id;
			$data['name'] = $value->name;
			$data['ch_name'] = !empty($value->ch_name) ? $value->ch_name : '';

			$data['action'] = '<a href="' . url('admin/colour/edit/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon-edit-1"></i>
                     </a>
                     <a href="' . url('admin/colour/delete/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon2-trash"></i>
                     </a>   ';
			$result[] = $data;
		}

		$meta['page'] = $page;
		$meta['pages'] = $lastPage;
		$meta['perpage'] = $perpage;
		$meta['total'] = $get_record_count;
		$json['meta'] = $meta;
		$json['data'] = $result;

		echo json_encode($json);

	}
	public function add_colour() {
		return view('backend.admin.page.colour.add');
	}

	public function insert_update_colour($id = '', Request $request) {
		$record = request()->validate([
			'name' => 'required|max:120',
		]);

		if(!empty($id))
		{
			$record = ColourModel::find($id);
		}
		else
		{
			$record = new ColourModel;	
		}

		
		$record->name = trim($request->name);
		$record->ch_name = trim($request->ch_name);
		$record->save();
		return redirect('admin/colour')->with('success', __("message.Record successfully save"));
	}

	

	public function edit_colour($id)
	{
		$data['record'] = ColourModel::get_single($id);
		return view('backend.admin.page.colour.edit', $data);
	}

	public function delete_colour($id)
	{
		$save = ColourModel::get_single($id);
		$save->is_delete = 1;
		$save->save();
		return redirect('admin/colour')->with('success', __("message.Record successfully deleted"));
	}

	// Teacher Type End



	// position Start
	public function position() {
		return view('backend.admin.page.position.list');
	}
	public function get_position_list(Request $request) {
		$perpage = $request->pagination['perpage'];
		$page = $request->pagination['page'];
		$offset = ($page - 1) * $perpage;

		$get_record_count = PositionModel::get_record_count();
		$lastPage = ceil($get_record_count / $perpage);

		$get_area = PositionModel::get_record_pagi($offset, $perpage);
		$result = array();
		foreach ($get_area as $key => $value) {
			$data['id'] = $value->id;
			$data['name'] = $value->name;
			$data['ch_name'] = !empty($value->ch_name) ? $value->ch_name : '';

			$data['action'] = '<a href="' . url('admin/position/edit/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon-edit-1"></i>
                     </a>
                     <a href="' . url('admin/position/delete/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon2-trash"></i>
                     </a>   ';

			$result[] = $data;
		}

		$meta['page'] = $page;
		$meta['pages'] = $lastPage;
		$meta['perpage'] = $perpage;
		$meta['total'] = $get_record_count;

		$json['meta'] = $meta;

		$json['data'] = $result;

		echo json_encode($json);
	}

	public function add_position() {
		return view('backend.admin.page.position.add');
	}
	public function insert_update_position($id = '', Request $request) {
		$record = request()->validate([
			'name' => 'required|max:120',
		]);

	   if(!empty($id))
		{
			$record = PositionModel::find($id);
		}
		else
		{
			$record = new PositionModel;	
		}

		$record->name = trim($request->name);
		$record->ch_name = trim($request->ch_name);
		$record->save();
		return redirect('admin/position')->with('success', __("message.Record successfully save"));
	}
	public function edit_position($id)
	{
		$data['record'] = PositionModel::get_single($id);
		return view('backend.admin.page.position.edit', $data);
	}
	public function delete_position()
	{
		echo "<h1>Delete Position</h1>";
		die();
	}
	// position End
	// nationality start
	public function nationality() {

		// $get_record = NationalityModel::get_record();
		// foreach ($get_record as $key => $value) {

		// 	if(!empty($value->getImage()))	
		// 	{

		// 		$nationality = NationalityModel::get_single($value->id);
		// 		$nationality->image_name = $value->alpha_2_code.'.svg';
		// 		$nationality->save();
		// 	}
		// }
		// die;

		return view('backend.admin.page.nationality.list');
	}
	public function get_nationality_list(Request $request) {
		$perpage = $request->pagination['perpage'];
		$page = $request->pagination['page'];
		$offset = ($page - 1) * $perpage;

		$get_record_count = NationalityModel::get_record_count();
		$lastPage = ceil($get_record_count / $perpage);

		$get_area = NationalityModel::get_record_pagi($offset, $perpage);
		$result = array();
		foreach ($get_area as $key => $value) {
			$data['id'] = $value->id;
			if(!empty($value->getImage()))
			{
				$data['icon'] = "<img style='height: 22px;' src=".$value->getImage().">";	
			}
			else
			{
				$data['icon'] = '';
			}
			
			$data['name'] = $value->name;
			$data['ch_name'] = !empty($value->ch_name) ? $value->ch_name : '';
			$data['is_native'] = !empty($value->is_native) ? 'Yes' : 'No';
			

			$data['action'] = '<a href="' . url('admin/nationality/edit/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon-edit-1"></i>
                     </a>
                     <a href="' . url('admin/nationality/delete/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon2-trash"></i>
                     </a>   ';

			$result[] = $data;
		}

		$meta['page'] = $page;
		$meta['pages'] = $lastPage;
		$meta['perpage'] = $perpage;
		$meta['total'] = $get_record_count;

		$json['meta'] = $meta;

		$json['data'] = $result;

		echo json_encode($json);
	}

	public function add_nationality() {
		return view('backend.admin.page.nationality.add');
	}

	public function insert_update_nationality($id = '', Request $request) {
		$record = request()->validate([
			'name' => 'required|max:120',
		]);
		
		if(!empty($id))
		{
			$record = NationalityModel::find($id);
		}
		else
		{
			$record = new NationalityModel;	
		}


		$record->name = trim($request->name);
		$record->ch_name = trim($request->ch_name);
		$record->is_native = trim($request->is_native);


		if (!empty($request->file('image_name'))) {

            if(!empty($record->image_name) && file_exists('upload/country/'.$record->image_name))
            {
                unlink('upload/country/'.$record->image_name);
            }

            $ext = 'jpg';
            $file = $request->file('image_name');
            $randomStr = Str::random(50);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/country/', $filename);

            $record->image_name = $filename;

            $thumb_img = Image::make('upload/country/'.$filename)->resize(100, 100);
            $thumb_img->save('upload/country/' . $filename, 100);
        }

		


		$record->save();
		return redirect('admin/nationality')->with('success', __("message.Record successfully save"));
	}
	public function edit_nationality($id)
	{
		$data['record'] = NationalityModel::get_single($id);
		return view('backend.admin.page.nationality.edit', $data);
	}
	public function delete_nationality($id)
	{
		echo "<h1>Delete Nationality</h1>";
		die();
	}
	// nationality End
	// cities start
	public function cities()
	{
		return view('backend.admin.page.cities.list');
	}
	public function get_cities_list(Request $request) {
		$perpage = $request->pagination['perpage'];
		$page = $request->pagination['page'];
		$offset = ($page - 1) * $perpage;

		$get_record_count = CityModel::get_record_count();
		$lastPage = ceil($get_record_count / $perpage);

		$get_area = CityModel::get_record_pagi($offset, $perpage);
		$result = array();
		foreach ($get_area as $key => $value) {
			$data['id'] = $value->id;
			$data['name'] = $value->name;
			$data['ch_name'] = !empty($value->ch_name) ? $value->ch_name : '';
			$data['state_id'] = !empty($value->getstate->name) ? $value->getstate->name : '';

			$data['action'] = '<a href="' . url('admin/cities/edit/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon-edit-1"></i>
                     </a>
                     <a href="' . url('admin/cities/delete/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon2-trash"></i>
                     </a>   
                     <a href="' . url('admin/city-profile/' . $value->id) . '" class="btn btn-light btn-hover-primary btn-sm">
                        City Profile
                     </a>   

                     ';

			$result[] = $data;
		}

		$meta['page'] = $page;
		$meta['pages'] = $lastPage;
		$meta['perpage'] = $perpage;
		$meta['total'] = $get_record_count;

		$json['meta'] = $meta;

		$json['data'] = $result;

		echo json_encode($json);
	}


	public function add_cities()
	{
	
		$data['get_state'] = StateModel::get_state_country(44);
		return view('backend.admin.page.cities.add', $data);
	}
	public function insert_update_cities($id = '', Request $request) {
		$record = request()->validate([
			'name' => 'required|max:120',
			'state_id' => 'required'
		]);

		if(!empty($id))
		{
			$record = CityModel::find($id);
		}
		else
		{
			$record = new CityModel;	
		}

		
		$record->name = trim($request->name);
		$record->ch_name = trim($request->ch_name);
		$record->state_id = trim($request->state_id);
		$record->save();
		return redirect('admin/cities')->with('success', __("message.Record successfully save"));
	}

	public function edit_cities($id)
	{
		$data['record'] = CityModel::get_single($id);
		$data['get_state'] = StateModel::get_record();
		return view('backend.admin.page.cities.edit', $data);
	}
	public function delete_cities($id)
	{		
		$save = CityModel::get_single($id);
		$save->is_delete = 1;
		$save->save();
		return redirect('admin/cities')->with('success', __("message.Record successfully deleted"));		
	}
	
	// cities end
	// countries start
	public function countries()
	{
			return view('backend.admin.page.countries.list');
	}
	public function get_countries_list(Request $request)
	{
		$perpage = $request->pagination['perpage'];
		$page = $request->pagination['page'];
		$offset = ($page - 1) * $perpage;

		$get_record_count = CountryModel::get_record_count();
		$lastPage = ceil($get_record_count / $perpage);

		$get_area = CountryModel::get_record_pagi($offset, $perpage);
		$result = array();
		foreach ($get_area as $key => $value) {
			$data['id'] = $value->id;
			$data['name'] = $value->name;
			$data['ch_name'] = !empty($value->ch_name) ? $value->ch_name : '';
		
			$data['action'] = '<a href="' . url('admin/countries/edit/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon-edit-1"></i>
                     </a>
                     <a href="' . url('admin/countries/delete/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon2-trash"></i>
                     </a>   ';

			$result[] = $data;
		}

		$meta['page'] = $page;
		$meta['pages'] = $lastPage;
		$meta['perpage'] = $perpage;
		$meta['total'] = $get_record_count;

		$json['meta'] = $meta;

		$json['data'] = $result;

		echo json_encode($json);
	}

	public function add_countries()
	{
		return view('backend.admin.page.countries.add');
	}
	public function insert_update_countries($id = '', Request $request) {
		$record = request()->validate([
			'name' => 'required|max:120',
		]);
		if(!empty($id))
		{
			$record = CountryModel::find($id);
		}
		else
		{
			$record = new CountryModel;	
		}

		$record->name = trim($request->name);
		$record->ch_name = trim($request->ch_name);
		$record->save();
		return redirect('admin/countries')->with('success', __("message.Record successfully save"));
	}
	public function edit_countries($id)
	{
		$data['record'] = CountryModel::get_single($id);
	    return view('backend.admin.page.countries.edit', $data);
	}
	public function delete_countries($id)
	{
		echo "<h1>Delete Countries</h1>";
		die();
	}
	// countries End

	// current location start

	public function current_location()
	{
		return view('backend.admin.page.current_location.list');
	}
	public function get_current_location_list(Request $request)
	{
		$perpage = $request->pagination['perpage'];
		$page = $request->pagination['page'];
		$offset = ($page - 1) * $perpage;

		$get_record_count = CurrentLocationModel::get_record_count();
		$lastPage = ceil($get_record_count / $perpage);

		$get_area = CurrentLocationModel::get_record_pagi($offset, $perpage);
		$result = array();
		foreach ($get_area as $key => $value) {
			$data['id'] = $value->id;
			$data['name'] = $value->name;
			$data['ch_name'] = !empty($value->ch_name) ? $value->ch_name : '';
		
			$data['action'] = '<a href="' . url('admin/current-location/edit/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon-edit-1"></i>
                     </a>
                     <a href="' . url('admin/current-location/delete/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon2-trash"></i>
                     </a>   ';

			$result[] = $data;
		}

		$meta['page'] = $page;
		$meta['pages'] = $lastPage;
		$meta['perpage'] = $perpage;
		$meta['total'] = $get_record_count;

		$json['meta'] = $meta;

		$json['data'] = $result;

		echo json_encode($json);
	}

	public function add_current_location()
	{
		return view('backend.admin.page.current_location.add');
	}
	public function insert_update_current_location($id = '', Request $request) {
		$record = request()->validate([
			'name' => 'required|max:120',
		]);

		if(!empty($id))
		{
			$record = CurrentLocationModel::find($id);
		}
		else
		{
			$record = new CurrentLocationModel;	
		}

		$record->name = trim($request->name);
		$record->ch_name = trim($request->ch_name);
		$record->save();
		return redirect('admin/current-location')->with('success', __("message.Record successfully save"));
	}
	public function edit_current_location($id)
	{
		$data['record'] = CurrentLocationModel::get_single($id);
		return view('backend.admin.page.current_location.edit', $data);
	}
	public function delete_current_location($id)
	{
		echo "<h1>Delete Current Location</h1>";
		die();
	}
	// current location End
	// Current Visa Type Start

	public function current_visa_type()
	{
		return view('backend.admin.page.current_visa_type.list');
	}

	public function get_current_visa_type_list(Request $request)
	{
		$perpage = $request->pagination['perpage'];
		$page = $request->pagination['page'];
		$offset = ($page - 1) * $perpage;

		$get_record_count = CurrentVisaTypeModel::get_record_count();
		$lastPage = ceil($get_record_count / $perpage);

		$get_area = CurrentVisaTypeModel::get_record_pagi($offset, $perpage);
		$result = array();
		foreach ($get_area as $key => $value) {
			$data['id'] = $value->id;
			$data['name'] = $value->name;
			$data['ch_name'] = !empty($value->ch_name) ? $value->ch_name : '';
		
			$data['action'] = '<a href="' . url('admin/current-visa-type/edit/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon-edit-1"></i>
                     </a>
                     <a href="' . url('admin/current-visa-type/delete/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon2-trash"></i>
                     </a>   ';

			$result[] = $data;
		}

		$meta['page'] = $page;
		$meta['pages'] = $lastPage;
		$meta['perpage'] = $perpage;
		$meta['total'] = $get_record_count;

		$json['meta'] = $meta;

		$json['data'] = $result;

		echo json_encode($json);
	}

	public function add_current_visa_type()
	{
		return view('backend.admin.page.current_visa_type.add');
	}

	public function insert_update_current_visa_type($id = '', Request $request) {
		$record = request()->validate([
			'name' => 'required|max:120',
		]);
		if(!empty($id))
		{
			$record = CurrentVisaTypeModel::find($id);
		}
		else
		{
			$record = new CurrentVisaTypeModel;	
		}

		$record->name = trim($request->name);
		$record->ch_name = trim($request->ch_name);
		$record->save();
		return redirect('admin/current-visa-type')->with('success', __("message.Record successfully save"));
	}
	public function edit_current_visa_type($id)
	{
		$data['record'] = CurrentVisaTypeModel::get_single($id);
		return view('backend.admin.page.current_visa_type.edit', $data);
	}
	public function delete_current_visa_type($id)
	{
		echo "<h1>Delete Current Visa Type</h1>";
		die();
	}
	// Current Visa Type end

	// Education Level Start
	public function education_level()
	{
		return view('backend.admin.page.education_level.list');
	}
	public function get_education_level_list(Request $request)
	{
		$perpage = $request->pagination['perpage'];
		$page = $request->pagination['page'];
		$offset = ($page - 1) * $perpage;

		$get_record_count = EducationLevelModel::get_record_count();
		$lastPage = ceil($get_record_count / $perpage);

		$get_area = EducationLevelModel::get_record_pagi($offset, $perpage);
		$result = array();
		foreach ($get_area as $key => $value) {
			$data['id'] = $value->id;
			$data['name'] = $value->name;
			$data['ch_name'] = !empty($value->ch_name) ? $value->ch_name : '';
		
			$data['action'] = '<a href="' . url('admin/education-level/edit/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon-edit-1"></i>
                     </a>
                     <a href="' . url('admin/education-level/delete/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon2-trash"></i>
                     </a>   ';

			$result[] = $data;
		}

		$meta['page'] = $page;
		$meta['pages'] = $lastPage;
		$meta['perpage'] = $perpage;
		$meta['total'] = $get_record_count;

		$json['meta'] = $meta;

		$json['data'] = $result;

		echo json_encode($json);
	}
	public function add_education_level()
	{
		return view('backend.admin.page.education_level.add');
	}
	public function insert_update_education_level($id = '', Request $request)
	{
		$record = request()->validate([
			'name' => 'required|max:120',
		]);

		if(!empty($id))
		{
			$record = EducationLevelModel::find($id);
		}
		else
		{
			$record = new EducationLevelModel;	
		}

		$record->name = trim($request->name);
		$record->ch_name = trim($request->ch_name);
		$record->save();
		return redirect('admin/education-level')->with('success', __("message.Record successfully save"));
	}
	public function edit_education_level($id)
	{
		$data['record'] = EducationLevelModel::get_single($id);
		return view('backend.admin.page.education_level.edit', $data);
	}
	public function delete_education_level($id)
	{
		echo "<h1>Delete Education Level</h1>";
		die();
	}

	// Education Level End

	// Job Type Start
		public function job_type()
	{
		return view('backend.admin.page.job_type.list');
	}
	public function get_job_type_list(Request $request)
	{
		$perpage = $request->pagination['perpage'];
		$page = $request->pagination['page'];
		$offset = ($page - 1) * $perpage;

		$get_record_count = JobTypeModel::get_record_count();
		$lastPage = ceil($get_record_count / $perpage);

		$get_area = JobTypeModel::get_record_pagi($offset, $perpage);
		$result = array();
		foreach ($get_area as $key => $value) {
			$data['id'] = $value->id;
			$data['name'] = $value->name;
			$data['ch_name'] = !empty($value->ch_name) ? $value->ch_name : '';
		
			$data['action'] = '<a href="' . url('admin/job-type/edit/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon-edit-1"></i>
                     </a>
                     <a href="' . url('admin/job-type/delete/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon2-trash"></i>
                     </a>   ';

			$result[] = $data;
		}

		$meta['page'] = $page;
		$meta['pages'] = $lastPage;
		$meta['perpage'] = $perpage;
		$meta['total'] = $get_record_count;

		$json['meta'] = $meta;

		$json['data'] = $result;

		echo json_encode($json);
	}
	public function add_job_type()
	{
		return view('backend.admin.page.job_type.add');
	}
	public function insert_update_job_type($id = '', Request $request)
	{
		$record = request()->validate([
			'name' => 'required|max:120',
		]);
		
		if(!empty($id))
		{
			$record = JobTypeModel::find($id);
		}
		else
		{
			$record = new JobTypeModel;	
		}

		$record->name = trim($request->name);
		$record->ch_name = trim($request->ch_name);
		$record->save();
		return redirect('admin/job-type')->with('success', __("message.Record successfully save"));
	}
	public function edit_job_type($id)
	{
		$data['record'] = JobTypeModel::get_single($id);
		return view('backend.admin.page.job_type.edit', $data);
	}
	public function delete_job_type($id)
	{
		echo "<h1>Delete Job Type</h1>";
		die();
	}

	// Job Type End

	// Salary Start
	public function salary()
	{
			return view('backend.admin.page.salary.list');
	}
	public function get_salary_list(Request $request)
	{
		$perpage = $request->pagination['perpage'];
		$page = $request->pagination['page'];
		$offset = ($page - 1) * $perpage;

		$get_record_count = SalaryModel::get_record_count();
		$lastPage = ceil($get_record_count / $perpage);

		$get_area = SalaryModel::get_record_pagi($offset, $perpage);
		$result = array();
		foreach ($get_area as $key => $value) {
			$data['id'] = $value->id;
			$data['name'] = $value->name;
			$data['ch_name'] = !empty($value->ch_name) ? $value->ch_name : '';
		
			$data['action'] = '<a href="' . url('admin/salary/edit/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon-edit-1"></i>
                     </a>
                     <a href="' . url('admin/salary/delete/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon2-trash"></i>
                     </a>   ';

			$result[] = $data;
		}

		$meta['page'] = $page;
		$meta['pages'] = $lastPage;
		$meta['perpage'] = $perpage;
		$meta['total'] = $get_record_count;

		$json['meta'] = $meta;

		$json['data'] = $result;

		echo json_encode($json);
	}

	public function add_salary()
	{
		return view('backend.admin.page.salary.add');
	}
	public function insert_update_salary($id = '', Request $request) {
		$record = request()->validate([
			'name' => 'required|max:120',
		]);
		if(!empty($id))
		{
			$record = SalaryModel::find($id);
		}
		else
		{
			$record = new SalaryModel;	
		}

		$record->name = trim($request->name);
		$record->ch_name = trim($request->ch_name);
		$record->save();
		return redirect('admin/salary')->with('success', __("message.Record successfully save"));
	}
	public function edit_salary($id)
	{
		$data['record'] = SalaryModel::get_single($id);
		return view('backend.admin.page.salary.edit', $data);
	}
	public function delete_salary($id)
	{
		echo "<h1>Delete Salary</h1>";
		die();
	}

	// Salary End
	// School Type Start
	public function school_type()
	{
			return view('backend.admin.page.school_type.list');
	}
	public function get_school_type_list(Request $request)
	{
		$perpage = $request->pagination['perpage'];
		$page = $request->pagination['page'];
		$offset = ($page - 1) * $perpage;

		$get_record_count = SchoolTypeModel::get_record_count();
		$lastPage = ceil($get_record_count / $perpage);

		$get_area = SchoolTypeModel::get_record_pagi($offset, $perpage);
		$result = array();
		foreach ($get_area as $key => $value) {
			$data['id'] = $value->id;
			$data['name'] = $value->name;
			$data['ch_name'] = !empty($value->ch_name) ? $value->ch_name : '';
		
			$data['action'] = '<a href="' . url('admin/school-type/edit/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon-edit-1"></i>
                     </a>
                     <a href="' . url('admin/school-type/delete/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon2-trash"></i>
                     </a>   ';

			$result[] = $data;
		}

		$meta['page'] = $page;
		$meta['pages'] = $lastPage;
		$meta['perpage'] = $perpage;
		$meta['total'] = $get_record_count;

		$json['meta'] = $meta;

		$json['data'] = $result;

		echo json_encode($json);
	}

	public function add_school_type()
	{
		return view('backend.admin.page.school_type.add');
	}
	public function insert_update_school_type($id = '', Request $request) {
		$record = request()->validate([
			'name' => 'required|max:120',
		]);

		if(!empty($id))
		{
			$record = SchoolTypeModel::find($id);
		}
		else
		{
			$record = new SchoolTypeModel;	
		}

		$record->name = trim($request->name);
		$record->ch_name = trim($request->ch_name);
		$record->save();
		return redirect('admin/school-type')->with('success', __("message.Record successfully save"));
	}
	public function edit_school_type($id)
	{
		$data['record'] = SchoolTypeModel::get_single($id);
		return view('backend.admin.page.school_type.edit', $data);
	}
	public function delete_school_type($id)
	{
		echo "<h1>Delete School Type</h1>";
		die();
	}

	// School Type End

	// start date Start
	public function start_date()
	{
			return view('backend.admin.page.start_date.list');
	}
	public function get_start_date_list(Request $request)
	{
		$perpage = $request->pagination['perpage'];
		$page = $request->pagination['page'];
		$offset = ($page - 1) * $perpage;

		$get_record_count = StartDateModel::get_record_count();
		$lastPage = ceil($get_record_count / $perpage);

		$get_area = StartDateModel::get_record_pagi($offset, $perpage);
		$result = array();
		foreach ($get_area as $key => $value) {
			$data['id'] = $value->id;
			$data['name'] = $value->name;
			$data['ch_name'] = !empty($value->ch_name) ? $value->ch_name : '';
		
			$data['action'] = '<a href="' . url('admin/start-date/edit/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon-edit-1"></i>
                     </a>
                     <a href="' . url('admin/start-date/delete/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon2-trash"></i>
                     </a>   ';

			$result[] = $data;
		}

		$meta['page'] = $page;
		$meta['pages'] = $lastPage;
		$meta['perpage'] = $perpage;
		$meta['total'] = $get_record_count;

		$json['meta'] = $meta;

		$json['data'] = $result;

		echo json_encode($json);
	}

	public function add_start_date()
	{
		return view('backend.admin.page.start_date.add');
	}
	public function insert_update_start_date($id = '', Request $request) {
		$record = request()->validate([
			'name' => 'required|max:120',
		]);

		if(!empty($id))
		{
			$record = StartDateModel::find($id);
		}
		else
		{
			$record = new StartDateModel;	
		}

		$record->name = trim($request->name);
		$record->ch_name = trim($request->ch_name);
		$record->save();
		return redirect('admin/start-date')->with('success', __("message.Record successfully save"));
	}

	public function edit_start_date($id)
	{
		$data['record'] = StartDateModel::get_single($id);
		return view('backend.admin.page.start_date.edit', $data);
	}
	public function delete_start_date($id)
	{
		echo "<h1>Delete Start Date</h1>";
		die();
	}

	// start date End

	// states Start

	public function states()
	{
		return view('backend.admin.page.states.list');
	}
	public function get_states_list(Request $request) {
		$perpage = $request->pagination['perpage'];
		$page = $request->pagination['page'];
		$offset = ($page - 1) * $perpage;

		$get_record_count = StateModel::get_record_count();
		$lastPage = ceil($get_record_count / $perpage);

		$get_area = StateModel::get_record_pagi($offset, $perpage);
		$result = array();
		foreach ($get_area as $key => $value) {
			$data['id'] = $value->id;
			$data['name'] = $value->name;
			$data['ch_name'] = !empty($value->ch_name) ? $value->ch_name : '';
			$data['country_id'] = !empty($value->getcountry->name) ? $value->getcountry->name : '';

			$data['action'] = '<a href="' . url('admin/states/edit/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon-edit-1"></i>
                     </a>
                     <a href="' . url('admin/states/delete/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon2-trash"></i>
                     </a>   ';

			$result[] = $data;
		}

		$meta['page'] = $page;
		$meta['pages'] = $lastPage;
		$meta['perpage'] = $perpage;
		$meta['total'] = $get_record_count;

		$json['meta'] = $meta;

		$json['data'] = $result;

		echo json_encode($json);
	}


	public function add_states()
	{
		$data['get_country'] = CountryModel::get_record();
		return view('backend.admin.page.states.add', $data);
	}
	public function insert_update_states($id = '', Request $request) {
		$record = request()->validate([
			'name' => 'required|max:120',
			'country_id' => 'required'
		]);

		if(!empty($id))
		{
			$record = StateModel::find($id);
		}
		else
		{
			$record = new StateModel;	
		}

		
		$record->name = trim($request->name);
		$record->ch_name = trim($request->ch_name);
		$record->country_id = trim($request->country_id);
		$record->save();
		return redirect('admin/states')->with('success', __("message.Record successfully save"));
	}

	public function edit_states($id)
	{
		$data['record'] = StateModel::get_single($id);
		$data['get_country'] = CountryModel::get_record();
		return view('backend.admin.page.states.edit', $data);
	}

	public function delete_states($id)
	{
		echo "<h1>Delete States</h1>";
		die();
	}
	

	// states end

	// faq Category Start
	public function faq_category() {
		return view('backend.admin.page.faq_category.list');
	}

	public function get_faq_category_list(Request $request) {
		$perpage = $request->pagination['perpage'];
		$page = $request->pagination['page'];
		$offset = ($page - 1) * $perpage;

		$get_record_count = FaqCategoryModel::get_record_count();
		$lastPage = ceil($get_record_count / $perpage);

		$get_faq_category = FaqCategoryModel::get_record_pagi($offset, $perpage);
		$result = array();
		foreach ($get_faq_category as $key => $value) {
			$data['id'] = $value->id;
			$data['name'] = $value->name;
			$data['ch_name'] = !empty($value->ch_name) ? $value->ch_name : '';

			$data['action'] = '<a href="' . url('admin/faq_category/edit/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon-edit-1"></i>
                     </a>
                     <a href="' . url('admin/faq_category/delete/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon2-trash"></i>
                     </a>   ';
			$result[] = $data;
		}

		$meta['page'] = $page;
		$meta['pages'] = $lastPage;
		$meta['perpage'] = $perpage;
		$meta['total'] = $get_record_count;
		$json['meta'] = $meta;
		$json['data'] = $result;

		echo json_encode($json);

	}
	public function add_faq_category() {
		return view('backend.admin.page.faq_category.add');
	}

	public function insert_update_faq_category($id = '', Request $request) {
		$record = request()->validate([
			'name' => 'required|max:500',
		]);

		if(!empty($id))
		{
			$record = FaqCategoryModel::find($id);
		}
		else
		{
			$record = new FaqCategoryModel;	
		}

		
		$record->name    = trim($request->name);
		$record->ch_name = trim($request->ch_name);
		$record->save();
		return redirect('admin/faq_category')->with('success', __("message.Record successfully save"));
	}

	public function edit_faq_category($id)
	{
		$data['record'] = FaqCategoryModel::get_single($id);
		return view('backend.admin.page.faq_category.edit', $data);
	}

	public function delete_faq_category($id)
	{
		$getrecord = FaqCategoryModel::find($id);
		$getrecord->is_delete = '1';
		$getrecord->save();
		return redirect('admin/faq_category')->with('success', __("message.Record successfully deleted"));
	}
	// faq Category End
	// faq Start
	public function faq() {
		return view('backend.admin.page.faq.list');
	}

	public function get_faq_list(Request $request) {
		$perpage = $request->pagination['perpage'];
		$page = $request->pagination['page'];
		$offset = ($page - 1) * $perpage;

		$get_record_count = FaqModel::get_record_count();
		$lastPage = ceil($get_record_count / $perpage);

		$get_faq = FaqModel::get_record_pagi($offset, $perpage);
		$result = array();
		foreach ($get_faq as $key => $value) {
			$data['id'] = $value->id;
			
		
			$data['faq_category_id'] = !empty($value->getfaqcategory->name) ? $value->getfaqcategory->name : '';

			$data['title'] = $value->title;

			$data['ch_title'] = !empty($value->ch_title) ? $value->ch_title : '';
			$data['description'] = !empty($value->description) ? $value->description : '';
			$data['ch_description'] = !empty($value->ch_description) ? $value->ch_description : '';

			$data['action'] = '<a href="' . url('admin/faq/edit/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon-edit-1"></i>
                     </a>
                     <a href="' . url('admin/faq/delete/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon2-trash"></i>
                     </a>   ';
			$result[] = $data;
		}

		$meta['page'] = $page;
		$meta['pages'] = $lastPage;
		$meta['perpage'] = $perpage;
		$meta['total'] = $get_record_count;
		$json['meta'] = $meta;
		$json['data'] = $result;

		echo json_encode($json);
	}

	public function add_faq()
	{
		$data['getfaqcategory'] = FaqCategoryModel::getFaqCategory();
		return view('backend.admin.page.faq.add', $data);
	}

	public function insert_update_faq($id = '', Request $request) {
		$record = request()->validate([
			'title' => 'required|max:500',
		]);

		if(!empty($id))
		{
			$record = FaqModel::find($id);
		}
		else
		{
			$record = new FaqModel;	
		}

		
		$record->faq_category_id    = trim($request->faq_category_id);
		$record->title 		        = trim($request->title);
		$record->ch_title           = trim($request->ch_title);
		$record->description        = trim($request->description);
		$record->ch_description     = trim($request->ch_description);
		$record->save();
		return redirect('admin/faq')->with('success', __("message.Record successfully save"));
	}
	public function edit_faq($id)
	{
		$data['record'] = FaqModel::get_single($id);
		$data['getfaqcategory'] = FaqCategoryModel::getFaqCategory();

		return view('backend.admin.page.faq.edit', $data);
	}
	public function delete_faq($id) {
		$getrecord = FaqModel::find($id);
		$getrecord->is_delete = '1';
		$getrecord->save();
		return redirect('admin/faq')->with('success', __("message.Record successfully deleted"));
	}
	//faq End


	// Visa Start
	public function visa() {
		return view('backend.admin.page.visa.list');
	}

	public function get_visa_list(Request $request) {
		$perpage = $request->pagination['perpage'];
		$page = $request->pagination['page'];
		$offset = ($page - 1) * $perpage;

		$get_record_count = VisaModel::get_record_count();
		$lastPage = ceil($get_record_count / $perpage);

		$get_visa = VisaModel::get_record_pagi($offset, $perpage);
		$result = array();
		foreach ($get_visa as $key => $value) {
			$data['id'] = $value->id;
			$data['name'] = $value->name;
			$data['ch_name'] = !empty($value->ch_name) ? $value->ch_name : '';
			$data['type'] = !empty($value->type) ? $value->type : '';
			

			$data['action'] = '<a href="' . url('admin/visa/edit/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon-edit-1"></i>
                     </a>
                     <a href="' . url('admin/visa/delete/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon2-trash"></i>
                     </a>   ';
			$result[] = $data;
		}

		$meta['page'] = $page;
		$meta['pages'] = $lastPage;
		$meta['perpage'] = $perpage;
		$meta['total'] = $get_record_count;
		$json['meta'] = $meta;
		$json['data'] = $result;

		echo json_encode($json);

	}
	public function add_visa() {
		return view('backend.admin.page.visa.add');
	}

	public function insert_update_visa($id = '', Request $request) {
		$record = request()->validate([
			'name' => 'required|max:500',
		]);

		if(!empty($id))
		{
			$record = VisaModel::find($id);
		}
		else
		{
			$record = new VisaModel;	
		}

		
		$record->name = trim($request->name);
		$record->type = trim($request->type);
		$record->ch_name = trim($request->ch_name);
		$record->save();

		VisaInformationModel::delete_record($record->id);

		if(!empty($request->rule)) {

			foreach ($request->rule as $key => $rule) {
				if(!empty($rule)) {

					$info 			= new VisaInformationModel;
					$info->visa_id 	= $record->id;
					$info->name 	= $rule;
					$info->ch_name 	= !empty($request->ch_rule[$key]) ? $request->ch_rule[$key] : '';
					$info->save();

				}
			}
		}

		return redirect('admin/visa')->with('success', __("message.Record successfully save"));
	}

	public function edit_visa($id)
	{
		$data['record'] = VisaModel::get_single($id);
		return view('backend.admin.page.visa.edit', $data);
	}

	public function delete_visa($id)
	{
		$getrecord = VisaModel::find($id);
		$getrecord->is_delete = '1';
		$getrecord->save();
		return redirect('admin/visa')->with('success', 'Record successfully deleted!');
	}
	// visa End


}
