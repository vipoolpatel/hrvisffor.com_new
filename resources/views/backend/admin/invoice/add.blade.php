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
   <!--begin::Subheader-->
   <div class="subheader py-2 py-lg-12  subheader-transparent " id="kt_subheader">
      <div class=" container  d-flex  justify-content-between flex-wrap ">
         <h2 class="text-white font-weight-bold my-2 mr-5" style="margin-bottom: 20px !important;">{{__("invoice.Create Invoice")}}</h2>
      </div>
   </div>
   @include('backend.admin.invoice._form')
</div>
@endsection
