



<?php
        
// $con = mysqli_connect('localhost', 'root', '123456', 'hrvisffor_com');

// $con->set_charset("utf8mb4");

// $old_con = mysqli_connect('localhost', 'root', '123456', 'groupchat');


// // Change character set to utf8
// $old_con->set_charset("utf8mb4");


// $get_old_job = mysqli_query($old_con,'SELECT * FROM jobs');


// while ($old_row = mysqli_fetch_assoc($get_old_job)) {

// 	$get_user = mysqli_query($con,'SELECT * FROM users WHERE company_id = "'.$old_row['company_id'].'" ');
// 	$row_user = mysqli_fetch_assoc($get_user);
// 	$user_id = $row_user['id'];

// $r_position_looking_id = !empty($old_row['r_position_looking_id'])? $old_row['r_position_looking_id'] : '0';
// $r_school_id = !empty($old_row['r_school_id'])? $old_row['r_school_id'] : '0';
// $r_work_type_id = !empty($old_row['r_work_type_id'])? $old_row['r_work_type_id'] : '0';
// $r_english_speaker_id = !empty($old_row['r_english_speaker_id'])? $old_row['r_english_speaker_id'] : '0';
// $r_visa_id = !empty($old_row['r_visa_id'])? $old_row['r_visa_id'] : '0';

// $r_teach_id = !empty($old_row['r_teach_id'])? $old_row['r_teach_id'] : '0';
// $r_position_id = !empty($old_row['r_position_id'])? $old_row['r_position_id'] : '0';
// $r_salary_id = !empty($old_row['r_salary_id'])? $old_row['r_salary_id'] : '0';
// $r_max_salary_id = !empty($old_row['r_max_salary_id'])? $old_row['r_max_salary_id'] : '0';
// $r_hour_id = !empty($old_row['r_hour_id'])? $old_row['r_hour_id'] : '0';

// $r_working_schedule_id = !empty($old_row['r_working_schedule_id'])? $old_row['r_working_schedule_id'] : '0';
// $r_class_size_id = !empty($old_row['r_class_size_id'])? $old_row['r_class_size_id'] : '0';
// $r_min_age_requirement_id = !empty($old_row['r_min_age_requirement_id'])? $old_row['r_min_age_requirement_id'] : '0';

// $r_max_age_requirement_id = !empty($old_row['r_max_age_requirement_id'])? $old_row['r_max_age_requirement_id'] : '0';




// $insert = "INSERT INTO `jobs`(
// `id`, 
// `user_id`, 
// `position_id`, 
// `type_of_school_id`, 
// `job_type_id`, 
// `country_id`,
// `is_english_speaker`, 
// `visa_type_id`, 
// `general_location_id`, 
// `teacher_start_id`, 
// `salary_minimum_id`, 
// `salary_maximum_id`, 
// `working_hours_per_week`,
// `working_schedule_id`, 
// `class_size`, 
// `maximum_age`, 
// `minimum_age`, 

// `expiry_date`, 
// `state_id`,
// `city_id`,

// `created_at`, 
// `updated_at`
// ) VALUES (

// 	'".$old_row['id']."',
// 	'".$user_id."',
// 	'".$r_position_looking_id."',
// 	'".$r_school_id."',
// 	'".$r_work_type_id."',
// 	'44',
// 	'".$r_english_speaker_id."',
// 	'".$r_visa_id."',
// 	'".$r_teach_id."',
// 	'".$r_position_id."',
// 	'".$r_salary_id."',
// 	'".$r_max_salary_id."',
// 	'".$r_hour_id."',
// 	'".$r_working_schedule_id."',
// 	'".$r_class_size_id."',
// 	'".$r_min_age_requirement_id."',
// 	'".$r_max_age_requirement_id."',
// 	'".date('Y-m-d',strtotime($old_row['expiry_date']))."',
// 	'0',
// 	'0',
// 	'".$old_row['created_at']."',
// 	'".$old_row['updated_at']."'
// )";

// // echo $insert ;
// // die;
// mysqli_query($con,$insert);


// }















// $get_old_user = mysqli_query($old_con,'SELECT * FROM companies');

// $i = 1645;

