<div class="flex-row-auto offcanvas-mobile w-300px w-xl-350px" id="kt_profile_aside">
   <!--begin::Profile Card-->
   <div class="card card-custom card-stretch">
      <!--begin::Body-->
      <div class="card-body pt-4" style="overflow: auto;">
         <!--begin::User-->
         <div class="d-flex align-items-center" style="margin-top: 20px;">
            <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
               <div class="symbol-label" style="background-image:url('{!! Auth::user()->getImage() !!}')"></div>
               <i class="symbol-badge bg-success"></i>
            </div>
            <div>
               <a href="#" class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">
               {{ Auth::user()->getName() }}
               </a>
               <br />

            <a style="margin-top: 10px;" class="btn btn-light btn-hover-primary btn-sm" href="{{ url('school/matched-teacher')}}"> <i class="fa fa-eye"></i> {{ __('layouts.View Profile') }}</a>
            
            </div>
         </div>
         <!--end::User-->
         <!--begin::Contact-->

         <div class="py-9">
            
            <div class="d-flex align-items-center justify-content-between mb-2">
               <span class="font-weight-bold mr-2">{{ __('layouts.Email') }}</span>
               <a href="javascript:;" class="text-muted text-hover-primary">{{ Auth::user()->email }}</a>
            </div>

            <div class="d-flex align-items-center justify-content-between mb-2">
               <span class="font-weight-bold mr-2">{{ __('layouts.Phone number') }}</span>
               <span class="text-muted">{{ Auth::user()->phone_number }}</span>
            </div>

           <div class="d-flex align-items-center justify-content-between mb-2">
               <span class="font-weight-bold mr-2">{{ __('layouts.Tutorial') }}</span>
               <span class="text-muted">
                     <span class="switch switch-success">
                           <label>
                              <input type="checkbox" id="change_is_tutorial" {{ (Auth::user()->is_tutorial == 1) ? 'checked' : '' }}>
                              <span></span>
                           </label>
                     </span>
               </span>
            </div>
         </div>

         <!--end::Contact-->
         <!--begin::Nav-->
         <div class="navi navi-bold navi-hover navi-active navi-link-rounded">
            <div class="navi-item mb-2">
               <a 

 {{-- data-toggle="popover" title="Popover title" data-html="true" data-placement="top" data-content="And here's some amazing <span class='label label-inline font-weight-bold label-light-primary'>HTML</span> content. It's very <code>engaging</code>. Right?" --}}

                href="{{ url('teacher/dashboard') }}" class="navi-link py-4 @if ( Request::segment(2) == 'dashboard' ) active @endif">
                  <span class="navi-icon mr-2"><i class="flaticon-squares-1"></i></span>
                  <span class="navi-text font-size-lg">{{ __('layouts.Dashboard') }}</span>
               </a>
            </div>
            <div class="navi-item mb-2">
               <a  
               @if(!empty(Auth::user()->is_tutorial))
               data-toggle="popover" title="{{ __('layouts.Profile') }}" data-html="true" data-placement="top" data-content="{{ __('layouts.Complete your profile to') }} <span class='text-danger'>{{ __('layouts.Find Your Dream Job') }}</span>"
               @endif
               href="{{ url('teacher/profile') }}" class="navi-link py-4 @if ( Request::segment(2) == 'profile' ) active @endif">
                  <span class="navi-icon mr-2"><i class="flaticon-profile"></i></span>
                  <span class="navi-text font-size-lg">{{ __('layouts.Profile') }}</span>
               </a>
            </div>

            <div class="navi-item mb-2">
              <a href="{{ url('teacher/vipul') }}" class="navi-link py-4 @if ( Request::segment(2) == 'vipul' ) active @endif">
                 <span class="navi-icon mr-2"><i class="flaticon-profile"></i></span>
                  <span class="navi-text font-size-lg">Vipul</span>
              </a>
            </div>

            <div class="navi-item mb-2">
               <a 
               @if(!empty(Auth::user()->is_tutorial))
               data-toggle="popover" title="{{ __('layouts.Find Your Dream Job') }}" data-html="true" data-placement="top" data-content="{{ __('layouts.Artificial Intelligence Matching System') }}" 
               @endif

                href="{{ url('teacher/matched-position') }}" class="navi-link py-4 @if ( Request::segment(2) == 'matched-position' ) active @endif">
                  <span class="navi-icon mr-2"><i class="flaticon-earth-globe"></i></span>
                  <span class="navi-text font-size-lg">{{ __('layouts.Find Your Dream Job') }}</span>
               </a>
            </div>


            <div class="navi-item mb-2">
                 <a 
                @if(!empty(Auth::user()->is_tutorial))
                data-toggle="popover" title="{{ __('layouts.Favorite School') }}" data-html="true" data-placement="top" data-content="{{ __('layouts.Find the school you saved') }}"
                @endif

                  href="{{ url('teacher/favorite-job') }}" class="navi-link py-4 @if ( Request::segment(2) == 'favorite-job' ) active @endif">
                     <span class="navi-icon mr-2"><i class="flaticon-user"></i></span>
                     <span class="navi-text font-size-lg">{{ __('layouts.Favorite School') }}</span>
                 </a>
             </div>


            <div class="navi-item mb-2">
               <a 
               @if(!empty(Auth::user()->is_tutorial))
            data-toggle="popover" title="{{ __('layouts.Interviews') }}" data-html="true" data-placement="top" data-content="{{ __('layouts.Check and join your online interview here') }}"
            @endif
                href="{{ url('teacher/interview') }}" class="navi-link py-4 @if ( Request::segment(2) == 'interview' ) active @endif">
                  <span class="navi-icon mr-2"><i class="flaticon-computer"></i></span>
                  <span class="navi-text font-size-lg">{{ __('layouts.Interviews') }}</span>
               </a>
            </div>


           <div class="navi-item mb-2">
               <a 
               @if(!empty(Auth::user()->is_tutorial))
              data-toggle="popover" title="{{ __('layouts.Offers') }}" data-html="true" data-placement="top" data-content="{{ __('layouts.Check and make the decision for your offers') }}"
              @endif

                href="{{ url('teacher/offer') }}" class="navi-link py-4 @if ( Request::segment(2) == 'offer' ) active @endif">
                  <span class="navi-icon mr-2"><i class="flaticon-medal"></i></span>
                  <span class="navi-text font-size-lg">{{ __('layouts.Offers') }}</span>
               </a>
            </div>


            <div class="navi-item mb-2">
               <a 
            @if(!empty(Auth::user()->is_tutorial))
            data-toggle="popover" title="{{ __('layouts.Contract') }}" data-html="true" data-placement="top" data-content="{{ __('layouts.The contract is a legal agreement between you and your new employer') }}"
            @endif

                href="{{ url('teacher/contract') }}" class="navi-link py-4 @if ( Request::segment(2) == 'contract' ) active @endif">
                  <span class="navi-icon mr-2"><i class="flaticon-edit-1"></i></span>
                  <span class="navi-text font-size-lg">{{ __('layouts.Contract') }}</span>
               </a>
            </div>


            <div class="navi-item mb-2">
               <a 
              @if(!empty(Auth::user()->is_tutorial))
              data-toggle="popover" title="{{ __('layouts.Visa') }}" data-html="true" data-placement="top" data-content="{{ __('layouts.VISFFOR will guide you to get visa step by step') }}"
              @endif
                href="{{ url('teacher/visa') }}" class="navi-link py-4 @if ( Request::segment(2) == 'visa' ) active @endif">
                  <span class="navi-icon mr-2"><i class="flaticon-folder-1"></i></span>
                  <span class="navi-text font-size-lg">{{ __('layouts.Visa') }}</span>
               </a>
            </div>


            <div class="navi-item mb-2">
               <a 
              @if(!empty(Auth::user()->is_tutorial))
              data-toggle="popover" title="{{ __('layouts.Travel Arrangement') }}" data-html="true" data-placement="top" data-content="{{ __('layouts.Enjoy your travel and see you in China') }}"
              @endif

                href="{{ url('teacher/travel') }}" class="navi-link py-4 @if ( Request::segment(2) == 'travel' ) active @endif">
                  <span class="navi-icon mr-2"><i class="flaticon-rocket"></i></span>
                  <span class="navi-text font-size-lg">{{ __('layouts.Travel Arrangement') }}</span>
               </a>
            </div>



             <div class="navi-item mb-2">
               <a 
              @if(!empty(Auth::user()->is_tutorial))
              data-toggle="popover" title="{{ __('layouts.Messages') }}" data-html="true" data-placement="top" data-content="{{ __('layouts.Check messages from schools') }}"
              @endif

                href="{{ url('teacher/chat') }}" class="navi-link py-4 @if ( Request::segment(2) == 'chat' ) active @endif">
                  <span class="navi-icon mr-2"><i class="flaticon-speech-bubble"></i></span>
                  <span class="navi-text font-size-lg">{{ __('layouts.Messages') }}</span>
               </a>
            </div>




            {{--  <div class="navi-item mb-2">
               <a  href="{{ url('teacher/feedback') }}" class="navi-link py-4 @if ( Request::segment(2) == 'feedback' ) active @endif">
                  <span class="navi-icon mr-2"><i class="flaticon-customer"></i></span>
                  <span class="navi-text font-size-lg">{{ __('layouts.Feedback') }}</span>
               </a>
            </div> --}}


            {{--  <div class="navi-item mb-2">
               <a  href="{{ url('teacher/report') }}" class="navi-link py-4 @if ( Request::segment(2) == 'report' ) active @endif">
                  <span class="navi-icon mr-2"><i class="flaticon-warning-sign"></i></span>
                  <span class="navi-text font-size-lg">{{ __('layouts.Report') }}</span>
               </a>
            </div> --}}
           
                       

             <div class="navi-item mb-2">
               <a 
              @if(!empty(Auth::user()->is_tutorial))
              data-toggle="popover" title="{{ __('layouts.24/7 Support') }}" data-html="true" data-placement="top" data-content="{{ __('layouts.Contact your private support or the other online VISFFOR staffs') }}"
              @endif

                href="{{ url('teacher/support') }}" class="navi-link py-4 @if ( Request::segment(2) == 'support' ) active @endif">
                  <span class="navi-icon mr-2"><i class="flaticon-businesswoman"></i></span>
                  <span class="navi-text font-size-lg">{{ __('layouts.24/7 Support') }}</span>
               </a>
            </div>
          
            <div class="navi-item mb-2">
               <a  href="{{ url('logout') }}" class="navi-link py-4 @if ( Request::segment(2) == 'logout' ) active @endif">
                  <span class="navi-icon mr-2"><i class="flaticon-logout"></i></span>
                  <span class="navi-text font-size-lg">{{ __('layouts.Sign Out') }}</span>
               </a>
            </div>

         </div>
         <!--end::Nav-->
      </div>
      <!--end::Body-->
   </div>
   <!--end::Profile Card-->
</div>