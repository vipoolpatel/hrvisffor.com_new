@extends('backend.layouts.app')
@section('style')
<style type="text/css">
   button {
   box-shadow: none;
   }
</style>
@endsection
@section('content')
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
   <!--begin::Subheader-->
   <div class="subheader py-2 py-lg-12  subheader-transparent" id="kt_subheader">
      <div class=" container  d-flex  justify-content-between flex-wrap ">
         <h2 class="text-white font-weight-bold my-2 mr-5">{{ __('task.Task Detail') }}
         </h2>
      </div>
   </div>
   <div class="d-flex flex-column-fluid">
      <div class=" container ">
         @include('layouts._message')
         <div class="row">
            <div class="col-xl-12 pt-10 pt-xl-0">
               <div class="card card-custom card-stretch" id="kt_todo_view">
                  <div class="card-header align-items-center flex-wrap justify-content-between border-0 py-6 h-auto">
                     <div class="d-flex align-items-center my-2">
                        <div class="d-flex align-items-center">
                           <div class="symbol symbol-35 mr-3">
                              <div class="symbol-label" style="background-image: url('{{ $value->user->getImage() }}')"></div>
                           </div>
                           <a href="javascript:;" class="text-dark-75 font-size-lg text-hover-primary font-weight-bolder">
                           {{ $value->user->name }}
                           </a>
                        </div>
                     </div>
                       <div class="d-flex align-items-center justify-content-end text-right my-2">
                        <span class="btn btn-light-warning btn-sm font-weight-bolder mr-2" >
                        {{ __('task.Due Date') }} :  {{ date('d M, Y',strtotime($value->end_date)) }}
                        </span>

                        @if(Auth::user()->is_admin == 1)

                           @if($value->status != 3)
                              <select class="form-control ChangeStatus mr-2" id="{{ $value->id }}" style="width: 110px;" >
                                 @foreach($get_status as $value_status)
                                    <option {{ ($value->status == $value_status->id) ? 'selected' : '' }} value="{{ $value_status->id }}">{{ $value_status->getName() }}</option>
                                 @endforeach
                              </select>
                           @else
                              <span class="btn btn-light-success btn-sm text-uppercase font-weight-bolder mr-2">
                                 {{ __('task.Complete') }}
                              </span>
                           @endif
                        @else

                           <span class="btn {{ $value->get_status->class }} btn-sm text-uppercase font-weight-bolder mr-2">
                                 {{ $value->get_status->getName() }}
                           </span>
                           
                        @endif

                     </div>

                  </div>
                  <div class="card-body p-0">
                     <div class="d-flex align-items-center justify-content-between flex-wrap card-spacer-x py-3">
                        <div class="d-flex flex-column mr-2 py-2">
                           <a href="javascript:;" class="text-dark text-hover-primary font-weight-bold font-size-h4 mr-3">{{ $value->title }}</a>
                           <div class="d-flex align-items-center py-1">
                              <a href="javascript:;" class="d-flex align-items-center text-muted text-hover-primary mr-2">
                              <span class="fa fa-genderless text-danger icon-md mr-2"></span> {{ $value->get_status->getName() }}
                              </a>

                              <a href="javascript:;" class="d-flex align-items-center text-muted text-hover-primary mr-2">
                              <span class="fa fa-genderless text-warning icon-md mr-2"></span>{{ __('task.Created Date') }} <span style="margin-left: 5px;" class="text-warning"> {{ date('d M, Y',strtotime($value->created_at)) }}</span>
                              </a>
                              @if(!empty($value->is_urgent))
                              <a href="javascript:;" class="d-flex align-items-center text-muted text-hover-primary">
                              <span class="fa fa-genderless text-success icon-md mr-2"></span> {{ __('task.Urgent') }}
                              </a>
                              @endif
                           </div>
                        </div>
                        <div class="pt-2">
                           <div class="mb-1">
                              {!! $value->description !!}
                           </div>
                        </div>
                     </div>

                     @foreach($value->reply() as $reply)
                     <div class="mb-3">
                        <div class="shadow-xs" >
                           <div class="d-flex align-items-start card-spacer-x py-4">
                              <span class="symbol symbol-35 mr-3 mt-1">
                              <span class="symbol-label" style="background-image: url('{{ $reply->sender->getImage() }}')"></span>
                              </span>
                              <div class="d-flex flex-column flex-grow-1 flex-wrap mr-2">
                                 <div class="d-flex">
                                    <a href="javascript:;" class="font-size-lg font-weight-bolder text-dark-75 text-hover-primary mr-2">{{ $reply->sender->name }}</a>
                                    <div class="font-weight-bold text-muted">
                                       @if(!empty($reply->sender->OnlineUser()))
                                       <span class="label label-success label-dot mr-2"></span>
                                       @endif
                                        {{ Carbon\Carbon::parse($reply->created_at)->diffForHumans() }}
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="card-spacer-x pt-2 pb-5">
                              <div class="mb-1">
                                 {!! $reply->description !!}
                              </div>
                           </div>
                        </div>
                     </div>
                     @endforeach
                        
                     @if($value->status == 3)

                           <div class="card-spacer-x pb-10 pt-5">
                           
                              <div class="card-body p-0 text-center" >
                                 @if(Auth::user()->is_admin == 1)
                                    {{ __('task.This task is complete.') }} <a href="{{ url('admin/privatechat/'.$value->user->username) }}">{{ __('task.Click here') }}</a> {{ __('task.to contact the Staff.') }}
                                 @else
                                    {{ __('task.This task is complete.') }} <a href="{{ url('admin/privatechat/'.$value->created_user->username) }}">{{ __('task.Click here') }}</a> {{ __('task.to contact the Admin.') }}
                                 @endif
                                 
                              </div>
                           
                        </div>


                           
                     @else
                        <div class="card-spacer-x pb-10 pt-5">
                           <div class="card card-custom shadow-sm">
                              <div class="card-body p-0">
                                 <form method="post" action="">
                                     {{ csrf_field() }}
                                    <div class="d-block" style="padding: 20px;">
                                        <textarea class="form-control" name="description" id="kt-ckeditor-1"></textarea>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between py-5 pl-8 pr-5">
                                          <button style="box-shadow: none;" class="btn btn-primary font-weight-bold px-6">{{ __('task.Reply') }}</button>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                     @endif
                     


                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('script')
<!--begin::Page Vendors(used by this page)-->
<script src="{{ url('assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js?v=7.0.6') }}"></script>
<!--end::Page Vendors-->

<!--begin::Page Scripts(used by this page)-->
<script src="{{ url('assets/js/pages/crud/forms/editors/ckeditor-classic.js?v=7.0.6') }}"></script>
<!--end::Page Scripts-->



<script type="text/javascript">
   
$('body').delegate('.ChangeStatus','change',function(){

   var id = $(this).attr('id');
   var status = $(this).val();
   $.ajax({
      url: "{{ url('admin/staff/task/change_status') }}",
      type: "POST",
      data:{
        "_token": "{{ csrf_token() }}",
          id:id,
          status:status,
       },
       dataType:"json",
       success:function(response){
           alert(response.success);
       },
   });
});



</script>
@endsection