// while ($old_row = mysqli_fetch_assoc($get_old_user)) {

// 	$username = '';

// 	if(!empty($old_row['username']))
// 	{
// 		$username = $old_row['username'];
// 	}
// 	else
// 	{
// 		$username = 'visffor'.$i;
// 		$i++;
// 	}

// // echo mysqli_real_escape_string($old_con,$old_row['ceo']);
// 	// echo $old_row['ceo'];
// 	// die;
    	
// $insert = "INSERT INTO `users`(
// 	`name`,
// 	`company_id`,
// 	`school_name`,
// 	`username`, 
// 	`wechat_id`, 
// 	`phone_number`, 
// 	`password`, 
// 	`profile_pic`, 
// 	`status`, 
// 	`school_id`, 
// 	`is_admin`, 
// 	`created_date`, 
// 	`created_at`, 
// 	`updated_at`
// ) 
// VALUES (
// 	'".$old_row['ceo']."',
// 	'".$old_row['id']."',
// 	'".$old_row['name']."',
// 	'".$username."',
// 	'".$old_row['wechat_id']."',
// 	'".$old_row['phone']."',
// 	'".$old_row['password']."',
// 	'".$old_row['logo']."',
// 	'1',
// 	'".$old_row['school_id']."',
// 	'3',
// 	 '".time()."',
//   	'".$old_row['created_at']."',
//   	'".$old_row['updated_at']."'
// )";


// mysqli_query($con,$insert);

// // die;


// }




// Teacher data move



    // $get_old_user = mysqli_query($old_con,'SELECT * FROM users');

    // while ($old_row = mysqli_fetch_assoc($get_old_user)) {
    	

// $insert = "INSERT INTO `users`(
// `id`,
// `name`, 
// `last_name`, 
// `username`, 
// `email`, 
// `country_id`, 
// `phone_number`, 
// `password`, 
//  `current_location_id`, 
//  `nationality_id`, 
//  `age`, 
//  `experience`, 
//  `is_native_english`, 
//  `visa_id`, 
//  `educaton_level_id`, 
//  `is_graduated`, 
//  `is_education_english`, 
//  `is_native_english_speaking`,
//  `position_id`, 
//  `job_type_id`, 
//  `start_date_id`, 
//  `area_id`, 
//  `current_visa_type_id`, 
//  `minimum_salary_id`, 
//  `maximum_salary_id`, 
//  `interview_time`, 
//  `others`, 
//  `profile_pic`, 
//  `user_video`, 
//  `teacher_id`,  
//  `is_admin`, 
//  `created_date`, 
//  `created_at`, 
//  `updated_at`)
//   VALUES (
//   '".$old_row['id']."',
//   '".$old_row['first_name']."',
//   '".$old_row['last_name']."',
//   '".$old_row['rule_id']."',
//   '".$old_row['email']."',
//   '".$old_row['country_id']."',
//   '".$old_row['phone']."',
//   '".$old_row['password']."',
//   '".$old_row['r_current_locatioin_id']."',
//   '".$old_row['nationality_id']."',
//   '".$old_row['r_age_id']."',
//   '".$old_row['r_working_experience']."',
//   '".$old_row['r_english_speaker_id']."',
//   '".$old_row['r_visa_id']."',
//   '".$old_row['r_highest_education_id']."',
//   '".$old_row['r_graduated_id']."',
//   '".$old_row['r_subject_education']."',
//   '".$old_row['r_native_english_speaking']."',
//   '".$old_row['r_position_looking_id']."',
//   '".$old_row['r_work_type_id']."',
//   '".$old_row['r_position_id']."',
//   '".$old_row['r_teach_id']."',
//   '".$old_row['chinese_visa_are_you_holding']."',
//   '".$old_row['r_salary_id']."',
//   '".$old_row['r_max_salary_id']."',
//   '".$old_row['online_interview']."',
//   '".$old_row['r_other_requirements']."',
//   '".$old_row['image']."',
//   '".$old_row['self_intro']."',
//   '".$old_row['rule_id']."',
//   '4',
//   '".time()."',
//   '".$old_row['created_at']."',
//   '".$old_row['updated_at']."'

// )";


// 	mysqli_query($con,$insert);





    // }


        
?>
