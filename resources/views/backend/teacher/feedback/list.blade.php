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
                     <h2 class="text-white font-weight-bold my-2 mr-5">Feedback List</h2>
                  </div>
                  <div class="col-sm-6" style="text-align: right;">
                    <a href="{{ url('teacher/feedback/add') }}" class="btn btn-transparent-white font-weight-bold  py-3 px-6 mr-2"><i class="flaticon2-plus-1"></i> Add Feedback
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
            @include('backend.layouts._sidebar_shcool_teacher')
            <div class="flex-row-fluid ml-lg-8">
               @include('layouts._message')
               <div class="card-custom card-stretch">
                  
<div class="row">



@foreach($get_feedback as $value)


<div class="col-md-6">
   <div class="card card-custom gutter-b card-stretch">
      <div class="card-body">
         <div class="d-flex align-items-center">
            <div style="width: 100%">
               
               <div class="row form-group">
                  <div class="col-md-3 text-primary font-weight-bold">Title </div>
                  <div class="col-md-9">{{ $value->title }}</div>
               </div>
               <div class="row form-group">
                  <div class="col-md-3 text-primary font-weight-bold">Review</div>
                  <div class="col-md-9">
                           {{ $value->review }}
                  </div>
               </div>
               <div class="row form-group">
                  <div class="col-md-3 text-primary font-weight-bold">Photo </div>
                  <div class="col-md-9">
                     @foreach($value->get_image as $image)
                        @if(!empty($image->getImage()))
                              <img style="width: 100%;height: 150px;margin-bottom: 10px;border-radius: 6px;" src="{{ $image->getImage() }}">
                        @endif
                     @endforeach
                  </div>
               </div>
               <div class="row form-group">
                  <div class="col-md-3 text-primary font-weight-bold">Video </div>
                  <div class="col-md-9">
                      @if($value->getVideo())
                        <video width="100%" controls>
                           <source  src="{{ $value->getVideo() }}" type="video/mp4">
                        </video>
                     @endif

                  </div>
               </div>
             
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
               {!! $get_feedback->links() !!}
            </div>
         </div>
      </div>




               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
