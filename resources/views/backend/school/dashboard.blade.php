@extends('backend.layouts.app')
@section('content')
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
   <!--begin::Subheader-->
   <div class="subheader py-2 py-lg-12  subheader-transparent " id="kt_subheader">
      <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
         <!--begin::Info-->
         <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Mobile Toggle-->
            <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none"
               id="kt_subheader_mobile_toggle">
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
            @include('backend.layouts._sidebar_school')
            <!--end::Aside-->
            <!--begin::Content-->
            <div class="flex-row-fluid ml-lg-8">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="row">
                        <a href="{{ url('school/profile-view') }}" class="col-md-3">
                           <!--begin::Tiles Widget 12-->
                           <div class="card card-custom gutter-b" style="height: 150px">
                              <div class="card-body" style="text-align: center;">
                                 <i class="flaticon-users icon-2x text-success"></i>
                                 <div style="margin-top: 0px !important;"
                                    class="text-dark font-weight-bolder font-size-h2 mt-3">{{ $user->position_view_school() }}
                                 </div>
                                 <div  class="text-muted text-hover-primary font-weight-bold font-size-lg mt-1">{{ __('dashboard.Position Views') }}</div>
                              </div>
                           </div>
                           <!--end::Tiles Widget 12-->
                        </a>
                        <a href="{{ url('school/interview') }}"  class="col-md-3">
                           <!--begin::Tiles Widget 12-->
                           <div class="card card-custom gutter-b" style="height: 150px">
                              <div class="card-body" style="text-align: center;">
                                 <i class="flaticon-computer icon-2x text-success"></i>
                                 <div style="margin-top: 0px !important;"
                                    class="text-dark font-weight-bolder font-size-h2 mt-3"> {{ $total_job_school_interview }}
                                 </div>
                                 <div class="text-muted text-hover-primary font-weight-bold font-size-lg mt-1">{{ __('dashboard.Interview') }}</div>
                              </div>
                           </div>
                           <!--end::Tiles Widget 12-->
                        </a>
                        <a href="{{ url('school/offer') }}" class="col-md-2">
                           <!--begin::Tiles Widget 12-->
                           <div class="card card-custom gutter-b" style="height: 150px">
                              <div class="card-body" style="text-align: center;">
                                 <i class="flaticon-medal icon-2x text-success"></i>
                                 <div style="margin-top: 0px !important;"
                                    class="text-dark font-weight-bolder font-size-h2 mt-3">{{ $TotalOffer }}
                                 </div>
                                 <div class="text-muted text-hover-primary font-weight-bold font-size-lg mt-1">{{ __('dashboard.Offer') }}</div>
                              </div>
                           </div>
                           <!--end::Tiles Widget 12-->
                        </a>
                        <a href="{{ url('school/chat') }}" class="col-md-2">
                           <!--begin::Tiles Widget 12-->
                           <div class="card card-custom gutter-b" style="height: 150px">
                              <div class="card-body" style="text-align: center;">
                                 <i class="flaticon-speech-bubble icon-2x text-success"></i>
                                 <div style="margin-top: 0px !important;" id="CountDashabordMessage" class="text-dark font-weight-bolder font-size-h2 mt-3">{{ $countdashabordmessage }}
                                 </div>
                                 <div class="text-muted text-hover-primary font-weight-bold font-size-lg mt-1">{{ __('dashboard.Messages') }}</div>
                              </div>
                           </div>
                           <!--end::Tiles Widget 12-->
                        </a>

                        <a href="{{ url('school/support') }}" class="col-md-2">
                           <!--begin::Tiles Widget 12-->
                           <div class="card card-custom gutter-b" style="height: 150px">
                              <div class="card-body" style="text-align: center;">
                                 <i class="flaticon-speech-bubble icon-2x text-success"></i>
                                 <div style="margin-top: 0px !important;" id="CountPrivateMessageCount" class="text-dark font-weight-bolder font-size-h2 mt-3">{{ $CountPrivateMessageCount }}</div>
                                 <div class="text-muted text-hover-primary font-weight-bold font-size-lg mt-1">{{ __('dashboard.24/7 Support') }}</div>
                              </div>
                           </div>
                           <!--end::Tiles Widget 12-->
                        </a>



                     </div>
                     <!--begin::Tiles Widget 13-->
                     <!--end::Tiles Widget 13-->
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     @include('backend.school.position._list')
                  </div>
               </div>
               <div class="row">
                  <!--begin::Row-->
                  <div class="col-lg-6">
                     <!--begin::List Widget 14-->
                     <div class="card card-custom card-stretch gutter-b">
                        <!--begin::Header-->
                        <div class="card-header border-0">
                           <h3 class="card-title font-weight-bolder text-dark">{{ __('dashboard.Recommended Teachers') }}</h3>

                          <div class="card-toolbar">
                              <a target="_blank" href="{{ url('school/matched-teacher?recommended=true') }}" class="btn btn-success font-weight-bolder font-size-sm">
                              <i class="flaticon2-list-2 "></i>
                              {{ __('dashboard.View All') }}
                              </a>
                           </div>

                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-2" style="max-height: 600px;overflow: auto;">
                           <!--begin::Item-->
                           @foreach($getRecommendedTeachers as $value)


                           

                              <div class="d-flex flex-wrap align-items-center mb-10">
                                 <!--begin::Symbol-->
                                 <div class="symbol symbol-60 symbol-2by3 flex-shrink-0 mr-4">
                                    <div class="symbol-label"
                                       style="background-image: url('{{ url($value->teacher->getImage()) }}');border-radius: 40px;height: 60px;width: 60px;"></div>
                                 </div>
                                 <!--end::Symbol-->
                                 <!--begin::Title-->
                                 <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                                    <a href="{{ url('teacher-profile/'.$value->teacher->username) }}" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg"> {{ $value->teacher->name }}</a>

                                    @if(!empty($value->teacher->start_date))
                                       <span class="text-muted font-weight-bold font-size-sm">
                                       {{ __('dashboard.Boarding time') }}: {{ !empty($value->teacher->start_date) ? $value->teacher->start_date->getName() : '' }}
                                       </span>
                                    @endif

                                    @if(!empty($value->teacher->minimum_salary) && !empty($value->teacher->maximum_salary))
                                    <span class="text-muted font-size-sm font-weight-bolder">
                                    Salary: {{ $value->teacher->minimum_salary->name }}-{{ $value->teacher->maximum_salary->name }} {{ __('dashboard.Monthly') }}
                                    </span>
                                    @endif
                                 </div>
                                 <!--end::Title-->
                                 <!--begin::Info-->
                                 
                                 <!--end::Info-->
                              </div>

                      

                           @endforeach

                           <!--end::Item-->

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
                        <div class="card-body pt-0" style="max-height: 600px;overflow: auto;">
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
                                       <a href="{{ url('school/my-notification?id='.$notification->id) }}" class="text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1">
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
                        <span class="card-label font-weight-bolder text-dark">{{ __('dashboard.Interview') }}</span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm">{{ __('dashboard.Today Interview List') }}</span>
                     </h3>
                  </div>
                  <!--end::Header-->
                  <!--begin::Body-->
                  <div class="card-body py-2">
                     <!--begin::Table-->
                     <div class="table-responsive">
                        <table class="table table-borderless table-vertical-center">
                           <tbody>
                           @foreach($get_today_school_interview as $interview)
                              <tr>
                                 <td class="p-0 py-4">
                                    <div class="symbol symbol-50 symbol-light">
                                       <span class="symbol-label">
                                       <img src="{!! $interview->user->getImage() !!}" style="height: auto !important;" class="h-50 align-self-center" alt="">
                                       </span>
                                    </div>
                                 </td>
                                 <td class="pl-0">
                                    <div style="padding-left: 10px;">
                                       <a href="javascript:;"
                                          class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $interview->user->teacher_id }}</a>
                                       <div>
                                          <span class="font-weight-bolder">{{ __('dashboard.Nationality') }}:</span>
                                          <a class="text-muted font-weight-bold text-hover-primary">{{ !empty($interview->user->nationality) ? $interview->user->nationality->getName() : '' }}</a>
                                       </div>
                                    </div>
                                 </td>
                                 <td class="text-right">
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                   @if(!empty($interview->user->minimum_salary)) {{ $interview->user->minimum_salary->name }} - @endif  @if(!empty($interview->user->maximum_salary)){{ $interview->user->maximum_salary->name }} @endif
                                    </span>
                                 </td>
                                 <td class="text-right">
                                    <button class="btn btn-primary btn-sm">{{ date('Y-m-d h:i A',$interview->interview_date_time) }}</button>
                                 </td>
                                 <td class="text-right">
                                    <span
                                       class="label label-lg label-light-primary label-inline">{{ __('dashboard.Confirmed') }}</span>
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
