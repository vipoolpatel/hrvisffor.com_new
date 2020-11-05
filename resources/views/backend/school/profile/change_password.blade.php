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
         <div class="d-flex align-items-center flex-wrap mr-1">
            <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none" id="kt_subheader_mobile_toggle">
            <span></span>
            </button>
            <div class="d-flex flex-column">
               <h2 class="text-white font-weight-bold my-2 mr-5">
                  {{ __('profile.Change Password') }}
               </h2>
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
               <div class="card card-custom card-stretch">
                  <div class="card-header py-3">
                     <div class="card-title align-items-start flex-column">
                        <h3 class="card-label font-weight-bolder text-dark">{{ __('profile.Change Password') }}</h3>
                     </div>
                  </div>
                  <form class="form" method="post" action="" enctype="multipart/form-data">
                     {{ csrf_field() }}
                     <div class="card-body">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label class="col-form-label">{{__("profile.Old Password")}}</label>
                                 <input type="password" name="old_password" class="form-control form-control-lg form-control-solid" placeholder="{{__("profile.Old Password")}}" required>
                              </div>
                           </div>
                        </div>

                       
                        <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                 <label class="col-form-label">{{__("profile.New Password")}}</label>
                                 <input type="password" name="new_password" class="form-control form-control-lg form-control-solid" placeholder="{{__("profile.New Password")}}" required>
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="col-form-label">{{__("profile.Confirm Password")}}</label>
                                 <input class="form-control form-control-lg form-control-solid" type="password"  placeholder="{{__("profile.Confirm Password")}}"  name="confirm_password" required />
                              </div>
                           </div>
                        </div>

                        <div class="form-group row">
                           <div class="col-lg-12 col-xl-12 text-right">
                              <br />
                              <button type="submit" class="btn btn-success mr-2">{{__("profile.Update Password")}}</button>
                           </div>
                        </div>
                     </div>
                     <!--end::Body-->
                  </form>
                  <!--end::Form-->
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
