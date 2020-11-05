@extends('backend.layouts.app')
@section('style')
<style type="text/css">
   .rating-color{
   color: orange;
   }
   .color-form-white label {
   color: #fff;
   }
   .color-form-select select {
   -moz-appearance:none; /* Firefox */
   -webkit-appearance:none; /* Safari and Chrome */
   appearance:none;
   }
   
   .form-group {
   margin-bottom: 8px;
   }
   .card-img img {
   width: 100%;
   padding: 6px;
   border-radius: 10px;
   }
   .header-profile
   {
   top: 35px;
   padding: 0px;
   }
   .card-center {
   text-align: center;
   }
   .right-side-line {
   border-right: 1px solid;
   }
   .left-side-padding{
   padding-left: 10px !important;
   }
   .margin-left-card {
      margin-left: 5px;margin-right: 5px;
   }

   @media (max-width: 575px){
      .col-sm-3 {
         -webkit-box-flex: 0;
         -ms-flex: 0 0 25%;
         flex: 0 0 25%;
         flex-shrink: 0;
         max-width: 44%;
      }
      .header-profile {
      top: 0px;
      }
      .right-side-line {
      border-right: 0px solid;
      }
      .left-side-padding{
          padding-left: 0px !important;
      }

   }
</style>
@endsection



