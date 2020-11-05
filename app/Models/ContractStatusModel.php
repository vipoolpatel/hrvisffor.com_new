<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractStatusModel extends Model
{
    protected $table = 'contract_status';

    static public function get_record()
    {
        return self::get();
    }

}
