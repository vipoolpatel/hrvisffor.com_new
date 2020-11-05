@extends('backend.layouts.app')
@section('style')
<style type="text/css">

</style>
@endsection
@section('content')
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
   <!--begin::Subheader-->
   <div class="subheader py-2 py-lg-12  subheader-transparent " id="kt_subheader">
      <div class=" container  d-flex  justify-content-between flex-wrap ">
         <h2 class="text-white font-weight-bold my-2 mr-5" style="margin-bottom: 20px !important;">{{ __('task.Task') }} 
            @if(!empty($user_id))
               ({{ $user->name }})
            @endif
         </h2>
         @if(!empty($user_id))
         <a href="{{ url('admin/staff/task/add/'.$user->id) }}" class="btn btn-transparent-white font-weight-bold  py-3 px-6 mr-2" style="margin-bottom: 15px;">
         <i class="flaticon2-plus-1"></i> {{ __('task.Add') }} 
         </a>
         @endif
      </div>
   </div>
   <div class="d-flex flex-column-fluid">
      <div class=" container ">
         @include('layouts._message')
         <div class="row">

           @foreach($get_task as $value)

            @php
                  if(Auth::user()->is_admin == 2)
                  {
                     $connect_user_id = $value->created_by;
                  }
                  else
                  {
                     $connect_user_id =   $value->user_id;
                  }

                  $countMessage = App\Models\TaskReplyModel::count_message_task($connect_user_id, Auth::user()->id, $value->id);

            @endphp

            <div class="col-xl-6 pt-10 pt-xl-0" style="margin-bottom: 10px;">
               <!--begin::Card-->
               <div class="card card-custom card-stretch" id="kt_todo_view">
                  <!--begin::Header-->
                  <div class="card-header align-items-center flex-wrap justify-content-between border-0 py-6 h-auto">
                     <!--begin::Left-->
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
                     <!--end::Left-->
                     <!--begin::Right-->
                     <div class="d-flex align-items-center justify-content-end text-right my-2">

                        @if(!empty($countMessage))
                        <span class="btn btn-light-success btn-sm text-uppercase font-weight-bolder mr-2" >
                           {{ $countMessage }}
                        </span>
                        @endif

                        <span class="btn btn-light-warning btn-sm text-uppercase font-weight-bolder mr-2" >
                        {{ __('task.Due Date') }} {{ date('d M, Y',strtotime($value->end_date)) }}
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
                        
                        <a href="{{ url('admin/staff/task/detail/'.$value->id) }}" class="btn btn-warning btn-sm text-uppercase font-weight-bolder mr-2">
                        {{ __('task.Detail') }}
                        </a>

                        @if(Auth::user()->is_admin == 1)
                        <a onclick="return confirm('{{ __('task.Are you sure you want to delete?') }}')" href="{{ url('admin/staff/task/delete/'.$value->id) }}" class="btn btn-danger btn-sm">
                        <i class="flaticon2-trash"></i>
                        </a>
                        @endif

                     </div>

                  </div>
                 
                  <div class="card-body p-0">
                     <div class="d-flex align-items-center justify-content-between flex-wrap card-spacer-x py-3">
                        <div class="d-flex flex-column mr-2 py-2">
                           <a href="{{ url('admin/staff/task/detail/'.$value->id) }}" class="text-dark text-hover-primary font-weight-bold font-size-h4 mr-3">{{ $value->title }}</a>

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
                     </div>
                     <div class="mb-3">
                        
                           <div class="card-spacer-x pt-2 pb-5 ">
                              <div class="mb-1">
                                 {!! $value->description !!}
                                 </p>
                              </div>
                           </div>
                        
                     </div>
                  </div>
               </div>
            </div>
            @endforeach
         </div>
         <div class="row col-md-12">
            <div class="d-flex justify-content-between align-items-center flex-wrap" style="margin: auto;">
               <div class="d-flex flex-wrap mr-3">
                     {!! $get_task->links() !!}      
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('script')

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
