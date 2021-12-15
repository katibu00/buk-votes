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
                                                <a href="{{route('user.guide')}}" class="nav-link {{($route=='user.guide')?'active':''}}">User Guides</a>
                                            </li>
                                        
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
                                             <i class="fas fa-lock"></i> Sign In
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
        <!--====== Start Breadcrumb Area ======-->
        {{-- <section class="breadcrumb-area">
            <div class="container">
                <div class="section-internal">
                    <div class="section-particle-effect d-none d-md-block section-particle-effect-v3">
                        <img class="particle-1 animate-zoom-fade" src="/front/assets/img/particle/particle-1.png" alt="particle One">
                        <img class="particle-2 animate-rotate-me" src="/front/assets/img/particle/particle-2.png" alt="particle Two">
                        <img class="particle-3 animate-float-bob-x" src="/front/assets/img/particle/particle-3.png" alt="particle Three">
                        <img class="particle-4 animate-float-bob-y" src="/front/assets/img/particle/particle-4.png" alt="particle Four">
                        <img class="particle-5 animate-float-bob-y" src="/front/assets/img/particle/particle-5.png" alt="particle Five">
                    </div>
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="breadcrumb-content text-center">
                                <div class="page-title wow fadeInDown" data-wow-delay="0.1s" data-wow-duration="1500ms">
                                    <h1>Team Member</h1>
                                </div>
                                <div class="page-breadcrumb wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="1500ms">
                                    <ul class="breadcrumb">
                                        <li><a href="index.html">Home</a></li>
                                        <li class="active">Team Member</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div> <!-- /.row -->
                </div> <!-- /.section-internal -->
            </div> <!-- /.container -->
        </section> <!-- /.breadcrumb-area --> --}}
        <!--====== End Breadcrumb Area ======-->
        <!--====== Start Team Skills Area ======-->

        <!--====== End Team Skills Area ======-->
        <!--====== Start Our Team Area ======-->
        <section class="our-team-area our-team-area-v2 pt-130 pb-100" style="background-image: url(/front/assets/img/services/dots-pattern-bg.png);">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col">
                        <div class="section-title text-center mb-70">
                            <div class="section-heading-tag">
                                <span class="single-heading-tag">Official</span>
                            </div>
                            <h2>{{$election->title}} General Elecction<br class="d-none d-md-block"> List of Winners</h2>
                        </div>
                    </div> <!-- /.col-lg-8 -->
                </div> <!-- /.row -->
                <div class="team-member-content">
                    <div class="row">

                        @php
                            $posts = App\Models\Forms::where('election_id',$election->id)->get();
                        @endphp

                        @foreach ($posts as $post)


                        @php
                            $winner = App\Models\Winner::where('election_id',$election->id)->where('post_id',$post->post_id)->get();
                        @endphp

                        @if($winner->count() > 0)

                        @foreach ($winner as $win)

                        <div class="col-lg-3 col-md-6">
                            <div class="single-team-member single-team-member-v2 wow fadeInUp" data-wow-delay="00ms" data-wow-duration="1500ms">
                                <div class="team-member-thumb">
                                    <img src="/uploads/users/{{$win['user']['image']}}" alt="{{$win['user']['first_name']}}" style="width: 270px; height: 300px;">
                                </div>
                                <div class="team-member-bio">
                                    <h5 class="team-member-name">
                                        {{$win['user']['first_name']}}  {{$win['user']['middle_name']}}  {{$win['user']['last_name']}}
                                    </h5>
                                    <p class="team-member-role">
                                        {{$win['post']['name']}}
                                    </p>
                                </div>
                                <p class="text-center"> {{$win['user']['first_name']}}  {{$win['user']['middle_name']}}  {{$win['user']['last_name']}} - {{$win['post']['name']}}</p>
                            </div>
                        </div>
                        @endforeach

                        @else
                        @if($loop->last)
                        <h5 class="text-danger">Result has not been published yet.</h5>
                        @endif
                        @endif

                        @endforeach

                    </div> <!-- /.row -->
                </div> <!-- /.team-member-content -->
            </div> <!-- /.container -->
        </section> <!-- /.our-team-area -->


        <!--====== End Call to Action Area ======-->
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
    </body>
</html>
