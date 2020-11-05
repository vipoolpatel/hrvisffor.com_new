<!--begin::Header-->
<div id="kt_header" class="header  header-fixed " >
   <!--begin::Container-->
   <div class=" container  d-flex align-items-stretch justify-content-between">
      <!--begin::Left-->
      <div class="d-flex align-items-stretch mr-3">
         <!--begin::Header Logo-->
         <div class="header-logo">
            <a href="{{ url('') }}">
            <img alt="Logo" src="{{ url('assets/front/img/logo.png') }}" class="logo-default max-h-40px"/>
            <img alt="Logo" src="{{ url('assets/front/img/logo.png') }}" class="logo-sticky max-h-40px"/>
            </a>
         </div>
         <!--end::Header Logo-->
         
         <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
            <!--begin::Header Menu-->
            <div id="kt_header_menu" class="header-menu header-menu-left header-menu-mobile  header-menu-layout-default " >
                <ul class="menu-nav">

                  @if(Auth::check())

                     @if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
                     @php
                     $staff_check_permission    = App\Models\AdminPermissionModel::getPermission('staff');
                     $teacher_check_permission  = App\Models\AdminPermissionModel::getPermission('teacher');
                     $job_check_permission      = App\Models\AdminPermissionModel::getPermission('jobs');
                     $teacher_chat_check_permission = App\Models\AdminPermissionModel::getPermission('teacher_chat');
                     $school_chat_check_permission = App\Models\AdminPermissionModel::getPermission('school_chat');   
                     $manage_check_permission = App\Models\AdminPermissionModel::getPermission('manage');                  
                     @endphp
                     <li class="menu-item  menu-item-submenu menu-item-rel" >
                        <a  href="{{ url('admin/dashboard') }}" class="menu-link"><span class="menu-text">{{ __('layouts.Dashboard') }}</span></a>
                     </li>
                     @if(!empty($staff_check_permission))
                     <li class="menu-item  menu-item-submenu menu-item-rel" >
                        <a  href="{{ url('admin/staff') }}" class="menu-link"><span class="menu-text">{{ __('layouts.Staff') }}</span></a>
                     </li>
                     @endif
                     @if(!empty($teacher_check_permission))
                     <li class="menu-item  menu-item-submenu menu-item-rel" >
                        <a  href="{{ url('admin/teacher') }}" class="menu-link"><span class="menu-text">{{ __('layouts.Teacher') }}</span></a>
                     </li>
                     @endif
                     @if(!empty($job_check_permission))
                     <li class="menu-item  menu-item-submenu menu-item-rel" >
                        <a  href="{{ url('admin/job') }}" class="menu-link"><span class="menu-text">{{ __('layouts.Job') }}</span></a>
                     </li>
                     @endif


                     <li class="menu-item  menu-item-submenu menu-item-rel" >
                        <a  href="{{ url('admin/task') }}" class="menu-link"><span class="menu-text">{{ __('layouts.Task') }}</span></a>
                     </li>


                     <li class="menu-item  menu-item-submenu menu-item-rel" >
                        <a  href="{{ url('admin/daily-report') }}" class="menu-link"><span class="menu-text">{{ __('layouts.Daily Report') }}</span></a>
                     </li>


                     <li class="menu-item  menu-item-submenu menu-item-rel" >
                        <a  href="{{ url('admin/chat') }}" class="menu-link"><span class="menu-text">{{ __('layouts.Chat') }} 
                           @php
                           $countChatHeaderMessage = App\Models\ChatModel::countdashabordmessage(Auth::user()->id);
                           @endphp
                           <i id="ShowChatMessageHeader" style="font-size: 6px;margin-left: 5px;color: #FFA800;{{  !empty($countChatHeaderMessage) ? : 'display: none;' }}" class="fa fa-circle"></i>
                            </span></a>
                     </li>
                   


                     <li class="menu-item  menu-item-submenu menu-item-rel" >
                        <a  href="{{ url('admin/privatechat') }}" class="menu-link"><span class="menu-text">{{ __('layouts.Private Chat') }}  
                           @php
                           $countPrivateChatHeaderMessage = App\Models\PrivateChatModel::countdashabordmessage(Auth::user()->id);
                           @endphp
                           <i id="ShowPrivateChatMessageHeader" style="font-size: 6px;margin-left: 5px;color: #FFA800;{{  !empty($countPrivateChatHeaderMessage) ? : 'display: none;'}}" class="fa fa-circle"></i>
                        </span></a>
                     </li>

                    


                     

                     <li class="menu-item  menu-item-submenu menu-item-rel" >
                        <a  href="{{ url('admin/groupchat') }}" class="menu-link"><span class="menu-text">{{ __('layouts.Group Chat') }}</span></a>
                     </li>

                     



                     {{--  
                     <li class="menu-item  menu-item-submenu menu-item-rel"  data-menu-toggle="click" aria-haspopup="true">
                        <a  href="javascript:;" class="menu-link menu-toggle"><span class="menu-text">Job</span><span class="menu-desc"></span><i class="menu-arrow"></i></a>
                        <div class="menu-submenu menu-submenu-classic menu-submenu-left" >
                           <ul class="menu-subnav">
                              <li class="menu-item ">
                                 <a  href="{{ url('admin/job') }}" class="menu-link">
                                 <span class="svg-icon menu-icon">
                                 <i class="flaticon2-list-2 text-success"></i>
                                 </span>
                                 <span class="menu-text">Job List</span>
                                 </a>
                              </li>
                              <li class="menu-item ">
                                 <a  href="{{ url('admin/job/add') }}" class="menu-link">
                                 <span class="svg-icon menu-icon">
                                 <i class="flaticon2-plus-1 text-success"></i>
                                 </span>
                                 <span class="menu-text">Add New Job</span>
                                 </a>
                              </li>
                           </ul>
                        </div>
                     </li>
                     --}}
                     @if(!empty($manage_check_permission))
                     <li class="menu-item  menu-item-submenu menu-item-rel" >
                        <a  href="{{ url('admin/manage') }}" class="menu-link"><span class="menu-text">{{ __('layouts.Manage') }}</span></a>
                     </li>
                     @endif
                     @elseif(Auth::user()->is_admin == 3)
                     <li class="menu-item  menu-item-submenu menu-item-rel" >
                        <a  href="{{ url('school/dashboard') }}" class="menu-link"><span class="menu-text">{{ __('layouts.Dashboard') }}</span></a>
                     </li>
                     <li class="menu-item  menu-item-submenu menu-item-rel"  data-menu-toggle="click" aria-haspopup="true">
                        <a  href="{{ url('school/position') }}" class="menu-link"><span class="menu-text">{{ __('layouts.Publish Position') }}</span></a>
                     </li>

                     <li class="menu-item  menu-item-submenu menu-item-rel" >
                        <a  href="{{ url('school/chat') }}" class="menu-link"><span class="menu-text">{{ __('layouts.Chat') }} 
                           @php
                           $countChatHeaderMessage = App\Models\ChatModel::countdashabordmessage(Auth::user()->id);
                           @endphp
                           <i id="ShowChatMessageHeader" style="font-size: 6px;margin-left: 5px;color: #FFA800;{{  !empty($countChatHeaderMessage) ? : 'display: none;' }}" class="fa fa-circle"></i>

                        </span></a>
                     </li>

                     
                     <li class="menu-item  menu-item-submenu menu-item-rel" >
                        <a  href="{{ url('school/groupchat') }}" class="menu-link"><span class="menu-text">{{ __('layouts.Group Chat') }}</span></a>
                     </li>




                  @elseif(Auth::user()->is_admin == 4)

                     <li class="menu-item  menu-item-submenu menu-item-rel" >
                        <a  href="{{ url('teacher/dashboard') }}" class="menu-link"><span class="menu-text">{{ __('layouts.Dashboard') }}</span></a>
                     </li>
                     <li class="menu-item  menu-item-submenu menu-item-rel"  data-menu-toggle="click" aria-haspopup="true">
                        <a  href="{{ url('teacher/matched-position') }}" class="menu-link"><span class="menu-text">{{ __('layouts.Find Your Dream Job') }}</span></a>
                     </li>

         

                      <li class="menu-item  menu-item-submenu menu-item-rel" >
                        <a  href="{{ url('teacher/chat') }}" class="menu-link"><span class="menu-text">{{ __('layouts.Chat') }} 
                           @php
                           $countChatHeaderMessage = App\Models\ChatModel::countdashabordmessage(Auth::user()->id);
                           @endphp
                           <i id="ShowChatMessageHeader" style="font-size: 6px;margin-left: 5px;color: #FFA800;{{  !empty($countChatHeaderMessage) ? : 'display: none;' }}" class="fa fa-circle"></i>

                        </span></a>
                     </li>


                     <li class="menu-item  menu-item-submenu menu-item-rel" >
                        <a  href="{{ url('teacher/groupchat') }}" class="menu-link"><span class="menu-text">{{ __('layouts.Group Chat') }}</span></a>
                     </li>

               
                     @endif
                  
             @else

               <li class="menu-item  menu-item-submenu menu-item-rel" >
                  <a  href="{{ url('') }}" class="menu-link"><span class="menu-text">{{ __('layouts.Home') }}</span></a>
               </li>
               <li class="menu-item  menu-item-submenu menu-item-rel" >
                  <a  href="{{ url('contact-us') }}" class="menu-link"><span class="menu-text">{{ __('layouts.Contact Us') }}</span></a>
               </li>


             @endif

             </ul>

               
               
            </div>
            <!--end::Header Menu-->
         </div>
         
      </div>
      <!--end::Left-->
      <!--begin::Topbar-->
      <div class="topbar">
         

      @if(Auth::check())

         <div class="dropdown">
         
            <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
               <div class="btn btn-icon btn-hover-transparent-white btn-dropdown btn-lg mr-1 pulse pulse-primary">
                  <span class="svg-icon svg-icon-xl">
                     <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
                     <svg  width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                           <rect x="0" y="0" width="24" height="24"/>
                           <path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" fill="#000000" opacity="0.3"/>
                           <path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" fill="#000000"/>
                        </g>
                     </svg>
                     <!--end::Svg Icon-->
                  </span>
               </div>
            </div>

            {{-- Condition End --}}
            <!--end::Toggle-->
            <!--begin::Dropdown-->
            <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
               <form>
                  @php
                  if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2) {
                     if(Auth::user()->is_admin == 2)
                     {
                           $user_notification = App\Models\NotificationModel::get_staff_notification(); 
                     }
                     else
                     {
                           $user_notification = App\Models\UsersModel::get_single(1);   
                     }
                  }
                  else {
                     $user_notification = App\Models\UsersModel::get_single(Auth::user()->id);  
                  }
                  @endphp
                  <!--begin::Header-->
                  <div class="d-flex flex-column pt-12 bgi-size-cover bgi-no-repeat rounded-top" style="background-image: url({{ url('assets/media/misc/bg-1.jpg')  }})">
                     <!--begin::Title-->
                     <h4 class="d-flex flex-center rounded-top" style="padding-bottom: 15px;">
                        <span class="text-white">{{ __('layouts.User Notifications') }}</span>
                        <span class="btn btn-text btn-success btn-sm font-weight-bold btn-font-md ml-2">
                           @if(Auth::user()->is_admin == 2)
                              {{ $user_notification->count() }} {{ __('layouts.new') }}
                           @else
                              {{ $user_notification->unreadNotifications->count() }} {{ __('layouts.new') }}
                           @endif
                        </span>
                     </h4>
                     <!--end::Title-->
                  </div>
                  <!--end::Header-->
                  <!--begin::Content-->
                  <div class="tab-content">
                     <!--begin::Tabpane-->
                     <div class="tab-pane active show p-8" id="topbar_notifications_notifications" role="tabpanel">
                        <!--begin::Scroll-->
                        <div class="scroll pr-7 mr-n7" data-scroll="true" data-height="300" data-mobile-height="200">

                           @if(Auth::user()->is_admin == 2)

                              @foreach($user_notification  as $notification_header)
                                 @php
                                     $getdata_header_menu = json_decode($notification_header->data);
                                 @endphp

                              <div class="d-flex align-items-center mb-6">
                                 <div class="d-flex flex-column font-weight-bold">
                                     <a href="{{ url('admin/my-notification?id='.$notification_header->notification_id) }}" class="text-dark text-hover-primary mb-1 font-size-lg">{{ $getdata_header_menu->message }}</a>
                                    <span class="text-muted">{{ Carbon\Carbon::parse($notification_header->created_at)->diffForHumans()}}</span>
                                 </div>                       
                              </div>
                             @endforeach 

                           @else

                              
                             @foreach($user_notification->unreadNotifications  as $notification_header)
                              <div class="d-flex align-items-center mb-6">
                                 <div class="d-flex flex-column font-weight-bold">
                                    @if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
                                     <a href="{{ url('admin/my-notification?id='.$notification_header->id) }}" class="text-dark text-hover-primary mb-1 font-size-lg">{{ $notification_header->data['message'] }}</a>

                                    @elseif(Auth::user()->is_admin == 3)
                                       <a href="{{ url('school/my-notification?id='.$notification_header->id) }}" class="text-dark text-hover-primary mb-1 font-size-lg">{{ $notification_header->data['message'] }}</a>
                                    @elseif(Auth::user()->is_admin == 4)
                                       <a href="{{ url('teacher/my-notification?id='.$notification_header->id) }}" class="text-dark text-hover-primary mb-1 font-size-lg">{{ $notification_header->data['message'] }}</a>
                                    @endif
                                    <span class="text-muted">{{ Carbon\Carbon::parse($notification_header->created_at)->diffForHumans()}}</span>
                                 </div>                       
                              </div>
                             @endforeach   

                           @endif



                        </div>
                        <!--end::Scroll-->
                        <!--begin::Action-->
                        @if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
                           <div class="d-flex flex-center pt-7"><a href="{{ url('admin/my-notification') }}" class="btn btn-light-primary font-weight-bold text-center">{{ __('layouts.See All') }}</a></div>
                        @elseif(Auth::user()->is_admin == 3)
                           <div class="d-flex flex-center pt-7"><a href="{{ url('school/my-notification') }}" class="btn btn-light-primary font-weight-bold text-center">{{ __('layouts.See All') }}</a></div>
                        @elseif(Auth::user()->is_admin == 4)
                           <div class="d-flex flex-center pt-7"><a href="{{ url('teacher/my-notification') }}" class="btn btn-light-primary font-weight-bold text-center">{{ __('layouts.See All') }}</a></div>
                        @endif
                        

                        <!--end::Action-->
                     </div>
                     <!--end::Tabpane-->
                  </div>
                  <!--end::Content-->
               </form>
            </div>
            <!--end::Dropdown-->
         </div>
         
      @endif

         <!--begin::Languages-->
         <div class="dropdown">
            <!--begin::Toggle-->
            {{-- Condition Start --}}
            <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
               <div
                  class="btn btn-icon btn-hover-transparent-white btn-dropdown btn-lg mr-1">
                  @if(\Session::get('locale') == 'ch')
                        <img class="h-20px w-20px rounded-sm"
                     src="{{ asset('assets/media/svg/flags/034-china.svg') }}"
                     alt="">
                  @else
                     <img class="h-20px w-20px rounded-sm"
                     src="{{ asset('assets/media/svg/flags/260-united-kingdom.svg') }}"
                     alt="">
                  @endif
                  
               </div>
            </div>
            {{-- Condition End --}}
            <!--end::Toggle-->
            <!--begin::Dropdown-->
            <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
               <!--begin::Nav-->
               <ul class="navi navi-hover py-4">
                  <!--begin::Item-->
                  <li class="navi-item">
                     <a href="{{ url('locale/en') }}" class="navi-link">
                     <span class="symbol symbol-20 mr-3">
                     <img src="{{ asset('assets/media/svg/flags/260-united-kingdom.svg') }}">
                     </span>
                     <span class="navi-text">{{ __('layouts.English') }}</span>
                     </a>
                  </li>
                  <!--end::Item-->
                  <!--begin::Item-->
                  <!--end::Item-->
                  <!--begin::Item-->
                  <li class="navi-item">
                     <a href="{{ url('locale/ch') }}" class="navi-link">
                     <span class="symbol symbol-20 mr-3">
                     <img src="{{ asset('assets/media/svg/flags/034-china.svg') }}">
                     </span>
                     <span class="navi-text">{{ __('layouts.Chinese') }}</span>
                     </a>
                  </li>
                  <!--end::Item-->
                  <!--begin::Item-->
                  <!--end::Item-->
               </ul>
               <!--end::Nav-->
            </div>
            <!--end::Dropdown-->
         </div>
         <!--end::Languages-->


      @if(Auth::check())
         
         <div class="dropdown">
            <!--begin::Toggle-->
            <div class="topbar-item" data-toggle="dropdown" data-offset="0px,0px">
               <div class="btn btn-icon d-flex align-items-center btn-lg px-md-2 w-md-auto">
                  <span class="text-white opacity-90 font-weight-bolder font-size-base d-md-inline mr-4">
                     <img style="height: 30px;width: 30px;border-radius: 20px;" src="{{ Auth::user()->getImage() }}">
                     </span>
               </div>
            </div>
            <!--end::Toggle-->
            <!--begin::Dropdown-->
            <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg p-0">
               <!--begin::Header-->
               <div class="d-flex align-items-center p-8 rounded-top">
                  <!--begin::Symbol-->
                  <div class="symbol symbol-md bg-light-primary mr-3 flex-shrink-0">
                     <img src="{!! Auth::user()->getImage() !!}" alt=""/>
                  </div>
                  <!--end::Symbol-->
                  <!--begin::Text-->
                  <div class="text-dark m-0 flex-grow-1 mr-3 font-size-h5">{{ Auth::user()->getName() }}</div>
                  <!--end::Text-->
               </div>
               <div class="separator separator-solid"></div>
               <!--end::Header-->
               <!--begin::Nav-->
               <div class="navi navi-spacer-x-0 pt-5">
                  @if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
                  <a href="{{ url('admin/change-password') }}" class="navi-item px-8">
                     <div class="navi-link">
                        <div class="navi-icon mr-2">
                           <i class="flaticon2-hourglass text-primary"></i>
                        </div>
                        <div class="navi-text">
                           <div class="font-weight-bold">
                              {{ __('layouts.Change Password') }}
                           </div>
                        </div>
                     </div>
                  </a>
                  <!--end::Item-->
                  <!--begin::Item-->
                  <a href="{{ url('admin/my-notification') }}"  class="navi-item px-8">
                     <div class="navi-link">
                        <div class="navi-icon mr-2">
                           <i class="flaticon2-rocket-1 text-danger"></i>
                        </div>
                        <div class="navi-text">
                           <div class="font-weight-bold">
                              {{ __('layouts.My Notifications') }}
                           </div>
                        </div>
                     </div>
                  </a>
                  <!--end::Item-->
                  <!---School Role ID 3-->
                  @elseif(Auth::user()->is_admin==3)
                  <!--begin::Item-->
                  <a href="{{ url('school/profile') }}" class="navi-item px-8">
                     <div class="navi-link">
                        <div class="navi-icon mr-2">
                           <i class="flaticon2-calendar-3 text-success"></i>
                        </div>
                        <div class="navi-text">
                           <div class="font-weight-bold">
                              {{ __('layouts.My Profile') }}
                           </div>
                        </div>
                     </div>
                  </a>
                  <a href="{{ url('school/change-password') }}" class="navi-item px-8">
                     <div class="navi-link">
                        <div class="navi-icon mr-2">
                           <i class="flaticon2-hourglass text-primary"></i>
                        </div>
                        <div class="navi-text">
                           <div class="font-weight-bold">
                              {{ __('layouts.Change Password') }}
                           </div>
                        </div>
                     </div>
                  </a>
                  <!--end::Item-->
                  <!--begin::Item-->
                  <a href="{{ url('school/chat') }}"  class="navi-item px-8">
                     <div class="navi-link">
                        <div class="navi-icon mr-2">
                           <i class="flaticon2-mail text-warning"></i>
                        </div>
                        <div class="navi-text">
                           <div class="font-weight-bold">
                              {{ __('layouts.My Messages') }}
                           </div>
                        </div>
                     </div>
                  </a>
                  <!--end::Item-->
                  <!--begin::Item-->
                  <a href="{{ url('school/my-notification') }}"  class="navi-item px-8">
                     <div class="navi-link">
                        <div class="navi-icon mr-2">
                           <i class="flaticon2-rocket-1 text-danger"></i>
                        </div>
                        <div class="navi-text">
                           <div class="font-weight-bold">
                              {{ __('layouts.My Notifications') }}
                           </div>
                        </div>
                     </div>
                  </a>
                  <!--end::Item-->
                  <!---Teacher Role ID 4 -->
                  @elseif(Auth::user()->is_admin==4)
                  <!--begin::Item-->
                  <a href="{{ url('teacher/profile') }}" class="navi-item px-8">
                     <div class="navi-link">
                        <div class="navi-icon mr-2">
                           <i class="flaticon2-calendar-3 text-success"></i>
                        </div>
                        <div class="navi-text">
                           <div class="font-weight-bold">
                              {{ __('layouts.My Profile') }}
                           </div>
                        </div>
                     </div>
                  </a>
                  <a href="{{ url('teacher/change-password') }}" class="navi-item px-8">
                     <div class="navi-link">
                        <div class="navi-icon mr-2">
                           <i class="flaticon2-hourglass text-primary"></i>
                        </div>
                        <div class="navi-text">
                           <div class="font-weight-bold">
                              {{ __('layouts.Change Password') }}
                           </div>
                        </div>
                     </div>
                  </a>
                  <!--end::Item-->
                  <!--begin::Item-->
                  <a href="{{ url('teacher/chat') }}"  class="navi-item px-8">
                     <div class="navi-link">
                        <div class="navi-icon mr-2">
                           <i class="flaticon2-mail text-warning"></i>
                        </div>
                        <div class="navi-text">
                           <div class="font-weight-bold">
                              {{ __('layouts.My Messages') }}
                           </div>
                        </div>
                     </div>
                  </a>
                  <!--end::Item-->
                  <!--begin::Item-->
                  <a href="{{ url('teacher/my-notification') }}"  class="navi-item px-8">
                     <div class="navi-link">
                        <div class="navi-icon mr-2">
                           <i class="flaticon2-rocket-1 text-danger"></i>
                        </div>
                        <div class="navi-text">
                           <div class="font-weight-bold">
                              {{ __('layouts.My Notifications') }}
                           </div>
                        </div>
                     </div>
                  </a>
                  <!--end::Item-->
                  @endif
                  <!--end::Item-->
                  <!--begin::Footer-->
                  <div class="navi-separator mt-3"></div>
                  <div class="navi-footer  px-8 py-5">
                     <a href="{{ url('logout') }}" class="btn btn-light-primary font-weight-bold">{{ __('layouts.Sign Out') }}</a>
                  </div>
                  <!--end::Footer-->
               </div>
               <!--end::Nav-->
            </div>
            <!--end::Dropdown-->
         </div>
         
      @else

      <div class="dropdown">
       
            <a href="{{ url('login') }}" class="topbar-item" style="padding-right: 10px;">
               <div class="btn btn-icon btn-hover-transparent-white d-flex align-items-center btn-lg px-md-2 w-md-auto">
                  <span class="text-white opacity-70 font-weight-bold font-size-base d-md-inline mr-1">{{ __('layouts.Login') }}</span>
               </div>
            </a>

            <a href="{{ url('register') }}" class="topbar-item">
               <div class="btn btn-icon btn-hover-transparent-white d-flex align-items-center btn-lg px-md-2 w-md-auto">
                  <span class="text-white opacity-70 font-weight-bold font-size-base d-md-inline mr-1">{{ __('layouts.Register') }}</span>
               </div>
            </a>
            
         </div>

      @endif




      </div>
      <!--end::Topbar-->
   </div>
   <!--end::Container-->
</div>
<!--end::Header-->
