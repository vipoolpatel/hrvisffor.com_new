<!DOCTYPE html>
<html lang="en" class="no-js">
   <head>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>{{ $job->user->school_id }}
         @if(!empty($job->get_location()))
         {{ '| '.$job->get_location() }} 
         @endif
         @if(!empty($job->get_school_type))
         {{ '| '. $job->get_school_type->getName() }}
         @endif
         - {{ __('position.VISFFOR') }} 
      </title>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
      <meta name="title" content="{{ $job->user->school_id }}
         @if(!empty($job->get_location()))
         {{ '| '.$job->get_location() }} 
         @endif
         @if(!empty($job->get_school_type))
         {{ '| '. $job->get_school_type->getName() }}
         @endif
         - {{ __('position.VISFFOR') }}">
      <link rel="shortcut icon" href="{{ url('assets/front/img/favicon.ico') }}"/>
      <link rel="stylesheet" href="{{ url('assets/card/css/reset.css') }}" type="text/css">
      <link rel="stylesheet" href="{{ url('assets/card/css/bootstrap-grid.min.css') }}" type="text/css">
      <link rel="stylesheet" href="{{ url('assets/card/css/animations.css') }}" type="text/css">
      <link rel="stylesheet" href="{{ url('assets/card/css/perfect-scrollbar.css') }}" type="text/css">
      <link rel="stylesheet" href="{{ url('assets/card/css/owl.carousel.css') }}" type="text/css">
      <link rel="stylesheet" href="{{ url('assets/card/css/magnific-popup.css') }}" type="text/css">
      <link rel="stylesheet" href="{{ url('assets/card/css/maincssfile.css') }}" type="text/css">
      <script src="{{ url('assets/card/js/modernizr.custom.js') }}"></script>
      <style type="text/css">
         #site_header_margin
         {
            margin-top: 140px;
         }
         .card-center {
            text-align: center;
         }
         .card-font-size {
            font-size: 20px;
         }
         .info-list ul li {
            margin-bottom: 25px;
         }
         .hr-line
         {
            color: #04b4e0;height: 6px;background: #04b4e0;margin-top: 40px;
         }
         .table tbody tr td
         {
            border-bottom: 1px solid #464646;
         }
         .table {
            width: 100%;
         }
         .color-icon {
            color: #1BC5BD !important;
         }

         .gallery-image {
             height: 250px;
         }

         @media (max-width: 575px){
            #site_header_margin {
               margin-top: 10px;
            }
            .card-font-size {
               font-size: 16px;
            }
            .animated-section {
               padding: 20px;
            }

            .gallery-image {
                height: 100px;
            }

            .info-list ul li {
                margin-bottom: 15px;
            }         
         }

         @media (max-width: 1024px) {
            .header {
               border-radius: 10% 10% 0% 0%;
            }
            .page-content {
               border-radius: 30px 30px 0px 0px;
            }
            .page {
               padding: 10px;
            }
            .logo-margin {
               margin-bottom: 40px;
            }
            .animated-section {
               height: auto;
            }
         }


         
         .modalDialog {
            position: fixed;
            font-family: Arial, Helvetica, sans-serif;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: rgba(0,0,0,0.8);
            z-index: 99999;
            -webkit-transition: opacity 400ms ease-in;
            -moz-transition: opacity 400ms ease-in;
            transition: opacity 400ms ease-in;
            display: none;
         }
         .modalDialog:target {
            opacity:1;
            pointer-events: auto;
         }
         .modalDialog > div {
            max-width: 600px;
            position: relative;
            margin: 10% auto;
            padding: 15px;
            border-radius: 10px;
            background: #fff;
         }
         .close {
            background: #606061;
            color: #FFFFFF;
            line-height: 25px;
            position: absolute;
            right: -12px;
            text-align: center;
            top: -10px;
            width: 24px;
            text-decoration: none;
            font-weight: bold;
            -webkit-border-radius: 12px;
            -moz-border-radius: 12px;
            border-radius: 12px;
            -moz-box-shadow: 1px 1px 3px #000;
            -webkit-box-shadow: 1px 1px 3px #000;
            box-shadow: 1px 1px 3px #000;
         }
         .close:hover { background: #00d9ff; }
      </style>
   </head>
   <body>

      <div class="lm-animated-bg" style="background-image: url({{ url('assets/card/img/main_bg.png') }});"></div>


      <div class="page">
         <div class="page-content" >

            <header class="header" style="padding: 0px;">
               {{--    <img src="http://gbcoding.com/assets/media/svg/flags/260-united-kingdom.svg" alt="" style="height: 29px;margin-top: 10px;margin-left: 10px;"> --}}
               <div id="site_header_margin">
                  <div class="header-content">
                     <div class="header-titles" style="margin-bottom: 40px;">
                        <h4><button class="btn btn-primary" style="background: #04b4e0;border: none;box-shadow: none;padding: 0.65rem 1rem;border-radius: 10px;margin: 0px 10px 10px 10px;">{{ $job->get_position->getName() }}</button></h4>
                        @if(!empty($job->get_job_type))
                        <h4>{{ $job->get_job_type->getName() }}</h4>
                        @endif
                     </div>
                     <div class="header-titles">
                        @if(!empty($job->user))
                           <h4>{{ $job->user->school_id }}</h4>
                        @if(!empty($job->get_school_type))
                           <h1 style="word-wrap: break-word;margin: 20px 0px;line-height: 1.2;">{{ $job->get_school_type->getName() }}</h1>
                        @endif
                        @endif
                        @if(!empty($job->get_location()))
                           <h4>{{ $job->get_location() }}</h4>
                        @endif
                        @if(!empty($job->get_general_location))
                           <h4>{{ $job->get_general_location->getName() }}</h4>
                        @endif
                     </div>
                  </div>
                  <ul class="main-menu" style="display: none;">
                     <li class="active">
                        <a href="#home" class="nav-anim">
                        <span class="menu-icon lnr lnr-user"></span>
                        <span class="link-text">{{ __('position.VISFFOR') }}Me</span>
                        </a>
                     </li>
                  </ul>
                  <div class="social-links">
                     <ul>
                        @if(Auth::check())

                           @if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
                              <li><a href="{{ url('school/matched-teacher/'.$job->slug) }}" class="color-icon" target="_blank"><i class="fas fa-search"></i></a></li>
                              <li><a href="javascript:;" class="color-icon" target="_blank"><i class="fas fa-desktop"></i></a></li>

                           @endif

                           @if(Auth::user()->is_admin == 4)
                           <li><a href="{{ url('teacher/apply/'.$job->slug) }}" class="color-icon" target="_blank"><i class="fas fa-desktop"></i></a></li>
                           @endif

                        @endif

                        <li>
                           @if(!empty(Auth::check()) && !empty($job->user))
                           @if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
                           <a href="{{ url('admin/privatechat/'.$job->user->username) }}" class="color-icon" target="_blank"><i class="far fa-comment"></i></a>
                           @elseif(Auth::user()->is_admin == 4)

                           @if(!empty(Auth::user()->staff_id)  && !empty($job->user->staff_id))
                           <a 
                              data-senderid="{{ Auth::user()->id }}"
                              data-receiverid="{{ Auth::user()->staff_id }}"
                              data-schoolid="{{ $job->user->id  }}"
                              data-teacherid="{{ Auth::user()->id }}"
                              data-schoolstaffid="{{ $job->user->staff_id }}"
                              data-teacherstaffid="{{ Auth::user()->staff_id }}"
                              data-main_connect_id="{{  $job->user->id }}"
                              href="javascript:;" class="color-icon SendMessage"><i class="far fa-comment"></i></a>
                           @endif
                           @endif
                           @else
                           <a href="{{ url('login') }}" class="color-icon" target="_blank"><i class="far fa-comment"></i></a>
                           @endif
                        </li>
                        <li><a href="javascript:;" class="color-icon" onclick="CopyLink(1)" ><i class="fas fa-share-alt"></i></a>
                           <input  type="hidden" value="{{ url('school-profile/'.$job->slug) }}" id="CopyLink1" >
                        </li>

                         @if(Auth::check())

                           @if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
                              <li>  <a href="{{ url('admin/job/edit/'.$job->id) }}" class="color-icon"><i class="fas fa-edit"></i></a></li>
                              <li>
                              <a onclick="return confirm('Are you sure you want to delete?')" class="color-icon" href="{{ url('admin/job/delete/'.$job->id) }}" class="margin-left-card"><i class="fas fa-trash"></i></a>
                           </li>
                           @endif
                        @endif

                     </ul>
                  </div>
                  <div class="logo-margin">
                     <img  src="{{ url('assets/front/img/logo.png') }}" style="height: 60px;margin: auto;">
                  </div>
               </div>
            </header>

            <div class="content-area">
               <div class="animated-sections">

                  <section class="animated-section">
                     <div class="page-title">
                        <h2>School <span>Position</span></h2>
                     </div>
                     <div class="section-content">
                        <div class="row">
                           <div class="col-xs-12 col-sm-6">
                              <div class="info-list card-font-size">
                                 <ul>
                                    @if(!empty($job->get_general_location))
                                    <li>
                                       <span class="title">{{ __('position.General Location') }}</span>
                                       <span class="value">{{ $job->get_general_location->getName() }}</span>
                                    </li>
                                    @endif
                                    <li>
                                       <span class="title">{{ __('position.Native English Speaker') }}</span>
                                       <span class="value">{{ $job->is_english_speaker }}</span>
                                    </li>
                                    @if(!empty($job->get_visa_type))
                                    <li>
                                       <span class="title">{{ __('position.Visa Type') }}</span>
                                       <span class="value">{{ $job->get_visa_type->getName() }}</span>
                                    </li>
                                    @endif
                                    @if(!empty($job->get_teacher_start))
                                    <li>
                                       <span class="title">{{ __('position.Required boarding time') }}</span>
                                       <span class="value">{{ $job->get_teacher_start->getName() }}</span>
                                    </li>
                                    @endif
                                    <li>
                                       <span class="title">{{ __('position.Salary') }}</span>
                                       <span class="value">@if(!empty($job->get_salary_minimum)) {{ $job->get_salary_minimum->name }} - @endif  @if(!empty($job->get_salary_maximum)) {{ $job->get_salary_maximum->name }} @endif</span>
                                    </li>
                                    <li>
                                       <span class="title">{{ __('position.Working hours per week') }}</span>
                                       <span class="value">{{ $job->working_hours_per_week }}</span>
                                    </li>
                                    @if(!empty($job->get_working_schedule))
                                    <li>
                                       <span class="title">{{ __('position.Working Schedule') }}</span>
                                       <span class="value">{{ $job->get_working_schedule->getName() }}</span>
                                    </li>
                                    @endif
                                    <li>
                                       <span class="title">{{ __('position.Class Size') }}</span>
                                       <span class="value">{{ $job->class_size }}</span>
                                    </li>
                                    <li>
                                       <span class="title">{{ __('position.Age Requirement') }}</span>
                                       <span class="value">@if(!empty($job->minimum_age)) {{ $job->minimum_age }} to @endif  @if(!empty($job->maximum_age)) {{ $job->maximum_age }} ysr @endif</span>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                           <div class="col-xs-12 col-sm-6 margin-top-card">
                              <div class="info-list card-font-size">
                                 <ul>
                                    <li>
                                       <video controls="" width="100%">
                                          <source src="" type="video/mp4">
                                       </video>
                                    </li>
                                    <li>
                                       <span class="title">{{ __('position.Benefits') }}</span>
                                       <span class="value">
                                          <p></p>
                                          @foreach($job->job_welfare as $job_welfare_value)
                                          <p>{{ $job_welfare_value->welfare->getName() }}</p>
                                          @endforeach
                                       </span>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="page-title">
                        <h2>{{ __('position.Images') }}</h2>
                     </div>
                     <div class="section-content">
                        <div class="row">
                           <div class="col-xs-12 col-sm-12">
                              <div class="portfolio-content">
                                 <div class="portfolio-grid three-columns">

                                    @forelse($job->job_teachers_accommodation as $teachers_accommodation)
                                       @if(!empty($teachers_accommodation->getImage()))
                                          <a target="_blank" href="{{ $teachers_accommodation->getImage() }}">
                                             <figure class="item lbaudio">
                                                <div class="portfolio-item-img">
                                                   <img alt="" src="{{ $teachers_accommodation->getImage() }}" class="gallery-image"  />
                                                </div>
                                             </figure>
                                          </a>
                                       @endif
                                    @empty
                                    @endforelse

                                    @forelse($job->job_school_environment as $school_environment)
                                       @if(!empty($school_environment->getImage()))
                                         <a target="_blank" href="{{ $school_environment->getImage() }}">
                                          <figure class="item lbaudio">
                                             <div class="portfolio-item-img">
                                                <img alt="" src="{{ $school_environment->getImage() }}" class="gallery-image" />
                                             </div>
                                          </figure>
                                          </a>
                                       @endif
                                    @empty
                                    @endforelse  

                                 </div>
                              </div>
                              <!-- End of Portfolio Content -->
                           </div>
                        </div>
                     </div>
                     @if(!empty($job->city) && !empty($job->city->city_profile))
                     <hr class="hr-line" />
                     <div class="page-title" style="margin-top: 30px;">
                        <h2>{{ __('position.City Profile') }}</h2>
                     </div>
                     <div class="section-content">
                        <div class="row">
                           <div class="col-xs-12 col-sm-6">
                              <div class="info-list">
                                 <ul>
                                    <li>
                                       <span  style="font-size: 22px;" class="title"> {{ $job->city->city_profile->title }}</span>
                                    </li>
                                    <li>
                                       <p>
                                          {!! $job->city->city_profile->about_city !!}
                                       </p>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                           @if(!empty($job->city->city_profile->getVideo()))
                           <div class="col-xs-12 col-sm-6 margin-top-card">
                              <div class="info-list card-font-size">
                                 <ul>
                                    <li>
                                       <video controls="" width="100%">
                                          <source src="{!! $job->city->city_profile->getVideo() !!}" type="video/mp4">
                                       </video>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                           @endif
                        </div>
                        <div class="row">
                           <div class="col-xs-12 col-sm-6">
                              <div class="info-list card-font-size">
                                 <ul>
                                    <li>
                                       @if(!empty($job->city->city_profile->getImage()))
                                       <img style="border-radius: 10px;" src="{!! $job->city->city_profile->getImage() !!}" alt="" title="">
                                       @endif
                                    </li>
                                 </ul>
                              </div>
                           </div>
                           <div class="col-xs-12 col-sm-6 margin-top-card">
                              <div class="info-list">
                                 <ul>
                                    <li>
                                       <span  style="font-size: 22px;" class="title">{!! $job->city->city_profile->info_title !!}</span>
                                    </li>
                                    <li>
                                       <p>{!! $job->city->city_profile->more_info_city !!}</p>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-xs-12 col-sm-12 margin-top-card">
                              <div class="info-list">
                                 <ul>
                                    <li>
                                       <span  style="font-size: 22px;" class="title">{!! $job->city->city_profile->living_cost_title !!}</span>
                                    </li>
                                    <li>
                                       <p>
                                          {!! $job->city->city_profile->living_cost_info !!}
                                       </p>
                                    </li>
                                    <li>

                                       <table class="table">
                                          <thead>
                                             <tr>
                                                <th>{{ __('position.List') }}</th>
                                                <th>{{ __('position.RMB') }}</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             @foreach($get_living_cost as $value)
                                             @php 
                                             $living_cost = App\Models\CityProfileLivingCostModel::living_cost($value->id, $job->city->city_profile->id);
                                             @endphp

                                                <tr>
                                                   <td>{{ $value->getName() }}</td>
                                                   <td>{{ !empty($living_cost) ? $living_cost->rmb_name : '-' }}</td>
                                                </tr>

                                             @endforeach
                                          </tbody>
                                       </table>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-xs-12 col-sm-12 margin-top-card">
                              <div class="info-list">
                                 <ul>
                                    <li>
                                       <span  style="font-size: 22px;" class="title">{!! $job->city->city_profile->climate_title !!}</span>
                                    </li>
                                    <li style="overflow: auto;">
                                       <table class="table">
                                          <thead>
                                             <tr>
                                                <th>{{ __('position.Months') }}</th>
                                                <th>{{ __('position.Low-High(C)') }}</th>
                                                <th>{{ __('position.Rain') }}</th>
                                                <th>{{ __('position.Strom') }}</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             @foreach($get_climate as $value_c)
                                             @php 
                                             $climate_cost = App\Models\CityProfileClimateModel::climate($value_c->id, $job->city->city_profile->id);
                                             @endphp
                                             <tr>
                                                <td>{{ $value_c->getName() }}</td>
                                                <td>{{ !empty($climate_cost->low_high) ? $climate_cost->low_high : ' - ' }}</td>
                                                <td>{{ !empty($climate_cost->rain) ? $climate_cost->rain : ' - ' }}</td>
                                                <td>{{ !empty($climate_cost->strom) ? $climate_cost->strom : ' - ' }}</td>
                                             </tr>
                                             @endforeach
                                          </tbody>
                                       </table>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                     @endif
                  </section>
               </div>
            </div>

         </div>
      </div>


   @if(Auth::check())
      <div class="modalDialog">
         <div>
            <a href="javascript:;" title="Close" class="close">X</a>
            <h2 style="color: #000;font-size: 20px;margin-bottom: 15px;">{{ __('position.Send Message') }}</h2>
            <form action="" id="SubmiMessageProfile" enctype="multipart/form-data" method="post">
               {{ csrf_field() }}

               <input type="hidden" name="main_connect_id" id="get_main_connect_id">
               <input type="hidden" name="school_id" id="get_school_id">
               <input type="hidden" name="teacher_id" id="get_teacher_id">
               <input type="hidden" name="school_staff_id" id="get_school_staff_id">
               <input type="hidden" name="teacher_staff_id" id="get_teacher_staff_id">
               <input type="hidden" name="sender_id" id="get_sender_id">
               <input type="hidden" name="receiver_id" id="get_reciever_id">
               <input type="hidden" name="token"  value="{{ Auth::user()->token }}">

               <label style="color: #000;">{{ __('position.Message') }} <span style="color: red">*</span></label>

                  <textarea name="message" style="box-shadow: none;margin-top: 7px;border: 1px solid #e1e1e1;color: #000;" class="form-control clear-message" required=""></textarea>

                  <div style="text-align: right;margin-top: 30px;">
                     <button style="border-radius: 5px;box-shadow: none;background: #04b4e0;cursor: pointer;"  class="btn btn-success">{{ __('position.Send') }}</button>
                  </div>

            </form>
         </div>
      </div>
   @endif


      <script src="{{ url('assets/card/js/jquery-2.1.3.min.js') }}"></script>
      <script src="{{ url('assets/card/js/imagesloaded.pkgd.min.js') }}"></script>
      <script src='{{ url('assets/card/js/perfect-scrollbar.min.js') }}'></script>
      <script src="{{ url('assets/card/js/mainjsfile.js') }}"></script>
      @include('backend.layouts._socket')
      <script type="text/javascript">
         function CopyLink(id) {
              $("#CopyLink"+id).attr("type", "text");
              var copyText = document.getElementById("CopyLink"+id);
              copyText.select();
              copyText.setSelectionRange(0, 99999)
              document.execCommand("copy");
              $("#CopyLink"+id).attr("type", "hidden");
              alert("{{ __('position.Copied') }} : " + copyText.value);
         }
         
         @if(Auth::check())
                  
            $('body').delegate('#SubmiMessageProfile','submit',function(e) {
                e.preventDefault();
            
                $.ajax({
                   url: app_base_url+"/api/app_private_chat_send",
                   method: "POST",
                   data:$(this).serialize(),
                   "headers": {
                       "Content-Type": "application/x-www-form-urlencoded"
                   },
                   dataType:"json",
                    success:function(response){
                         if(response.status){
                               alert('{{ __('position.Message successfully sent.') }}');
                               $('.modalDialog').hide();
                               $('.clear-message').val('');
                               
                         }
                         else {
                            alert('{{ __('position.Due to some error please try again.') }}');
                         }
                    },
                  });
            
            });
         
            $('body').delegate('.SendMessage','click',function() {
                 var sender_id = $(this).attr('data-senderid');
                 var receiver_id = $(this).attr('data-receiverid');
            
                 var school_id        = $(this).attr('data-schoolid');
                 var teacher_id       = $(this).attr('data-teacherid');
                 var school_staff_id  = $(this).attr('data-schoolstaffid');
                 var teacher_staff_id = $(this).attr('data-teacherstaffid');
            
                 var main_connect_id = $(this).attr('data-main_connect_id');
            
                 $('#get_school_id').val(school_id);      
                 $('#get_main_connect_id').val(main_connect_id);
                 $('#get_teacher_id').val(teacher_id);
                 $('#get_school_staff_id').val(school_staff_id);
                 $('#get_teacher_staff_id').val(teacher_staff_id);
                 $('#get_sender_id').val(sender_id);
                 $('#get_reciever_id').val(receiver_id);
            
                  $('.modalDialog').show();
            });   
         
         
            $('.modalDialog').delegate('.close','click',function() {
                 $('.modalDialog').hide();
            });
            
         @endif
         
      </script>
   </body>
</html>