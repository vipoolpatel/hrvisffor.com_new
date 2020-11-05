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
                     <h2 class="text-white font-weight-bold my-2 mr-5">Position List</h2>
                  </div>
                  <div class="col-sm-6" style="text-align: right;">
                     <a href="{{ url('school/position/add') }}" class="btn btn-transparent-white font-weight-bold  py-3 px-6 mr-2"><i class="flaticon2-plus-1"></i> Add New Position
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
                    @include('backend.school.position._list')
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
