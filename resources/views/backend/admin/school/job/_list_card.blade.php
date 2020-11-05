
<div class="container-fluid py-10" style="padding-top: 0px !important;">
   <div class="row">
      @forelse($get_job as $value)
      <div class="col-md-6 col-sm-12 col-12 py-5 ipad-col-1">
         <div class="card-bg-1">
            <div class="lm-animated-bg" style="background-image: url({{ url('assets/img/main_bg.png') }});"></div>
            <div class="page">
               <div class="page-content">
                  <div id="site_header" class="header-profile mobile-menu-hide">
                     <div class="header-content">
                        <div class="header-titles" style="margin-bottom: 20px;">
                           <button class="btn btn-primary" style="background: #04b4e0;border: none;">{{ $value->get_position->getName() }}</button>
                          @if(!empty($value->get_job_type))
                           <h4>{{ $value->get_job_type->getName() }}</h4>
                          @endif
                        </div>
                        <div class="header-titles pb-3">
                            @if(!empty($value->user))
                              <h2 class="show_hide_school_name" style="font-size: 20px;">{{ $value->user->school_name }}</h2>
                              <h4>{{ $value->user->school_id }}</h4>
                              <h2 style="font-size: 20px;">{{ !empty($value->get_school_type) ? $value->get_school_type->getName() : '' }}</h2>
                           @endif
                            @if(!empty($value->get_location()))
                              <h4>{{ $value->get_location() }}</h4>
                           @endif

                           @if(!empty($value->get_general_location))
                             <h4>{{ $value->get_general_location->getName() }}</h4>
                           @endif

                        </div>
                     </div>
                     <div class="header-buttons">
                         <a href="{{ url('school/matched-teacher/'.$value->slug) }}" target="_blank" class="margin-left-card"><i class="flaticon-search text-success"></i></a>
                        <a href="javascript:;" target="_blank" class="margin-left-card"><i class="flaticon-computer  text-success"></i></a>
                        <a href="{{ url('admin/privatechat/'.$value->user->username) }}" target="_blank" class="margin-left-card"><i class="flaticon-speech-bubble text-success"></i></a>
                        <a href="javascript:;" onclick="CopyLink({{ $value->id }})" class="margin-left-card"><i class="flaticon-reply text-success"></i></a>

                        <input type="hidden" value="{{ url('school-profile/'.$value->slug) }}" id="CopyLink{{ $value->id }}">

                        <a href="{{ url('school-profile/'.$value->slug) }}" target="_blank" class="margin-left-card"><i class="flaticon-eye  text-success"></i></a>

                        

                        <a href="{{ url('admin/job/edit/'.$value->id.'?page='.Request::get('page')) }}" class="margin-left-card"><i class="flaticon-edit-1 text-success"></i></a>
                        <a onclick="return confirm('Are you sure you want to delete?')" href="{{ url('admin/job/delete/'.$value->id) }}" class="margin-left-card"><i class="flaticon2-trash  text-success"></i></a>                       
                     </div>

                     <div class="header-buttons">
                        <img class="logo-default max-h-40px" src="{{ url('assets/front/img/logo.png') }}" style="margin-top: 8px;">
                     </div>
                  </div>
                  <div class="content-area">
                 {{--     <div class="card-language">
                        <div class="dropdown">
                           <div class="topbar-item">
                              <div class="btn btn-icon btn-hover-transparent-white btn-dropdown btn-lg mr-1">
                                 <img class="h-20px w-20px rounded-sm" src="{{ url('assets/media/svg/flags/260-united-kingdom.svg') }}" >
                              </div>
                           </div>
                        </div>
                     </div> --}}

                     <div class="animated-sections" >
                        <!-- About Me Subpage -->
                        <section class="animated-section" style="min-height: 388px;">
                           <!-- End of Personal Information -->
                           <div class="white-space-50"></div>
                           <div class="row">
             
                              <div class="col-xs-12 col-sm-6 col-md-6 p-0 right-side-line">
                                 <div class="info-list">
                                    <ul>

                                  
                          
                                       <li>
                                          <span class="title">{{ __('position.Salary') }}</span>
                                          <span class="value">@if(!empty($value->get_salary_minimum)) {{ $value->get_salary_minimum->name }} - @endif  @if(!empty($value->get_salary_maximum)) {{ $value->get_salary_maximum->name }} @endif</span>
                                       </li>

                                       <li>
                                          <span class="title">{{ __('position.Entry Time') }}</span>
                                          <span class="value">{{ !empty($value->get_teacher_start) ? $value->get_teacher_start->getName() : '' }}</span>
                                       </li>
                                       <li>
                                          <span class="title">{{ __('position.Age Requirement') }}</span>
                                          <span class="value">@if(!empty($value->minimum_age)) {{ $value->minimum_age }} to @endif  @if(!empty($value->maximum_age)) {{ $value->maximum_age }} ysr @endif</span>
                                       </li>
                                       <li>
                                          <span class="title">{{ __('position.Visa Requirement') }}</span>
                                          <span class="value">{{ !empty($value->get_visa_type) ? $value->get_visa_type->getName() : '' }}</span>
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                              <div class="col-xs-12 col-sm-6 col-md-6 p-0 left-side-padding">
                                 <div class="info-list">
                                    <ul>
                                       <li>
                                          <span class="title">{{ __('position.Class size for teacher') }}</span>
                                          <span class="value">{{ $value->class_size }}</span>
                                       </li>
                                       <li>
                                          <span class="title">{{ __('position.Working hours per week') }}</span>
                                          <span class="value">{{ $value->working_hours_per_week }}</span>
                                       </li>
                                       <li>
                                          <span class="title">{{ __('position.Working Time') }}</span>
                                          <span class="value">{{ !empty($value->get_working_schedule) ? $value->get_working_schedule->getName() : '' }}</span>
                                       </li>
                                       <li>
                                          <span class="title">{{ __('position.City Profile') }}</span>
                                          <span class="value">{{ !empty($value->city) ? $value->city->getName() : '' }}</span>
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                              <div class="col-xs-12 col-sm-12 col-md-12 p-0">
                                 <div class="info-list">
                                    <ul>
                                       <li>
                                          <span class="title">{{ __('position.Welfare') }}</span>
                                       </li>
                                       <li>
                                          <span class="value">
                                          @foreach($value->job_welfare as $job_welfare_value)
                                          {{ $job_welfare_value->welfare->getName() }};
                                           @endforeach
                                          </span>
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                           </div>



                           
     


                           <div class="row" style="min-height: 155px;">
                                 @forelse($value->job_teachers_accommodation as $teachers_accommodation)
                                    <div class="col-xs-3 col-sm-3 col-md-3 p-0 card-img">
                                       <img style="height: 155px;" src="{{ url('upload/school/'.$teachers_accommodation->image_name) }}" alt="">
                                    </div>
                                 @empty
                                 @endforelse

                                  @forelse($value->job_school_environment as $school_environment)
                                    <div class="col-xs-3 col-sm-3 col-md-3 p-0 card-img">
                                       <img  style="height: 155px;" src="{{ url('upload/school/'.$school_environment->image_name) }}" alt="">
                                    </div>
                                 @empty
                                 @endforelse                               
                           </div>
                        </section>
                        <!-- End of About Me Subpage -->
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      @empty
      @endforelse
      <div style="clear: both;"></div>
      <!--begin::Pagination-->
      <div class="card card-custom" style="width: 100%;">
         <div class="card-body py-7">
            <!--begin::Pagination-->
            <div class="d-flex justify-content-between align-items-center flex-wrap">
               <div class="d-flex flex-wrap mr-3">
                  {!! $get_job->links() !!}
               </div>
            </div>
            <!--end:: Pagination-->
         </div>
      </div>
      <!--end::Pagination-->
   </div>
</div>