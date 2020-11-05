<!DOCTYPE html>

<html lang="en" >
   <!--begin::Head-->
   <head>

      <meta charset="utf-8"/>
      @if(Auth::check())
       <title>@if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2) {{ __('layouts.Admin Panel') }} - {{ config('app.name') }} @elseif(Auth::user()->is_admin == 3) {{ __('layouts.School Panel') }} - {{ config('app.name') }} @elseif(Auth::user()->is_admin == 4) {{ __('layouts.Teacher Panel') }} - {{ config('app.name') }} @endif </title>
      @else
      <title>{{ __('layouts.Teach in China') }}</title>
      @endif
     

      <meta name="description" content="User profile overview example"/>
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
      <!--begin::Fonts-->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
      <!--end::Fonts-->
      <!--begin::Global Theme Styles(used by all pages)-->
      <link href="{{ url('assets/plugins/global/plugins.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
      <link href="{{ url('assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
      
      
      <link href="{{ url('assets/css/style.bundle.min.css') }}" rel="stylesheet" type="text/css"/>
      {{-- <link href="{{ url('assets/css/style.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/> --}}

       <link href="{{ url('assets/front/css/style.css') }}" rel="stylesheet">

      <!--end::Global Theme Styles-->
      <!--begin::Layout Themes(used by all pages)-->
      <!--end::Layout Themes-->
      <link rel="shortcut icon" href="{{ url('assets/front/img/favicon.ico') }}"/>
      <style type="text/css">
         select {
    -moz-appearance:none; 
    -webkit-appearance:none;
    appearance:none;
}
      </style>


{{-- <script>(function(d,t,u,s,e){e=d.getElementsByTagName(t)[0];s=d.createElement(t);s.src=u;s.async=1;e.parentNode.insertBefore(s,e);})(document,'script','//visffor.net/livechat/php/app.php?widget-init.js');</script>
 --}}

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




      @include('backend.layouts._header')

          @yield('content')

      @include('backend.layouts._footer')

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




@if(Auth::check())

<div class="modal fade" id="SendMessageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ __('layouts.Send Message') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
            </button>
         </div>

        <form action="" id="SubmiMessage" enctype="multipart/form-data" method="post">
           {{ csrf_field() }}
           <input type="hidden" name="main_connect_id" id="get_main_connect_id">
           <input type="hidden" name="school_id" id="get_school_id">
           <input type="hidden" name="teacher_id" id="get_teacher_id">
           <input type="hidden" name="school_staff_id" id="get_school_staff_id">
           <input type="hidden" name="teacher_staff_id" id="get_teacher_staff_id">
           <input type="hidden" name="sender_id" id="get_sender_id">
           <input type="hidden" name="receiver_id" id="get_reciever_id">
           <input type="hidden" name="token"  value="{{ Auth::user()->token }}">
           
           <div class="modal-body">
              <div class="row">
                 <div class="col-md-12">
                    <div class="form-group">
                       <label>{{ __('layouts.Message') }} <span style="color: red" class="required">*</span></label>
                       <textarea name="message" required class="clear-message form-control form-control-lg form-control-solid"></textarea>
                    </div>
                 </div>
              </div>

         </div>
         <div class="modal-footer">
            <button type="submit" class="btn btn-success font-weight-bold">{{ __('layouts.Send') }}</button>
         </div>
       </form>

      </div>
   </div>
</div>

@endif



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
         @include('backend.layouts._socket')

       @yield('script')


     <script type="text/javascript">


@if(Auth::check())

$('body').delegate('#change_is_tutorial','change',function() {
    $.ajax({
          url: "{{ url('teacher/change_tutorial_status') }}",
          type: "POST",
          data:{
            "_token": "{{ csrf_token() }}",
           },
           dataType:"json",
           success:function(response){
                location.reload()
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

        $('#SendMessageModal').modal('show');  
 });



 $('#SendMessageModal').delegate('#SubmiMessage','submit',function(e) {
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
                      $('.modalDialog').hide();
                      $('#SendMessageModal').modal('hide');
                      $('.clear-message').val('');
                      alert('{{ __('layouts.Message successfully sent.') }}');
                }
                else {
                   alert('{{ __('layouts.Due to some error please try again.') }}');
                }
           },
         });
 });
 


 @endif













         function CopyLink(id) {
              $("#CopyLink"+id).attr("type", "text");
              var copyText = document.getElementById("CopyLink"+id);
              copyText.select();
              copyText.setSelectionRange(0, 99999)
              document.execCommand("copy");
              $("#CopyLink"+id).attr("type", "hidden");
              alert("{{ __('layouts.Copied') }} : " + copyText.value);
         }


        function TeacherRecommend(user_id,job_id) {
             $.ajax({
                url: "{{ url('admin/job/teacher_recommend') }}",
                type: "POST",
                data:{
                  "_token": "{{ csrf_token() }}",
                    user_id:user_id,
                    job_id:job_id,
                 },
                 dataType:"json",
                 success:function(response){
                     alert(response.success);
                 },
            });
        }



        function SchoolRecommend(school_id,teacher_id) {
             $.ajax({
                url: "{{ url('admin/teacher/school_recommend') }}",
                type: "POST",
                data:{
                  "_token": "{{ csrf_token() }}",
                    teacher_id:teacher_id,
                    school_id:school_id,
                 },
                 dataType:"json",
                 success:function(response){
                     alert(response.success);
                 },
            });
        }


        

   var KTAppSettings = { };
         
      </script>

   </body>
   <!--end::Body-->
</html>
