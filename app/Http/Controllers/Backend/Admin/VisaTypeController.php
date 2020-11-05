<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 8/2/2020
 * Time: 10:02 PM
 */

namespace App\Http\Controllers\Backend\Admin;


use App\Http\Controllers\Controller;
use App\Models\VisaType;
use Illuminate\Http\Request;

class VisaTypeController extends Controller
{
    public function index(){
        return view('backend.admin.page.visa_type.index');
    }
    public function visaTypeList(Request $request){

            $perpage = $request->pagination['perpage'];
            $page = $request->pagination['page'];
            $offset = ($page - 1) * $perpage;

            $get_record_count = VisaType::get_record_count();
            $lastPage = ceil($get_record_count / $perpage);

            $get_area = VisaType::get_record_pagination($offset, $perpage);
            $result = array();
            foreach ($get_area as $key => $value) {
                $data['id'] = $value->id;
                $data['name'] = $value->name;

                $data['action'] = '<a href="' . url('admin/visa-type/edit/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                        <i class="flaticon-edit-1"></i>
                     </a>
                     <a href="' . url('admin/visa-type/destroy/' . $value->id) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
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
    public function create(){
        return view('backend.admin.page.visa_type.add');
    }
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required|string|max:100'
        ]);
        VisaType::create([
           'name'=>$request->name
        ]);
        return redirect('admin/visa-type')->with('success', __("message.Record successfully save"));
    }
    public function edit($id){
        $data['record'] = VisaType::get_single($id);
        return view('backend.admin.page.visa_type.edit',$data);
    }
    public function update(Request $request,$id){
        $this->validate($request,[
            'name'=>'required|string|max:100'
        ]);
        $row =VisaType::find($id);
        $row->update([
            'name'=>$request->name
        ]);
        return redirect('admin/visa-type')->with('success', __("message.Record successfully updated"));
    }
    public function destroy($id){
        $row = VisaType::find($id);
        $row->delete();
        return redirect('admin/visa-type')->with('success', __("message.Record successfully Deleted"));
    }
}
