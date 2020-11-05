@extends('backend.layouts.app')
@section('style')
<style type="text/css">
   .interview-table tr td {
   padding-right: 10px;
   padding-top: 10px;
   padding-bottom: 10px;
   }
   .interview-table tr th {
   padding-right: 10px;
   }
   .required {
    color: red;
   }
</style>
@endsection
@section('content')
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
   <!--begin::Subheader-->
   <div class="subheader py-2 py-lg-12  subheader-transparent " id="kt_subheader">
      <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
         <!--begin::Info-->
         <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Heading-->
            <div class="d-flex flex-column">
               <!--begin::Title-->
               <h2 class="text-white font-weight-bold my-2 mr-5">
                    {{ __('travel.Travel Arrangements List') }}
                  
               </h2>
            </div>
            <!--end::Heading-->
         </div>
         <!--end::Info-->
      </div>
   </div>
   <div class="d-flex flex-column-fluid">
      <div class=" container ">
         @include('layouts._message')
         <div class="row">

@forelse($get_travel as $value)

   <div class="col-md-6">
      <div class="card card-custom gutter-b card-stretch">
         <div class="card-body">
            <div class="d-flex align-items-center">
               <div style="width: 100%">

                    <div class="d-flex align-items-center">
                      <div class="d-flex flex-column mr-auto">
                         <a href="javascript:;" class="card-title text-hover-primary font-weight-bolder font-size-h5 text-dark mb-1"> {{ $value->school->school_name }} ({{  $value->school->school_id }})</a>
                      </div>
                   </div>
                   <hr />


                  <div class="d-flex align-items-center">
                     <div class="d-flex flex-column mr-auto">
                        <a href="{{ url('teacher-profile/'.$value->teacher->username) }}" class="card-title text-hover-primary font-weight-bolder font-size-h5 text-dark mb-1">{{ $value->teacher->name }} ({{ $value->teacher->teacher_id }})</a>
                        @if(!empty($value->teacher->nationality))
                        <span class="text-muted font-weight-bold">
                        {{ __('travel.Nationality') }}: {{ $value->teacher->nationality->getName() }}
                        </span>
                        @endif
                     </div>
                  </div>
                  <hr>

                  @if(!empty($value->get_flight_ticket()))
                     <div class="row form-group" style="margin-top: 10px;">
                        <div class="col-md-5 text-primary font-weight-bold">{{ __('travel.Flight Ticket') }}</div>
                        <div class="col-md-7">
                           <a target="_blank" href="{{ $value->get_flight_ticket() }}" class="btn btn-sm btn-success">{{ __('travel.Download') }}</a>
                        </div>
                     </div>
                  @endif

                  @if(!empty($value->picked_up_by))
                     <div class="row form-group">
                        <div class="col-md-5 text-primary font-weight-bold">{{ __('travel.You will be picked up by') }}</div>
                        <div class="col-md-7">{{ $value->picked_up_by }}</div>
                     </div>
                  @endif

                  <div class="row form-group">
                     <div class="col-md-5 text-primary font-weight-bold">{{ __('travel.Profile') }}</div>
                     <div class="col-md-7">
                        <img src="{{ $value->getimage() }}" style="width: 100px; height: 100px;">
                     </div>
                  </div>

                  @if(!empty($value->email))
                     <div class="row form-group">
                        <div class="col-md-5 text-primary font-weight-bold">{{ __('travel.Email') }}</div>
                        <div class="col-md-7">{{$value->email }}</div>
                     </div>
                  @endif

                  @if(!empty($value->phone_number))
                     <div class="row form-group">
                        <div class="col-md-5 text-primary font-weight-bold">{{ __('travel.Phone Number') }}</div>
                        <div class="col-md-7">{{ !empty($value->country) ? $value->country->getName() : '' }} - {{ $value->phone_number }}</div>
                     </div>
                  @endif 

                  @if(!empty($value->skype))
                     <div class="row form-group">
                        <div class="col-md-5 text-primary font-weight-bold">{{ __('travel.Skype') }}</div>
                        <div class="col-md-7">{{$value->skype }}</div>
                     </div>
                  @endif

                  @if(!empty($value->wechat))
                     <div class="row form-group">
                        <div class="col-md-5 text-primary font-weight-bold">{{ __('travel.Wechat') }}</div>
                        <div class="col-md-7">{{$value->wechat }}</div>
                     </div>
                  @endif

                  @if(!empty($value->metting_point))
                     <div class="row form-group">
                        <div class="col-md-5 text-primary font-weight-bold">{{ __('travel.Metting Point') }}</div>
                        <div class="col-md-7">{{$value->metting_point }}</div>
                     </div>
                  @endif

                  @if(!empty($value->picked_school))
                     <div class="row form-group">
                        <div class="col-md-5 text-primary font-weight-bold">{{ __('travel.I have picked by the school') }}</div>
                        <div class="col-md-7">{{ $value->picked_school }}</div>
                     </div>
                  @endif

                  @if(!empty($value->note))
                     <div class="row form-group">
                        <div class="col-md-5 text-primary font-weight-bold">{{ __('travel.Note') }}</div>
                        <div class="col-md-7">{{ $value->note }}</div>
                     </div>
                  @endif

                  @if(!empty($value->school_reason) && $value->school_status == 3)
                     <div class="row form-group">
                        <div class="col-md-5 text-danger font-weight-bold">{{ __('travel.School Reject') }}</div>
                        <div class="col-md-7">{{ $value->school_reason }}</div>
                     </div>
                  @endif

                  @if(!empty($value->teacher_reason) && $value->teacher_status == 3)
                     <div class="row form-group">
                        <div class="col-md-5 text-danger font-weight-bold">{{ __('travel.Teacher Reject') }}</div>
                        <div class="col-md-7">{{ $value->teacher_reason }}</div>
                     </div>
                  @endif



               </div>
            </div>
            
            <div class="d-flex flex-wrap">
               <div class="mr-12 d-flex flex-column mb-7">
                  <span class="font-weight-bolder mb-4">{{ __('travel.School Status') }}</span>
                   <select class="form-control ChangeTravelStatus" data-val="school_status" id="{{ $value->id }}">
                      @foreach($get_status as $status)
                        <option {{ ($value->school_status == $status->id) ? 'selected' : '' }} value="{{ $status->id }}">{{ $status->name }}</option>
                      @endforeach
                   </select>
               </div>

               @if(!empty($value->teacher_status))
                 <div class="mr-12 d-flex flex-column mb-7">
                    <span class="font-weight-bolder mb-4">{{ __('travel.Teacher Status') }}</span>
                     <select class="form-control ChangeTravelStatus" data-val="teacher_status" id="{{ $value->id }}">
                        @foreach($get_status as $status)
                          <option {{ ($value->teacher_status == $status->id) ? 'selected' : '' }} value="{{ $status->id }}">{{ $status->name }}</option>
                        @endforeach
                     </select>
                 </div>
               @endif

               <div class="d-flex flex-column flex-lg-fill float-left mb-7">
                  <span class="font-weight-bolder mb-4">{{ __('travel.Action') }}</span>
                  <div class="symbol-group symbol-hover">
                     <a style="margin-right: 10px" href="javascript:;" id="{{ $value->id }}" class="EditTravel btn btn-icon btn-light btn-hover-danger btn-sm"> <i class="flaticon-edit-1 text-primary"></i>
                     </a>

                     <a onclick="return confirm('{{ __('travel.Are you sure you want to delete?') }}')" href="{{ url('common/travel/delete/'.$value->id) }}" class="btn btn-icon btn-light btn-hover-danger btn-sm">
                     <i class="flaticon2-trash text-danger"></i>
                     </a>
                  </div>
               </div>


            </div>

         </div>
      </div>
   </div>


