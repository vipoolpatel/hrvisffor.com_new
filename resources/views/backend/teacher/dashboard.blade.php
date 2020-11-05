@extends('backend.layouts.app')
@section('content')
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
   <!--begin::Subheader-->
   <div class="subheader py-2 py-lg-12  subheader-transparent " id="kt_subheader">
      <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
         <!--begin::Info-->
         <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Mobile Toggle-->
            <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none" id="kt_subheader_mobile_toggle">
            <span></span>
            </button>
            <!--end::Mobile Toggle-->
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
         <!--begin::Profile Overview-->
         <div class="d-flex flex-row">
            <!--begin::Aside-->
            @include('backend.layouts._sidebar_shcool_teacher')
            <!--end::Aside-->
            <!--begin::Content-->
            <div class="flex-row-fluid ml-lg-8">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="row">
                        <a href="{{ url('teacher/profile-view') }}" class="col-md-3">
                           <!--begin::Tiles Widget 12-->
                           <div class="card card-custom gutter-b" style="height: 150px">
                              <div class="card-body" style="text-align: center;">
                                 <i  class="flaticon-users icon-2x text-success"></i>
                                 <div style="margin-top: 0px !important;" class="text-dark font-weight-bolder font-size-h2 mt-3">{{ $user->profile_view() }}</div>
                                 <div class="text-muted text-hover-primary font-weight-bold font-size-lg mt-1">{{ __('dashboard.Profile Views') }}</div>
                              </div>
                           </div>
                           <!--end::Tiles Widget 12-->
                        </a>
                        <a href="{{ url('teacher/interview') }}" class="col-md-3">
                           <!--begin::Tiles Widget 12-->
                           <div class="card card-custom gutter-b" style="height: 150px">
                              <div class="card-body" style="text-align: center;">
                                 <i class="flaticon-computer icon-2x text-success"></i>
                                 <div style="margin-top: 0px !important;" class="text-dark font-weight-bolder font-size-h2 mt-3">{{ $total_job_teacher_interview }}</div>
                                 <div class="text-muted text-hover-primary font-weight-bold font-size-lg mt-1">{{ __('dashboard.Interview') }}</div>
                              </div>
                           </div>
                           <!--end::Tiles Widget 12-->
                        </a>
                        <a href="{{ url('teacher/offer') }}" class="col-md-2">
                           <!--begin::Tiles Widget 12-->
                           <div class="card card-custom gutter-b" style="height: 150px">
                              <div class="card-body" style="text-align: center;">
                                 <i class="flaticon-medal icon-2x text-success"></i>
                                 <div style="margin-top: 0px !important;" class="text-dark font-weight-bolder font-size-h2 mt-3">{{ $TotalOffer }}</div>
                                 <div class="text-muted text-hover-primary font-weight-bold font-size-lg mt-1">{{ __('dashboard.Offer') }}</div>
                              </div>
                           </div>
                           <!--end::Tiles Widget 12-->
                        </a>
                        <a href="{{ url('teacher/chat') }}" class="col-md-2">
                           <!--begin::Tiles Widget 12-->
                           <div class="card card-custom gutter-b" style="height: 150px">
                              <div class="card-body" style="text-align: center;">
                                 <i class="flaticon-speech-bubble icon-2x text-success"></i>
                                 <div style="margin-top: 0px !important;" id="CountDashabordMessage" class="text-dark font-weight-bolder font-size-h2 mt-3">{{ $countdashabordmessage }}</div>
                                 <div class="text-muted text-hover-primary font-weight-bold font-size-lg mt-1">{{ __('dashboard.Messages') }}</div>
                              </div>
                           </div>
                           <!--end::Tiles Widget 12-->
                        </a>

                        <a href="{{ url('teacher/support') }}" class="col-md-2">
                           <div class="card card-custom gutter-b" style="height: 150px">
                              <div class="card-body" style="text-align: center;">
                                 <i class="flaticon-speech-bubble icon-2x text-success"></i>
                                 <div style="margin-top: 0px !important;" id="CountPrivateMessageCount" class="text-dark font-weight-bolder font-size-h2 mt-3">{{ $CountPrivateMessageCount }}</div>
                                 <div class="text-muted text-hover-primary font-weight-bold font-size-lg mt-1">{{ __('dashboard.24/7 Support') }}</div>
                              </div>
                           </div>
                        </a>

                     </div>
                     <!--begin::Tiles Widget 13-->
                     <!--end::Tiles Widget 13-->
                  </div>
               </div>
               <div class="row">
                  <!--begin::Row-->
                  <div class="col-lg-6">
                     <!--begin::List Widget 14-->
                     <div class="card card-custom card-stretch gutter-b">
                        <!--begin::Header-->
                        <div class="card-header border-0">
                           <h3 class="card-title font-weight-bolder text-dark">{{ __('dashboard.Recommended Jobs') }}</h3>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-2">

                           @foreach($getRecommendedJobs as $value)

                           @php
                                 $getdata = json_decode($value->data);
                                 $job = App\Models\Job::get_single_job($getdata->common_id);
                            @endphp
                            @if(!empty($job) && !empty($job->user))
                              <!--begin::Item-->
                              <div class="d-flex flex-wrap align-items-center mb-10">

                                 <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                                    <a href="{{ url('school-profile/'.$job->slug) }}" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">
                                    {{ $job->user->school_id }}</a>

                                    @if(!empty($job->get_location()))
                                       <span class="text-muted font-weight-bold font-size-sm my-1">{{ __('dashboard.Location') }}: {{ $job->get_location() }}</span>
                                    @endif

                                    @if(!empty($job->get_salary_minimum) && !empty($job->get_salary_maximum))
                                       <span class="text-muted font-size-sm font-weight-bolder">{{ __('dashboard.Salary') }}: {{ $job->get_salary_minimum->name }} - {{ $job->get_salary_maximum->name }}</span>
                                    @endif

                                 </div>
                               
                              </div>

                              @endif

                           @endforeach

                        </div>
                        <!--end::Body-->
                     </div>
                     <!--end::List Widget 14-->
                  </div>
                  <div class="col-lg-6">
                     <!--begin::List Widget 10-->
                     <div class="card card-custom  card-stretch gutter-b">
                        <!--begin::Header-->
                        <div class="card-header border-0">
                           <h3 class="card-title font-weight-bolder text-dark">{{ __('dashboard.Notifications') }}</h3>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-0">
                           @php
                              $user_notification = App\Models\UsersModel::get_single(Auth::user()->id);
                           @endphp

                           @foreach($user_notification->unreadNotifications as $notification)
                           <!--begin::Item-->
                           <div class="mb-6">
                              <!--begin::Content-->
                              <div class="d-flex align-items-center flex-grow-1">
                                 <!--begin::Section-->
                                 <div class="d-flex flex-wrap align-items-center justify-content-between w-100">
                                    <!--begin::Info-->
                                    <div class="d-flex flex-column align-items-cente py-2">
                                       <!--begin::Title-->
                                       <a href="{{ url('teacher/my-notification?id='.$notification->id) }}" class="text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1">
                                       {!! $notification->data['message'] !!}
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
                        <!--end: Card Body-->
                     </div>
                     <!--end: Card-->
                     <!--end: List Widget 10-->
                  </div>
               </div>
               <!--end::Row-->
               <div class="card card-custom gutter-b">
                  <!--begin::Header-->
                  <div class="card-header border-0 pt-5">
                     <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">{{ __('dashboard.Interview(s)') }}</span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm">{{ __('dashboard.Todays interviews') }}</span>
                     </h3>
                  </div>
                  <!--end::Header-->
                  <!--begin::Body-->
                  <div class="card-body py-2">
                     <!--begin::Table-->
                     <div class="table-responsive">
                        <table class="table table-borderless table-vertical-center">
                           <tbody>
                             @foreach($get_today_teacher_interview as $interview)
                              <tr>
                                 <td class="pl-0">
                                       <a href="{{ url('school-profile/'.$interview->job->slug) }}" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $interview->job->user->school_id }}</a>
                                       <div>
                                          <span class="font-weight-bolder">{{ __('dashboard.Location') }}:</span>
                                          <a class="text-muted font-weight-bold text-hover-primary">{{ $interview->job->get_location() }}</a>
                                       </div>
                                 </td>
                                 <td class="text-right">
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                          @if(!empty($interview->job->get_salary_minimum)) {{ $interview->job->get_salary_minimum->name }} - @endif  @if(!empty($interview->job->get_salary_maximum)) {{ $interview->job->get_salary_maximum->name }} @endif
                                    </span>                                   
                                 </td>
                                 <td class="text-right">
                                    <button class="btn btn-primary btn-sm">{{ date('Y-m-d h:i A',$interview->interview_date_time) }}</button>
                                 </td>
                                 <td class="text-right">
                                    <span class="label label-lg label-light-primary label-inline">{{ __('dashboard.Confirmed') }}</span>
                                 </td>
                                 <td class="pr-0 text-right">
                                    <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                    <i class="flaticon-computer text-primary"></i>
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
               <!--begin::Advance Table: Widget 7-->
               <!--end::Advance Table Widget 7-->
            </div>
            <!--end::Content-->
         </div>
         <!--end::Profile Overview-->
      </div>
      <!--end::Container-->
   </div>
   <!--end::Entry-->
</div>
@endsection