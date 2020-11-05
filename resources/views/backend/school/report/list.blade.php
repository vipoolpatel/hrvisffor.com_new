@extends('backend.layouts.app')
@section('style')
<style type="text/css">
   .form-group {
   margin-bottom: 8px;
   }
   .required {
   color: red;
   }
   select {
   -moz-appearance:none; /* Firefox */
   -webkit-appearance:none; /* Safari and Chrome */
   appearance:none;
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
                     <h2 class="text-white font-weight-bold my-2 mr-5">{{__("report.Report List")}}</h2>
                  </div>
                  <div class="col-sm-6" style="text-align: right;">
                     <a href="javascript:;" class="btn btn-transparent-white font-weight-bold  py-3 px-6 mr-2" id="AddReport"><i class="flaticon2-plus-1"></i> {{__("report.Add New Report")}}
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
                     @foreach($get_report as $value)
                     <div class="col-md-6">
                        <div class="card card-custom gutter-b card-stretch">
                           <div class="card-body">
                              <div class="d-flex align-items-center">
                                 <div style="width: 100%">
                                    <div class="row form-group">
                                       <div class="col-md-3 text-primary font-weight-bold"> {{__("report.Name")}}</div>
                                       <div class="col-md-9">{{ $value->name }}</div>
                                    </div>
                                    <div class="row form-group">
                                       <div class="col-md-3 text-primary font-weight-bold">{{__("report.Email")}} </div>
                                       <div class="col-md-9">{{ $value->email }}</div>
                                    </div>
                                    <div class="row form-group">
                                       <div class="col-md-3 text-primary font-weight-bold">{{__("report.Phone")}}  </div>
                                       <div class="col-md-9">{{ $value->phone }}</div>
                                    </div>
                                    <div class="row form-group">
                                       <div class="col-md-3 text-primary font-weight-bold">{{__("report.Title")}}  </div>
                                       <div class="col-md-9">{{ $value->title }}</div>
                                    </div>
                                    <div class="row form-group">
                                       <div class="col-md-3 text-primary font-weight-bold">{{__("report.Description")}} </div>
                                       <div class="col-md-9">
                                          {{ $value->description }}
                                       </div>
                                    </div>
                                     @if($value->status == 3)
                                       <div class="row form-group">
                                          <div class="col-md-3 text-danger font-weight-bold">{{__("report.Reject Rason")}}</div>
                                          <div class="col-md-9">{{ $value->reason }}</div>
                                       </div>
                                       @endif
                                 </div>
                              </div>

                              <div class="d-flex flex-wrap">
                                  <div class="mr-12 d-flex flex-column mb-7">
                                    <span class="font-weight-bolder mb-4">{{__("report.Status")}}</span>
                                    <span class="btn {{ $value->get_status->class }} btn-sm font-weight-bold btn-upper btn-text">{{ $value->get_status->name }}</span>
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
                           {!! $get_report->links() !!}
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
<div class="modal fade" id="AddEditReportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{__("report.Report")}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
            </button>
         </div>
         <form method="post" accept="{{ url('teacher/report') }}">
            {{ csrf_field() }}
            <div class="modal-body">
               <div class="col-md-12">
                  <div class="form-group">
                     <label>{{__("report.Name")}}</label>
                     <input class="form-control form-control-lg form-control-solid" placeholder="{{__("report.Name")}}" type="text" name="name" required>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                     <label>{{__("report.Email")}}</label>
                     <input class="form-control form-control-lg form-control-solid" placeholder="{{__("report.Email")}}" type="text" name="email" required>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                     <label>{{__("report.Phone")}}</label>
                     <input class="form-control form-control-lg form-control-solid" placeholder="{{__("report.Phone")}}" type="text" name="phone" required>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                     <label>{{__("report.Title")}}</label>
                     <input class="form-control form-control-lg form-control-solid" placeholder="{{__("report.Title")}}" type="text" name="title" required>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                     <label>{{__("report.Description")}}</label>
                     <textarea class="form-control form-control-lg form-control-solid" placeholder="{{__("report.Description")}}" name="description" required></textarea>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger font-weight-bold" data-dismiss="modal">{{__("report.Close")}}</button>
               <button type="submit" id="add" class="btn btn-success font-weight-bold" >{{__("report.Save")}}</button>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
   $('body').delegate('#AddReport','click',function(){
      $('#AddEditReportModal').modal('show');
   });
   
</script>
@endsection
