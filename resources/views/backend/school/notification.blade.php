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
                  {{__("profile.Notifications")}}
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
                  <!--begin::Row-->
                


                  <div class="col-lg-12">
                     <!--begin::List Widget 10-->
                     <div class="card card-custom  card-stretch gutter-b">
                        <!--begin::Header-->
                        <div class="card-header border-0">
                           <h3 class="card-title font-weight-bolder text-dark">{{__("profile.Notifications")}}</h3>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-0">


                          @foreach($notifications as $notification)
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
                                    <div class="d-flex flex-column align-items-cente py-2" style="{{  empty($notification->read_at) ? 'font-weight: bold;' : '' }}">
                                       <!--begin::Title-->
                                       

                                       @if($getdata->type == 'job')
                                       @php

                                        $job = App\Models\Job::get_single_job($getdata->common_id)
                                        @endphp
                                         <a href="{{ url('school-profile/'.$job->slug) }}" class="text-dark-75 text-hover-primary font-size-lg mb-1">
                                            {!! $getdata->message !!}
                                         </a>

                                       @elseif($getdata->type == 'teacher')
                                       @php

                                        $user = App\Models\UsersModel::get_single($getdata->common_id)
                                        @endphp
                                         <a href="{{ url('teacher-profile/'.$user->username) }}" class="text-dark-75  text-hover-primary font-size-lg mb-1">
                                            {!! $getdata->message !!}
                                        </a>

                                        @elseif($getdata->type == 'interview')
                                         <a href="{{ url('school/interview') }}" class="text-dark-75  text-hover-primary font-size-lg mb-1">
                                            {!! $getdata->message !!}
                                        </a>

                                        @elseif($getdata->type == 'offer')
                                         <a href="{{ url('school/offer') }}" class="text-dark-75 text-hover-primary font-size-lg mb-1">
                                            {!! $getdata->message !!}
                                        </a>

                                      

                                        @elseif($getdata->type == 'contract')
                                         <a href="{{ url('school/contract') }}" class="text-dark-75 text-hover-primary font-size-lg mb-1">
                                            {!! $getdata->message !!}
                                        </a>

                                        @elseif($getdata->type == 'visa')
                                         <a href="{{ url('school/visa') }}" class="text-dark-75 text-hover-primary font-size-lg mb-1">
                                            {!! $getdata->message !!}
                                        </a>


                                        @elseif($getdata->type == 'travel')
                                         <a href="{{ url('school/travel') }}" class="text-dark-75 text-hover-primary font-size-lg mb-1">
                                            {!! $getdata->message !!}
                                        </a>


                                        @elseif($getdata->type == 'report')
                                         <a href="{{ url('school/travel') }}" class="text-dark-75 text-hover-primary font-size-lg mb-1">
                                            {!! $getdata->message !!}
                                        </a>

                                        @elseif($getdata->type == 'invoice')
                                         <a href="{{ url('school/invoice') }}" class="text-dark-75 text-hover-primary font-size-lg mb-1">
                                            {!! $getdata->message !!}
                                        </a>


                                       @endif
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
                             <div class="d-flex justify-content-between align-items-center flex-wrap" style="margin: auto;">
                                <div class="d-flex flex-wrap mr-3">
                                   @if(!empty($notifications))
                                      {!! $notifications->links() !!}
                                   @endif
                                </div>
                             </div>
                        <!--end: Card Body-->
                     </div>
                     <!--end: Card-->
                     <!--end: List Widget 10-->
                  </div>




               </div>
               <!--end::Row-->






















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
