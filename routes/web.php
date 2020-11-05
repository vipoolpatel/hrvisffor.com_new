<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('locale/{locale}', function ($locale){
    \Session::put('locale', $locale);
    return redirect()->back();
});


Route::group(['middleware' => 'superadmin'], function () {

	Route::get('admin/staff/task/{id}', 'Backend\TaskController@list');
	Route::get('admin/staff/task/add/{id}', 'Backend\TaskController@add');
	Route::post('admin/staff/task/add/{id}', 'Backend\TaskController@create');
	
	Route::post('admin/staff/task/change_status', 'Backend\TaskController@change_status');
	Route::get('admin/staff/task/delete/{id}', 'Backend\TaskController@delete_task');



});

Route::group(['middleware' => 'admin'], function () {
	Route::get('admin/dashboard', 'Backend\DashboardController@dashboard');


	// Daily Report

	Route::get('admin/daily-report', 'Backend\DailyReportController@list');
	Route::get('admin/daily-report/add', 'Backend\DailyReportController@add');
	Route::post('admin/daily-report/add', 'Backend\DailyReportController@insert');
	



	// interview
	Route::get('admin/interview', 'Backend\InterviewController@index');
	Route::post('admin/interview/change_status', 'Backend\InterviewController@interview_change_status');
	Route::post('admin/interview/note_update', 'Backend\InterviewController@note_update');
	

	//offer
	Route::get('admin/offer','Backend\OfferController@list');
	Route::post('admin/offer/change_status','Backend\OfferController@offer_change_status');
	Route::post('admin/offer/edit','Backend\OfferController@edit');
	Route::post('admin/offer/update','Backend\OfferController@update');
	

	// report
	Route::get('admin/report', 'Backend\ReportController@report');
	Route::post('admin/report/reject', 'Backend\ReportController@report_reject');
	Route::post('admin/report/change_report_status', 'Backend\ReportController@change_report_status');
	Route::get('admin/report/delete/{id}', 'Backend\ReportController@delete');
	

	// contract
	Route::get('admin/contract','Backend\OfferContractController@list');
	Route::post('admin/contract/change_status','Backend\OfferContractController@contract_change_status');
	Route::post('admin/contract/change_status/reject','Backend\OfferContractController@change_status_reject');
	
	Route::post('admin/school/contract_submit','Backend\OfferContractController@admin_contract_submit');
	
	// travel

	Route::get('admin/travel','Backend\TravelArrangementController@list');
	Route::post('admin/travel/change_status','Backend\TravelArrangementController@travel_change_status');
	Route::post('admin/travel/edit','Backend\TravelArrangementController@admin_edit');
	Route::post('admin/travel/update','Backend\TravelArrangementController@admin_update');
	Route::post('admin/user/travel/reject','Backend\TravelArrangementController@travel_change_status_reject');


	// feedback
	Route::get('admin/feedback','Backend\FeedbackController@list');
	Route::post('admin/feedback/edit','Backend\FeedbackController@edit');
	Route::post('admin/feedback/update','Backend\FeedbackController@update');
	
	Route::get('admin/feedback/delete/{id}','Backend\FeedbackController@delete');
	
	



	Route::get('admin/staff', 'Backend\UserController@staff');
	
	Route::get('admin/staff/add', 'Backend\UserController@add_staff');
	Route::post('admin/staff/add', 'Backend\UserController@insert_update_staff');
	Route::get('admin/staff/edit/{id}', 'Backend\UserController@edit_staff');
	Route::post('admin/staff/edit/{id}', 'Backend\UserController@insert_update_staff');
	Route::get('admin/staff/delete/{id}', 'Backend\UserController@staff_delete');

	

	// staff task

	Route::get('admin/staff/task/detail/{id}', 'Backend\TaskController@detail');
	Route::post('admin/staff/task/detail/{id}', 'Backend\TaskController@reply');
	Route::get('admin/task', 'Backend\TaskController@list');
	
	
	


	Route::get('admin/teacher', 'Backend\UserController@teacher');

// visa part
	Route::get('admin/user/visa/{id}', 'Backend\UserController@user_visa');
	Route::post('admin/user/change_visa_status', 'Backend\UserController@change_visa_status');

	Route::get('admin/user/visa/add/{user_id}', 'Backend\UserController@user_visa_add');
	Route::post('admin/user/visa/add/{user_id}', 'Backend\UserController@insert_user_visa');

	Route::get('admin/user/visa/edit/{id}', 'Backend\UserController@user_visa_edit');
	Route::post('admin/user/visa/edit/{id}', 'Backend\UserController@insert_user_visa');

	Route::get('admin/user/visa/delete/{id}', 'Backend\UserController@user_visa_delete');

	Route::post('admin/user/visa/reject', 'Backend\UserController@user_visa_reject');

	Route::post('admin/user/visa_assign', 'Backend\UserController@user_visa_assign');

		
	
	// invoice 
	Route::get('admin/user/invoice/{id}', 'Backend\InvoiceController@list');
	Route::get('admin/user/invoice/add/{id}', 'Backend\InvoiceController@add');
	Route::post('admin/user/invoice/add/{id}', 'Backend\InvoiceController@insert_add');
	Route::get('admin/user/invoice/edit/{id}', 'Backend\InvoiceController@edit');
	Route::post('admin/user/invoice/edit/{id}', 'Backend\InvoiceController@update');
	Route::get('admin/user/invoice/delete/{id}', 'Backend\InvoiceController@delete');

	Route::get('admin/user/invoice/item_delete/{id}', 'Backend\InvoiceController@item_delete');
	


	



	


	Route::get('admin/teacher-profile-view', 'Backend\UserController@teacher_profile_view');
	Route::post('admin/teacher-profile-view', 'Backend\UserController@teacher_profile_view');

	
	Route::post('admin/teacher', 'Backend\UserController@teacher');
	Route::get('admin/teacher/add', 'Backend\UserController@add_teacher');
	Route::get('admin/teacher/edit/{id}', 'Backend\UserController@edit_teacher');
	Route::post('admin/teacher/edit/{id}', 'Backend\UserController@insert_update_teacher');
	Route::post('admin/teacher/add', 'Backend\UserController@insert_update_teacher');
	Route::get('admin/teacher/delete/{id}', 'Backend\UserController@delete_teacher');

	Route::get('admin/teacher/video_delete/{id}', 'Backend\UserController@video_delete');

	

	Route::post('admin/teacher/note/update', 'Backend\UserController@note_update');

	


	

    Route::post('admin/teacher-list','Backend\UserController@teacher_list');

	Route::get('admin/job', 'Backend\UserController@job');
	Route::get('admin/job/add', 'Backend\UserController@add_job');
	Route::post('admin/job/add', 'Backend\UserController@insert_update_job');
	Route::get('admin/job/edit/{id}', 'Backend\UserController@edit_job');
	Route::post('admin/job/edit/{id}', 'Backend\UserController@insert_update_job');
	Route::get('admin/job/delete/{id}', 'Backend\UserController@delete_job');

	Route::post('admin/job/match_status_job', 'Backend\UserController@match_status_job');

	


	Route::post('admin/job/credit_level_update', 'Backend\UserController@credit_level_update');
	Route::post('admin/job/emergency_level_update', 'Backend\UserController@emergency_level_update');

	Route::post('admin/job/teacher_recommend', 'Backend\UserController@job_teacher_recommend');

	Route::post('admin/teacher/school_recommend', 'Backend\UserController@teacher_school_recommend');

	Route::post('admin/teacher/match_status_teacher', 'Backend\UserController@match_status_teacher');

	




	Route::post('admin/user_permission', 'Backend\UserController@user_permission');
	Route::post('admin/save_permission', 'Backend\UserController@save_permission');
	
	

	Route::get('admin/change-password','Backend\ProfileController@change_password');
	Route::post('admin/change-password','Backend\ProfileController@update_password');
	

	// Page Start

	
	Route::get('admin/manage', 'Backend\PageController@manage');


	Route::get('admin/setting', 'Backend\PageController@setting');
	Route::post('admin/setting', 'Backend\PageController@update_setting');

	
	Route::get('admin/faq_category', 'Backend\PageController@faq_category');
	Route::post('admin/faq_category/get_faq_category_list', 'Backend\PageController@get_faq_category_list');
	Route::get('admin/faq_category/add', 'Backend\PageController@add_faq_category');
	Route::post('admin/faq_category/add', 'Backend\PageController@insert_update_faq_category');
	Route::get('admin/faq_category/edit/{id}', 'Backend\PageController@edit_faq_category');
	Route::post('admin/faq_category/edit/{id}', 'Backend\PageController@insert_update_faq_category');
	Route::get('admin/faq_category/delete/{id}', 'Backend\PageController@delete_faq_category');

	Route::get('admin/faq', 'Backend\PageController@faq');
	Route::post('admin/faq/get_faq_list', 'Backend\PageController@get_faq_list');
	Route::get('admin/faq/add', 'Backend\PageController@add_faq');
	Route::post('admin/faq/add', 'Backend\PageController@insert_update_faq');
	Route::get('admin/faq/edit/{id}', 'Backend\PageController@edit_faq');
	Route::post('admin/faq/edit/{id}', 'Backend\PageController@insert_update_faq');
	Route::get('admin/faq/delete/{id}', 'Backend\PageController@delete_faq');
	


	Route::get('admin/visa', 'Backend\PageController@visa');
	Route::post('admin/visa/get_visa_list', 'Backend\PageController@get_visa_list');
	Route::get('admin/visa/add', 'Backend\PageController@add_visa');
	Route::post('admin/visa/add', 'Backend\PageController@insert_update_visa');
	Route::get('admin/visa/edit/{id}', 'Backend\PageController@edit_visa');
	Route::post('admin/visa/edit/{id}', 'Backend\PageController@insert_update_visa');
	Route::get('admin/visa/delete/{id}', 'Backend\PageController@delete_visa');



	Route::get('admin/area', 'Backend\PageController@area');
	Route::post('admin/area/get_area_list', 'Backend\PageController@get_area_list');
	Route::get('admin/area/add', 'Backend\PageController@add_area');
	Route::post('admin/area/add', 'Backend\PageController@insert_update_area');
	Route::get('admin/area/edit/{id}', 'Backend\PageController@edit_area');
	Route::post('admin/area/edit/{id}', 'Backend\PageController@insert_update_area');
	Route::get('admin/area/delete/{id}', 'Backend\PageController@delete_area');



	Route::get('admin/livingcost', 'Backend\PageController@livingcost');
	Route::post('admin/livingcost/get_livingcost_list', 'Backend\PageController@get_livingcost_list');
	Route::get('admin/livingcost/add', 'Backend\PageController@add_livingcost');
	Route::post('admin/livingcost/add', 'Backend\PageController@insert_update_livingcost');
	Route::get('admin/livingcost/edit/{id}', 'Backend\PageController@edit_livingcost');
	Route::post('admin/livingcost/edit/{id}', 'Backend\PageController@insert_update_livingcost');
	Route::get('admin/livingcost/delete/{id}', 'Backend\PageController@delete_livingcost');


	Route::get('admin/creditlevel', 'Backend\PageController@creditlevel');
	Route::post('admin/creditlevel/get_creditlevel_list', 'Backend\PageController@get_creditlevel_list');
	Route::get('admin/creditlevel/add', 'Backend\PageController@add_creditlevel');
	Route::post('admin/creditlevel/add', 'Backend\PageController@insert_update_creditlevel');
	Route::get('admin/creditlevel/edit/{id}', 'Backend\PageController@edit_creditlevel');
	Route::post('admin/creditlevel/edit/{id}', 'Backend\PageController@insert_update_creditlevel');
	Route::get('admin/creditlevel/delete/{id}', 'Backend\PageController@delete_creditlevel');

	Route::get('admin/emergencylevel', 'Backend\PageController@emergencylevel');
	Route::post('admin/emergencylevel/get_emergencylevel_list', 'Backend\PageController@get_emergencylevel_list');
	Route::get('admin/emergencylevel/add', 'Backend\PageController@add_emergencylevel');
	Route::post('admin/emergencylevel/add', 'Backend\PageController@insert_update_emergencylevel');
	Route::get('admin/emergencylevel/edit/{id}', 'Backend\PageController@edit_emergencylevel');
	Route::post('admin/emergencylevel/edit/{id}', 'Backend\PageController@insert_update_emergencylevel');
	Route::get('admin/emergencylevel/delete/{id}', 'Backend\PageController@delete_emergencylevel');

	
	Route::get('admin/colour', 'Backend\PageController@colour');
	Route::post('admin/colour/get_colour_list', 'Backend\PageController@get_colour_list');
	Route::get('admin/colour/add', 'Backend\PageController@add_colour');
	Route::post('admin/colour/add', 'Backend\PageController@insert_update_colour');
	Route::get('admin/colour/edit/{id}', 'Backend\PageController@edit_colour');
	Route::post('admin/colour/edit/{id}', 'Backend\PageController@insert_update_colour');
	Route::get('admin/colour/delete/{id}', 'Backend\PageController@delete_colour');	
	
	Route::get('admin/cardcolour', 'Backend\PageController@cardcolour');
	Route::post('admin/cardcolour/get_cardcolour_list', 'Backend\PageController@get_cardcolour_list');
	Route::get('admin/cardcolour/add', 'Backend\PageController@add_cardcolour');
	Route::post('admin/cardcolour/add', 'Backend\PageController@insert_update_cardcolour');
	Route::get('admin/cardcolour/edit/{id}', 'Backend\PageController@edit_cardcolour');
	Route::post('admin/cardcolour/edit/{id}', 'Backend\PageController@insert_update_cardcolour');
	Route::get('admin/cardcolour/delete/{id}', 'Backend\PageController@delete_cardcolour');


	Route::get('admin/teachertype', 'Backend\PageController@teachertype');
	Route::post('admin/teachertype/get_teachertype_list', 'Backend\PageController@get_teachertype_list');
	Route::get('admin/teachertype/add', 'Backend\PageController@add_teachertype');
	Route::post('admin/teachertype/add', 'Backend\PageController@insert_update_teachertype');
	Route::get('admin/teachertype/edit/{id}', 'Backend\PageController@edit_teachertype');
	Route::post('admin/teachertype/edit/{id}', 'Backend\PageController@insert_update_teachertype');
	Route::get('admin/teachertype/delete/{id}', 'Backend\PageController@delete_teachertype');
		

	Route::get('admin/position', 'Backend\PageController@position');
	Route::post('admin/position/get_position_list', 'Backend\PageController@get_position_list');
	Route::get('admin/position/add', 'Backend\PageController@add_position');
	Route::post('admin/position/add', 'Backend\PageController@insert_update_position');
	Route::get('admin/position/edit/{id}', 'Backend\PageController@edit_position');
	Route::post('admin/position/edit/{id}', 'Backend\PageController@insert_update_position');
	Route::get('admin/position/delete/{id}', 'Backend\PageController@delete_position');

	Route::get('admin/nationality', 'Backend\PageController@nationality');
	Route::post('admin/nationality/get_nationality_list', 'Backend\PageController@get_nationality_list');
	Route::get('admin/nationality/add', 'Backend\PageController@add_nationality');
	Route::post('admin/nationality/add', 'Backend\PageController@insert_update_nationality');
	Route::get('admin/nationality/edit/{id}', 'Backend\PageController@edit_nationality');
	Route::post('admin/nationality/edit/{id}', 'Backend\PageController@insert_update_nationality');
	Route::get('admin/nationality/delete/{id}', 'Backend\PageController@delete_nationality');

	Route::get('admin/cities', 'Backend\PageController@cities');
	Route::post('admin/cities/get_cities_list', 'Backend\PageController@get_cities_list');
	Route::get('admin/cities/add', 'Backend\PageController@add_cities');
	Route::post('admin/cities/add', 'Backend\PageController@insert_update_cities');
	Route::get('admin/cities/edit/{id}', 'Backend\PageController@edit_cities');
	Route::post('admin/cities/edit/{id}', 'Backend\PageController@insert_update_cities');
	Route::get('admin/cities/delete/{id}', 'Backend\PageController@delete_cities');


	Route::get('admin/city-profile/{id}', 'Backend\CityProfileController@city_profile');
	Route::post('admin/city-profile/{id}', 'Backend\CityProfileController@update_city_profile');

	Route::get('admin/countries', 'Backend\PageController@countries');
	Route::post('admin/countries/get_countries_list', 'Backend\PageController@get_countries_list');
	Route::get('admin/countries/add', 'Backend\PageController@add_countries');
	Route::post('admin/countries/add', 'Backend\PageController@insert_update_countries');
	Route::get('admin/countries/edit/{id}', 'Backend\PageController@edit_countries');
	Route::post('admin/countries/edit/{id}', 'Backend\PageController@insert_update_countries');
	Route::get('admin/countries/delete/{id}', 'Backend\PageController@delete_countries');

	Route::get('admin/current-location', 'Backend\PageController@current_location');
	Route::post('admin/current_location/get_current_location_list', 'Backend\PageController@get_current_location_list');
	Route::get('admin/current-location/add', 'Backend\PageController@add_current_location');
	Route::post('admin/current-location/add', 'Backend\PageController@insert_update_current_location');
	Route::get('admin/current-location/edit/{id}', 'Backend\PageController@edit_current_location');
	Route::post('admin/current-location/edit/{id}', 'Backend\PageController@insert_update_current_location');
	Route::get('admin/current-location/delete/{id}', 'Backend\PageController@delete_current_location');

	Route::get('admin/current-visa-type', 'Backend\PageController@current_visa_type');
	Route::post('admin/current_visa_type/get_current_visa_type_list', 'Backend\PageController@get_current_visa_type_list');
	Route::get('admin/current-visa-type/add', 'Backend\PageController@add_current_visa_type');
	Route::post('admin/current-visa-type/add', 'Backend\PageController@insert_update_current_visa_type');
	Route::get('admin/current-visa-type/edit/{id}', 'Backend\PageController@edit_current_visa_type');
	Route::post('admin/current-visa-type/edit/{id}', 'Backend\PageController@insert_update_current_visa_type');
	Route::get('admin/current-visa-type/delete/{id}', 'Backend\PageController@delete_current_visa_type');

	Route::get('admin/education-level', 'Backend\PageController@education_level');
	Route::post('admin/education_level/get_education_level_list', 'Backend\PageController@get_education_level_list');
	Route::get('admin/education-level/add', 'Backend\PageController@add_education_level');
	Route::post('admin/education-level/add', 'Backend\PageController@insert_update_education_level');
	Route::get('admin/education-level/edit/{id}', 'Backend\PageController@edit_education_level');
	Route::post('admin/education-level/edit/{id}', 'Backend\PageController@insert_update_education_level');
	Route::get('admin/education-level/delete/{id}', 'Backend\PageController@delete_education_level');

	Route::get('admin/job-type', 'Backend\PageController@job_type');
	Route::post('admin/job_type/get_job_type_list', 'Backend\PageController@get_job_type_list');
	Route::get('admin/job-type/add', 'Backend\PageController@add_job_type');
	Route::post('admin/job-type/add', 'Backend\PageController@insert_update_job_type');
	Route::get('admin/job-type/edit/{id}', 'Backend\PageController@edit_job_type');
	Route::post('admin/job-type/edit/{id}', 'Backend\PageController@insert_update_job_type');
	Route::get('admin/job-type/delete/{id}', 'Backend\PageController@delete_job_type');

	Route::get('admin/salary', 'Backend\PageController@salary');
	Route::post('admin/salary/get_salary_list', 'Backend\PageController@get_salary_list');
	Route::get('admin/salary/add', 'Backend\PageController@add_salary');
	Route::post('admin/salary/add', 'Backend\PageController@insert_update_salary');
	Route::get('admin/salary/edit/{id}', 'Backend\PageController@edit_salary');
	Route::post('admin/salary/edit/{id}', 'Backend\PageController@insert_update_salary');
	Route::get('admin/salary/delete/{id}', 'Backend\PageController@delete_salary');

	Route::get('admin/school-type', 'Backend\PageController@school_type');
	Route::post('admin/school_type/get_school_type_list', 'Backend\PageController@get_school_type_list');
	Route::get('admin/school-type/add', 'Backend\PageController@add_school_type');
	Route::post('admin/school-type/add', 'Backend\PageController@insert_update_school_type');
	Route::get('admin/school-type/edit/{id}', 'Backend\PageController@edit_school_type');
	Route::post('admin/school-type/edit/{id}', 'Backend\PageController@insert_update_school_type');
	Route::get('admin/school-type/delete/{id}', 'Backend\PageController@delete_school_type');

	Route::get('admin/start-date', 'Backend\PageController@start_date');
	Route::post('admin/start_date/get_start_date_list', 'Backend\PageController@get_start_date_list');
	Route::get('admin/start-date/add', 'Backend\PageController@add_start_date');
	Route::post('admin/start-date/add', 'Backend\PageController@insert_update_start_date');
	Route::get('admin/start-date/edit/{id}', 'Backend\PageController@edit_start_date');
	Route::post('admin/start-date/edit/{id}', 'Backend\PageController@insert_update_start_date');
	Route::get('admin/start-date/delete/{id}', 'Backend\PageController@delete_start_date');

	Route::get('admin/states', 'Backend\PageController@states');
	Route::post('admin/states/get_states_list', 'Backend\PageController@get_states_list');
	Route::get('admin/states/add', 'Backend\PageController@add_states');
	Route::post('admin/states/add', 'Backend\PageController@insert_update_states');
	Route::get('admin/states/edit/{id}', 'Backend\PageController@edit_states');
	Route::post('admin/states/edit/{id}', 'Backend\PageController@insert_update_states');
	Route::get('admin/states/delete/{id}', 'Backend\PageController@delete_states');

	Route::get('admin/welfare','Backend\Admin\WelfareController@index');
	Route::post('admin/welfare/welfare-list','Backend\Admin\WelfareController@welfareList');
    Route::get('admin/welfare/create','Backend\Admin\WelfareController@create');
    Route::post('admin/welfare','Backend\Admin\WelfareController@store');
    Route::get('admin/welfare/edit/{id}','Backend\Admin\WelfareController@edit');
    Route::post('admin/welfare/{id}','Backend\Admin\WelfareController@update');
    Route::get('admin/welfare/destroy/{id}','Backend\Admin\WelfareController@destroy');

    Route::get('admin/general-location','Backend\Admin\GeneralLocationController@index');
    Route::post('admin/general-location/general-location-list','Backend\Admin\GeneralLocationController@generalLocationList');
    Route::get('admin/general-location/create','Backend\Admin\GeneralLocationController@create');
    Route::post('admin/general-location','Backend\Admin\GeneralLocationController@store');
    Route::get('admin/general-location/edit/{id}','Backend\Admin\GeneralLocationController@edit');
    Route::post('admin/general-location/{id}','Backend\Admin\GeneralLocationController@update');
    Route::get('admin/general-location/destroy/{id}','Backend\Admin\GeneralLocationController@destroy');

    Route::get('admin/visa-type','Backend\Admin\VisaTypeController@index');
    Route::post('admin/visa-type/visa-type-list','Backend\Admin\VisaTypeController@visaTypeList');
    Route::get('admin/visa-type/create','Backend\Admin\VisaTypeController@create');
    Route::post('admin/visa-type','Backend\Admin\VisaTypeController@store');
    Route::get('admin/visa-type/edit/{id}','Backend\Admin\VisaTypeController@edit');
    Route::post('admin/visa-type/{id}','Backend\Admin\VisaTypeController@update');
    Route::get('admin/visa-type/destroy/{id}','Backend\Admin\VisaTypeController@destroy');

    Route::get('admin/working-schedule','Backend\Admin\WorkingScheduleController@index');
    Route::post('admin/working-schedule/working-schedule-list','Backend\Admin\WorkingScheduleController@workingScheduleList');
    Route::get('admin/working-schedule/create','Backend\Admin\WorkingScheduleController@create');
    Route::post('admin/working-schedule','Backend\Admin\WorkingScheduleController@store');
    Route::get('admin/working-schedule/edit/{id}','Backend\Admin\WorkingScheduleController@edit');
    Route::post('admin/working-schedule/{id}','Backend\Admin\WorkingScheduleController@update');
    Route::get('admin/working-schedule/destroy/{id}','Backend\Admin\WorkingScheduleController@destroy');

	// Page End

	    	// Notification
	Route::get('admin/my-notification', 'Backend\NotificationController@notification');	



	// chat part
    Route::get('admin/chat/{username?}','Backend\ChatController@chat');
    Route::get('admin/groupchat','Backend\ChatController@groupchat');
    Route::get('admin/privatechat/{username?}','Backend\ChatController@privatechat');

	Route::post('admin/get_seach_member', 'Backend\ChatController@get_seach_member');
	Route::post('admin/get_seach_member_already', 'Backend\ChatController@get_seach_member_group_already');
	
    
    
});

