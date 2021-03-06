@extends('backend.layouts.app')
@section('style')
<style type="text/css">
  .active {
    background-color: #e5f8e6; 
  }
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
                       <input type="text" class="form-control py-4 h-auto" id="SearchGroup" placeholder="{{ __('chat.Search Group') }}" />
                    </div>
                    
                  <div class="mt-7 scroll scroll-pull sroll-sidebar-user" style=" margin-top: 5px !important;">
                    <span id="getChatUserChat">
                        @include('backend.groupchat._group')
                     </span>
                     @if(!empty($getUser['page']))
                          <div style="width: 100%;text-align: center;margin-top: 15px;">
                            <a href="javascript:;" style="display: block;margin: 0px 10px;" id="{{ $getUser['page'] }}" class="btn btn-success GroupLoadMore">{{ __('chat.Load More') }}</a>  
                          </div>
                      @endif
                  </div>


                  </div>
                  <!--end::Body-->
               </div>
               <!--end::Card-->
            </div>
            <!--end::Aside-->
            <!--begin::Content-->
            <div class="flex-row-fluid ml-lg-8"  id="kt_chat_content">
               <div class="card card-custom">
                  <div class="card-header align-items-center px-4 py-3">
                     <div class="text-left flex-grow-1">
                        <!--begin::Aside Mobile Toggle-->
                        <button style="box-shadow: none;" type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md d-lg-none" id="kt_app_chat_toggle">
                           <span class="svg-icon svg-icon-lg">
                              <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Adress-book2.svg-->
                              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                 <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M18,2 L20,2 C21.6568542,2 23,3.34314575 23,5 L23,19 C23,20.6568542 21.6568542,22 20,22 L18,22 L18,2 Z" fill="#000000" opacity="0.3"/>
                                    <path d="M5,2 L17,2 C18.6568542,2 20,3.34314575 20,5 L20,19 C20,20.6568542 18.6568542,22 17,22 L5,22 C4.44771525,22 4,21.5522847 4,21 L4,3 C4,2.44771525 4.44771525,2 5,2 Z M12,11 C13.1045695,11 14,10.1045695 14,9 C14,7.8954305 13.1045695,7 12,7 C10.8954305,7 10,7.8954305 10,9 C10,10.1045695 10.8954305,11 12,11 Z M7.00036205,16.4995035 C6.98863236,16.6619875 7.26484009,17 7.4041679,17 C11.463736,17 14.5228466,17 16.5815,17 C16.9988413,17 17.0053266,16.6221713 16.9988413,16.5 C16.8360465,13.4332455 14.6506758,12 11.9907452,12 C9.36772908,12 7.21569918,13.5165724 7.00036205,16.4995035 Z" fill="#000000"/>
                                 </g>
                              </svg>
                              <!--end::Svg Icon-->
                           </span>
                        </button>
                        <!--end::Aside Mobile Toggle-->
                        @if(Auth::user()->is_admin == 1)
                          <!--begin::Dropdown Menu-->
                          <div class="dropdown dropdown-inline">
                             <button style="box-shadow: none;" type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <i class="ki ki-bold-more-hor icon-md"></i>
                             </button>
                             <div class="dropdown-menu p-0 m-0 dropdown-menu-left dropdown-menu-md">
                                <!--begin::Navigation-->
                                <ul class="navi navi-hover py-5">
                                   <li class="navi-item">
                                      <a href="javascript:;" id="CreateNewGroup" class="navi-link">
                                      <span class="navi-icon"><i class="flaticon2-drop"></i></span>
                                      <span class="navi-text">{{ __('chat.Create New Group') }}</span>
                                      </a>
                                   </li>
                                </ul>
                                <!--end::Navigation-->
                             </div>
                          </div>
                          <!--end::Dropdown Menu-->
                        @endif

                     </div>


                     <div class="text-center text-center">
                        <div class="symbol-group symbol-hover justify-content-center" id="getMember">
                        </div>
                     </div>

                    @if(Auth::user()->is_admin == 1)

                     <div class="text-right flex-grow-1 AddNewMember" style="display: none;">
                        <!--begin::Dropdown Menu-->
                        <div class="dropdown dropdown-inline">
                           <button style="box-shadow: none;" type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="svg-icon svg-icon-lg">
                                 <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->
                                 <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                       <polygon points="0 0 24 0 24 24 0 24"/>
                                       <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                       <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                                    </g>
                                 </svg>
                                 <!--end::Svg Icon-->
                              </span>
                           </button>
                           <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-md" >
                              <!--begin::Navigation-->
                              <ul class="navi navi-hover py-5">
                                 <li class="navi-item">
                                    <a href="javascript:;" id="AddNewMemberGroup" class="navi-link">
                                    <span class="navi-icon"><i class="flaticon2-drop"></i></span>
                                    <span class="navi-text">{{ __('chat.Add New Member') }}</span>
                                    </a>
                                 </li>
                                 <li class="navi-item">
                                    <a href="javascript:;" id="LeaveMember" class="navi-link">
                                    <span class="navi-icon"><i class="flaticon2-drop"></i></span>
                                    <span class="navi-text">{{ __('chat.Leave Member') }}</span>
                                    </a>
                                 </li>
                              </ul>
                              <!--end::Navigation-->
                           </div>
                        </div>
                        <!--end::Dropdown Menu-->
                     </div>

                   @endif


                  </div>
                  <span id="getMessageChat">
                    @include('backend.groupchat._all_chat')
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



