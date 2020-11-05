<div class="container-fluid py-10">
   <div class="row">
      @forelse($teachers as $teacher)

      <div class="col-md-6 col-sm-12 col-12 py-5 ipad-col-1">
         <div class="card-bg-1" style="background:{{ !empty($teacher->card_colour) ? $teacher->card_colour->color : 'linear-gradient(#0b7080, #0ba376);'  }}">
            <div class="lm-animated-bg" style="background-image: url({{ url('assets/img/main_bg.png') }});"></div>
            <div class="page">
               <div class="page-content">
                  <div id="site_header" style="padding-left: 15px;padding-right: 15px;" class="header-profile mobile-menu-hide">
                     <div class="header-content">
                        <div class="header-photo">
                           <img src="{!! $teacher->getImage() !!}" alt="{{ $teacher->username }}">
                        </div>
                        <div class="header-titles pb-3">
                           <h2 style="font-size: 20px;">{{ $teacher->name }}</h2>
                           <h4 class="font-size">{{__('teacher.ID')}}:{{ $teacher->teacher_id }}</h4>

                           @if(!empty($teacher->nationality) && !empty($teacher->nationality->getImage()))                        
                              <h4 style="margin-top: 10px;margin-bottom: 10px;">
                                 <img class="h-20px w-20px rounded-sm" src="{!! $teacher->nationality->getImage() !!}" >
                              </h4>
                           @endif
                        </div>
                     </div>
                     <div class="header-buttons">
                        
                        <a href="{{ url('teacher/matched-position/'.$teacher->username) }}" target="_blank" class="margin-left-card"><i class="flaticon-search text-success"></i></a>
                        <a href="javascript:;" target="_blank" class="margin-left-card"><i class="flaticon-computer text-success"></i></a>
                        <a href="{{ url('admin/privatechat/'.$teacher->username) }}" target="_blank" class="margin-left-card"><i class="flaticon-speech-bubble text-success"></i></a>
                        
                        <a href="{{ url('teacher-profile/'.$teacher->username) }}" target="_blank" class="margin-left-card"><i class="flaticon-eye text-success"></i></a>



                        <a href="javascript:;" class="margin-left-card" onclick="CopyLink({{ $teacher->id }})"><i class="flaticon-reply text-success"></i></a>
                         <input type="hidden" value="{{ url('teacher-profile/'.$teacher->username) }}" id="CopyLink{{ $teacher->id }}">

                        <a  href="{{ url('admin/teacher/edit/'.$teacher->id.'?page='.Request::get('page')) }}" class="margin-left-card" ><i class="flaticon-edit-1 text-success"></i></a>
                        <a onclick="return confirm('Are you sure you want to delete?')" href="{{ url('admin/teacher/delete/'.$teacher->id) }}" class="margin-left-card" ><i class="flaticon2-trash text-success"></i></a>

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
                                          <span class="title">{{__('teacher.Nationality')}}</span>
                                          <span class="value">@if(!empty($teacher->nationality)){{ $teacher->nationality->name}}@endif</span>
                                       </li>
                                       <li>
                                          <span class="title">{{__('teacher.Age')}}</span>
                                          <span class="value">{{ $teacher->age }}</span>
                                       </li>
                                       <li>
                                          <span class="title">{{__('teacher.Degree')}}</span>
                                          <span class="value">@if(!empty($teacher->education_level)){{ $teacher->education_level->name }}@endif</span>
                                       </li>
                                       <li>
                                          <span class="title">{{__('teacher.Working Experience')}}</span>
                                          <span class="value">{{ !empty($teacher->experience) ? $teacher->experience.' ysr' : '-' }}</span>
                                       </li>
                                       <li>
                                          <span class="title">{{__('teacher.Boarding Time')}}</span>
                                          <span class="value">{{ !empty($teacher->start_date) ? $teacher->start_date->getName() : '-' }}</span>

                                       </li>
                            
                                       <li>
                                          <span class="title">{{__('teacher.Expected Salary')}}</span>
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
                                          <span class="title">{{__('teacher.Expected Location')}}</span>
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
                                    <h2 class="p-0">{{__('teacher.About')}} <span>{{__('teacher.Me')}}</span></h2>
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

      @empty
      @endforelse
   </div>
   <div class="row col-md-12" style="margin-top: 10px !important;margin: auto;">
      <div class="d-flex justify-content-between align-items-center flex-wrap" style="margin: auto;">
         <div class="d-flex flex-wrap mr-3">
             {!! $teachers->links() !!}
         </div>
      </div>
   </div>
</div>
