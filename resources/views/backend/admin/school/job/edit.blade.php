@extends('backend.layouts.app')
@section('content')
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
   <div class="subheader py-2 py-lg-12  subheader-transparent " id="kt_subheader">
      <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
         <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex flex-column">
               <h2 class="text-white font-weight-bold my-2 mr-5">
                  {{ __('position.Edit Job') }}                           
               </h2>
               <div class="d-flex align-items-center font-weight-bold my-2">
                  <a href="{{ url('admin/job') }}" class="text-white text-hover-white opacity-75 hover-opacity-100">{{ __('position.Job') }}</a>
                  <span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
                  <a href="" class="text-white text-hover-white opacity-75 hover-opacity-100">
                  {{ __('position.Edit Job') }}</a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!--end::Subheader-->
   <!--begin::Entry-->
   <div class="d-flex flex-column-fluid">
      <!--begin::Container-->
      <div class=" container ">
         @include('layouts._message')
         <!--begin::Card-->
         <div class="card card-custom">
            <!--begin::Card body-->
             <div class="card-header py-3">
               <div class="card-title align-items-start flex-column">
                  <h3 class="card-label font-weight-bolder text-dark">{{ __('position.Account Information') }}</h3>
                  <span class="text-muted font-weight-bold font-size-sm mt-1">{{ __('position.Update your personal informaiton') }}</span>
               </div>
            </div>

            <div class="card-body px-0" style="padding-top: 0px;padding-bottom: 0px;">
                @include('backend.admin.school.job._form')
            </div>
            <!--begin::Card body-->
         </div>
      </div>
   </div>
</div>
@endsection