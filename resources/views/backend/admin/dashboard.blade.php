@extends('backend.layouts.app')
@section('content')
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
   <!--begin::Subheader-->
   <div class="subheader py-2 py-lg-12  subheader-transparent " id="kt_subheader">
      <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
         <!--begin::Info-->
         <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Heading-->
            <div class="d-flex flex-column">
               <!--begin::Title-->
               <h2 class="text-white font-weight-bold my-2 mr-5">
                  {{ __('dashboard.Dashboard') }}
               </h2>
               <!--end::Title-->
            </div>
            <!--end::Heading-->
         </div>
         <!--end::Info-->
      </div>
   </div>
   <!--end::Subheader-->
   <!--begin::Entry-->
   <div class="d-flex flex-column-fluid">
      <!--begin::Container-->
      <div class=" container ">
         <!--begin::Dashboard-->
         <div class="row">
            <div class="col-xl-12">
               <div class="row">

                  @if(!empty($p_teacher))
                     <a href="{{ url('admin/teacher?teacher_type_id=2') }}"  class="col-md-2">
                        <div class="card card-custom gutter-b" style="height: 150px">
                           <div class="card-body" style="text-align: center;">
                              <i  class="flaticon-users icon-2x text-success"></i>
                              <div style="margin-top: 0px !important;" class="text-dark font-weight-bolder font-size-h2 mt-3">{{ $TotalGoldTeacher }}</div>
                              <div class="text-muted text-hover-primary font-weight-bold font-size-lg mt-1"> {{ __('dashboard.Gold Teachers') }}</div>
                           </div>
                        </div>
                     </a>
                  @endif

                  @if(!empty($p_teacher))
                      <a  href="{{ url('admin/teacher') }}"  class="col-md-2">
                        <div class="card card-custom gutter-b" style="height: 150px">
                           <div class="card-body" style="text-align: center;">
                              <i  class="flaticon-users icon-2x text-success"></i>
                              <div style="margin-top: 0px !important;" class="text-dark font-weight-bolder font-size-h2 mt-3">{{ $TotalTeacher }} <span class="text-success">({{ $TodayTotalTeacher }})</span></div>
                              <div class="text-muted text-hover-primary font-weight-bold font-size-lg mt-1"> {{ __('dashboard.Teachers') }}</div>
                           </div>
                        </div>
                     </a>
                  @endif
                  
                  @if(!empty($p_jobs))
                     <a  href="{{ url('admin/job') }}"  class="col-md-2">
                        <div class="card card-custom gutter-b" style="height: 150px">
                           <div class="card-body" style="text-align: center;">
                              <i class="flaticon-users icon-2x text-success"></i>
                              <div style="margin-top: 0px !important;" class="text-dark font-weight-bolder font-size-h2 mt-3">{{ $TotalJob }} <span class="text-success">({{ $TodayTotalJob }})</span></div>
                              <div class="text-muted text-hover-primary font-weight-bold font-size-lg mt-1"> {{ __('dashboard.Jobs') }}</div>
                           </div>
                        </div>
                     </a>
                   @endif


                  @if(!empty($p_offer))
                  <a href="{{ url('admin/offer') }}"  class="col-md-2">
                     <div class="card card-custom gutter-b" style="height: 150px">
                        <div class="card-body" style="text-align: center;">
                           <i class="flaticon-medal icon-2x text-success"></i>
                           <div style="margin-top: 0px !important;" class="text-dark font-weight-bolder font-size-h2 mt-3">{{ $TotalOffer }} <span class="text-success">({{ $TodayTotalOffer }})</span></div>
                           <div class="text-muted text-hover-primary font-weight-bold font-size-lg mt-1"> {{ __('dashboard.Offer(s)') }}</div>
                        </div>
                     </div>
                  </a>
                  @endif

                  @if(!empty($p_offer))
                  <a href="{{ url('admin/interview') }}"  class="col-md-2">
                     <div class="card card-custom gutter-b" style="height: 150px">
                        <div class="card-body" style="text-align: center;">
                           <i class="flaticon-computer icon-2x text-success"></i>
                           <div style="margin-top: 0px !important;" class="text-dark font-weight-bolder font-size-h2 mt-3">{{ $TotalInterview }} <span class="text-success">({{ $TodayTotalInterview }})</span></div>
                           <div class="text-muted text-hover-primary font-weight-bold font-size-lg mt-1"> {{ __('dashboard.Interview(s)') }}</div>
                        </div>
                     </div>
                  </a>
                  @endif
                  
                  @if(!empty($p_contract))
                  <a href="{{ url('admin/contract') }}"  class="col-md-2">
                     <div class="card card-custom gutter-b" style="height: 150px">
                        <div class="card-body" style="text-align: center;">
                           <i class="flaticon-edit-1 icon-2x text-success"></i>
                           <div style="margin-top: 0px !important;" class="text-dark font-weight-bolder font-size-h2 mt-3">{{ $TotalContract }} <span class="text-success">({{ $TodayTotalContract }})</span></div>
                           <div class="text-muted text-hover-primary font-weight-bold font-size-lg mt-1"> {{ __('dashboard.Contract') }}</div>
                        </div>
                     </div>
                  </a>
                  @endif

                  @if(!empty($p_travel))
                  <a href="{{ url('admin/travel') }}"  class="col-md-2">
                     <div class="card card-custom gutter-b" style="height: 150px">
                        <div class="card-body" style="text-align: center;">
                           <i class="flaticon-rocket icon-2x text-success"></i>
                           <div style="margin-top: 0px !important;" class="text-dark font-weight-bolder font-size-h2 mt-3">{{ $TotalTravel }} <span class="text-success">({{ $TodayTotalTravel }})</span></div>
                           <div class="text-muted text-hover-primary font-weight-bold font-size-lg mt-1"> {{ __('dashboard.Travel Arrangement') }}</div>
                        </div>
                     </div>
                  </a>
                   @endif

                  @if(!empty($p_feedback))
                   <a href="{{ url('admin/feedback') }}"  class="col-md-2">
                     <div class="card card-custom gutter-b" style="height: 150px">
                        <div class="card-body" style="text-align: center;">
                           <i class="flaticon-customer icon-2x text-success"></i>
                           <div style="margin-top: 0px !important;" class="text-dark font-weight-bolder font-size-h2 mt-3">{{ $TotalFeedback }} <span class="text-success">({{ $TodayTotalFeedback }})</span></div>
                           <div class="text-muted text-hover-primary font-weight-bold font-size-lg mt-1"> {{ __('dashboard.Feedback') }}</div>
                        </div>
                     </div>
                  </a>
                  @endif
                 
                 @if(!empty($p_report))
                  <a href="{{ url('admin/report') }}"  class="col-md-2">
                     <div class="card card-custom gutter-b" style="height: 150px">
                        <div class="card-body" style="text-align: center;">
                           <i class="flaticon-warning-sign icon-2x text-success"></i>
                           <div style="margin-top: 0px !important;" class="text-dark font-weight-bolder font-size-h2 mt-3">{{ $TotalReport }} <span class="text-success">({{ $TodayTotalReport }})</span></div>
                           <div class="text-muted text-hover-primary font-weight-bold font-size-lg mt-1"> {{ __('dashboard.Report') }}</div>
                        </div>
                     </div>
                  </a>
                  @endif

                  <a href="{{ url('admin/task') }}"  class="col-md-2">
                     <div class="card card-custom gutter-b" style="height: 150px">
                        <div class="card-body" style="text-align: center;">
                           <i class="flaticon-file-1 icon-2x text-success"></i>
                           <div style="margin-top: 0px !important;" class="text-dark font-weight-bolder font-size-h2 mt-3">{{ $totalTaskMessage }}</div>
                           <div class="text-muted text-hover-primary font-weight-bold font-size-lg mt-1"> {{ __('dashboard.Task') }}</div>
                        </div>
                     </div>
                  </a>
                  
                  
                  <a href="{{ url('admin/chat') }}"  class="col-md-2">
                     <div class="card card-custom gutter-b" style="height: 150px">
                        <div class="card-body" style="text-align: center;">
                           <i class="flaticon-speech-bubble icon-2x text-success"></i>
                           <div style="margin-top: 0px !important;" id="CountDashabordMessage" class="text-dark font-weight-bolder font-size-h2 mt-3">{{ $countdashabordmessage }}</div>
                           <div class="text-muted text-hover-primary font-weight-bold font-size-lg mt-1"> {{ __('dashboard.Chat') }}</div>
                        </div>
                     </div>
                  </a>

                 <a href="{{ url('admin/privatechat') }}"  class="col-md-2">
                     <div class="card card-custom gutter-b" style="height: 150px">
                        <div class="card-body" style="text-align: center;">
                           <i class="flaticon-speech-bubble icon-2x text-success"></i>
                           <div style="margin-top: 0px !important;" id="CountPrivateMessageCount" class="text-dark font-weight-bolder font-size-h2 mt-3">{{ $CountPrivateMessageCount }}</div>
                           <div class="text-muted text-hover-primary font-weight-bold font-size-lg mt-1">{{ __('dashboard.Private Chat') }}</div>
                        </div>
                     </div>
                  </a>

               </div>
               <!--begin::Tiles Widget 13-->
               <!--end::Tiles Widget 13-->
            </div>
         </div>

