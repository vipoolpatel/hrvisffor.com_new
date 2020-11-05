<div class=" container ">
   @forelse($get_job as $value)

   <div class="card card-custom gutter-b">
      <div class="card-body">
         <!--begin::Top-->
         <div class="d-flex">
            <!--begin::Pic-->
       
            <!--end::Pic-->
            <!--begin: Info-->
            <div class="flex-grow-1">
               <!--begin::Title-->
               <div class="d-flex align-items-center justify-content-between flex-wrap mt-2">
                  <!--begin::User-->
                  <div class="mr-3">
                     <!--begin::Name-->
                     <a href="#" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">
                        <span class="show_hide_school_name">{{ $value->user->school_name }}</span> ({{ $value->user->school_id }}) 

                        @if($value->user->OnlineUser())
                           <i class="flaticon2-correct text-success icon-md ml-2"></i>
                        @endif


                        <div class="text-muted text-hover-primary font-weight-bold ml-5">{{ !empty($value->get_school_type) ? $value->get_school_type->getName() : '' }}</div>
                     </a>



                     <div class="d-flex flex-wrap my-2">
                        @if(!empty($value->user->phone_number))
                        <a href="javascript:;" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                        <i class="flaticon2-phone"></i> {{ $value->user->phone_number }}
                        </a>
                        @endif
                        <a href="javascript:;" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                        <i class="flaticon2-user"></i> {{ $value->user->name }}
                        </a>
                        @if(!empty($value->get_location()))
                        <a href="javascript:;" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                        <i class="flaticon-location"></i> {{ $value->get_location() }}
                        </a>
                        @endif
                        <a href="javascript:;" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                        <i class="flaticon-calendar-with-a-clock-time-tools"></i> {{ $value->expiry_date }}
                        </a>
                     </div>
                     <!--end::Contacts-->
                  </div>
                  <!--begin::User-->
                  <!--begin::Actions-->
                  <div class="my-lg-0 my-1">
                      <a target="_blank" href="{{ url('admin/user/visa/'.$value->user_id) }}" class="btn btn-sm btn-light-primary font-weight-bolder mr-2">{{ __('position.Visa') }}</a>

                      <a target="_blank" href="{{ url('admin/user/invoice/'.$value->user_id) }}" class="btn btn-sm btn-light-primary font-weight-bolder mr-2">{{ __('position.Invoice') }}</a>
                      
                     <a href="javascript:;" onclick="CopyLink({{ $value->id }})" class="btn btn-sm btn-light-primary font-weight-bolder text-uppercase mr-2"><i class="flaticon-reply text-muted font-weight-bold"></i></a>
                     <input type="hidden" value="{{ url('school-profile/'.$value->slug) }}" id="CopyLink{{ $value->id }}">

                     <a href="javascript:;" class="btn btn-sm btn-light-primary font-weight-bolder text-uppercase mr-2">{{ __('position.Send Profile') }}</a>
                     <a href="{{ url('school/matched-teacher/'.$value->slug) }}" target="_blank" class="btn btn-sm btn-light-primary font-weight-bolder text-uppercase mr-2">{{ __('position.Match') }}</a>
                     <a href="{{ url('school-profile/'.$value->slug) }}" target="_blank" class="btn btn-sm btn-light-primary font-weight-bolder text-uppercase mr-2">{{ __('position.View') }}</a>
                     <a href="{{ url('admin/job/edit/'.$value->id.'?page='.Request::get('page')) }}" class="btn btn-icon btn-light-primary btn-hover-primary btn-sm"><i class="flaticon-edit-1"></i></a>
                     <a onclick="return confirm('Are you sure you want to delete?')" href="{{ url('admin/job/delete/'.$value->id) }}" class="btn btn-icon btn-light-primary btn-hover-primary btn-sm"><i class="flaticon2-trash"></i></a>
                  </div>
                  <!--end::Actions-->
               </div>
               <!--end::Title-->
               <!--begin::Content-->
               <div class="d-flex align-items-center flex-wrap justify-content-between">
                  <!--begin::Description-->
                  <div class="flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2 mr-5">
                     <h4 class="text-primary"> <a href="javascript:;" class="btn btn-sm btn-light-primary font-weight-bolder text-uppercase mr-2"> {{ __('position.Notes') }}</a></h4>
                     {!! $value->note !!}
                  </div>
                  <!--end::Description-->
               </div>
               <!--end::Content-->
            </div>
            <!--end::Info-->
         </div>
         <!--end::Top-->
         <!--begin::Separator-->
         <div class="separator separator-solid my-7"></div>
         <!--end::Separator-->
         <!--begin::Bottom-->
         <div class="d-flex align-items-center flex-wrap">
            <!--begin: Item-->
            <!--end: Item-->
            <!--begin: Item-->
            <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
               <span class="mr-4">
               <i class="flaticon-user icon-2x text-muted font-weight-bold"></i>
               </span>
               <div class="d-flex flex-column text-dark-75">
                  <span class="font-weight-bolder font-size-sm">{{ __('position.Saved Teacher') }}</span>
                  <a href="javascript:;" class="text-primary font-weight-bolder">{{ $value->save_teacher() }}</a>
               </div>
            </div>
            <!--end: Item-->
            <!--begin: Item-->
            <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
               <span class="mr-4">
               <i class="flaticon-price-tag icon-2x text-muted font-weight-bold"></i>
               </span>
               <div class="d-flex flex-column text-dark-75">
                  <span class="font-weight-bolder font-size-sm">{{ __('position.Credit Level') }}</span>
                  <form class="color-form-select">
                     <select class="form-control get_credit_level" id="{{ $value->id }}">
                        <option value="">{{ __('position.Select') }}</option>
                        @foreach($get_credit_level as $level)
                           <option {{ ($value->credit_level_id == $level->id) ? 'selected' : '' }} value="{!! $level->id !!}">{!! $level->getName() !!}</option>
                        @endforeach
                     </select>
                  </form>
               </div>
            </div>
            <!--end: Item-->
            <!--begin: Item-->
            <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
               <span class="mr-4">
               <i class="flaticon2-help icon-2x text-muted font-weight-bold"></i>
               </span>
               <div class="d-flex flex-column flex-lg-fill">
                  <span class="text-dark-75 font-weight-bolder font-size-sm">{{ __('position.Emergency Level') }}</span>
                  <form class="color-form-select">
                     <select class="form-control get_emergency_level" id="{{ $value->id }}">
                        <option value="">{{ __('position.Select') }}</option>                     
                        @foreach($get_emergency_level as $emergency)
                           <option  {{ ($value->emergency_level_id == $emergency->id) ? 'selected' : '' }} value="{!! $emergency->id !!}">{!! $emergency->getName() !!}</option>
                        @endforeach                                                
                     </select>
                  </form>
               </div>
            </div>
            <!--end: Item-->
            <!--begin: Item-->

             

          <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
               <div class="d-flex flex-column">
                  <span class="text-dark-75 font-weight-bolder font-size-sm">{{ __('position.Match') }}</span>
                        <select class="form-control ChangeMatchStatus" id="{{ $value->id }}">
                           <option {{ ($value->is_match == '1') ? 'selected' : '' }} value="1">{{ __('position.Active') }}</option>
                           <option {{ ($value->is_match == '0') ? 'selected' : '' }} value="0">{{ __('position.Inactive') }}</option>
                        </select>
               </div>
            </div>


            <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
               <span class="mr-4">
               <i class="flaticon-presentation icon-2x text-muted font-weight-bold"></i>
               </span>
               <div class="d-flex flex-column">
                  <span class="text-dark-75 font-weight-bolder font-size-sm">{{ __('position.Interviews') }}</span>
                  <a href="{{ url('admin/interview?job_id='.$value->id) }}" class="text-primary font-weight-bolder">{{ $value->get_total_interview() }}</a>
               </div>
            </div>
            <!--end: Item-->
            <!--begin: Item-->
            <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
               <span class="mr-4">
               <i class="flaticon2-contract icon-2x text-muted font-weight-bold"></i>
               </span>
               <div class="d-flex flex-column">
                  <span class="text-dark-75 font-weight-bolder font-size-sm">{{ __('position.Paid Amount') }}</span>
                  <a href="javascript:;" class="text-primary font-weight-bolder">¥{{ $value->user->get_total_invoice() }}</a>
               </div>
            </div>
            <!--end: Item-->

            <!--begin: Item-->
            <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
               <span class="mr-4">
               <i class="flaticon-speech-bubble icon-2x text-muted font-weight-bold"></i>
               </span>
               <div class="d-flex flex-column">
                  <a href="{{ url('admin/privatechat/'.$value->user->username) }}" target="_blank" class="text-dark-75 font-weight-bolder font-size-sm">{{ __('position.Chat') }}</a>
               </div>
            </div>
            <!--end: Item-->

            <!--begin: Item-->

             @if(!empty($value->user) && !empty($value->user->staff))
              <div class="d-flex align-items-center flex-lg-fill my-1">
               <span class="mr-4">
               <i class="flaticon-businesswoman icon-2x text-muted font-weight-bold"></i>
               </span>
                  <div class="symbol-group symbol-hover">
                      <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip" title="" data-original-title="Mark Stone">
                          <img alt="Pic" src="{!! $value->user->staff->getImage() !!}">
                      </div>
                      <div class="symbol symbol-30 symbol-circle" style="margin-left: 0px;">
                           {!! $value->user->staff->name !!}
                      </div>
                  </div>
              </div>
              @endif



            <!--end: Item-->
         </div>
         <!--end::Bottom-->
      </div>
   </div>
   
   @empty
   @endforelse

   <!--begin::Pagination-->
   <div class="card card-custom">
        <div class="card-body py-7">
            <!--begin::Pagination-->
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="d-flex flex-wrap mr-3">
                    {!! $get_job->links() !!}
                </div>
            </div>
            <!--end:: Pagination-->
        </div>
    </div>


   <!--end::Pagination-->
</div>