@empty

@endforelse


         </div>

           <div class="row col-md-12">
              <div class="d-flex justify-content-between align-items-center flex-wrap" style="margin: auto;">
                 <div class="d-flex flex-wrap mr-3">
                    {!! $get_travel->links() !!}
                 </div>
              </div>
            </div>

      </div>
   </div>
</div>






<div class="modal fade TravelModal" id="TravelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>





<div class="modal fade" id="ReasonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ __('travel.Reason') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
            </button>
         </div>

        <form action="{{ url('admin/user/travel/reject') }}" enctype="multipart/form-data" method="post">
           {{ csrf_field() }}
           <input type="hidden" name="id" id="get_travel_id">
           <input type="hidden" name="type" id="get_type_id">
           <div class="modal-body">
              <div class="row">
                 <div class="col-md-12">
                    <div class="form-group">
                       <label>{{ __('travel.Reason') }} <span class="required">*</span></label>
                       <textarea name="reason" required class="form-control form-control-lg form-control-solid"></textarea>
                    </div>
                 </div>
              </div>

         </div>
         <div class="modal-footer">
            <button type="submit" class="btn btn-success font-weight-bold">{{ __('travel.Reject') }}</button>
         </div>

       </form>

      </div>
   </div>
</div>





@endsection
@section('script')

<script type="text/javascript">

  
$('body').delegate('.EditTravel','click',function(){

   var id = $(this).attr('id');
 
   $.ajax({
      url: "{{ url('admin/travel/edit') }}",
      type: "POST",
      data:{
        "_token": "{{ csrf_token() }}",
          id:id,
       },
       dataType:"json",
       success:function(response){
          $('.TravelModal').html(response.success);
          $('#TravelModal').modal('show');
       },
   });
});


  
$('body').delegate('.ChangeTravelStatus','change',function(){

   var id = $(this).attr('id');
   var status = $(this).val();
   var type = $(this).attr('data-val');

   if(status == 3)
   {
      $('#get_travel_id').val(id);    
      $('#get_type_id').val(type);    
      $('#ReasonModal').modal('show');  
   }
   else
   {
       $.ajax({
          url: "{{ url('admin/travel/change_status') }}",
          type: "POST",
          data:{
            "_token": "{{ csrf_token() }}",
              id:id,
              status:status,
              type:type,
           },
           dataType:"json",
           success:function(response){
               alert(response.success);
           },
       });
   }
    
});



</script>

@endsection