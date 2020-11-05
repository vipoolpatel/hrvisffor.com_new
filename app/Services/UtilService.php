<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 8/3/2020
 * Time: 1:56 AM
 */

namespace App\Services;


use App\Models\Welfare;

class UtilService
{
    public static function getAllWelfare($name, $sel = ''){
        $rows = Welfare::all();

        $str = '';
        foreach ($rows as $row){
            $checked = ($sel && in_array($row->id, $sel))? 'checked="checked"' : '';
            $str.='<div class="checkbox-inline"><label class="checkbox">
                                    <input type="checkbox" value="'.$row->id.'" name="welfare[]"'.$checked.'>
                                    <span></span> '.$row->name.'</label></div>';
        }
        return $str;
    }
}
