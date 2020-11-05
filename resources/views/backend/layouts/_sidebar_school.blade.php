<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 8/2/2020
 * Time: 2:03 PM
 */
?>
<div class="flex-row-auto offcanvas-mobile w-300px w-xl-350px" id="kt_profile_aside">
    <!--begin::Profile Card-->
    <div class="card card-custom card-stretch">
        <!--begin::Body-->
        <div class="card-body pt-4" style="overflow: auto;">
            <!--begin::User-->
            <div class="d-flex align-items-center" style="margin-top: 20px;">
                <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                    <div class="symbol-label" style="background-image:url('{!! Auth::user()->getImage() !!}')"></div>
                    <i class="symbol-badge bg-success"></i>
                </div>
                <div>
                    <a href="#" class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">
                        {{ Auth::user()->getName() }}
                    </a>

                </div>
              
            </div>
            <!--end::User-->
            <!--begin::Contact-->
            <div class="py-9">
                <!--<div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="font-weight-bold mr-2">Email:</span>
                    <a href="javascript:;" class="text-muted text-hover-primary">{{ Auth::user()->email }}</a>
                </div>
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="font-weight-bold mr-2">Phone:</span>
                    <span class="text-muted">44(76)34254578</span>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <span class="font-weight-bold mr-2">Location:</span>
                    <span class="text-muted">Melbourne</span>
                </div>-->
            </div>
            <!--end::Contact-->
            <!--begin::Nav-->
            <div class="navi navi-bold navi-hover navi-active navi-link-rounded">
                <div class="navi-item mb-2">
                    <a href="{{ url('school/dashboard') }}" class="navi-link py-4 @if ( Request::segment(2) == 'dashboard' ) active @endif">
                        <span class="navi-icon mr-2"><i class="flaticon-squares-1"></i></span>
                        <span class="navi-text font-size-lg">{{ __('layouts.Dashboard') }}</span>
                    </a>
                </div>

                <div class="navi-item mb-2">
                    <a  href="{{ url('school/profile') }}" class="navi-link py-4 @if ( Request::segment(2) == 'profile' ) active @endif">
                        <span class="navi-icon mr-2"><i class="flaticon-profile"></i></span>
                        <span class="navi-text font-size-lg">{{ __('layouts.Profile') }}</span>
                    </a>
                </div>

                <div class="navi-item mb-2">
                    <a  href="{{ url('school/position') }}" class="navi-link py-4 @if ( Request::segment(2) == 'position' ) active @endif">
                        <span class="navi-icon mr-2"><i class="flaticon-profile"></i></span>
                        <span class="navi-text font-size-lg">{{ __('layouts.Publish Position') }}</span>
                    </a>
                </div>

               <div class="navi-item mb-2">
                    <a  href="{{ url('school/favorite-teacher') }}" class="navi-link py-4 @if ( Request::segment(2) == 'favorite-teacher' ) active @endif">
                        <span class="navi-icon mr-2"><i class="flaticon-user"></i></span>
                        <span class="navi-text font-size-lg">{{ __('layouts.Favorite Teacher') }}</span>
                    </a>
                </div>


                <div class="navi-item mb-2">
                    <a  href="{{ url('school/interview') }}" class="navi-link py-4 @if ( Request::segment(2) == 'interview' ) active @endif">
                        <span class="navi-icon mr-2"><i class="flaticon-computer"></i></span>
                        <span class="navi-text font-size-lg">{{ __('layouts.Interview') }}</span>
                    </a>
                </div>


                <div class="navi-item mb-2">
                    <a  href="{{ url('school/offer') }}" class="navi-link py-4 @if ( Request::segment(2) == 'offer' ) active @endif">
                        <span class="navi-icon mr-2"><i class="flaticon-medal"></i></span>
                        <span class="navi-text font-size-lg">{{ __('layouts.Offer') }}</span>
                    </a>
                </div>


                <div class="navi-item mb-2">
                    <a  href="{{ url('school/contract') }}" class="navi-link py-4 @if ( Request::segment(2) == 'contract' ) active @endif">
                        <span class="navi-icon mr-2"><i class="flaticon-edit-1"></i></span>
                        <span class="navi-text font-size-lg">{{ __('layouts.Contract') }}</span>
                    </a>
                </div>


                <div class="navi-item mb-2">
                    <a  href="{{ url('school/visa') }}" class="navi-link py-4 @if ( Request::segment(2) == 'visa' ) active @endif">
                        <span class="navi-icon mr-2"><i class="flaticon-folder-1"></i></span>
                        <span class="navi-text font-size-lg">{{ __('layouts.Visa') }}</span>
                    </a>
                </div>


                <div class="navi-item mb-2">
                    <a  href="{{ url('school/travel') }}" class="navi-link py-4 @if ( Request::segment(2) == 'travel' ) active @endif">
                        <span class="navi-icon mr-2"><i class="flaticon-rocket"></i></span>
                        <span class="navi-text font-size-lg">{{ __('layouts.Travel Arrangements') }}</span>
                    </a>
                </div>


                <div class="navi-item mb-2">
                    <a  href="{{ url('school/chat') }}" class="navi-link py-4 @if ( Request::segment(2) == 'chat' ) active @endif">
                        <span class="navi-icon mr-2"><i class="flaticon-speech-bubble"></i></span>
                        <span class="navi-text font-size-lg">{{ __('layouts.Chat') }}</span>
                    </a>
                </div>


                <div class="navi-item mb-2">
                   <a href="{{ url('school/invoice') }}" class="navi-link py-4 @if ( Request::segment(2) == 'invoice' ) active @endif">
                      <span class="navi-icon mr-2"><i class="flaticon-price-tag"></i></span>
                      <span class="navi-text font-size-lg">{{ __('invoice.Invoice') }}</span>
                   </a>
                </div>



                <div class="navi-item mb-2">
                    <a  href="{{ url('school/report') }}" class="navi-link py-4 @if ( Request::segment(2) == 'report' ) active @endif">
                        <span class="navi-icon mr-2"><i class="flaticon-warning-sign"></i></span>
                        <span class="navi-text font-size-lg">{{ __('layouts.Report') }}</span>
                    </a>
                </div>



                <div class="navi-item mb-2">
                    <a  href="{{ url('school/support') }}" class="navi-link py-4 @if ( Request::segment(2) == 'support' ) active @endif">
                        <span class="navi-icon mr-2"><i class="flaticon-businesswoman"></i></span>
                        <span class="navi-text font-size-lg">{{ __('layouts.24/7 Support') }}</span>
                    </a>
                </div>



                <div class="navi-item mb-2">
                    <a  href="{{ url('logout') }}" class="navi-link py-4 @if ( Request::segment(2) == 'logout' ) active @endif">
                        <span class="navi-icon mr-2"><i class="flaticon-logout"></i></span>
                        <span class="navi-text font-size-lg">{{ __('layouts.Sign Out') }}</span>
                    </a>
                </div>


            </div>
            <!--end::Nav-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Profile Card-->
</div>
