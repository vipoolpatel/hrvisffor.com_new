@extends('backend.layouts.app')
@section('content')
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
   <div class="subheader py-2 py-lg-12  subheader-transparent " id="kt_subheader">
      <div class=" container  d-flex  justify-content-between flex-wrap ">
         <h2 class="text-white font-weight-bold my-2 mr-5" style="margin-bottom: 20px !important;">{{ __('profile.Staff') }} </h2>
         <a href="{{ url('admin/staff/add') }}" class="btn btn-transparent-white font-weight-bold  py-3 px-6 mr-2" style="margin-bottom: 15px;">
         <i class="flaticon2-plus-1"></i> {{ __('profile.Add') }}  
         </a>
      </div>
   </div>
   <!--end::Subheader-->
   <!--begin::Entry-->
   <div class="d-flex flex-column-fluid">
      <!--begin::Container-->
      <div class=" container ">
         @include('layouts._message')
         <div class="row">
            @foreach($get_record as $value)
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
               <!--begin::Card-->
               <div class="card card-custom gutter-b card-stretch">
                  <!--begin::Body-->
                  <div class="card-body pt-4">
                     <div class="d-flex align-items-end mb-7">
                        <div class="d-flex align-items-center">
                           <div class="flex-shrink-0 mr-4 mt-lg-0 mt-3">
                              <div class="symbol symbol-circle symbol-lg-75">
                                 <img src="{{ $value->getImage() }}" alt="{{ $value->name }}">
                              </div>
                              <div class="symbol symbol-lg-75 symbol-circle symbol-primary ">
                                 <span class="font-size-h3 font-weight-boldest">
                                 @if($value->OnlineUser())
                                 <i class="flaticon2-correct text-success icon-md ml-2"></i>
                                 @endif
                                 </span>
                              </div>
                           </div>
                           <div class="d-flex flex-column">
                              <a href="javascript:;" class="text-dark font-weight-bold text-hover-primary font-size-h6 mb-0">{{ $value->name }} {{ $value->last_name }}</a>
                           </div>
                        </div>
                     </div>
                     <div class="mb-7">
                        <div class="d-flex justify-content-between align-items-center">
                           <span class="text-dark-75 font-weight-bolder mr-2">{{ __('profile.Email') }}:</span>
                           <a href="javascript:;" class="text-muted text-hover-primary">{{ $value->email }}</a>
                        </div>
                        <div class="d-flex justify-content-between align-items-cente my-1">
                           <span class="text-dark-75 font-weight-bolder mr-2">{{ __('profile.Username') }}:</span>
                           <a href="javascript:;" class="text-muted text-hover-primary">{{ $value->username }}</a>
                        </div>
                        <div class="d-flex justify-content-between align-items-cente my-1">
                           <span class="text-dark-75 font-weight-bolder mr-2">{{ __('profile.Role') }}:</span>
                           <a href="javascript:;" class="text-muted text-hover-primary">{{ ($value->is_admin == 1) ? 'Super Admin' : 'Admin' }}</a>
                        </div>
                        @php
                        $ChatCount        = App\Models\ChatModel::countdashabordmessage($value->id);
                        $PrivateChatCount = App\Models\PrivateChatModel::countdashabordmessage($value->id);
                        @endphp
                        @if(!empty($ChatCount))
                        <div class="d-flex justify-content-between align-items-cente my-1">
                           <span class="text-dark-75 font-weight-bolder mr-2">{{ __('profile.Chat') }}:</span>
                           <a href="javascript:;" class="text-white label label-sm label-warning">{{ $ChatCount }}</a>
                        </div>
                        @endif
                        @if(!empty($PrivateChatCount))
                        <div class="d-flex justify-content-between align-items-cente my-1">
                           <span class="text-dark-75 font-weight-bolder mr-2">{{ __('profile.Private Chat') }}:</span>
                           <a href="javascript:;" class="text-white label label-sm label-warning">{{ $PrivateChatCount }}</a>
                        </div>
                        @endif
                     </div>
                     @if(Auth::user()->id != $value->id)
                     <a href="{{ url('admin/privatechat/'.$value->username.'?history=true') }}" class="btn btn-light-success btn-sm">{{ __('profile.Private Chat History') }}</a>
                     <a href="{{ url('admin/chat/'.$value->username.'?history=true') }}" class="btn btn-light-success btn-sm">{{ __('profile.Chat History') }}</a>
                     <hr>
                     <a href="{{ url('admin/privatechat/'.$value->username) }}" class="btn  btn-sm btn-light-warning"><i class="flaticon-speech-bubble"></i></a>
                     @endif
                     <a href="javascript:;" id="{{ $value->id }}" class="btn btn-light-danger btn-sm getPermission">{{ __('profile.Permission') }}</a>
                     <a href="{{ url('admin/staff/edit/'.$value->id) }}" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                     <i class="flaticon-edit-1"></i>
                     </a>

                     <a onclick="return confirm('{{__("profile.Are you sure you want to delete?")}}')" href="{{ url('admin/staff/delete/'.$value->id) }}" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                     <i class="flaticon2-trash"></i>
                     </a>

                     @if(Auth::user()->id != $value->id)
                     <hr>
                     <a style="margin-top: 10px;box-shadow: none;" href="{{ url('admin/staff/task/'.$value->id) }}" class="btn btn-light-warning btn-sm">{{ __('profile.Task') }}</a>
                     @endif
                  </div>
                  <!--end::Body-->
               </div>
               <!--end::Card-->
            </div>
            @endforeach
         </div>

          <div class="row col-md-12">
            <div class="d-flex justify-content-between align-items-center flex-wrap" style="margin: auto;">
               <div class="d-flex flex-wrap mr-3">
                     {!! $get_record->links() !!}      
               </div>
            </div>
         </div>

         
      </div>
   </div>
</div>
<div class="modal fade" id="PermissionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>
@endsection
@section('script')
<script type="text/javascript">   
   $('#PermissionModal').delegate('#SubmitPermission','submit',function(e){
           e.preventDefault();
   
           $.ajax({
               url: "{{ url('admin/save_permission') }}",
               type: "POST",
               data: $(this).serialize(),
               dataType:"json",
               success:function(response){
                    alert('Sucessfully save permission');
               },
           });
   
     });   
   
   
     $('body').delegate('.getPermission','click',function(){
           var user_id = $(this).attr('id');
           alert(user_id);
           $.ajax({
               url: "{{ url('admin/user_permission') }}",
               type: "POST",
               data:{
                   "_token": "{{ csrf_token() }}",
                   user_id:user_id,
               },
               dataType:"json",
               success:function(response){
                    $('#PermissionModal').html(response.success);
                    $('#PermissionModal').modal('show');
               },
           });
   
     });   
   
   
</script>
@endsection
