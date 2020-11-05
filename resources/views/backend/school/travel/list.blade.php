@extends('backend.layouts.app')
@section('style')
<style type="text/css">
   .form-group {
   margin-bottom: 8px;
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
                     <h2 class="text-white font-weight-bold my-2 mr-5">{{__("travel.Travel Arrangements List")}}</h2>
                  </div>
                  <div class="col-sm-6" style="text-align: right;">
                     <a href="{{ url('school/travel/add') }}" class="btn btn-transparent-white font-weight-bold  py-3 px-6 mr-2"><i class="flaticon2-plus-1"></i> {{__("travel.Add Travel Arrangement")}}
                     </a>
                  </div>
               </div>
            </div>


         </div>
      </div>
   </div>
   <div class="d-flex flex-column-fluid">
      <div class=" container ">
         <div class="d-flex flex-row">
            @include('backend.layouts._sidebar_school')
            <div class="flex-row-fluid ml-lg-8">
               @include('layouts._message')
               <div class="card-custom card-stretch">
                  
<div class="row">

@foreach($get_travel as $value)

   <div class="col-md-6">
      <div class="card card-custom gutter-b card-stretch">
         <div class="card-body">
            <div class="d-flex align-items-center">
               <div style="width: 100%">
                  <div class="d-flex align-items-center">
                     <div class="d-flex flex-column mr-auto">
                        <a href="{{ url('teacher-profile/Trina/'.$value->teacher->username) }}" class="card-title text-hover-primary font-weight-bolder font-size-h5 text-dark mb-1">{{ $value->teacher->name }} ({{ $value->teacher->teacher_id }})</a>
                        @if(!empty($value->teacher->nationality))
                        <span class="text-muted font-weight-bold">
                        {{__("travel.Nationality")}}: {{ $value->teacher->nationality->getName() }}
                        </span>
                        @endif
                     </div>
                  </div>
                  <hr>

                  @if(!empty($value->get_flight_ticket()) && $value->teacher_status == 0)
                     <div class="row form-group" style="margin-top: 10px;">
                        <div class="col-md-5 text-primary font-weight-bold">{{__("travel.Flight Ticket")}}</div>
                        <div class="col-md-7">
                           <a target="_blank" href="{{ $value->get_flight_ticket() }}" class="btn btn-sm btn-success">{{__("travel.Download")}}</a>
                        </div>
                     </div>
                  @else
                     @if(!empty($value->get_flight_ticket()) && $value->teacher_status == 2)
                        <div class="row form-group" style="margin-top: 10px;">
                           <div class="col-md-5 text-primary font-weight-bold">{{__("travel.Flight Ticket")}}</div>
                           <div class="col-md-7">
                              <a target="_blank" href="{{ $value->get_flight_ticket() }}" class="btn btn-sm btn-success">{{__("travel.Download")}}</a>
                           </div>
                        </div>
                     @endif
                  @endif

                  @if(!empty($value->picked_up_by))
                     <div class="row form-group">
                        <div class="col-md-5 text-primary font-weight-bold">{{__("travel.You will be picked up by")}}</div>
                        <div class="col-md-7">{{ $value->picked_up_by }}</div>
                     </div>
                  @endif

                  <div class="row form-group">
                     <div class="col-md-5 text-primary font-weight-bold">{{__("travel.Profile")}}</div>
                     <div class="col-md-7">
                        <img src="{{ $value->getimage() }}" style="width: 100px; height: 100px;">
                     </div>
                  </div>

                  @if(!empty($value->email))
                     <div class="row form-group">
                        <div class="col-md-5 text-primary font-weight-bold">{{__("travel.Email")}}</div>
                        <div class="col-md-7">{{$value->email }}</div>
                     </div>
                  @endif

                  @if(!empty($value->phone_number))
                     <div class="row form-group">
                        <div class="col-md-5 text-primary font-weight-bold">{{__("travel.Phone Number")}}</div>
                        <div class="col-md-7">{{ !empty($value->country) ? $value->country->getName() : '' }} - {{ $value->phone_number }}</div>
                     </div>
                  @endif 

                  @if(!empty($value->skype))
                     <div class="row form-group">
                        <div class="col-md-5 text-primary font-weight-bold">{{__("travel.Skype")}}</div>
                        <div class="col-md-7">{{$value->skype }}</div>
                     </div>
                  @endif

                  @if(!empty($value->wechat))
                     <div class="row form-group">
                        <div class="col-md-5 text-primary font-weight-bold">{{__("travel.Wechat")}}</div>
                        <div class="col-md-7">{{$value->wechat }}</div>
                     </div>
                  @endif

                  @if(!empty($value->metting_point))
                     <div class="row form-group">
                        <div class="col-md-5 text-primary font-weight-bold">{{__("travel.Metting Point")}}</div>
                        <div class="col-md-7">{{$value->metting_point }}</div>
                     </div>
                  @endif

                  @if(!empty($value->picked_school))
                     <div class="row form-group">
                        <div class="col-md-5 text-primary font-weight-bold"> {{__("travel.I have picked by the school")}}</div>
                        <div class="col-md-7">{{ $value->picked_school }}</div>
                     </div>
                  @endif

                  @if(!empty($value->note))
                     <div class="row form-group">
                        <div class="col-md-5 text-primary font-weight-bold">{{__("travel.Note")}}</div>
                        <div class="col-md-7">{{ $value->note }}</div>
                     </div>
                  @endif

                  @if(!empty($value->school_reason) && $value->school_status == 3)
                     <div class="row form-group">
                        <div class="col-md-5 text-danger font-weight-bold">{{__("travel.Reject Reason")}}</div>
                        <div class="col-md-7">{{ $value->school_reason }}</div>
                     </div>
                  @endif


               </div>
            </div>
            
            <div class="d-flex flex-wrap">

               <div class="mr-12 d-flex flex-column mb-7">
                  <span class="font-weight-bolder mb-4">{{__("travel.Status")}}</span>
                  <span class="btn {{ $value->school_status_type->class }} font-weight-bold btn-upper btn-text">{{ $value->school_status_type->name }}</span>
               </div>

               @if($value->school_status != 2)

                  <div class="d-flex flex-column flex-lg-fill float-left mb-7">
                     <span class="font-weight-bolder mb-4">{{__("travel.Action")}}</span>
                     <div class="symbol-group symbol-hover">
                        <a style="margin-right: 10px" href="{{ url('school/travel/edit/'.$value->id) }}" class="btn btn-icon btn-light btn-hover-danger btn-sm"> <i class="flaticon-edit-1 text-primary"></i>
                        </a>

                        <a onclick="return confirm('{{__("travel.Are you sure you want to delete?")}}')" href="{{ url('common/travel/delete/'.$value->id) }}" class="btn btn-icon btn-light btn-hover-danger btn-sm">
                        <i class="flaticon2-trash text-danger"></i>
                        </a>
                     </div>
                  </div>

               @endif


            </div>

         </div>
      </div>
   </div>
@endforeach

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
      </div>
   </div>
</div>
@endsection
