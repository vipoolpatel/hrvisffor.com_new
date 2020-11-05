@extends('backend.layouts.app')
@section('style')
<style type="text/css">
   .interview-table tr td {
   padding-right: 5px;
   padding-top: 10px;
   padding-bottom: 10px;
   }
   .interview-table tr th {
   padding-right: 5px;
   }
   .form-group {
   margin-bottom: 15px;
   }
   .required {
    color: red;
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
                     <h2 class="text-white font-weight-bold my-2 mr-5">{{ __('favorite.Favorite School Job') }}</h2>
                  </div>
                  <div class="col-sm-6" style="text-align: right;">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="d-flex flex-column-fluid">
      <div class=" container ">
         <div class="d-flex flex-row">
            @include('backend.layouts._sidebar_shcool_teacher')
            <div class="flex-row-fluid ml-lg-8">
               @include('layouts._message')
               <div class="row">
              
@forelse($getRecord as $value)

   <div class="col-lg-6">
     <div class="card card-custom card-stretch gutter-b">
        <div class="card-body">
           <div class="d-flex flex-wrap align-items-center mb-1">
              <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                 <a href="{{ url('school-profile/'.$value->job->slug) }}" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">
                 {{ $value->job->user->school_id }}</a>
                  @if(!empty($value->job->get_location()))
                     <span class="text-muted font-weight-bold font-size-sm my-1">{{ __('favorite.Location') }}: {{ $value->job->get_location() }}</span>
                  @endif
                  @if(!empty($value->job->get_salary_minimum) && !empty($value->job->get_salary_maximum))
                     <span class="text-muted font-size-sm font-weight-bolder">{{ __('favorite.Salary') }}: {{ $value->job->get_salary_minimum->name }} - {{ $value->job->get_salary_maximum->name }}</span>
                  @endif
              </div>

              <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                <a onclick="return confirm('{{ __('favorite.Are you sure you want to delete?') }}')" href="{{ url('teacher/favorite-job/delete/'.$value->id) }}" class="btn btn-icon btn-light-danger btn-hover-primary btn-sm"><i class="flaticon2-trash"></i></a>

              </div>


           </div>    
        </div>
     </div>
  </div>

@empty

@endforelse



               </div>
               <div class="row col-md-12">
                  <div class="d-flex justify-content-between align-items-center flex-wrap" style="margin: auto;">
                     <div class="d-flex flex-wrap mr-3">
                          {!! $getRecord->links() !!}
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
