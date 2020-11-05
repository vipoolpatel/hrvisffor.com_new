@extends('backend.layouts.app')
@section('content')
<!--begin::Main-->
<!--end::Header Mobile-->
<div class="d-flex flex-column flex-root">
   <!--begin::Page-->
   <div class="d-flex flex-row flex-column-fluid page">
      <!--begin::Wrapper-->
      <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
         <div class="content  pt-0  d-flex flex-column flex-column-fluid" id="kt_content">
            <!--begin::Entry-->
            <!--begin::Hero-->
            <div class="d-flex flex-row-fluid bgi-size-cover bgi-position-center" style="background-image: url({{ url('assets/media/bg/bg-9.jpg') }})">
               <div class=" container ">
                  <!--begin::Topbar-->
                  <div class="d-flex justify-content-between align-items-center border-bottom border-white py-7">
                     <h3 class="h4 text-dark mb-0">
                        
                              {{__("home.Work in China")}}
                     </h3>
                  </div>
                  <!--end::Topbar-->
                  <div class="d-flex align-items-stretch text-center flex-column py-40">
                     <!--begin::Heading-->
                     <h1 class="text-dark font-weight-bolder mb-12">
                    
                         {{__("home.Artificial Intelligence Matching System")}}
                     </h1>
                     <!--end::Heading-->
                     <!--begin::Form-->
                     <form class="d-flex position-relative w-75 px-lg-40 m-auto">
                        <div class="input-group">
                           <!--begin::Icon-->
                           <div class="input-group-prepend">
                              <span class="input-group-text bg-white border-0 py-7 px-8" >
                                 <span class="svg-icon svg-icon-xl">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                       <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                          <rect x="0" y="0" width="24" height="24"/>
                                          <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                          <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero"/>
                                       </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                 </span>
                              </span>
                           </div>
                           <!--end::Icon-->
                           <!--begin::Input-->
                           <input type="text" class="form-control h-auto border-0 py-7 px-1 font-size-h6" placeholder="{{__("home.Ask a question")}}"  />
                           <!--end::Input-->
                        </div>
                     </form>
                     <!--end::Form-->
                  </div>
               </div>
            </div>
            <!--end::Hero-->
            <!--begin::Section-->
            <div class=" container  py-8">
               <div class="row">
                  <div class="col-lg-4">
                     <!--begin::Callout-->
                     <div class="card card-custom wave wave-animate-slow wave-primary mb-8 mb-lg-0">
                        <div class="card-body">
                           <div class="d-flex align-items-center p-5">
                              <!--begin::Icon-->
                              <div class="mr-6">
                                 <span class="svg-icon svg-icon-primary svg-icon-4x">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Mirror.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                       <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                          <rect x="0" y="0" width="24" height="24"/>
                                          <path d="M13,17.0484323 L13,18 L14,18 C15.1045695,18 16,18.8954305 16,20 L8,20 C8,18.8954305 8.8954305,18 10,18 L11,18 L11,17.0482312 C6.89844817,16.5925472 3.58685702,13.3691811 3.07555009,9.22038742 C3.00799634,8.67224972 3.3975866,8.17313318 3.94572429,8.10557943 C4.49386199,8.03802567 4.99297853,8.42761593 5.06053229,8.97575363 C5.4896663,12.4577884 8.46049164,15.1035129 12.0008191,15.1035129 C15.577644,15.1035129 18.5681939,12.4043008 18.9524872,8.87772126 C19.0123158,8.32868667 19.505897,7.93210686 20.0549316,7.99193546 C20.6039661,8.05176407 21.000546,8.54534521 20.9407173,9.09437981 C20.4824216,13.3000638 17.1471597,16.5885839 13,17.0484323 Z" fill="#000000" fill-rule="nonzero"/>
                                          <path d="M12,14 C8.6862915,14 6,11.3137085 6,8 C6,4.6862915 8.6862915,2 12,2 C15.3137085,2 18,4.6862915 18,8 C18,11.3137085 15.3137085,14 12,14 Z M8.81595773,7.80077353 C8.79067542,7.43921955 8.47708263,7.16661749 8.11552864,7.19189981 C7.75397465,7.21718213 7.4813726,7.53077492 7.50665492,7.89232891 C7.62279197,9.55316612 8.39667037,10.8635466 9.79502238,11.7671393 C10.099435,11.9638458 10.5056723,11.8765328 10.7023788,11.5721203 C10.8990854,11.2677077 10.8117724,10.8614704 10.5073598,10.6647638 C9.4559885,9.98538454 8.90327706,9.04949813 8.81595773,7.80077353 Z" fill="#000000" opacity="0.3"/>
                                       </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                 </span>
                              </div>
                              <!--end::Icon-->
                              <!--begin::Content-->
                              <div class="d-flex flex-column">
                                 <a href="#" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">
                                 

                                    {{__("home.Get Started")}}
                                 </a>
                                 <div class="text-dark-75">
                                    
                                      {{__("home.Base FAQ Questions")}}
                                 </div>
                              </div>
                              <!--end::Content-->
                           </div>
                        </div>
                     </div>
                     <!--end::Callout-->
                  </div>
                  <div class="col-lg-4">
                     <!--begin::Callout-->
                     <div class="card card-custom wave wave-animate-slow wave-danger mb-8 mb-lg-0">
                        <div class="card-body">
                           <div class="d-flex align-items-center p-5">
                              <!--begin::Icon-->
                              <div class="mr-6">
                                 <span class="svg-icon svg-icon-danger svg-icon-4x">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/Thunder-move.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                       <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                          <rect x="0" y="0" width="24" height="24"/>
                                          <path d="M16.3740377,19.9389434 L22.2226499,11.1660251 C22.4524142,10.8213786 22.3592838,10.3557266 22.0146373,10.1259623 C21.8914367,10.0438285 21.7466809,10 21.5986122,10 L17,10 L17,4.47708173 C17,4.06286817 16.6642136,3.72708173 16.25,3.72708173 C15.9992351,3.72708173 15.7650616,3.85240758 15.6259623,4.06105658 L9.7773501,12.8339749 C9.54758575,13.1786214 9.64071616,13.6442734 9.98536267,13.8740377 C10.1085633,13.9561715 10.2533191,14 10.4013878,14 L15,14 L15,19.5229183 C15,19.9371318 15.3357864,20.2729183 15.75,20.2729183 C16.0007649,20.2729183 16.2349384,20.1475924 16.3740377,19.9389434 Z" fill="#000000"/>
                                          <path d="M4.5,5 L9.5,5 C10.3284271,5 11,5.67157288 11,6.5 C11,7.32842712 10.3284271,8 9.5,8 L4.5,8 C3.67157288,8 3,7.32842712 3,6.5 C3,5.67157288 3.67157288,5 4.5,5 Z M4.5,17 L9.5,17 C10.3284271,17 11,17.6715729 11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L4.5,20 C3.67157288,20 3,19.3284271 3,18.5 C3,17.6715729 3.67157288,17 4.5,17 Z M2.5,11 L6.5,11 C7.32842712,11 8,11.6715729 8,12.5 C8,13.3284271 7.32842712,14 6.5,14 L2.5,14 C1.67157288,14 1,13.3284271 1,12.5 C1,11.6715729 1.67157288,11 2.5,11 Z" fill="#000000" opacity="0.3"/>
                                       </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                 </span>
                              </div>
                              <!--end::Icon-->
                              <!--begin::Content-->
                              <div class="d-flex flex-column">
                                 <a href="#" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">
                                  {{__("home.Tutorials")}}
                                 </a>
                                 <div class="text-dark-75">
                                    
                                     {{__("home.Books & Articles")}}
                                 </div>
                              </div>
                              <!--end::Content-->
                           </div>
                        </div>
                     </div>
                     <!--end::Callout-->
                  </div>
                  <div class="col-lg-4">
                     <!--begin::Callout-->
                     <div class="card card-custom wave wave-animate-slow wave-success mb-8 mb-lg-0">
                        <div class="card-body">
                           <div class="d-flex align-items-center p-5">
                              <!--begin::Icon-->
                              <div class="mr-6">
                                 <span class="svg-icon svg-icon-success svg-icon-4x">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Sketch.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                       <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                          <rect x="0" y="0" width="24" height="24"/>
                                          <polygon fill="#000000" opacity="0.3" points="5 3 19 3 23 8 1 8"/>
                                          <polygon fill="#000000" points="23 8 12 20 1 8"/>
                                       </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                 </span>
                              </div>
                              <!--end::Icon-->
                              <!--begin::Content-->
                              <div class="d-flex flex-column">
                                 <a href="#" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">
                                   {{__("home.User Guide")}}
                                 </a>
                                 <div class="text-dark-75">
                                    
                                      {{__("home.Complete Knowledgebase")}}
                                 </div>
                              </div>
                              <!--end::Content-->
                           </div>
                        </div>
                     </div>
                     <!--end::Callout-->
                  </div>
               </div>
            </div>
            <!--end::Section-->
            <!--begin::Section-->
            <div class=" container  mb-8">
               <div class="card">
                  <div class="card-body">
                     <div class="p-6">
                        <h2 class="text-dark mb-8"> {{__("home.FAQ")}}</h2>
                        <div class="row">
                           <div class="col-lg-3">
                              <!--begin::Navigation-->
                              <ul class="navi navi-link-rounded navi-accent navi-hover flex-column mb-8 mb-lg-0" role="tablist">
                                 <!--begin::Nav Item-->
                                 @php
                                 $i_cate = 0;
                                 @endphp
                                 @foreach($get_faq_category as $category)
                                 <li class="navi-item mb-2">
                                    <a id="{{ $category->id }}" class="ChangeFAQ navi-link {{ ($i_cate == '0') ? 'active' : '' }}" data-toggle="tab" href="#accordionExample{{ $category->id }}" >
                                    <span class="navi-text text-dark-50 font-size-h5 font-weight-bold">{{ $category->getName() }}</span>
                                    </a>
                                 </li>
                                 @php 
                                 $i_cate++
                                 @endphp
                                 @endforeach
                                 <!--end::Nav Item-->
                              </ul>
                              <!--end::Navigation-->
                           </div>
                           <div class="col-lg-7">
                              @php
                              $i_sub_cate = 0;
                              @endphp
                              @foreach($get_faq_category as $category_s)
                              @php 
                              $i_sub_cate++
                              @endphp
                              <!--begin::Accordion-->
                              <div style="{{ ($i_sub_cate == 1) ? '' : 'display: none;' }}" class="hide-faq-all accordion accordion-light accordion-light-borderless accordion-svg-toggle" id="accordionExample{{ $category_s->id }}">
                                 @foreach($category_s->get_faq as $faq)
                                 <!--begin::Item-->
                                 <div class="card">
                                    <!--begin::Header-->
                                    <div class="card-header" id="headingOne{{  $faq->id }}">
                                       <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne{{  $faq->id }}" aria-expanded="true" role="button">
                                          <span class="svg-icon svg-icon-primary">
                                             <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-right.svg-->
                                             <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                   <polygon points="0 0 24 0 24 24 0 24"/>
                                                   <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"/>
                                                   <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "/>
                                                </g>
                                             </svg>
                                             <!--end::Svg Icon-->
                                          </span>
                                          <div class="card-label text-dark pl-4">{{ $faq->getName() }}</div>
                                       </div>
                                    </div>
                                    <!--begin::Body-->
                                    <div id="collapseOne{{  $faq->id }}" class="collapse" aria-labelledby="headingOne{{  $faq->id }}" data-parent="#accordionExample{{  $category_s->id }}" >
                                       <div class="card-body text-dark-50 font-size-lg pl-12">
                                          {{ $faq->getDescription() }}
                                       </div>
                                    </div>
                                    <!--end::Body-->
                                 </div>
                                 @endforeach
                                 <!--end::Item-->
                              </div>
                              <!--end::Accordion-->
                              @endforeach
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!--end::Section-->
            <!--begin::Section-->
            <div class=" container  mb-8">
               <div class="card card-custom p-6">
                  <div class="card-body">
                     <!--begin::Heading-->
                     <h2 class="text-dark mb-8">{{__("home.About China")}}</h2>
                     <!--end::Heading-->
                     <!--begin::Content-->
                     <h4 class="font-weight-bold text-dark mb-4">
                        {{__("home.How to become an English teacher in China?")}}
                        <a class="font-weight-bold HideReadMore HideReadMore1" style="display: none" id="1" href="javascript:;">{{__("home.Hide")}}</a>
                     </h4>
                     <div class="text-dark-50 line-height-lg mb-8">
                        <p>
                           If you are thinking about teaching in English in China then there is no need to worry about it. We are providing some guidance to become an English Teacher in China. There are some eligibility criteria to become an English Teacher in China.
                        </p>
                        <div style="display: none;" id="AboutChinaReadMore1">
                           <p>
                              Teaching English abroad is a popular way for college graduates to go abroad. Teaching jobs in China is a great option for all teachers as the country is offering the most terms of culture, language, and travel opportunities. However, there is a need for proper planning and preparation for teaching abroad in China. You should know the following main requirement of becoming an English Teacher in China.
                           </p>
                           <p>
                              You should have the idea of speaking the English Language. Teaching English will improve your understanding of the culture of China. Further, it will help you to make interactions with other students from different countries. These programs will give you the opportunity to engage in a cultural exchange, which was my main reason for going abroad.
                           </p>
                           <p>
                              We are discussing some methods to become an English teacher in China.
                           </p>
                           <p>
                           <ul>
                              <li>Earn a Bachelor's Degree.</li>
                              <li>Earn a TEFL certificate.</li>
                              <li>Complete a TELF internship in China.</li>
                              <li>Age</li>
                              <li>Visa</li>
                              <li>Finding the English Job</li>
                              <li>Earn a Bachelor's Degree.</li>
                           </ul>
                           </p>
                           <p>
                              Many teachers move to china every year to teach as English Teachers in China. Most of the teaching jobs in China require applicants to earn bachelor's degrees. So it is necessary for you to complete your Bachelor's Degree in selection of English teachers in China. So when you have a degree then you will be able to teach as an English teacher in China. As the government of china needs an application for teaching jobs in china for a university graduate.
                           </p>
                           <p>
                              If you are going to work in China legally then there is a need to get the Z visa. For this purpose, there is a need for a bachelor's degree.  So when you will submit the applications then there will be a need for a certificate or bachelor's degree.
                           </p>
                           <p>
                              However, there is no need to have a specialization of English in a bachelor's degree for an English teacher. 
                           </p>
                           <p><strong>Earn a TEFL certificate.</strong></p>
                           <p>There is a need for a TEFL degree for an English teacher. Furthermore, TEFL is the best way for your preparation as an English teacher in China. Although there are other companies who certify the teacher but TEFL is the most widely known certificate. However, you can get the TEFL certificate.</p>
                           <p><strong>Obtain Teaching Experience</strong></p>
                           <p>Some English teaching jobs require teaching experience. Teaching experience will help you to avail of the chance of a job in china. There are different certificates that give you the right to teach in China. Let’s have look at the most popular ones. TEFL certificates will give a great advantage to ESL teachers.</p>
                           <p>Teaching English to Speakers of Other Languages is also the second popular certificate. It can prove your qualifications for teaching English. Although TEFL and TESOL are quite similar exams you can find some difficulties.</p>
                           <p>In the TESOL certificate, you can also teach English in both non- English speaking and English speaking ones. </p>
                           <p>CELTA (Certificate in Teaching English to Speakers of Other Languages) is another English certificate that is issued by Cambridge University. It can improve the necessary skills to teach English as a Second Langue.</p>
                           <p>TOEFL (Test of English as a Foreign Language) is an English exam that is valid in more than 130 countries of the world. It can prove your adequate ability to use and understand English.</p>
                           <p><strong>Complete a TELF internship in China.</strong></p>
                           <p>You can also gain a teaching job in China through a Paid TEFL internship. The internship cost may be varying between $1200 and $1500. When you will complete the TEFL internship, you will gain experience and learn your TEFL certificate.</p>
                           <p><strong>Age</strong></p>
                           <p>Age is one of the crucial factors to teach English in China.  The age should be 18-60 for this purpose. However, experience persons may have greater age.</p>
                           <p><strong>Visa</strong></p>
                           <p>Visa is one of the important requirements for the job as an English teacher in China. It may require some cost which depends upon the following factors. In general, a work visa to China may have costs from 100$ to 140$.</p>
                           <p><strong>Finding the English Job</strong></p>
                           <p>When you will fulfill all the legal requirements of an English teacher then you can avail of the opportunity of a job in china. You can search for your job. The following factors will help you to choose an English job, Determine your desired location Research available jobs Apply to open positions Be wary of recruiters.</p>
                           <p><strong>Conclusion</strong></p>
                           <p>Teaching English in China is a good job for you but you have to fulfill all necessary requirements like degree, experience certificate, TELF, visa and age to get the English Teacher job in China.</p>
                           <a class="font-weight-bold HideReadMore" id="1" href="javascript:;">{{__("home.Hide")}}</a>
                        </div>
                        <a class="font-weight-bold ReadMore ReadMoreOpen1" id="1" href="javascript:;">{{__("home.Read More")}}</a>
                     </div>
                     <!--end::Content-->
                     <!--begin::Content-->
                     <h4 class="font-weight-bold text-dark mb-4"> {{__("home.The Truth about Working in China as a Foreigner")}}
                        <a class="font-weight-bold HideReadMore HideReadMore2" style="display: none" id="2" href="javascript:;">{{__("home.Hide")}}</a>
                     </h4>
                     <div class="text-dark-50 line-height-lg mb-8">
                        <p>
                           As we know that China has the world's biggest economy. Further, China has estimated about 7000 international expatriates. Many companies are relocating to china. Chines employment can remain buoyant.
                        </p>
                        <div style="display: none;" id="AboutChinaReadMore2">
                           <p>There is issuance of an L visa for foreigners to work in China. There is also a tourist visa for 30 days to 90 days.</p>
                           <p>China is one of the largest sources of immigrants in the world. It is now an increasingly attractive destination for foreigners. Due to social and economic developments, growing international influence and better career prospects can motivate foreigners to move the country for work.</p>
                           <p>However, if you are planning to work in China then you should know the following truth and facts about working in china as a foreigner. These will give a better idea to the foreigners</p>
                           <p><strong>Economy and Job Market</strong></p>
                           <p><strong>What is the current job market situation?</strong></p>
                           <p>China's economy is booming day by day. It has made the economy one of the most candidate short markets in Asia. There are also highly salary inflation and staff turnover rates.</p>
                           <p>There are specialized jobs for many foreigners as they are highly qualified.  There are more than 85 % ex-pats with a job in China work for international companies. There is a large proportion of sales and marketing, banking and financial services.</p>
                           <p><strong>Which job functions and industries have demand</strong></p>
                           <p>The professional services are the best sector in china that shows the strongest hiring intentions. The employers have increased the headcount of 71.4 % headcount in the first half of 2015. Their experts in financial services and banking services may also continue to be in demand as china can open this sector for foreign companies.</p>
                           <p>The consumer sectors in china are going very strong. There is a significant demand for advertising and marketing professionals who are responsible to drive the revenue. These marketing professionals may be category managers, product developers, and contribution managers.</p>
                           <p><strong>How easy for international candidates to find jobs?</strong></p>
                           <p>The first preference for many companies may be to recruit local candidates. They have experience and working experience in multinational corporations.</p>
                           <p>To employers, the ideal expatriate worker would have the right mix of technical experience, related skills, and bilingual abilities.</p>
                           <p>There may be some positions for top-level management and expatriate staff. The ideal expatriate worker may have the right mix of some technical experience.</p>
                           <p>However, there are some skills in demand that can include the IT and Complex manufacturing processes, financial skills, international marketing experience, and financial managers. They are familiar with WTO rules and experienced lawyers. These lawyers are experts in international trade law.</p>
                           <p>However, the Bilingual foreigners who have some experience of working in China are considered for many managerial roles. They are being offered some local packages. It may include some benefits of housing or tax incentives.  There are many local companies that are not offering housing packages.</p>
                           <p><strong>Which types of companies recruit international candidates?</strong></p>
                           <p>Foreign-invested enterprises have an 85% expatriate workforce. There is 40% of ex-pats jobs are in china is for sales and marketing. However, you can also see 10% management and 5 % IT jobs in China. There is a small percentage of expatriate works for Chines Companies.</p>
                           <p><strong>What language skills are required?</strong></p>
                           <p>There is a need for fluency and spoken English for jobs in China. However, there is a certain level of Mandarin that can give an advantage. The best-paying jobs in china require the ability to speak Mandarin. There are many positions that require spoken and written Mandarin.</p>
                           <p><strong>Housing and Accommodation</strong></p>
                           <p>There are many options for catering to all budgets. However, the prices of real estate are rising in China.</p>
                           <p>There are fully furnished apartments. Leaseholders can choose furniture as per their demand. Kitchen appliances are also included. However, the serviced department may include some extra services, fitness centers, and main services.</p>
                           <p>If you are looking for a place in China then you can get some help from a Chinese contact person. You can also get information from the HR staff members of the company. Furthers your friends can also give a lot of information.  You can talk to a landlord and approve the rental agreement or look at the house.</p>
                           <p><strong>Work in China</strong></p>
                           <p>If you are looking for work in China then you can search for and apply for many jobs. You can search for many jobs online from leading recruiters. There is a new and exciting role for each job. When you will apply online then you will send your CV. The recruiters will match the quality of the candidates.</p>
                           <p>However, foreigners can do the following jobs in china</p>
                           <p>
                           <ul>
                              <li>Teaching English</li>
                              <li>IT Jobs</li>
                              <li>Engineering / Specialized Technical Skills jobs</li>
                              <li>Marketing/Creative Field jobs</li>
                              <li>English Editor/ Writer/ Journalist</li>
                              <li>Trading company sales manager</li>
                              <li>Accounting and Financial jobs</li>
                              <li>Hotel management jobs.</li>
                           </ul>
                           </p>
                           <a class="font-weight-bold HideReadMore" id="2" href="javascript:;"> {{__("home.Hide")}}</a>
                        </div>
                        <a class="font-weight-bold ReadMore ReadMoreOpen2" id="2" href="javascript:;">{{__("home.Read More")}}</a>
                     </div>
                     <h4 class="font-weight-bold text-dark mb-4"> {{__("home.Cost of living-Teaching English in China")}}
                        <a class="font-weight-bold HideReadMore HideReadMore3" style="display: none" id="3" href="javascript:;">{{__("home.Hide")}}</a>
                     </h4>
                     <div class="text-dark-50 line-height-lg mb-8">
                        <p>
                           Many people are trying to earn from china to enjoy their life and save some money. This is one of the best reasons that people teach English in China. Teaching English in China can provide a lot of benefits like traveling, the introduction of a new culture. However, you can earn a lot of money from China.  
                        </p>
                        <div style="display: none;" id="AboutChinaReadMore3">
                           <p><strong>Average English Teacher’s Salary in China</strong></p>
                           <p>If we look at average foreign English Teacher salary in China then we can see that it rounds about the 10000-15000 RMB or $1,400 – $2,200 per month. It looks like a high salary as compared to the home country. The key factor in the cost of living in China. We are going to discuss the lifestyle and cost of living of an English teacher.</p>
                           <p>
                           <ul>
                              <li>Cost of Renting an Apartment in China</li>
                              <li>Cost of Transportation in China </li>
                              <li>Cost of Food in China </li>
                              <li>Dining Out in China</li>
                              <li>Grocery Shopping in China</li>
                              <li>Cost of Leisure Activities in China</li>
                           </ul>
                           </p>
                           <p><strong>Cost of Renting an Apartment in China</strong></p>
                           <p>Rent is a major factor in the cost of living outside the home. It is the major expense for you if you are teaching in China. Although the cost of renting an apartment in China is very low. The prices of renting may vary from city to city and district to district.</p>
                           <p>There are some high-cost cities in China like Beijing and Shanghai. You may have to pay at least 4000 RMB. While you may pay less cost in Guangzhou. The prices can vary when you will choose 1 bedroom or 2-bed room apartments.</p>
                           <p>However when you will consider some school that provides first leap China can also provide the allowances. There is a higher apartment allowance for teachers.</p>
                           <p>When you will arrive in China, you will need to have some cash to fulfill the expense for your apartment. There is also a requirement of payment in advance.</p>
                           <p><strong>Cost of Transportation in China</strong></p>
                           <p>The transportation cost may be low in China. You may pay for 2 RMB for the city Bus and 25 RMB for the 20-minute taxi ride. The riding may be affordable as it may start from 2 RMB. Traveling within China may be inexpensive and it may cost around 490 RMB to get speed train from Guangzhou to Wuhan. Flights for nearby cities may be inexpensive as it largely depends upon the departure and arrival of cities. However, transportation is very inexpensive in China for an English teacher.</p>
                           <p><strong>Cost of Food in China</strong></p>
                           <p>If we look at the local food of china then we find it very different from the home country. You will find a wide variety of food in China. The quality of the food may be good and cheaper in China.</p>
                           <p>It means there is a low cost of living in China for you if you eat local food. You can find local food everywhere. However, if you prefer the important food as European food then it will be difficult for you to find the food in China. It will be an expensive food for you.</p>
                           <p><strong>Dining Out in China</strong></p>
                           <p>There are many options for dining in China. The adventurous people will like local street food. The people search for some taste and cheap food. So if you are an English teacher then you can search for the cheap food in China Street food. You can choose eggs, potatoes, carrots and some meat for your meal. This meal may cost for 3 RMB.</p>
                           <p><strong>Grocery Shopping in China</strong></p>
                           <p>The food prices in China are very low in comparison to your home country. it will also depend upon the cooking of your home. However, the budget for grocery shopping in china is low for an English teacher. You can afford the prices of grocery in the China.</p>
                           <p><strong>Cost of Leisure Activities in China</strong></p>
                           <p>Many people in China teach English to enjoy a variety of leisure and cultural activities. It is good to step for them as they can be happy and comfortable in that living standard. These activities are very cheaper. It will give you the chance to have 3-course dinners which may be cost of less than 100 RMB.</p>
                           <p>If you want to join the fitness club then there will be a membership cost of 150 RMB. Some teachers like to watch the night movies in Cinema which may cost 65 RMB. However, you can explore the historical cities of the Forbidden City in Beijing.</p>
                           <p><strong>Conclusion</strong></p>
                           <p>You can see the cost of living in China then it is not a huge budget for an English Teacher. In this article, we have seen the different budgets for the cost of living. This article will give you a clear idea of the living cost of an English teacher in China.</p>
                           <a class="font-weight-bold HideReadMore" id="3" href="javascript:;">{{__("home.Hide")}}</a>
                        </div>
                        <a class="font-weight-bold ReadMore ReadMoreOpen3" id="3" href="javascript:;">{{__("home.Read More")}}</a>
                     </div>
                     <h4 class="font-weight-bold text-dark mb-4">{{__("home.How much you Earn Teaching English in China")}} <a class="font-weight-bold HideReadMore HideReadMore4" style="display: none" id="4" href="javascript:;">{{__("home.Hide")}}</a></h4>
                     <div class="text-dark-50 line-height-lg ">
                        <p>
                           Those people who teach English in China in 2020 can earn almost 6.500 RMB and 16,000 RMB. It will be roughly $920 and $2,300 per month. However, there are many other factors that can affect the earning in China.
                        </p>
                        <div style="display: none;" id="AboutChinaReadMore4">
                           <p>Qualification and previous experience.</p>
                           <p><strong>The Working region or City.</strong></p>
                           <p>It is important to know that public school teachers will pay less than private schools. You will find more bonuses in an international school and private schools.</p>
                           <p> However, you will find different paying jobs in china but an English job will improve your financial position. You can see the salaries for teaching English for different classes and schools.</p>
                           <p>If you are teaching Kindergarten then salary maybe 8,000 – 12,000 RMB or $1,200 – $1,800.  When you will work with young learners then you can earn a decent salary. These classes are very short from 20 to 40 minutes.</p>
                           <p><strong>Salaries for Teaching English in Public Schools</strong></p>
                           <p>You can earn almost 10000 RMB per month and 6000 RMB from public schools. If you are teaching in high school in China then you will be able to get the 12,000 or 14,000 RMB per month</p>
                           <p>However, the top-rated schools may offer some bonuses and free trips and health insurance of $2,000. So private school can give you more chance of earning than private schools.</p>
                           <p><strong>Salaries for Teaching English in Private Institutions</strong></p>
                           <p>According to different research, the salary of the private sector is more than the public sector. The teacher can earn more income from private schools and Kindergartens as he can earn 13,000 RMB or $1,840.</p>
                           <p>Parents pay more for qualified foreign teachers. If you teach in public schools and a part-time job in a private school then you can earn more income and improve your situation. When you will teach in rural China then you will see the less strict schedules as well as low salary. Private schools have some attractive packages.</p>
                           <p><strong>Salaries for Teaching English in Language Centers</strong></p>
                           <p>Languages courses are important places for ESL teachers in China as you can teach only 20 people in the class. The salary of teachers maybe 10,000 RMB or $1,415.</p>
                           <p>The teacher salary can be between 10,000 RMB and 13,000 RMB. However, you can earn $1,410 – $1,840 per month by teaching English in learning centers. When there is a new contract for language learning centers then you can earn an extra minimum of 5,000 RMB for a new contract.</p>
                           <p><strong>Salaries for Teaching English in International Schools</strong></p>
                           <p>You should not be confused with international institutions. The normal salary for these schools may be 13,000 – 14,000 RMB. If you want to teach TEFL in China then you should be native in language. Further, international schools do not require uncertified amateurs with no degree. The diploma is necessary for teaching in International schools. </p>
                           <p><strong>Salaries for Teaching English in Colleges and Universities</strong></p>
                           <p>The great benefits of higher education in China are the number of working hours. In china 15 class hours in a week are considered full-time office hours. The English Professor in China can earn almost $1,200 – $1,300 per month.</p>
                           <p>However, universities and colleges in China can offer meals and allowances of utility bills.</p>
                           <p><strong>Teaching Salary Depends on Geography</strong></p>
                           <p>Another important factor is geography. There are three tiers that can help you to understand the earning salary in China.</p>
                           <p><strong>Tier 1 Cities</strong></p>
                           <p>Beijing, Shanghai, Guangzhou, and Shenzhen cities are included in Tier 1 cities.</p>
                           <p>You can earn a full-time salary of about 14,000 RMB and minimum wages of 7,000 RMB in these cities. However, there is also 18,000 RMB for experienced English teachers.</p>
                           <p><strong>Tier 2 Cities</strong></p>
                           <p>Tier 2 cities are Nanjing, Chengdu, Kunming, Wuhan, and Xiamen. You can earn an average salary of 10,000 RMB and a minimum of 4,000 RMB from these cities as these cities are less popular with tourists.</p>
                           <p><strong>Tier 3 Cities</strong></p>
                           <p>Yangzhou, Zhongshan, Guilin, and Foshan have included in tier 3 cities. The cost of living in these cities is incomparable for the 1st Tier. You may earn a lot with $350 – $450 per month. If you are new in English teaching and have no experience then 3rd tier cities are the best choice for you. You will find the job very easy.</p>
                           <p><strong>Salary depends on Education, Experience, and Qualifications</strong></p>
                           <p>It is also a great fact that your earning depend on qualification and certification. If you are TEFL certified then you will earn more money. However, your degree and native language will also affect the salary in china.</p>
                           <p><strong>Conclusion</strong></p>
                           <p>Earning in China as an English teacher requires some skills, education, and experience. If you are a well-qualified and experienced person then you can earn a lot of money from teaching Teaching English in China.</p>
                           <a class="font-weight-bold HideReadMore" id="4" href="javascript:;">{{__("home.Hide")}}</a>
                        </div>
                        <a class="font-weight-bold ReadMore ReadMoreOpen4" id="4" href="javascript:;">{{__("home.Read More")}}</a>
                     </div>
                     <!--end::Content-->
                  </div>
               </div>
            </div>
            <!--end::Section-->
            <!--begin::Section-->
            <div class=" container ">
               <div class="row">
                   <div class="col-lg-3">
                   
                  </div>
                  <div class="col-lg-6">
                     <!--begin::Callout-->
                     <div class="card card-custom p-6 mb-8 mb-lg-0">
                        <div class="card-body">
                           <div class="row">
                              <!--begin::Content-->
                              <div class="col-sm-7">
                                 <h2 class="text-dark mb-4">{{__("home.Get in Touch")}}</h2>
                                 <p class="text-dark-50 line-height-lg">
                                    
                                    {{__("home.Windows 10 automatically installs updates to make for sure")}}
                                 </p>
                              </div>
                              <!--end::Content-->
                              <!--begin::Button-->
                              <div class="col-sm-5 d-flex align-items-center justify-content-sm-end">
                                 <a style="box-shadow: none;" href="{{ url('contact-us') }}" class="btn font-weight-bolder text-uppercase font-size-lg btn-primary py-3 px-6">
{{__("home.Submit a Request")}}
                                 </a>
                              </div>
                              <!--end::Button-->
                           </div>
                        </div>
                     </div>
                     <!--end::Callout-->
                  </div>
                  <div class="col-lg-3">
                   
                  </div>
               </div>
            </div>
            <!--end::Section-->
            <!--end::Entry-->
         </div>
         <!--end::Content-->
         <!--begin::Footer-->
         <div class="footer bg-white py-4 d-flex flex-lg-column " id="kt_footer">
            <!--begin::Container-->
            <div class=" container  d-flex flex-column flex-md-row align-items-center justify-content-between">
               <!--begin::Copyright-->
               <div class="text-dark order-2 order-md-1">
                  <span class="text-muted font-weight-bold mr-2">2020&copy;</span>
                  <a href="http://keenthemes.com/metronic" target="_blank" class="text-dark-75 text-hover-primary">{{__("home.Keenthemes")}}</a>
               </div>
               <!--end::Copyright-->
               <!--begin::Nav-->
               <div class="nav nav-dark order-1 order-md-2">
                  <a href="" target="_blank" class="nav-link pr-3 pl-0">{{__("home.About")}}</a>
                  <a href="" target="_blank" class="nav-link px-3">{{__("home.Team")}}</a>
                  <a href="{{ url('contact-us') }}" target="_blank" class="nav-link pl-3 pr-0">{{__("home.Contact")}}</a>
               </div>
               <!--end::Nav-->
            </div>
            <!--end::Container-->
         </div>
         <!--end::Footer-->
      </div>
      <!--end::Wrapper-->
   </div>
   <!--end::Page-->
</div>
<!--end::Main-->
@endsection
@section('script')
<script type="text/javascript">
   $('.ChangeFAQ').click(function(){
      $('.ChangeFAQ').removeClass('active');
      $(this).addClass('active');
      var id = $(this).attr('id');
      $('.hide-faq-all').hide();
      $('#accordionExample'+id).show();
   });
   
   $('.ReadMore').click(function(){
          var id = $(this).attr('id');
         $('#AboutChinaReadMore'+id).show();
         $('.HideReadMore'+id).show();
         $(this).hide();
   });
   
   $('.HideReadMore').click(function(){
          var id = $(this).attr('id');
         $('.ReadMoreOpen'+id).show();
         $('.HideReadMore'+id).hide();
         $('#AboutChinaReadMore'+id).hide();
         
   });   
</script>
@endsection