@if(!empty($p_offer))
      <div class="row">
         <div class="col-lg-12 col-xxl-12">
            <!--begin::Advance Table Widget 1-->
            <div class="card card-custom card-stretch gutter-b">
               <!--begin::Header-->
               <div class="card-header border-0 py-5">
                  <h3 class="card-title align-items-start flex-column">
                     <span class="card-label font-weight-bolder text-dark">{{ __('dashboard.Today Offers') }}</span>
                  </h3>
                  <div class="card-toolbar">
                     <a href="{{ url('admin/offer') }}" class="btn btn-success font-weight-bolder font-size-sm">
                     <i class="flaticon2-list-2 "></i>
                     {{ __('dashboard.View All Offers') }}
                     </a>
                  </div>
               </div>
               <!--end::Header-->
               <!--begin::Body-->
               <div class="card-body py-0">
                  <!--begin::Table-->
                  <table class="table table-borderless table-vertical-center">
                     <tbody>
                     @forelse($get_today_offer as $offer)            
                        <tr>
                           
                           <td class="pl-0">
                              <div style="padding-left: 10px;">
                                 <a href="{{ url('school-profile/'.$offer->job_apply->job->slug) }}" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $offer->job_apply->job->user->school_id }}</a>
                                   <a href="{{ url('admin/privatechat/'.$offer->job_apply->job->user->username) }}" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                 <i class="flaticon-speech-bubble text-primary"></i>
                                 </a>

                                 <div>
                                    <span class="font-weight-bolder">{{ $offer->job_apply->job->user->school_name }}</span>
                                 </div>      

                                 <div>
                                    <span class="font-weight-bolder">{{ __('dashboard.Location') }}:</span>
                                    <a class="text-muted font-weight-bold text-hover-primary">{{ $offer->job_apply->job->get_location() }}</a>
                                 </div>
                                 <div>
                                    <span class="font-weight-bolder">{{ __('dashboard.Staff') }}:</span>
                                    <a class="text-muted font-weight-bold text-hover-primary">{{ !empty($offer->job_apply->job->user->staff) ? $offer->job_apply->job->user->staff->name : '' }}</a>
                                 </div>

                              </div>
                           </td>

                           <td class="p-0 py-4">
                              <div class="symbol symbol-50 symbol-light">
                                 <span class="symbol-label">
                                 <img src="{!! $offer->job_apply->user->getImage() !!}" style="height: auto !important;width: 100%;" class="h-50 align-self-center" alt="">
                                 </span>
                              </div>
                           </td>
                           <td class="pl-0">
                              <div style="padding-left: 10px;">
                                 <a href="{{ url('teacher-profile/'.$offer->job_apply->user->username) }}" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $offer->job_apply->user->teacher_id }}</a>
                                 <a href="{{ url('admin/privatechat/'.$offer->job_apply->user->username) }}" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                 <i class="flaticon-speech-bubble text-primary"></i>
                                 </a>
                                 
                                 <div>
                                    <span class="font-weight-bolder">{{ $offer->job_apply->user->name }}</span>
                                 </div> 

                                 <div>
                                    <span class="font-weight-bolder">{{ __('dashboard.Nationality') }}:</span>
                                    <a class="text-muted font-weight-bold text-hover-primary">{{ !empty($offe->job_applyr->user->nationality) ? $offer->job_apply->user->nationality->getName() : '' }}</a>
                                 </div>
                                  <div>
                                    <span class="font-weight-bolder">{{ __('dashboard.Staff') }}:</span>
                                    <a class="text-muted font-weight-bold text-hover-primary">{{ !empty($offer->job_apply->user->staff) ? $offer->job_apply->user->staff->name : '' }}</a>
                                 </div>
                              </div>
                           </td>


                         
                           
                           <td class="text-right">
                              <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                             ¥ {{ $offer->salary }}
                              </span>
                              <span class="text-muted font-weight-bold">
                              {{ __('dashboard.Monthly') }} ({{ $offer->tax->name }})
                              </span>
                           </td>
                           <td class="text-right">
                              {{ date('Y-m-d h:i A',strtotime($offer->created_at)) }}
                           </td>
                           <td class="text-right">
                              <select class="form-control ChangeOfferStatus" id="{{ $offer->id }}">
                                 @foreach($get_offer_status as $offer_status)
                                   <option {{ ($offer->status == $offer_status->id) ? 'selected' : '' }} value="{{ $offer_status->id }}">{{ $offer_status->name }}</option>
                                 @endforeach
                              </select>   
                              
                           </td>
                           <td class="pr-0 text-right">
                              <a href="{{ url('admin/offer') }}" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                              <i class="flaticon-eye text-primary"></i>
                              </a>

                           </td>
                        </tr>
                        @empty
                        @endforelse
                     </tbody>
                  </table>
                  <!--end::Table-->
               </div>
               <!--end::Body-->
            </div>
            <!--end::Advance Table Widget 1-->
         </div>
      </div>      
