@extends('backend.layouts.app')
@section('style')
<style type="text/css">
   .form-group {
   margin-bottom: 8px;
   }
   .required {
   color: red;
   }
   select {
   -moz-appearance:none; /* Firefox */
   -webkit-appearance:none; /* Safari and Chrome */
   appearance:none;
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
                  {{__("visa.Visa")}}
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
                        <h3 class="card-label font-weight-bolder text-dark">{{__("visa.Visa")}}</h3>
                        <span class="text-muted font-weight-bold font-size-sm mt-1">{{__("visa.Update your Visa")}}</span>
                     </div>
                  </div>
                  <div class="card-body" style="padding-top: 15px;">

                     <div class="row" style="margin-bottom: 30px;">
                        <div class="col-md-4"><b> {{__("visa.Working in China System")}}</b></div>
                        <div class="col-md-8">

                           <form action="{{ url('school/visa/china_system') }}" method="post" enctype="multipart/form-data">
                               {{ csrf_field() }}
                                 <div class="form-group">
                                    <div class="radio-inline">

                                       <label class="radio">
                                          <input type="radio" {{ ($user->china_system == 'Yes') ? 'checked' : '' }} required value="Yes" class="china_system" name="china_system">
                                          <span></span>   {{__("visa.Yes")}}
                                       </label>

                                       <label class="radio">
                                          <input type="radio"  {{ ($user->china_system == 'No') ? 'checked' : '' }} required value="No" class="china_system" name="china_system">
                                          <span></span> {{__("visa.No")}}
                                       </label>

                                    </div>
                                 </div>



                                <div id="show_china_system" style="{{ ($user->china_system == 'Yes') ? '' : 'display: none;' }}">

                                    <div class="form-group" style="margin-top: 10px">

                                       <label>{{__("visa.Account")}}</label>
                                       <input type="text" name="account_info" value="{{ $user->account_info }}" class="form-control form-control-lg form-control-solid china_system_required">

                                       <br />

                                       <label>{{__("visa.Password")}}</label>
                                       <input type="text" name="password_info" value="{{ $user->password_info }}" class="form-control form-control-lg form-control-solid china_system_required">

                                    </div>
                                

                                 </div> 



                                  <div class="form-group" style="margin-top: 20px">
                                    <button class="btn btn-sm btn-success">{{__("visa.Save")}}</button>
                                 </div>

                           </form>

                        </div>
                     </div>

                     
                   
                        @foreach($visa as $value_vi)

                              @php
                                 $display = '';
                                 $class = '';
                              @endphp

                              @if($user->china_system != "No")
                                 @if($value_vi->type == 'school')              
                                    @php
                                       $display = 'display: none;';
                                       $class = 'china_system_show_extra';
                                       
                                    @endphp
                                 @endif
                              @endif

                               @if($value_vi->type == 'school')              
                                    @php
                                       $class = 'china_system_show_extra';
                                    @endphp
                                 @endif

                           <form action="" method="post" enctype="multipart/form-data" class="{{ $class }}" style="{{ $display }}">

                              {{ csrf_field() }}

                              <input type="hidden" value="{{ $value_vi->id }}" name="visa_id">

                              <div class="row" style="margin-bottom: 30px;">
                                 <div class="col-md-4">
                                    <strong>{{ $value_vi->getName() }}</strong>
                                 </div>
                                 <div class="col-md-6">
                                    @foreach($value_vi->visa_info as $visa_info)
                                    <p>{{ $visa_info->getName() }}</p>
                                    @endforeach
                                    @if(!empty($value_vi->get_teacher_document()) && $value_vi->get_teacher_document()->status != 3)
                                    @php
                                    $get_teacher_document = $value_vi->get_teacher_document();
                                    @endphp
                                    <label style="margin-top: 10px;" class="label label-lg {{ $get_teacher_document->getstatus->class }} label-inline font-weight-bold">{{ $get_teacher_document->getstatus->name  }}</label>
                                    @if(!empty($get_teacher_document->getDocument()))
                                    <div style="margin-top: 20px;">
                                       <a target="_blank" href="{!! $get_teacher_document->getDocument() !!}" class="btn-sm btn btn-warning">{{__("visa.Download")}}</a>
                                    </div>
                                    @endif
                                    @else
                                    @if(!empty($value_vi->get_teacher_document()) && $value_vi->get_teacher_document()->status == 3)
                                    <label style="margin-top: 10px;" class="label label-lg {{ $value_vi->get_teacher_document()->getstatus->class }} label-inline font-weight-bold">{{ $value_vi->get_teacher_document()->getstatus->name  }}</label>
                                    <p style="margin-top: 10px;"><b>{{__("visa.Reason")}} :-</b> {{ $value_vi->get_teacher_document()->reason }}</p>
                                    @endif
                                    <div>
                                       <input type="file" required name="document">   
                                    </div>
                                    <button style="margin-top: 20px;" type="submit" class="btn btn-sm btn-success">{{__("visa.Save")}}</button>
                                    @endif
                                 </div>
                              </div>
                           </form>


                        @endforeach

                     @if($get_assign_visa->count() > 0)
                        <hr />
                        <div class="row">
                              <div class="col-md-12">
                                 <h3>{{__("visa.Teacher Document")}}</h3>
                              </div>
                        </div>
                        <hr />


                        @foreach($get_assign_visa as $assign_visa)
                           <div class="row" style="margin-bottom: 30px;">
                              <div class="col-md-4">
                                 <strong>{{ $assign_visa->visa->getName() }}</strong>
                              </div>
                              <div class="col-md-6">
                                   @foreach($assign_visa->visa->visa_info as $assign_visa_info)
                                    <p>{{ $assign_visa_info->getName() }}</p>
                                   @endforeach
                                 
                                 @if(!empty($assign_visa->getDocument()))
                                    <div style="margin-top: 20px;">
                                       <a target="_blank" href="{!! $assign_visa->getDocument() !!}" class="btn-sm btn btn-warning">{{__("visa.Download")}}</a>
                                    </div>
                                 @endif
                                
                              </div>
                           </div>
                        @endforeach
                        
                     @endif

                     


                  </div>
                  <!--end::Body-->
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
   
   $('.china_system').change(function(){
         var value = $(this).val();
         if(value == 'Yes') {
               $('#show_china_system').show();
               $('.china_system_show_extra').hide();
               $('.china_system_required').prop('required',true);
         }
         else {
               $('#show_china_system').hide();
               $('.china_system_show_extra').show();
               
               $('.china_system_required').prop('required',false);
         }
   });

</script>
@endsection
