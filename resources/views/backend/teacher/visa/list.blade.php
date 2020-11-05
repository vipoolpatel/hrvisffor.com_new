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
                  {{ __('visa.Visa') }}
               </h2>
            </div>
         </div>
      </div>
   </div>
   <div class="d-flex flex-column-fluid">
      <div class=" container ">
         <div class="d-flex flex-row">
            @include('backend.layouts._sidebar_shcool_teacher')
            <div class="flex-row-fluid ml-lg-8">
               @include('layouts._message')
               <div class="card card-custom card-stretch">
                  <div class="card-header py-3">
                     <div class="card-title align-items-start flex-column">
                        <h3 class="card-label font-weight-bolder text-dark">{{ __('visa.Visa') }}</h3>
                        <span class="text-muted font-weight-bold font-size-sm mt-1">{{ __('visa.Update your Visa, Education & Experience') }}</span>
                     </div>
                  </div>
                  <div class="card-body" style="padding-top: 15px;">


                    

                   
                        @foreach($visa as $value_vi)

                         <form action="" method="post" enctype="multipart/form-data">
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

                                       <label style="margin-top: 20px;" class="label label-lg {{ $get_teacher_document->getstatus->class }} label-inline font-weight-bold">{{ $get_teacher_document->getstatus->name  }}</label>
                                       
                                       @if(!empty($get_teacher_document->getDocument()))
                                          <div style="margin-top: 20px;">
                                             <a target="_blank" href="{!! $get_teacher_document->getDocument() !!}" class="btn-sm btn btn-warning">{{ __('visa.Download') }}</a>
                                          </div>
                                       @endif

                                       

                                    @else

                                    @if(!empty($value_vi->get_teacher_document()) && $value_vi->get_teacher_document()->status == 3)

                                          <label style="margin-top: 10px;" class="label label-lg {{ $value_vi->get_teacher_document()->getstatus->class }} label-inline font-weight-bold">{{ $value_vi->get_teacher_document()->getstatus->name  }}</label>

                                          <p style="margin-top: 10px;"><b>{{ __('visa.Reason') }} :-</b> {{ $value_vi->get_teacher_document()->reason }}</p>
                                    @endif

                                    <div>
                                       <input type="file" required name="document">   
                                    </div>

                                    <button style="margin-top: 20px;" type="submit" class="btn btn-sm btn-success">{{ __('visa.Save') }}</button>

                                    @endif

                               


                              </div>
                           </div>
                        </form>
                        @endforeach


                        @if($get_assign_visa->count() > 0)
                          <hr />
                           <div class="row">
                                 <div class="col-md-12">
                                    <h3>School Document{{ __('visa.Visa') }}</h3>
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
                                          <a target="_blank" href="{!! $assign_visa->getDocument() !!}" class="btn-sm btn btn-warning">{{ __('visa.Download') }}</a>
                                       </div>
                                    @endif
                                   
                                 </div>
                              </div>
                           @endforeach
                        @endif
                        
                        
         
                     <hr />
                     <div class="row">
                        <div class="col-lg-12 col-xl-12">
                           <h5 class="font-weight-bold mt-10 mb-6" style="margin-top: 8px !important;">{{ __('visa.Education History') }}</h5>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-lg-12 col-xl-12">
                           <div class="table-responsive">
                              <table class="table bordered">
                                 <tr>
                                    <th>{{ __('visa.Start Date') }}</th>
                                    <th>{{ __('visa.End Date') }}</th>
                                    <th>{{ __('visa.School Name') }}</th>
                                    <th>{{ __('visa.Country') }}</th>
                                    <th>{{ __('visa.Major') }}</th>
                                    <th>{{ __('visa.Degree') }}</th>
                                    <th>{{ __('visa.Action') }}</th>
                                 </tr>
                                 <tbody>
                                    @forelse($user->get_education as $education)
                                    <tr>
                                       <td>{{ $education->start_date }}</td>
                                       <td>{{ $education->end_date }}</td>
                                       <td>{{ $education->school_name }}</td>
                                       <td>{{ $education->country->getName() }}</td>
                                       <td>{{ $education->major }}</td>
                                       <td>{{ $education->degree }}</td>
                                       <td>
                                          <a href="javascript:;" id="{{ $education->id }}" class="btn btn-icon btn-light btn-hover-primary btn-sm EducationHistory"><i class="flaticon-edit-1 text-primary"></i></a>
                                          <a href="{{ url('teacher/profile/education/delete/'.$education->id) }}" class="btn btn-icon btn-light btn-hover-primary btn-sm"><i class="flaticon2-trash text-primary"></i></a>
                                       </td>
                                    </tr>
                                    @empty
                                    <tr>
                                       <td class="100%">{{ __('visa.Record not found') }}</td>
                                    </tr>
                                    @endforelse
                                 </tbody>
                              </table>
                              <a href="javascript:;" class="btn btn-light btn-hover-primary btn-sm" id="AddEducation">{{ __('visa.Add Education') }}</a>
                           </div>
                        </div>
                     </div>
                     <hr />
                     <div class="row">
                        <div class="col-lg-12 col-xl-12">
                           <h5 class="font-weight-bold mt-10 mb-6" style="margin-top: 8px !important;">{{ __('visa.Working Experience') }}</h5>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-lg-12 col-xl-12">
                           <div class="table-responsive">
                              <table class="table bordered">
                                 <tr>
                                    <th>{{ __('visa.Start Date') }}</th>
                                    <th>{{ __('visa.End Date') }}</th>
                                    <th>{{ __('visa.Company Name') }}</th>
                                    <th>{{ __('visa.Position') }}</th>
                                    <th>{{ __('visa.Title') }}</th>
                                    <th>{{ __('visa.Duty') }}</th>
                                    <th>{{ __('visa.Action') }}</th>
                                 </tr>
                                 <tbody>
                                    @forelse($user->get_experience as $experience)
                                    <tr>
                                       <td>{{ $experience->start_date }}</td>
                                       <td>{{ $experience->end_date }}</td>
                                       <td>{{ $experience->company_name }}</td>
                                       <td>{{ $experience->position }}</td>
                                       <td>{{ $experience->title }}</td>
                                       <td>{{ $experience->duty }}</td>
                                       <td>
                                          <a href="javascript:;" id="{{ $experience->id }}" class="btn btn-icon btn-light btn-hover-primary btn-sm ExperienceHistory"><i class="flaticon-edit-1 text-primary"></i></a>
                                          <a href="{{ url('teacher/profile/experience/delete/'.$experience->id) }}" class="btn btn-icon btn-light btn-hover-primary btn-sm"><i class="flaticon2-trash text-primary"></i></a>
                                       </td>
                                    </tr>
                                    @empty
                                    <tr>
                                       <td class="100%">{{ __('visa.Record not found') }}</td>
                                    </tr>
                                    @endforelse
                                 </tbody>
                              </table>
                              <a href="javascript:;" class="btn btn-light btn-hover-primary btn-sm" id="AddExperience">{{ __('visa.Add Experience') }}</a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!--end::Body-->
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="AddEditEducationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ __('visa.Education') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
            </button>
         </div>
         <form action="{{ url('teacher/profile/education/add') }}" method="post" >
            {{ csrf_field() }}
            <input type="hidden" name="id" id="get_education_id">
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>{{ __('visa.Start Date') }}</label>
                        <input class="form-control form-control-lg form-control-solid" placeholder="{{ __('visa.Start Date') }}" type="date" id="get_start_date" name="start_date" required>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>{{ __('visa.End Date') }}</label>
                        <input class="form-control form-control-lg form-control-solid" placeholder="{{ __('visa.End Date') }}" type="date" id="get_end_date" name="end_date" required>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>{{ __('visa.School Name') }}</label>
                        <input class="form-control form-control-lg form-control-solid" placeholder="{{ __('visa.School Name') }}" type="text" id="get_school_name" name="school_name" required>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group" >
                        <label>{{ __('visa.Country') }}</label>
                        <select class="form-control form-control-lg form-control-solid" id="get_country_id" name="country_id" required>
                           <option value="">{{ __('visa.Select') }}</option>
                           @foreach($get_country as $country_name)
                           <option value="{{ $country_name->id }}">{{ $country_name->getName() }}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>{{ __('visa.Major') }}</label>
                        <input class="form-control form-control-lg form-control-solid" placeholder="{{ __('visa.Major') }}" type="text" id="get_major" name="major" required>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>{{ __('visa.Degree') }}</label>
                        <input class="form-control form-control-lg form-control-solid" placeholder="{{ __('visa.Visa') }}" type="text" id="get_degree" name="degree" required>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('visa.Close') }}</button>
               <button type="submit" class="btn btn-light-primary font-weight-bold" >{{ __('visa.Save') }}</button>
            </div>
         </form>
      </div>
   </div>
