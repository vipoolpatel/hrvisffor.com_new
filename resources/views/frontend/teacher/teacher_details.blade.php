<!DOCTYPE html>
<html lang="en" class="no-js">
   <head>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>{{ $teacher->name }} | {{ $teacher->teacher_id }} - {{ __('profile.VISFFOR') }} </title>
      <meta name="description" content="{{ $teacher->bio }}">
      <meta name="title" content="{{ $teacher->name }} | {{ $teacher->teacher_id }} - {{ __('profile.VISFFOR') }}">
      <meta property="og:title" content="{{ $teacher->name }} | {{ $teacher->teacher_id }} - {{ __('profile.VISFFOR') }}">
      <meta property="og:description" content="{{ $teacher->bio }}">
      <meta property="og:site_name" content="{{ __('profile.VISFFOR') }}">
      <meta property="og:image" content="{{ $teacher->getImage() }}">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
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
            font-size: 18px;
         }
         .info-list ul li {
            margin-bottom: 15px;
         }
         .hr-line
         {
            color: #04b4e0;height: 6px;background: #04b4e0;margin-top: 40px;
         }
         .table tbody tr td
         {
            border-bottom: 1px solid #464646;
         }
         .table
         {
            width: 100%;
         }
         .color-icon {
            color: #1BC5BD !important;
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
               height: auto;
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
               margin-bottom: 20px;
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


         /*cv css*/

        .modalDialogCV {
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
         .modalDialogCV:target {
            opacity:1;
            pointer-events: auto;
         }
         .modalDialogCV > div {
            max-width: 1200px;
            position: relative;
            margin: 4% auto;
            padding: 15px;
            border-radius: 10px;
            background: #fff;
         }

      </style>
   </head>
   @if(!empty($teacher->card_colour) && !empty($teacher->card_colour->color))
   <body style="background: {{ $teacher->card_colour->color  }} ">
      @else
      <body>
         @endif
         <div class="lm-animated-bg" style="background-image: url({{ url('assets/card/img/main_bg.png') }});"></div>
     
         <div class="page">
            <div class="page-content">
               <header id="" class="header" style="padding: 0px;">
                  <div id="site_header_margin">
                     <div class="header-content">
                        <div class="header-photo">
                           <img src="{{ url($teacher->getImage()) }}" >
                        </div>
                        <div class="header-titles">
                           <h2>{{ $teacher->name }}</h2>
                           <h4>{{ $teacher->teacher_id }}</h4>
                        </div>
                     </div>
                     <div class="header-content">
                        <div class="header-titles">
                           @if(!empty($teacher->nationality))
                           <h4>
                              @if(!empty($teacher->nationality->getImage()))
                              <img src="{{ url($teacher->nationality->getImage()) }}" style="height: 25px;margin: auto;margin-top: 10px;margin-bottom: 10px;" >
                              @endif
                              <div>{{ !empty($teacher->nationality) ? $teacher->nationality->name : '' }}</div>
                           </h4>
                           @endif
                           <h4>{{ $teacher->age }} ysr</h4>
                           <h4>{{ !empty($teacher->education_level) ? $teacher->education_level->name : '' }}</h4>
                        </div>
                     </div>
                     <ul class="main-menu" style="display: none;">
                        <li class="active">
                           <a href="#home" class="nav-anim">
                           <span class="menu-icon lnr lnr-user"></span>
                           <span class="link-text">Me</span>
                           </a>
                        </li>
                     </ul>
                     <div class="social-links">
                        <ul>
                           @if(!empty(Auth::check()))
                           @if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
                           <li><a href="{{ url('teacher/matched-position/'.$teacher->username) }}" class="color-icon" ><i class="fa fa-search"></i></a></li>
                           @endif
                           @endif
                           @if(!empty($job_slug))
                           <li><a href="{{ url('school/apply/'.$teacher->username.'/'.$job_slug) }}" class="color-icon" target="_blank"><i class="fas fa-desktop"></i></a></li>
                           @endif
                           @if(!empty(Auth::check()))
                           @if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
                           <li><a href="{{ url('admin/privatechat/'.$teacher->username) }}" class="color-icon"><i class="far fa-comment"></i></a></li>
                           @else
                           @if(!empty(Auth::user()->staff_id)  && !empty($teacher->staff_id) && Auth::user()->is_admin == 3)
                           <li><a 
                              data-senderid="{{ Auth::user()->id }}"
                              data-receiverid="{{ Auth::user()->staff_id }}"
                              data-schoolid="{{ Auth::user()->id  }}"
                              data-teacherid="{{ $teacher->id }}"
                              data-schoolstaffid="{{ Auth::user()->staff_id }}"
                              data-teacherstaffid="{{ $teacher->staff_id }}"
                              data-main_connect_id="{{ $teacher->id }}"
                              href="javascript:;" class="color-icon SendMessage"><i class="far fa-comment"></i></a></li>
                           @endif
                           @endif
                           @else
                           <li><a href="{{ url('login') }}" target="_blank" class="color-icon"><i class="far fa-comment"></i></a></li>
                           @endif
                           <li><a href="javascript:;" class="color-icon" onclick="CopyLink(1)" ><i class="fas fa-share-alt"></i></a>
                              <input  type="hidden" value="{{ url('teacher-profile/'.$teacher->username) }}" id="CopyLink1" >
                           </li>

                           @if(!empty($teacher->getStaffCVUpload()))
                              <li><a href="javascript:;" id="{{ $teacher->getStaffCVUpload() }}" class="color-icon getStaffCVUpload"><i class="fa fa-download"></i></a></li>
                           @endif

                           @if(!empty(Auth::check()))
                           @if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
                           <li><a href="{{ url('admin/teacher/edit/'.$teacher->id) }}" class="color-icon" ><i class="fa fa-edit "></i></a></li>
                           <li><a onclick="return confirm('{{ __('profile.Are you sure you want to delete?') }}')" href="{{ url('admin/teacher/delete/'.$teacher->id) }}" class="color-icon" ><i class="fa fa-trash"></i></a></li>
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
                     <!-- About Me Subpage -->
                     <section  class="animated-section">
                        <div class="page-title">
                           <h2>{{ __('profile.Teacher') }} <span>{{ __('profile.Position') }}</span></h2>
                        </div>
                        <div class="section-content">
                           <div class="row">
                              <div class="col-xs-12 col-sm-6">
                                 <div class="info-list card-font-size">
                                    <ul>
                                       <li>
                                          <span class="title">{{ __('profile.Location') }}</span>
                                          <span class="value">{{ !empty($teacher->current_location) ?  $teacher->current_location->name : '-' }}</span>
                                       </li>
                                       <li>
                                          <span class="title">{{ __('profile.Working Experience') }}</span>
                                          <span class="value">{{ $teacher->experience }} {{ __('profile.years') }}</span>
                                       </li>
                                       <li>
                                          <span class="title">{{ __('profile.Boarding Time') }}</span>
                                          <span class="value">{{ !empty($teacher->start_date) ? $teacher->start_date->getName() : '' }}</span>
                                       </li>
                                       <li>
                                          <span class="title">  {{ __('profile.Graduated two years or more') }}</span>
                                          <span class="value">{{ $teacher->is_graduated }}</span>
                                       </li>
                                       <li>
                                          <span class="title">{{ __('profile.Type of position') }}</span>
                                          <span class="value">{{ !empty($teacher->position) ? $teacher->position->name : '' }}</span>
                                       </li>
                                       <li>
                                          <span class="title">{{ __('profile.Type Of Work') }}</span>
                                          <span class="value">{{ !empty($teacher->job_type) ? $teacher->job_type->name : '' }}</span>
                                       </li>
                                       <li>
                                          <span class="title">{{ __('profile.Chinese Visa status') }}</span>
                                          <span class="value">{{ !empty($teacher->current_visa_type) ? $teacher->current_visa_type->name : '' }}</span>
                                       </li>
                                       <li>
                                          <span class="title">{{ __('profile.Expected Salary') }}</span>
                                          <span class="value">{{ !empty($teacher->minimum_salary) ? $teacher->minimum_salary->name.' -' : '' }} {{ !empty($teacher->maximum_salary) ? $teacher->maximum_salary->name : '' }} {{ __('profile.Monthly') }}</span>
                                       </li>
                                       <li>
                                          <span class="title">{{ __('profile.Expected Location') }}</span>
                                          <span class="value">
                                          @foreach($teacher->get_location as $value_location)
                                          {{ $value_location->get_location() }} <span class="title">|</span>
                                          @endforeach 
                                          {{ !empty($teacher->area) ? $teacher->area->getName() : '-' }}
                                          </span>
                                       </li>
                                       <li>
                                          <span class="title">{{ __('profile.Type of School') }}</span>
                                          @if(!empty($teacher->get_school_type))
                                          @php
                                          $school_type_html = '';
                                          @endphp
                                          @foreach($teacher->get_school_type as $key=>$school_type)
                                          @php
                                          $school_type_html .=  $school_type->school_type->name.', ';
                                          @endphp
                                          @endforeach
                                          <span class="value">{{ trim($school_type_html, ', ') }}</span>
                                          @endif
                                       </li>
                                       @if(!empty($teacher->others))
                                       <li>
                                          <span class="title">{{ __('profile.Other requirements') }}</span>
                                          <span class="value">{{ $teacher->others }}</span>
                                       </li>
                                       @endif
                                    </ul>
                                 </div>
                              </div>
                              <div class="col-xs-12 col-sm-6 margin-top-card">
                                 <div class="info-list card-font-size">
                                    <ul>
                                       <li>
                                          @if(!empty($teacher->getVideo()))
                                          @php
                                          $filename = explode('.', $teacher->user_video);
                                          $extension = end($filename);
                                          @endphp
                                          <video style="max-height: 210px;" width="100%" id="player" playsinline controls>
                                             @if (strtolower($extension) == 'mp4')
                                             <source src="{{ url('upload/profile') }}/{{ $teacher->user_video }}" type="video/mp4">
                                             @elseif (strtolower($extension) == 'webm')
                                             <source src="{{ url('upload/profile') }}/{{ $teacher->user_video }}" type="video/webm">
                                             @endif
                                          </video>
                                          @endif   
                                       </li>
                                       <li>
                                          <span class="title">{{ __('profile.About Me') }}</span>
                                          <span class="value">
                                             <p>{{ $teacher->bio }}</p>
                                          </span>
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </div>
                        @if($teacher->get_video->count() > 0)
                        <div class="page-title">
                           <h2>{{ __('profile.More Video') }}</h2>
                        </div>
                        <div class="section-content">
                           <div class="row">
                              <div class="col-xs-12 col-sm-12">
                                 <div class="portfolio-content">
                                    <div class="portfolio-grid three-columns">
                                       @foreach($teacher->get_video as $get_video)
                                       @if(!empty($get_video->getVideo()))
                                       <figure class="item lbaudio">
                                          @php
                                          $filename = explode('.', $get_video->name);
                                          $extension = end($filename);
                                          @endphp
                                          <video style="max-height: 210px;" width="100%" id="player"  controls>
                                             @if (strtolower($extension) == 'mp4')
                                             <source src="{{ $get_video->getVideo() }}" type="video/mp4">
                                             @elseif (strtolower($extension) == 'webm')
                                             <source src="{{ $get_video->getVideo() }}" type="video/webm">
                                             @endif
                                          </video>
                                       </figure>
                                       @endif
                                       @endforeach
                                    </div>
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
               <h2 style="color: #000;font-size: 20px;margin-bottom: 15px;">{{ __('profile.Send Message') }}</h2>
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
                  <label style="color: #000;">{{ __('profile.Message') }} <span style="color: red">*</span></label>
                  <textarea name="message" style="box-shadow: none;margin-top: 7px;border: 1px solid #e1e1e1;color: #000;" class="form-control clear-message" required=""></textarea>
                  <div style="text-align: right;margin-top: 30px;">
                     <button style="border-radius: 5px;box-shadow: none;background: #04b4e0;cursor: pointer;"  class="btn btn-success">{{ __('profile.Send') }}</button>
                  </div>
               </form>
            </div>
         </div>
         @endif


         <div class="modalDialogCV">
            <div>
               <a href="javascript:;" title="Close" class="close">X</a>
               <h2 style="color: #000;font-size: 20px;margin-bottom: 15px;">{{ __('profile.CV') }}</h2>
               <div id="getStaffCV"></div>
            </div>
         </div>

         <script src="{{ url('assets/card/js/jquery-2.1.3.min.js') }}"></script>
         <script src="{{ url('assets/card/js/imagesloaded.pkgd.min.js') }}"></script>
         <script src='{{ url('assets/card/js/perfect-scrollbar.min.js') }}'></script>
         <script src="{{ url('assets/card/js/mainjsfile.js') }}"></script>
         @include('backend.layouts._socket')
         <script type="text/javascript">


          $('body').on('click', '.getStaffCVUpload', function(e) {
                 var url = $(this).attr('id');
                 var html = '<iframe style="width: 100%;min-height: 700px;" src="'+url+'" ></iframe>';
                 $('#getStaffCV').html(html);
                 $('.modalDialogCV').show();
          });

            $('.modalDialogCV').delegate('.close','click',function() {
                 $('.modalDialogCV').hide();
            });
            





            function CopyLink(id) {
                 $("#CopyLink"+id).attr("type", "text");
                 var copyText = document.getElementById("CopyLink"+id);
                 copyText.select();
                 copyText.setSelectionRange(0, 99999)
                 document.execCommand("copy");
                 $("#CopyLink"+id).attr("type", "hidden");
                 alert("{{ __('profile.Copied') }}: " + copyText.value);
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
                     if(response.status) {
                         alert('{{ __('profile.Message successfully sent.') }}');
                         $('.modalDialog').hide();
                         $('.clear-message').val('');
                     }
                     else {
                        alert('{{ __('profile.Due to some error please try again.') }}');
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