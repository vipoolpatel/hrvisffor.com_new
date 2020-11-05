@extends('backend.layouts.app')
@section('content')
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
   <div class="subheader py-2 py-lg-12  subheader-transparent " id="kt_subheader">
      <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
         <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex flex-column">
               <h2 class="text-white font-weight-bold my-2 mr-5">
                  {{__("visa.Add Visa")}}                        
               </h2>
               <div class="d-flex align-items-center font-weight-bold my-2">
                
                  <a href="{{ url('admin/user/visa/'.$user->id) }}" class="text-white text-hover-white opacity-75 hover-opacity-100">
                  {{__("visa.Visa")}}
                  </a>
                  <span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
                  <a href="" class="text-white text-hover-white opacity-75 hover-opacity-100">
                  {{__("visa.Add Visa")}}
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="d-flex flex-column-fluid">
      <div class=" container ">
         <div class="card card-custom">
            <div class="card-body px-0">
               @include('backend.admin.common.visa._form')
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