Route::group(['middleware' => 'school'], function () {

	// save favorite 
	Route::get('school/favorite-teacher', 'Backend\FavoriteController@list');
	Route::get('school/favorite-teacher/delete/{id}', 'Backend\FavoriteController@favorite_teacher_delete');
	
	

	Route::get('school/dashboard', 'Backend\DashboardController@dashboard');


	//travel-arrangements
	Route::get('school/travel','Backend\TravelArrangementController@list');
	Route::get('school/travel/add','Backend\TravelArrangementController@add');
	Route::post('school/travel/add','Backend\TravelArrangementController@insert_update');
	Route::get('school/travel/edit/{id}','Backend\TravelArrangementController@edit');
	Route::post('school/travel/edit/{id}','Backend\TravelArrangementController@insert_update');


	//end travel-arrangements

	
	Route::get('school/profile','Backend\ProfileController@profile');
	Route::post('school/profile','Backend\ProfileController@update_profile');

	Route::get('school/profile-view', 'Backend\ProfileController@profile_view');
	Route::post('school/profile-view', 'Backend\ProfileController@profile_view');

	
	

	Route::get('school/change-password','Backend\ProfileController@change_password');
	Route::post('school/change-password','Backend\ProfileController@update_password');

    Route::get('school/position', 'School\JobController@index');
    Route::get('school/position/add', 'School\JobController@add');
	Route::post('school/position/add','School\JobController@store');
	Route::get('school/position/edit/{id}','School\JobController@edit');
	Route::post('school/position/edit/{id}','School\JobController@update');
	Route::get('school/position/delete/{id}','School\JobController@delete');

	// Notification
	Route::get('school/my-notification', 'Backend\NotificationController@notification');	
	/**
     * Interview
     */
    Route::get('school/interview','Backend\InterviewController@index');
   
    

    // offer
    
    Route::post('school/interview/offer/submit','Backend\OfferController@offer_submit');
    Route::get('school/offer','Backend\OfferController@list');

	// contract
	Route::get('school/contract','Backend\OfferContractController@list');
	Route::post('school/contract/again_submit','Backend\OfferContractController@school_again_submit');
	

    
    Route::post('school/offer/contract/submit','Backend\OfferContractController@contract_submit');
    Route::post('school/offer/admin_contract_submit','Backend\OfferContractController@school_admin_contract_submit');


    /**
     * Apply Job
     */
    Route::get('school/apply/{slug}/{jobslug}', 'School\TeacherApplyController@applyTeacher');
    Route::post('school/apply/{slug}/{jobslug}', 'School\TeacherApplyController@postApplyTeacher');



    // teacher visa 

	Route::get('school/visa','Backend\VisaController@visa');
	Route::post('school/visa','Backend\VisaController@visa_update');
	Route::post('school/visa/china_system','Backend\VisaController@china_system_update');


		// Report
	Route::get('school/report', 'Backend\ReportController@report');	
	Route::post('school/report', 'Backend\ReportController@insert_report');

    Route::get('school/chat','Backend\ChatController@chat');


    Route::get('school/support','Backend\ChatController@privatechat');


    Route::post('school/save_teacher', 'Backend\ProfileController@save_teacher_school');


    Route::get('school/groupchat','Backend\ChatController@groupchat');


	Route::get('school/invoice','Backend\InvoiceController@school_list');    
    
    

});

