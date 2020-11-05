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
                        <h3 class="card-label font-weight-bolder text-dark">{{ __('position.Account Information') }}</h3>
                        <span class="text-muted font-weight-bold font-size-sm mt-1">{{ __('position.Update your personal informaiton') }}</span>
                     </div>
                  </div>
                  <form class="form" method="post" action="" enctype="multipart/form-data">
                     {{ csrf_field() }}
                     <div class="card-body">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="col-form-label">{{ __('position.Username') }} <span class="required">*</span></label>
                                 <input class="form-control form-control-lg form-control-solid" placeholder="{{ __('position.Username') }}" name="username" value="{{ old('username') }}" type="text" />
                                 <div class="required">{{ $errors->first('username') }}</div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="col-form-label">{{ __('position.Password') }}</label>
                                 <input class="form-control form-control-lg form-control-solid" placeholder="{{ __('position.Password') }}" name="password" type="password" />
                                 <div class="required">{{ $errors->first('password') }}</div>
                              </div>
                           </div>
                        </div>
                        <hr />
                        <div class="row">
                           <div class="col-lg-12 col-xl-12">
                              <h5 class="font-weight-bold mt-10 mb-6" style="margin-top: 8px !important;">{{ __('position.Personal Information') }}</h5>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label for="position" class="col-form-label">{{__("position.What's the title of your position?")}} <span class="required">*</span></label>
                                 <select id="position" name="position" required class="form-control form-control-lg form-control-solid">
                                    <option value="">{{ __('position.Select') }}</option>
                                    @foreach($get_position as $value_p)
                                    <option {{ (old('position') == $value_p->id)  ? 'selected' : '' }} value="{{ $value_p->id }}">{{ $value_p->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="type_of_school" class="col-form-label">{{__('position.What type of your school?')}} <span class="required">*</span></label>
                                 <select id="type_of_school" name="type_of_school" required class="form-control form-control-lg form-control-solid">
                                    <option value="">{{ __('position.Select') }}</option>
                                    @foreach($get_school_type as $value_s)
                                    <option {{ (old('type_of_school') == $value_s->id)  ? 'selected' : '' }}  value="{{ $value_s->id }}">{{ $value_s->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="job_type" class="col-form-label">{{__("position.What's type of position will you provide?")}} <span class="required">*</span></label>
                                 <select id="job_type" name="job_type" required class="form-control form-control-lg form-control-solid">
                                    <option value="">{{ __('position.Select') }}</option>
                                    @foreach($get_job_type as $value_w)
                                    <option  {{ (old('job_type') == $value_w->id)  ? 'selected' : '' }} value="{{ $value_w->id }}">{{ $value_w->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                        </div>
                        <hr />
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group text-center">
                                 <label style="font-size: 16px;">
                                 {{__("position.What's the location of your school?")}}
                                 <input type="hidden" value="44" name="country_id" id="country_id">
                                 </label>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="col-form-label">{{__("position.State")}} <span class="required">*</span></label>
                                 <select name="state_id" required class="form-control form-control-lg form-control-solid StateChange" id="1" >
                                    <option value="">{{ __('position.Select') }}</option>
                                    @foreach($get_state as $value_s)
                                    <option  value="{{ $value_s->id }}" >{{ $value_s->getName() }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="col-form-label">{{__("position.City")}} <span class="required">*</span></label>
                                 <select name="city_id" required id="getCity1" class="form-control form-control-lg form-control-solid">
                                    <option value="">{{ __('position.Select') }}</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="is_english_speaker" class="col-form-label">{{__('position.Do you need this teacher is a Native English Speaker or not?')}} <span class="required">*</span></label>
                                 <select id="is_english_speaker" name="is_english_speaker" required class="form-control form-control-lg form-control-solid">
                                    <option value="">{{ __('position.Select') }}</option>
                                    <option {{ (old('is_english_speaker') == 'Yes')  ? 'selected' : '' }} value="Yes">{{__("position.Yes")}}</option>
                                    <option {{ (old('is_english_speaker') == 'No')  ? 'selected' : '' }} value="No">{{__("position.No")}}</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="visa_type" class="col-form-label">{{__('position.What type of visa do you require for teachers?')}} <span class="required">*</span></label>
                                 <select id="visa_type" name="visa_type_id" required class="form-control form-control-lg form-control-solid">
                                    <option value="">{{ __('position.Select') }}</option>
                                    @foreach($get_visa_type as $visa_type)
                                    <option {{ (old('visa_type_id') == $visa_type->id)  ? 'selected' : '' }} value="{{ $visa_type->id }}">{{ $visa_type->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="general_location" class="col-form-label">{{__("position.What's the general location of your school?")}} <span class="required">*</span></label>
                                 <select id="general_location" name="general_location" required class="form-control form-control-lg form-control-solid">
                                    <option value="">{{ __('position.Select') }}</option>
                                    @foreach($get_general_location as $general_location)
                                    <option {{ (old('general_location') == $general_location->id)  ? 'selected' : '' }} value="{{ $general_location->id }}">{{ $general_location->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="teacher_start" class="col-form-label">{{__("position.When you need new teachers join the new work?")}} <span class="required">*</span></label>
                                 <select id="teacher_start" name="teacher_start" required class="form-control form-control-lg form-control-solid">
                                    <option value="">{{ __('position.Select') }}</option>
                                    @foreach($get_start_date as $value_p)
                                    <option {{ (old('teacher_start') == $value_p->id)  ? 'selected' : '' }} value="{{ $value_p->id }}">{{ $value_p->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="salary_minimum" class="col-form-label">{{__("position.Salary Minimum Provided")}} <span class="required">*</span></label>
                                 <select id="salary_minimum" name="salary_minimum" required class="form-control form-control-lg form-control-solid">
                                    <option value="">{{ __('position.Select') }}</option>
                                    @foreach($get_salary as $value_s)
                                    <option {{ (old('salary_minimum') == $value_s->id)  ? 'selected' : '' }} value="{{ $value_s->id }}">{{ $value_s->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="salary_maximum" class="col-form-label">{{__("position.Salary Maximum Provided")}} <span class="required">*</span></label>
                                 <select id="salary_maximum" name="salary_maximum" required class="form-control form-control-lg form-control-solid">
                                    <option value="">{{ __('position.Select') }}</option>
                                    @foreach($get_salary as $value_s)
                                    <option  {{ (old('salary_maximum') == $value_s->id)  ? 'selected' : '' }} value="{{ $value_s->id }}">{{ $value_s->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="working_hours_per_week" class="col-form-label">{{__("position.Working hours per week")}} <span class="required">*</span></label>
                                 <select id="working_hours_per_week" name="working_hours_per_week" required class="form-control form-control-lg form-control-solid">
                                    <option value="">{{ __('position.Select') }}</option>
                                    @for($i=1; $i<=50; $i++)
                                    <option {{ (old('working_hours_per_week') == $i)  ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="working_schedule" class="col-form-label">{{__("position.Working Schedule")}} <span class="required">*</span></label>
                                 <select id ="working_schedule" name="working_schedule" required class="form-control form-control-lg form-control-solid">
                                    <option value="">{{ __('position.Select') }}</option>
                                    @foreach($get_working_schedule as $working_schedule)
                                    <option {{ (old('working_schedule') == $working_schedule->id)  ? 'selected' : '' }} value="{{ $working_schedule->id }}">{{ $working_schedule->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="class_size" class="col-form-label">{{__("position.Class size for teacher")}} <span class="required">*</span></label>
                                 <select id="class_size" name="class_size" required class="form-control form-control-lg form-control-solid">
                                    <option value="">{{ __('position.Select') }}</option>
                                    @for($i=1; $i<=50; $i++)
                                    <option {{ (old('class_size') == $i)  ? 'selected' : '' }}  value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="minimum_age" class="col-form-label">{{__("position.Minimum Age requirement")}} <span class="required">*</span></label>
                                 <select id="minimum_age" name="minimum_age" required class="form-control form-control-lg form-control-solid">
                                    <option value="">{{ __('position.Select') }}</option>
                                    @for($i=18; $i<=65; $i++)
                                    <option {{ (old('minimum_age') == $i)  ? 'selected' : '' }}  value="{{ $i }}">{{ $i }} {{__("ysr")}}</option>
                                    @endfor
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="maximum_age" class="col-form-label">{{__("position.Maximum Age requirement")}} <span class="required">*</span></label>
                                 <select id="maximum_age" name="maximum_age" required class="form-control form-control-lg form-control-solid">
                                    <option value="">{{ __('position.Select') }}</option>
                                    @for($i=18; $i<=65; $i++)
                                    <option {{ (old('maximum_age') == $i)  ? 'selected' : '' }} value="{{ $i }}">{{ $i }} {{__("ysr")}}</option>
                                    @endfor
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label class="col-form-label">{{__("position.Welfare Provided (Multiple Selections)")}}</label>
                                 @foreach($get_welfare as $value_welfare)
                                 <div class="checkbox-inline" style="margin-bottom: 5px;"> 
                                    <label class="checkbox">
                                    <input  type="checkbox" value="{!! $value_welfare->id !!}" name="welfare[]">
                                    <span></span>
                                    {!! $value_welfare->getName() !!}
                                    </label>
                                 </div>
                                 @endforeach                   
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label class="col-form-label">{{__("position.Photo of your school environment (Maximum 6 photos)")}}</label>
                                 <input type="file" name="school_environment[]" accept="image/*" multiple class="form-control form-control-lg form-control-solid">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label class="col-form-label">{{__("position.Photo of teacher's accommodation (Maximum 6 photos)")}}</label>
                                 <input type="file" name="teachers_accommodation[]" accept="image/*" multiple class="form-control form-control-lg form-control-solid">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="col-form-label">{{__("position.Contact name")}} <span class="required">*</span></label>
                                 <input class="form-control form-control-lg form-control-solid" required type="text" value="{{ old('name') }}" placeholder="{{__("position.Contact name")}}" name="name" />
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="col-form-label">{{__("position.Contact phone number")}} <span class="required">*</span></label>
                                 <input class="form-control form-control-lg form-control-solid" required type="text" placeholder="{{__("position.Contact phone number")}}" value="{{ old('phone_number') }}" name="phone_number"/>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="col-form-label">{{__("position.Wechat ID")}}</label>
                                 <input class="form-control form-control-lg form-control-solid"  type="text" value="{{ old('wechat_id') }}" placeholder="{{__("position.Wechat ID")}}"  name="wechat_id" />
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="col-form-label">{{__("position.School name")}} <span class="required">*</span></label>
                                 <input class="form-control form-control-lg form-control-solid" required type="text" placeholder="{{__("position.School name")}}" value="{{ old('school_name') }}" name="school_name"/>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="col-form-label">{{__("position.Expiry Date")}} <span class="required">*</span></label>
                                 <input class="form-control form-control-lg form-control-solid" type="date" required value="{{ old('expiry_date') }}" placeholder="{{__("position.Expiry Date")}}" name="expiry_date" />
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="col-form-label">{{__("position.Email Address")}} <span class="required">*</span></label>
                                 <input class="form-control form-control-lg form-control-solid" required type="email" placeholder="{{__("position.Email Address")}}" value="{{ old('email') }}" name="email"/>
                              </div>
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-lg-12 col-xl-12 text-right">
                              <br />
                              <button type="submit" class="btn btn-success mr-2">{{__("position.Submit")}}</button>
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
   
   
</script>
@endsection
