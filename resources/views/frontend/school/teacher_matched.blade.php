@extends('backend.layouts.app')
@section('style')
<style type="text/css">
   .form-group {
   margin-bottom: 8px;
   }
  .margin-card {
   margin-left: 3px;margin-right: 3px;
   }
   .animated-section {
   padding-bottom: 0px
   }
   .right-side-line {
   border-right: 1px solid;
   }
   .left-side-padding{
   padding-left: 25px !important;
   }
   .info-list ul {
   font-size: 16px;
   }
   .font-size {
   font-size: 16px !important;
   }
   @media (max-width: 575px){
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
          <input type="hidden" name="recommended" value="{{ $recommended }}">
         <div class="row mb-6">
            <div class="col-lg-2 mb-lg-0 mb-6">
               <label>{{ __('position.Current Location') }}</label>
               <select class="form-control common_change" name="current_location_id">
                  <option value="">{{ __('position.Select') }}</option>
                  @foreach($get_current_location as $value_lo)
                  <option value="{{ $value_lo->id }}">{{ $value_lo->getName() }}</option>
                  @endforeach
               </select>
            </div>
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.Education Level') }}</label>
               <select class="form-control common_change" name="educaton_level_id">
                  <option value="">{{ __('position.Select') }}</option>
                  @foreach($get_educaton_level as $value_edu)
                  <option value="{{ $value_edu->id }}">{{ $value_edu->getName() }}</option>
                  @endforeach
               </select>
            </div>
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.Min Salary') }}</label>
               <select class="form-control common_change" name="minimum_salary_id">
                  <option value="">{{ __('position.Select') }}</option>
                  @foreach($get_salary as $value_min)
                  <option value="{{ $value_min->id }}">{!! $value_min->getName() !!}</option>
                  @endforeach
               </select>
            </div>
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.Max Salary') }}</label>
               <select class="form-control common_change" name="maximum_salary_id">
                  <option value="">{{ __('position.Select') }}</option>
                  @foreach($get_salary as $value_max)
                  <option value="{{ $value_max->id }}">{!! $value_max->getName() !!}</option>
                  @endforeach
               </select>
            </div>
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.Native') }}</label>
               <select class="form-control common_change" name="is_native_english">
                  <option value="">{{ __('position.Select') }}</option>
                  <option value="Yes">{{ __('position.Yes') }}</option>
                  <option value="No">{{ __('position.No') }}</option>
               </select>
            </div>
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.Subject') }}</label>
               <select class="form-control common_change" name="is_education_english">
                  <option value="">{{ __('position.Select') }}</option>
                  <option value="Yes">{{ __('position.Yes') }}</option>
                  <option value="No">{{ __('position.No') }}</option>
               </select>
            </div>
         </div>
         <div class="row mb-6">
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.Colour') }}</label>
               <select class="form-control common_change" name="color_id">
                  <option value="">{{ __('position.Select') }}</option>
                  @foreach($get_colour as $value_co)
                  <option value="{{ $value_co->id }}">{{ $value_co->getName() }}</option>
                  @endforeach
               </select>
            </div>
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.Job Type') }}</label>
               <select class="form-control common_change" name="job_type_id">
                  <option value="">{{ __('position.Select') }}</option>
                  @foreach($get_job_type as $value_job)
                  <option value="{{ $value_job->id }}">{{ $value_job->getName() }}</option>
                  @endforeach
               </select>
            </div>
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.School Type') }}</label>
               <select class="form-control common_change" name="school_type_id">
                  <option value="">{{ __('position.Select') }}</option>
                  @foreach($get_school_type as $value_school_type)
                  <option value="{{ $value_school_type->id }}">{{ $value_school_type->getName() }}</option>
                  @endforeach
               </select>
            </div>
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.State') }}</label>
               <select class="form-control StateChange common_change" name="state_id" >
                  <option value="">{{ __('position.Select') }}</option>
                  @foreach($get_state as $value_s)
                  <option value="{{ $value_s->id }}">{{ $value_s->getName() }}</option>
                  @endforeach
               </select>
            </div>
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.City') }}</label>
               <select class="form-control common_change" id="getCity" name="city_id">
                  <option value="">{{ __('position.Select') }}</option>
               </select>
            </div>
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.Registered Date') }}</label>
               <select class="form-control common_change" name="register_date">
                  <option value="">{{ __('position.Select') }}</option>
                  <option {{ (Request::get('register_date') == 'Latest') ? 'selected' : '' }} value="Latest">{{ __('position.Latest') }}</option>
                  <option  {{ (Request::get('register_date') == 'Oldest') ? 'selected' : '' }} value="Oldest">{{ __('position.Oldest') }}</option>
               </select>
            </div>
         </div>
         <div class="row mb-6">
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.Area') }}</label>
               <select class="form-control common_change" name="area_id">
                  <option value="">{{ __('position.Select') }}</option>
                  @foreach($get_area as $value_area)
                  <option value="{{ $value_area->id }}">{{ $value_area->getName() }}</option>
                  @endforeach
               </select>
            </div>
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.Start Date') }}</label>
               <select class="form-control common_change" name="start_date_id">
                  <option value="">{{ __('position.Select') }}</option>
                  @foreach($get_start_date as $value_start)
                  <option value="{{ $value_start->id }}">{{ $value_start->getName() }}</option>
                  @endforeach
               </select>
            </div>
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.English Studied') }}</label>
               <select class="form-control common_change" name="is_native_english_speaking">
                  <option value="">{{ __('position.Select') }}</option>
                  <option value="Yes">{{ __('position.Yes') }}</option>
                  <option value="No">{{ __('position.No') }}</option>
               </select>
            </div>
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.Teacher Type') }}</label>
               <select class="form-control common_change" name="teacher_type_id">
                  <option value="">{{ __('position.Select') }}</option>
                  @foreach($get_teacher_type as $value_teacher_type)
                  <option value="{{ $value_teacher_type->id }}">{{ $value_teacher_type->getName() }}</option>
                  @endforeach
               </select>
            </div>
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.Card Colour') }}</label>
               <select class="form-control common_change" name="card_colour_id">
                  <option value="">{{ __('position.Select') }}</option>
                  @foreach($get_card_colour as $value_color)
                  <option value="{{ $value_color->id }}">{{ $value_color->getName() }}</option>
                  @endforeach
               </select>
            </div>
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.Staff') }}</label>
               <select class="form-control common_change" name="staff_id">
                  <option value="">{{ __('position.Select') }}</option>
                  @foreach($get_record_staff as $value_staff)
                  <option value="{{ $value_staff->id }}">{{ $value_staff->name }} {{ $value_staff->last_name }}</option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="row mb-6">
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.Teacher ID') }}</label>
               <input type="text" class="form-control common_change" name="teacher_id">
            </div>
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ __('position.Teacher Name') }}</label>
               <input type="text" class="form-control common_change" name="teacher_name">
            </div>
         </div>
      </form>
   </div>
