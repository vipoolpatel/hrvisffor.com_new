@extends('backend.layouts.app')
@section('style')
<style type="text/css">
  
</style>
@endsection
@section('content')
<!--begin::Content-->
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content" style="margin-top: 10px;">
   <!--begin::Entry-->
   <div class="d-flex flex-column-fluid">
      <!--begin::Container-->
      <div class=" container ">
         <!--begin::Chat-->
         <div class="d-flex flex-row">
            <!--begin::Aside-->
            <div class="flex-row-auto offcanvas-mobile w-350px w-xl-400px" id="kt_chat_aside">
               <!--begin::Card-->
               <div class="card card-custom">
                  <!--begin::Body-->
                  <div class="card-body">

                    <div class="input-group input-group-solid">
                        <input type="hidden" value="{{ $history }}" id="get_history">
                        <input type="text" data-val="{{ $sender_id }}" class="form-control py-4 h-auto" id="SearchMember" placeholder="{{ __('chat.Search Member') }}" />
                    </div>

                    <div class="mt-7 scroll scroll-pull sroll-sidebar-user">
                        <span id="getChatUserChat">
                            @include('backend.chat._user')
                        </span>
                        @if(!empty($getUser['page']))
                          <div style="width: 100%;text-align: center;margin-top: 15px;">
                            <a data-val="{{ $sender_id }}" href="javascript:;" style="display: block;margin: 0px 10px;" id="{{ $getUser['page'] }}" class="btn btn-success ChatLoadMore">{{ __('chat.Load More') }}</a>  
                          </div>
                        @endif
                    </div>

                  </div>
               </div>
            </div>

            <div class="flex-row-fluid ml-lg-8"  id="kt_chat_content">
               <!--begin::Card-->
               <div class="card card-custom" >

                       <div class="card-header align-items-center px-4 py-3">
                         <div class="text-left flex-grow-1">
                          
                            <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md d-lg-none" id="kt_app_chat_toggle">
                               <span class="flaticon2-calendar-3 text-success" style="font-size: 18px;"></span>
                            </button>
                         </div>
                         <div class="text-center flex-grow-1">
                            <div id="getNameUser" class="text-dark-75 font-weight-bold font-size-h5"></div>
                            <div style="display: none;" id="ActiveUser">
                               <span class="label label-sm label-dot label-success"></span>
                               <span class="font-weight-bold text-muted font-size-sm">{{ __('chat.Active') }}</span>
                            </div>
                         </div>
                         <div class="text-right flex-grow-1">

                         </div>
                      </div>
                  

                      <span id="getMessageChat">
                           @include('backend.chat._all_chat')
                      </span>

               </div>
               <!--end::Card-->
            </div>
            <!--end::Content-->
         </div>
         <!--end::Chat-->
      </div>
      <!--end::Container-->
   </div>
   <!--end::Entry-->
</div>
<!--end::Content-->
@endsection
@section('script')
<script src="{{ url('assets/js/pages/custom/chat/chat.js?v=7.0.6') }}"></script>


<script type="text/javascript">

        var xhr;
          
        $('body').delegate('#chat-message','keydown',function(e) {
              var value = $(this).val();
              if (e.ctrlKey && e.keyCode == 13) {
                  if(value != "")
                  {
                      $('#SubmitReply').submit();
                  }
              }
         });
         

        $('body').delegate('.ChatLoadMore','click',function() {

            var page = $(this).attr('id');
            var sender_id = $(this).attr('data-val');

            $.ajax({
                url: "{{ url('get_chat_user?page=') }}"+page,
                type: "POST",
                data:{
                 "_token": "{{ csrf_token() }}",
                 sender_id:sender_id,
                },
                dataType:"json",
                success:function(response){
                    if(response.page > 0)
                    {
                        $('.ChatLoadMore').attr('id',response.page);
                    }
                    else
                    {
                        $('.ChatLoadMore').hide(); 
                    }
                    $('#getChatUserChat').append(response.success);

                    $(".sroll-sidebar-user").stop().animate({ scrollTop: $(".sroll-sidebar-user")[0].scrollHeight}, 1);

                },
            });

        });




        $('body').delegate('#SearchMember','keyup',function() {

            var name = $(this).val();
            var sender_id = $(this).attr('data-val');

            if(xhr && xhr.readyState != 4){
                xhr.abort();
            }

            xhr = $.ajax({
               url: "{{ url('get_chat_user') }}",
               type: "POST",
               data:{
                "_token": "{{ csrf_token() }}",
                  name:name,
                  sender_id:sender_id,
                },
               dataType:"json",
               success:function(response){
                   $('#getChatUserChat').html(response.success);
                   KTAppChat.init();
               },
            });
        });




        $('body').delegate('.getnewchat','click',function(){
            var receiver_id = $(this).attr('id');
            var name = $(this).attr('data-name');

            $('#getNameUser').html(name);
            $('#ActiveUser').show();
            

            var sender_id        = $(this).attr('data-senderid');
            var school_id        = $(this).attr('data-schoolid');
            var teacher_id       = $(this).attr('data-teacherid');
            var school_staff_id  = $(this).attr('data-schoolstaffid');
            var teacher_staff_id = $(this).attr('data-teacherstaffid');
            var main_connect_id  = $(this).attr('data-main_connect_id');

            $.ajax({
                url: "{{ url('getchatdata') }}",
                type: "POST",
                data:{
                 "_token": "{{ csrf_token() }}",
                   receiver_id:receiver_id,
                   sender_id:sender_id,
                   school_id:school_id,
                   teacher_id:teacher_id,
                   school_staff_id:school_staff_id,
                   teacher_staff_id:teacher_staff_id,
                   main_connect_id:main_connect_id,
                   history:"{{ $history }}"
                },
                dataType:"json",
                success:function(response){
                    $('#getMessageChat').html(response.success);

                    @if(empty($history))
                      $('#clear_count_'+main_connect_id).html('');
                    @endif
                    KTAppChat.init();
                    $(".blank-space").stop().animate({ scrollTop: $(".blank-space")[0].scrollHeight}, 1);

                },
              });

       });


         $('body').delegate('#SubmitReply','submit',function(e) {
              e.preventDefault();
               $("#DisEnaSendMessage").attr("disabled", true); 

              $.ajax({
                url: app_base_url+"/api/app_private_chat_send",
                method: "POST",
                data:$(this).serialize(),
                "headers": {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                dataType:"json",
                 success:function(data){
                    if(data.status) {
                      $("#DisEnaSendMessage").attr("disabled", false); 
                      $('#chat-message').val('');
                      var date =  moment.unix(data.result.timestamp);
                      var create_date =  date.fromNow(); 
                        
                        var html = '<div class="d-flex flex-column mb-5 align-items-end">\n\
                            <div class="d-flex align-items-center">\n\
                               <div>\n\
                                  <span class="text-muted font-size-sm">'+create_date+'</span>\n\
                               </div>\n\
                            </div>\n\
                            <div class="mt-2 rounded p-5 bg-light-primary text-dark-50 font-weight-bold font-size-lg text-right max-w-400px">\n\
                              '+data.result.message+'\n\
                            </div>\n\
                        </div>';
                        $('#getMessageAppend').append(html);  
                        
                        $(".blank-space").stop().animate({ scrollTop: $(".blank-space")[0].scrollHeight}, 1);                        
                    }
                 },
               });


         });




    




</script>

@endsection
