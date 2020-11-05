<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupMasterModel extends Model
{
      protected $table = 'group_master';

     static public function get_single($id)
     {
        return self::find($id);
     }

}