Route::group(['middleware' => 'teacher'], function () {

	// save favorite 
	Route::get('teacher/favorite-job', 'Backend\FavoriteController@list');
	Route::get('teacher/favorite-job/delete/{id}', 'Backend\FavoriteController@favorite_job_delete');
	
	// Vipul Start
	Route::get('teacher/vipul', 'Backend\VipulController@vipul');
	// Vipul End


	Route::get('teacher/dashboard', 'Backend\DashboardController@dashboard');
	Route::get('teacher/profile', 'Backend\ProfileController@profile');
	Route::post('teacher/profile', 'Backend\ProfileController@update_profile');

	Route::get('teacher/profile-view', 'Backend\ProfileController@profile_view');
	Route::post('teacher/profile-view', 'Backend\ProfileController@profile_view');

	Route::get('teacher/video_delete/{id}', 'Backend\ProfileController@video_delete');



	Route::post('teacher/save_job', 'Backend\ProfileController@save_job_teacher');


	Route::post('teacher/change_tutorial_status', 'Backend\ProfileController@change_tutorial_status');



  	Route::get('teacher/change-password','Backend\ProfileController@change_password');
	Route::post('teacher/change-password','Backend\ProfileController@update_password');
	

	//offer
	Route::get('teacher/offer','Backend\OfferController@list');
	Route::get('teacher/offer/staus/{status}/{id}','Backend\OfferController@offer_change_staus_teacher');
	

	// contract
 	Route::post('teacher/offer/contract/submit','Backend\OfferContractController@teacher_contract_submit');
	Route::get('teacher/contract','Backend\OfferContractController@list');


	

	// visa
	Route::get('teacher/visa','Backend\VisaController@visa');
	Route::post('teacher/visa','Backend\VisaController@visa_update');


	// Report
	Route::get('teacher/report', 'Backend\ReportController@report');	
	Route::post('teacher/report', 'Backend\ReportController@insert_report');


	// Notification
	Route::get('teacher/my-notification', 'Backend\NotificationController@notification');

	
	/**
     * Interview
     */
    Route::get('teacher/interview','Backend\InterviewController@index');

	// travel

	Route::get('teacher/travel','Backend\TravelArrangementController@list');
	Route::post('teacher/travel/upload_flight_ticket','Backend\TravelArrangementController@teacher_upload_flight_ticket');
	
    	

	// feedback 

	Route::get('teacher/feedback','Backend\FeedbackController@list');
	Route::get('teacher/feedback/add','Backend\FeedbackController@add');
	Route::post('teacher/feedback/add','Backend\FeedbackController@insert');
    
    

    /**
     * Apply Job
     */
    Route::get('teacher/apply/{slug}', 'Teacher\JobApplyController@applyJob');
    Route::post('teacher/apply/{slug}', 'Teacher\JobApplyController@postApplyJob');

    Route::get('teacher/chat','Backend\ChatController@chat');


    Route::get('teacher/support','Backend\ChatController@privatechat');

});