</div>



@if(!empty($jobs) && !empty($jobs->user))

<div class="container-fluid py-10" style="padding-bottom: 0px !important;">
   <div style="background: #ffff;padding: 25px;border-radius: 10px;padding-bottom: 1px !important;">
         <div class="row mb-6 info-list">    
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ $jobs->user->school_name }} ({{ $jobs->user->school_id }})</label>
            </div>
             <div class="col-lg-2  mb-lg-0 mb-6">
               <label>{{ $jobs->get_location() }}</label>
            </div>

            <div class="col-lg-2  mb-lg-0 mb-6">
               <label><span class="title">{{ __('position.Credit Level') }}</span> {{ !empty($jobs->creditlevel) ? $jobs->creditlevel->getName() : '-' }}</label>
             </div>
            <div class="col-lg-2  mb-lg-0 mb-6">
               <label><span class="title">{{ __('position.Emergency Level') }}</span> {{ !empty($jobs->emergencylevel) ? $jobs->emergencylevel->getName() : '-' }}</label>
            </div>

            <div class="col-lg-2  mb-lg-0 mb-6">
               <label><span class="title">{{ __('position.Staff') }}</span> {{ !empty($jobs->user->staff) ? $jobs->user->staff->name : ''  }}</label>
            </div>

             <div class="col-lg-2  mb-lg-0 mb-6">
            <a href="{{ url('admin/job/edit/'.$jobs->id) }}" target="_blank" ><i class="flaticon-edit-1 title"></i></a>
            </div>


         </div>
    </div>
</div>
@endif

@else
    <form id="FilterForm" action="" method="post">
        <input type="hidden" name="recommended" value="{{ $recommended }}">
    </form>
@endif

<div class="row" style="margin: auto;">
   @include('layouts._message')
</div>


<div class="container-fluid py-10" id="user_datatable_ajax">
   @include('frontend.school._teacher_matched')
</div>





<div class="modal fade" id="StaffCVUploadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">

         <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('position.Select') }}CV</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body" id="getStaffCV">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger font-weight-bold" data-dismiss="modal">{{ __('position.Select') }}Close</button>
            </div>
        </div>

    </div>
</div>



@endsection
@section('script')
<script type="text/javascript">




  $('body').on('click', '.SaveTeacher', function(e) {
      e.preventDefault(); 
      var teacher_id = $(this).attr('id');
      $.ajax({
            url: "{{ url('school/save_teacher') }}",
            type: "POST",
            data:{
              "_token": "{{ csrf_token() }}",
                teacher_id:teacher_id,
             },
             dataType:"json",
             success:function(response){
                if(response.success)
                {
                    alert('Teacher successfully save');
                    $('.SaveTeacherClass'+teacher_id).removeClass('text-light');
                    $('.SaveTeacherClass'+teacher_id).addClass('text-success');
                }
                else
                {
                    alert('Teacher save successfully removed');
                    $('.SaveTeacherClass'+teacher_id).removeClass('text-success');
                    $('.SaveTeacherClass'+teacher_id).addClass('text-light');
                }                
             },
         });
  });



    
    $('body').on('click', '.getStaffCVUpload', function(e) {
           var url = $(this).attr('id');

           var html = '<iframe style="width: 100%;min-height: 700px;" src="'+url+'" ></iframe>';

           $('#getStaffCV').html(html);
           $('#StaffCVUploadModal').modal('show');
    });



  $('body').on('click', '.ChangeBatch', function(e) {
       e.preventDefault();
       var page_id = $(this).attr('id');
       var url = '{{ url('school/matched-teacher/'.$slug.'?page=') }}'+page_id;
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
           url: "{{ url('school/matched-teacher/'.$slug) }}",
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
   
   $('body').delegate('.StateChange','change',function(){
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
