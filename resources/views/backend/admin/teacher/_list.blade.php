<div class=" container ">
    @forelse($teachers as $teacher)
        <div class="card card-custom gutter-b">
            <div class="card-body" >
                <!--begin::Top-->
                <div class="d-flex">
                    <!--begin::Pic-->
                    <div class="flex-shrink-0 mr-7">
                        <div class="symbol symbol-50 symbol-lg-120">
                            <img src="{!! $teacher->getImage() !!}" alt="{{ $teacher->name }}">
                        </div>
                    </div>
                    <!--end::Pic-->
                    <!--begin: Info-->
                    <div class="flex-grow-1">
                        <!--begin::Title-->
                        <div class="d-flex align-items-center justify-content-between flex-wrap mt-2">
                            <!--begin::User-->
                            <div class="mr-3">
                                <!--begin::Name-->
                                <a href="#" class="align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">
                                    {{ $teacher->name }} @if(!empty($teacher->teacher_id))({{ $teacher->teacher_id }}) @endif 

                                    @if($teacher->OnlineUser())
                                        <i class="flaticon2-correct text-success icon-md ml-2"></i>
                                    @endif

                                </a>

                                    @if(!empty($teacher->getCV()))
                                    <a href="{!! $teacher->getCV() !!}" target="_blank" class="btn btn-sm btn-light-primary font-weight-bolder mr-2">{{__('teacher.Private CV')}}</a>
                                    @endif

                                    @if(!empty($teacher->getStaffCVUpload()))
                                        <a target="_blank" href="{!! $teacher->getStaffCVUpload() !!}" class="btn btn-sm btn-light-primary font-weight-bolder mr-2">{{__('teacher.Public CV')}}</a>
                                    @endif


                                    <a target="_blank" href="{{ url('admin/user/visa/'.$teacher->id) }}" class="btn btn-sm btn-light-primary font-weight-bolder mr-2">{{__('teacher.Visa')}}</a>
                                    


                                <div>
                                 
                                    @if(!empty($teacher->gender))
                                    <a href="javascript:;" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                        <i class="flaticon-user"></i> {{ $teacher->gender->getName() }}
                                    </a>
                                    @endif
                                </div>
                                <!--end::Name-->
                                <!--begin::Contacts-->
                                <div class="d-flex flex-wrap my-2">
                                   

                                    @if(!empty($teacher->nationality))
                                    <a href="javascript:;" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                        <i class="flaticon2-location"></i> @if(!empty($teacher->nationality)){{ $teacher->nationality->getName() }}@endif
                                    </a>
                                    @endif

                                    @if(!empty($teacher->education_level))
                                    <a href="javascript:;" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                        <i class="flaticon-trophy"></i> @if(!empty($teacher->education_level)){{ $teacher->education_level->getName() }}@endif
                                    </a>
                                    @endif

                                    
                                    @if(!empty($teacher->teacher_type))
                                        <a href="javascript:;" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                            <i class="flaticon-file"></i> {{ $teacher->teacher_type->getName() }}
                                        </a>
                                     @endif

                                     
                                     @if(!empty($teacher->colour))
                                        <a href="javascript:;" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                            <i class="flaticon-profile-1"></i> {{ $teacher->colour->getName() }}
                                        </a>
                                     @endif

                                 
                                    <a href="javascript:;" onclick="CopyLink({{ $teacher->id }})"  class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                        <i class="flaticon-share"></i> {{__('teacher.Share')}}
                                    </a>

                                    <input type="hidden" id="CopyLink{{ $teacher->id }}" value="{{ url('teacher-profile/'.$teacher->username) }}">


                                      @if(!empty($teacher->current_location))
                                        <a href="javascript:;" class="text-muted text-hover-primary font-weight-bold">
                                            <i class="flaticon-profile-1"></i> {{ $teacher->current_location->short_name }}
                                        </a>
                                     @endif

                                </div>
                                <!--end::Contacts-->
                            </div>
                            <!--begin::User-->
                            <!--begin::Actions-->
                            <div class="my-lg-0 my-1">
                                    <select style="display: inline;width: 92px;" class="form-control ChangeMatchStatus" data-val="status" id="{{ $teacher->id }}" >
                                        <option {{ ($teacher->status == 1) ? 'selected' : '' }} value="1">{{__('teacher.Active')}}</option>
                                        <option {{ ($teacher->status == 0) ? 'selected' : '' }} value="0">{{__('teacher.Inactive')}}</option>
                                    </select>
                                    <select style="display: inline;width: 92px;" class="form-control ChangeMatchStatus" data-val="verify" id="{{ $teacher->id }}" >
                                        <option {{ ($teacher->verify == 1) ? 'selected' : '' }} value="1">{{__('teacher.Verify')}}</option>
                                        <option {{ ($teacher->verify == 0) ? 'selected' : '' }} value="0">{{__('teacher.Unverify')}}</option>
                                    </select>
                              </div>


                            <div class="my-lg-0 my-1">
                               
                                <a href="{{ url('teacher/matched-position/'.$teacher->username) }}" target="_blank" class="btn btn-sm btn-light-primary font-weight-bolder text-uppercase mr-2">{{__('teacher.Match')}}</a>

                                <a href="{{ url('school/matched-teacher?user_id='.$teacher->id) }}" class="btn btn-sm btn-light-primary font-weight-bolder text-uppercase mr-2">{{__('teacher.View')}}</a>

                                <a href="{{ url('admin/teacher/edit/'.$teacher->id.'?page='.Request::get('page')) }}" class="btn btn-icon btn-light-primary btn-hover-primary btn-sm"><i class="flaticon-edit-1"></i></a>

                                <a onclick="return confirm('{{__('teacher.Are you sure you want to delete?')}}')" href="{{ url('admin/teacher/delete/'.$teacher->id) }}" class="btn btn-icon btn-light-primary btn-hover-primary btn-sm"><i class="flaticon2-trash"></i></a>


                                {{-- <a href="#" class="btn btn-sm btn-primary font-weight-bolder text-uppercase">Hire</a> --}}
                            </div>
                            <!--end::Actions-->
                        </div>
                        <!--end::Title-->
                        <!--begin::Content-->
                        <div class="d-flex align-items-center flex-wrap justify-content-between">
                            <!--begin::Description-->
                            <div class="flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2 mr-5">
                             <h4 class="text-primary"> <a href="javascript:;" id="{{  $teacher->id }}" class="btn btn-sm btn-light-primary font-weight-bolder text-uppercase mr-2 UpdateNotes"> {{__('teacher.Notes')}}</a></h4>
                            <span id="getLatestNote{{ $teacher->id }}">{!! $teacher->note !!}</span> 
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
                    <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                     <span class="mr-4">
                     <i class="flaticon-calendar-with-a-clock-time-tools icon-2x text-muted font-weight-bold"></i>
                     </span>
                        <div class="d-flex flex-column text-dark-75">
                            <span class="font-weight-bolder font-size-sm">{{__('teacher.Register Date')}}</span>
                            <span class="font-size-h5">{{ date('Y-m-d',strtotime($teacher->created_at)) }}
                            </span>
                            <span class="font-size-h6">
                                {{ Carbon\Carbon::parse($teacher->created_at)->diffForHumans() }}
                            </span>
                            
                        </div>
                    </div>
                    <!--end: Item-->
                    <!--begin: Item-->
                    <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                     <span class="mr-4">
                     <i class="flaticon-visible icon-2x text-muted font-weight-bold"></i>
                     </span>
                        <div class="d-flex flex-column text-dark-75">
                            <span class="font-weight-bolder font-size-sm">{{ $teacher->profile_view() }} {{__('teacher.Profile Views')}}</span>
                            <a href="{{ url('admin/teacher-profile-view?user_id='.$teacher->id) }}" class="text-primary font-weight-bolder">{{__('teacher.View')}}</a>
                        </div>
                    </div>
                    <!--end: Item-->
                    <!--begin: Item-->
                    <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                     <span class="mr-4">
                     <i class="flaticon-presentation icon-2x text-muted font-weight-bold"></i>
                     </span>
                        <div class="d-flex flex-column text-dark-75">
                            <span class="font-weight-bolder font-size-sm">{{ $teacher->get_total_interview() }} {{__('teacher.Interviews')}}</span>
                            <a href="{{ url('admin/interview?user_id='.$teacher->id) }}" class="text-primary font-weight-bolder">{{__('teacher.View')}}</a>
                        </div>
                    </div>
                    <!--end: Item-->
                    <!--begin: Item-->
                    <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                     <span class="mr-4">
                     <i class="flaticon-medal icon-2x text-muted font-weight-bold"></i>
                     </span>
                        <div class="d-flex flex-column flex-lg-fill">
                            <span class="text-dark-75 font-weight-bolder font-size-sm">{{ $teacher->get_total_offer() }} {{__('teacher.Offers')}}</span>
                            <a href="{{ url('admin/offer?user_id='.$teacher->id) }}" class="text-primary font-weight-bolder">{{__('teacher.View')}}</a>
                        </div>
                    </div>
                    <!--end: Item-->
                    <!--begin: Item-->
                    <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                     <span class="mr-4">
                     <i class="flaticon-speech-bubble icon-2x text-muted font-weight-bold"></i>
                     </span>
                        <div class="d-flex flex-column">
                            <a href="{{ url('admin/privatechat/'.$teacher->username) }}"  target="_blank" class="text-dark-75 font-weight-bolder font-size-sm">{{__('teacher.Chat')}}</a>
                        </div>
                    </div>
                    <!--end: Item-->
                    <!--begin: Item-->
                    @if(!empty($teacher->staff))
                    <div class="d-flex align-items-center flex-lg-fill my-1">
                     <span class="mr-4">
                     <i class="flaticon-businesswoman icon-2x text-muted font-weight-bold"></i>
                     </span>
                        <div class="symbol-group symbol-hover">
                            <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip" title="" data-original-title="Mark Stone">
                                <img alt="Pic" src="{!! $teacher->staff->getImage() !!}">
                            </div>
                            <div class="symbol symbol-30 symbol-circle" style="margin-left: 0px;">
                                 {!! $teacher->staff->name !!}
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
                    {!! $teachers->links() !!}
                </div>
            </div>
            <!--end:: Pagination-->
        </div>
    </div>
    <!--end::Pagination-->
</div>
