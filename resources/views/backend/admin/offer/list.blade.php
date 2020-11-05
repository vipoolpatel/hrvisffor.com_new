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
                  {{__("offer.Offer List")}}
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

@forelse($getOffer as $value)

  <div class="col-md-6">
     <div class="card card-custom gutter-b card-stretch">
        <div class="card-body">
           <div class="d-flex align-items-center">
              <div style="width: 100%">

                   <div class="d-flex align-items-center">
                      <div class="d-flex flex-column mr-auto">
                         <a href="{{ url('school-profile/'.$value->job_apply->job->slug) }}" class="card-title text-hover-primary font-weight-bolder font-size-h5 text-dark mb-1"> {{ $value->school->school_id }} ({{ $value->job_apply->job->get_school_type->getName() }})</a>
                         <span class="text-muted font-weight-bold">
                         {{__("offer.Location")}}: @if(!empty($value->job_apply->job->get_location())) {{ $value->job_apply->job->get_location() }} @endif 
                         </span>
                      </div>
                   </div>

                   <hr />
                   <div class="d-flex align-items-center">
                      <div class="d-flex flex-column mr-auto">
                         <a href="{{ url('teacher-profile/'.$value->job_apply->user->username) }}" class="card-title text-hover-primary font-weight-bolder font-size-h5 text-dark mb-1"> {{ $value->job_apply->user->teacher_id }} ({{ $value->job_apply->user->name }})</a>
                         <span class="text-muted font-weight-bold">
                         {{__("offer.Nationality")}}: {{ !empty($value->job_apply->user->nationality) ? $value->job_apply->user->nationality->getName() : '' }}
                         </span>
                      </div>
                   </div>

                   <hr />


                 <div class="row form-group" style="margin-top: 10px;">
                    <div class="col-md-5 text-primary font-weight-bold">{{__("offer.Salary")}}</div>
                    <div class="col-md-7">¥ {{ $value->salary }} {{__("offer.Monthly")}} ({{ $value->tax->getName() }})</div>
                 </div>
                   @if(!empty($value->flights))
                 <div class="row form-group">
                    <div class="col-md-5 text-primary font-weight-bold">{{__("offer.Flights")}}</div>
                    <div class="col-md-7"> {{ $value->flights }}</div>
                 </div>
                 @endif
                 @if(!empty($value->holiday))
                 <div class="row form-group">
                    <div class="col-md-5 text-primary font-weight-bold">{{__("offer.Holidays")}}</div>
                    <div class="col-md-7">{{ $value->holiday }}</div>
                 </div>
                  @endif

                  @if(!empty($value->contract_length))
                  <div class="row form-group">
                    <div class="col-md-5 text-primary font-weight-bold">{{__("offer.Contract Length")}}</div>
                    <div class="col-md-7">{{ $value->contract_length }}</div>
                 </div>
                 @endif

                 @if(!empty($value->insurance))
                 <div class="row form-group">
                    <div class="col-md-5 text-primary font-weight-bold">{{__("offer.Insurance")}}</div>
                    <div class="col-md-7">{{ $value->insurance }}</div>
                 </div>
                 @endif


                 @if(!empty($value->start_date))
                  <div class="row form-group">
                    <div class="col-md-5 text-primary font-weight-bold">{{__("offer.Start Date")}}</div>
                    <div class="col-md-7"><span class="btn btn-light-primary btn-sm font-weight-bold btn-upper btn-text">{{ $value->start_date }}</span></div>
                 </div>
                 @endif

                 @if(!empty($value->apartment))
                 <div class="row form-group">
                    <div class="col-md-5 text-primary font-weight-bold">{{__("offer.Apartment")}}</div>
                    <div class="col-md-7">{{ $value->apartment }}</div>
                 </div>
                @endif 

                @if(!empty($value->bonus))
                  <div class="row form-group">
                    <div class="col-md-5 text-primary font-weight-bold">{{__("offer.Bonus")}}</div>
                    <div class="col-md-7">{{ $value->bonus }}</div>
                 </div>
               @endif 

               @if(!empty($value->expired_date))
                  <div class="row form-group">
                    <div class="col-md-5 text-primary font-weight-bold">{{__("offer.Offer Expired Date")}}</div>
                    <div class="col-md-7"><span class="btn btn-light-danger btn-sm font-weight-bold btn-upper btn-text">{{ $value->expired_date }}</span></div>
                 </div>
               @endif



              </div>
           </div>
           <p class="mb-7 mt-3">
              {{ $value->note }}
           </p>
           <div class="d-flex flex-wrap">
              <div class="mr-12 d-flex flex-column mb-7">
                 <span class="font-weight-bolder mb-4">{{__("offer.Status")}}</span>
                  <select class="form-control ChangeOfferStatus" id="{{ $value->id }}">
                      @foreach($get_status as $status)
                        <option {{ ($value->status == $status->id) ? 'selected' : '' }} value="{{ $status->id }}">{{ $status->name }}</option>
                      @endforeach
                   </select>
              </div>

               @if($value->is_confirm != 0)
                <div class="mr-12 d-flex flex-column mb-7">
                   <span class="font-weight-bolder mb-4">{{__("offer.Teacher Status")}}</span>
                   <span class="btn {{ $value->confirm->class }} font-weight-bold btn-upper btn-text">{{ $value->confirm->teacher_status }}</span>
                </div>
      
               @endif

              <div class="d-flex flex-column flex-lg-fill float-left mb-7">
                 <span class="font-weight-bolder mb-4">{{__("offer.Action")}}</span>
                 <div class="symbol-group symbol-hover">
                     <a class="btn btn-icon btn-light btn-hover-primary btn-sm EditOffer" style="margin-right: 10px;" id="{{ $value->id }}" > <i class="flaticon-edit-1"></i> </a>

                     <a onclick="return confirm('{{__("offer.Are you sure you want to delete?")}}')" href="{{ url('common/offer/delete/'.$value->id) }}" class="btn btn-icon btn-light btn-hover-danger btn-sm"> <i class="flaticon2-trash text-danger"></i> </a>
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
                    {!! $getOffer->links() !!}
                 </div>
              </div>
            </div>



      </div>
   </div>
</div>



<div class="modal fade SendOfferModal" id="SendOfferModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>

@endsection
@section('script')

<script type="text/javascript">

  
$('body').delegate('.EditOffer','click',function(){

   var id = $(this).attr('id');
 
   $.ajax({
      url: "{{ url('admin/offer/edit') }}",
      type: "POST",
      data:{
        "_token": "{{ csrf_token() }}",
          id:id,
       },
       dataType:"json",
       success:function(response){
          $('.SendOfferModal').html(response.success);
          $('#SendOfferModal').modal('show');
       },
   });
});

  
$('body').delegate('.ChangeOfferStatus','change',function(){

   var id = $(this).attr('id');
   var status = $(this).val();
   $.ajax({
      url: "{{ url('admin/offer/change_status') }}",
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