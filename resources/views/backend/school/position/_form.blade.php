
@if(!empty($job))
    <form class="form" method="post" action="{{ url('school/position/edit/'.$job->id) }}" enctype="multipart/form-data">
@else
<form class="form" method="post" action="" enctype="multipart/form-data">
 @endif
    {{ csrf_field() }}
    <div class="card-body">

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="position" class="col-form-label">{{__("position.What's the title of your position?")}} <span class="required">*</span></label>
                    <select id="position" name="position" required class="form-control form-control-lg form-control-solid">
                        <option value="">{{__("position.Select")}}</option>
                        @foreach($get_position as $value_p)
                            <option @if(!empty($job)) {{ ($job->position_id == $value_p->id) ? 'selected' : '' }} @endif
                                    value="{{ $value_p->id }}">{{ $value_p->name }}</option>
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
                        <option value="">{{__("position.Select")}}</option>
                        @foreach($get_school_type as $value_s)
                            <option @if(!empty($job)) {{ ($job->type_of_school_id == $value_s->id) ? 'selected' : '' }} @endif value="{{ $value_s->id }}">{{ $value_s->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="job_type" class="col-form-label">{{__("position.What's type of position will you provide?")}} <span class="required">*</span></label>
                    <select id="job_type" name="job_type" required class="form-control form-control-lg form-control-solid">
                        <option value="">{{__("position.Select")}}</option>
                        @foreach($get_job_type as $value_w)
                            <option @if(!empty($job)) {{ ($job->job_type_id == $value_w->id) ? 'selected' : '' }} @endif value="{{ $value_w->id }}">{{ $value_w->name }}</option>
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
                        <option value="">{{__("position.Select")}}</option>
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

                    <label class="col-form-label">{{__("position.City")}} <span class="required">*</span></label>
                    <select name="city_id" required id="getCity1" class="form-control form-control-lg form-control-solid">
                        <option value="">{{__("position.Select")}}</option>
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
                        <option value="">{{__("position.Select")}}</option>
                        <option @if(!empty($job)) {{ ($job->is_english_speaker == 'Yes') ? 'selected' : '' }} @endif value="Yes">{{__("Yes")}}</option>
                        <option @if(!empty($job)) {{ ($job->is_english_speaker == 'No') ? 'selected' : '' }} @endif value="No">{{__("No")}}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="visa_type" class="col-form-label">{{__('position.What type of visa do you require for teachers?')}} <span class="required">*</span></label>
                    <select id="visa_type" name="visa_type_id" required class="form-control form-control-lg form-control-solid">
                        <option value="">{{__("position.Select")}}</option>
                      @foreach($get_visa_type as $visa_type)
                          <option  @if(!empty($job)) {{ ($job->visa_type_id == $visa_type->id) ? 'selected' : '' }} @endif value="{{ $visa_type->id }}">{{ $visa_type->name }}</option>
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
                        <option value="">{{__("position.Select")}}</option>
                        @foreach($get_general_location as $general_location)
                            <option @if(!empty($job)) {{ ($job->general_location_id == $general_location->id) ? 'selected' : '' }} @endif value="{{ $general_location->id }}">{{ $general_location->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="teacher_start" class="col-form-label">{{__("position.When you need new teachers join the new work?")}} <span class="required">*</span></label>
                    <select id="teacher_start" name="teacher_start" required class="form-control form-control-lg form-control-solid">
                        <option value="">{{__("position.Select")}}</option>
                        @foreach($get_start_date as $value_p)
                            <option @if(!empty($job)) {{ ($job->teacher_start_id == $value_p->id) ? 'selected' : '' }} @endif value="{{ $value_p->id }}">{{ $value_p->name }}</option>
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
                        <option value="">{{__("position.Select")}}</option>
                        @foreach($get_salary as $value_s)
                            <option @if(!empty($job)) {{ ($job->salary_minimum_id == $value_s->id) ? 'selected' : '' }} @endif value="{{ $value_s->id }}">{{ $value_s->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="salary_maximum" class="col-form-label">{{__("position.Salary Maximum Provided")}} <span class="required">*</span></label>
                    <select id="salary_maximum" name="salary_maximum" required class="form-control form-control-lg form-control-solid">
                        <option value="">{{__("position.Select")}}</option>
                        @foreach($get_salary as $value_s)
                            <option @if(!empty($job)) {{ ($job->salary_maximum_id == $value_s->id) ? 'selected' : '' }} @endif value="{{ $value_s->id }}">{{ $value_s->name }}</option>
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
                        <option value="">{{__("position.Select")}}</option>
                        @for($i=1; $i<=50; $i++)
                            <option @if(!empty($job)) {{ ($job->working_hours_per_week == $i) ? 'selected' : '' }} @endif value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="working_schedule" class="col-form-label">{{__("position.Working Schedule")}} <span class="required">*</span></label>
                    <select id ="working_schedule" name="working_schedule" required class="form-control form-control-lg form-control-solid">
                        <option value="">{{__("position.Select")}}</option>
                        @foreach($get_working_schedule as $working_schedule)
                            <option @if(!empty($job)) {{ ($job->working_schedule_id == $working_schedule->id) ? 'selected' : '' }} @endif  value="{{ $working_schedule->id }}">{{ $working_schedule->name }}</option>
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
                        <option value="">{{__("position.Select")}}</option>
                        @for($i=1; $i<=50; $i++)
                            <option  @if(!empty($job)) {{ ($job->class_size == $i) ? 'selected' : '' }} @endif value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="minimum_age" class="col-form-label">{{__("position.Minimum Age requirement")}} <span class="required">*</span></label>
                    <select id="minimum_age" name="minimum_age" required class="form-control form-control-lg form-control-solid">
                        <option value="">{{__("position.Select")}}</option>
                        @for($i=18; $i<=65; $i++)
                            <option @if(!empty($job)) {{ ($job->minimum_age == $i) ? 'selected' : '' }} @endif  value="{{ $i }}">{{ $i }} {{__("ysr")}}</option>
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
                        <option value="">{{__("position.Select")}}</option>
                        @for($i=18; $i<=65; $i++)
                            <option @if(!empty($job)) {{ ($job->maximum_age == $i) ? 'selected' : '' }} @endif  value="{{ $i }}">{{ $i }} {{__("ysr")}}</option>
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
       <div class="col-md-3">
        <img alt="" style="height: 100px; width: 100%;" src="{{ url('upload/school/'.$school_environment->image_name) }}">
        <a href="{{ url('school/position/environment/delete/'.$school_environment->job_id.'/'.$school_environment->id.'') }}" style="background: #dc3545;padding: 6px;margin-top: 5px;margin-bottom: 5px;text-transform: capitalize;font-weight: normal;" class="btn btn-danger">{{__("Delete")}}</a>
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
           <div class="col-md-3">
            <img alt="" style="height: 100px; width: 100%;" src="{{ url('upload/school/'.$teachers_accommodation->image_name) }}">
            <a href="{{ url('school/position/accommodation/delete/'.$teachers_accommodation->job_id.'/'.$teachers_accommodation->id.'') }}" style="background: #dc3545;padding: 6px;margin-top: 5px;margin-bottom: 5px;text-transform: capitalize;font-weight: normal;" class="btn btn-danger">{{__("Delete")}}</a>
          </div>
    @endforeach
</div>
@endif


        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-form-label">{{__("position.Contact name")}} <span class="required">*</span></label>
                    <input class="form-control form-control-lg form-control-solid" required type="text" value="{{ $user->name }}" placeholder="{{__("position.Contact name")}}" name="contact_name" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-form-label">{{__("position.Contact phone number")}} <span class="required">*</span></label>
                    <input class="form-control form-control-lg form-control-solid" required type="text" placeholder="{{__("position.Contact phone number")}}" value="{{ $user->phone_number }}" name="phone_number"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-form-label">{{__("position.Wechat ID")}}</label>
                    <input class="form-control form-control-lg form-control-solid"  type="text" value="{{ $user->wechat_id }}" placeholder="{{__("position.Wechat ID")}}"  name="wechat_id" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-form-label">{{__("position.School name")}} <span class="required">*</span></label>
                    <input class="form-control form-control-lg form-control-solid" required type="text" placeholder="{{__("position.School name")}}" value="{{ $user->school_name }}" name="school_name"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-form-label">{{__("position.Expiry Date")}} <span class="required">*</span></label>
                    <input class="form-control form-control-lg form-control-solid" type="date" required value="{{ old('expiry_date',(!empty($job))?$job->expiry_date : '') }}" placeholder="{{__("position.Expiry Date")}}" name="expiry_date" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-form-label">{{__("position.Email Address")}} <span class="required">*</span></label>
                    <input class="form-control form-control-lg form-control-solid" required type="email" placeholder="{{__("position.Email Address")}}" value="{{ $user->email }}" name="email_address"/>
                </div>
            </div>
        </div>


        <div class="form-group row">
            <div class="col-lg-12 col-xl-12 text-right">
                <br />
                @if(!empty($job))
                <button type="submit" class="btn btn-success mr-2">{{__("position.Update Position")}}</button>
                @else
                <button type="submit" class="btn btn-success mr-2">{{__("position.Create Position")}}</button>
                @endif
                
            </div>
        </div>
    </div>
    <!--end::Body-->
</form>
<!--end::Form-->