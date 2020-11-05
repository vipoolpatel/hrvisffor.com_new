<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceModel extends Model
{
    protected $table = 'invoice';

    static public function get_single($id) {
    	return self::find($id);
    }

    static public function get_invoice($user_id) {
    	return self::where('user_id','=',$user_id)->orderBy('id','desc')->paginate(12);
    }

    public function item()
    {
    	return $this->hasMany(InvoiceItemModel::class, 'invoice_id', 'id');
    }

}
