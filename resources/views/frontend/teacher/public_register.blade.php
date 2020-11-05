@extends('layouts.app_public')
@section('style')
<style type="text/css">
   .form-group {
   margin-bottom: 8px;
   }
    select {
       -moz-appearance:none; /* Firefox */
      -webkit-appearance:none; /* Safari and Chrome */
       appearance:none;
   }
   .required {
      color: red;
   }
    .instant-messenger-first
   {
      width: 150px;display: inline;
   }
   .instant-messenger-second
   {
      max-width: 248px;display: inline;
   }
</style>
@endsection
@section('content')
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
   <div class="d-flex flex-column-fluid" style="margin-top: 30px;">
      <div class=" container ">
         <div class="d-flex flex-row">
            <div class="flex-row-fluid">
               @include('layouts._message')
               <div class="card card-custom card-stretch">
                  <div class="card-header py-3">
                     <div class="card-title align-items-start flex-column">
                        <h3 class="card-label font-weight-bolder text-dark">{{ __('profile.Tell us something about yourself') }}</h3>
                     </div>
                  </div>
                  <form class="form" method="post" action="" enctype="multipart/form-data">
                     {{ csrf_field() }}
                      <input type="hidden" name="visa_id" id="r_visa_id">
                     <div class="card-body">
                        <div class="row">
                           <div class="col-md-4">
                              <label style="width: 100%" class="col-form-label">{{ __('profile.Profile Picture') }}</label>
                              <div class="image-input image-input-outline image-input-empty" id="kt_profile_avatar" style="background-image: url({{ url('assets/media/users/blank.png')  }})">
                                 <div class="image-input-wrapper" style="background-image: none;"></div>
                                 <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                 <i class="fa fa-pen icon-sm text-muted"></i>
                                 <input type="file" accept="image/*" name="profile_pic">
                                 </label>
                                 <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                 <i class="ki ki-bold-close icon-xs text-muted"></i>
                                 </span>
                                 <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                 <i class="ki ki-bold-close icon-xs text-muted"></i>
                                 </span>
                              </div>
                              <span class="form-text text-muted">{{ __('profile.Please upload your picture as as PNG, JPG or JPEG (max 10MB)') }}</span>
                           </div>
                        
                           <div class="col-md-5">
                              <div class="form-group">
                                 <label class="col-form-label">{{ __('profile.Self-Introduction Video') }}</label>
                                 <p>{{ __('profile.Please tell use the following in your video (1-2 minutes)') }}:</p>
                                 <p>{{ __('profile.Name + Age + Nationality + Your degree and major + Working Experience + A fun fact about you + Anything else you want your new employer to know about you') }}</p>
                                 <div class="uppy" id="kt_uppy_5">
                                    <div class="uppy-wrapper">
                                       <div class="uppy-Root uppy-FileInput-container">
                                          <input class="uppy-FileInput-input uppy-input-control user_video" accept="video/*" type="file" name="user_video" id="kt_uppy_5_input_control">
                                          <label class="uppy-input-label btn btn-light-primary btn-sm btn-bold" for="kt_uppy_5_input_control">{{ __('profile.Select Self-Introduction Video') }}</label>
                                        
                                       </div>
                                       <p id="get_user_video_name"></p>


                                    <div class="row">
                                       <div class="col-md-12">
                                          <div class="uppy-wrapper">
                                             <div class="uppy-Root uppy-FileInput-container">
                                                <input class="uppy-FileInput-input uppy-input-control multi_user_video" accept="video/*" type="file" name="multi_user_video[]" data-val="500" id="multi_user_video500">
                                                <label class="uppy-input-label btn btn-light-primary btn-sm btn-bold" for="multi_user_video500">{{ __('profile.Select Demo Video (Recommended)') }}</label>
                                                <a href="javascript:;" id="AppendVideo" style="margin-left: 10px;margin-top: -3px;" class="btn btn-sm btn-success">{{ __('profile.Add') }}</a>
                                             </div>
                                          </div>
                                          <p id="get_multi_user_video500"></p>
                                       </div>
                                    </div>
                                    <div id="getMultiVideo"></div>



                                    </div>
                                 </div>
                                  
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-group">
                                 <label class="col-form-label">{{ __('profile.CV Upload') }} <span class="required">*</span></label>
                                 <div class="uppy" id="kt_uppy_5">
                                    <div class="uppy-wrapper">
                                       <div class="uppy-Root uppy-FileInput-container">
                                          <input required class="uppy-FileInput-input uppy-input-control cv_upload" type="file" name="cv_upload" id="kt_uppy_5_input_controlCV">
                                          <label class="uppy-input-label btn btn-light-primary btn-sm btn-bold" for="kt_uppy_5_input_controlCV">{{ __('profile.Select CV Upload') }}</label>                                       
                                       </div>
                                    </div>
                                 </div>
                                  <p id="get_cv_upload_name"></p>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label class="col-form-label">{{ __('profile.Username') }} <span class="required">*</span></label>
                                 <input id="CheckUsername" class="form-control form-control-lg form-control-solid" required placeholder="{{ __('profile.Username') }}" name="username" value="{{ old('username') }}" type="text" />
                                 <div class="required" id="getUsernameMessage">{{ $errors->first('username') }}</div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label class="col-form-label">{{ __('profile.Password') }} <span class="required">*</span></label>
                                 <input class="form-control form-control-lg form-control-solid" placeholder="{{ __('profile.Password') }}" name="password" type="password" />
                                 <div class="required">{{ $errors->first('password') }}</div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label class="col-form-label">{{ __('profile.Email') }} <span class="required">*</span></label>
                                 <input class="form-control form-control-lg form-control-solid" placeholder="{{ __('profile.Email') }}" required type="email" value="{{ old('email') }}" name="email"/>
                                 <div class="required">{{ $errors->first('email') }}</div>
                              </div>
                           </div>
                        </div>


                        <div class="row">
                           <div class="col-md-8">
                              <div class="form-group">
                                 <label class="col-form-label">{{ __('profile.Instant Messenger') }} <span class="required">*</span></label>
                                 <div>
                                    <select name="instant_messenger_id[]" required class="instant-messenger-first form-control form-control-lg form-control-solid">
                                       <option value="">{{ __('profile.Select') }}</option>
                                       @foreach($get_instant_messenger as $value_messenger)
                                       <option value="{{ $value_messenger->id }}">{{ $value_messenger->getName() }}</option>
                                       @endforeach
                                    </select>
                                    <input class="instant-messenger-second form-control form-control-lg form-control-solid" placeholder="{{ __('profile.Instant Messenger') }}" required type="text"  name="instant_messenger_name[]"  />

                                    <button style="display: inline;box-shadow: none;" type="button" class="btn btn-primary btn-sm AddNewInstantMessenger">{{ __('profile.Add') }}</button>

                                 </div>

                                 <div class="AppendNewInstantMessenger"></div>

                              </div>
                           </div>
                        </div>
                      
                        <div class="row">
                      

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="col-form-label">{{ __('profile.Phone Number') }} <span class="required">*</span></label>
                                 <div>
                                 <select style="width: 150px;display: inline;" required name="country_id" class="form-control form-control-lg form-control-solid">
                                       <option value="">Country Code</option>
                                       @foreach($get_country as $value_country)
                                          <option {{ ( old('country_id') == $value_country->id) ? "selected" : '' }} value="{{ $value_country->id }}">{{ $value_country->getName() }}</option>
                                       @endforeach
                                 </select>

                                 <input style="max-width: 240px;display: inline;" class="form-control form-control-lg form-control-solid" placeholder="Phone Number" type="text" value="{{ old('phone_number') }}" name="phone_number" required  />
                                 </div>
                              </div>
                           </div>
                        </div>
                          <hr />
                        <div class="row">
                           <div class="col-lg-12 col-xl-12">
                              <h5 class="font-weight-bold mt-10 mb-6" style="margin-top: 8px !important;">{{ __('profile.Personal Information') }}</h5>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-3">
                              <div class="form-group">
                                 <label class="col-form-label">{{ __('profile.First Name') }} <span class="required">*</span></label>
                                 <input class="form-control form-control-lg form-control-solid" placeholder="{{ __('profile.First Name') }}" type="text" value="{{ old('name') }}" name="name" required />
                                 <div class="required">{{ $errors->first('name') }}</div>
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-group">
                                 <label class="col-form-label">{{ __('profile.Last Name') }} </label>
                                 <input class="form-control form-control-lg form-control-solid" placeholder="{{ __('profile.Last Name') }}" type="text" value="{{ old('last_name') }}" name="last_name"   />
                                 <div class="required">{{ $errors->first('last_name') }}</div>
                              </div>
                           </div>


                           <div class="col-md-3">
                              <div class="form-group">
                                 <label class="col-form-label">{{ __('profile.Age') }} <span class="required">*</span></label>
                                 <select name="age" required class="form-control form-control-lg form-control-solid">
                                    <option value="">{{ __('profile.Select') }}</option>
                                    @for($i=18; $i<=65; $i++)
                                    <option {{ ( old('age') == $i) ? "selected" : '' }} value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                 </select>
                              </div>
                           </div>

                           <div class="col-md-3">
                              <div class="form-group">
                                 <label class="col-form-label">{{ __('profile.Gender') }} <span class="required">*</span></label>
                                 <select required class="form-control form-control-lg form-control-solid" name="gender_id">
                                       <option value="">{{ __('profile.Select') }}</option>
                                       @foreach($get_gender as $value_ge)
                                         <option {{ (old('gender_id') == $value_ge->id) ? 'selected' : '' }} value="{{ $value_ge->id }}">{{ $value_ge->getName() }}</option>
                                       @endforeach
                                 </select>
                                 <div class="required">{{ $errors->first('gender_id') }}</div>
                              </div>
                           </div>

                           
                          
                        </div>


                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="col-form-label">{{ __('profile.Nationality (Please tell us your passort nationality)') }}<span class="required">*</span></label>
                                 <select name="nationality_id" id="nationality_id" required class="general_chine form-control form-control-lg form-control-solid">
                                    <option value="">{{ __('profile.Select') }}</option>
                                    @foreach($get_nationality as $value_n)
                                    <option data-val="{{ $value_n->is_native }}" {{ ( old('nationality_id') == $value_n->id) ? "selected" : '' }} value="{{ $value_n->id }}">{{ $value_n->getName() }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="col-form-label">{{ __('profile.Educational Level') }} <span class="required">*</span></label>

                                 <input id="r_english_speaker" type="hidden" name="is_native_english" value="{{ old('is_native_english', 'No') }}">

                                 <select name="educaton_level_id" id="educaton_level_id" required class="general_chine form-control form-control-lg form-control-solid">
                                    <option value="">{{ __('profile.Select') }}</option>
                                    @foreach($get_educaton_level as $value_edu)
                                    <option {{ ( old('educaton_level_id') == $value_edu->id) ? "selected" : '' }} value="{{ $value_edu->id }}">{{ $value_edu->getName() }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>

                        </div>



                        <div class="row">
                          

                           <div class="col-md-4 hide_show_native">
                              <div class="form-group">
                                 <label class="col-form-label">{{ __('profile.Have you graduated two years or more?') }}</label>
                                 <select name="is_graduated" id="is_graduated"  class="general_chine form-control form-control-lg form-control-solid clear_value_native">
                                    <option value="">{{ __('profile.Select') }}</option>
                                    <option {{ ( old('is_graduated') == 'Yes') ? "selected" : '' }} value="Yes">{{ __('profile.Yes') }}</option>
                                    <option {{ ( old('is_graduated') == 'No') ? "selected" : '' }} value="No">{{ __('profile.No') }}</option>
                                 </select>
                              </div>
                           </div>

                            <div class="col-md-4 hide_show_native">
                              <div class="form-group">
                                 <label class="col-form-label">{{ __('profile.Is Your Subject related to education or English?') }}</label>
                                 <select name="is_education_english"  class="form-control form-control-lg form-control-solid clear_value_native">
                                    <option value="">{{ __('profile.Select') }}</option>
                                    <option {{ ( old('is_education_english') == 'Yes') ? "selected" : '' }} value="Yes">{{ __('profile.Yes') }}</option>
                                    <option {{ ( old('is_education_english') == 'No') ? "selected" : '' }} value="No">{{ __('profile.No') }}</option>
                                 </select>
                              </div>
                           </div>

                           <div class="col-md-4 hide_show_native">
                              <div class="form-group">
                                 <label class="col-form-label">{{ __('profile.Did you study in native English speaking countries?') }}</label>
                                 <select name="is_native_english_speaking"  class="form-control form-control-lg form-control-solid clear_value_native">
                                    <option value="">{{ __('profile.Select') }}</option>
                                    <option {{ ( old('is_native_english_speaking') == 'Yes') ? "selected" : '' }} value="Yes">{{ __('profile.Yes') }}</option>
                                    <option {{ ( old('is_native_english_speaking') == 'No') ? "selected" : '' }} value="No">{{ __('profile.No') }}</option>
                                 </select>
                              </div>
                           </div>

                        </div>



                       <div class="row">
                 
                        
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="col-form-label">{{ __('profile.Years of Working Experience') }} <span class="required">*</span></label>
                                 <select name="experience" required class="form-control form-control-lg form-control-solid">
                                    <option value="">{{ __('profile.Select') }}</option>
                                    @for($i=0; $i<=47; $i++)
                                    <option {{ ( old('experience') == $i) ? "selected" : '' }} value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                 </select>
                              </div>
                           </div>

                      
                        
                        </div>

                     

                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label class="col-form-label">{{ __('profile.Bio') }}</label>
                                 <textarea class="form-control form-control-lg form-control-solid" name="bio" placeholder="{{ __('profile.Bio') }}">{{ old('bio') }}</textarea>
                              </div>
                           </div>
                        </div>



                    


                        <div class="row">
                       
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="col-form-label">{{ __('profile.Job Type') }} <span class="required">*</span></label>
                                 <select name="job_type_id" required class="form-control form-control-lg form-control-solid">
                                    <option value="">{{ __('profile.Select') }}</option>
                                    @foreach($get_job_type as $value_job)
                                    <option {{ ( old('job_type_id') == $value_job->id) ? "selected" : '' }} value="{{ $value_job->id }}">{{ $value_job->getName() }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                         
                        </div>


                      <div class="row">

                           <div class="col-md-4">
                              <div class="form-group">
                                 <label class="col-form-label">{{ __('profile.Current Location') }} <span class="required">*</span></label>
                                 <select name="current_location_id" id="current_location_id" required class="form-control form-control-lg form-control-solid">
                                    <option value="">{{ __('profile.Select') }}</option>
                                    @foreach($get_current_location as $value_lo)
                                    <option  {{ ( old('current_location_id') == $value_lo->id) ? "selected" : '' }} value="{{ $value_lo->id }}">{{ $value_lo->getName() }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>

                          <div class="col-md-4">
                              <div class="form-group">
                                 <label class="col-form-label">{{ __('profile.Start Date') }} <span class="required">*</span></label>
                                 <select name="start_date_id" required class="form-control form-control-lg form-control-solid">
                                    <option value="">{{ __('profile.Select') }}</option>
                                    @foreach($get_start_date as $value_start)
                                    <option {{ ( old('start_date_id') == $value_start->id) ? "selected" : '' }} value="{{ $value_start->id }}">{{ $value_start->getName() }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>

                              <div class="col-md-4" id="hide_current_visa_type_id"> 
                              <div class="form-group">
                                 <label class="col-form-label">{{ __('profile.Current visa type') }}</label>
                                 <select name="current_visa_type_id" id="current_visa_type_id" class="form-control form-control-lg form-control-solid">
                                    <option value="">{{ __('profile.Select') }}</option>
                                    @foreach($get_current_visa_type as $value_visa)
                                    <option {{ ( old('current_visa_type_id') == $value_visa->id) ? "selected" : '' }} value="{{ $value_visa->id }}">{{ $value_visa->getName() }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>


                        </div>



                        <hr />
                        <div class="row">
                           <div class="col-lg-12 col-xl-12">
                              <h5 class="font-weight-bold mt-10 mb-6" style="margin-top: 8px !important;">{{ __('profile.Preferred area') }}</h5>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="col-form-label">{{ __('profile.Area') }} <span class="required">*</span></label>
                                 <select name="area_id" required class="form-control form-control-lg form-control-solid">
                                    <option value="">{{ __('profile.Select') }}</option>
                                    @foreach($get_area as $value_area)
                                    <option {{ ( old('area_id') == $value_area->id) ? "selected" : '' }} value="{{ $value_area->id }}">{{ $value_area->getName() }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                        </div>
                      
                        <div class="row">
                           
                           <div class="col-md-5">
                              <div class="form-group">
                                 <label class="col-form-label">{{ __('profile.Province') }} <span class="required">*</span></label>
                                 <select name="state_id[]" required class="form-control form-control-lg form-control-solid StateChange" id="1" >
                                    <option value="">{{ __('profile.Select') }}</option>
                                    @foreach($get_state as $value_s)
                                    <option value="{{ $value_s->id }}">{{ $value_s->getName() }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-5">
                              <div class="form-group">
                                 <label class="col-form-label">{{ __('profile.City') }} <span class="required">*</span></label>
                                 <select name="city_id[]"  required id="getCity1" class="form-control form-control-lg form-control-solid">
                                    <option value="">{{ __('profile.Select') }}</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="form-group">
                                 <label class="col-form-label">&nbsp;</label>
                                 <br />
                                 <button type="button" style="box-shadow: none;" class="btn btn-primary AddNewLocation">{{ __('profile.Add City') }}</button>
                              </div>
                           </div>

                        </div>
                        <div class="AppendNewLocation"></div>
                       
                        <hr />


                       <div class="row">
                     
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="col-form-label">{{ __('profile.Minimum Salary Monthly') }}</label>
                                 <select name="minimum_salary_id" class="form-control form-control-lg form-control-solid">
                                    <option value="">{{ __('profile.Select') }}</option>
                                    @foreach($get_salary as $value_min)
                                    <option  {{ ( old('minimum_salary_id') == $value_min->id) ? "selected" : '' }} value="{{ $value_min->id }}">{!! $value_min->getName() !!}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="col-form-label">{{ __('profile.Maximum Salary Monthly') }}</label>
                                 <select name="maximum_salary_id" class="form-control form-control-lg form-control-solid">
                                    <option value="">{{ __('profile.Select') }}</option>
                                    @foreach($get_salary as $value_max)
                                    <option {{ (old('maximum_salary_id') == $value_max->id) ? "selected" : '' }} value="{{ $value_max->id }}">{!! $value_max->getName() !!}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                        </div>


                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label class="col-form-label">{{ __('profile.Preferred School Type') }}</label>
                                 <div class="checkbox-inline">
                                    @foreach($get_school_type as $value_school)

                                   
                                    <label class="checkbox">
                                    <input type="checkbox" value="{!! $value_school->id !!}" name="school_type[]">
                                    <span></span>
                                    {!! $value_school->getName() !!}
                                    </label>
                                    @endforeach
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                         <div class="col-md-6">
                              <div class="form-group">
                                 <label class="col-form-label">{{ __('profile.Position') }} <span class="required">*</span></label>
                                 <select name="position_id" required class="form-control form-control-lg form-control-solid">
                                    <option value="">{{ __('profile.Select') }}</option>
                                    @foreach($get_position as $value_po)
                                    <option {{ ( old('position_id') == $value_po->id) ? "selected" : '' }} value="{{ $value_po->id }}">{{ $value_po->getName() }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                        </div>


                      


                        <div class="row">
                          {{--  <div class="col-md-6">
                              <div class="form-group">
                                 <label class="col-form-label">Available Interview Time</label>
                                 <input  class="form-control form-control-lg form-control-solid" type="text" value="{{ old('interview_time') }}" placeholder="Available Interview Time" name="interview_time" />
                              </div>
                           </div> --}}
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="col-form-label">{{ __('profile.Other Contract Requirements') }}</label>
                                 <input class="form-control form-control-lg form-control-solid" type="text" placeholder="{{ __('profile.Other Contract Requirements') }}" value="{{ old('others') }}" name="others"/>
                              </div>
                           </div>
                        </div>
               
                        <div class="form-group row">
                           <div class="col-lg-12 col-xl-12 text-right">
                              <br />
                              <button type="submit" class="btn btn-success mr-2">{{ __('profile.Submit') }}</button>
                           </div>
                        </div>
                     </div>
                     <!--end::Body-->
                  </form>
                  <!--end::Form-->
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection
@section('script')
<script type="text/javascript">

    $('#CheckUsername').keyup(function(){
            var user_id = $(this).attr('data-val');
            var username = $(this).val();

           $.ajax({
                url: "{{ url('user/profile/check_user_name') }}",
                type: "POST",
                data:{
                  "_token": "{{ csrf_token() }}",
                    username:username,
                    user_id: user_id,
                 },
                 dataType:"json",
                 success:function(response){
                        if(response.success)
                        {
                           $('#getUsernameMessage').html('');
                        }
                        else
                        {
                           $('#getUsernameMessage').html('{{ __('profile.Username already register please choose another') }}');
                        }
                 },
            });

      });



   var i = 1;
   $('#AppendVideo').click(function(){
         var html = '';
         html = '<div class="row" id="RemoveVideo'+i+'">\n\
                  <div class="col-md-12">\n\
                     <div class="uppy-wrapper">\n\
                        <div class="uppy-Root uppy-FileInput-container">\n\
                           <input class="uppy-FileInput-input uppy-input-control multi_user_video" accept="video/*" type="file" name="multi_user_video[]" data-val="'+i+'" id="multi_user_video'+i+'">\n\
                           <label class="uppy-input-label btn btn-light-primary btn-sm btn-bold" for="multi_user_video'+i+'">{{ __('profile.Select Demo Video (Recommended)') }}</label>\n\
                            <a href="javascript:;" id="'+i+'" style="margin-left: 10px;margin-top: -3px;" class="btn btn-sm btn-danger RemoveSelfVideo">{{ __('profile.Remove') }}</a>\n\
                         </div>\n\
                     </div>\n\
                     <p id="get_multi_user_video'+i+'"></p>   \n\
                  </div>\n\
               </div>';
   
         $('#getMultiVideo').append(html);
         i++;
   });
   
   
   $('body').delegate('.RemoveSelfVideo','click',function(){
         var id = $(this).attr('id');
         $('#RemoveVideo'+id).remove();
   });
   
   $('body').delegate('.multi_user_video','change',function(e) {
         var id = $(this).attr('data-val');
         var fileName = e. target. files[0]. name;
         $('#get_multi_user_video'+id).html(fileName);
   });
   
   


   // Instant Messenger Part

   var j = 50;
   $('.AddNewInstantMessenger').click(function() {
         var html = '';
         html += '<div id="RemoveMainPartInstantMessenger'+j+'" style="margin-bottom: 2px;">\n\
               <select required name="instant_messenger_id[]" class="instant-messenger-first form-control form-control-lg form-control-solid">\n\
                  <option value="">{{ __('profile.Select') }}</option>';
                  @foreach($get_instant_messenger as $value_messenger)
                  html += '<option value="{{ $value_messenger->id }}">{{ $value_messenger->getName() }}</option>';
                  @endforeach
               html += '</select>\n\
               <input class="instant-messenger-second form-control form-control-lg form-control-solid" placeholder="{{ __('profile.Instant Messenger') }}" type="text" value="" name="instant_messenger_name[]" required  />\n\
               <button style="display: inline;" id="'+j+'" type="button" class="btn btn-danger btn-sm RemoveNewInstantMessenger">{{ __('profile.Remove') }}</button>\n\
            </div>';

          $('.AppendNewInstantMessenger').append(html);
          j++;
   });

   $('body').delegate('.RemoveNewInstantMessenger','click',function(){
        var id = $(this).attr('id');
        $('#RemoveMainPartInstantMessenger'+id).remove();
   });

   // End Instant Messenger Part

      
$('.user_video'). change(function(e){
      var fileName = e. target. files[0]. name;
      $('#get_user_video_name').html(fileName);
});

$('.cv_upload'). change(function(e){
      var fileName = e. target. files[0]. name;
      $('#get_cv_upload_name').html(fileName);
});


     $('body').delegate('#nationality_id','change',function() {
         var nationality_id = $('option:selected', this).attr('data-val');   
         if(nationality_id == '1') {
             $('#r_english_speaker').val('Yes');
         }
         else {
             $('#r_english_speaker').val('No');
         }
     });

     $('body').delegate('.general_chine','change',function() {
         general_chine();
     });


      function general_chine() {

            var nationality_id      = $('#nationality_id option:selected').attr('data-val');
            var english_speaker     = $('#r_english_speaker').val();
            var educaton_level_id   = $('#educaton_level_id').val(); 
            var is_graduated        = $('#is_graduated').val(); 
            
             if(educaton_level_id == 4)
             {
                $('#r_visa_id').val('2');
             }
             else
             {
                    if(nationality_id == '1' && english_speaker == 'Yes' && (educaton_level_id == 1 || educaton_level_id == 2 || educaton_level_id == 3))
                    {
                        
                        $('#r_visa_id').val('1');
                    }
                    else
                    {
                        if(educaton_level_id == 4 && nationality_id == 0 && english_speaker == 'No')
                        {
                            $('#r_visa_id').val('2');
                        }
                        else
                        {
                            if(is_graduated == 'Yes')
                            {
                                $('#r_visa_id').val('1');
                            }
                            else if(is_graduated == 'No')
                            {
                                $('#r_visa_id').val('2');
                            }
                            else
                            {
                                $('#r_visa_id').val('');
                            }
                        }                    
                    }  
             }

            education_english();
      }


      general_chine();


      function education_english() {
            var r_visa_id = $('#r_english_speaker').val();
            if(r_visa_id == 'Yes')
            {
               $('.clear_value_native').val('');
               $('.hide_show_native').hide();
                // $("#r_subject_education").prop('required',true);
                // $("#r_native_english_speaking").prop('required',true);
            }
            else
            {
               
               $('.hide_show_native').show();

                // $('.hide_english_speaker').hide();
                // $("#r_subject_education").val('');
                // $("#r_subject_education").prop('required',false);
                // $("#r_native_english_speaking").val('');
                // $("#r_native_english_speaking").prop('required',false);
            }
      }



   var i = 10;
   $('.AddNewLocation').click(function(){
   
     var html = '';
      html += '<div id="RemoveMainPartLocation'+i+'" class="row">\n\
                          <div class="col-md-5">\n\
                             <div class="form-group">\n\
                                <label class="col-form-label">{{ __('profile.Province') }}</label>\n\
                                <select name="state_id[]" required id="'+i+'" class="StateChange form-control form-control-lg form-control-solid">\n\
                                     <option value="">{{ __('profile.Select') }}</option>';
                                   @foreach($get_state as $value_s)
                                      html += '<option value="{{ $value_s->id }}">{{ $value_s->getName() }}</option>';
                                   @endforeach
   
                                html += '</select>\n\
                             </div>\n\
                          </div>\n\
                          <div class="col-md-5">\n\
                             <div class="form-group">\n\
                                <label class="col-form-label">{{ __('profile.City') }}</label>\n\
                                <select name="city_id[]" required id="getCity'+i+'" class="form-control form-control-lg form-control-solid">\n\
                                   <option value="">{{ __('profile.Select') }}</option>\n\
                                </select>\n\
                             </div>\n\
                          </div>\n\
                          <div class="col-md-2">\n\
                             <div class="form-group">\n\
                                <label class="col-form-label">&nbsp;</label>\n\
                                <br />\n\
                                <button type="button" id="'+i+'" class="btn btn-danger RemoveNewLocation">{{ __('profile.Remove') }}</button>\n\
                             </div>\n\
                          </div>\n\
                       </div>';
   
     $('.AppendNewLocation').append(html)
   
     i++;
   });
   

   
   $('body').delegate('.StateChange','change',function(){
       var id = $(this).attr('id');
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
                $('#getCity'+id).html(response.html);
           },
       });
   });
   
   
   $('body').delegate('.RemoveNewLocation','click',function(){
     var id = $(this).attr('id');
     $('#RemoveMainPartLocation'+id).remove()
   });

   $('body').delegate('#current_location_id','change',function(){
            current_location();        
   });
      
   function current_location() {
         var value = $('#current_location_id').val();
        if(value == 2)
        {
            $('#current_visa_type_id').val('');
            $('#hide_current_visa_type_id').hide();
        }
        else
        {
            $('#hide_current_visa_type_id').show();
        }
   }
   
   $('body').delegate('.PlayVideo','click',function(){
     $('#PlayVideoModal').modal('show');
   
   });
   
   
   
</script>
@endsection
