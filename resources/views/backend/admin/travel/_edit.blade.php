 <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ __('travel.Edit Travel Arrangement') }} </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
            </button>
         </div>

        <form action="{{ url('admin/travel/update') }}" method="post">
           {{ csrf_field() }}
           <input type="hidden" name="id"  value="{{ $travel->id }}">
         <div class="modal-body">
      
          <div class="row">
         <div class="col-md-6">
            <div class="form-group">
               <label for="position" class="col-form-label">{{ __('travel.Teacher') }} <span class="required">*</span></label>
               <select  name="teacher_id" required class="form-control form-control-lg form-control-solid">
                  <option value="">{{ __('travel.Select Teacher') }}</option>
                  @foreach($get_contract_teacher as $value)
                      <option {{ (!empty($travel) ? $travel->teacher_id : ''  == $value->teacher_id) ? 'selected' : '' }} value="{{ $value->teacher_id }}">{{ $value->teacher->name }} ({{ $value->teacher->teacher_id }})</option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="col-md-6">
            <div class="form-group">
               <label for="position" class="col-form-label">{{ __('travel.Flight Ticket') }}</label>
               <input type="file" name="flight_ticket" class="form-control form-control-lg form-control-solid">   
               @if(!empty($travel) && !empty($travel->get_flight_ticket()))         
               <a class="btn btn-success btn-sm" href="{{ url($travel->get_flight_ticket()) }}" target="_blank">{{ __('travel.Download') }}</a>
               @endif
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-6">
            <div class="form-group">
               <label  class="col-form-label">{{ __('travel.You will be picked up by') }} <span class="required">*</span></label>
               <input type="text" name="picked_up_by" value="{{ !empty($travel) ? $travel->picked_up_by : '' }}" placeholder="{{ __('travel.You will be picked up by') }}" class="form-control form-control-lg form-control-solid">
            </div>
         </div>

         <div class="col-md-6">
            <div class="form-group">
               <label  class="col-form-label">{{ __('travel.Profile') }} <span class="required">*</span></label>
               <input type="file" accept="image/*" name="profile_pic" class="form-control form-control-lg form-control-solid">  
               <img src="{{ $travel->getImage() }}" style="height: 25px;width: 25px;">
            </div>
         </div>


      </div>

  
      <div class="row">
         <div class="col-md-7">
            <div class="form-group">
               <label class="col-form-label">{{ __('travel.Phone Number') }} <span class="required">*</span></label>
               <div>
                  <select style="width: 150px;display: inline;" required="" name="country_id" class="form-control form-control-lg form-control-solid">
                     <option  value="">{{ __('travel.Country Code') }}</option>
                     @foreach($get_country as $value_country)
                        <option  {{ (!empty($travel) ? $travel->country_id : ''  == $value_country->id) ? 'selected' : '' }} value="{{ $value_country->id }}">{{ $value_country->getName() }}</option>
                     @endforeach
                  </select>
                  <input style="max-width: 248px;display: inline;" class="form-control form-control-lg form-control-solid" placeholder="{{ __('travel.Phone Number') }}" type="text" value="{{ !empty($travel) ? $travel->phone_number : '' }}" name="phone_number" required>
               </div>
            </div>
         </div>
         <div class="col-md-5">
            <div class="form-group">
               <label  class="col-form-label">{{ __('travel.Email') }} <span class="required">*</span></label>
               <input type="email" name="email" required placeholder="{{ __('travel.Email') }}" value="{{ !empty($travel) ? $travel->email : '' }}" class="form-control form-control-lg form-control-solid">
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-6">
            <div class="form-group">
               <label  class="col-form-label">{{ __('travel.Skype') }} </label>
               <input type="text" name="skype" value="{{ !empty($travel) ? $travel->skype : '' }}" placeholder="{{ __('travel.Skype') }}" class="form-control form-control-lg form-control-solid">
            </div>
         </div>
         <div class="col-md-6">
            <div class="form-group">
               <label  class="col-form-label">{{ __('travel.Wechat') }} </label>
               <input type="text" name="wechat" value="{{ !empty($travel) ? $travel->wechat : '' }}" placeholder="{{ __('travel.Wechat') }}" class="form-control form-control-lg form-control-solid">
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-6">
            <div class="form-group">
               <label  class="col-form-label">{{ __('travel.Metting Point') }} <span class="required">*</span></label>
               <input type="text" name="metting_point" value="{{ !empty($travel) ? $travel->metting_point : '' }}" placeholder="{{ __('travel.Metting Point') }}" class="form-control form-control-lg form-control-solid">
            </div>
         </div>
         <div class="col-md-6">
            <div class="form-group">
               <label  class="col-form-label">{{ __('travel.I have picked by the school') }} <span class="required">*</span></label>
               <select name="picked_school" required="" class="form-control form-control-lg form-control-solid">
                  <option value="">Select</option>
                  <option {{ (!empty($travel) ? $travel->picked_school : ''  == 'Yes') ? 'selected' : '' }} value="Yes">{{ __('travel.Yes') }}</option>
                  <option {{ (!empty($travel) ? $travel->picked_school : ''  == 'No') ? 'selected' : '' }} value="No">{{ __('travel.No') }}</option>
               </select>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="form-group">
               <label  class="col-form-label">{{ __('travel.Note') }} <span class="required">*</span></label>
               <textarea placeholder="Note" required name="note" class="form-control form-control-lg form-control-solid">{{ !empty($travel) ? $travel->note : '' }}</textarea>
            </div>
         </div>
      </div>
          
         </div>
         <div class="modal-footer">
            <button type="submit" class="btn btn-success font-weight-bold">{{ __('travel.Update') }}</button>
         </div>

       </form>

      </div>
   </div>