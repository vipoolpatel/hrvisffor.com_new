
@extends('backend.layouts.app')
@section('style')
<style type="text/css">
   .mb-lg-0, .my-lg-0 {
       margin-bottom: 13px !important;
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
   .margin-card {
   margin-left: 3px;margin-right: 3px;
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

@if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2) 

<div class="container-fluid py-10" style="padding-bottom: 0px !important;">
   <div style="background: #ffff;padding: 25px;border-radius: 10px;padding-bottom: 1px !important;">
      <form id="FilterForm" action="" method="post">

         <div class="row mb-6">
            <div class="col-lg-2 mb-lg-0 mb-6">
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
            <div class="col-lg-2 mb-lg-0 mb-6">
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


            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.Visa Type') }}</label>
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

            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.School ID') }}</label>
               <input type="text" class="form-control common_change" name="school_id">
            </div>
          
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.School Name') }}</label>
               <input type="text" class="form-control common_change" name="school_name">
            </div>


             <div class="col-lg-2 mb-lg-0 mb-6">
                <label>{{ __('position.Registered Date') }}</label>
                <select class="form-control common_change" name="register_date">
                   <option value="">{{ __('position.Select') }}</option>
                   <option {{ (Request::get('register_date') == 'Latest') ? 'selected' : '' }} value="Latest">{{ __('position.Latest') }}</option>
                   <option  {{ (Request::get('register_date') == 'Oldest') ? 'selected' : '' }} value="Oldest">{{ __('position.Oldest') }}</option>
                </select>
             </div>


            <div class="col-lg-4 mb-lg-0 mb-6" style="margin-top: 25px;">
                  <a href="javascript:;" id="1" class="btn btn-success font-weight-bolder font-size-sm SchoolName"><i class="flaticon2-list-2 "></i> {{ __('position.Show School Name') }}</a>
                  <a href="javascript:;" id="2" class="btn btn-danger font-weight-bolder font-size-sm SchoolName"><i class="flaticon2-list-2 "></i> {{ __('position.Hide School Name') }}</a>
                  
             </div>

         </div>
      </form>
   </div>
</div>



  @if(!empty($getuser))
  <div class="container-fluid py-10" style="padding-bottom: 0px !important;">
     <div style="background: #ffff;padding: 25px;border-radius: 10px;padding-bottom: 1px !important;">
           <div class="row mb-6 info-list" style="margin-bottom: 12px !important;">    
            
              <div class="col-lg-2  mb-lg-0 mb-6">
                   <img style="height: 50px;margin-right: 10px;border-radius: 40px;width: 50px;" src="{!! $getuser->getImage() !!}">  <a href="{{ url('school/matched-teacher?user_id='.$getuser->id) }}">{{ $getuser->name }} ({{ $getuser->teacher_id }})</a>
              </div>

              @if(!empty($getuser->nationality))
              <div class="col-lg-2  mb-lg-0 mb-6" style="margin-top: 10px;">
                   @if(!empty($getuser->nationality->getImage())) <img src="{!! $getuser->nationality->getImage() !!}" style="width: 30px;height: 30px;margin-right: 10px;">@endif {{ $getuser->nationality->name }}
              </div>
              @endif

              @if(!empty($getuser->education_level))
              <div class="col-lg-2  mb-lg-0 mb-6" style="margin-top: 10px;">
                    <span class="title">{{ __('position.Educational Level') }}</span> {{ $getuser->education_level->getName() }}
              </div>
              @endif

              @if(!empty($getuser->teacher_type))
              <div class="col-lg-2  mb-lg-0 mb-6" style="margin-top: 10px;">
                    <span class="title">{{ __('position.Teacher type') }}</span> {{ $getuser->teacher_type->getName() }}
              </div>
              @endif

              @if(!empty($getuser->colour))
              <div class="col-lg-1  mb-lg-0 mb-6" style="margin-top: 10px;">
                    <span class="title">{{ __('position.Colour') }}</span> {{ $getuser->colour->getName() }}
              </div>
              @endif

              @if(!empty($getuser->staff))
              <div class="col-lg-2  mb-lg-0 mb-6" style="margin-top: 10px;">
                    <span class="title">{{ __('position.Staff') }}</span> {{ !empty($getuser->staff->name) ? $getuser->staff->name : '-' }}
              </div>
              @endif
              
              @if(!empty($getuser->staff))
                <div class="col-lg-1  mb-lg-0 mb-6" style="margin-top: 6px;">

                      <input type="hidden" value="{{ url('teacher-profile/'.$getuser->username) }}" id="CopyLink{{ $getuser->id }}">

                      <a href="javascript:;" onclick="CopyLink({{ $getuser->id }})" ><i class="flaticon-reply icon-2x title"></i></a>
                      <a target="_blank" href="{{ url('teacher-profile/'.$getuser->username) }}" ><i class="flaticon-eye icon-2x title"></i></a>
                      <a target="_blank" href="{{ url('admin/teacher/edit/'.$getuser->id) }}" ><i class="flaticon-edit-1 icon-2x title"></i></a>
                </div>
              @endif
            

           </div>
      </div>
  </div>
  @endif

@endif


<div class="row" style="margin: auto;">
   @include('layouts._message')
</div>


<div class="container-fluid py-10" id="user_datatable_ajax">
      @include('frontend.teacher._matched_position')
</div>


@endsection

@section('script')
<script type="text/javascript">

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


   
  $('body').on('click', '.SaveJob', function(e) {
      e.preventDefault(); 
      var job_id = $(this).attr('id');
      $.ajax({
            url: "{{ url('teacher/save_job') }}",
            type: "POST",
            data:{
              "_token": "{{ csrf_token() }}",
                job_id:job_id,
             },
             dataType:"json",
             success:function(response){
                if(response.success)
                {
                    alert('Job successfully save');
                    $('.SaveJobClass'+job_id).removeClass('text-light');
                    $('.SaveJobClass'+job_id).addClass('text-success');
                }
                else
                {
                    alert('Job save successfully removed');
                    $('.SaveJobClass'+job_id).removeClass('text-success');
                    $('.SaveJobClass'+job_id).addClass('text-light');
                }                
             },
         });
  });

  
  $('body').on('click', '.ChangeBatch', function(e) {
       e.preventDefault();
       var page_id = $(this).attr('id');
       var url = '{{ url('teacher/matched-position?page=') }}'+page_id;
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



  $('.common_change').on('change keyup', function (e) {
         e.preventDefault();
         get_data();
   });


    function get_data() {
        $.ajax({
              type: "GET",
              url: "{{ url('teacher/matched-position/'.$slug) }}",
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