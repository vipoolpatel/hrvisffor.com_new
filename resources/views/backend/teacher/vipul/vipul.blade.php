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
   <div class="subheader py-2 py-lg-12  subheader-transparent " id="kt_subheader">
      <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
         <div class="d-flex align-items-center flex-wrap mr-1">
            <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none" id="kt_subheader_mobile_toggle">
            <span></span>
            </button>
            <div class="d-flex flex-column">
               <h2 class="text-white font-weight-bold my-2 mr-5">
                 Vipul
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
                        <h3 class="card-label font-weight-bolder text-dark">Tell us something about yourself</h3>
                        
                     </div>
                  </div>

{{-- form start --}}
<form class="form" method="post" action="" enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class="card-body">
		<div class="row">
			<div class="col-md-4">
          <label style="width: 100%" class="col-form-label">Profile Picture</label>
          <div class="image-input image-input-outline image-input-empty" id="kt_profile_avatar" style="background-image: url({{ url('assets/media/users/blank.png')  }})">
             <div class="image-input-wrapper" style="background-image: url('assets/media/users/blank.png');"></div>
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
          <span class="form-text text-muted">
            Please upload your picture as as PNG, JPG or JPEG (max 10MB)
          </span>
       </div>

       <div class="col-md-5">
          <div class="form-group">
             <label class="col-form-label">
                Self-Introduction Video
             </label>

             <p>
                Please tell use the following in your video (1-2 minutes) :</p>
             <p>
                Name + Age + Nationality + Your degree and major + Working Experience + A fun fact about you + Anything else you want your new employer to know about you
             </p>
             
             <div class="uppy" id="kt_uppy_5">
                <div class="uppy-wrapper">
                   <div class="uppy-Root uppy-FileInput-container">
                      <input class="uppy-FileInput-input uppy-input-control user_video" accept="video/*" type="file" name="user_video" id="kt_uppy_5_input_control">
                      <label class="uppy-input-label btn btn-light-primary btn-sm btn-bold" for="kt_uppy_5_input_control">
                      Select Self-Introduction Video</label>
               
                      
               
                   </div>
                </div>
                <p id="get_user_video_name"></p>

              

                <div class="row">
                   <div class="col-md-12">
                      <div class="uppy-wrapper">
                         <div class="uppy-Root uppy-FileInput-container">
                            <input class="uppy-FileInput-input uppy-input-control multi_user_video" accept="video/*" type="file" name="multi_user_video[]" data-val="500" id="multi_user_video500">
                            <label class="uppy-input-label btn btn-light-primary btn-sm btn-bold" for="multi_user_video500">
                              Select Demo Video (Recommended)
                            </label>
                            <a href="javascript:;" id="AppendVideo" style="margin-left: 10px;margin-top: -3px;" class="btn btn-sm btn-success">Add</a>
                         </div>
                      </div>
                      <p id="get_multi_user_video500"></p>
                   </div>
                </div>
                <div id="getMultiVideo"></div>

                
             </div>
          </div>
       </div>
          <div class="col-md-3">
          <div class="form-group">
             <label class="col-form-label">CV Upload <span class="required"> *</span></label>
             <div class="uppy" id="kt_uppy_5">
                <div class="uppy-wrapper">
                   <div class="uppy-Root uppy-FileInput-container">
                      <input class="uppy-FileInput-input uppy-input-control cv_upload" type="file" name="cv_upload" id="kt_uppy_5_input_controlCV">
                      <label class="uppy-input-label btn btn-light-primary btn-sm btn-bold" for="kt_uppy_5_input_controlCV">Select CV Upload</label>
                     
                   </div>
                </div>
             </div>
             <p id="get_cv_upload_name"></p>
          </div>
       </div>




		</div>
		<hr/>

		<div class="row">
           <div class="col-md-12">
              <div class="form-group">
                 <label class="col-form-label">Email <span class="required"> *</span></label>
                 <input class="form-control form-control-lg form-control-solid" placeholder="Email" required type="email" value="" name="email"/>
              </div>
           </div>
        </div>

        <div class="row">
           <div class="col-md-8">
              <div class="form-group">
                 <label class="col-form-label">Instant Messenger <span class="required"> *</span></label>
               
                 <div style="margin-bottom: 2px;">
                    <select required name="instant_messenger_id[]" class="instant-messenger-first form-control form-control-lg form-control-solid">
                       <option value="">Select</option>
                       <option value="Possible">Possible</option>
                       <option value="Work">Work</option>
                      
                    </select>
                    <input class="instant-messenger-second form-control form-control-lg form-control-solid" placeholder="Instant Messenger" type="text" value="" name="instant_messenger_name[]" required  />
                    <a style="display: inline;" href="" class="btn btn-danger btn-sm">Remove</a>
                 </div>
                
                 <div>
                    <select name="instant_messenger_id[]" class="instant-messenger-first form-control form-control-lg form-control-solid">
                    <option value="">Select</option>
                    
                    <option value="Surat">Surat</option>
                    <option value="Bhavnagar">Bhavnagar</option>
                    
                    </select>
                    <input class="instant-messenger-second form-control form-control-lg form-control-solid" placeholder="Instant Messenger" type="text"  name="instant_messenger_name[]" />
                    <button style="display: inline;box-shadow: none;" type="button" class="btn btn-primary btn-sm AddNewInstantMessenger">Add</button>
                 </div>
                 <div class="AppendNewInstantMessenger"></div>
              </div>
           </div>
        </div>

         <div class="row">
         <div class="col-md-6">
            <div class="form-group">
               <label class="col-form-label">Phone Number <span class="required">*</span></label>
               <div>
                  <select style="width: 150px;display: inline;" required name="country_id" class="form-control form-control-lg form-control-solid">
                     <option value="">Country Code</option>
                   
                     <option value="India">India</option>
                   
                  </select>
                  <input style="max-width: 248px;display: inline;" class="form-control form-control-lg form-control-solid" placeholder="Phone Number" type="text" value="" name="phone_number" required  />
               </div>
            </div>
         </div>
      </div>
       <hr />
        <div class="row">
           <div class="col-lg-12 col-xl-12">
              <h5 class="font-weight-bold mt-10 mb-6" style="margin-top: 8px !important;">Personal Information</h5>
           </div>
        </div>

        <div class="row">
             <div class="col-md-3">
                <div class="form-group">
                   <label class="col-form-label">First Name <span class="required"> *</span></label>
                   <input class="form-control form-control-lg form-control-solid" placeholder="First Name" type="text" value="" name="name" required />
                </div>
             </div>
             <div class="col-md-3">
                <div class="form-group">
                   <label class="col-form-label">Last Name </label>
                   <input class="form-control form-control-lg form-control-solid" placeholder="Last Name" type="text" value="" name="last_name"   />
                </div>
             </div>

             <div class="col-md-3">
                <div class="form-group">
                   <label class="col-form-label">Gender <span class="required"> *</span></label>
                   <select required class="form-control form-control-lg form-control-solid" name="gender_id">
                      <option value="">Select Gender</option>
                     
                      <option value="Male">Male</option>
                       <option value="FeMale">FeMale</option>
                     
                   </select>
                </div>
             </div>

             <div class="col-md-3">
                <div class="form-group">
                   <label class="col-form-label">Age <span class="required">*</span></label>
                   <select name="age" required class="form-control form-control-lg form-control-solid">
                      <option value="">Select</option>
                      @for($i=18; $i<=65; $i++)
                      <option value="{{ $i }}">{{ $i }}</option>
                      @endfor
                   </select>
                </div>
             </div>

          </div>

          <div class="row">
             <div class="col-md-6">
                <div class="form-group">
                   <label class="col-form-label">Nationality (Please tell us your passort nationality <span class="required"> *</span></label>
                   <select name="nationality_id" id="nationality_id" required class="general_chine form-control form-control-lg form-control-solid">
                      <option value="">Select</option>
                     
                      <option data-val="" value="">Indian boy</option>
                      <option data-val="" value="">Canada boy</option>
                      
                   </select>
                </div>
             </div>
          </div>

          <div class="row">
           <div class="col-md-6">
              <div class="form-group">
                 <label class="col-form-label">Educational Level <span class="required"> *</span></label>
                
                 <select name="educaton_level_id" id="educaton_level_id" required class="general_chine form-control form-control-lg form-control-solid">
                    <option value="">Select</option>
                    <option value="MCA">MCA</option>
                    <option value="MBA">MBA</option>
                   
                 </select>
              </div>
           </div>
        </div>

         <div class="row">
             <div class="col-md-6 hide_show_native">
                <div class="form-group">
                   <label class="col-form-label">Have you graduated two years or more?</label>
                   <select name="is_graduated" id="is_graduated"  class="general_chine form-control form-control-lg form-control-solid clear_value_native">
                      <option value="">Select</option>
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                   </select>
                </div>
             </div>
             <div class="col-md-6 hide_show_native">
                <div class="form-group">
                   <label class="col-form-label">Is Your Subject related to education or English?</label>
                   <select name="is_education_english"  class="form-control form-control-lg form-control-solid clear_value_native">
                      <option value="">Select</option>
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                   </select>
                </div>
             </div>
          </div>

 <div class="row">
     <div class="col-md-6 hide_show_native">
        <div class="form-group">
           <label class="col-form-label">Did you study in native English speaking countries?</label>
           <select name="is_native_english_speaking" class="form-control form-control-lg form-control-solid clear_value_native">
              <option value="">Select</option>
              <option value="Yes">Yes</option>
              <option value="No">No</option>
           </select>
        </div>
     </div>
  </div>

 <div class="row">
       <div class="col-md-6">
          <div class="form-group">
             <label class="col-form-label">Years of Working Experience <span class="required">*</span></label>
             <select name="experience" required class="form-control form-control-lg form-control-solid">
                <option value="">Select</option>
                @for($i=0; $i<=47; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
                @endfor
             </select>
          </div>
       </div>
    </div>

    <div class="row">
     <div class="col-md-12">
        <div class="form-group">
           <label class="col-form-label">Bio</label>
           <textarea class="form-control form-control-lg form-control-solid" name="bio" placeholder="Bio"></textarea>
        </div>
     </div>
  </div>

     <div class="row">
         <div class="col-md-6">
            <div class="form-group">
               <label class="col-form-label">Job Type <span class="required"> *</span></label>
               <select name="job_type_id" required class="form-control form-control-lg form-control-solid">
                  <option value="">Select</option>
                 <option value="">Placement</option>
                  <option value="">Marketing</option>
                
               </select>
            </div>
         </div>
      </div>


      <div class="row">
         <div class="col-md-6">
            <div class="form-group">
               <label class="col-form-label">Current Location <span class="required">*</span></label>
               <select name="current_location_id" id="current_location_id" required class="form-control form-control-lg form-control-solid">
                  <option value="">Select</option>
                  
                  <option value="Suart">Surat</option>
                  
               </select>
            </div>
         </div>
         <div class="col-md-6">
            <div class="form-group">
               <label class="col-form-label">Start Date <span class="required"> *</span></label>
               <select name="start_date_id" required class="form-control form-control-lg form-control-solid">
                  <option value="">Select</option>
                  
                  <option value="">Startdate</option>
                  
               </select>
            </div>
         </div>
      </div>
<div class="row" id="hide_current_visa_type_id">
     <div class="col-md-6">
        <div class="form-group">
           <label class="col-form-label">Current visa type</label>
           <select name="current_visa_type_id" id="current_visa_type_id" class="form-control form-control-lg form-control-solid">
              <option value="">Select</option>
              <option value="Visa">Visa</option>
              <option value="Master">Master</option>
           
           </select>
        </div>
     </div>
  </div>
  <hr />
      <div class="row">
         <div class="col-lg-12 col-xl-12">
            <h5 class="font-weight-bold mt-10 mb-6" style="margin-top: 8px !important;">Preferred area</h5>
         </div>
      </div>
      <div class="row">
         <div class="col-md-6">
            <div class="form-group">
               <label class="col-form-label">Area <span class="required">*</span></label>
               <select name="area_id" required class="form-control form-control-lg form-control-solid">
                  <option value="">Select</option>
                 
                  <option value="katar Game">katar Game</option>
                 
               </select>
            </div>
         </div>
      </div>

       <div class="row">
         <div class="col-md-5">
            <div class="form-group">
               <label class="col-form-label">Province <span class="required"> *</span></label>
               <select name="state_id[]" required id="" class="StateChange form-control form-control-lg form-control-solid"  >
                  <option value="">Select</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                  
               </select>
            </div>
         </div>
          
          <div class="col-md-5">
            <div class="form-group">
               <label class="col-form-label">City <span class="required"> *</span></label>
               <select name="city_id[]" required id="getCity" class="form-control form-control-lg form-control-solid">
                  <option value="">Select</option>
                  
                  <option value="BVS">BSA</option>
                  
               </select>
            </div>
         </div>
         <div class="col-md-2">
            <div class="form-group">
               <label class="col-form-label">&nbsp;</label>
               <br />
               <a href="" class="btn btn-sm btn-danger">Remove</a>
            </div>
         </div>
      </div>

          <div class="row">
           <div class="col-md-5">
              <div class="form-group">
                 <label class="col-form-label">Province</label>
                 <select name="state_id[]"  class="form-control form-control-lg form-control-solid StateChange" id="1" >
                    <option value="">Select</option>
               
                    <option value="POD">POD</option>
               
                 </select>
              </div>
           </div>
           <div class="col-md-5">
              <div class="form-group">
                 <label class="col-form-label">City</label>
                 <select name="city_id[]"  id="getCity1" class="form-control form-control-lg form-control-solid">
                    <option value="">Select</option>
                 </select>
              </div>
           </div>
           <div class="col-md-2">
              <div class="form-group">
                 <label class="col-form-label">&nbsp;</label>
                 <br />
                 <button type="button" style="box-shadow: none;" class="btn btn-primary btn-sm AddNewLocation">Add City</button>
              </div>
           </div>
        </div>
        <div class="AppendNewLocation"></div>
        <hr />







	</div>
	
</form>
						
{{-- form end --}}




               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection

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
                            <a href="javascript:;" id="'+i+'" style="margin-left: 10px;margin-top: -3px;" class="btn btn-sm btn-danger RemoveSelfVideo">Remove</a>\n\
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

  var j = 50;

  $('.AddNewInstantMessenger').click(function() {
    var html = '';
    html += '<div id="RemoveMainPartInstantMessenger'+j+'" style="margin-bottom: 2px;">\n\
    <select required name="instant_messenger_id[]"\n\
    class="instant-messenger-first form-control form-control-lg form-control-solid">\n\
    <option value=""></option>';
    html += '<option value=""></option><option value="Otp">Otp</option>';
    html += '</select>\n\
    <input class="instant-messenger-second form-control form-control-lg form-control-solid" placeholder="Instant Messenger" type="text" value="" name="instant_messenger_name[]" required  />\n\
    <button style="display: inline;" id="'+j+'" type="button" class="btn btn-danger btn-sm RemoveNewInstantMessenger">Remove </button>\n\
    </div>';

    $('.AppendNewInstantMessenger').append(html);
    j++;

  });
  $('body').delegate('.RemoveNewInstantMessenger','click', function(){
    var id = $(this).attr('id');
    $('#RemoveMainPartInstantMessenger'+id).remove();
  });

   
	
	</script>

@endsection