  @if(!empty($record))
 <form class="form" action="{{ url('admin/school-type/edit/'.$record->id) }}" method="post" enctype="multipart/form-data">
 @else
<form class="form" action="" method="post" enctype="multipart/form-data">
 @endif
 
                  {{ csrf_field() }}
                  <div class="tab-content">
                     <!--begin::Tab-->
                     <div class="tab-pane show active px-7" id="kt_user_edit_tab_1" role="tabpanel">
                        <!--begin::Row-->
                        <div class="row">
                           <div class="col-xl-2"></div>
                           <div class="col-xl-7 my-2">
                             <!--begin::Group-->
                               <div class="form-group row">
                               <label class="col-form-label col-3 text-lg-right text-left"> {{ __('manage.Name') }}</label>
                                    <div class="col-9">
                                       <input class="form-control form-control-lg form-control-solid" type="text" value="{{ old('name',!empty($record->name) ? $record->name : '') }}" name="name" />
                                       <div style="color: red;">{{ $errors->first('name') }}</div>
                                    </div>
                                 </div>
                                 <!--end::Group-->
                                 <!--begin::Group-->
                                 <div class="form-group row">
                                    <label class="col-form-label col-3 text-lg-right text-left">{{ __('manage.China Name') }}</label>
                                    <div class="col-9">
                                       <input class="form-control form-control-lg form-control-solid" type="text" value="{{ old('ch_name',!empty($record->ch_name) ? $record->ch_name : '') }}" name="ch_name" />
                                    </div>
                                 </div>
                              <!--end::Group-->
                             
                           </div>
                        </div>
                        <div class="card-footer pb-0">
                           <div class="row">
                              <div class="col-xl-2"></div>
                              <div class="col-xl-7">
                                 <div class="row">
                                    <div class="col-3"></div>
                                    <div class="col-9">
                                       <button type="submit" class="btn btn-light-primary font-weight-bold">{{ __('manage.Submit') }}</button>
                                       <a href="{{ url('admin/school-type') }}" class="btn btn-clean font-weight-bold">{{ __('manage.Cancel') }}</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!--end::Row-->
                     </div>
                  </div>
               </form>