<!DOCTYPE html>

<html lang="en" >
   <!--begin::Head-->
   <head>

      <meta charset="utf-8"/>
      <title>{{ __('profile.Public Profile') }}</title>

      <meta name="description" content="User profile overview example"/>
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
      <!--begin::Fonts-->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
      <!--end::Fonts-->
      <!--begin::Global Theme Styles(used by all pages)-->
      <link href="{{ url('assets/plugins/global/plugins.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
      <link href="{{ url('assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
      <link href="{{ url('assets/css/style.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
       <link href="{{ url('assets/front/css/style.css') }}" rel="stylesheet">

      <!--end::Global Theme Styles-->
      <!--begin::Layout Themes(used by all pages)-->
      <!--end::Layout Themes-->
      <link rel="shortcut icon" href="{{ url('assets/front/img/favicon.ico') }}"/>
       @yield('style')
   </head>

   <!--end::Head-->
   <!--begin::Body-->
   <body  id="kt_body" style="background-image: url({{ url('assets/media/bg/bg-10.jpg') }})"  class="quick-panel-right demo-panel-right offcanvas-right header-fixed subheader-enabled page-loading"  >
      <!--begin::Main-->
      @include('backend.layouts._mobile')

        <div class="d-flex flex-column flex-root">
         <!--begin::Page-->
         <div class="d-flex flex-row flex-column-fluid page">
            <!--begin::Wrapper-->
         <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">





         <div id="kt_header" class="header"  style="position: unset;">
            <div class=" container  d-flex align-items-stretch justify-content-between">
               <div class="row" style="width: 100%;">
                     <div class="col-sm-4" style="margin-top: 14px;">
                        <a href="{{ url('') }}"><img alt="Logo" src="{{ url('assets/front/img/logo.png') }}" class="logo-default max-h-40px"/></a>
                     </div>
                     <div class="col-sm-4" style="text-align: center;margin-top: 20px;color: #ffff;font-size: 24px;">{{ $header_title }}</div>
                     <div class="col-sm-4 text-right" style="margin-top: 20px;">
                              <div class="dropdown">
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
                                 <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
                                    <ul class="navi navi-hover py-4">
                                       <li class="navi-item">
                                          <a href="{{ url('locale/en') }}" class="navi-link">
                                          <span class="symbol symbol-20 mr-3">
                                          <img src="{{ asset('assets/media/svg/flags/260-united-kingdom.svg') }}">
                                          </span>
                                          <span class="navi-text">{{ __('layouts.English') }}</span>
                                          </a>
                                       </li>
                                       <li class="navi-item">
                                          <a href="{{ url('locale/ch') }}" class="navi-link">
                                          <span class="symbol symbol-20 mr-3">
                                          <img src="{{ asset('assets/media/svg/flags/034-china.svg') }}">
                                          </span>
                                          <span class="navi-text">{{ __('layouts.Chinese') }}</span>
                                          </a>
                                       </li>
                                    </ul>
                                 </div>
                              </div>

                     </div>
                  </div>
            </div>


         </div>






































          @yield('content')

   

        <!--begin::Footer-->

               <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
         </div>
         <!--end::Page-->
      </div>
      <!--end::Main-->

      <!--begin::Scrolltop-->
      <div id="kt_scrolltop" class="scrolltop">
         <span class="svg-icon">
            <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
               <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <polygon points="0 0 24 0 24 24 0 24"/>
                  <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1"/>
                  <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero"/>
               </g>
            </svg>
            <!--end::Svg Icon-->
         </span>
      </div>
      <!--end::Scrolltop-->

      <!--end::Global Config-->
      <!--begin::Global Theme Bundle(used by all pages)-->
      <script src="{{ url('assets/plugins/global/plugins.bundle.js?v=7.0.6') }}"></script>
      <script src="{{ url('assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.6') }}"></script>
      <script src="{{ url('assets/js/scripts.bundle.js?v=7.0.6') }}"></script>
      <!--end::Global Theme Bundle-->
      <!--begin::Page Scripts(used by this page)-->
      <script src="{{ url('assets/js/pages/widgets.js?v=7.0.6') }}"></script>
      <script src="{{ url('assets/js/pages/custom/profile/profile.js?v=7.0.6') }}"></script>
      <!--end::Page Scripts-->

       @yield('script')

    

   </body>
   <!--end::Body-->
</html>