@endif

@if(!empty($p_interview))
   <div class="row">
      <div class="col-lg-12 col-xxl-12">
         <!--begin::Advance Table Widget 1-->
         <div class="card card-custom card-stretch gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0 py-5">
               <h3 class="card-title align-items-start flex-column">
                  <span class="card-label font-weight-bolder text-dark">{{ __('dashboard.Today Interviews') }}</span>
               </h3>
               <div class="card-toolbar">
                  <a href="{{ url('admin/interview') }}" class="btn btn-success font-weight-bolder font-size-sm">
                  <i class="flaticon2-list-2 "></i>
                  {{ __('dashboard.View All Interviews') }}
                  </a>
               </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body py-0">
               <!--begin::Table-->
               <table class="table table-borderless table-vertical-center">
                  <tbody>
                     @foreach($get_today_interview as $interview)
                     <tr>
                    
                        <td class="pl-0">
                           <div style="padding-left: 10px;">
                              <a href="{{ url('school-profile/'.$interview->job->slug) }}" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $interview->job->user->school_id }}</a>
                                <a href="{{ url('admin/privatechat/'.$interview->job->user->username) }}" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                              <i class="flaticon-speech-bubble text-primary"></i>
                              </a>

                              <div>
                                 <span class="font-weight-bolder">{{ $interview->job->user->school_name }}</span>
                              </div>      

                              <div>
                                 <span class="font-weight-bolder">{{ __('dashboard.Location') }}:</span>
                                 <a class="text-muted font-weight-bold text-hover-primary">{{ $interview->job->get_location() }}</a>
                              </div>
                              <div>
                                 <span class="font-weight-bolder">{{ __('dashboard.Staff') }}:</span>
                                 <a class="text-muted font-weight-bold text-hover-primary">{{ !empty($interview->job->user->staff) ? $interview->job->user->staff->name : '' }}</a>
                              </div>

                           </div>
                        </td>
                        <td class="p-0 py-4">
                           <div class="symbol symbol-50 symbol-light">
                              <span class="symbol-label">
                              <img src="{!! $interview->user->getImage() !!}" style="height: auto !important;width: 100%;" class="h-50 align-self-center" alt="">
                              </span>
                           </div>
                        </td>
                        <td class="pl-0">
                           <div style="padding-left: 10px;">
                              <a href="{{ url('teacher-profile/'.$interview->user->username) }}" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $interview->user->teacher_id }}</a>
                              <a href="{{ url('admin/privatechat/'.$interview->user->username) }}" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                              <i class="flaticon-speech-bubble text-primary"></i>
                              </a>
                              
                              <div>
                                 <span class="font-weight-bolder">{{ $interview->user->name }}</span>
                              </div> 

                              <div>
                                 <span class="font-weight-bolder">{{ __('dashboard.Nationality') }}:</span>
                                 <a class="text-muted font-weight-bold text-hover-primary">{{ !empty($interview->user->nationality) ? $interview->user->nationality->getName() : '' }}</a>
                              </div>
                               <div>
                                 <span class="font-weight-bolder">{{ __('dashboard.Staff') }}:</span>
                                 <a class="text-muted font-weight-bold text-hover-primary">{{ !empty($interview->user->staff) ? $interview->user->staff->name : '' }}</a>
                              </div>
                           </div>
                        </td>
                        
                        <td class="text-right">
                           {{ date('Y-m-d h:i A',strtotime($interview->created_at)) }}
                        </td>
                       
                        <td class="text-right">
                           <select class="form-control ChangeInterviewStatus" id="{{ $interview->id }}">
                              @foreach($get_interview_status as $interview_status)
                                <option {{ ($interview->status == $interview_status->id) ? 'selected' : '' }} value="{{ $interview_status->id }}">{{ $interview_status->name }}</option>
                              @endforeach
                           </select>                              
                        </td>
                        <td class="pr-0 text-right">
                           <span class="label label-lg {{ $interview->getstatus->class }} label-inline">{{ $interview->getstatus->name }}</span>

                           <a href="{{ url('admin/interview') }}" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                           <i class="flaticon-eye text-primary"></i>
                           </a>
                            
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
               <!--end::Table-->
            </div>
            <!--end::Body-->
         </div>
         <!--end::Advance Table Widget 1-->
      </div>
   </div>
