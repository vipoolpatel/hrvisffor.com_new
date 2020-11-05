  @if(!empty($record))
   <form class="form" action="{{ url('admin/faq/edit/'.$record->id) }}" method="post" enctype="multipart/form-data">
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
                                 <label class="col-form-label col-3 text-lg-right text-left"> {{ __('manage.Category') }}</label>
                                 <div class="col-9">
                                    @php
                                    $faq_category_id = !empty($record->faq_category_id) ? $record->faq_category_id : '';
                                    @endphp
                                    <select class="form-control form-control-lg form-control-solid" name="faq_category_id">
                                       <option value="">{{ __('manage.Select Category') }}</option>
                                       @foreach ($getfaqcategory as $va)
                                            <option {{ ($faq_category_id == $va->id) ? 'selected' : '' }} value="{{ $va->id }}">{{ $va->getName() }}</option>                                    
                                       @endforeach
                                    </select>
                                 </div>
                              </div>

                              <div class="form-group row">
                                 <label class="col-form-label col-3 text-lg-right text-left">{{ __('manage.Title') }}</label>
                                 <div class="col-9">
                                    <input class="form-control form-control-lg form-control-solid" type="text" value="{{ old('title',!empty($record->title) ? $record->title : '') }}" name="title" />
                                    <div style="color: red;">{{ $errors->first('title') }}</div>
                                 </div>
                              </div>
                              <!--end::Group-->
                              <!--begin::Group-->
                              <div class="form-group row">
                                 <label class="col-form-label col-3 text-lg-right text-left"> {{ __('manage.China Title') }}</label>
                                 <div class="col-9">
                                    <input class="form-control form-control-lg form-control-solid" type="text" value="{{ old('ch_title',!empty($record->ch_title) ? $record->ch_title : '') }}" name="ch_title" />
                                 </div>
                              </div>
                              <!--end::Group-->
                               <div class="form-group row">
                                 <label class="col-form-label col-3 text-lg-right text-left"> {{ __('manage.Description') }}</label>
                                 <div class="col-9">
                                    <textarea class="form-control form-control-lg form-control-solid" name="description" />{{ old('description',!empty($record->description) ? $record->description : '') }}</textarea>
                                 </div>
                              </div>

                               <div class="form-group row">
                                 <label class="col-form-label col-3 text-lg-right text-left">{{ __('manage.China Description') }}</label>
                                 <div class="col-9">
                                    <textarea class="form-control form-control-lg form-control-solid" name="ch_description" />{{ old('ch_description',!empty($record->ch_description) ? $record->ch_description : '') }}</textarea>
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
                                       <button type="submit" class="btn btn-light-primary font-weight-bold">{{ __('manage.Submit') }}</button>
                                       <a href="{{ url('admin/faq') }}" class="btn btn-clean font-weight-bold">{{ __('manage.Cancel') }}</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!--end::Row-->
                     </div>
                  </div>
               </form>