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
                     <h2 class="text-white font-weight-bold my-2 mr-5">{{__('favorite.Favorite Teacher')}}</h2>
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
            @include('backend.layouts._sidebar_school')
            <div class="flex-row-fluid ml-lg-8">
               @include('layouts._message')
               <div class="row">
              
@forelse($getRecord as $value)

<div class="col-lg-6">
   <!--begin::List Widget 14-->
   <div class="card card-custom card-stretch gutter-b">
     
      <div class="card-body">
     
         <div class="d-flex flex-wrap align-items-center mb-1">
     
            <div class="symbol symbol-60 symbol-2by3 flex-shrink-0 mr-4">
               <div class="symbol-label" style="background-image: url('{{ url($value->teacher->getImage())  }}');border-radius: 40px;height: 60px;width: 60px;"></div>
            </div>
     
            <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
               <a href="{{ url('teacher-profile/'.$value->teacher->username) }}" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $value->teacher->name }}</a>

                 @if(!empty($value->teacher->start_date))
                   <span class="text-muted font-weight-bold font-size-sm">
                   {{__('favorite.Boarding time')}}: {{ !empty($value->teacher->start_date) ? $value->teacher->start_date->getName() : '' }}
                   </span>
                @endif

                @if(!empty($value->teacher->minimum_salary) && !empty($value->teacher->maximum_salary))
                  <span class="text-muted font-size-sm font-weight-bolder">
                  : {{ $value->teacher->minimum_salary->name }}-{{ $value->teacher->maximum_salary->name }} {{__('favorite.Monthly Salary')}}
                  </span>
                @endif


            </div>

              <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                <a onclick="return confirm('{{__('favorite.Are you sure you want to delete?')}}')" href="{{ url('school/favorite-teacher/delete/'.$value->id) }}" class="btn btn-icon btn-light-danger btn-hover-primary btn-sm"><i class="flaticon2-trash"></i></a>

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
