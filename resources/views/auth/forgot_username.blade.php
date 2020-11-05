@extends('auth.layouts.app')
@section('content')

      <div class="d-flex flex-column flex-root">
         <!--begin::Login-->
         <div class="login login-2 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
            <!--begin::Aside-->
            <div class="login-aside order-2 order-lg-1 d-flex flex-row-auto position-relative overflow-hidden">
               <!--begin: Aside Container-->
               <div class="d-flex flex-column-fluid flex-column justify-content-between py-9 px-7 py-lg-13 px-lg-35">
                  <!--begin::Logo-->
                  <a href="{{ url('') }}" class="text-center pt-2">
                  <img src="{{ url('assets/front/img/logo.png') }}" class="max-h-75px" alt=""/>
                  </a>
                  <!--end::Logo-->
                  <!--begin::Aside body-->
                  <div class="d-flex flex-column-fluid flex-column flex-center">
                     <!--begin::Signin-->
                     <div class="login-form login-signin py-11">
                        <!--begin::Form-->
                           
                        <form class="form" method="post" action="">
                               {{ csrf_field() }}
                           <!--begin::Title-->
                           <div class="text-center pb-8">
                              <h2 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">{{__("auth.Forgot Username")}} </h2>
                              <span class="text-muted font-weight-bold font-size-h4">{{__("auth.Or")}} <a href="{{ url('login') }}" class="text-primary font-weight-bolder" >{{__("auth.Sign In")}}</a></span>
                           </div>
                            @include('layouts._message')
                           <!--end::Title-->
                           <!--begin::Form group-->
                           <div class="form-group">
                              <label class="font-size-h6 font-weight-bolder text-dark">{{__("auth.Email")}}</label>
                              <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" placeholder="{{__("auth.Email")}}" type="email" name="email" value="{{ old('email') }}" required autocomplete="off"/>
                           </div>
                           <!--begin::Action-->
                           <div class="text-center pt-2">
                              <button id="kt_login_signin_submit" class="btn btn-dark font-weight-bolder font-size-h6 px-8 py-4 my-3">{{__("auth.Forgot Username")}}</button>
                           </div>
                           <!--end::Action-->
                        </form>
                        <!--end::Form-->
                     </div>
                     <!--end::Signin-->


                  </div>
                  <!--end::Aside body-->


               </div>
               <!--end: Aside Container-->
            </div>
            <!--begin::Aside-->
            <!--begin::Content-->
            <div class="content order-1 order-lg-2 d-flex flex-column w-100 pb-0" style="background-color: #B1DCED;">
               <!--begin::Title-->
               <div class="d-flex flex-column justify-content-center text-center pt-lg-40 pt-md-5 pt-sm-5 px-lg-0 pt-5 px-7">
                  <h3 class="display4 font-weight-bolder my-7 text-dark" style="color: #986923;">{{__("auth.WE FOR YOU")}}</h3>
                  <p class="font-weight-bolder font-size-h2-md font-size-lg text-dark opacity-70">{{__("auth.VISFFOR, a UK-based company with other main offices in the United States, Canada,")}}
                     <br /> {{__("auth.Austria and China, aims to promoting cultural")}}<br /> {{__("auth.exchanges among countries.")}}
                  </p>
               </div>
               <!--end::Title-->
               <!--begin::Image-->
               <div class="content-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center" style="background-image: url({{ url('assets/media/svg/illustrations/login-visual-2.svg')  }});"></div>
               <!--end::Image-->
            </div>
            <!--end::Content-->
         </div>
         <!--end::Login-->
      </div>


@endsection