@section('content')
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-12  subheader-transparent " id="kt_subheader">
   <div class=" container  d-flex  justify-content-between flex-wrap ">
      <h2  class="text-white font-weight-bold my-2 mr-5" style="margin-bottom: 20px !important;">{{ __('position.Jobs') }}</h2>
      <a href="{{ url('admin/job/add') }}" class="btn btn-transparent-white font-weight-bold  py-3 px-6 mr-2" style="margin-bottom: 15px;">
      <i class="flaticon2-plus-1"></i> {{ __('position.Add') }}
      </a>
      <form id="FilterForm" class="kt-form kt-form--fit mb-15 color-form-select" style="width: 100%;background: #fff;padding: 20px;border-radius: 10px;padding-bottom: 0px;margin-bottom: 0px !important;">

         <div class="row col-lg-12">
           @include('layouts._message')
         </div>

            
         <div class="row mb-6">
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.School Type') }}</label>
               <select class="form-control common_change" name="type_of_school_id">
                  <option value="">{{ __('position.Select') }}</option>
                  @foreach($get_school_type as $value_school_type)
                  <option {{ (Request::get('type_of_school_id') == $value_school_type->id) ? 'selected' : '' }} value="{{ $value_school_type->id }}">{{ $value_school_type->getName() }}</option>
                  @endforeach
               </select>
            </div>
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.Credit Level') }}</label>
               <select class="form-control common_change" name="credit_level_id">
                  <option value="">{{ __('position.Select') }}</option>
                  @foreach($get_credit_level as $credit_rating)
                  <option {{ (Request::get('credit_level_id') == $credit_rating->id) ? 'selected' : '' }} value="{{ $credit_rating->id }}">{{ $credit_rating->getName() }}</option>
                  @endforeach
               </select>
            </div>
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.General Location') }}</label>
               <select class="form-control common_change" name="general_location_id">
                  <option value="">{{ __('position.Select') }}</option>
                  @foreach($get_general_location as $value_location)
                  <option {{ (Request::get('credit_level_id') == $value_location->id) ? 'selected' : '' }} value="{{ $value_location->id }}">{{ $value_location->getName() }}</option>
                  @endforeach
               </select>
            </div>
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.Native English') }}</label>
               <select class="form-control common_change" name="is_english_speaker">
                  <option value="">{{ __('position.Select') }}</option>
                  @foreach($get_native_english as $native_english)
                     <option {{ (Request::get('is_english_speaker') == $native_english->name) ? 'selected' : '' }} value="{{ $native_english->name }}">{{ $native_english->getName() }}</option>
                  @endforeach
               </select>
            </div>
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.Working Hours') }}</label>
               <select class="form-control common_change" name="working_schedule_id">
                  <option value="">{{ __('position.Select') }}</option>
                  @foreach($get_working_schedule as $working_schedule)
                  <option {{ (Request::get('working_schedule_id') == $working_schedule->id) ? 'selected' : '' }} value="{{ $working_schedule->id }}">{{ $working_schedule->getName() }}</option>
                  @endforeach
               </select>
            </div>
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.Boarding Time') }}</label>
               <select class="form-control common_change" name="teacher_start_id">
                  <option value="">{{ __('position.Select') }}</option>
                  @foreach($get_start_date as $value_start)
                  <option {{ (Request::get('teacher_start_id') == $value_start->id) ? 'selected' : '' }} value="{{ $value_start->id }}">{{ $value_start->getName() }}</option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="row mb-6">
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.Position Title') }}</label>
               <select class="form-control common_change" name="position_id">
                  <option value="">{{ __('position.Select') }}</option>
                  @foreach($get_position as $position)
                  <option {{ (Request::get('position_id') == $position->id) ? 'selected' : '' }} value="{{ $position->id }}">{{ $position->getName() }}</option>
                  @endforeach
               </select>
            </div>
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.Emergency Level') }}</label>
               <select class="form-control common_change" name="emergency_level_id">
                  <option value="">{{ __('position.Select') }}</option>
                  @foreach($get_emergency_level as $emergency_level)
                  <option {{ (Request::get('emergency_level_id') == $emergency_level->id) ? 'selected' : '' }} value="{{ $emergency_level->id }}">{{ $emergency_level->getName() }}</option>
                  @endforeach
               </select>
            </div>
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.State') }}</label>
               <select class="form-control StateChange common_change" name="state_id" >
                  <option value="">{{ __('position.Select') }}</option>
                  @foreach($get_state as $state)
                  <option {{ (Request::get('state_id') == $state->id) ? 'selected' : '' }} value="{{ $state->id }}">{{ $state->getName() }}</option>
                  @endforeach
               </select>
            </div>
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.City') }}</label>
               <select class="form-control common_change" name="city_id"  id="getCity">
                  <option value="">{{ __('position.Select') }}</option>
               </select>
            </div>

         
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.Class Size') }}</label>
               <select class="form-control common_change" name="class_size">
                  <option value="">{{ __('position.Select') }}</option>
                  @foreach($get_class_size as $class_size)
                  <option {{ (Request::get('class_size') == $class_size->id) ? 'selected' : '' }} value="{{ $class_size->id }}">{{ $class_size->getName() }}</option>
                  @endforeach
               </select>
            </div>

            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.Staff') }}</label>
               <select class="form-control common_change" name="staff_id">
                  <option value="">{{ __('position.Select') }}</option>
                  @foreach($get_record_staff as $staff)
                     <option {{ (Request::get('staff_id') == $staff->id) ? 'selected' : '' }} value="{{ $staff->id }}">{{ $staff->getName() }}</option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="row mb-6">
           
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.Teacher Visa Type') }}</label>
               <select class="form-control common_change" name="visa_type_id">
                  <option value="">{{ __('position.Select') }}</option>
                  @foreach($get_visa_type as $visa_type)
                  <option {{ (Request::get('visa_type_id') == $visa_type->id) ? 'selected' : '' }} value="{{ $visa_type->id }}">{{ $visa_type->getName() }}</option>
                  @endforeach
               </select>
            </div>
           
      
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.Working Schedule') }}</label>
               <select class="form-control common_change" name="working_schedule_id" >
                  <option value="">{{ __('position.Select') }}</option>
                  @foreach($get_working_schedule as $working_schedule)
                  <option {{ (Request::get('working_schedule_id') == $working_schedule->id) ? 'selected' : '' }} value="{{ $working_schedule->id }}">{{ $working_schedule->getName() }}</option>
                  @endforeach
               </select>
            </div>
      
      
      
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.Min Salary') }}</label>
               <select class="form-control common_change" name="salary_minimum_id">
                  <option value="">{{ __('position.Select') }}</option>
                  @foreach($get_salary as $salary)
                  <option {{ (Request::get('salary_minimum_id') == $salary->id) ? 'selected' : '' }} value="{{ $salary->id }}">{{ $salary->getName() }}</option>
                  @endforeach
               </select>
            </div>

            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.Max Salary') }}</label>
               <select class="form-control common_change" name="salary_maximum_id">
                  <option value="">{{ __('position.Select') }}</option>
                  @foreach($get_salary as $salary)
                  <option {{ (Request::get('salary_maximum_id') == $salary->id) ? 'selected' : '' }} value="{{ $salary->id }}">{{ $salary->getName() }}</option>
                  @endforeach
               </select>
            </div>
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.Min Age') }}</label>
               <select class="form-control common_change" name="minimum_age">
                  <option value="">{{ __('position.Select') }}</option>
                  @for($i=18; $i<=65; $i++)
                  <option {{ (Request::get('minimum_age') == $i) ? 'selected' : '' }} value="{{ $i }}">{{ $i }} {{__("ysr")}}</option>
                  @endfor
               </select>
            </div>
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.Max Age') }}</label>
               <select class="form-control common_change" name="maximum_age">
                  <option value="">{{ __('position.Select') }}</option>
                  @for($i=18; $i<=65; $i++)
                  <option {{ (Request::get('maximum_age') == $i) ? 'selected' : '' }} value="{{ $i }}">{{ $i }} {{__("ysr")}}</option>
                  @endfor
               </select>
            </div>
         </div>
         <div class="row mb-6">
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.School ID') }}</label>
               <input type="text" class="form-control common_change" name="school_id">
            </div>
          
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.School Name') }}</label>
               <input type="text" class="form-control common_change" name="school_name">
            </div>
            
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.Note') }}</label>
               <input type="text" class="form-control common_change" name="note">
            </div>

           

               <div class="col-lg-2  mb-lg-0 mb-6">
                  <label>{{ __('position.Registered Date') }}</label>
                  <select class="form-control common_change" name="register_date">
                     <option value="">{{ __('position.Select') }}</option>
                     <option {{ (Request::get('register_date') == 'Latest') ? 'selected' : '' }} value="Latest">{{ __('position.Latest') }}</option>
                     <option  {{ (Request::get('register_date') == 'Oldest') ? 'selected' : '' }} value="Oldest">{{ __('position.Oldest') }}</option>
                  </select>
               </div>

             <div class="col-lg-12  mb-lg-0 mb-6" style="margin-top: 25px;">
                <input type="hidden" class="form-control getShowType" name="type" value="{{ !empty(Request::get('type')) ? Request::get('type') : 'card' }}">
                <a href="javascript:;" id="list" class="btn btn-success font-weight-bolder font-size-sm ShowType">
                      <i class="flaticon2-list-2 "></i> {{ __('position.List Show') }}
                </a>
                <a href="javascript:;" id="card" class="btn btn-success font-weight-bolder font-size-sm ShowType">
                    <i class="flaticon2-list-2 "></i> {{ __('position.Card Show') }}
                </a>

                <a href="javascript:;" id="1" class="btn btn-success font-weight-bolder font-size-sm SchoolName"><i class="flaticon2-list-2 "></i> {{ __('position.Show School Name') }}</a>

                <a href="javascript:;" id="2" class="btn btn-danger font-weight-bolder font-size-sm SchoolName"><i class="flaticon2-list-2 "></i> {{ __('position.Hide School Name') }}</a>
            </div>


         </div>
      </form>



   </div>
