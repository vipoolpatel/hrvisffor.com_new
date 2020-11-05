@extends('backend.layouts.app')
@section('style')
<style type="text/css">
   .interview-table tr td {
   padding-right: 5px;
   padding-top: 10px;
   padding-bottom: 10px;
   }
   .interview-table tr th {
   padding-right: 5px;
   }
   .form-group {
   margin-bottom: 15px;
   }
   .required {
    color: red;
   }
</style>
@endsection
@section('content')
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
   <div class="subheader py-2 py-lg-12  subheader-transparent " id="kt_subheader">
      <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
         <div class="d-flex align-items-center flex-wrap mr-1" style="width: 100%;">
            <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none" id="kt_subheader_mobile_toggle">
            <span></span>
            </button>
            <div class="d-flex flex-column" style="width: 100%;">
               <div class="row">
                  <div class="col-sm-6">
                     <h2 class="text-white font-weight-bold my-2 mr-5">{{ __('offer.Offers') }}</h2>
                  </div>
                  <div class="col-sm-6" style="text-align: right;">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="d-flex flex-column-fluid">
      <div class=" container ">
         <div class="d-flex flex-row">
            @include('backend.layouts._sidebar_shcool_teacher')
            <div class="flex-row-fluid ml-lg-8">
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
                         {{ __('offer.Location') }}: @if(!empty($value->job_apply->job->get_location())) {{ $value->job_apply->job->get_location() }} @endif 
                         </span>
                      </div>
                   </div>

                   <hr />
                 <div class="row form-group" style="margin-top: 10px;">
                    <div class="col-md-5 text-primary font-weight-bold">{{ __('offer.Salary') }}</div>
                    <div class="col-md-7">¥ {{ $value->salary }} {{ __('offer.Monthly') }} ({{ $value->tax->getName() }})</div>
                 </div>
                   @if(!empty($value->holiday))
                 <div class="row form-group">
                    <div class="col-md-5 text-primary font-weight-bold">{{ __('offer.Holidays') }}</div>
                    <div class="col-md-7">{{ $value->holiday }}</div>
                 </div>
                  @endif

                  @if(!empty($value->flights))
                 <div class="row form-group">
                    <div class="col-md-5 text-primary font-weight-bold">{{ __('offer.Flights') }}</div>
                    <div class="col-md-7"> {{ $value->flights }}</div>
                 </div>
                 @endif
           
                  @if(!empty($value->contract_length))
                  <div class="row form-group">
                    <div class="col-md-5 text-primary font-weight-bold">{{ __('offer.Contract Length') }}</div>
                    <div class="col-md-7">{{ $value->contract_length }}</div>
                 </div>
                 @endif

                 @if(!empty($value->insurance))
                 <div class="row form-group">
                    <div class="col-md-5 text-primary font-weight-bold">{{ __('offer.Insurance') }}</div>
                    <div class="col-md-7">{{ $value->insurance }}</div>
                 </div>
                 @endif


                 @if(!empty($value->start_date))
                  <div class="row form-group">
                    <div class="col-md-5 text-primary font-weight-bold">{{ __('offer.Start Date') }}</div>
                    <div class="col-md-7"><span class="btn btn-light-primary btn-sm font-weight-bold btn-upper btn-text">{{ date('d-m-Y',strtotime($value->start_date)) }}</span></div>
                 </div>
                 @endif

                 @if(!empty($value->apartment))
                 <div class="row form-group">
                    <div class="col-md-5 text-primary font-weight-bold">{{ __('offer.Apartment') }}</div>
                    <div class="col-md-7">{{ $value->apartment }}</div>
                 </div>
                @endif 

                @if(!empty($value->bonus))
                  <div class="row form-group">
                    <div class="col-md-5 text-primary font-weight-bold">{{ __('offer.Bonus') }}</div>
                    <div class="col-md-7">{{ $value->bonus }}</div>
                 </div>
               @endif 

               @if(!empty($value->expired_date))
                  <div class="row form-group">
                    <div class="col-md-5 text-primary font-weight-bold">{{ __('offer.Offer Expired on') }}</div>
                    <div class="col-md-7"><span class="btn btn-light-danger btn-sm font-weight-bold btn-upper btn-text">{{ date('d-m-Y',strtotime($value->expired_date)) }}</span></div>
                 </div>
               @endif



              </div>
           </div>
           <p class="mb-7 mt-3">
              {{ $value->note }}
           </p>
           <div class="d-flex flex-wrap">

              @if(!empty($user->staff))
                <div class="mr-12 d-flex flex-column mb-7">
                   <span class="font-weight-bolder mb-4">{{ __('offer.Support') }}</span>
                   <a class="btn btn-light btn-hover-primary btn-sm" href="{{ url('teacher/support') }}"> <i class="flaticon-speech-bubble"></i> {{ $user->staff->name }}</a>
                </div>
              @endif

              @if($value->is_confirm == 1)
                <div class="d-flex flex-column flex-lg-fill float-left mb-7">
                   <span class="font-weight-bolder mb-4">{{ __('offer.Action') }}</span>
                   <div class="symbol-group symbol-hover">
                     <a href="{{ url('teacher/offer/staus/2/'.$value->id) }}" class="btn btn-success btn-hover-primary btn-sm" style="margin-right: 10px;"> <i class="flaticon2-check-mark"></i>{{ __('offer.Accept') }} </a>
                     <a href="{{ url('teacher/offer/staus/3/'.$value->id) }}" class="btn btn-danger btn-hover-primary btn-sm"> <i class="flaticon2-cancel-music"></i> {{ __('offer.Reject') }}</a>
                   </div>
                </div>
              @else

               <div class="mr-12 d-flex flex-column mb-7">
                   <span class="font-weight-bolder mb-4">{{ __('offer.Status') }}</span>
                   <span class="btn {{ $value->confirm->class }} font-weight-bold btn-upper btn-text">{{ $value->confirm->teacher_status }}</span>
                </div>
      

              @endif

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
   </div>
</div>

@endsection
@section('script')
@endsection
