@extends('backend.layouts.app')
@section('style')
<style type="text/css">
   .required {
      color: red;
   }

   button {
      box-shadow: none;
   }
</style>
@endsection

@section('content')
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
   <div class="subheader py-2 py-lg-12  subheader-transparent " id="kt_subheader">
      <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
         <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex flex-column">
               <h2 class="text-white font-weight-bold my-2 mr-5">
                  {{ __('task.Add Task') }}
               </h2>
               <div class="d-flex align-items-center font-weight-bold my-2">
                  <a href="{{ url('admin/staff/task/'.$user->id) }}" class="text-white text-hover-white opacity-75 hover-opacity-100"> {{ __('task.Task') }}</a>
                  <span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
                  <a href="" class="text-white text-hover-white opacity-75 hover-opacity-100">
                  {{ __('task.Add Task') }}
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
               <form class="form" action="" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="tab-content">
                     <!--begin::Tab-->
                     <div class="tab-pane show active px-7" id="kt_user_edit_tab_1" role="tabpanel">
                        <!--begin::Row-->
                        <div class="row">
                           <div class="col-xl-2"></div>
                           <div class="col-xl-12 my-2">
                            
                              <div class="form-group row">
                                 <label class="col-form-label col-3 text-lg-right text-left">{{ __('task.Title') }} <span class="required">*</span></label>
                                 <div class="col-9">
                                    <input class="form-control form-control-lg form-control-solid" placeholder="{{ __('task.Title') }}" type="text" name="title" />
                                 </div>
                              </div>

                              <div class="form-group row">
                                 <label class="col-form-label col-3 text-lg-right text-left">{{ __('task.Urgent') }} </label>
                                 <div class="col-9" style="margin-top: 10px;">
                                       <label class="checkbox"><input  type="checkbox" name="is_urgent"><span></span> </label>
                                 </div>
                              </div>


                              <div class="form-group row">
                                 <label class="col-form-label col-3 text-lg-right text-left">{{ __('task.End Date') }} <span class="required">*</span></label>
                                 <div class="col-9">
                                    <input class="form-control form-control-lg form-control-solid" placeholder="{{ __('task.End Date') }}" type="date" name="end_date" />
                                 </div>
                              </div>


                              <div class="form-group row">
                                 <label class="col-form-label col-3 text-lg-right text-left">{{ __('task.Description') }} <span class="required">*</span></label>
                                 <div class="col-9">
                                    <textarea name="description" class="form-control" id="kt-ckeditor-1"></textarea>
                                 </div>
                              </div>


                              
                              <div class="form-group row">
                                 <label class="col-form-label col-3 text-lg-right text-left">{{ __('task.Status') }} <span class="required">*</span></label>
                                 <div class="col-9">
                                       <select name="status" class="form-control form-control-lg form-control-solid">
                                          @foreach($get_status as $value)
                                             <option value="{{ $value->id }}">{{ $value->getName() }}</option>
                                          @endforeach
                                       </select>
                                 </div>
                              </div>
                      
                           </div>
                        </div>
                        <div class="card-footer pb-0">
                           <div class="row">
                              <div class="col-xl-2"></div>
                              <div class="col-xl-12">
                                 <div class="row">
                                    <div class="col-12 text-right">
                                       <button type="submit" class="btn btn-success font-weight-bold">{{ __('task.Submit') }}</button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!--end::Row-->
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')

<!--begin::Page Vendors(used by this page)-->
<script src="{{ url('assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js?v=7.0.6') }}"></script>
<!--end::Page Vendors-->

<!--begin::Page Scripts(used by this page)-->
<script src="{{ url('assets/js/pages/crud/forms/editors/ckeditor-classic.js?v=7.0.6') }}"></script>
<!--end::Page Scripts-->

<script type="text/javascript"></script>
@endsection
