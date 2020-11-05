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
                   {{ __('manage.Setting') }}
               </h2>
               <!--end::Title-->
           
            </div>
            <!--end::Heading-->
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
            <div class="card-body px-0">
              
               






  
<form class="form" action="" method="post" enctype="multipart/form-data">
   {{ csrf_field() }}
   <div class="tab-content">

      <div class="tab-pane show active px-7" id="kt_user_edit_tab_1" role="tabpanel">
         
         <div class="row">
            <div class="col-xl-2"></div>
            <div class="col-xl-7 my-2">
            
               <div class="form-group row">
                  <label class="col-form-label col-3 text-lg-right text-left">  {{ __('manage.Handbook') }}</label>
                  <div class="col-9">
                     <input class="form-control form-control-lg form-control-solid" name="handbook" type="file"  />
                     @if(!empty($record->get_handbook()))
                        <a href="{{ $record->get_handbook() }}" target="_blank" class="btn btn-warning btn-sm"> {{ __('manage.Download') }}</a>
                     @endif
                  </div>
               </div>
              
               <div class="form-group row">
                  <label class="col-form-label col-3 text-lg-right text-left"> {{ __('manage.Contract Template') }}</label>
                  <div class="col-9">
                     <input class="form-control form-control-lg form-control-solid" type="file" name="contract_document" />
                     @if(!empty($record->get_contract_document()))
                        <a href="{{ $record->get_contract_document() }}" target="_blank" class="btn btn-warning btn-sm">{{ __('manage.Download') }}</a>
                     @endif
                  </div>
               </div>
              
            </div>
         </div>

         <div class="card-footer pb-0">
            <div class="row">
               <div class="col-xl-2"></div>
               <div class="col-xl-7">
                  <div class="row">
                     <div class="col-3"></div>
                     <div class="col-9">
                        <button type="submit" class="btn btn-success font-weight-bold">{{ __('manage.Submit') }}</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
       
      </div>
   </div>
</form>















            </div>
            <!--begin::Card body-->
         </div>
      </div>
   </div>
</div>
@endsection
