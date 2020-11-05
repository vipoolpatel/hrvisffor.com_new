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
         <h2 class="text-white font-weight-bold my-2 mr-5" style="margin-bottom: 20px !important;">Daily Report</h2>
         <a href="{{ url('admin/daily-report/add') }}" class="btn btn-transparent-white font-weight-bold  py-3 px-6 mr-2" style="margin-bottom: 15px;">
         <i class="flaticon2-plus-1"></i> Add
         </a>
      </div>
   </div>
   <div class="d-flex flex-column-fluid">
      <div class=" container ">
         @include('layouts._message')
         <div class="row">
            <div class="col-xl-6 pt-10 pt-xl-0" style="margin-bottom: 10px;">
               <!--begin::Card-->
               <div class="card card-custom card-stretch" id="kt_todo_view">
                  <!--begin::Header-->
                  <div class="card-header align-items-center flex-wrap justify-content-between border-0 py-6 h-auto">
                     <!--begin::Left-->
                     <div class="d-flex align-items-center my-2">
                        <div class="d-flex align-items-center">
                           <div class="symbol symbol-35 mr-3">
                              <div class="symbol-label" style="background-image: url('{{ url('upload/profile/profile.png') }}')"></div>
                           </div>
                           <a href="javascript:;" class="text-dark-75 font-size-lg text-hover-primary font-weight-bolder">
                           Admin
                           </a>
                        </div>
                     </div>
                     <div class="d-flex align-items-center justify-content-end text-right my-2">
                        <span class="btn btn-light-warning btn-sm text-uppercase font-weight-bolder mr-2">09 Sep, 2020</span>
                        <a onclick="return confirm('Are you sure you want to delete?')" href="{{ url('admin/daily-report/delete/') }}" class="btn btn-danger btn-sm btn-icon">
                        <i class="flaticon2-trash"></i>
                        </a>
                     </div>
                  </div>
                  <div class="card-body p-0">
                     <div class="d-flex align-items-center justify-content-between flex-wrap card-spacer-x py-3">
                        <div class="d-flex flex-column mr-2 py-2">
                           <a href="" class="text-dark text-hover-primary font-weight-bold font-size-h4 mr-3">CBT Video Courses | An IELTS Medical Website</a>
                        </div>
                     </div>
                     <div class="mb-3">
                        <div class="card-spacer-x pt-2 pb-5 ">
                           <div class="mb-1">
                              <p>CBT Video Courses | An IELTS Medical Website CBT Video Courses | An IELTS Medical Website CBT Video Courses | An IELTS Medical Website CBT Video Courses | An IELTS Medical Website CBT Video Courses | An IELTS Medical Website</p>
                              <p></p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row col-md-12">
            <div class="d-flex justify-content-between align-items-center flex-wrap" style="margin: auto;">
               <div class="d-flex flex-wrap mr-3">
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('script')
<script type="text/javascript"></script>
@endsection
