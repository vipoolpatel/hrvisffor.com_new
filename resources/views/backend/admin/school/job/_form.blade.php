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
</style>
<form class="form" method="post" action="" enctype="multipart/form-data">
 {{ csrf_field() }}
 <div class="card-body" style="padding-top: 10px;">
    <div class="row">
       <div class="col-md-6">
          <div class="form-group">
             <label class="col-form-label">{{ __('position.Username') }} <span class="required">*</span></label>
             <input id="CheckUsername" data-val="{!! !empty($user) ? $user->id : '' !!}" class="form-control form-control-lg form-control-solid" placeholder="{{ __('position.Username') }}" name="username" value="{{ old('username',!empty($user) ? $user->username : '' ) }}" type="text" />
             <div class="required" id="getUsernameMessage">{{ $errors->first('username') }}</div>
          </div>
       </div>
       <div class="col-md-6">
          <div class="form-group">
             <label class="col-form-label">{{ __('position.Password') }}</label>
             <input class="form-control form-control-lg form-control-solid" {{ !empty($user) ? '' : 'required' }} placeholder="{{ __('position.Password') }}" name="password" type="password" />
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
             <select id="position" name="position_id" required class="form-control form-control-lg form-control-solid">
                <option value="">{{ __('position.Select') }}</option>
                @foreach($get_position as $value_p)
                <option {{ (old('position_id',!empty($job) ? $job->position_id : '') == $value_p->id)  ? 'selected' : '' }} value="{{ $value_p->id }}">{{ $value_p->name }}</option>
                @endforeach
             </select>
          </div>
       </div>
    </div>
    <div class="row">
       <div class="col-md-6">
          <div class="form-group">
             <label for="type_of_school" class="col-form-label">{{__('position.What type of your school?')}} <span class="required">*</span></label>
             <select id="type_of_school" name="type_of_school_id" required class="form-control form-control-lg form-control-solid">
                <option value="">{{ __('position.Select') }}</option>
                @foreach($get_school_type as $value_s)
                <option {{ (old('type_of_school_id',!empty($job) ? $job->type_of_school_id : '') == $value_s->id)  ? 'selected' : '' }}  value="{{ $value_s->id }}">{{ $value_s->name }}</option>
                @endforeach
             </select>
          </div>
       </div>
       <div class="col-md-6">
          <div class="form-group">
             <label for="job_type" class="col-form-label">{{__("position.What's type of position will you provide?")}} <span class="required">*</span></label>
             <select id="job_type" name="job_type_id" required class="form-control form-control-lg form-control-solid">
                <option value="">{{ __('position.Select') }}</option>
                @foreach($get_job_type as $value_w)
                <option  {{ (old('job_type_id',!empty($job) ? $job->job_type_id : '') == $value_w->id)  ? 'selected' : '' }} value="{{ $value_w->id }}">{{ $value_w->name }}</option>
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
             <label class="col-form-label">{{ __('position.State') }} <span class="required">*</span></label>
             <select name="state_id" required class="form-control form-control-lg form-control-solid StateChange" id="1" >
                <option value="">{{ __('position.Select') }}</option>
                @foreach($get_state as $value_s)
                <option @if(!empty($job)) {{ ($job->state_id == $value_s->id) ? 'selected' : '' }} @endif value="{{ $value_s->id }}" >{{ $value_s->getName() }}</option>
                @endforeach
             </select>
          </div>
       </div>
       <div class="col-md-6">
          <div class="form-group">
              @php
              if(!empty($job)) {
                $getCity = App\Models\CityModel::get_state_city($job->state_id);
              }
                @endphp

             <label class="col-form-label">{{ __('position.City') }} <span class="required">*</span></label>
             <select name="city_id" required id="getCity1" class="form-control form-control-lg form-control-solid">
                <option value="">{{ __('position.Select') }}</option>
                @if(!empty($job))
                     @foreach($getCity as $value_city)
                    <option {{ ($job->city_id == $value_city->id) ? 'selected' : '' }} value="{{ $value_city->id }}">{{ $value_city->getName() }}</option>
                    @endforeach
                @endif
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
                <option {{ (old('is_english_speaker',!empty($job) ? $job->is_english_speaker : '') == 'Yes')  ? 'selected' : '' }} value="Yes">{{__("Yes")}}</option>
                <option {{ (old('is_english_speaker',!empty($job) ? $job->is_english_speaker : '') == 'No')  ? 'selected' : '' }} value="No">{{__("No")}}</option>
             </select>
          </div>
       </div>
       <div class="col-md-6">
          <div class="form-group">
             <label for="visa_type" class="col-form-label">{{__('position.What type of visa do you require for teachers?')}} <span class="required">*</span></label>
             <select id="visa_type" name="visa_type_id" required class="form-control form-control-lg form-control-solid">
                <option value="">{{ __('position.Select') }}</option>
                @foreach($get_visa_type as $visa_type)
                <option {{ (old('visa_type_id',!empty($job) ? $job->visa_type_id : '') == $visa_type->id)  ? 'selected' : '' }} value="{{ $visa_type->id }}">{{ $visa_type->name }}</option>
                @endforeach
             </select>
          </div>
       </div>
    </div>
    <div class="row">
       <div class="col-md-6">
          <div class="form-group">
             <label for="general_location" class="col-form-label">{{__("position.What's the general location of your school?")}} <span class="required">*</span></label>
             <select id="general_location" name="general_location_id" required class="form-control form-control-lg form-control-solid">
                <option value="">{{ __('position.Select') }}</option>
                @foreach($get_general_location as $general_location)
                <option {{ (old('general_location_id',!empty($job) ? $job->general_location_id : '') == $general_location->id)  ? 'selected' : '' }} value="{{ $general_location->id }}">{{ $general_location->name }}</option>
                @endforeach
             </select>
          </div>
       </div>
       <div class="col-md-6">
          <div class="form-group">
             <label for="teacher_start" class="col-form-label">{{__("position.When you need new teachers join the new work?")}} <span class="required">*</span></label>
             <select id="teacher_start" name="teacher_start_id" required class="form-control form-control-lg form-control-solid">
                <option value="">{{ __('position.Select') }}</option>
                @foreach($get_start_date as $value_p)
                <option {{ (old('teacher_start_id',!empty($job) ? $job->teacher_start_id : '') == $value_p->id)  ? 'selected' : '' }} value="{{ $value_p->id }}">{{ $value_p->name }}</option>
                @endforeach
             </select>
          </div>
       </div>
    </div>
    <div class="row">
       <div class="col-md-6">
          <div class="form-group">
             <label for="salary_minimum" class="col-form-label">{{__("position.Salary Minimum Provided")}} <span class="required">*</span></label>
             <select id="salary_minimum" name="salary_minimum_id" required class="form-control form-control-lg form-control-solid">
                <option value="">{{ __('position.Select') }}</option>
                @foreach($get_salary as $value_s)
                <option {{ (old('salary_minimum_id',!empty($job) ? $job->salary_minimum_id : '') == $value_s->id)  ? 'selected' : '' }} value="{{ $value_s->id }}">{{ $value_s->name }}</option>
                @endforeach
             </select>
          </div>
       </div>
       <div class="col-md-6">
          <div class="form-group">
             <label for="salary_maximum" class="col-form-label">{{__("position.Salary Maximum Provided")}} <span class="required">*</span></label>
             <select id="salary_maximum" name="salary_maximum_id" required class="form-control form-control-lg form-control-solid">
                <option value="">{{ __('position.Select') }}</option>
                @foreach($get_salary as $value_s)
                <option  {{ (old('salary_maximum_id',!empty($job) ? $job->salary_maximum_id : '') == $value_s->id)  ? 'selected' : '' }} value="{{ $value_s->id }}">{{ $value_s->name }}</option>
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
                <option {{ (old('working_hours_per_week',!empty($job) ? $job->working_hours_per_week : '') == $i)  ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                @endfor
             </select>
          </div>
       </div>
       <div class="col-md-6">
          <div class="form-group">
             <label for="working_schedule" class="col-form-label">{{__("position.Working Schedule")}} <span class="required">*</span></label>
             <select id ="working_schedule" name="working_schedule_id" required class="form-control form-control-lg form-control-solid">
                <option value="">{{ __('position.Select') }}</option>
                @foreach($get_working_schedule as $working_schedule)
                <option {{ (old('working_schedule_id',!empty($job) ? $job->working_schedule_id : '') == $working_schedule->id)  ? 'selected' : '' }} value="{{ $working_schedule->id }}">{{ $working_schedule->name }}</option>
                @endforeach
             </select>
          </div>
       </div>
    </div>
    <div class="row">
       <div class="col-md-4">
          <div class="form-group">
             <label for="class_size" class="col-form-label">{{__("position.Class size for teacher")}} <span class="required">*</span></label>
             <select id="class_size" name="class_size" required class="form-control form-control-lg form-control-solid">
                <option value="">{{ __('position.Select') }}</option>
                @for($i=1; $i<=50; $i++)
                <option {{ (old('class_size',!empty($job) ? $job->class_size : '') == $i)  ? 'selected' : '' }}  value="{{ $i }}">{{ $i }}</option>
                @endfor
             </select>
          </div>
       </div>
       <div class="col-md-4">
          <div class="form-group">
             <label for="minimum_age" class="col-form-label">{{__("position.Minimum Age requirement")}} <span class="required">*</span></label>
             <select id="minimum_age" name="minimum_age" required class="form-control form-control-lg form-control-solid">
                <option value="">{{ __('position.Select') }}</option>
                @for($i=18; $i<=65; $i++)
                <option {{ (old('minimum_age',!empty($job) ? $job->minimum_age : '') == $i)  ? 'selected' : '' }}  value="{{ $i }}">{{ $i }} {{__("ysr")}}</option>
                @endfor
             </select>
          </div>
       </div>
        <div class="col-md-4">
          <div class="form-group">
             <label for="maximum_age" class="col-form-label">{{__("position.Maximum Age requirement")}} <span class="required">*</span></label>
             <select id="maximum_age" name="maximum_age" required class="form-control form-control-lg form-control-solid">
                <option value="">{{ __('position.Select') }}</option>
                @for($i=18; $i<=65; $i++)
                <option {{ (old('maximum_age',!empty($job) ? $job->maximum_age : '') == $i)  ? 'selected' : '' }} value="{{ $i }}">{{ $i }} {{__("ysr")}}</option>
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
                @php
                    $selected = '';
                @endphp
                @if(!empty($job))
                    @foreach($job->job_welfare as $job_welfare_value)
                        @if($job_welfare_value->welfare_id == $value_welfare->id)
                            @php
                            $selected = 'checked';
                            @endphp
                        @endif
                    @endforeach
                @endif

             <div class="checkbox-inline" style="margin-bottom: 5px;"> 
                <label class="checkbox">
                <input  type="checkbox" {{ $selected }} value="{!! $value_welfare->id !!}" name="welfare[]">
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

@if(!empty($job) && !empty(count($job->job_school_environment)))
<div class="row">
    @foreach($job->job_school_environment as $school_environment)
       <div class="col-md-2">
        <img alt="" style="height: 100px; width: 100%;" src="{{ url('upload/school/'.$school_environment->image_name) }}">
        <a href="{{ url('school/position/environment/delete/'.$school_environment->job_id.'/'.$school_environment->id.'') }}" style="background: #dc3545;padding: 6px;margin-top: 5px;margin-bottom: 5px;text-transform: capitalize;font-weight: normal;" class="btn btn-danger">{{__("position.Delete")}}</a>
      </div>
    @endforeach
</div>
@endif

    <div class="row">
       <div class="col-md-12">
          <div class="form-group">
             <label class="col-form-label">{{__("position.Photo of teacher's accommodation (Maximum 6 photos)")}}</label>
             <input type="file" name="teachers_accommodation[]" accept="image/*" multiple class="form-control form-control-lg form-control-solid">
          </div>
       </div>
    </div>

@if(!empty($job) && !empty(count($job->job_teachers_accommodation)))
<div class="row">
   @foreach($job->job_teachers_accommodation as $teachers_accommodation)
           <div class="col-md-2">
            <img alt="" style="height: 100px; width: 100%;" src="{{ url('upload/school/'.$teachers_accommodation->image_name) }}">
            <a href="{{ url('school/position/accommodation/delete/'.$teachers_accommodation->job_id.'/'.$teachers_accommodation->id.'') }}" style="background: #dc3545;padding: 6px;margin-top: 5px;margin-bottom: 5px;text-transform: capitalize;font-weight: normal;" class="btn btn-danger">{{__("position.Delete")}}</a>
          </div>
    @endforeach
</div>
@endif


    <div class="row">
       <div class="col-md-4">
          <div class="form-group">
             <label class="col-form-label">{{__("position.Contact name")}} <span class="required">*</span></label>
             <input class="form-control form-control-lg form-control-solid" required type="text" value="{{ old('name',!empty($user) ? $user->name : '') }}" placeholder="{{__("position.Contact name")}}" name="name" />
          </div>
       </div>
       <div class="col-md-4">
          <div class="form-group">
             <label class="col-form-label">{{__("position.Contact phone number")}} <span class="required">*</span></label>
             <input class="form-control form-control-lg form-control-solid" required type="text" placeholder="{{__("position.Contact phone number")}}" value="{{ old('phone_number',!empty($user) ? $user->phone_number : '') }}" name="phone_number"/>
          </div>
       </div>

        <div class="col-md-4">
            <div class="form-group">
               <label class="col-form-label">{{__("position.Staff")}} <span class="required">*</span></label>
               <select name="staff_id" required class="form-control form-control-lg form-control-solid">
                  <option value="">{{ __('position.Select') }}</option>
                  @foreach($get_record_staff as $value_staff)
                  <option {{ (old('staff_id', !empty($user->staff_id) ? $user->staff_id : '') == $value_staff->id) ? 'selected' : '' }} value="{{ $value_staff->id }}">{{ $value_staff->name }} {{ $value_staff->last_name }}</option>
                  @endforeach
               </select>
            </div>
         </div>


    </div>
    <div class="row">
       <div class="col-md-6">
          <div class="form-group">
             <label class="col-form-label">{{__("position.Wechat ID")}}</label>
             <input class="form-control form-control-lg form-control-solid"  type="text" value="{{ old('wechat_id',!empty($user) ? $user->wechat_id : '') }}" placeholder="{{__("position.Wechat ID")}}"  name="wechat_id" />
          </div>
       </div>
       <div class="col-md-6">
          <div class="form-group">
             <label class="col-form-label">{{__("position.School name")}} <span class="required">*</span></label>
             <input class="form-control form-control-lg form-control-solid" required type="text" placeholder="{{__("position.School name")}}" value="{{ old('school_name',!empty($user) ? $user->school_name : '') }}" name="school_name"/>
          </div>
       </div>
    </div>
    <div class="row">
       <div class="col-md-6">
          <div class="form-group">
             <label class="col-form-label">{{__("position.Expiry Date")}} <span class="required">*</span></label>
             <input class="form-control form-control-lg form-control-solid" type="date" required value="{{ old('expiry_date',!empty($job) ? $job->expiry_date : '') }}" placeholder="{{__("position.Expiry Date")}}" name="expiry_date" />
          </div>
       </div>
       <div class="col-md-6">
          <div class="form-group">
             <label class="col-form-label">{{__("position.Email Address")}} </label>
             <input class="form-control form-control-lg form-control-solid"  type="email" placeholder="{{__("position.Email Address")}}" value="{{ old('email',!empty($user) ? $user->email : '') }}" name="email"/>
          </div>
       </div>
    </div>

    <div class="row">
        <div class="col-md-12">
          <div class="form-group">
             <label class="col-form-label">{{__("position.Notes")}} </label>
             <textarea class="form-control form-control-lg form-control-solid" name="note">{{ old('note',!empty($job) ? $job->note : '') }}</textarea>             
          </div>
        </div>
    </div>


    <div class="form-group row">
       <div class="col-lg-12 col-xl-12 text-right">
          <br />
          <button type="submit" class="btn btn-success mr-2">{{ __('position.Submit') }}</button>
       </div>
    </div>
 </div>
 <!--end::Body-->
</form>

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
                           $('#getUsernameMessage').html('{{ __('position.Username already register please choose another') }}');
                        }
                 },
            });

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


</script>

@endsection