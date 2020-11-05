@if(!empty($user))
<form class="form" action="{{ url('admin/staff/edit/'.$user->id) }}" method="post" enctype="multipart/form-data">
@else
<form class="form" action="" method="post" enctype="multipart/form-data">
@endif
   {{ csrf_field() }}
   <div class="tab-content">
      <!--begin::Tab-->
      <div class="tab-pane show active px-7" id="kt_user_edit_tab_1" role="tabpanel">
         <!--begin::Row-->
         <div class="row">
            <div class="col-xl-2"></div>
            <div class="col-xl-7 my-2">
            
               <!--begin::Group-->
               <div class="form-group row">
                  <label class="col-form-label col-3 text-lg-right text-left">{{ __('profile.Profile Image') }}</label>
                  <div class="col-9">
                         <div class="image-input image-input-outline" id="kt_profile_avatar" style="background-image: url({{ url('assets/media/users/blank.png') }})">
                           @if(!empty($user))
                              <div class="image-input-wrapper" style="background-image: url({!! $user->getImage() !!})"></div>
                           @else
                              <div class="image-input-wrapper" style="background-image: url({{ url('assets/media/users/default.jpg') }})"></div>
                           @endif
                              <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                              <i class="fa fa-pen icon-sm text-muted"></i>
                              <input type="file" accept="image/*" name="profile_pic" />
                              <input type="hidden" name="profile_avatar_remove"/>
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
               <!--end::Group-->
               <!--begin::Group-->
               <div class="form-group row">
                  <label class="col-form-label col-3 text-lg-right text-left">{{ __('profile.First Name') }}</label>
                  <div class="col-9">
                     <input class="form-control form-control-lg form-control-solid" type="text" value="{{ old('name',!empty($user->name) ? $user->name : '') }}" name="name" />
                     <div style="color: red;">{{ $errors->first('name') }}</div>
                  </div>
               </div>
               <!--end::Group-->
               <!--begin::Group-->
               <div class="form-group row">
                  <label class="col-form-label col-3 text-lg-right text-left">{{ __('profile.Last Name') }}</label>
                  <div class="col-9">
                     <input class="form-control form-control-lg form-control-solid" type="text" value="{{ old('last_name',!empty($user->last_name) ? $user->last_name : '') }}" name="last_name" />
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-form-label col-3 text-lg-right text-left">{{ __('profile.Username') }}</label>
                  <div class="col-9">
                     <input class="form-control form-control-lg form-control-solid" type="text" value="{{ old('username',!empty($user->username) ? $user->username : '') }}" name="username" />
                     <div style="color: red;">{{ $errors->first('username') }}</div>
                  </div>
               </div>
               <!--begin::Group-->
               <div class="form-group row">
                  <label class="col-form-label col-3 text-lg-right text-left">{{ __('profile.Email Address') }}</label>
                  <div class="col-9">
                     <div class="input-group input-group-lg input-group-solid">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
                        <input type="email" class="form-control form-control-lg form-control-solid" value="{{ old('email',!empty($user->email) ? $user->email : '') }}" name="email" />
                     </div>
                     <div style="color: red;">{{ $errors->first('email') }}</div>
                  </div>
               </div>
               <!--end::Group-->
               <!--begin::Group-->
               <div class="form-group row">
                  <label class="col-form-label col-3 text-lg-right text-left">{{ __('profile.Password') }}</label>
                  <div class="col-9">
                     <input class="form-control form-control-lg form-control-solid" type="password" value="" name="password" />
                     <div style="color: red;">{{ $errors->first('password') }}</div>
                  </div>
               </div>
               <!--end::Group-->
               <div class="form-group row">
                  <label class="col-form-label col-3 text-lg-right text-left">{{ __('profile.Role') }}</label>
                  <div class="col-9">
                     @php
                     $is_admin = 0;
                     if(!empty($user->is_admin))
                     {
                        $is_admin = $user->is_admin;
                     }
                     @endphp
                     <select name="is_admin" class="form-control form-control-lg form-control-solid">
                        <option {{ ($is_admin == 1) ? 'selected' : '' }} value="1">{{ __('profile.Super Admin') }}</option>
                        <option {{ ($is_admin == 2) ? 'selected' : '' }} value="2">{{ __('profile.Admin') }}</option>
                     </select>
                  </div>
               </div>
            </div>
         </div>
         <div class="card-footer pb-0">
            <div class="row">
               <div class="col-xl-2"></div>
               <div class="col-xl-7">
                  <div class="row">
                     <div class="col-3"></div>
                     <div class="col-9">
                        <button type="submit" style="box-shadow: none;" class="btn btn-light-primary font-weight-bold">{{ __('profile.Save') }}</button>
                        <a href="{{ url('admin/staff') }}" class="btn btn-clean font-weight-bold">{{ __('profile.Cancel') }}</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!--end::Row-->
      </div>
   </div>
</form>