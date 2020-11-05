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
</style>
@endsection
@section('content')
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
   <div class="subheader py-2 py-lg-12  subheader-transparent " id="kt_subheader">
      <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
         <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex flex-column">
               <h2 class="text-white font-weight-bold my-2 mr-5">
                  {{__("profile.Notifications")}}
               </h2>
            </div>
         </div>
      </div>
   </div>
   <div class="d-flex flex-column-fluid">
      <div class=" container ">
         @include('layouts._message')
         <div class="row">
            <div class="col-lg-12">
             
               <div class="card card-custom  card-stretch gutter-b">

                  <div class="card-header border-0">
                     <h3 class="card-title font-weight-bolder text-dark">{{__("profile.Notifications")}}</h3>
                  </div>

                  <div class="card-body pt-0">
                     @foreach($notifications as $notification)

                       @php
                          $getdata = json_decode($notification->data);
                       @endphp

                     <div class="mb-6">
                        <div class="d-flex align-items-center flex-grow-1">
                           <div class="d-flex flex-wrap align-items-center justify-content-between w-100">
                              <div class="d-flex flex-column align-items-cente py-2" style="{{  empty($notification->read_at) ? 'font-weight: bold;' : '' }}">
                                 
                                 @if($getdata->type == 'interview')
                                 <a href="{{ url('admin/interview') }}" class="text-dark-75 text-hover-primary font-size-lg mb-1">
                                     {!! $getdata->message !!}
                                 </a>
                                 @elseif($getdata->type == 'offer')
                                 <a href="{{ url('admin/offer') }}" class="text-dark-75 text-hover-primary font-size-lg mb-1">
                                     {!! $getdata->message !!}
                                 </a>

                                 @elseif($getdata->type == 'contract')
                                 <a href="{{ url('admin/contract') }}" class="text-dark-75 text-hover-primary font-size-lg mb-1">
                                     {!! $getdata->message !!}
                                 </a>


                                 @elseif($getdata->type == 'travel')
                                 <a href="{{ url('admin/travel') }}" class="text-dark-75 text-hover-primary font-size-lg mb-1">
                                     {!! $getdata->message !!}
                                 </a>

                                @elseif($getdata->type == 'feedback')
                                 <a href="{{ url('admin/feedback') }}" class="text-dark-75 text-hover-primary font-size-lg mb-1">
                                     {!! $getdata->message !!}
                                 </a>

                                 @elseif($getdata->type == 'report')
                                 <a href="{{ url('admin/report') }}" class="text-dark-75 text-hover-primary font-size-lg mb-1">
                                     {!! $getdata->message !!}
                                 </a>


                                 @elseif($getdata->type == 'task')
                                 <a href="{{ url('admin/task') }}" class="text-dark-75 text-hover-primary font-size-lg mb-1">
                                     {!! $getdata->message !!}
                                 </a>

                                 @elseif($getdata->type == 'visa')
                                    @php
                                       $visa = App\Models\UserVisaModel::get_single($getdata->common_id)
                                    @endphp

                                 <a href="{{ url('admin/user/visa/'.$visa->user_id) }}" class="text-dark-75 text-hover-primary font-size-lg mb-1">
                                     {!! $getdata->message !!}
                                 </a>

                                 @endif
                          
                                 <span class="text-muted font-weight-bold">
                                 {{ Carbon\Carbon::parse($notification->created_at)->diffForHumans()}}
                                 </span>
                              </div>
                           </div>
                        </div>
                     </div>
                     @endforeach
                  </div>
                  <div class="d-flex justify-content-between align-items-center flex-wrap" style="margin: auto;">
                     <div class="d-flex flex-wrap mr-3">
                        @if(!empty($notifications))
                        {!! $notifications->links() !!}
                        @endif
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
