@extends('backend.layouts.app')

@section('style')

<style type="text/css">
   .font-size-sm {
      margin-bottom: 15px;
   }
</style>

@endsection

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
                       {{ __('manage.Manage') }}                                  
               </h2>
               <!--end::Title-->
            </div>
            <!--end::Heading-->
         </div>
         <!--end::Info-->
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
            <!--begin::Body-->
            <div class="card-body">

                  <a href="{{ url('admin/area') }}" class="btn btn-success font-weight-bolder font-size-sm"><i class="flaticon2-list-2 "></i>  {{ __('manage.Area') }}     </a>

                  <a href="{{ url('admin/creditlevel') }}" class="btn btn-success font-weight-bolder font-size-sm"><i class="flaticon2-list-2 "></i>   {{ __('manage.Credit Level') }}  </a>

                  <a href="{{ url('admin/emergencylevel') }}" class="btn btn-success font-weight-bolder font-size-sm"><i class="flaticon2-list-2 "></i> {{ __('manage.Emergency Level') }}</a>


                  <a href="{{ url('admin/colour') }}" class="btn btn-success font-weight-bolder font-size-sm"><i class="flaticon2-list-2 "></i> 
                   {{ __('manage.Colour') }}</a>

                  <a href="{{ url('admin/cardcolour') }}" class="btn btn-success font-weight-bolder font-size-sm"><i class="flaticon2-list-2 "></i>  {{ __('manage.Card Colour') }}</a>

                  <a href="{{ url('admin/teachertype') }}" class="btn btn-success font-weight-bolder font-size-sm"><i class="flaticon2-list-2 "></i>   {{ __('manage.Teacher Type') }}</a>

                  <a href="{{ url('admin/position') }}" class="btn btn-success font-weight-bolder font-size-sm"><i class="flaticon2-list-2 "></i>    {{ __('manage.Position') }}</a>

                  <a href="{{ url('admin/nationality') }}" class="btn btn-success font-weight-bolder font-size-sm"><i class="flaticon2-list-2 "></i>  {{ __('manage.Nationality') }}</a>

                  <a href="{{ url('admin/countries') }}" class="btn btn-success font-weight-bolder font-size-sm"><i class="flaticon2-list-2 "></i>  {{ __('manage.Countries') }}</a>

                  <a href="{{ url('admin/states') }}" class="btn btn-success font-weight-bolder font-size-sm"><i class="flaticon2-list-2 "></i>  {{ __('manage.States') }}</a>

                  <a href="{{ url('admin/cities') }}" class="btn btn-success font-weight-bolder font-size-sm"><i class="flaticon2-list-2 "></i>   {{ __('manage.Cities') }}</a>

                  <a href="{{ url('admin/current-location') }}" class="btn btn-success font-weight-bolder font-size-sm"><i class="flaticon2-list-2 "></i>    {{ __('manage.Current Location') }}</a>

                  <a href="{{ url('admin/current-visa-type') }}" class="btn btn-success font-weight-bolder font-size-sm"><i class="flaticon2-list-2 "></i>    {{ __('manage.Current Visa Type') }}</a>

                  <a href="{{ url('admin/education-level') }}" class="btn btn-success font-weight-bolder font-size-sm"><i class="flaticon2-list-2 "></i>   {{ __('manage.Education Level') }}</a>

                  <a href="{{ url('admin/job-type') }}" class="btn btn-success font-weight-bolder font-size-sm"><i class="flaticon2-list-2 "></i> {{ __('manage.Job Type') }}</a>

                  <a href="{{ url('admin/salary') }}" class="btn btn-success font-weight-bolder font-size-sm"><i class="flaticon2-list-2 "></i>  {{ __('manage.Salary') }}</a>

                  <a href="{{ url('admin/school-type') }}" class="btn btn-success font-weight-bolder font-size-sm"><i class="flaticon2-list-2 "></i>    {{ __('manage.School Type') }}</a>

                  <a href="{{ url('admin/start-date') }}" class="btn btn-success font-weight-bolder font-size-sm"><i class="flaticon2-list-2 "></i> {{ __('manage.Start Date') }}</a>

                  <a href="{{ url('admin/welfare') }}" class="btn btn-success font-weight-bolder font-size-sm"><i class="flaticon2-list-2 "></i>  {{ __('manage.Welfare') }}</a>

                  <a href="{{ url('admin/general-location') }}" class="btn btn-success font-weight-bolder font-size-sm"><i class="flaticon2-list-2 "></i>  {{ __('manage.General Location') }}</a>

                  <a href="{{ url('admin/visa-type') }}" class="btn btn-success font-weight-bolder font-size-sm"><i class="flaticon2-list-2 "></i>  {{ __('manage.Visa Type') }}</a>

                  <a href="{{ url('admin/working-schedule') }}" class="btn btn-success font-weight-bolder font-size-sm"><i class="flaticon2-list-2 "></i>  {{ __('manage.Working Schedule') }}</a>

                  <a href="{{ url('admin/livingcost') }}" class="btn btn-success font-weight-bolder font-size-sm"><i class="flaticon2-list-2 "></i>   {{ __('manage.Living Cost') }}</a>

                  

                  <a href="{{ url('admin/faq_category') }}" class="btn btn-success font-weight-bolder font-size-sm"><i class="flaticon2-list-2 "></i> {{ __('manage.FAQ') }}</a>

                  <a href="{{ url('admin/visa') }}" class="btn btn-success font-weight-bolder font-size-sm"><i class="flaticon2-list-2 "></i>  {{ __('manage.Visa') }}</a>

                  <a href="{{ url('admin/setting') }}" class="btn btn-success font-weight-bolder font-size-sm"><i class="flaticon2-list-2 "></i>   {{ __('manage.Setting') }}</a>


                  

                  





                  

            </div>
            <!--end::Body-->
         </div>
         <!--end::Card-->
      </div>
      <!--end::Container-->
   </div>
   <!--end::Entry-->
</div>
@endsection