</div>
<!--end::Subheader-->

   <div class="d-flex flex-column-fluid" id="user_datatable_ajax">
      <!--begin::Container-->
      @if(!empty(Request::get('type')) && Request::get('type') == 'list')
        @include('backend.admin.school.job._list')
      @else
        @include('backend.admin.school.job._list_card')                
      @endif
       
      <!--end::Container-->
   </div>

</div>
@endsection
@section('script')
<script type="text/javascript">

$('body').delegate('.ChangeMatchStatus','change',function(){

   var id = $(this).attr('id');
   var status = $(this).val();
   $.ajax({
      url: "{{ url('admin/job/match_status_job') }}",
      type: "POST",
      data:{
        "_token": "{{ csrf_token() }}",
          id:id,
          status:status,
       },
       dataType:"json",
       success:function(response){
           alert(response.success);
       },
   });
});



   $('.SchoolName').click(function(){
        var id = $(this).attr('id');
        if(id == 1)
        {
           $('.show_hide_school_name').show();
        }
        else
        {
           $('.show_hide_school_name').hide();
        }         
   });

  

    $('body').on('click', '.pagination a', function(e) {
          e.preventDefault();
          var url = $(this).attr('href');
          $.ajax({
              type: "GET",
              url: url,
              data: $('#FilterForm').serialize(),
              dataType: "json",
              success: function (data) {
                  $('#user_datatable_ajax').html(data.success);
                   window.history.pushState("", "", data.url);
              },
              error: function (data) {
              }
          });
          
       });

    $('.ShowType').on('click', function (e) {
        var value = $(this).attr('id');
        $('.getShowType').val(value);
        get_data();
    });

  $('.common_change').on('change keyup', function (e) {
        e.preventDefault();
        get_data();
   });

    var xhr;

    function get_data()
    {
       if(xhr && xhr.readyState != 4){
        xhr.abort();
      }

       xhr = $.ajax({
              type: "GET",
              url: "{{ url('admin/job') }}",
              data: $('#FilterForm').serialize(),
              dataType: "json",
              success: function (data) {
                  $('#user_datatable_ajax').html(data.success);
                  window.history.pushState("", "", data.url);
              },
              error: function (data) {
                
              }
        });
    }



$('body').delegate('.get_credit_level','change',function(){
   var id = $(this).attr('id');
   var value = $(this).val();
   $.ajax({
      url: "{{ url('admin/job/credit_level_update') }}",
      type: "POST",
      data:{
        "_token": "{{ csrf_token() }}",
          id:id,
          value:value,
       },
       dataType:"json",
       success:function(response){
           alert(response.success);
       },
   });
   

});


$('body').delegate('.get_emergency_level','change',function(){
   var id = $(this).attr('id');
   var value = $(this).val();
   $.ajax({
      url: "{{ url('admin/job/emergency_level_update') }}",
      type: "POST",
      data:{
        "_token": "{{ csrf_token() }}",
          id:id,
          value:value,
       },
       dataType:"json",
       success:function(response){
           alert(response.success);
       },
   });
   

});



   $('body').delegate('.StateChange','change',function() {
         var state_id = $(this).val();
         $.ajax({
            url: "{{ url('common/getStateCity') }}",
            type: "POST",
            data:{
              "_token": "{{ csrf_token() }}",
                state_id:state_id,
             },
             dataType:"json",
             success:function(response){
                  $('#getCity').html(response.html);
             },
         });
   });

</script>
@endsection