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
      .margin-left-card {
      margin-left: 2px;margin-right: 2px;
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
<div class="content  d-flex flex-column flex-column-fluid">
   <!--begin::Subheader-->
   <div class="subheader py-3 py-lg-12  subheader-transparent " id="kt_subheader">
      <div class=" container  d-flex  justify-content-between flex-wrap ">


         <h2  class="text-white font-weight-bold my-2 mr-5" style="margin-bottom: 20px !important;">{{__('teacher.Teachers')}}</h2>


         <a href="{{ url('admin/teacher/add') }}" class="btn btn-transparent-white font-weight-bold  py-3 px-6 mr-2" style="margin-bottom: 15px;">
            <i class="flaticon2-plus-1"></i> {{__('teacher.Add')}}
         </a>


         <form id="FilterForm" class="kt-form kt-form--fit mb-15 color-form-select" style="width: 100%;background: #fff;padding: 20px;border-radius: 10px;padding-bottom: 0px;margin-bottom: 0px !important;">

            <div class="row col-lg-12">
              @include('layouts._message')
            </div>
            
            <div class="row mb-6">
               <div class="col-lg-2 mb-lg-0 mb-6">
                  <label>{{__('teacher.Current Location')}}</label>
                  <select class="form-control common_change" name="current_location_id">
                     <option value="">{{__('teacher.Select')}}</option>
                     @foreach($get_current_location as $value_lo)
                      <option value="{{ $value_lo->id }}">{{ $value_lo->getName() }}</option>
                     @endforeach
                  </select>
               </div>

               <div class="col-lg-2  mb-lg-0 mb-6">
                  <label>{{__('teacher.Education Level')}}</label>
                  <select class="form-control common_change" name="educaton_level_id">
                     <option value="">{{__('teacher.Select')}}</option>
                     @foreach($get_educaton_level as $value_edu)
                       <option value="{{ $value_edu->id }}">{{ $value_edu->getName() }}</option>
                     @endforeach
                  </select>
               </div>

               <div class="col-lg-2  mb-lg-0 mb-6">
                  <label>{{__('teacher.Min Salary')}}</label>
                  <select class="form-control common_change" name="minimum_salary_id">
                     <option value="">{{__('teacher.Select')}}</option>
                     @foreach($get_salary as $value_min)
                         <option value="{{ $value_min->id }}">{!! $value_min->getName() !!}</option>
                     @endforeach
                  </select>
               </div>

               <div class="col-lg-2  mb-lg-0 mb-6">
                  <label>{{__('teacher.Max Salary')}}</label>
                  <select class="form-control common_change" name="maximum_salary_id">
                     <option value="">{{__('teacher.Select')}}</option>
                     @foreach($get_salary as $value_max)
                         <option value="{{ $value_max->id }}">{!! $value_max->getName() !!}</option>
                     @endforeach
                  </select>
               </div>

               <div class="col-lg-2  mb-lg-0 mb-6">
                  <label>{{__('teacher.Native')}}</label>
                  <select class="form-control common_change" name="is_native_english">
                     <option value="">{{__('teacher.Select')}}</option>
                     <option value="Yes">{{__('teacher.Yes')}}</option>
                     <option value="No">{{__('teacher.No')}}</option>
                  </select>
               </div>

               <div class="col-lg-2  mb-lg-0 mb-6">
                  <label>{{__('teacher.Subject')}}</label>
                  <select class="form-control common_change" name="is_education_english">
                     <option value="">{{__('teacher.Select')}}</option>
                     <option value="Yes">{{__('teacher.Yes')}}</option>
                     <option value="No">{{__('teacher.No')}}</option>
                  </select>
               </div>

            </div>

            <div class="row mb-6">

                <div class="col-lg-2  mb-lg-0 mb-6">
                  <label>{{__('teacher.Colour')}}</label>
                  <select class="form-control common_change" name="color_id">
                     <option value="">{{__('teacher.Select')}}</option>
                     @foreach($get_colour as $value_co)
                       <option value="{{ $value_co->id }}">{{ $value_co->getName() }}</option>
                     @endforeach
                  </select>
               </div>

               <div class="col-lg-2  mb-lg-0 mb-6">
                  <label>{{__('teacher.Job Type')}}</label>
                  <select class="form-control common_change" name="job_type_id">
                     <option value="">{{__('teacher.Select')}}</option>
                       @foreach($get_job_type as $value_job)
                           <option value="{{ $value_job->id }}">{{ $value_job->getName() }}</option>
                        @endforeach
                  </select>
               </div>

                <div class="col-lg-2  mb-lg-0 mb-6">
                  <label>{{__('teacher.School Type')}}</label>
                  <select class="form-control common_change" name="school_type_id">
                     <option value="">{{__('teacher.Select')}}</option>
                     @foreach($get_school_type as $value_school_type)
                       <option value="{{ $value_school_type->id }}">{{ $value_school_type->getName() }}</option>
                     @endforeach
                  </select>
               </div>

               <div class="col-lg-2  mb-lg-0 mb-6">
                  <label>{{__('teacher.State')}}</label>
                  <select class="form-control StateChange common_change" name="state_id" >
                     <option value="">{{__('teacher.Select')}}</option>
                     @foreach($get_state as $value_s)
                        <option value="{{ $value_s->id }}">{{ $value_s->getName() }}</option>
                     @endforeach
                  </select>
               </div>

               <div class="col-lg-2  mb-lg-0 mb-6">
                  <label>{{__('teacher.City')}}</label>
                  <select class="form-control common_change" id="getCity" name="city_id">
                     <option value="">{{__('teacher.Select')}}</option>
                  </select>
               </div>

               <div class="col-lg-2  mb-lg-0 mb-6">
                  <label>{{__('teacher.Registered Date')}}</label>
                  <select class="form-control common_change" name="register_date">
                     <option value="">{{__('teacher.Select')}}</option>
                     <option {{ (Request::get('register_date') == 'Latest') ? 'selected' : '' }} value="Latest">{{__('teacher.Latest')}}</option>
                     <option  {{ (Request::get('register_date') == 'Oldest') ? 'selected' : '' }} value="Oldest">{{__('teacher.Oldest')}}</option>
                  </select>
               </div>

            </div>
            <div class="row mb-6">

               <div class="col-lg-2  mb-lg-0 mb-6">
                  <label>{{__('teacher.Area')}}</label>
                  <select class="form-control common_change" name="area_id">
                     <option value="">{{__('teacher.Select')}}</option>
                     @foreach($get_area as $value_area)
                       <option value="{{ $value_area->id }}">{{ $value_area->getName() }}</option>
                     @endforeach
                  </select>
               </div>

               <div class="col-lg-2  mb-lg-0 mb-6">
                  <label>{{__('teacher.Start Date')}} </label>
                  <select class="form-control common_change" name="start_date_id">
                     <option value="">{{__('teacher.Select')}}</option>
                     @foreach($get_start_date as $value_start)
                       <option value="{{ $value_start->id }}">{{ $value_start->getName() }}</option>
                     @endforeach
                  </select>
               </div>



               <div class="col-lg-2  mb-lg-0 mb-6">
                  <label>{{__('teacher.English Studied')}}</label>
                  <select class="form-control common_change" name="is_native_english_speaking">
                     <option value="">{{__('teacher.Select')}}</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </div>

               <div class="col-lg-2  mb-lg-0 mb-6">
                  <label>{{__('teacher.Teacher Type')}}</label>
                  <select class="form-control common_change" name="teacher_type_id">
                     <option value="">{{__('teacher.Select')}}</option>
                     @foreach($get_teacher_type as $value_teacher_type)
                          <option {{ (Request::get('teacher_type_id') == $value_teacher_type->id) ? 'selected' : '' }}  value="{{ $value_teacher_type->id }}">{{ $value_teacher_type->getName() }}</option>
                     @endforeach

                  </select>
               </div>

               <div class="col-lg-2  mb-lg-0 mb-6">
                  <label>{{__('teacher.Card Colour')}}</label>
                  <select class="form-control common_change" name="card_colour_id">
                     <option value="">{{__('teacher.Select')}}</option>
                     @foreach($get_card_colour as $value_color)
                       <option value="{{ $value_color->id }}">{{ $value_color->getName() }}</option>
                     @endforeach

                  </select>
               </div>

               <div class="col-lg-2  mb-lg-0 mb-6">
                  <label>{{__('teacher.Staff')}}</label>
                  <select class="form-control common_change" name="staff_id">
                     <option value="">{{__('teacher.Select')}}</option>
                     @foreach($get_record_staff as $value_staff)
                        <option value="{{ $value_staff->id }}">{{ $value_staff->name }} {{ $value_staff->last_name }}</option>
                     @endforeach
                  </select>
               </div>

            </div>

            <div class="row mb-6">

               <div class="col-lg-2  mb-lg-0 mb-6">
                  <label>{{__('teacher.Teacher ID')}}</label>
                  <input type="text" class="form-control common_change" name="teacher_id">
               </div>
               <div class="col-lg-2  mb-lg-0 mb-6">
                  <label>{{__('teacher.Teacher Name')}}</label>
                  <input type="text" class="form-control common_change" name="teacher_name">
               </div>

               <div class="col-lg-2  mb-lg-0 mb-6">
                  <label>{{__('teacher.Search Note')}}</label>
                  <input type="text" class="form-control common_change" name="note">
               </div>

               <div class="col-lg-2  mb-lg-0 mb-6">
                  <label>{{__('teacher.Status')}}</label>

                  <select class="form-control common_change" name="status">
                     <option value="">{{__('teacher.Select')}}</option>
                     <option value="1">{{__('teacher.Active')}}</option>
                     <option value="100">{{__('teacher.Inactive')}}</option>
                  </select>

               </div>


               <div class="col-lg-2  mb-lg-0 mb-6">
                  <label>{{__('teacher.Verify')}}</label>

                  <select class="form-control common_change" name="verify">
                     <option value="">{{__('teacher.Select')}}</option>
                     <option value="1">{{__('teacher.Verify')}}</option>
                     <option value="100">{{__('teacher.Unverify')}}</option>
                  </select>

               </div>


               <div class="col-lg-2  mb-lg-0 mb-6">
                  <label>{{__('teacher.Job Status')}}</label>

                  <select class="form-control common_change" name="created_at">
                     <option value="">{{__('teacher.Select')}}</option>
                     @foreach($get_user_register as $created_at)
                        <option value="{{ $created_at->day }}">{{ $created_at->getName() }}</option>
                     @endforeach
                  </select>

               </div>


             <div class="col-lg-6  mb-lg-0 mb-6" style="margin-top: 25px;">
                  <input type="hidden" class="form-control getShowType" name="type" value="{{ !empty(Request::get('type')) ? Request::get('type') : 'list' }}">
                  <a href="javascript:;" id="list" class="btn btn-success font-weight-bolder font-size-sm ShowType">
                        <i class="flaticon2-list-2 "></i>{{__('teacher.List Show')}}
                  </a>
                  <a href="javascript:;" id="card" class="btn btn-success font-weight-bolder font-size-sm ShowType">
                      <i class="flaticon2-list-2 "></i>{{__('teacher.Card Show')}}
                  </a>
            </div>

            </div>

         </form>
      </div>
   </div>
   <!--end::Subheader-->
   <!--begin::Entry-->


   <div class="d-flex flex-column-fluid" id="user_datatable_ajax">

      <!--begin::Container-->
      @if(!empty(Request::get('type')) && Request::get('type') == 'card')
        @include('backend.admin.teacher._list_card')
      @else
        @include('backend.admin.teacher._list')
      @endif

      

      <!--end::Container-->
   </div>
   <!--end::Entry-->
</div>



<div class="modal fade" id="UpdateNotesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('teacher.Update Note')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
          <form action="" method="post" id="UpdateNoteForm">
             {{ csrf_field() }}
            <div class="modal-body">
                <label>{{__('teacher.Note')}}</label>
                <input type="hidden" name="id" id="getUserID">
                <textarea name="note" required id="getNote" rows="10" class="form-control"></textarea>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary font-weight-bold">{{__('teacher.Save')}}</button>
            </div>
          </form>
        </div>
    </div>
</div>


@endsection


@section('script')
<script type="text/javascript">


$('body').delegate('.ChangeMatchStatus','change',function(){

   var id = $(this).attr('id');
   var status = $(this).val();
   var column = $(this).attr('data-val');
   $.ajax({
      url: "{{ url('admin/teacher/match_status_teacher') }}",
      type: "POST",
      data:{
        "_token": "{{ csrf_token() }}",
          id:id,
          status:status,
          column:column,
       },
       dataType:"json",
       success:function(response){
           alert(response.success);
       },
   });
});


  
  $('body').delegate('.UpdateNotes','click',function(){
      var id = $(this).attr('id');
      var text = $('#getLatestNote'+id).html();
      $('#getUserID').val(id);
      $('#getNote').val(text);
      $('#UpdateNotesModal').modal('show');
  });


  $('#UpdateNotesModal').delegate('#UpdateNoteForm','submit',function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
             url: "{{ url('admin/teacher/note/update') }}",
            data: $(this).serialize(),
            dataType: "json",
            success: function (data) {
                $('#getLatestNote'+data.id).html(data.note);
                alert(data.success);
                $('#UpdateNotesModal').modal('hide');

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

  var xhr;
    
  function get_data() {

    if(xhr && xhr.readyState != 4){
        xhr.abort();
    }

    xhr = $.ajax({
              type: "GET",
              url: "{{ url('admin/teacher') }}",
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



  // $(function () {

  //     $('.common_change').on('change keyup', function (e) {
  //         e.preventDefault();
  //         $.ajax({
  //             type: "post",
  //             url: "{{ url('admin/teacher') }}",
  //             data: {
  //                 _token: '{{ @csrf_token() }}',
  //                 current_location: $('#current_location').val(),
  //                 education_level: $('#education_level').val(),
  //                 min_salary: $('#min_salary').val(),
  //                 max_salary: $('#max_salary').val(),
  //             },
  //             dataType: "html",
  //             success: function (data) {
  //                 $('#user_datatable_ajax').html(data);
  //             },
  //             error: function (data) {
  //                 // error handling
  //             }
  //         })
  //     });

  //     $(function() {
  //         $('body').on('click', '.pagination a', function(e) {
  //             e.preventDefault();
  //             var url = $(this).attr('href');
  //             getProducts(url);
  //             window.history.pushState("", "", url);
  //         });

  //         function getProducts(url) {
  //             $.ajax({
  //                 url : url,
  //                 data: {
  //                     _token: '{{ @csrf_token() }}',
  //                     current_location: $('#current_location').val(),
  //                     education_level: $('#education_level').val(),
  //                     min_salary: $('#min_salary').val(),
  //                     max_salary: $('#max_salary').val(),
  //                 },
  //             }).done(function (data) {
  //                 $('#user_datatable_ajax').html(data);

  //             }).fail(function () {
  //                 alert('Data could not be loaded.');
  //             });
  //         }
  //     });
  // });


</script>
@endsection
