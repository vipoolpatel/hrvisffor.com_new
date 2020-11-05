@foreach($user->get_job as $value)
 
  <div class="card card-custom gutter-b">
      <div class="card-body">
         <!--begin::Top-->
         <div class="d-flex">
            <!--begin::Pic-->
            {{--          
            <div class="flex-shrink-0 mr-7">
               <div class="symbol symbol-50 symbol-lg-120">
                  <img alt="Pic" src="http://gbcoding.com/assets/media//users/300_1.jpg">
               </div>
            </div>
            --}}
            <!--end::Pic-->
            <!--begin: Info-->
            <div class="flex-grow-1">
               <!--begin::Title-->
               <div class="d-flex align-items-center justify-content-between flex-wrap mt-2">
                  <!--begin::User-->
                  <div class="mr-3">
                     <!--begin::Name-->
                     <a href="javascript:;" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">
                        {{ $value->user->school_name }} ({{ $value->user->school_id }}) 
                        <div class="text-muted text-hover-primary font-weight-bold ml-5">{{ $value->get_position->getName() }}</div>
                     </a>
                     <!--end::Name-->
                     <!--begin::Contacts-->
                     <div class="d-flex flex-wrap my-2">
                        <a href="javascript:;" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                        <i class="flaticon2-phone"></i> {{ $value->user->phone_number }}
                        </a>
                        <a href="javascript:;" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                        <i class="flaticon2-user"></i> {{ $value->user->name }}
                        </a>
                        @if($value->get_location())
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
                     @if(!empty($value->is_match))
                        <a href="{{ url('school/matched-teacher/'.$value->slug)}}" class="btn btn-sm btn-light-primary font-weight-bolder text-uppercase mr-2">{{ __('position.Match') }}</a>
                     @endif

                     <a href="{{ url('school/position/edit/'.$value->id) }}" class="btn btn-icon btn-light btn-hover-primary btn-sm"><i class="flaticon-edit-1 text-primary"></i></a>

                     <a href="{{ url('school/position/delete/'.$value->id) }}" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                     <i class="flaticon2-trash text-primary"></i>
                     </a>
                  </div>
                  <!--end::Actions-->
               </div>
               <!--end::Title-->
               
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
         

            <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
               <span class="mr-4">
               <i class="flaticon-computer icon-2x text-muted font-weight-bold"></i>
               </span>
               <div class="d-flex flex-column">
                  <span class="text-dark-75 font-weight-bolder font-size-sm">{{ __('position.Interviews') }}</span>
                  <a href="{{ url('school/interview?job_id='.$value->id) }}" class="text-primary font-weight-bolder">{{ $value->get_total_interview() }}</a>
               </div>
            </div>


            <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
               <span class="mr-4">
               <i class="flaticon-medal icon-2x text-muted font-weight-bold"></i>
               </span>
               <div class="d-flex flex-column">
                  <span class="text-dark-75 font-weight-bolder font-size-sm">{{ __('position.Offers') }}</span>
                  <a href="{{ url('school/offer?job_id='.$value->id) }}" class="text-primary font-weight-bolder">{{ $value->get_total_offer() }}</a>
               </div>
            </div>
        
 
    
         </div>
         <!--end::Bottom-->
      </div>
   </div>

 @endforeach          