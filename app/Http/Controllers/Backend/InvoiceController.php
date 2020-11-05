<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\UsersModel;
use App\Models\InvoiceItemModel;
use App\Models\InvoiceModel;
use App\Notifications\AdminSendInvoiceSchoolNotification;

use Illuminate\Http\Request;
use Auth;

class InvoiceController extends Controller
{
    public function list($user_id, Request $request) {

		$user = UsersModel::get_single($user_id);
		if(!empty($user)) {
			$data['get_invoice'] = InvoiceModel::get_invoice($user_id);
			$data['user'] = $user;
			return view('backend.admin.invoice.list',$data);
		}
		else {
			return redirect('admin/dashbaord');
		}

    }


    public function add($user_id)
    {
    	$user = UsersModel::get_single($user_id);
    	if(!empty($user)) {
			$data['user'] = $user;
			return view('backend.admin.invoice.add',$data);
		}
		else {
			return redirect('admin/dashbaord');
		}
    }


    public function edit($id)
    {
		$data['invoice'] = InvoiceModel::get_single($id);
		return view('backend.admin.invoice.edit',$data);
    }

    public function insert_add($user_id, Request $request)
    {	
    	$invoice 				= new InvoiceModel;
    	$invoice->user_id 		= $user_id;
    	$invoice->company_name 	= $request->company_name;
    	$invoice->address 		= $request->address;
    	$invoice->post_code 	= $request->post_code;
    	$invoice->invoice_date 	= $request->invoice_date;
    	$invoice->phone_number 	= $request->phone_number;
    	$invoice->invoice_number = $request->invoice_number;
    	$invoice->invoice_to 	= $request->invoice_to;
    	$invoice->account_name 	= $request->account_name;
    	$invoice->account_number = $request->account_number;
    	$invoice->tax_no 		= $request->tax_no;
    	$invoice->total 		= $request->total;
    	$invoice->save();
    	
    	foreach ($request->row as $value) {
			$item 				= new InvoiceItemModel;
			$item->invoice_id 	= $invoice->id;
			$item->description 	= $value['description'];
			$item->type 		= $value['type'];
			$item->amount 		= $value['amount'];
			$item->save();
	    }


        $user    = UsersModel::get_single($user_id);
        $subject = 'Admin has been send an invoice';
        $user->notify(new AdminSendInvoiceSchoolNotification($subject,$invoice));  


	    return redirect('admin/user/invoice/'.$user_id)->with('success', __("invoice.Invoice successfully created"));

    }

    public function update($id, Request $request)
    {
    	$invoice 				= InvoiceModel::get_single($id);
    
    	$invoice->company_name 	= $request->company_name;
    	$invoice->address 		= $request->address;
    	$invoice->post_code 	= $request->post_code;
    	$invoice->invoice_date 	= $request->invoice_date;
    	$invoice->phone_number 	= $request->phone_number;
    	$invoice->invoice_number = $request->invoice_number;
    	$invoice->invoice_to 	= $request->invoice_to;
    	$invoice->account_name 	= $request->account_name;
    	$invoice->account_number = $request->account_number;
    	$invoice->tax_no 		= $request->tax_no;
    	$invoice->total 		= $request->total;
    	$invoice->save();
    	
    	foreach ($request->row as $value) {

    		if(!empty($value['description']) && !empty($value['type']) && $value['amount'])
    		{
    			if(!empty($value['id']))
    			{
    				$item = InvoiceItemModel::get_single($value['id']);
    			}
    			else
    			{
    				$item = new InvoiceItemModel;	
    				$item->invoice_id 	= $invoice->id;
    			}
				
				$item->description 	= $value['description'];
				$item->type 		= $value['type'];
				$item->amount 		= $value['amount'];
				$item->save();
    		}	
	    }

	    return redirect('admin/user/invoice/'.$invoice->user_id)->with('success', __("invoice.Invoice successfully updated"));
    }


    public function item_delete($id)
    {	

    	$item  = InvoiceItemModel::get_single($id);

    	$invoice  = InvoiceModel::get_single($item->invoice_id);
		$finalAnount = $invoice->total - $item->amount;
		$invoice->total = $finalAnount;
		$invoice->save();

		
		$item->delete();
		

	    return redirect()->back()->with('success', __("invoice.Record successfully deleted"));

    }


    public function delete($id)
    {
    	$item = InvoiceModel::get_single($id);
    	$item->delete();

		InvoiceItemModel::where('invoice_id','=',$id)->delete();

		return redirect()->back()->with('success', __("invoice.Record successfully deleted"));		
    }



	// school part

    public function school_list(Request $request) {

    	$user_id = Auth::user()->id;
    	$data['get_invoice'] = InvoiceModel::get_invoice($user_id);
		return view('backend.school.invoice.list',$data);
		
	}


}
