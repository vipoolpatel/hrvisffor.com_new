@extends('layouts.app')
@section('content')

 <!-- Search End -->
      <!-- Home Banner Start   -->
      <section class="home-banner">
         <div class="container py-3">
            <div class="row">
               <div class="col-md-6">
                  <div class="banner-text">
                     <div class="welcome">
                        <span>Welcome</span>
                     </div>
                     <div class="banner-title">
                        <h2> Work in China as an <br/>
                           English Teacher
                        </h2>
                     </div>
                     <div class="banner-btn-area">
                        <a href="#jobs" class="banner-white-btn">View Chinese School</a>
                        <a href="#job-seekers" class="banner-green-btn">View English Teacher</a>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="banner-image">
                     <img src="{{ url('assets/front/img/7_Web Design V1.png') }}" class="img-fluid">
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- Home Banner End   -->
      <!-- Popular Searches start -->
      <section>
         <div class="container">
            <div class="row">
               <div class="col-md-11 mx-auto">
                  <div class="tab-list">
                     <nav class="nav-justified ">
                        <div class="nav nav-tabs " id="nav-tab" role="tablist">
                           <a class="nav-item nav-link active" id="pop1-tab" href="#application" role="tab"
                              aria-controls="pop1" aria-selected="true"><i class="fa fa-envelope"></i> Application
                           Process</a>
                           <a class="nav-item nav-link" id="pop2-tab" href="#videos" role="tab"
                              aria-controls="pop2" aria-selected="false"><i class="fa fa-sticky-note"></i> Testimonials</a>
                           <a class="nav-item nav-link" id="pop3-tab" href="#beijing-profile" role="tab"
                              aria-controls="pop3" aria-selected="false"><i class="fa fa-building"></i> China City
                           Profile</a>
                           <a class="nav-item nav-link" id="pop4-tab" href="#blog" role="tab"
                              aria-controls="pop3" aria-selected="false"><i class="fa fa-search-plus"></i>
                           Resources</a>
                        </div>
                     </nav>
                  </div>
               </div>
               <div class="col-md-12" id="map">
                  <div class="tab-content" id="nav-tabContent">
                     <div class="tab-pane fade show active" id="pop1" role="tabpanel" aria-labelledby="pop1-tab">
                        <div class="pt-3"></div>
                        <h2 class="text-center py-3">Teacher Join Us <br/>
                           Around The World
                        </h2>
                        <div class="row">
                           <div class="col-md-10 mx-auto">
                              <div id="container"></div>
                           </div>
                        </div>
                     </div>
                     <div class="tab-pane fade" id="pop2" role="tabpanel" aria-labelledby="pop2-tab">
                        <div class="pt-3"></div>
                        <p></p>
                     </div>
                     <div class="tab-pane fade" id="pop3" role="tabpanel" aria-labelledby="pop3-tab">
                        <div class="pt-3"></div>
                        <p></p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- Popular Searches ends -->
      <!-- Testimonials start -->
      <div class="section">
         <div class="container">
            <!-- title start -->
            <div class="titleTop">
               <h3>Latest <span>Blogs</span></h3>
            </div>
            <!-- title end -->
            <ul class="jobslist row">
               <li class="col-lg-4">
                  <div class="bloginner">
                     <div class="postimg">
                        <img src="{{ url('assets/front/img/woman-in-discussing-a-lesson-plan-3772511.png') }}" class="img-fluid">
                     </div>
                     <div class="blog-post">
                        <div class="post-header">
                           <h4><a href="#how-to-become-an-english-teacher-in-china">How to become an English teacher in China?</a></h4>
                           <div class="postmeta">Category : <a href='#jobseekers'>Jobseekers</a>, <a href='#general'>General</a></div>
                        </div>
                        <p class="p-1">
                        <p>If you are thinking about teaching in English in China then there is no need to worry about it. We are providing some guidance to become an English...</p>
                     </div>
                  </div>
               </li>
               <li class="col-lg-4">
                  <div class="bloginner">
                     <div class="postimg">
                        <img src="{{ url('assets/front/img/woman-in-discussing-a-lesson-plan-3772511.png') }}" class="img-fluid">
                     </div>
                     <div class="blog-post">
                        <div class="post-header">
                           <h4><a href="#the-truth-about-working-in-china-as-a-foreigner">The Truth about Working in China as a Foreigner</a></h4>
                           <div class="postmeta">Category : <a href='#jobseekers'>Jobseekers</a>, <a href='#employers'>Employers</a></div>
                        </div>
                        <p class="p-1">
                        <p>As we know that China has the world's biggest economy. Further, China has estimated about 7000 international expatriates. Many companies are reloca...</p>
                     </div>
                  </div>
               </li>
               <li class="col-lg-4">
                  <div class="bloginner">
                     <div class="postimg">
                        <img src="{{ url('assets/front/img/woman-in-discussing-a-lesson-plan-3772511.png') }}" class="img-fluid">
                     </div>
                     <div class="blog-post">
                        <div class="post-header">
                           <h4><a href="#cost-of-living-teaching-english-in-china">Cost of living-Teaching English in China</a></h4>
                           <div class="postmeta">Category : <a href='#jobseekers'>Jobseekers</a>, <a href='#general'>General</a></div>
                        </div>
                        <p class="p-1">
                        <p><strong>Cost of living-Teaching English in China</strong></p>
                        <p>Many people are trying to earn from china to enjoy their life and save some money...</p>
                     </div>
                  </div>
               </li>
            </ul>
            <!--view button-->
            <div class="viewallbtn"><a href="#blog">View All Blog Posts</a></div>
            <!--view button end-->
         </div>
      </div>
      <!-- Testimonials End -->
      <section class="why-tech">
         <div class="container py-5">
            <div class="row">
               <div class="col-md-12 text-center py-3">
                  <div class="titleTop">
                     <h3>Why Teach English in <span>China?</span></h3>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6 py-3">
                  <div class="card">
                     <div class="row">
                        <div class="col-md-5 pr-0 text-center">
                           <img src="{{ url('assets/front/img/tourists-at-forbidden-temple-1486577.png') }}" class=" why-tech-img">
                        </div>
                        <div class="col-md-7 px-1  py-4">
                           <div class="card-block tech-card">
                              <h4 class="card-title">Live abroad</h4>
                              <p class="card-text">Experience life in a foreign country,
                                 Eat work and play like a local
                              </p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 py-3">
                  <div class="card">
                     <div class="row">
                        <div class="col-md-5 pr-0  text-center">
                           <img src="{{ url('assets/front/img/three-toddler-eating-on-white-table-1001914@2x.png') }}" class="why-tech-img">
                        </div>
                        <div class="col-md-7 px-1  py-4">
                           <div class="card-block tech-card">
                              <h4 class="card-title">Inspire children</h4>
                              <p class="card-text">Share your language and culture
                                 with curious children who are eager
                                 to learn
                              </p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 py-3">
                  <div class="card">
                     <div class="row">
                        <div class="col-md-5 pr-0  text-center">
                           <img src="{{ url('assets/front/img/photo-of-dragon-temple-733071.png') }}" class=" why-tech-img">
                        </div>
                        <div class="col-md-7 px-1  py-4">
                           <div class="card-block tech-card">
                              <h4 class="card-title">5000 Chinese history</h4>
                              <p class="card-text">China is the oldest continuous
                                 civilization on Earth, dating
                                 from 3500BC.
                              </p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 py-3">
                  <div class="card">
                     <div class="row">
                        <div class="col-md-5 pr-0 text-center">
                           <div class="tech-image">
                              <img src="{{ url('assets/front/img/man-sitting-with-laptop-computer-on-desk-and-lamp-1586996.png') }}" class=" why-tech-img">
                           </div>
                        </div>
                        <div class="col-md-7 px-1  py-4">
                           <div class="card-block tech-card">
                              <h4 class="card-title">Grow Your career</h4>
                              <p class="card-text">Earn a competitive salary and
                                 benefit from a low cost of living
                              </p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <section class="why-choose" id="why_us">
         <div class="container py-5">
            <div class="row">
               <div class="col-md-12 text-center py-3">
                  <div class="titleTop">
                     <h3>Why Choose <span>Visffor?</span></h3>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-3">
                  <div class="legal">
                     <div class="why-tech-image py-3">
                        <i class="fa fa-handshake-o fa-2x"></i>
                     </div>
                     <div>
                        <h4>Legal Protection</h4>
                        <div class="why-choose-details">
                           <p>Starting your job in China Is
                              not the end of our service Our
                              lawyers protect you while you
                              are working in China.
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="support">
                     <div class="why-tech-image py-3">
                        <i class="fa fa-support fa-2x"></i>
                     </div>
                     <div>
                        <h4>24 hour support</h4>
                        <div class="why-choose-details">
                           <p>With offices in China, USA, UK
                              and Australia, there is always
                              someone available to answer
                              your questions.
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="visa">
                     <div class="why-tech-image py-3">
                        <i class="fa fa-cc-visa fa-2x"></i>
                     </div>
                     <div>
                        <h4>Visa support</h4>
                        <div class="why-choose-details">
                           <p>Our professional visa team are
                              expertsin Chinese and other
                              countries' visa policies. Every
                              teacher gets a personal visa
                              support team.
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="loyalty">
                     <div class="why-tech-image py-3">
                        <i class="fa fa-hand-spock-o fa-2x"></i>
                     </div>
                     <div >
                        <h4>Loyalty</h4>
                        <div class="why-choose-details">
                           <p>We will help you every step of
                              the way. We've helped over 500
                              teacher start their adventure in
                              China.
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="container-fluid pb-3" id="videos">
            <div class="row">
               <div class="owl-carousel">
                  <div class="item black">
                     <a href="#" class="video" data-video="https://www.youtube.com/embed/FxiskmF16gU" data-toggle="modal" data-target="#videoModal">
                     <img src="{{ url('assets/front/img/slider.PNG') }}" alt="1" />
                     </a>
                  </div>
                  <div class="item">
                     <a href="#" class="video" data-video="https://www.youtube.com/embed/FxiskmF16gU" data-toggle="modal" data-target="#videoModal">
                     <img src="{{ url('assets/front/img/slider.PNG') }}" alt="2" />
                     </a>
                  </div>
                  <div class="item black">
                     <a href="#" class="video" data-video="https://www.youtube.com/embed/FxiskmF16gU" data-toggle="modal" data-target="#videoModal">
                     <img src="{{ url('assets/front/img/slider.PNG') }}" alt="3" />
                     </a>
                  </div>
                  <div class="item">
                     <a href="#" class="video" data-video="https://www.youtube.com/embed/FxiskmF16gU" data-toggle="modal" data-target="#videoModal">
                     <img src="{{ url('assets/front/img/slider.PNG') }}" alt="4" />
                     </a>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-body">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                     <iframe width="100%" height="350" src="" frameborder="0" allowfullscreen></iframe>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <section class="timeline py-3" id="application">
         <div class="titleTop">
            <h3>Application <span>Process</span></h3>
         </div>
         <ul>
            <li>
               <div class="content">
                  <h2>
                     <time>Register online</time>
                  </h2>
                  <p>Lorem ipsum is placeholder text commonly
                     used in the graphic, print, and publishing
                     industries for previewing layouts.
                  </p>
               </div>
            </li>
            <li>
               <div class="content text-right">
                  <h2>
                     <time>Complete your profile</time>
                  </h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati quas, reiciendis quis sequi voluptatem consectetur adipisci accusamus hic vel vero ea ad iure! Natus, ipsum, enim aspernatur fugit voluptatibus similique?</p>
               </div>
            </li>
            <li>
               <div class="content">
                  <h2>
                     <time>Schedule an interview with a school</time>
                  </h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis, expedita. Dolorem blanditiis, delectus omnis eos accusamus mollitia et cupiditate officia maxime vel, nesciunt alias eius, quibusdam in ea eveniet ut!</p>
               </div>
            </li>
            <li>
               <div class="content text-right">
                  <h2>
                     <time>Get an offer and sign contract</time>
                  </h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis voluptas voluptatum dolorum, quibusdam dignissimos animi pariatur laboriosam quis explicabo similique aperiam debitis quam velit quod, reprehenderit harum ratione. Iste, unde?</p>
               </div>
            </li>
            <li>
               <div class="content">
                  <h2>
                     <time>Begin visa process</time>
                  </h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet inventore odit placeat in laboriosam dolore ducimus vero, sapiente ipsam veritatis, numquam libero itaque dolores natus ex aliquam nam nihil cumque.</p>
               </div>
            </li>
            <li>
               <div class="content text-right">
                  <h2>
                     <time>Make travel arrangements</time>
                  </h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit sequi nobis, blanditiis quae dolorem quasi reiciendis odio qui fugit? Officiis quos aspernatur mollitia dolorum pariatur repellendus quaerat dolorem magnam quo.</p>
               </div>
            </li>
            <li>
               <div class="content">
                  <h2>
                     <time>Evaluate VISFFOR service with Video</time>
                  </h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel corporis sunt nostrum velit quibusdam neque porro ratione quos dolor libero. Tempore consequatur natus nostrum delectus provident fugiat corporis error ipsa.</p>
               </div>
            </li>
            <li>
               <div class="content text-right">
                  <h2>
                     <time>Start your new job in China</time>
                  </h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel corporis sunt nostrum velit quibusdam neque porro ratione quos dolor libero. Tempore consequatur natus nostrum delectus provident fugiat corporis error ipsa.</p>
               </div>
            </li>
         </ul>
      </section>
      <section class="news-area">
         <div class="container py-3">
            <div class="row">
               <div class="col-md-12">
                  <div class="titleTop text-center">
                     <h3 class="latest-news-title"><a href="#">Latest <span>News</span></a></h3>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6 py-3">
                  <div class="card news-card">
                     <div class="row">
                        <div class="col-md-5 pr-0">
                           <img src="{{ url('assets/front/img/group-of-people-standing-inside-room-2608517.png') }}" class="news-img">
                        </div>
                        <div class="col-md-7 px-3">
                           <div class="card-block latest-news px-3">
                              <h4 class="card-title">How to become an English teacher in China?</h4>
                              <div class="card-text">
                                 <p>If you are thinking about teaching in English in China then there is no need...
                              </div>
                              <a href="#how-to-become-an-english-teacher-in-china" class="btn latest-news-btn btn-sm">Read More</a>
                              <div class="text-right float-right py-1"><small><i class="fa fa-calendar"></i> Last updated on 2020-07-08</small></div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 py-3">
                  <div class="card news-card">
                     <div class="row">
                        <div class="col-md-5 pr-0">
                           <img src="{{ url('assets/front/img/group-of-people-standing-inside-room-2608517.png') }}" class="news-img">
                        </div>
                        <div class="col-md-7 px-3">
                           <div class="card-block latest-news px-3">
                              <h4 class="card-title">The Truth about Working in China as a Foreigner</h4>
                              <div class="card-text">
                                 <p>As we know that China has the world's biggest economy. Further, China has est...
                              </div>
                              <a href="#the-truth-about-working-in-china-as-a-foreigner" class="btn latest-news-btn btn-sm">Read More</a>
                              <div class="text-right float-right py-1"><small><i class="fa fa-calendar"></i> Last updated on 2020-07-08</small></div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 py-3">
                  <div class="card news-card">
                     <div class="row">
                        <div class="col-md-5 pr-0">
                           <img src="{{ url('assets/front/img/group-of-people-standing-inside-room-2608517.png') }}" class="news-img">
                        </div>
                        <div class="col-md-7 px-3">
                           <div class="card-block latest-news px-3">
                              <h4 class="card-title">Cost of living-Teaching English in China</h4>
                              <div class="card-text">
                                 <p><strong>Cost of living-Teaching English in China</strong></p>
                                 <p>Many people...
                              </div>
                              <a href="#cost-of-living-teaching-english-in-china" class="btn latest-news-btn btn-sm">Read More</a>
                              <div class="text-right float-right py-1"><small><i class="fa fa-calendar"></i> Last updated on 2020-07-07</small></div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 py-3">
                  <div class="card news-card">
                     <div class="row">
                        <div class="col-md-5 pr-0">
                           <img src="{{ url('assets/front/img/group-of-people-standing-inside-room-2608517.png') }}" class="news-img">
                        </div>
                        <div class="col-md-7 px-3">
                           <div class="card-block latest-news px-3">
                              <h4 class="card-title">How much you Earn Teaching English in China</h4>
                              <div class="card-text">
                                 <p>Those people who teach English in China in 2020 can earn almost 6.500 RMB and...
                              </div>
                              <a href="#how-much-you-earn-teaching-english-in-china" class="btn latest-news-btn btn-sm">Read More</a>
                              <div class="text-right float-right py-1"><small><i class="fa fa-calendar"></i> Last updated on 2020-07-07</small></div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <div class="container py-5" id="faq">
         <div class="row">
            <div class="col-md-12">
               <div class="titleTop text-center">
                  <h3> Frequently Asked <span>Question</span></h3>
               </div>
            </div>
         </div>
         <div class="row">
            <ul id="accordion" class="col-sm-6 col-md-12  faq">
               <!-- Question one -->
               <li>
                  <div id="choose" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" >
                     <span class="faq-img"><img src="{{ url('assets/front/img/Repeat Grid 6.png') }}"></span>
                     <div class="p-1">How to complete profile?</div>
                     <span class="fa fa-caret-down fa-2x text-faq pull-right"></span>
                  </div>
                  <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                     <div class="card-body faq-text">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                     </div>
                  </div>
               </li>
               <!-- Question two -->
               <li>
                  <div class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                     <span class="faq-img"><img src="{{ url('assets/front/img/Repeat Grid 6.png') }}"></span>
                     <div class="p-1"> Where do I go incase I have a complaint?</div>
                     <span class="fa fa-caret-down fa-2x text-faq pull-right"></span>
                  </div>
                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                     <div class="card-body faq-text">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                     </div>
                  </div>
               </li>
               <!-- Question three -->
               <li>
                  <div class="collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                     <span class="faq-img"><img src="{{ url('assets/front/img/Repeat Grid 6.png') }}"></span>
                     <div class="p-1">Do you have any outlets in the country ?</div>
                     <span class="fa fa-caret-down fa-2x text-faq pull-right"></span>
                  </div>
                  <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                     <div class="card-body faq-text">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                     </div>
                  </div>
               </li>
               <!-- Question Four -->
               <li>
                  <div class="collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                     <span class="faq-img"><img src="{{ url('assets/front/img/Repeat Grid 6.png') }}"></span>
                     <div class="p-1"> How can I file a complaint?</div>
                     <span class="fa fa-caret-down fa-2x text-faq pull-right"></span>
                  </div>
                  <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                     <div class="card-body faq-text">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                     </div>
                  </div>
               </li>
               <!-- Questiion Five -->
               <li>
                  <div class="collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                     <span class="faq-img"><img src="{{ url('assets/front/img/Repeat Grid 6.png') }}"></span>
                     <div class="p-1">How can I join the team?</div>
                     <span class="fa fa-caret-down fa-2x text-faq pull-right"></span>
                  </div>
                  <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                     <div class="card-body faq-text">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                     </div>
                  </div>
               </li>
               <!-- Question Six-->
               <li>
                  <div class="collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                     <span class="faq-img"><img src="{{ url('assets/front/img/Repeat Grid 6.png') }}"></span>
                     <div class="p-1">In case I forgot my password, what do I do?</div>
                     <span class="fa fa-caret-down fa-2x text-faq pull-right"></span>
                  </div>
                  <div id="collapseSix" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                     <div class="card-body faq-text">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                     </div>
                  </div>
               </li>
            </ul>
         </div>
      </div>

@endsection
