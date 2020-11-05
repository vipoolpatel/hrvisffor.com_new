<form class="form" method="post" action="" enctype="multipart/form-data">
   {{ csrf_field() }}
   <div class="card-body" style="padding-top: 10px;">
      <div class="row">
         <div class="col-md-6">
            <div class="form-group">
               <label for="position" class="col-form-label">{{__("travel.Teacher")}} <span class="required">*</span></label>
               <select  name="teacher_id" required class="form-control form-control-lg form-control-solid">
                  <option value="">{{__("travel.Select Teacher")}}</option>
                  @foreach($get_contract_teacher as $value)
                      <option {{ (!empty($travel) ? $travel->teacher_id : ''  == $value->teacher_id) ? 'selected' : '' }} value="{{ $value->teacher_id }}">{{ $value->teacher->name }} ({{ $value->teacher->teacher_id }})</option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="col-md-6">
            <div class="form-group">
               <label for="position" class="col-form-label">{{__("travel.Flight Ticket")}}</label>
               <input type="file" name="flight_ticket" class="form-control form-control-lg form-control-solid">   
               @if(!empty($travel) && !empty($travel->get_flight_ticket()))         
               <a class="btn btn-success btn-sm" href="{{ url($travel->get_flight_ticket()) }}" target="_blank">{{__("travel.Download")}}</a>
               @endif
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-6">
            <div class="form-group">
               <label  class="col-form-label">{{__("travel.You will be picked up by")}} <span class="required">*</span></label>
               <input type="text" name="picked_up_by" value="{{ !empty($travel) ? $travel->picked_up_by : '' }}" placeholder="{{__("travel.You will be picked up by")}}" class="form-control form-control-lg form-control-solid">
            </div>
         </div>
      </div>

       <div class="row">
         <div class="col-md-6">
            <div class="form-group">
               <label style="display: block;"  class="col-form-label">{{__("travel.Profile")}} <span class="required">*</span></label>

                  <div class="image-input image-input-outline image-input-empty" id="kt_profile_avatar" style="background-image: url({{ url('assets/media/users/blank.png') }})">
                     @if(!empty($travel) && !empty($travel->getImage()))
                     <div class="image-input-wrapper" style="background-image: url('{{ $travel->getImage()  }}');"></div>
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

            </div>
         </div>
      </div>

      <div class="row">
         <div class="col-md-6">
            <div class="form-group">
               <label class="col-form-label"> {{__("travel.Phone Number")}} <span class="required">*</span></label>
               <div>
                  <select style="width: 150px;display: inline;" required="" name="country_id" class="form-control form-control-lg form-control-solid">
                     <option  value=""> {{__("travel.Country Code")}}</option>
                     @foreach($get_country as $value_country)
                        <option  {{ (!empty($travel) ? $travel->country_id : ''  == $value_country->id) ? 'selected' : '' }} value="{{ $value_country->id }}">{{ $value_country->getName() }}</option>
                     @endforeach
                  </select>
                  <input style="max-width: 248px;display: inline;" class="form-control form-control-lg form-control-solid" placeholder="{{__("travel.Phone Number")}}" type="text" value="{{ !empty($travel) ? $travel->phone_number : '' }}" name="phone_number" required>
               </div>
            </div>
         </div>
         <div class="col-md-6">
            <div class="form-group">
               <label  class="col-form-label">{{__("travel.Email")}} <span class="required">*</span></label>
               <input type="email" name="email" required placeholder="{{__("travel.Email")}}" value="{{ !empty($travel) ? $travel->email : '' }}" class="form-control form-control-lg form-control-solid">
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-6">
            <div class="form-group">
               <label  class="col-form-label">{{__("travel.Skype")}} </label>
               <input type="text" name="skype" value="{{ !empty($travel) ? $travel->skype : '' }}" placeholder="{{__("travel.Skype")}}" class="form-control form-control-lg form-control-solid">
            </div>
         </div>
         <div class="col-md-6">
            <div class="form-group">
               <label  class="col-form-label"> {{__("travel.Wechat")}}</label>
               <input type="text" name="wechat" value="{{ !empty($travel) ? $travel->wechat : '' }}" placeholder="{{__("travel.Wechat")}}" class="form-control form-control-lg form-control-solid">
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-6">
            <div class="form-group">
               <label  class="col-form-label">{{__("travel.Metting Point")}} <span class="required">*</span></label>
               <input type="text" name="metting_point" value="{{ !empty($travel) ? $travel->metting_point : '' }}" placeholder="{{__("travel.Metting Point")}}" class="form-control form-control-lg form-control-solid">
            </div>
         </div>
         <div class="col-md-6">
            <div class="form-group">
               <label  class="col-form-label">{{__("travel.I have picked by the school")}} <span class="required">*</span></label>
               <select name="picked_school" required="" class="form-control form-control-lg form-control-solid">
                  <option value="">{{__("travel.Select")}}</option>
                  <option {{ (!empty($travel) ? $travel->picked_school : ''  == 'Yes') ? 'selected' : '' }} value="Yes">{{__("travel.Yes")}}</option>
                  <option {{ (!empty($travel) ? $travel->picked_school : ''  == 'No') ? 'selected' : '' }} value="No">{{__("travel.No")}}</option>
               </select>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="form-group">
               <label  class="col-form-label">{{__("travel.Note")}} <span class="required">*</span></label>
               <textarea placeholder="{{__("travel.Note")}}" required name="note" class="form-control form-control-lg form-control-solid">{{ !empty($travel) ? $travel->note : '' }}</textarea>
            </div>
         </div>
      </div>
      <div class="form-group row">
         <div class="col-lg-12 col-xl-12 text-right">
            <br>
            <button type="submit" class="btn btn-success mr-2">{{__("travel.Save")}}</button>
         </div>
      </div>
   </div>
   <!--end::Body-->
</form>