Route::group(['middleware' => 'common'], function () {



	Route::get('teacher/profile/location/delete/{id}', 'Backend\ProfileController@location_delete');
	Route::get('teacher/profile/instant_messenger/delete/{id}', 'Backend\ProfileController@instant_messenger_delete');
	

	Route::post('teacher/profile/education/add', 'Backend\ProfileController@add_education');
	Route::get('teacher/profile/education/delete/{id}', 'Backend\ProfileController@delete_education');
	Route::post('teacher/profile/education/edit', 'Backend\ProfileController@edit_education');

	Route::post('teacher/profile/experience/add', 'Backend\ProfileController@add_experience');
	Route::get('teacher/profile/experience/delete/{id}', 'Backend\ProfileController@delete_experience');
	Route::post('teacher/profile/experience/edit', 'Backend\ProfileController@edit_experience');


	Route::get('school/position/accommodation/delete/{job_id}/{id}','School\JobController@accommodation_delete');
	Route::get('school/position/environment/delete/{job_id}/{id}','School\JobController@environment_delete');

	
    Route::get('teacher/matched-position/{slug?}','HomeController@matchedPosition');
    Route::get('school/matched-teacher/{slug?}','HomeController@matchTeacher');	

    Route::get('common/interview/delete/{id}','Backend\InterviewController@delete_interview');
    Route::get('common/offer/delete/{id}','Backend\OfferController@delete_offer');
    

    Route::post('school/interview/change_interview_time_status','Backend\InterviewController@change_interview_time_status');
    Route::post('school/interview/change_confirm_status','Backend\InterviewController@change_confirm_status');

    Route::get('common/contract/delete/{id}','Backend\OfferContractController@contract_delete');

    Route::get('common/travel/delete/{id}','Backend\TravelArrangementController@travel_delete');

	

    Route::post('getchatdata', 'Backend\ChatController@getchatdata');
    Route::post('get_chat_user', 'Backend\ChatController@get_chat_user');
    Route::post('update_message_count', 'Backend\ChatController@update_message_count');


    // private chat

    
    Route::post('getprivatechatdata', 'Backend\ChatController@getprivatechatdata');
    Route::post('update_private_message_count', 'Backend\ChatController@update_private_message_count');
    Route::post('get_private_chat_user', 'Backend\ChatController@get_private_chat_user');


    Route::get('teacher/groupchat','Backend\ChatController@groupchat');

	Route::post('getgroupchatdata', 'Backend\ChatController@getgroupchatdata');
    Route::post('get_chat_group', 'Backend\ChatController@get_chat_group');
    Route::post('add_new_member_group', 'Backend\ChatController@add_new_member_group');
    Route::post('leave_member_group', 'Backend\ChatController@leave_member_group');
    Route::post('update_group_message_count', 'Backend\ChatController@update_group_message_count');

});


