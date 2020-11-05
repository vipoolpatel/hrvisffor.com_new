  @if(!empty($record))
   <form class="form" action="{{ url('admin/visa/edit/'.$record->id) }}" method="post" enctype="multipart/form-data">
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
                           <div class="col-xl-12 my-2">
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

                              <div class="form-group row">
                                 <label class="col-form-label col-3 text-lg-right text-left">{{ __('manage.Visa Type') }}</label>
                                 <div class="col-9">
                                       <select name="type" class="form-control form-control-lg form-control-solid">
                                             <option @if(!empty($record)) {{ ($record->type == 'teacher') ? 'selected' : '' }}  @endif value="teacher">{{ __('manage.Teacher') }}</option>
                                             <option @if(!empty($record)) {{ ($record->type == 'school') ? 'selected' : '' }}  @endif value="school">{{ __('manage.School') }}</option>
                                       </select>
                                 </div>
                              </div>


                              <!--end::Group-->


                              <div class="form-group">
                              <hr />
                              <h3>{{ __('manage.More Info') }}</h3>
                              </div>

                              <div class="form-group row">
                                 
                                   <div class="row col-md-12">
                                       <div class="col-6">
                                          {{ __('manage.English Name') }}
                                       </div>
                                       <div class="col-5">
                                           {{ __('manage.China Name') }}
                                       </div>
                                       <label class="col-form-label col-1 ">
                                       
                                       </label>
                                 </div>

                                 @if(!empty($record))

                                    @foreach($record->visa_info as $visa_info)

                                   <div class="row col-md-12" id="RemoveRecord{{ $visa_info->id }}">
                                          <div class="col-6">
                                             <input class="form-control form-control-lg form-control-solid" type="text" value="{{ $visa_info->name }}" name="rule[]" />
                                          </div>
                                          <div class="col-5">
                                             <input class="form-control form-control-lg form-control-solid" type="text" value="{{ $visa_info->ch_name }}" name="ch_rule[]" />
                                          </div>
                                          <label class="col-form-label col-1 ">
                                             <a href="javascript:;" id="{{ $visa_info->id }}" class="ApplyRemoveRecord btn btn-danger btn-sm">  {{ __('manage.Remove') }}</a>
                                          </label>
                                    </div>


                                    @endforeach

                                 @endif

                                 <div class="row col-md-12">
                                       <div class="col-6">
                                          <input class="form-control form-control-lg form-control-solid" type="text" value="" name="rule[]" />
                                       </div>
                                       <div class="col-5">
                                          <input class="form-control form-control-lg form-control-solid" type="text" value="" name="ch_rule[]" />
                                       </div>
                                       <label class="col-form-label col-1 ">
                                          <a href="javascript:;" id="addInfo" class="btn btn-warning btn-sm"> {{ __('manage.Add') }}</a>
                                       </label>
                                 </div>



                                 <div id="getInfo" style="width: 100%">
                                      
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
                                       <button type="submit" class="btn btn-success font-weight-bold">{{ __('manage.Submit') }}</button>
                                       <a href="{{ url('admin/visa') }}" class="btn btn-clean font-weight-bold">{{ __('manage.Cancel') }}</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!--end::Row-->
                     </div>
                  </div>
               </form>


@section('script')

<script type="text/javascript">
      var i = 1000;
      $('#addInfo').click(function(){
         var html = '';
         html = '<div class="row col-md-12" id="RemoveRecord'+i+'">\n\
                        <div class="col-6">\n\
                           <input class="form-control form-control-lg form-control-solid" type="text" value="" name="rule[]" />\n\
                        </div>\n\
                        <div class="col-5">\n\
                           <input class="form-control form-control-lg form-control-solid" type="text" value="" name="ch_rule[]" />\n\
                        </div>\n\
                     <label class="col-form-label col-1 ">\n\
                        <a href="javascript:;" id="'+i+'" class="btn btn-danger btn-sm ApplyRemoveRecord">Remove</a>\n\
                     </label>\n\
                 </div>';

           $('#getInfo').append(html);

      });


      $('body').delegate('.ApplyRemoveRecord','click',function(){
           var id = $(this).attr('id');
           $('#RemoveRecord'+id).remove();
      });


</script>

@endsection