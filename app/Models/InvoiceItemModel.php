<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItemModel extends Model
{
    protected $table = 'invoice_item';

    static public function get_single($id) {
    	return self::find($id);
    }
}