</div>
<div class="modal fade" id="AddEditExperienceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ __('visa.Experience') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
            </button>
         </div>
         <form action="{{ url('teacher/profile/experience/add') }}" method="post" >
            {{ csrf_field() }}
            <input type="hidden" name="id" id="e_get_experience_id">
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>{{ __('visa.Start Date') }}</label>
                        <input class="form-control form-control-lg form-control-solid" placeholder="{{ __('visa.Start Date') }}" type="date" id="e_get_start_date" name="start_date" required>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>{{ __('visa.End Date') }}</label>
                        <input class="form-control form-control-lg form-control-solid" placeholder="{{ __('visa.End Date') }}" type="date" id="e_get_end_date" name="end_date" required>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>{{ __('visa.Company Name') }}</label>
                        <input class="form-control form-control-lg form-control-solid" placeholder="{{ __('visa.Company Name') }}" type="text" id="e_get_company_name" name="company_name" required>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>{{ __('visa.Position') }}</label>
                        <input class="form-control form-control-lg form-control-solid" placeholder="{{ __('visa.Position') }}" type="text" id="e_get_position" name="position" required>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>{{ __('visa.Title') }}</label>
                        <input class="form-control form-control-lg form-control-solid" placeholder="{{ __('visa.Title') }}" type="text" id="e_get_title" name="title" required>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>{{ __('visa.Duty') }}</label>
                        <input class="form-control form-control-lg form-control-solid" placeholder="{{ __('visa.Duty') }}" type="text" id="e_get_duty" name="duty" required>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('visa.Close') }}</button>
               <button type="submit" class="btn btn-light-primary font-weight-bold" >{{ __('visa.Save') }}</button>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
   $('body').delegate('#AddExperience','click',function(){
       getExperienceClear();
       $('#AddEditExperienceModal').modal('show');
    });
   
   
   
   $('body').delegate('.ExperienceHistory','click',function(){
          var id = $(this).attr('id');
          getExperienceClear();
          $.ajax({
              url: "{{ url('teacher/profile/experience/edit') }}",
              type: "POST",
              data:{
                "_token": "{{ csrf_token() }}",
                  id:id,
               },
               dataType:"json",
               success:function(response){
                   $('#e_get_experience_id').val(response.id);
                   $('#e_get_duty').val(response.duty);
                   $('#e_get_position').val(response.position);
                   $('#e_get_title').val(response.title);
                   $('#e_get_company_name').val(response.company_name);
                   $('#e_get_start_date').val(response.start_date);
                   $('#e_get_end_date').val(response.end_date);
   
                   $('#AddEditExperienceModal').modal('show');
               },
          });
    });
   
   
    function getExperienceClear()
    {
       $('#e_get_experience_id').val('');
       $('#e_get_duty').val('');
       $('#e_get_position').val('');
       $('#e_get_company_name').val('');
       $('#e_get_start_date').val('');
       $('#e_get_end_date').val('');
       $('#e_get_title').val('');
    }
   
   
   
   
    
   $('body').delegate('#AddEducation','click',function(){
       getEducationClear();
       $('#AddEditEducationModal').modal('show');
    });
   
   
   
   
   
   
   $('body').delegate('.EducationHistory','click',function(){
          var id = $(this).attr('id');
          getEducationClear();
          $.ajax({
              url: "{{ url('teacher/profile/education/edit') }}",
              type: "POST",
              data:{
                "_token": "{{ csrf_token() }}",
                  id:id,
               },
               dataType:"json",
               success:function(response){
                   $('#get_education_id').val(response.id);
                   $('#get_country_id').val(response.country_id);
                   $('#get_start_date').val(response.start_date);
                   $('#get_end_date').val(response.end_date);
                   $('#get_school_name').val(response.school_name);
                   $('#get_major').val(response.major);
                   $('#get_degree').val(response.degree);
                   $('#AddEditEducationModal').modal('show');
               },
          });
    });
   
   
   
   
    function getEducationClear()
    {
          $('#get_education_id').val('');
          $('#get_country_id').val('');
          $('#get_start_date').val('');
          $('#get_end_date').val('');
          $('#get_major').val('');
          $('#get_degree').val('');
    }
      
    
</script>
@endsection
