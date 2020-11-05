<div class="row">
   @foreach($teachers as $teacher)
   <div class="col-md-6 col-sm-12 col-12 py-5 ipad-col-1">
      <div class="card-bg-1" style="background:{{ !empty($teacher->card_colour) ? $teacher->card_colour->color : 'linear-gradient(#0b7080, #0ba376);'  }}">
         <div class="lm-animated-bg"
            style="background-image: url({{ url('assets/img/main_bg.png') }});"></div>
         <div class="page">
            <div class="page-content">
               <div id="site_header" class="header-profile mobile-menu-hide" style="padding-left: 0px;padding-right: 0px;">
                  <div class="header-content">
                     <div class="header-photo">
                        <img src="{!! $teacher->getImage() !!}" alt="{{ $teacher->name }}">
                     </div>
                     <div class="header-titles pb-3">
                        <h2>{{ $teacher->name }}</h2>
                        <h4 class="font-size">{{ __('position.ID') }}:{{ $teacher->teacher_id }}</h4>

                        @if(!empty($teacher->nationality) && !empty($teacher->nationality->getImage()))                        
                           <h4 style="margin-top: 10px;margin-bottom: 10px;">
                              <img class="h-20px w-20px rounded-sm" src="{!! $teacher->nationality->getImage() !!}" >
                           </h4>
                        @endif
                        
                     </div>
                  </div>
                  <div class="header-buttons">
                     @if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)

                        <a href="{{ url('teacher/matched-position/'.$teacher->username) }}" target="_blank" class="margin-card"><i class="flaticon-search text-success"></i></a>

                        <a href="javascript:;" target="_blank" class="margin-card"><i class="flaticon-computer text-success"></i></a>

                        <a href="{{ url('admin/privatechat/'.$teacher->username) }}" target="_blank" class="margin-card"><i class="flaticon-speech-bubble text-success"></i></a>

                     @endif


                     @if(!empty($slug) && Auth::user()->is_admin == 3) 
                        <a href="{{ url('school/apply/'.$teacher->username.'/'.$slug) }}" target="_blank"  class="margin-card"><i class="flaticon-computer text-success"></i></a>
                     @endif

                     @if(Auth::user()->is_admin == 3)
                        @if(!empty(Auth::user()->staff_id)  && !empty($teacher->staff_id))
                              <a href="javascript:;" 

                        data-senderid="{{ Auth::user()->id }}"
                        data-receiverid="{{ Auth::user()->staff_id }}"

                        data-schoolid="{{ Auth::user()->id  }}"
                        data-teacherid="{{ $teacher->id }}"
                        data-schoolstaffid="{{ Auth::user()->staff_id }}"
                        data-teacherstaffid="{{ $teacher->staff_id }}"
                        data-main_connect_id="{{ $teacher->id }}"
                        
                         class="SendMessage margin-card"><i class="flaticon-speech-bubble text-success"></i></a>
                        @endif


                        <a href="javascript:;" class="margin-card" ><i class="flaticon-star {{ ($teacher->save_teacher_school() > 0) ? 'text-success' : 'text-light' }} SaveTeacher SaveTeacherClass{{ $teacher->id }}" id="{{ $teacher->id }}" ></i></a>

                     @endif



                     <a href="{{ url('teacher-profile/'.$teacher->username.'/'.$slug) }}" target="_blank" class="margin-card" ><i class="flaticon-eye text-success"></i></a>

                     @if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
                        @if(!empty($jobs))
                           <a href="javascript:;" class="margin-card" onclick="SchoolRecommend('{{ $jobs->user_id }}','{{ $teacher->id }}')" ><i class="flaticon2-telegram-logo text-success"></i></a>
                        @endif
                     @endif

                     @if(!empty($teacher->getStaffCVUpload()))
                         <a href="javascript:;" class="getStaffCVUpload margin-card" id="{!! $teacher->getStaffCVUpload() !!}" ><i class="flaticon-multimedia-4 text-success"></i></a>
                     @endif
                      
                      

                     <a href="javascript:;" class="margin-card" onclick="CopyLink({{ $teacher->id }})" ><i class="flaticon-share text-success"></i></a>
                      <input type="hidden" value="{{ url('teacher-profile/'.$teacher->username) }}" id="CopyLink{{ $teacher->id }}">

                     @if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)

                        <a href="{{ url('admin/teacher/edit/'.$teacher->id) }}" class="margin-card"><i class="flaticon-edit-1 text-success"></i></a>

                        <a onclick="return confirm('{{ __('position.Are you sure you want to delete?') }}')" href="{{ url('admin/teacher/delete/'.$teacher->id) }}" class="margin-left-card"><i class="flaticon2-trash text-success"></i></a>

                     @endif



                  </div>
               </div>
               <div class="content-area">
                  <div class="animated-sections">
                     <!-- About Me Subpage -->
                     <section class="animated-section" style="min-height: 373px;">
                        <!-- End of Personal Information -->
                        <div class="white-space-50"></div>
                        <div class="row">
                           <div class="col-xs-12 col-sm-8 col-md-8 p-0">
                              <div class="info-list">
                                 <ul>
                                    <li>
                                       <span class="title">{{ __('position.Nationality') }}</span>
                                       <span class="value">@if(!empty($teacher->nationality)){{ $teacher->nationality->name}}@endif</span>
                                    </li>
                                    <li>
                                       <span class="title">{{ __('position.Age') }}</span>
                                       <span class="value">{{ $teacher->age }}</span>
                                    </li>
                                    <li>
                                       <span class="title">{{ __('position.Degree') }}</span>
                                       <span class="value">@if(!empty($teacher->education_level)){{ $teacher->education_level->name }}@endif</span>
                                    </li>
                                     <li>
                                       <span class="title">{{ __('position.Working Experience') }}</span>
                                       <span class="value">{{ !empty($teacher->experience) ? $teacher->experience.' ysr' : '-' }}</span>
                                    </li>
                                    <li>
                                       <span class="title">{{ __('position.Boarding Time') }}</span>
                                       <span class="value">{{ !empty($teacher->start_date) ? $teacher->start_date->getName() : '-' }}</span>
                                    </li>
                                    <li>
                                       <span class="title">{{ __('position.Expected Salary') }}</span>
                                       <span class="value">@if(!empty($teacher->minimum_salary)){{ $teacher->minimum_salary->name }}@endif - @if(!empty($teacher->maximum_salary)){{ $teacher->maximum_salary->name }}@endif</span>
                                    </li>

                                 </ul>
                              </div>
                           </div>
                     
                           <div class="col-xs-12 col-sm-4 col-md-4 p-0" style="text-align: center;">

                             @if(!empty($teacher->getVideo()))
                              @php
                              $filename = explode('.', $teacher->user_video);
                              $extension = end($filename);
                              @endphp
                              <video poster="" style="max-height: 119px;" width="100%" id="player" playsinline controls>
                                 @if (strtolower($extension) == 'mp4')
                                 <source src="{{ url('upload/profile') }}/{{ $teacher->user_video }}" type="video/mp4">
                                 @elseif (strtolower($extension) == 'webm')
                                 <source src="{{ url('upload/profile') }}/{{ $teacher->user_video }}" type="video/webm">
                                 @endif
                              </video>
                             @endif

                           </div>
                        </div>

                          <div class="row">
                           <div class="col-xs-12 col-sm-12 col-md-12 p-0">
                              <div class="info-list">
                                 <ul>
                                    <li>
                                       <span class="title">{{ __('position.Expected Location') }}</span>
                                    </li>
                                    <li>
                                       <span class="value">
                                          @foreach($teacher->get_location as $value_location)
                                                {{ $value_location->get_location() }} <span class="title">|</span>
                                          @endforeach 
                                          {{ !empty($teacher->area) ? $teacher->area->getName() : '-' }}
                                       </span>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>

                        <div class="section-content about-me">
                           <!-- Personal Information -->
                           <div class="row">
                              <div class="page-title p-0">
                                 <h2 class="p-0">{{ __('position.About') }} <span>{{ __('position.Me') }}</span></h2>
                              </div>
                              <div class="col-xs-12 col-sm-12 p-0 font-size">
                                {{ $teacher->bio }}
                              </div>
                              <div class="col-xs-12 col-sm-12 p-0" style="text-align: right;">
                                 <img class="logo-default max-h-40px" src="{{ url('assets/front/img/logo.png') }}" style="margin-top: 14px;">
                              </div>
                           </div>
                           <!-- End of Services -->
                        </div>
                     </section>
                     <!-- End of About Me Subpage -->
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   @endforeach
</div>

<div class="row col-md-12" style="margin-top: 10px !important;margin: auto;">
   <div class="d-flex justify-content-between align-items-center flex-wrap" style="margin: auto;">
      <div class="d-flex flex-wrap mr-3">

         @if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
               {!! $teachers->links() !!}
         @else
            @if(!empty($page_id))
               <a class="btn btn-success ChangeBatch" id="{{ $page_id }}" href="javascript:;">{{ __('position.Change Batch') }}</a>
            @endif
         @endif


      </div>
   </div>
</div>