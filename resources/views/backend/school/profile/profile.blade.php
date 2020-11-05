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
                  {{ __('profile.Profile') }}
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
                        <h3 class="card-label font-weight-bolder text-dark">{{ __('profile.Personal Information') }}</h3>
                        <span class="text-muted font-weight-bold font-size-sm mt-1">{{ __('profile.Update your personal information') }}</span>
                     </div>
                  </div>
                  <form class="form" method="post" action="" enctype="multipart/form-data">
                     {{ csrf_field() }}
                     <div class="card-body">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="col-form-label">{{__("profile.Username")}}</label>
                                 <input class="form-control form-control-lg form-control-solid" readonly placeholder="{{__("profile.Username")}}" value="{!! $user->username !!}" type="text" name="username" />
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="col-form-label">{{__("profile.Email Address")}}</label>
                                 <input class="form-control form-control-lg form-control-solid" type="email"  required placeholder="{{__("profile.Email Address")}}" value="{!! $user->email !!}" name="email"/>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="col-form-label">{{__("profile.Contact name")}}</label>
                                 <input class="form-control form-control-lg form-control-solid" type="text" required value="{!! $user->name !!}" placeholder="{{__("profile.Contact name")}}" name="name" />
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="col-form-label">{{__("profile.Contact phone number")}}</label>
                                 <input class="form-control form-control-lg form-control-solid" type="text" required placeholder="{{__("profile.Contact phone number")}}" value="{!! $user->phone_number !!}" name="phone_number"/>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="col-form-label">{{__("profile.Wechat ID")}}</label>
                                 <input class="form-control form-control-lg form-control-solid" type="text" value="{!! $user->wechat_id !!}" placeholder="{{__("profile.Wechat ID")}}"  name="wechat_id" />
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="col-form-label">{{__("profile.School Name")}}</label>
                                 <input class="form-control form-control-lg form-control-solid" type="text" required placeholder="{{__("profile.School Name")}}" value="{!! $user->school_name !!}" name="school_name"/>
                              </div>
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-lg-12 col-xl-12 text-right">
                              <br />
                              <button type="submit" class="btn btn-success mr-2">{{__("profile.Save")}}</button>
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
