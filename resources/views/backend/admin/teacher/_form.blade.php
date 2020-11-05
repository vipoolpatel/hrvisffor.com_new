<style type="text/css">
   .form-group {
   margin-bottom: 8px;
   }
    select {
       -moz-appearance:none; 
      -webkit-appearance:none;
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

<form class="form" action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="visa_id" value="{{ old('visa_id',!empty($user->visa_id) ? $user->visa_id : '') }}" id="r_visa_id">

    <input type="hidden" name="teacher_id" value="{{ !empty($user) ? $user->teacher_id : $getTeacherID }}">

   {{ csrf_field() }}
   <div class="card-body" style="padding-top: 0px;">
      <div class="row">
         <div class="col-md-4">
            <label style="width: 100%" class="col-form-label">{{ __('profile.Profile Picture') }}</label>
            <div class="image-input image-input-outline image-input-empty" id="kt_profile_avatar" style="background-image: url({{ url('assets/media/users/blank.png')  }})">
               @if(!empty($user))
               <div class="image-input-wrapper" style="background-image: url({!! $user->getImage() !!});"></div>
               @else
               <div class="image-input-wrapper" style="background-image: none;"></div>
               @endif
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
         <div class="col-md-6">
            <div class="form-group">
               <label class="col-form-label">{{ __('profile.Self-Introduction Video') }}</label>
               <p>{{ __('profile.Please tell use the following in your video (1-2 minutes)') }}:</p>
               <p>{{ __('profile.Name + Age + Nationality + Your degree and major + Working Experience + A fun fact about you + Anything else you want your new employer to know about you') }}</p>
               <div class="uppy" id="kt_uppy_5">

                  <div class="uppy-wrapper">
                     <div class="uppy-Root uppy-FileInput-container">
                        <input class="uppy-FileInput-input uppy-input-control user_video" accept="video/*" type="file" name="user_video" id="kt_uppy_5_input_control">
                        <label class="uppy-input-label btn btn-light-primary btn-sm btn-bold" for="kt_uppy_5_input_control"> {{ __('profile.Select Self-Introduction Video') }} </label>
                        @if(!empty($user) && !empty($user->getVideo()))
                        <a href="javascript:;" id="{!! $user->getVideo() !!}" style="margin-top: -8px;" class="btn btn-icon btn-light btn-hover-primary btn-sm PlayVideo"><i class="flaticon2-download-1 text-primary"></i></a>
                        @endif
                     </div>
                  </div>
                  <p id="get_user_video_name"></p>

            <div class="row" style="margin-bottom: 20px;">
                     @if(!empty($user))
                        @foreach($user->get_video as $get_video)
                           @if(!empty($get_video->getVideo()))
                           <div class="col-md-3">
                              <a href="javascript:;" id="{!! $get_video->getVideo() !!}" style="margin-top: -8px;" class="btn btn-icon btn-light btn-hover-primary btn-sm PlayVideo"><i class="flaticon2-download-1 text-primary"></i></a>

                              <a onclick="return confirm('{{ __('profile.Are you sure you want to delete?') }}')" href="{{ url('admin/teacher/video_delete/'.$get_video->id) }}" class="btn btn-sm btn-danger">{{ __('profile.Delete') }}</a>

                           </div>
                           @endif
                        @endforeach
                     @endif
            </div>
                  

                  <div class="row">
                     <div class="col-md-12">
                        <div class="uppy-wrapper">
                           <div class="uppy-Root uppy-FileInput-container">
                              <input class="uppy-FileInput-input uppy-input-control multi_user_video" accept="video/*" type="file" name="multi_user_video[]" data-val="500" id="multi_user_video500">
                              <label class="uppy-input-label btn btn-light-primary btn-sm btn-bold" for="multi_user_video500"> {{ __('profile.Select Demo Video (Recommended)') }}</label>
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
         <div class="col-md-2">
            <div class="form-group">
               <label class="col-form-label">{{ __('profile.CV Upload') }}</label>
               <div class="uppy" id="kt_uppy_5">
                  <div class="uppy-wrapper">
                     <div class="uppy-Root uppy-FileInput-container">
                        <input class="uppy-FileInput-input uppy-input-control cv_upload" type="file" name="cv_upload" id="kt_uppy_5_input_controlCV">
                        <label class="uppy-input-label btn btn-light-primary btn-sm btn-bold" for="kt_uppy_5_input_controlCV">{{ __('profile.Select CV Upload') }}</label>
                        @if(!empty($user) && !empty($user->getCV()))
                        <a href="{!! $user->getCV() !!}" target="_blank" style="margin-top: -8px;" class="btn btn-icon btn-light btn-hover-primary btn-sm"><i class="flaticon2-download-1 text-primary"></i></a>
                        @endif
                     </div>
                  </div>
               </div>
                <p id="get_cv_upload_name"></p>
            </div>

             <div class="form-group">
               <label class="col-form-label">{{ __('profile.Staff CV Upload') }}</label>
               <div class="uppy" id="kt_uppy_5">
                  <div class="uppy-wrapper">
                     <div class="uppy-Root uppy-FileInput-container">
                        <input class="uppy-FileInput-input uppy-input-control staff_cv_upload" type="file" name="staff_cv_upload" id="kt_uppy_5_input_controlCVStaff">
                        <label class="uppy-input-label btn btn-light-primary btn-sm btn-bold" for="kt_uppy_5_input_controlCVStaff">{{ __('profile.Public CV Upload') }}</label>
                        @if(!empty($user) && !empty($user->getStaffCVUpload()))
                        <a href="{!! $user->getStaffCVUpload() !!}" target="_blank" style="margin-top: -8px;" class="btn btn-icon btn-light btn-hover-primary btn-sm"><i class="flaticon2-download-1 text-primary"></i></a>
                        @endif
                     </div>
                  </div>
               </div>
                <p id="get_staff_cv_upload"></p>
            </div>


         </div>

         


      </div>
      <div class="row">
         <div class="col-md-4">
            <div class="form-group">
               <label class="col-form-label">{{ __('profile.Username') }} <span class="required">*</span></label>
               <input id="CheckUsername" data-val="{!! !empty($user) ? $user->id : '' !!}" class="form-control form-control-lg form-control-solid" placeholder="{{ __('profile.Username') }}" value="{!! old('username', !empty($user->username) ? $user->username : '' ) !!}" name="username" required type="text" />
               <div class="required" id="getUsernameMessage">{{ $errors->first('username') }}</div>
            </div>
         </div>
         <div class="col-md-4">
            <div class="form-group">
               <label class="col-form-label">{{ __('profile.Password') }} {!! !empty($user) ? '' : '<span class="required">*</span>' !!}</label>
               <input class="form-control form-control-lg form-control-solid" placeholder="{{ __('profile.Password') }}" {{ !empty($user) ? '' : 'required' }} value="" name="password" type="password" />
               <div class="required">{{ $errors->first('password') }}</div>
            </div>
         </div>
         <div class="col-md-4">
            <div class="form-group">
               <label class="col-form-label">{{ __('profile.Email') }}</label>
               <input class="form-control form-control-lg form-control-solid" placeholder="{{ __('profile.Email') }}" type="email" value="{!! old('email', !empty($user->email) ? $user->email : '' ) !!}" name="email"/>
               <div class="required">{{ $errors->first('email') }}</div>
            </div>
         </div>
      </div>

      <div class="row">

         <div class="col-md-8">
            <div class="form-group">
               <label class="col-form-label">{{ __('profile.Instant Messenger') }} </label>
               @if(!empty($user))
              @forelse($user->get_instant_messenger as $instant_messenger)
               <div style="margin-bottom: 2px;"> 
                  <select required name="instant_messenger_id[]" class="instant-messenger-first form-control form-control-lg form-control-solid">
                     <option value="">{{ __('profile.Select') }}</option>
                     @foreach($get_instant_messenger as $value_messenger)
                     <option {{ ($instant_messenger->instant_messenger_id == $value_messenger->id) ? 'selected' : '' }} value="{{ $value_messenger->id }}">{{ $value_messenger->getName() }}</option>
                     @endforeach
                  </select>
                  <input class="instant-messenger-second form-control form-control-lg form-control-solid" placeholder="{{ __('profile.Instant Messenger') }}" type="text" value="{{ $instant_messenger->name }}" name="instant_messenger_name[]" required  />

                  <a style="display: inline;" href="{{ url('teacher/profile/instant_messenger/delete/'.$instant_messenger->id) }}" class="btn btn-danger btn-sm">{{ __('profile.Remove') }}</a>
               </div>
               @empty
               @endforelse
               @endif

               <div>
                  <select name="instant_messenger_id[]" class="instant-messenger-first form-control form-control-lg form-control-solid">
                     <option value="">{{ __('profile.Select') }}</option>
                     @foreach($get_instant_messenger as $value_messenger)
                     <option value="{{ $value_messenger->id }}">{{ $value_messenger->getName() }}</option>
                     @endforeach
                  </select>
                  <input class="instant-messenger-second form-control form-control-lg form-control-solid" placeholder="{{ __('profile.Instant Messenger') }}" type="text"  name="instant_messenger_name[]"  />

                  <button style="display: inline;box-shadow: none;" type="button" class="btn btn-primary btn-sm AddNewInstantMessenger">{{ __('profile.Add') }}</button>

               </div>

               <div class="AppendNewInstantMessenger"></div>

            </div>
         </div>
      </div>


       <div class="row">

        <div class="col-md-4">
            <div class="form-group">
               <label class="col-form-label">{{ __('profile.Phone Number') }}</label>
               <div>

               <select style="width: 150px;display: inline;"  name="country_id" class="form-control form-control-lg form-control-solid">
                     <option value="">{{ __('profile.Country Code') }}</option>
                     @foreach($get_country as $value_country)
                        <option {{ ( old('country_id',!empty($user->country_id) ? $user->country_id : '') == $value_country->id) ? "selected" : '' }} value="{{ $value_country->id }}">{{ $value_country->getName() }}</option>
                     @endforeach
               </select>

               <input style="max-width: 240px;display: inline;" class="form-control form-control-lg form-control-solid" placeholder="{{ __('profile.Country Code') }}" type="text" value="{{ old('phone_number', !empty($user->phone_number) ? $user->phone_number : '') }}" name="phone_number"   />
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
               <input class="form-control form-control-lg form-control-solid" placeholder="{{ __('profile.First Name') }}" type="text" value="{!! old('name', !empty($user->name) ? $user->name : '' ) !!}" name="name" required />
               <div class="required">{{ $errors->first('name') }}</div>
            </div>
         </div>

         <div class="col-md-3">
            <div class="form-group">
               <label class="col-form-label">{{ __('profile.Last Name') }}</label>
               <input class="form-control form-control-lg form-control-solid" placeholder="{{ __('profile.Last Name') }}" type="text" value="{!! old('last_name', !empty($user->last_name) ? $user->last_name : '' ) !!}" name="last_name"   />
               <div class="required">{{ $errors->first('last_name') }}</div>
            </div>
         </div>


           <div class="col-md-3">
            <div class="form-group">
               <label class="col-form-label">{{ __('profile.Gender') }}</label>
                <select class="form-control form-control-lg form-control-solid" name="gender_id">
                     <option value="">{{ __('profile.Select Gender') }}</option>
                     @foreach($get_gender as $value_ge)
                       <option {{ (old('gender_id',!empty($user) ? $user->gender_id : '') == $value_ge->id) ? 'selected' : '' }} value="{{ $value_ge->id }}">{{ $value_ge->getName() }}</option>
                     @endforeach
               </select>

               <div class="required">{{ $errors->first('gender_id') }}</div>
            </div>
         </div>


         <div class="col-md-3">
            <div class="form-group">
               <label class="col-form-label">{{ __('profile.Age') }} <span class="required">*</span></label>
               <select name="age" required class="form-control form-control-lg form-control-solid">
                  <option value="">{{ __('profile.Select') }}</option>
                  @for($i=18; $i<=65; $i++)
                  <option {{ (old('age', !empty($user->age) ? $user->age : '' ) == $i) ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                  @endfor
               </select>
            </div>
         </div>


       
         
      </div>


      <div class="row">

         <div class="col-md-4">
            <div class="form-group">
               <label class="col-form-label">{{ __('profile.Nationality (Please tell us your passort nationality)') }} <span class="required">*</span></label>
               <select name="nationality_id" id="nationality_id" required class="general_chine form-control form-control-lg form-control-solid">
                  <option value="">{{ __('profile.Select') }}</option>
                  @foreach($get_nationality as $value_n)
                  <option data-val="{{ $value_n->is_native }}" {{ (old('nationality_id', !empty($user->nationality_id) ? $user->nationality_id : '' ) == $value_n->id) ? 'selected' : '' }} value="{{ $value_n->id }}">{{ $value_n->getName() }}</option>
                  @endforeach
               </select>
            </div>
         </div>

         <div class="col-md-4">
            <div class="form-group">
               <label class="col-form-label">{{ __('profile.Native English Speaker or not?') }}</label>
               <input class="form-control form-control-lg form-control-solid" type="text" readonly="" id="r_english_speaker" name="is_native_english" value="{{ old('is_native_english', !empty($user->is_native_english) ? $user->is_native_english : 'No' ) }}">
            </div>
         </div>

         <div class="col-md-4">
            <div class="form-group">
               <label class="col-form-label">{{ __('profile.Educational Level') }} <span class="required">*</span></label>
               <select name="educaton_level_id" id="educaton_level_id" required class="general_chine form-control form-control-lg form-control-solid">
                  <option value="">{{ __('profile.Select') }}</option>
                  @foreach($get_educaton_level as $value_edu)
                  <option {{ (old('educaton_level_id', !empty($user->educaton_level_id) ? $user->educaton_level_id : '' ) == $value_edu->id) ? 'selected' : '' }} value="{{ $value_edu->id }}">{{ $value_edu->getName() }}</option>
                  @endforeach
               </select>
            </div>
         </div>
         
        
      </div>


      <div class="row">
         
         <div class="col-md-4 hide_show_native">
            <div class="form-group">
               <label class="col-form-label">>{{ __('profile.Have you graduated two years or more?') }} <span class="required">*</span></label>
               <select name="is_graduated" id="is_graduated"  class="general_chine form-control form-control-lg form-control-solid clear_value_native">
                  <option value="">{{ __('profile.Select') }}</option>
                  <option {{ (old('is_graduated', !empty($user->is_graduated) ? $user->is_graduated : '' ) == 'Yes') ? 'selected' : '' }} value="Yes">{{ __('profile.Yes') }}</option>
                  <option {{ (old('is_graduated', !empty($user->is_graduated) ? $user->is_graduated : '' ) == 'No') ? 'selected' : '' }} value="No">{{ __('profile.No') }}</option>
               </select>
            </div>
         </div>
     
         <div class="col-md-4 hide_show_native">
            <div class="form-group">
               <label class="col-form-label">{{ __('profile.Is Your Subject related to education or English?') }} <span class="required">*</span></label>
               <select name="is_education_english"  class="form-control form-control-lg form-control-solid clear_value_native">
                  <option value="">{{ __('profile.Select') }}</option>
                  <option {{ (old('is_education_english', !empty($user->is_education_english) ? $user->is_education_english : '' ) == 'Yes') ? 'selected' : '' }} value="Yes">{{ __('profile.Yes') }}</option>
                  <option {{ (old('is_education_english', !empty($user->is_education_english) ? $user->is_education_english : '' ) == 'No') ? 'selected' : '' }} value="No">{{ __('profile.No') }}</option>
               </select>
            </div>
         </div>
         <div class="col-md-4 hide_show_native">
            <div class="form-group">
               <label class="col-form-label">{{ __('profile.Did you study in native English speaking countries?') }} <span class="required">*</span></label>
               <select name="is_native_english_speaking"  class="form-control form-control-lg form-control-solid clear_value_native">
                  <option value="">{{ __('profile.Select') }}</option>
                  <option {{ (old('is_native_english_speaking', !empty($user->is_native_english_speaking) ? $user->is_native_english_speaking : '' ) == 'Yes') ? 'selected' : '' }} value="Yes">{{ __('profile.Yes') }}</option>
                  <option {{ (old('is_native_english_speaking', !empty($user->is_native_english_speaking) ? $user->is_native_english_speaking : '' ) == 'No') ? 'selected' : '' }} value="No">{{ __('profile.No') }}</option>
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
                  <option {{ (old('experience', !empty($user->experience) ? $user->experience : '' ) == $i) ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                  @endfor
               </select>
            </div>
         </div>

      </div>


      <div class="row">
         <div class="col-md-12">
            <div class="form-group">
               <label class="col-form-label">{{ __('profile.Bio') }}</label>
               <textarea class="form-control form-control-lg form-control-solid" name="bio" placeholder="{{ __('profile.Bio') }}">{!! old('bio',!empty($user->bio) ? $user->bio : '') !!}</textarea>
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
                  <option {{ (old('job_type_id', !empty($user->job_type_id) ? $user->job_type_id : '') == $value_job->id) ? 'selected' : '' }} value="{{ $value_job->id }}">{{ $value_job->getName() }}</option>
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
                  <option {{ (old('current_location_id', !empty($user->current_location_id) ? $user->current_location_id : '' ) == $value_lo->id) ? 'selected' : '' }} value="{{ $value_lo->id }}">{{ $value_lo->getName() }}</option>
                  @endforeach
               </select>
            </div>
         </div>

         <div class="col-md-4" id="hide_current_visa_type_id">
            <div class="form-group">
               <label class="col-form-label">{{ __('profile.Current visa type') }} </label>
               <select name="current_visa_type_id" id="current_visa_type_id" class="form-control form-control-lg form-control-solid">
                  <option value="">{{ __('profile.Select') }}</option>
                  @foreach($get_current_visa_type as $value_visa)
                  <option {{ (old('current_visa_type_id', !empty($user->current_visa_type_id) ? $user->current_visa_type_id : '') == $value_visa->id) ? 'selected' : '' }} value="{{ $value_visa->id }}">{{ $value_visa->getName() }}</option>
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
                  <option {{ (old('start_date_id', !empty($user->start_date_id) ? $user->start_date_id : '') == $value_start->id) ? 'selected' : '' }} value="{{ $value_start->id }}">{{ $value_start->getName() }}</option>
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
                  <option {{ (old('area_id', !empty($user->area_id) ? $user->area_id : '') == $value_area->id) ? 'selected' : '' }} value="{{ $value_area->id }}">{{ $value_area->getName() }}</option>
                  @endforeach
               </select>
            </div>
         </div>
      </div>


      @php
      $countStateCity = 0;
      @endphp

      @if(!empty($user))

@php
$i_s = 500;
$countStateCity = $user->get_location->count();
@endphp



      @forelse($user->get_location as $value_location)
      @php
      $getCity = App\Models\CityModel::get_state_city($value_location->state_id);
      $i_s++;
      @endphp
      <div class="row">
         <div class="col-md-5">
            <div class="form-group">
               <label class="col-form-label">{{ __('profile.Province') }} <span class="required">*</span></label>
               <select name="state_id[]" required class="form-control form-control-lg form-control-solid StateChange" id="{{ $i_s }}" >
                  <option value="">{{ __('profile.Select') }}</option>
                  @foreach($get_state as $value_s)
                  <option {{ ($value_location->state_id == $value_s->id) ? 'selected' : '' }} value="{{ $value_s->id }}">{{ $value_s->getName() }}</option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="col-md-5">
            <div class="form-group">
               <label class="col-form-label">{{ __('profile.City') }} <span class="required">*</span></label>
               <select name="city_id[]" required id="getCity{{ $i_s }}" class="form-control form-control-lg form-control-solid">
                  <option value="">{{ __('profile.Select') }}</option>
                  @foreach($getCity as $value_city)
                  <option {{ ($value_location->city_id == $value_city->id) ? 'selected' : '' }} value="{{ $value_city->id }}">{{ $value_city->getName() }}</option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="col-md-2">
            <div class="form-group">
               <label class="col-form-label">&nbsp;</label>
               <br />
               <a href="{{ url('teacher/profile/location/delete/'.$value_location->id) }}" class="btn btn-danger">{{ __('profile.Remove') }}</a>
            </div>
         </div>
      </div>
      @empty
      @endforelse
      @endif
      <div class="row">
         <div class="col-md-5">
            <div class="form-group">
               <label class="col-form-label">{{ __('profile.Province') }} {!! ($countStateCity == 0) ? '<span class="required">*</span>' : '' !!}</label>
               <select name="state_id[]"  {{ ($countStateCity == 0) ? 'required' : '' }}  class="form-control form-control-lg form-control-solid StateChange" id="1" >
                  <option value="">{{ __('profile.Select') }}</option>
                  @foreach($get_state as $value_s)
                  <option value="{{ $value_s->id }}">{{ $value_s->getName() }}</option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="col-md-5">
            <div class="form-group">
               <label class="col-form-label">{{ __('profile.City') }} {!! ($countStateCity == 0) ? '<span class="required">*</span>' : '' !!}</label>
               <select name="city_id[]"  {{ ($countStateCity == 0) ? 'required' : '' }}  id="getCity1" class="form-control form-control-lg form-control-solid">
                  <option value="">{{ __('profile.Select') }}</option>
               </select>
            </div>
         </div>
         <div class="col-md-2">
            <div class="form-group">
               <label class="col-form-label">&nbsp;</label>
               <br />
               <button type="button" style="box-shadow: none;" class="btn btn-primary AddNewLocation">{{ __('profile.Add') }}</button>
            </div>
         </div>
      </div>
      <div class="AppendNewLocation"></div>
  
      <hr />


      <div class="row">
       
         <div class="col-md-6">
            <div class="form-group">
               <label class="col-form-label">{{ __('profile.Minimum Salary Monthly') }} <span class="required">*</span></label>
               <select name="minimum_salary_id" required class="form-control form-control-lg form-control-solid">
                  <option value="">{{ __('profile.Select') }}</option>
                  @foreach($get_salary as $value_min)
                  <option {{ (old('minimum_salary_id', !empty($user->minimum_salary_id) ? $user->minimum_salary_id : '') == $value_min->id) ? 'selected' : '' }} value="{{ $value_min->id }}">{!! $value_min->getName() !!}</option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="col-md-6">
            <div class="form-group">
               <label class="col-form-label">{{ __('profile.Maximum Salary Monthly') }} <span class="required">*</span></label>
               <select name="maximum_salary_id" required class="form-control form-control-lg form-control-solid">
                  <option value="">{{ __('profile.Select') }}</option>
                  @foreach($get_salary as $value_max)
                  <option {{ (old('maximum_salary_id', !empty($user->maximum_salary_id) ? $user->maximum_salary_id : '') == $value_max->id) ? 'selected' : '' }} value="{{ $value_max->id }}">{!! $value_max->getName() !!}</option>
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
                  @php
                  $selected = '';
                  @endphp
                  @if(!empty($user))
                  @foreach($user->get_school_type as $user_school_type)
                  @if($user_school_type->school_type_id == $value_school->id)
                  @php
                  $selected = 'checked';
                  @endphp
                  @endif
                  @endforeach
                  @endif
                  <label class="checkbox">
                  <input {{ $selected }} type="checkbox" value="{!! $value_school->id !!}" name="school_type[]">
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
                  <option {{ (old('position_id', !empty($user->position_id) ? $user->position_id : '') == $value_po->id) ? 'selected' : '' }} value="{{ $value_po->id }}">{{ $value_po->getName() }}</option>
                  @endforeach
               </select>
            </div>
         </div>
      </div>



     
      <div class="row">
{{--          <div class="col-md-6">
            <div class="form-group">
               <label class="col-form-label">Available Interview Time</label>
               <input class="form-control form-control-lg form-control-solid" type="text" value="{!! old('interview_time', !empty($user->interview_time) ? $user->interview_time : '') !!}" placeholder="Available Interview Time" name="interview_time" />
            </div>
         </div> --}}
         <div class="col-md-12">
            <div class="form-group">
               <label class="col-form-label">{{ __('profile.Other Contract Requirements') }}</label>
               <input class="form-control form-control-lg form-control-solid" type="text" placeholder="{{ __('profile.Other Contract Requirements') }}" value="{!! old('others', !empty($user->others) ? $user->others : '') !!}" name="others"/>
            </div>
         </div>
      </div>


<div style="display: none;">
      @if(!empty($user))
      <hr />
      <div class="row">
         <div class="col-lg-12 col-xl-12">
            <h5 class="font-weight-bold mt-10 mb-6" style="margin-top: 8px !important;"><button class="btn btn-primary" type="button">Education History (Optional)</button></h5>
            <div class="table-responsive">
                <table class="table bordered">
                  <tr>
                     <th>Start Date</th>
                     <th>End Date</th>
                     <th>School Name</th>
                     <th>Country</th>
                     <th>Major</th>
                     <th>Degree</th>
                     <th>Action</th>
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
                        <td class="100%">Record not found</td>
                     </tr>
                     @endforelse
                  </tbody>
               </table>
               <a href="javascript:;" id="AddEducation">Add Education</a>
            </div>
         </div>
      </div>
      <hr />
      <div class="row">
         <div class="col-lg-12 col-xl-12">
            <h5 class="font-weight-bold mt-10 mb-6" style="margin-top: 8px !important;"><button class="btn btn-primary" type="button">Working Experience (Optional)</button></h5>
            <div class="table-responsive">
               <table class="table bordered">
                  <tr>
                     <th>Start Date</th>
                     <th>End Date</th>
                     <th>Company Name</th>
                     <th>Position</th>
                     <th>Title</th>
                     <th>Duty</th>
                     <th>Action</th>
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
                        <td class="100%">Record not found</td>
                     </tr>
                     @endforelse

                  </tbody>
               </table>

               <a href="javascript:;" id="AddExperience">Add Experience</a>
            </div>
         </div>
      </div>
      @endif
      

   </div>

   <hr />



      <div class="row">
         <div class="col-md-3">
            <div class="form-group">
               <label class="col-form-label">{{ __('profile.Teacher type') }} <span class="required">*</span></label>
               <select name="teacher_type_id" required class="form-control form-control-lg form-control-solid">
                  <option value="">{{ __('profile.Select') }}</option>
                  @foreach($get_teacher_type as $value_teacher_type)
                  <option {{ (old('teacher_type_id', !empty($user->teacher_type_id) ? $user->teacher_type_id : '') == $value_teacher_type->id) ? 'selected' : '' }} value="{{ $value_teacher_type->id }}">{{ $value_teacher_type->getName() }}</option>
                  @endforeach
               </select>
            </div>
         </div>
        
         <div class="col-md-3">
            <div class="form-group">
               <label class="col-form-label">{{ __('profile.Colour') }} <span class="required">*</span></label>
               <select name="color_id" required class="form-control form-control-lg form-control-solid">
                  <option value="">{{ __('profile.Select') }}</option>
                  @foreach($get_colour as $value_co)
                  <option {{ (old('color_id', !empty($user->color_id) ? $user->color_id : '') == $value_co->id) ? 'selected' : '' }} value="{{ $value_co->id }}">{{ $value_co->getName() }}</option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="col-md-3">
            <div class="form-group">
               <label class="col-form-label">{{ __('profile.Card Colour') }} <span class="required">*</span></label>
               <select name="card_colour_id" required class="form-control form-control-lg form-control-solid">
                  <option value="">{{ __('profile.Select') }}</option>
                  @foreach($get_card_colour as $value_color)
                  <option {{ (old('card_colour_id', !empty($user->card_colour_id) ? $user->card_colour_id : '') == $value_color->id) ? 'selected' : '' }} value="{{ $value_color->id }}">{{ $value_color->getName() }}</option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="col-md-3">
            <div class="form-group">
               <label class="col-form-label">{{ __('profile.Staff') }} <span class="required">*</span></label>
               <select name="staff_id" required class="form-control form-control-lg form-control-solid">
                  <option value="">{{ __('profile.Select') }}</option>
                  @foreach($get_record_staff as $value_staff)
                  <option {{ (old('staff_id', !empty($user->staff_id) ? $user->staff_id : '') == $value_staff->id) ? 'selected' : '' }} value="{{ $value_staff->id }}">{{ $value_staff->name }} {{ $value_staff->last_name }}</option>
                  @endforeach
               </select>
            </div>
         </div>
      </div>
      <hr />
      <div class="row">
          <div class="col-md-3">
            <div class="form-group">
               <label class="col-form-label">{{ __('profile.Status') }} <span class="required">*</span></label>
               <select name="status" class="form-control form-control-lg form-control-solid">
                  <option {{ (old('status', !empty($user->status) ? $user->status : '0') == '1') ? 'selected' : '' }} value="1">{{ __('profile.Active') }}</option>
                  <option {{ (old('status', !empty($user->status) ? $user->status : '0') == '0') ? 'selected' : '' }} value="0">{{ __('profile.Inactive') }}</option>
               </select>
            </div>
         </div>
         <div class="col-md-3">
            <div class="form-group">
               <label class="col-form-label">{{ __('profile.Verify') }} <span class="required">*</span></label>
               <select name="verify" class="form-control form-control-lg form-control-solid">
                  <option {{ (old('verify', !empty($user->verify) ? $user->verify : '0') == '1') ? 'selected' : '' }} value="1">{{ __('profile.Verify') }}</option>
                  <option {{ (old('verify', !empty($user->verify) ? $user->verify : '0') == '0') ? 'selected' : '' }} value="0">{{ __('profile.Unverify') }}</option>
               </select>
            </div>
         </div>
  
      </div>


    <div class="row">
        <div class="col-md-12">
          <div class="form-group">
             <label class="col-form-label">{{__("profile.Notes")}} </label>
             <textarea class="form-control form-control-lg form-control-solid" name="note">{{ old('note',!empty($user) ? $user->note : '') }}</textarea>             
          </div>
        </div>
    </div>
    

      <hr/>
      <div class="form-group row">
         <div class="col-lg-12 col-xl-12 text-right">
            <br />
            <button type="submit" class="btn btn-success mr-2">{{__("profile.Submit")}}</button>
         </div>
      </div>
   </div>
</form>

@if(!empty($user))
<div class="modal fade" id="PlayVideoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ __('profile.Self-Introduction Video') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
            </button>
         </div>
         <div class="modal-body" id="SetVideoURL">
            
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('profile.Close') }}</button>
         </div>
      </div>
   </div>
</div>


<div class="modal fade" id="AddEditEducationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Education</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
            </button>
         </div>
         <form action="{{ url('teacher/profile/education/add') }}" method="post" >
            {{ csrf_field() }}
            <input type="hidden" name="id" id="get_education_id">
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Start Date</label>
                        <input class="form-control form-control-lg form-control-solid" placeholder="Start Date" type="date" id="get_start_date" name="start_date" required>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>End Date</label>
                        <input class="form-control form-control-lg form-control-solid" placeholder="Start Date" type="date" id="get_end_date" name="end_date" required>
                     </div>
                  </div>
               </div>

                <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>School Name</label>
                        <input class="form-control form-control-lg form-control-solid" placeholder="School Name" type="text" id="get_school_name" name="school_name" required>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group" >
                        <label>Country</label>
                        <select class="form-control form-control-lg form-control-solid" id="get_country_id" name="country_id" required>
                           <option value="">{{ __('profile.Select') }}</option>
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
                        <label>Major</label>
                        <input class="form-control form-control-lg form-control-solid" placeholder="Major" type="text" id="get_major" name="major" required>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Degree</label>
                        <input class="form-control form-control-lg form-control-solid" placeholder="Degree" type="text" id="get_degree" name="degree" required>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-light-primary font-weight-bold" >Save</button>
            </div>
         </form>
      </div>
   </div>
</div>



<div class="modal fade" id="AddEditExperienceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Experience</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
            </button>
         </div>
         <form action="{{ url('teacher/profile/experience/add') }}" method="post" >
            {{ csrf_field() }}
            <input type="hidden" name="id" id="e_get_experience_id">
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Start Date</label>
                        <input class="form-control form-control-lg form-control-solid" placeholder="Start Date" type="date" id="e_get_start_date" name="start_date" required>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>End Date</label>
                        <input class="form-control form-control-lg form-control-solid" placeholder="Start Date" type="date" id="e_get_end_date" name="end_date" required>
                     </div>
                  </div>
               </div>

                <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Company Name</label>
                        <input class="form-control form-control-lg form-control-solid" placeholder="Company Name" type="text" id="e_get_company_name" name="company_name" required>
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Position</label>
                        <input class="form-control form-control-lg form-control-solid" placeholder="Position" type="text" id="e_get_position" name="position" required>
                     </div>
                  </div>
               </div>

                 <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Title</label>
                        <input class="form-control form-control-lg form-control-solid" placeholder="Title" type="text" id="e_get_title" name="title" required>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Duty</label>
                        <input class="form-control form-control-lg form-control-solid" placeholder="Duty" type="text" id="e_get_duty" name="duty" required>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-light-primary font-weight-bold" >Save</button>
            </div>
         </form>
      </div>
   </div>
</div>


@endif


@section('script')
<script type="text/javascript">
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


   $('.staff_cv_upload'). change(function(e){
         var fileName = e. target. files[0]. name;
         $('#get_staff_cv_upload').html(fileName);
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

      current_location();
   
   
   $('body').delegate('.PlayVideo','click',function(){
         var src = $(this).attr('id');
         $('#SetVideoURL').html('<video width="100%" height="300" controls>\n\
                  <source  src="'+src+'" type="video/mp4">\n\
               </video>');
         $('#PlayVideoModal').modal('show');
   });
   
   
   
</script>
@endsection
