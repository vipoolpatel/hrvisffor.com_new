@extends('backend.layouts.app')
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
                  {{__('teacher.Edit Teacher')}}                               
               </h2>
               <!--end::Title-->
               <!--begin::Breadcrumb-->
               <div class="d-flex align-items-center font-weight-bold my-2">
                  <!--begin::Item-->
                  <a href="{{ url('admin/teacher') }}" class="text-white text-hover-white opacity-75 hover-opacity-100">
                  {{__('teacher.Teacher')}}
                  </a>
                  <!--end::Item-->
                  <!--begin::Item-->
                  <span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
                  <a href="" class="text-white text-hover-white opacity-75 hover-opacity-100">
                   
                  {{__('teacher.Edit Teacher')}}                       
                      </a>
                  <!--end::Item-->
               </div>
               <!--end::Breadcrumb-->
            </div>
            <!--end::Heading-->
         </div>
         <!--end::Info-->
         <!--begin::Toolbar-->
         <!--end::Toolbar-->
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
                  <h3 class="card-label font-weight-bolder text-dark">{{__('teacher.Tell us something about yourself')}} (<span style="color: blue">{{ $user->teacher_id }}</span>)</h3>
               </div>
            </div>
            <div class="card-body px-0">
                @include('backend.admin.teacher._form')
            </div>
            <!--begin::Card body-->
         </div>
      </div>
   </div>
</div>
@endsection