<div class="modal fade" id="MemberGroupModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>


<div class="modal fade" id="CreateNewGroupModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
       <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ __('chat.Create New Group') }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i aria-hidden="true" class="ki ki-close"></i>
          </button>
       </div>

      <form action="" enctype="multipart/form-data" id="CreateNewGroupForm" method="post">
         {{ csrf_field() }}
         <input type="hidden" required name="token" value="{{ Auth::user()->token }}">
         <div class="modal-body">

          <div class="row">
             <div class="col-md-12">
               <div class="form-group">
                   <label>{{ __('chat.Group Name') }} <span style="color: red" class="required">*</span></label>
                   <input type="text" class="form-control" id="CreateGroupName" placeholder="{{ __('chat.Group Name') }}" required name="group_name" >
                </div>

                <div class="form-group">
                   <label>{{ __('chat.Select Member') }} <span style="color: red" class="required">*</span></label>

                   @foreach($get_record_staff as $member)
                        <label class="checkbox" style="margin-bottom: 5px;">
                            <input class="CreateMemberID" value="{{ $member->id }}" type="checkbox" {{ ($member->id == Auth::user()->id) ? 'checked' : '' }} {{ ($member->id == Auth::user()->id) ? 'required' : '' }} name="member_id"><span style="margin-right: 10px;"></span> {{ $member->name }}
                        </label>                      
                   @endforeach

                    <span id="getSearchMemberHTML"></span>

                </div>


                <div class="form-group">
                   <label>{{ __('chat.Search ID/Name ') }}</label>
                   <input type="text" class="form-control" id="SearchMember" placeholder="{{ __('chat.Search Member') }}" >
                </div>
                <span id="getSearchMember"></span>

             </div>
          </div>

       </div>
       <div class="modal-footer">
          <button type="submit" class="btn btn-success font-weight-bold">{{ __('chat.Create') }}</button>
       </div>

     </form>

    </div>
  </div>
</div>





@endsection
@section('script')
<script src="{{ url('assets/js/pages/custom/chat/chat.js?v=7.0.6') }}"></script>
<script type="text/javascript">


 $('body').delegate('#chat-message','keydown',function(e) {
      var value = $(this).val();
      if (e.ctrlKey && e.keyCode == 13) {
          if(value != "")
          {
              $('#SubmitReply').submit();
          }
      }
 });



    


  // load more group

  
  $('body').delegate('.GroupLoadMore','click',function() {
       var page = $(this).attr('id');
       $.ajax({
            url: "{{ url('get_chat_group?page=') }}"+page,
            type: "POST",
            data:{
             "_token": "{{ csrf_token() }}"                   
            },
            dataType:"json",
            success:function(response){
                if(response.page > 0)
                {
                    $('.GroupLoadMore').attr('id',response.page);
                }
                else
                {
                    $('.GroupLoadMore').hide(); 
                }
                $('#getChatUserChat').append(response.success);
                $(".sroll-sidebar-user").stop().animate({ scrollTop: $(".sroll-sidebar-user")[0].scrollHeight}, 1);
            },
        });
  });



var xhr;


$('body').delegate('#CreateNewGroup','click',function() {
    $('#CreateNewGroupModel').modal('show');
});



