<!DOCTYPE html>
<html lang="en" >
   <!--begin::Head-->
   <head>
      <meta charset="utf-8"/>
      <title>{!! !empty($meta_title) ? $meta_title : '' !!} - {{__("auth.VISFFOR")}}</title>
      <meta name="description" content="Login page example"/>
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
      <!--begin::Fonts-->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
      <!--end::Fonts-->
      <!--begin::Page Custom Styles(used by this page)-->
      <link href="{{ url('assets/css/pages/login/login-2.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
      <!--end::Page Custom Styles-->
      <!--begin::Global Theme Styles(used by all pages)-->
      <link href="{{ url('assets/plugins/global/plugins.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
      <link href="{{ url('assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
      <link href="{{ url('assets/css/style.bundle.css?v=7.0.6') }}"  rel="stylesheet" type="text/css"/>
      <!--end::Global Theme Styles-->
      <!--begin::Layout Themes(used by all pages)-->
      <!--end::Layout Themes-->
      <link rel="shortcut icon" href="{{ url('assets/front/img/favicon.ico') }}"/>
<style type="text/css">
   .required { 
      color: red;
    }
</style>
   </head>
   <!--end::Head-->
   <!--begin::Body-->
   <body  id="kt_body" style="background-image: url({{ url('assets/media/bg/bg-10.jpg')  }})"  class="quick-panel-right demo-panel-right offcanvas-right header-fixed subheader-enabled page-loading"  >
      <!--begin::Main-->


       @yield('content')

       <!--end::Main-->
      <!--begin::Global Theme Bundle(used by all pages)-->
      <script src="{{ url('assets/plugins/global/plugins.bundle.js?v=7.0.6') }}"></script>
      <script src="{{ url('assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.6') }}"></script>
      <script src="{{ url('assets/js/scripts.bundle.js?v=7.0.6') }}"></script>
      <!--end::Global Theme Bundle-->
      <!--begin::Page Scripts(used by this page)-->
      <script src="{{ url('assets/js/pages/custom/login/login-general.js?v=7.0.6') }}"></script>
      <!--end::Page Scripts-->
   </body>
   <!--end::Body-->
</html>
