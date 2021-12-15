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
                                <div class="section-heading-tag">
                                    <span class="single-heading-tag">Documentaion</span>
                                </div>
                                <h2>Download <br class="d-none d-md-block">
                                    <span>Step-by-Step</span> 
                                    User Guides
                                </h2>
                            </div>
                        </div>
                    </div> <!-- /.row -->
                </div> <!-- /.service-area-internal -->
            </div> <!-- /.container -->
            <div class="service-area-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-2 col-lg-4 col-md-6">
                            <div class="single-service-box single-service-box-v2 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="service-thumbnail">
                                    <img src="/uploads/PDF_file_icon.svg" alt="Students' Guide" width="80%">
                                </div>
                                <div class="service-box-content">
                                    <h5 class="service-box-title">Students' Guide</h5>
                                    <div class="service-box-btn">
                                        <a href="{{route('download.doc.student')}}"><i class="fas fa-download"></i></a>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-6">
                            <div class="single-service-box single-service-box-v2 wow fadeInUp" data-wow-delay="0.2s">
                                <div class="service-thumbnail">
                                    <img src="/uploads/PDF_file_icon.svg" alt="Candidates Guide" width="80%">
                                </div>
                                <div class="service-box-content">
                                    <h5 class="service-box-title">Candidates' Guide</h5>
                                    <div class="service-box-btn">
                                        <a href="{{route('download.doc.candidate')}}"><i class="fas fa-download"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-6">
                            <div class="single-service-box single-service-box-v2 wow fadeInUp" data-wow-delay="0.3s">
                                <div class="service-thumbnail">
                                    <img src="/uploads/PDF_file_icon.svg" alt="ELCOMs' Guide" width="80%">
                                </div>
                                <div class="service-box-content">
                                    <h5 class="service-box-title">ELCOMs' Guide</h5>
                                    <div class="service-box-btn">
                                        <a href="{{route('download.doc.elcom')}}"><i class="fas fa-download"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                  
                        
                        
                    </div> <!-- /.row -->
                </div> <!-- /.container-fluid -->
            </div> <!-- /.service-area-content -->
        </section> <!-- /.our-services -->
        <!--====== End Our Services Area ======-->
        <!--====== Start Footer Area ======-->
        <footer class="footer-area footer-area-v2 bg-ocean-blue">
            <div class="container">

            </div> <!-- /.container -->
            <div class="footer-copyright-area wow fadeInDown" data-wow-delay="0.8s">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6 col-sm-4">
                            <div class="footer-logo">
                                <img src="/uploads/logo.png" style="width: 40px" alt="footer logo white">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-8">
                            <div class="footer-copyright">
                                <p>&copy; 2021 <a href="#">BUK Electronic Votes.</a> All Rights Reserved</p>
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