Route::post('common/getStateCity', 'Backend\ProfileController@getStateCity');


// Auth
Route::get('login', 'AuthController@login');
Route::post('login', 'AuthController@login_auth');

Route::get('register', 'AuthController@register');
Route::post('register', 'AuthController@register_auth');

Route::get('forgot', 'AuthController@forgot');
Route::post('forgot', 'AuthController@forgot_auth');


Route::get('forgot-username', 'AuthController@forgot_username');
Route::post('forgot-username', 'AuthController@forgot_username_auth');




Route::get('activate/{token}', 'AuthController@activate');
Route::get('reset/{token?}', 'AuthController@reset');
Route::post('reset/{token?}', 'AuthController@reset_auth');

Route::get('logout', 'AuthController@logout');


/**
 * Public Page Url
 */
Route::get('teacher-profile/{id}/{slug?}','HomeController@teacherProfile');
Route::get('school-profile/{slug}','HomeController@schoolProfile');


Route::get('teacher/register','RegisterController@teacher_register');
Route::post('teacher/register','RegisterController@insert_teacher_register');


Route::get('school/register','RegisterController@school_register');
Route::post('school/register','RegisterController@insert_school_register');

Route::post('user/profile/check_user_name', 'Backend\UserController@check_user_name');


Route::get('/', 'HomeController@home');
Route::get('faq', 'HomeController@faq');
Route::get('contact-us', 'HomeController@contact_us');
Route::post('contact-us', 'HomeController@contact_insert');


