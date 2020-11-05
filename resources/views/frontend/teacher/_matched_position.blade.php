<div class="row">
      @forelse($jobs as $value)
      <div class="col-md-6 col-sm-12 col-12 py-5 ipad-col-1">
         <div class="card-bg-1">
            <div class="lm-animated-bg"
               style="background-image: url({{ url('assets/img/main_bg.png') }});"></div>
            <div class="page">
               <div class="page-content">
                  <div id="site_header" class="header-profile mobile-menu-hide" >
                     <div class="header-content">
                       @if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
                        <div class="header-titles" style="margin-bottom: 20px;margin-top: 5px;">
                        @else
                          <div class="header-titles" style="margin-bottom: 40px;margin-top: 5px;">
                        @endif

                           <button class="btn btn-primary" style="background: #04b4e0;border: none;margin: 0px 10px 10px 10px;box-shadow: none;">{{ $value->get_position->getName() }}</button>
                           @if(!empty($value->get_job_type))
                           <h4>{{ $value->get_job_type->getName() }}</h4>
                           @endif
                        </div>
                        <div class="header-titles pb-3">
                           @if(!empty($value->user))

                           @if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
                              <h2 style="font-size: 18px;" class="show_hide_school_name">{{ $value->user->school_name }}</h2>
                           @endif

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

                        @if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)

                        <a href="{{ url('school/matched-teacher/'.$value->slug) }}" target="_blank" class="margin-card"><i class="flaticon-search text-success"></i></a>

                        <a href="javascript:;" target="_blank" class="margin-card"><i class="flaticon-computer  text-success"></i></a>


                        <a href="{{ url('admin/privatechat/'.$value->user->username) }}" target="_blank" class="margin-card"><i class="flaticon-speech-bubble text-success"></i></a>

                        @endif


                     
                     @if(Auth::user()->is_admin == 4)

                        <a href="{{ url('teacher/apply/'.$value->slug) }}" target="_blank" class="margin-card" ><i class="flaticon-computer  text-success"></i></a>

                        @if(!empty(Auth::user()->staff_id)  && !empty($value->user->staff_id))

                              <a href="javascript:;" 

                              data-senderid="{{ Auth::user()->id }}"
                              data-receiverid="{{ Auth::user()->staff_id }}"

                              data-schoolid="{{ $value->user->id  }}"
                              data-teacherid="{{ Auth::user()->id }}"
                              data-schoolstaffid="{{ $value->user->staff_id }}"
                              data-teacherstaffid="{{ Auth::user()->staff_id }}"
                              data-main_connect_id="{{  $value->user->id }}"
                              

                               class="margin-card SendMessage" ><i class="flaticon-speech-bubble text-success"></i></a>
                        @endif


                        <a href="javascript:;" class="margin-card" ><i class="flaticon-star {{ ($value->save_job_teacher() > 0) ? 'text-success' : 'text-light' }}  SaveJob SaveJobClass{{ $value->id }}" id="{{ $value->id }}" ></i></a>


                     @endif



                        <a href="{{ url('school-profile/'.$value->slug) }}" target="_blank" class="margin-card" ><i class="flaticon-eye text-success"></i></a>


                        

                     @if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
                        @if(!empty($getuser))
                           <a href="javascript:;" class="margin-card" onclick="TeacherRecommend('{{ $getuser->id }}','{{ $value->id }}')" ><i class="flaticon2-telegram-logo  text-success"></i></a>
                        @endif
                     @endif
                      

                        <a href="javascript:;" onclick="CopyLink({{ $value->id }})" class="margin-card" ><i class="flaticon-share text-success"></i></a>
                        <input type="hidden" value="{{ url('school-profile/'.$value->slug) }}" id="CopyLink{{ $value->id }}">

                        @if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
                           <a href="{{ url('admin/job/edit/'.$value->id) }}" class="margin-card"><i class="flaticon-edit-1 text-success"></i></a>

                           <a onclick="return confirm('Are you sure you want to delete?')" href="{{ url('admin/job/delete/'.$value->id) }}" class="margin-card"><i class="flaticon2-trash  text-success"></i></a>
                           
                        @endif



                     </div>
                     <div class="header-buttons">
                        <img class="logo-default max-h-40px" src="{{ url('assets/front/img/logo.png') }}" style="margin-top: 8px;">
                     </div>
                  </div>
                  <div class="content-area">
               {{--       <div class="card-language">
                        <div class="dropdown">
                           <!--begin::Toggle-->
                           <div class="topbar-item">
                              <div
                                 class="btn btn-icon btn-hover-transparent-white btn-dropdown btn-lg mr-1">
                                 <img class="h-20px w-20px rounded-sm"
                                    src="{{ asset('assets/media/svg/flags/260-united-kingdom.svg') }}"
                                    alt="">
                              </div>
                           </div>
               
                        </div>
                     </div> --}}
                     <div class="animated-sections">
                        <!-- About Me Subpage -->
                        <section class="animated-section" style="min-height: 425px;">
                           <!-- End of Personal Information -->
                           <div class="white-space-50"></div>
                           <div class="row">
                    
                              <div class="col-xs-12 col-sm-6 col-md-6 p-0 right-side-line" >
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
                              <div class="col-xs-12 col-sm-6 col-md-6 p-0 left-side-padding" >
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
                              <div class="col-xs-12 col-sm-12 col-md-12 p-0" >
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
                                    @if($teachers_accommodation->getImage())
                                       <a href="{{ $teachers_accommodation->getImage() }}" target="_blank" class="col-xs-3 col-sm-3 col-md-3 p-0 card-img">
                                          <img  alt="" style="height: 155px;" src="{{ $teachers_accommodation->getImage() }}" >
                                       </a>
                                    @endif
                                 @empty
                                 @endforelse

                                  @forelse($value->job_school_environment as $school_environment)
                                    @if($school_environment->getImage())
                                       <a href="{{ $school_environment->getImage() }}" target="_blank" class="col-xs-3 col-sm-3 col-md-3 p-0 card-img">
                                          <img alt="" style="height: 155px;" src="{{ $school_environment->getImage() }}" >
                                       </a>
                                    @endif
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

</div>


   <div class="row col-md-12" style="margin-top: 10px !important;margin: auto;">
      <div class="d-flex justify-content-between align-items-center flex-wrap" style="margin: auto;">
         <div class="d-flex flex-wrap mr-3">
            @if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
                {!! $jobs->links() !!}
            @else
               @if(!empty($page_id))
                  <a class="btn btn-success ChangeBatch" id="{{ $page_id }}" href="javascript:;">{{ __('position.Change Batch') }}</a>
               @endif
            @endif
         </div>
      </div>
   </div>

</div>