$('body').delegate('#LeaveMember','click',function() {

      var group_id = $('#getGroupID').val();
      if(group_id != "")
      {
          if(xhr && xhr.readyState != 4){
              xhr.abort();
          }

          xhr = $.ajax({
               url: "{{ url('leave_member_group') }}",
               type: "POST",
               data:{
                "_token": "{{ csrf_token() }}",
                  group_id:group_id,
                },
               dataType:"json",
               success:function(response){
                   $('#MemberGroupModel').html(response.success);
                   $('#MemberGroupModel').modal('show');
               },
          });
      }
      

});



$('body').delegate('#AddNewMemberGroup','click',function() {
      var group_id = $('#getGroupID').val();
      if(group_id != "")
      {
          if(xhr && xhr.readyState != 4){
              xhr.abort();
          }

          xhr = $.ajax({
               url: "{{ url('add_new_member_group') }}",
               type: "POST",
               data:{
                "_token": "{{ csrf_token() }}",
                  group_id:group_id,
                },
               dataType:"json",
               success:function(response){
                   $('#MemberGroupModel').html(response.success);
                   $('#MemberGroupModel').modal('show');
               },
          });
      }
     
});



    


  $('body').delegate('#SearchGroup','keyup',function() {

      var group_name = $(this).val();

      if(xhr && xhr.readyState != 4){
          xhr.abort();
      }

      xhr = $.ajax({
         url: "{{ url('get_chat_group') }}",
         type: "POST",
         data:{
          "_token": "{{ csrf_token() }}",
            group_name:group_name,
          },
         dataType:"json",
         success:function(response){
             $('#getChatUserChat').html(response.success);
              KTAppChat.init();
         },
      });
  });



   $('body').delegate('.getnewchat','click',function(){
       var group_id = $(this).attr('id');
       $('.RemoveClassActive').removeClass('active');
       $(this).addClass('active');



       $.ajax({
           url: "{{ url('getgroupchatdata') }}",
           type: "POST",
           data:{
            "_token": "{{ csrf_token() }}",
              group_id:group_id,
            },
           dataType:"json",
           success:function(response){
                $('#clear_count_'+group_id).html('');
               $('#getMessageChat').html(response.success);
               $('#getMember').html(response.member);
              
               $('.AddNewMember').show();
   
               $('[data-toggle="tooltip"]').each(function() {
                       initTooltip($(this));
               });

               KTAppChat.init();
               $(".blank-space").stop().animate({ scrollTop: $(".blank-space")[0].scrollHeight}, 1);

   
           },
         });
   });


