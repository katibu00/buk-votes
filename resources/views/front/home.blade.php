@php
$route = Route::current()->getName();
@endphp

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BUK e-Votes - Home </title>
        <!--====== Bootstrap ======-->
        <link rel="stylesheet" href="/front/assets/css/bootstrap.min.css">
        <!--====== Font Awesome ======-->
        <link rel="stylesheet" href="/front/assets/fonts/fontawesome/css/all.min.css">
        <!--====== Flaticon ======-->
        <link rel="stylesheet" href="/front/assets/fonts/flaticon/flaticon.css">
        <!--====== Animate CSS ======-->
        <link rel="stylesheet" href="/front/assets/css/animate.min.css">
        <!-- Magnific Popup CSS -->
        <link rel="stylesheet" href="/front/assets/css/magnific-popup.min.css">
        <!--====== Slick Slider ======-->
        <link rel="stylesheet" href="/front/assets/css/slick.css">
        <!--====== Nice Select  ======-->
        <link rel="stylesheet" href="/front/assets/css/nice-select.css">
        <!--====== Default css ======-->
        <link rel="stylesheet" href="/front/assets/css/default.css">
        <!--====== Main Stylesheet ======-->
        <link rel="stylesheet" href="/front/assets/css/style.css">
        <!--====== Responsive Stylesheet ======-->
        <link rel="stylesheet" href="/front/assets/css/responsive.css">
        <!-- Place favicon in the root directory -->
        <link rel="icon" type="image/png" href="/uploads/logo.png">
        <link rel="stylesheet" href="/toast//toastr.min.css">
    </head>
    <body>
        <!--======= Start Preloader =======-->
        <div class="preloader">
            <img class="preloader-image" width="60" src="/uploads/logo.png" alt="preloader"/>
        </div> <!-- /.preloader -->
        <!--====== End Preloader ======-->
        <!--====== Start Search From ======-->
        <div class="modal fade" id="search-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form>
                        <div class="form_group">
                            <input type="text" class="form_control" placeholder="Search here...">
                            <button class="search_btn"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div> <!-- /.modal-content -->
            </div> <!-- /.modal-dialog -->
        </div><!-- /#search-modal -->
        <!--====== End Search Modal ======-->
        <!--====== Start Header Area ======-->
        <header class="header-area header-v2">
            <div class="header-navigation">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <!-- Brand Logo -->
                        <div class="col-xl-2 col-lg-4 col-md-5 col-6">
                            <div class="site-branding-and-language-selection">
                                <div class="brand-logo">
                                    <a href="index.html">
                                        <img src="/uploads/logo.png" class="logo-v1" style="width: 40px">
                                        {{-- <img src="/front/assets/img/logo-yellow.png" alt="logo yellow" class="logo-v2"> --}}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- Desktop and Mobile Menu -->
                        <div class="col-xl-7 col-lg-3 col-md-1 col-2 text-center">
                            <div class="primary-menu">
                                <div class="nav-menu">
                                    <!-- Navbar Close Icon -->
                                    <div class="navbar-close">
                                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                                    </div>
                                    <nav class="main-menu">
                                        <ul>
                                            <li class="menu-item">
                                                <a href="{{route('home')}}" class="nav-link {{($route=='/')?'active':''}}">Home</a>
                                            </li>

                                            <li class="menu-item">
                                                <a href="#report" class="nav-link">Suggestion Box</a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="#timetable" class="nav-link">Timetable</a>
                                            </li>


                                            <li class="menu-item menu-item-has-children">
                                                <a href="#" class="nav-link">Official Winners</a>
                                                <ul class="sub-menu">
                                                    @foreach ($datas as $data)
                                                    <li><a href="{{route('official.list',$data->id)}}">{{$data->title}}</a></li>
                                                    @endforeach

                                                </ul>
                                            </li>

                                            <li class="menu-item">
                                                <a href="{{route('user.guide')}}" class="nav-link">User Guides</a>
                                            </li>

                                            {{-- <li class="d-none d-xl-inline-block">
                                                <a href="#" data-toggle="modal" data-target="#search-modal" class="search-btn"><i class="fas fa-search"></i></a>
                                            </li> --}}
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <!-- Menu Right -->
                        <div class="col-xl-3 col-lg-5 col-md-6 col-4">
                            <div class="header-right">
                                <ul>
                                    <li class="get-started-wrapper">
                                        <a href="{{route('voter.login')}}" class="filled-btn bg-burning-orange">
                                         <i class="fas fa-lock"></i>   &nbsp;&nbsp;&nbsp;Sign in
                                        </a>
                                    </li>
                                    <li>
                                        <div class="menu-toggle">
                                            <div class="menu-overlay"></div>
                                            <!-- Navbar Toggler -->
                                            <div class="nav-toggle">
                                                <div class="navbar-toggler float-end">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div> <!-- /.row -->
                </div> <!-- /.container-fluid -->
            </div> <!-- /.header-navigation -->
        </header> <!-- /.header-area -->
        <!--====== End Header Area ======-->
        <div id="home"></div>
                <!--====== Start Hero Area ======-->
                <section class="hero-area hero-v2 bg-contain bg-ocean-blue hero-padding" style="background-image: url(/front/assets/img/hero/hero-map-bg.png);">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-7">
                                <div class="hero-content">
                                    <div class="section-title section-title-white">
                                        <div class="section-heading-tag wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="1500ms">
                                            {{-- <span class="single-heading-tag text-white bg-burning-orange">Save 25%</span> --}}
                                            <span class="single-heading-tag text-white bordered-tag">At Ease, Wherever you are</span>
                                        </div>
                                        <h1 class="wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="1500ms">Exercise your <span>STUDENT</span> Rights</h1>
                                        <div class="section-button-wrapper section-dual-button wow fadeInUp" data-wow-delay="0.4s" data-wow-duration="1500ms">
                                            <span>
                                                <a href="{{route('voter.login')}}" class="filled-btn bg-burning-orange">
                                                    <i class="fas  fa-lock"></i>  &nbsp;&nbsp;&nbsp;Sign in
                                                </a>
                                            </span>
                                            <span>
                                                <a href="{{route('user.guide')}}" class="filled-btn btn-bordered">
                                                    User Guides <i class="fas fa-arrow-right"></i>
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="blob-image-wrapper">
                                    <div class="blob-shape-wrapper">
                                        <img src="/front/assets/img/particle/thumbs-up-particle-white.png" alt="white thumbs up" class="blob-shape blob-shape-1 animate-float-bob-y">
                                        <img src="/front/assets/img/particle/announcement-particle-white.png" alt="white announcement" class="blob-shape blob-shape-2 animate-float-bob-x">
                                        <img src="/front/assets/img/particle/paper-plane-particle-white.png" alt="white paper plane" class="blob-shape blob-shape-3 animate-float-bob-x">
                                    </div>
                                    <div class="blob-main-image wow fadeInUp" data-wow-delay="500ms" data-wow-duration="2500ms">
                                        <img src="/uploads/square.jpg" alt="Gambari Square">
                                    </div>
                                </div> <!-- /.blob-image-wrapper -->
                            </div>
                        </div> <!-- /.row -->
                    </div> <!-- .container -->
                    <div class="hero-infobox-area">
                        <div class="container-fluid">
                            <div class="hero-infobox-internal">
                                <div class="row gap-40 justify-content-xl-between align-items-center">
                                    <div class="col-lg-6">
                                        <div class="infobox-item wow fadeInUp" data-wow-delay="00ms" data-wow-duration="1500ms">
                                            <div class="infobox-icon">
                                                <img src="/front/assets/img/hero/infobox-icon-1.png" alt="info icon one">
                                            </div>
                                            <div class="infobox-content">
                                                <h4 class="infobox-title">How to Cast your Vote</h4>
                                               {{-- <ul> --}}
                                                   <p>1. Click on <a href="{{route('voter.login')}}">LOGIN</a></p>
                                                   <p>2. Login by providing your Reg Number only</p>
                                                   <p>3. click on authentication and choose your preferred method</p>
                                                   <p>4. Enter the code sent to you and authenticate.</p>
                                                   <p>5. Cast your Vote</p>
                                               {{-- </ul> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="infobox-item wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms">
                                            <div class="infobox-icon">
                                                <img src="/front/assets/img/hero/infobox-icon-2.png" alt="info icon two">
                                            </div>
                                            <div class="infobox-content">
                                                <h4 class="infobox-title">How to Become a candidate</h4>
                                                <p>1. Click on <a href="{{route('voter.login')}}">LOGIN</a></p>
                                                <p>2. Click on Become a candidate in the menu</p>
                                                <p>3. Read and Under the instructions</p>
                                                <p>4. Update your profile</p>
                                                <p>5. Declare interest and make the payment</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- /.container -->
                    </div> <!-- /.hero-infobox-area -->
                </section> <!-- /.hero-area -->
                <!--======= End Hero Area =======-->

                <!--====== Start About Us Area ======-->
                <section class="about-us-area pt-130 pb-150">
                    <div class="container">
                        <div class="row align-items-center align-items-center">
                            <div class="col-lg-7">
                                <div class="blob-image-wrapper content-right-spacer">
                                    <div class="blob-shape-wrapper">
                                        <img src="/front/assets/img/particle/thumbs-up-particle-blue.png" alt="blue thumbs up" class="blob-shape blob-shape-1 animate-float-bob-y">
                                        <img src="/front/assets/img/particle/announcement-particle-orange.png" alt="orange announcement" class="blob-shape blob-shape-2 animate-float-bob-x">
                                        <img src="/front/assets/img/particle/paper-plane-particle-orange.png" alt="orange paper plane" class="blob-shape blob-shape-3 animate-float-bob-x">
                                    </div>
                                    <div class="blob-main-image wow fadeInUp" data-wow-delay="00ms" data-wow-duration="2500ms">
                                        <img src="/uploads/new-senate.jpg" alt="BUK Senate Building">
                                    </div>
                                </div> <!-- /.blob-image-wrapper -->
                            </div>
                            <div class="col-lg-5">
                                <div class="section-title section-title-ocean-blue">
                                    <div class="section-heading-tag">
                                        <span class="single-heading-tag">About BUK E-Votes</span>
                                    </div>
                                    <h2>Cast Your
                                        <span>VOTES</span>
                                        Securely and unanonimously
                                    </h2>
                                    <div class="section-title-quote">
                                        <p>Good leadership starts with credible election. Your votes are assured to be counted.</p>
                                    </div>
                                    <div class="section-title-description">
                                        <p>Its your duty as responsible student of Bayero University to abide by all rules and regulations governing the conduct of election in the university. Never disclose your verifification code to anyone. Election campaigns should be carried out responsibly. If you have any concern, please feel free to fill the form below and we will see your writing. </p>
                                    </div>

                                </div>
                            </div>
                        </div> <!-- /.row -->
                    </div> <!-- /.container -->
                </section> <!-- /.about-us-area -->
                <!--====== End About Us Area ======-->
                <div id="timetable"></div>
                <!--====== Start Our Services Area ======-->
                <section class="our-services our-services-v1 pt-150 pb-100" style="background-image: url(/front/assets/img/services/dots-pattern-bg.png);">
                    <div class="container">
                        <div class="service-area-internal">
                            <div class="section-particle-effect d-none d-lg-block">
                                <img class="particle-1 animate-zoominout" src="/front/assets/img/particle/gradient-ball-shape.png" alt="ball shape">
                                <img class="particle-3 animate-rotate-me" src="/front/assets/img/particle/gradient-curve-shape.png" alt="curve shape">
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="section-title mb-105 text-center section-title-ocean-blue">

                                        <h2>Election <br class="d-none d-md-block">
                                            <span>Timetable</span>

                                        </h2>
                                    </div>
                                </div>
                            </div> <!-- /.row -->
                        </div> <!-- /.service-area-internal -->
                    </div> <!-- /.container -->
                    <div id="report"></div>
                    <div class="service-area-content">
                        <div class="container-fluid">
                            <div class="row">

                                <table class="table table-responsive table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">S/N</th>
                                            <th>Name</th>
                                            <th style="color: blue">Sales of Forms</th>
                                            <th>Status</th>
                                            <th style="color: blue">Election Date</th>
                                            <th>Time</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="">
                                        @foreach ($datas as $key => $data)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$data->title}}</td>
                                            @php

                                                $form = App\Models\Forms::where('election_id',$data->id)->first();
                                                if($form){
                                                    $form_close = Carbon\Carbon::createFromFormat('Y-m-d',$form->end_date);
                                                    $form_start = Carbon\Carbon::createFromFormat('Y-m-d', $form->start_date);
                                                    $today_date = carbon\Carbon::createFromFormat('Y-m-d', date('Y-m-d'));
                                                    $start_date = Carbon\Carbon::createFromFormat('Y-m-d', $data->start_date);
                                                }

                                            @endphp
                                            @if($form)
                                            <td>{{\Carbon\Carbon::parse($form->start_date)->format('jS M')}} - {{\Carbon\Carbon::parse($form->end_date)->format('jS M')}}</td>

                                            @if($today_date->lt($form_start))
                                            <td><span class="badge" style="color: blue">Pending</span></td>
                                            @elseif($today_date->lte($form_close))
                                            <td><span class="badge" style="color:green">Ongoing</span></td>
                                            @elseif($today_date->gt($form_close))
                                            <td><span class="badge" style="color: red;">Closed</span></td>
                                           @endif

                                            <td>{{\Carbon\Carbon::parse($data->start_date)->format('l, jS M')}} ({{\Carbon\Carbon::now()->diffForHumans($start_date)}})</td>
                                            <td>{{\Carbon\Carbon::parse($data->start_time)->format('h:i A')}} - {{\Carbon\Carbon::parse($data->end_time)->format('h:i A')}}</td>

                                            @if($today_date->lt($start_date))
                                              <td><span class="badge" style="color: blue;">Pending</span></td>
                                              @elseif($today_date->eq($start_date))
                                              <td><span class="badge" style="color: green;">Ongoing</span></td>
                                              @elseif($today_date->gt($start_date))
                                              <td><span class="badge" style="color: red;">Closed</span></td>
                                             @endif
                                             @endif

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>



                            </div> <!-- /.row -->
                        </div> <!-- /.container-fluid -->
                    </div> <!-- /.service-area-content -->
                </section> <!-- /.our-services -->
                <!--====== End Our Services Area ======-->


                        <!--====== Start Newsletter Search Area ======-->
        <div class="newsletter-search-area wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
            <div class="container">
                <div class="newsletter-search-internal text-center section-gradient-1 pt-75 pb-80">
                    <div class="newsletter-search-section-images wow fadeInUp" data-wow-delay="800ms" data-wow-duration="1500ms" style="background-image: url(front/assets/img/particle/hello-announcement.png), url(front/assets/img/particle/launch-rocket.png);"></div>
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="section-title section-title-white">
                                <h2 class="wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms"><span>Suggestion Box</span></h2>
                                <p class="wow fadeInUp" data-wow-delay="400ms" data-wow-duration="1500ms">your feedback is important to us and we will try to reply if the message is important. You can add your contact details.</p>
                            </div>
                            <div class="newsletter-search-form wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1500ms">
                                <form action="{{route('message.index')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="message" id="yourWebsite" class="form-control" placeholder="Your Message" required>
                                        <input type="text" name="contact" id="emailAddress" class="form-control" placeholder="Contact Details (Phone or Email)" required>
                                        <button type="submit" name="submit" value="Go" class="filled-btn bg-burning-orange">Send Now <i class="fas fa-arrow-right"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> <!-- /.row -->
                </div> <!-- /.newsletter-search-internal  -->
            </div> <!-- /.container -->
            <div class="section-bg-overflow bg-magnolia"></div>
        </div> <!-- /.newsletter-search-area -->
        <!--====== End Newsletter Search Area ======-->



                <!--====== Start FAQ Area ======-->
                <section class="faq-area bg-magnolia pt-130 pb-130">
                    <div class="container">
                        <div class="section-internal">
                            <div class="section-particle-effect d-none d-md-block section-particle-effect-v2">
                                <img class="particle-1 animate-zoom-fade" src="/front/assets/img/particle/particle-1.png" alt="particle One">
                                <img class="particle-2 animate-rotate-me" src="/front/assets/img/particle/particle-2.png" alt="particle Two">
                                <img class="particle-3 animate-float-bob-x" src="/front/assets/img/particle/particle-3.png" alt="particle Three">
                                <img class="particle-4 animate-zoominout" src="/front/assets/img/particle/particle-4.png" alt="particle Four">
                                <img class="particle-5 animate-zoominout" src="/front/assets/img/particle/particle-5.png" alt="particle Five">
                                <img class="particle-7 animate-float-bob-x" src="/front/assets/img/particle/particle-7.png" alt="particle Seven">
                            </div>
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <div class="faq-content content-right-spacer">
                                        <div class="section-title section-title-ocean-blue">
                                            <div class="section-heading-tag">
                                                <span class="single-heading-tag">Frequenty Asked Questions</span>
                                            </div>
                                            <h2>Rules of
                                                <span>Engagement</span>
                                            </h2>
                                        </div>
                                        <div class="section-accordion">
                                            <div class="accordion" id="accordionFAQ">
                                                <div class="accordion-item">
                                                    <h5 class="accordion-header" id="headingOne">
                                                        <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                           How can I cast my Vote?
                                                        </button>
                                                    </h5>
                                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionFAQ">
                                                        <div class="accordion-body">
                                                            <p>You need to login to your dashboard by providing your Registration Number. After login, you need to authenticate yourself, where by we will sent email or SMS to you with a verification code. After receiving the code, you need to verify yourself. You may then continue to cast your vote.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h5 class="accordion-header" id="headingTwo">
                                                        <button class="accordion-button" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                           How can I contest in an Election?
                                                        </button>
                                                    </h5>
                                                    <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionFAQ">
                                                        <div class="accordion-body">
                                                            <p>You should login as a voter to. In the menu, click on 'Become candidate' option and you will see further instruction to upgrade your account to a contestant account. You may then declare interest and  then make payment for the form.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h5 class="accordion-header" id="headingThree">
                                                        <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                            How Credible can election be using this software?
                                                        </button>
                                                    </h5>
                                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionFAQ">
                                                        <div class="accordion-body">
                                                            <p>Election conducted using this software are very fair and credible. It closed the loopholes of the traditional method. No unautherized activity can be carried out on this platform.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h5 class="accordion-header" id="headingFour">
                                                        <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                           How is my privacy protected?
                                                        </button>
                                                    </h5>
                                                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionFAQ">
                                                        <div class="accordion-body">
                                                            <p>Your votes are anonymous. Your identity is never revealed or tracked. </p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="accordion-item">
                                                    <h5 class="accordion-header" id="headingFive">
                                                        <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                           Is there Qualification Process after buying Form?
                                                        </button>
                                                    </h5>
                                                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionFAQ">
                                                        <div class="accordion-body">
                                                            <p>Yes. After buying form, candidates will have to undergo qualification process such as verbal interview. Unqualified candidates will not appear in the Ballot page. </p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="accordion-item">
                                                    <h5 class="accordion-header" id="headingSix">
                                                        <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                                           Can I cast my vote in any election?
                                                        </button>
                                                    </h5>
                                                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionFAQ">
                                                        <div class="accordion-body">
                                                            <p>No. You can only cast your vote in an elections which you are eligible to participate.</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="accordion-item">
                                                    <h5 class="accordion-header" id="headingSeven">
                                                        <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                                           How is SRA Election  Structured?
                                                        </button>
                                                    </h5>
                                                    <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionFAQ">
                                                        <div class="accordion-body">
                                                            <p>You can only see Faculty Senators contesting from your faculty. likewise for departmental senators, You can see and vote for only those from your department.</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="accordion-item">
                                                    <h5 class="accordion-header" id="headingEight">
                                                        <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                                           Is there Election Committe (ELCOM) constituted for every election?
                                                        </button>
                                                    </h5>
                                                    <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordionFAQ">
                                                        <div class="accordion-body">
                                                            <p>Yes. There can be one to few persons appointed as ELCOM for every election to help Student Affairs Division in the sales of forms and qualifying of candidates. </p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="accordion-item">
                                                    <h5 class="accordion-header" id="headingNine">
                                                        <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                                           Is this software for only SUG or includes all Elections?
                                                        </button>
                                                    </h5>
                                                    <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordionFAQ">
                                                        <div class="accordion-body">
                                                            <p>All kinds of Election in the university are expected to be conducted using this software. Faculty and Departmental Elections, State Unions and Asssociation Elections, etc.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- /.accordion -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="section-right-image animate-float-bob-y wow fadeInUp" data-wow-delay="0ms" data-wow-duration="2500ms">
                                        <img src="/front/assets/img/faq/faq-image.png" alt="faq image">
                                    </div>
                                </div>
                            </div> <!-- /.row -->
                        </div> <!-- /.section-internal -->
                    </div> <!-- /.container -->
                </section> <!-- /.faq-area -->
                <!--====== End FAQ Area ======-->



        <!--====== Start Footer Area ======-->
        <footer class="footer-area footer-area-v2 bg-ocean-blue">
            <div class="container">

            </div> <!-- /.container -->
            <div class="footer-copyright-area wow fadeInDown" data-wow-delay="0.8s">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-3 col-sm-4">
                            <div class="footer-logo">
                                <img src="/uploads/logo.png" style="width: 40px" alt="footer logo white">
                            </div>
                        </div>
                        @php
                            $data = App\Models\Settings::where('id',1)->first();
                        @endphp
                        <div class="col-md-5 col-sm-4">
                            <div class="footer-copyright">
                                <p> <i class="fa fa-phone"></i> &nbsp;{{ $data->phone }} &nbsp;&nbsp;<i class="fa fa-envelope"></i> &nbsp;{{ $data->email }}</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-8">
                            <div class="footer-copyright">
                                <p>&copy; 2021 <a href="#">BUK eVotes.</a> All Rights Reserved</p>
                            </div>
                        </div>
                    </div> <!-- /.row -->
                </div> <!-- /.container -->
            </div> <!-- /.footer-copyright-area -->
        </footer> <!-- /.footer-area -->
        <!--====== End Footer Area ======-->
        <!--======= Scroll To Top =======-->
        <a href="#" data-target="html" class="scroll-to-target scroll-to-top bg-burning-orange"><i class="fa fa-angle-up"></i></a>
        <!--====== Optional Javascript ======-->
        <script src="/front/assets/js/jquery-3.6.0.min.js"></script>
        <!--====== Popper JS ======-->
        <script src="/front/assets/js/popper.min.js"></script>
        <!--====== Bootstrap JS ======-->
        <script src="/front/assets/js/bootstrap.min.js"></script>
        <!--====== Slick Slider JS ======-->
        <script src="/front/assets/js/slick.min.js"></script>
        <!--====== Wow JS ======-->
        <script src="/front/assets/js/wow.js"></script>
        <!--====== Nice Select ======-->
        <script src="/front/assets/js/jquery.nice-select.min.js"></script>
        <!--====== Counter Up JS ======-->
        <script src="/front/assets/js/jquery.counterup.min.js"></script>
        <!--====== Magnific Popup JS ======-->
        <script src="/front/assets/js/jquery.magnific-popup.min.js"></script>
        <!--====== Waypoint JS ======-->
        <script src="/front/assets/js/jquery.waypoints.js"></script>
        <!--====== Main Script ======-->
        <script src="/front/assets/js/main.js"></script>
        <script src="/toast/jquery.min.js"></script>
        <script src="/toast/toastr.min.js"></script>
        {!! Toastr::message() !!}
    </body>
</html>
