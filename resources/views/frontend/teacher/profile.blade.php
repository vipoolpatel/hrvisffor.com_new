<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 8/1/2020
 * Time: 3:05 PM
 */
?>

@extends('backend.layouts.app')
@section('style')
    <style type="text/css">
        .form-group {
            margin-bottom: 8px;
        }
    </style>
@endsection
@section('content')
    <div class="container">
    <div class="page">
        <div class="page-content">

            <div id="site_header" class="header-profile mobile-menu-hide">
                <div class="header-content">
                    <div class="card-language">
                        <div class="dropdown">
                            <!--begin::Toggle-->
                            <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                                <div
                                    class="btn btn-icon btn-hover-transparent-white btn-dropdown btn-lg mr-1">
                                    <img class="h-20px w-20px rounded-sm"
                                         src="{{ asset('assets/media/svg/flags/260-united-kingdom.svg') }}"
                                         alt="">
                                </div>
                            </div>
                            <!--end::Toggle-->
                            <!--begin::Dropdown-->
                            <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
                                <!--begin::Nav-->
                                <ul class="navi navi-hover py-4">
                                    <!--begin::Item-->
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                                         <span class="symbol symbol-20 mr-3">
                                                         <img src="{{ asset('assets/media/svg/flags/260-united-kingdom.svg') }}">
                                                         </span>
                                            <span class="navi-text">English</span>
                                        </a>
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                                         <span class="symbol symbol-20 mr-3">
                                                          <img src="{{ asset('assets/media/svg/flags/034-china.svg') }}">
                                                         </span>
                                            <span class="navi-text">Chinese</span>
                                        </a>
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <!--end::Item-->
                                </ul>
                                <!--end::Nav-->
                            </div>
                            <!--end::Dropdown-->
                        </div>


                    </div>
                    <div class="header-photo">
                        <img src="{{ asset('assets/img/main_photo.jpg') }}" alt="Alex Smith">
                    </div>
                    <div class="header-titles">
                        <h2>Alex</h2>
                        <h4>45 yes British</h4>
                        <h4>Bachelor</h4>
                        <h4>4 Interviews Booked</h4>
                    </div>
                </div>

                <div class="header-buttons">
                    <a href="#" target="_blank" class="btn btn-primary">Message</a>
                </div>
                <div class="header-buttons">
                    <a href="#" target="_blank" class="btn btn-primary my-3">Interview</a>
                </div>
                <div class="copyrights">© 2020 All rights reserved.</div>
            </div>

            <div class="content-area">
                <div class="animated-sections">

                    <!-- About Me Subpage -->
                    <section class="animated-section">
                        <div class="page-title">
                            <h2>About <span>Me</span></h2>
                        </div>

                        <div class="section-content">
                            <!-- Personal Information -->
                            <div class="row">
                                <div class="col-xs-12 col-sm-8">
                                    <p>Proin volutpat mauris ac pellentesque pharetra. Suspendisse congue elit vel odio suscipit, sit amet tempor nisl imperdiet. Quisque ex justo, faucibus ut mi in, condimentum finibus dolor. Aliquam vitae hendrerit dolor, eget imperdiet mauris. Maecenas et ante id ipsum condimentum dictum et vel massa. Ut in imperdiet dolor, vel consectetur dui.</p>
                                </div>

                                <div class="col-xs-12 col-sm-4">
                                    @php
                                        $filename = explode('.', \Illuminate\Support\Facades\Auth::user()->user_video);
                                        $extension = end($filename);
                                    @endphp
                                    <video poster="" height="150"  width="100%" id="player" playsinline controls>
                                        @if (strtolower($extension) == 'mp4')
                                            <source src="{{ url('upload/profile') }}/{{ \Illuminate\Support\Facades\Auth::user()->user_video }}" type="video/mp4">
                                        @elseif (strtolower($extension) == 'webm')
                                            <source src="{{ url('upload/profile') }}/{{ \Illuminate\Support\Facades\Auth::user()->user_video }}" type="video/webm">
                                        @endif
                                    </video>
                                </div>
                            </div>
                            <!-- End of Personal Information -->

                            <div class="white-space-50"></div>

                            <!-- Services -->
                            <div class="row">
                                <div class="col-xs-12 col-sm-12">
                                    <div class="block-title">
                                        <h3>Info</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="info-list">
                                        <ul>
                                            <li>
                                                <span class="title">Age</span>
                                                <span class="value">32</span>
                                            </li>
                                            <li>
                                                <span class="title">Nationality</span>
                                                <span class="value">Americans</span>
                                            </li>
                                            <li>
                                                <span class="title">Location</span>
                                                <span class="value">Within the chinese Border</span>
                                            </li>

                                            <li>
                                                <span class="title">Working Experience</span>
                                                <span class="value">7 years</span>
                                            </li>

                                            <li>
                                                <span class="title">Boarding Time</span>
                                                <span class="value">ASAP</span>
                                            </li>
                                            <li>
                                                <span class="title">Graduated two years or more</span>
                                                <span class="value">Yes</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-6">
                                    <div class="info-list">
                                        <ul>
                                            <li>
                                                <span class="title">Type of position</span>
                                                <span class="value">English Teacher</span>
                                            </li>

                                            <li>
                                                <span class="title">Type Of Work</span>
                                                <span class="value">Full Time in China</span>
                                            </li>
                                            <li>
                                                <span class="title">Chinese Visa status</span>
                                                <span class="value">Z</span>
                                            </li>
                                            <li>
                                                <span class="title">Expected Salary</span>
                                                <span class="value">22000CNY-27000CNY Monthly</span>
                                            </li>

                                            <li>
                                                <span class="title">Type of School</span>
                                                <span class="value">Language Training Center</span><br />
                                                <span class="value">Kingdergarten Primary/Midle/High School University </span>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="col-mx-12 col-sm-12 col-md-6">
                                    <div class="info-list">
                                        <ul>
                                            <li>
                                    <span class="title">Other requirements</span>
                                    <span class="value">
                                                    I need freefly tickets, free apartment, I need to brng my tamly to China.Ineed to apply Chinese working Z Visa.
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="white-space-50"></div>

                                <div class="col-xs-12 col-sm-12 pt-5">
                                    <div class="block-title">
                                        <h3>Education History</h3>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table bordered">
                                            <tr>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Company Name</th>
                                                <th>Position</th>
                                                <th>Title</th>
                                                <th>Duty</th>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="white-space-50"></div>

                            <div class="col-xs-12 col-sm-12 pt-3 px-0">
                                <div class="block-title">
                                    <h3>Working Experience</h3>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 px-0">
                                <div class="table-responsive">
                                    <table class="table bordered">
                                        <tr>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Company Name</th>
                                            <th>Position</th>
                                            <th>Title</th>
                                            <th>Duty</th>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- End of Services -->

                            <div class="white-space-30"></div>


                        </div>
                    </section>
                    <!-- End of About Me Subpage -->


                </div>
            </div>

        </div>
    </div>
    </div>
@endsection

