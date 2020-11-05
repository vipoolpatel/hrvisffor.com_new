@extends('backend.layouts.app')
@section('style')
<style type="text/css">
  .required {
    color: red;
  }
</style>
@endsection

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
                  {{ __('position.Apply Teacher') }}                                
               </h2>
            </div>
         </div>
      </div>
   </div>
   <!--end::Subheader-->
   <!--begin::Entry-->
   <div class="d-flex flex-column-fluid">
      <!--begin::Container-->
      <div class=" container ">
         <!--begin::Card-->
         <div class="card card-custom">
            <!--begin::Card body-->
            <div class="card-header py-3">
               <div class="card-title align-items-start flex-column">
                  <h3 class="card-label font-weight-bolder text-dark">{{ __('position.Teacher ID') }} : {{$teacher->teacher_id}}</h3>
                  <span class="text-muted font-weight-bold font-size-sm mt-1">{{ __('position.Set Up Your Interview Date & Time') }}</span>
               </div>
            </div>
            <div class="card-body px-0" style="padding-bottom: 0px;">
               <form action="" method="post">
                  {{ csrf_field() }}
                  <div class="card-body" style="padding-top: 0px;padding-bottom: 0px;">
                     <div class="row">
                        <div class="col-md-2">
                           <div class="form-group">
                              <label class="col-form-label">{{ __('position.Date') }} <span class="required">*</span></label>
                              <input class="form-control form-control-lg form-control-solid" placeholder="{{ __('position.Date') }}" type="date" name="addmore[0][date]" required>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label class="col-form-label">{{ __('position.Time') }} <span class="required">*</span></label>
                              <input class="form-control form-control-lg form-control-solid" placeholder="Date" type="time" name="addmore[0][time]" required>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label class="col-form-label">{{ __('position.Duration') }} <span class="required">*</span></label>
                              <select name="addmore[0][duration]" required class="form-control form-control-lg form-control-solid">
                                 <option value="">{{ __('position.Select Minute') }}</option>
                                 <option value="15">15 {{ __('position.Minute') }}</option>
                                 <option value="20">20 {{ __('position.Minute') }}</option>
                                 <option value="25">25 {{ __('position.Minute') }}</option>
                                 <option value="30">30 {{ __('position.Minute') }}</option>
                              </select>
                           </div>
                        </div>
                       
                     </div>

                     <div class="row">
                        <div class="col-md-2">
                           <div class="form-group">
                              <input class="form-control form-control-lg form-control-solid" placeholder="{{ __('position.Date') }}" type="date" name="addmore[1][date]" required>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <input class="form-control form-control-lg form-control-solid" placeholder="{{ __('position.Time') }}" type="time" name="addmore[1][time]" required>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <select name="addmore[1][duration]" required class="form-control form-control-lg form-control-solid">
                                 <option value="">{{ __('position.Select Minute') }}</option>
                                 <option value="15">15 {{ __('position.Minute') }}</option>
                                 <option value="20">20 {{ __('position.Minute') }}</option>
                                 <option value="25">25 {{ __('position.Minute') }}</option>
                                 <option value="30">30 {{ __('position.Minute') }}</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-2" style="margin-top: 4px;">
                           <a href="javascript:;" id="add" class="btn btn-icon btn-light btn-hover-primary btn-md"><i class="flaticon2-plus-1 text-primary"></i></a>
                        </div>
                     </div>


                     <div id="dynamicTable"></div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label class="col-form-label">{{__("position.Notes")}} </label>
                              <textarea class="form-control form-control-lg form-control-solid" required name="note"></textarea>             
                           </div>
                        </div>
                     </div>
                     <hr/>
                     <div class="form-group row">
                        <div class="col-lg-12 col-xl-12 text-right">
                           <br />
                           <button type="submit" class="btn btn-success mr-2">{{ __('position.Apply Teacher') }}</button>
                        </div>
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
<script>
   var i = 5;


   $("#add").click(function(){
   
       ++i;
   
   $("#dynamicTable").append('<div class="row" id="RemoveRow'+i+'">\n\
   <div class="col-md-2">\n\
       <div class="form-group">\n\
          <input class="form-control form-control-lg form-control-solid" placeholder="{{ __('position.Date') }}" type="date" name="addmore['+i+'][date]" required>\n\
       </div>\n\
   </div>\n\
    <div class="col-md-2">\n\
       <div class="form-group">\n\
          <input class="form-control form-control-lg form-control-solid" placeholder="{{ __('position.Time') }}" type="time" name="addmore['+i+'][time]" required>\n\
       </div>\n\
    </div>\n\
    <div class="col-md-2">\n\
       <div class="form-group">\n\
          <select name="addmore['+i+'][duration]" required class="form-control form-control-lg form-control-solid">\n\
           <option value="">{{ __('position.Select Minute') }}</option>\n\
              <option value="15">15 {{ __('position.Minute') }}</option>\n\
              <option value="20">20 {{ __('position.Minute') }}</option>\n\
              <option value="25">25 {{ __('position.Minute') }}</option>\n\
              <option value="30">30 {{ __('position.Minute') }}</option>\n\
              </select>\n\
       </div>\n\
    </div>\n\
    <div class="col-md-2" style="margin-top: 5px;">\n\
           <a href="javascript:;" class="btn btn-icon btn-light btn-hover-danger btn-md DeleteRow" id="'+i+'"><i class="flaticon2-trash text-danger"></i></a>\n\
    </div>\n\
   </div>');
   
   
   });
   
   $('body').delegate('.DeleteRow','click',function(){
   var id = $(this).attr('id');
   $('#RemoveRow'+id).remove();
   
   }); 
   
</script>
@endsection
