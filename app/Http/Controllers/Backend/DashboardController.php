<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UsersModel;
use App\Models\JobApply;
use App\Models\Job;
use App\Models\NotificationModel;
use App\Models\InterviewStatusModel;
use App\Models\TeacherJobInterviewTime;
use App\Models\OfferModel;
use App\Models\OfferStatusModel;
use App\Models\OfferContractModel;
use App\Models\TravelModel;
use App\Models\FeedbackModel;
use App\Models\ReportModel;
use App\Models\AdminPermissionModel;
use App\Models\ChatModel;
use App\Models\PrivateChatModel;
use App\Models\RecommendedTeachersModel;
use App\Models\TaskReplyModel;











use Auth;

class DashboardController extends Controller
{
    public function dashboard() {
    	
		$data['user'] = UsersModel::get_single(Auth::user()->id);
		$data['countdashabordmessage'] = ChatModel::countdashabordmessage(Auth::user()->id);
		
		$data['CountPrivateMessageCount'] = PrivateChatModel::countdashabordmessage(Auth::user()->id);

		$data['getChatUserMessage'] = PrivateChatModel::getChatUserDashboard(Auth::user()->id);
		
		if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
		{
			$data['p_teacher'] 	= AdminPermissionModel::getPermission('teacher');
			$data['p_jobs'] 	= AdminPermissionModel::getPermission('jobs');
			$data['p_interview']= AdminPermissionModel::getPermission('interview');
			$data['p_contract'] = AdminPermissionModel::getPermission('contract');
			$data['p_travel'] 	= AdminPermissionModel::getPermission('travel');
			$data['p_feedback'] = AdminPermissionModel::getPermission('feedback');
			$data['p_report'] 	= AdminPermissionModel::getPermission('report');
			$data['p_offer'] 	= AdminPermissionModel::getPermission('offer');


			$data['totalTaskMessage']  	= TaskReplyModel::totalMessageCount(Auth::user()->id);

			$data['TotalTeacher'] 		= UsersModel::getTotalTeacher($date = '', 4);
			$data['TodayTotalTeacher'] 	= UsersModel::getTotalTeacher(date('Y-m-d'), 4);			
			$data['TotalGoldTeacher'] 	= UsersModel::getTotalGoldTeacher(2, 4);

			$data['TotalJob'] 			= Job::getTotalJob($date = '');
			$data['TodayTotalJob'] 		= Job::getTotalJob(date('Y-m-d'));

			$data['TotalInterview'] 	 = JobApply::getTotalInterview($date = '');
			$data['TodayTotalInterview'] = JobApply::getTotalInterview(date('Y-m-d'));

			$data['get_today_interview']  = JobApply::get_today_interview();
			$data['get_interview_status'] = InterviewStatusModel::get_record();

			$data['get_today_teachers'] = UsersModel::get_today_teachers();
			$data['get_today_job'] 		= Job::get_today_job();


			$data['TotalOffer'] 			= OfferModel::getTotalOffer($date = '');
			$data['TodayTotalOffer'] 		= OfferModel::getTotalOffer(date('Y-m-d'));

			$data['TotalContract'] 			= OfferContractModel::getTotalContract($date = '');
			$data['TodayTotalContract'] 	= OfferContractModel::getTotalContract(date('Y-m-d'));

			$data['TotalTravel'] 			= TravelModel::getTotalTravel($date = '');
			$data['TodayTotalTravel'] 		= TravelModel::getTotalTravel(date('Y-m-d'));

			$data['TotalFeedback'] 			= FeedbackModel::getTotalFeedback($date = '');
			$data['TodayTotalFeedback'] 		= FeedbackModel::getTotalFeedback(date('Y-m-d'));

			$data['TotalReport'] 			= ReportModel::getTotalReport($date = '');
			$data['TodayTotalReport'] 		= ReportModel::getTotalReport(date('Y-m-d'));
			

			$data['get_today_offer'] 		= OfferModel::get_today_offer(date('Y-m-d'));
			$data['get_offer_status'] 		= OfferStatusModel::get_record();
			
			return view('backend.admin.dashboard',$data);

		}
		else if(Auth::user()->is_admin == 3)
		{
			$data['getRecommendedTeachers'] = RecommendedTeachersModel::getRecommendedTeachers(Auth::user()->id);
			$data['TotalOffer'] 			= OfferModel::getTotalOfferSchool(Auth::user()->id);


			$data['get_today_school_interview'] = JobApply::get_today_school_interview(Auth::user()->id);
			$data['total_job_school_interview'] = JobApply::get_total_job_school_interview(Auth::user()->id);

			
			return view('backend.school.dashboard',$data);	
		}	
		else if(Auth::user()->is_admin == 4)
		{
			$data['TotalOffer'] 			= OfferModel::getTotalOfferTeacher(Auth::user()->id);
			$data['getRecommendedJobs'] = NotificationModel::getRecommendedJobs(Auth::user()->id);
			$data['total_job_teacher_interview'] = JobApply::get_total_job_teacher_interview(Auth::user()->id);
			$data['get_today_teacher_interview'] = JobApply::get_today_teacher_interview(Auth::user()->id);
			
			return view('backend.teacher.dashboard',$data);
		}
		
	}
}