// add new member and leave member and create new group

    $('body').delegate('#SearchMemberAlready','keyup',function(e) {
          var search = $(this).val();
          var group_name = $(this).val();          
          if(xhr && xhr.readyState != 4){
              xhr.abort();
          }

          xhr = $.ajax({
             url: "{{ url('admin/get_seach_member_already') }}",
             type: "POST",
             data:{
              "_token": "{{ csrf_token() }}",
                search:search,
              },
             dataType:"json",
             success:function(response){
                 $('#getSearchAlreadyMember').html(response.success);
             },
          });    
   });


    $('#MemberGroupModel').delegate('.AssignAlreadyMemberGroup','click',function(){
          var user_id = $(this).attr('id');
          var name = $(this).attr('data-val');

          var html = '<label class="checkbox" style="margin-bottom: 5px;">\n\
              <input class="SelectMemberAdd" checked value="'+user_id+'" type="checkbox"><span style="margin-right: 10px;"></span> '+name+'\n\
          </label>'
          
          $('#getSearchMemberAlreadyHTML').append(html);          
   });



   $('body').delegate('#AddNewMemberForm','submit',function(e) {
          e.preventDefault();
          var group_name = $('#getAddGroupName').val();
          var group_id   = $('#getAddGroupID').val();


          var member_id = '';
          $('.SelectMemberAdd').each(function(){
              if(this.checked) {
                  var id = $(this).val();
                  member_id += id+',';
              }
          });
      
          member_id = member_id.replace(/,\s*$/, "");
          
          if(member_id != "")
          { 
             $.ajax({
                 url: app_base_url+"/api/app_add_group_member",
                 method: "POST",
                 data:{
                   "_token": "{{ csrf_token() }}",
                   "token": "{{ Auth::user()->token }}",
                   "user_id": "{{ Auth::user()->id }}",
                    member_ids:member_id,
                    group_name:group_name,
                    group_id:group_id,
                },
                 "headers": {
                     "Content-Type": "application/x-www-form-urlencoded"
                 },
                 dataType:"json",
                  success:function(data){
                     if(data.status) {
                        alert("{{ __('chat.Member successfully Add') }}");
                        $('#MemberGroupModel').modal('hide');
                        location.reload();
                     }
                  },
              });   
          }


         
    });
   





   // create group and search

   
   $('body').delegate('#SearchMember','keyup',function(e) {
          var search = $(this).val();
          var group_name = $(this).val();          
          if(xhr && xhr.readyState != 4){
              xhr.abort();
          }

          xhr = $.ajax({
             url: "{{ url('admin/get_seach_member') }}",
             type: "POST",
             data:{
              "_token": "{{ csrf_token() }}",
                search:search,
              },
             dataType:"json",
             success:function(response){
                 $('#getSearchMember').html(response.success);
             },
          });    
   });


   $('#CreateNewGroupModel').delegate('.AssignAddMemberGroup','click',function(){
          var user_id = $(this).attr('id');
          var name = $(this).attr('data-val');

          var html = '<label class="checkbox" style="margin-bottom: 5px;">\n\
              <input class="CreateMemberID" checked value="'+user_id+'" type="checkbox" name="member_id"><span style="margin-right: 10px;"></span> '+name+'\n\
          </label>'
          
          $('#getSearchMemberHTML').append(html);          
   });


   
   
   
    $('body').delegate('#CreateNewGroupForm','submit',function(e) {
          e.preventDefault();

          var member_id = '';
          $('.CreateMemberID').each(function(){
              if(this.checked)
              {
                  var id = $(this).val();
                  member_id += id+',';
              }
          });

          var group_name = $('#CreateGroupName').val();
          member_id = member_id.replace(/,\s*$/, "");
          
          $.ajax({
               url: app_base_url+"/api/app_create_group",
               method: "POST",
               data: {
                   "_token": "{{ csrf_token() }}",
                   "token": "{{ Auth::user()->token }}",
                    member_ids:member_id,
                    group_name:group_name,
                    "user_id": "{{ Auth::user()->id }}",
              },
              "headers": {
                   "Content-Type": "application/x-www-form-urlencoded"
              },
              dataType:"json",
              success:function(data) {
                 if(data.status) {
                    alert("{{ __('chat.Group successfully created') }}");
                    $('#CreateNewGroupModel').modal('hide');
                     location.reload();
                 }
              },
          });   

    });



   
    $('body').delegate('#LeavMemberForm','submit',function(e) {
          e.preventDefault();
          var member_id     = $('#LeavMemberMemberID').val();
          var group_id   = $('#LeaveGroupID').val();
          $.ajax({
               url: app_base_url+"/api/app_group_member_leave",
               method: "POST",
               data: {
                   "_token": "{{ csrf_token() }}",
                   "token": "{{ Auth::user()->token }}",
                    member_id:member_id,
                    group_id:group_id,
                    "user_id": "{{ Auth::user()->id }}",
              },
              "headers": {
                   "Content-Type": "application/x-www-form-urlencoded"
              },
              dataType:"json",
              success:function(data) {
                 if(data.status) {
                    alert("{{ __('chat.Member successfully removed') }}");
                    $('#MemberGroupModel').modal('hide');
                     location.reload();
                 }
              },
          });   

    });

    


// end add new member and leave member and create new group
   
   
    $('body').delegate('#SubmitReply','submit',function(e) {
         e.preventDefault();
          $("#DisEnaSendMessage").attr("disabled", true); 

         $.ajax({
           url: app_base_url+"/api/app_group_message_send",
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
                             <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">{{ __('chat.You') }}</a>\n\
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
   
   
   
   var initTooltip = function(el) {
       var theme = el.data('theme') ? 'tooltip-' + el.data('theme') : '';
       var width = el.data('width') == 'auto' ? 'tooltop-auto-width' : '';
       var trigger = el.data('trigger') ? el.data('trigger') : 'hover';
       
       $(el).tooltip({
             trigger: trigger,
             template: '<div class="tooltip ' + theme + ' ' + width + '" role="tooltip">\
                 <div class="arrow"></div>\
                 <div class="tooltip-inner"></div>\
             </div>'
         });
   }
   

  socket.on('app_group_member_leave', function(data) {

    var user_id = "{{ Auth::user()->id }}";
    var app_user_id = data.result.user_id;
    
    if(parseInt(app_user_id) == parseInt(user_id)) {

      location.reload();
    }
    
  });
   
   
</script>
@endsection