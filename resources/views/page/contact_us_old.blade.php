@extends('layouts.app')
@section('content')




<!-- Header end -->
<!-- Inner Page Title start -->
<div class="pageTitle">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <h1 class="page-heading">Contact Us</h1>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="breadCrumb"><a href="{{ url('') }}">Home</a> / <span>Contact Us</span></div>
            </div>
        </div>
    </div>
</div><!-- Inner Page Title end -->
<div class="inner-page">
    <!-- About -->
    <div class="container">
        <div class="contact-wrap">
            <div class="title"> <span>We Are Here For Your Help</span>
                <h2>GET IN TOUCH FAST</h2>
                <p>
                    Vestibulum at magna tellus. Vivamus sagittis nunc aliquet. Vivamin orci aliquam
                    <br>
                    eros vel saphicula. Donec eget ultricies ipsmconsequat
                </p>
            </div>
                <!-- Contact Info -->
                <div class="contact-now">
				<div class="row">
                    <div class="col-lg-4 column">
                        <div class="contact"> <span><i class="fa fa-home"></i></span>
                            <div class="information"> <strong>Address:</strong>
                                <p>O-G-8, Courtwood House, Sliver Street head, Sheffield, United Kingdom. S1 4BX
                                  Yuetan South Street,Xicheng,Beijing, China. 100032 Landline:(+86)-010-57173657</p>
                            </div>
                        </div>
                    </div>
                    <!-- Contact Info -->
                    <div class="col-lg-4 column">
                        <div class="contact"> <span><i class="fa fa-envelope"></i></span>
                            <div class="information"> <strong>Email Address:</strong>
                                <p><a href="">info@ukvisffor.com</a></p>
                            </div>
                        </div>
                    </div>
                    <!-- Contact Info -->
                    <div class="col-lg-4 column">
                        <div class="contact"> <span><i class="fa fa-phone"></i></span>
                            <div class="information"> <strong>Phone:</strong>
                                <p><a href="tel:+44 07455962168">+44 07455962168</a></p>
                                <p><a href="tel:"></a></p>
                            </div>
                        </div>
                    </div>
                    <!-- Contact Info -->
                </div>
					<div class="row">
                <div class="col-lg-4 column">
                    <!-- Google Map -->
                    <div class="googlemap">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d193572.19492844533!2d-74.11808565615137!3d40.70556503857166!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1481975053066" allowfullscreen=""></iframe>
                    </div>
                </div>
                <!-- Contact form -->
                <div class="col-lg-8 column">
                    @include('layouts._message')
                    <div class="contact-form">

                        <form method="post" action="{{ url('contact-us') }}">
                          {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6">
                                    <input placeholder="Full Name" value="{{ old('full_name') }}" required="required" name="full_name" type="text">
                                </div>
                                <div class="col-md-6">
                                    <input placeholder="Email" value="{{ old('email') }}" required="required" name="email" type="text">
                                      <span style="color: red;">{{ $errors->first('email') }}</span>
                                </div>
                                <div class="col-md-6">
                                    <input placeholder="Phone" value="{{ old('phone') }}" name="phone" type="text">

                                </div>
                                <div class="col-md-6">
                                    <input  placeholder="Subject" value="{{ old('subject') }}" required="required" name="subject" type="text">
                                </div>
                                <div class="col-md-12">
                                    <textarea placeholder="Message" required="required" name="message" cols="50" rows="10">{{ old('message') }}</textarea>
                                </div>
                                <div class="col-md-12">
                                  <label style="width: 100%;text-align: left;">
                                    @php
                                      $firstNumber_acc   = mt_rand(0, 9);
                                      $secondNumber_acc  = mt_rand(0, 9);
                                      echo $firstNumber_acc . ' + ' . $secondNumber_acc .' = ? ';
                                    @endphp
                                  </label>
                                    <input type="hidden" name="current_captcha" value="{{ $firstNumber_acc + $secondNumber_acc}}"/>
                                    <input placeholder="Verification Code" required="required" name="CaptchaCode" type="text">
                                    <div style="color: red;text-align: left;">{{ $errors->first('CaptchaCode') }}</div>
                                </div>
                                <div class="col-md-12">
                                    <button class="button" type="submit">Submit Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
					 </div>
        </div>
    </div>
</div>
<!--Footer-->

@endsection