@endif
         




             <!--begin::Row-->
         <div class="row">
            <div class="col-lg-6 col-xxl-6">
               <!--begin::Advance Table Widget 1-->
               <div class="card card-custom card-stretch gutter-b">
                  <!--begin::Header-->
                  <div class="card-header border-0 py-5">
                     <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">{{ __('dashboard.Message') }}</span>
                     </h3>
                     <div class="card-toolbar">
                        <a href="{{ url('admin/privatechat') }}" class="btn btn-success font-weight-bolder font-size-sm">
                        <i class="flaticon2-list-2 "></i>
                        {{ __('dashboard.View All Message') }}
                        </a>
                     </div>
                  </div>
                  <!--end::Header-->
                  <!--begin::Body-->
                  <div class="card-body py-0">
                     <!--begin::Table-->
                     <div class="table-responsive">
                        <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_1">
                           <thead>
                              <tr class="text-left">
                                 <th class="pr-0">{{ __('dashboard.Name') }}</th>
                                 <th></th>
                                 <th class="pr-0 text-right" style="min-width: 150px">{{ __('dashboard.action') }}</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach($getChatUserMessage as $value_message)
                              <tr>
                                 <td class="pr-0">
                                    <div class="symbol symbol-50 symbol-light mt-1">
                                       <span class="symbol-label">
                                       <img style="max-width: 100%;" src="{{  $value_message->getconnectuser->getImage() }}" class="h-75 align-self-end" alt=""/>
                                       </span>
                                    </div>
                                 </td>
                                 <td class="pl-0">
                                    <a href="javascript:;" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $value_message->getName() }}</a>
                                    <a href="javascript:;" class="text-muted font-weight-bold  text-hover-primary text-muted d-block">
                                       {{  $value_message->message }}
                                    </a>
                                 </td>
                                 <td class="pr-0 text-right">
                                    <a href="{{ url('admin/privatechat/'.$value_message->getconnectuser->username) }}" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                    <i class="flaticon-speech-bubble text-primary"></i>
                                    </a>
                                    
                                 </td>
                              </tr>
                              @endforeach
                           </tbody>
                        </table>
                     </div>
                     <!--end::Table-->
                  </div>
                  <!--end::Body-->
               </div>
               <!--end::Advance Table Widget 1-->
            </div>

           <div class="col-lg-6 col-xxl-6">
               <div class="card card-custom card-stretch gutter-b">

                  <div class="card-header border-0 py-5">
                     <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">{{ __('dashboard.Notifications') }}</span>
                     </h3>
                     <div class="card-toolbar">
                        <a href="{{ url('admin/my-notification') }}" class="btn btn-success font-weight-bolder font-size-sm">
                        <i class="flaticon2-list-2 "></i>
                        {{ __('dashboard.View All Notifications') }}
                        </a>
                     </div>
                  </div>

                  <div class="card-body pt-0">
                           @php
                              $user_notification = App\Models\NotificationModel::get_staff_notification();
                           @endphp

                           @foreach($user_notification as $notification)
                                 @php
                                   $getdata = json_decode($notification->data);
                                @endphp
                           <!--begin::Item-->
                           <div class="mb-6">
                              <!--begin::Content-->
                              <div class="d-flex align-items-center flex-grow-1">
                                 <!--begin::Section-->
                                 <div class="d-flex flex-wrap align-items-center justify-content-between w-100">
                                    <!--begin::Info-->
                                    <div class="d-flex flex-column align-items-cente py-2">
                                       <!--begin::Title-->
                                       <a href="{{ url('admin/my-notification?id='.$notification->notification_id) }}" class="text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1">
                                       {{  $getdata->message  }}
                                       </a>
                                       <!--end::Title-->
                                       <!--begin::Data-->
                                       <span class="text-muted font-weight-bold">
                                       {{ Carbon\Carbon::parse($notification->created_at)->diffForHumans()}}
                                       </span>
                                       <!--end::Data-->
                                    </div>
                                    <!--end::Info-->
                                 </div>
                                 <!--end::Section-->
                              </div>
                              <!--end::Content-->
                           </div>
                           @endforeach
                        </div>
                  <!--end::Body-->
               </div>
               <!--end::Advance Table Widget 1-->
            </div>


       
         </div>
         <!--end::Row-->

         <!--begin::Row-->
         <div class="row">

         @if(!empty($p_teacher))

            <div class="col-lg-6 col-xxl-6">
               <div class="card card-custom card-stretch gutter-b">
                  <!--begin::Header-->
                  <div class="card-header border-0 py-5">
                     <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">{{ __('dashboard.Today Teachers') }}</span>
                     </h3>
                     <div class="card-toolbar">
                        <a href="{{ url('admin/teacher') }}" class="btn btn-success font-weight-bolder font-size-sm">
                        <i class="flaticon2-list-2 "></i>
                        {{ __('dashboard.View All Teachers') }}
                        </a>
                     </div>
                  </div>
                  <!--end::Header-->
                  <!--begin::Body-->
                  <div class="card-body py-0">
                     <!--begin::Table-->
                     <div class="table-responsive">
                        <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_1">
                           <thead>
                              <tr class="text-left">
                                 <th class="pr-0">{{ __('dashboard.Name') }}</th>
                                 <th></th>
                                 <th class="pr-0 text-right" style="min-width: 150px">{{ __('dashboard.action') }}</th>
                              </tr>
                           </thead>
                           <tbody>
                           @foreach($get_today_teachers as $teacher)
                              <tr>
                                 <td class="pr-0">
                                    <div class="symbol symbol-50 symbol-light mt-1">
                                       <span class="symbol-label">
                                       <img src="{!! $teacher->getImage() !!}" style="height: auto !important;width: 100%;" class="h-75 align-self-end" alt=""/>
                                       </span>
                                    </div>
                                 </td>
                                 <td class="pl-0">
                                    <a href="javascript:;" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $teacher->name }} ({{ $teacher->teacher_id }})</a>
                                    <a href="{{ url('teacher-profile/'.$teacher->username) }}" class="text-muted font-weight-bold  text-hover-primary text-muted d-block">{{ __('dashboard.View Public Profile') }}</a>
                                 </td>
                                 <td class="pr-0 text-right">
                                    <a href="{{ url('admin/teacher/edit/'.$teacher->id) }}" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                    <i class="flaticon-edit-1 text-primary"></i>
                                    </a>
                                 </td>
                              </tr>
                              @endforeach
                           </tbody>
                        </table>
                     </div>
                     <!--end::Table-->
                  </div>
                  <!--end::Body-->
               </div>
               <!--end::Advance Table Widget 1-->
            </div>

         @endif

          @if(!empty($p_jobs))

            <div class="col-lg-6 col-xxl-6">
               <div class="card card-custom card-stretch gutter-b">
                  <div class="card-header border-0 py-5">
                     <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">{{ __('dashboard.Today Jobs') }}</span>
                     </h3>
                     <div class="card-toolbar">
                        <a href="{{ url('admin/job') }}" class="btn btn-success font-weight-bolder font-size-sm">
                        <i class="flaticon2-list-2 "></i>
                        {{ __('dashboard.View All Jobs') }}
                        </a>
                     </div>
                  </div>
                  <!--end::Header-->
                  <!--begin::Body-->
                  <div class="card-body py-0">
                     <!--begin::Table-->
                     <div class="table-responsive">
                        <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_1">
                           <thead>
                              <tr class="text-left">
                                 <th class="pr-0">{{ __('dashboard.Name') }}</th>
                                 <th class="pr-0 text-right" style="min-width: 150px">{{ __('dashboard.action') }}</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach($get_today_job as $job)
                              <tr>
                                 <td class="pl-0">
                                    <a href="javascript:;" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $job->user->school_name }} ({{ $job->user->school_id }})</a>
                                    <a href="{{ url('school-profile/'.$job->slug) }}" class="text-muted font-weight-bold  text-hover-primary text-muted d-block">{{ __('dashboard.View Public Profile') }}</a>
                                 </td>
                                 <td class="pr-0 text-right">
                                    <a href="{{ url('admin/job/edit/'.$job->id) }}" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                    <i class="flaticon-edit-1 text-primary"></i>
                                    </a>                                    
                                 </td>
                              </tr>
                              @endforeach
                           </tbody>
                        </table>
                     </div>
                     <!--end::Table-->
                  </div>
                  <!--end::Body-->
               </div>
               <!--end::Advance Table Widget 1-->
            </div>      

          @endif      


         </div>
         <!--end::Row-->            
         <!--end::Dashboard-->
      </div>
      <!--end::Container-->
   </div>
   <!--end::Entry-->
</div>
@endsection


@section('script')

<script type="text/javascript">

  
$('body').delegate('.ChangeOfferStatus','change',function(){

   var id = $(this).attr('id');
   var status = $(this).val();
   $.ajax({
      url: "{{ url('admin/offer/change_status') }}",
      type: "POST",
      data:{
        "_token": "{{ csrf_token() }}",
          id:id,
          status:status,
       },
       dataType:"json",
       success:function(response){
           alert(response.success);
       },
   });
});




$('body').delegate('.ChangeInterviewStatus','change',function(){

   var id = $(this).attr('id');
   var status = $(this).val();
   $.ajax({
      url: "{{ url('admin/interview/change_status') }}",
      type: "POST",
      data:{
        "_token": "{{ csrf_token() }}",
          id:id,
          status:status,
       },
       dataType:"json",
       success:function(response){
           alert(response.success);
           location.reload();
       },
   });
});

</script>

@endsection