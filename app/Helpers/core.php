<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 8/2/2020
 * Time: 1:45 PM
 */
/**
 * Takes a filename and returns in directory format
 * @param string $filename
 * @return string
 */
function file_path($filename)
{
    return str_replace('_', '/', $filename);
}
function generate_teacher_id(){
    $digits = 7;
    $teacher_id =  'A'.rand(pow(10, $digits-1), pow(10, $digits)-1);
    $check_id =\App\Models\UsersModel::where('teacher_id',$teacher_id)->first();
    if(empty($check_id)){
       $teacher= $teacher_id;
    }else{
        $teacher =  $teacher_id.'1';
    }
    return $teacher;
}
function generate_school_id(){
    $digits = 7;
    $school_id =  'S'.rand(pow(10, $digits-1), pow(10, $digits)-1);
    $check_id =\App\Models\UsersModel::where('school_id',$school_id)->first();
    if(empty($check_id)){
        $school= $school_id;
    }else{
        $school =  $school_id.'1';
    }
    return $school;
}
function time_zone(){
    $timezone = '';
    try {
        $ip     = $_SERVER['REMOTE_ADDR'];
        $json   = file_get_contents( 'http://ip-api.com/json/' . $ip);
        $ipData = json_decode( $json, true);
        $timezone = !empty($ipData['timezone']) ? $ipData['timezone'] : '';
    }
    catch (\Exception $e) {

    }
    return $timezone;
}