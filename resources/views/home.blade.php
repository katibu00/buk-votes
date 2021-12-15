  @extends('layouts.master')
  @section('PageTitle', 'Home')
  @section('content')
   <!-- BEGIN: Content-->
   <div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- Dashboard Analytics Start -->
            <section id="dashboard-analytics">
                <div class="row match-height">
                    <!-- Greetings Card starts -->
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="card card-congratulations">
                            <div class="card-body text-center">
                                <img src="/app-assets/images/elements/decore-left.png" class="congratulations-img-left" alt="card-img-left" />
                                <img src="/app-assets/images/elements/decore-right.png" class="congratulations-img-right" alt="card-img-right" />
                                <div class="avatar avatar-xl bg-primary shadow">
                                    <div class="avatar-content">
                                        <i data-feather="award" class="font-large-1"></i>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <h1 class="mb-1 text-white">&#x20A6;{{number_format($sum + $sum2,0)}}</h1>
                                    <p class="card-text m-auto w-75">
                                       Forms Sold
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Greetings Card ends -->

                    <!-- Subscribers Chart Card starts -->
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header flex-column align-items-start pb-0">
                                <div class="avatar bg-light-primary p-50 m-0">
                                    <div class="avatar-content">
                                        <i data-feather="users" class="font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="fw-bolder mt-1">{{number_format($interests + $interest_sra,0)}}</h2>
                                <p class="card-text">Interests Declared</p>
                            </div>
                            <div id="gained-chart"></div>
                        </div>
                    </div>
                    <!-- Subscribers Chart Card ends -->

                    <!-- Orders Chart Card starts -->
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header flex-column align-items-start pb-0">
                                <div class="avatar bg-light-warning p-50 m-0">
                                    <div class="avatar-content">
                                        <i data-feather="package" class="font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="fw-bolder mt-1">{{number_format($paid + $paid_sra,0)}}</h2>
                                <p class="card-text">Forms paid</p>
                            </div>
                            <div id="order-chart"></div>
                        </div>
                    </div>
                    <!-- Orders Chart Card ends -->
                </div>

               {{-- my ow --}}
                <!-- Dashboard Ecommerce Starts -->
                <section id="dashboard-ecommerce">
                    <div class="row match-height">
                        <!-- Medal Card -->
                        <div class="col-xl-4 col-md-6 col-12">
                            <div class="card card-congratulation-medal">
                                <div class="card-body">
                                    <h4 class="card-title">Today's Election</h4>
                                    @php
                                        $today_date = date('Y-m-d');
                                        $current_time = carbon\Carbon::createFromFormat('H:i:s', date('H:i:s'));
                                        $elections = App\Models\Election::where('start_date',$today_date)->get();
                                    @endphp
                                    @if ($elections->count() > 0)
                                    <p class="card-text font-small-3">{{$elections->count()}} Election ongoing</p>
                                    <h4 class="mb-75 mt-2 pt-50">
                                        @php
                                            $init = 0;
                                            foreach ($elections as $election){
                                                $count = App\Models\Cast::where('election_id',$election->id)->get()->groupBy('user_id')->count();
                                                $init += $count;
                                            }
                                          
                                        @endphp
                                      
                                        <a href="#">{{$init}} Votes Casted</a>
                                    </h4>
                                    <a href="{{route('live.result')}}" class="btn btn-info">Open Live Result</a>
                                    <img src="/app-assets/images/illustration/badge.svg" class="congratulation-medal" alt="Medal Pic" />
                                    @else
                                    <p class="card-text font-small-3">No Election ongoing Today</p>
                                    <h3 class="mb-75 mt-2 pt-50">
                                        {{-- <a href="#">654,000</a> --}}
                                    </h3>
                                    <img src="/app-assets/images/illustration/badge.svg" class="congratulation-medal" alt="Medal Pic" />

                                    @endif
                                   
                                </div>
                            </div>
                        </div>
                        <!--/ Medal Card -->

                        <!-- Statistics Card -->
                        <div class="col-xl-8 col-md-6 col-12">
                            <div class="card card-statistics">
                                <div class="card-header">
                                    <h4 class="card-title">Statistics</h4>
                                    <div class="d-flex align-items-center">
                                        <p class="card-text font-small-2 me-25 mb-0"></p>
                                    </div>
                                </div>
                                <div class="card-body statistics-body">
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                            <div class="d-flex flex-row">
                                                <div class="avatar bg-light-primary me-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="users" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="my-auto">
                                                    <h4 class="fw-bolder mb-0">{{number_format($voters,0)}}</h4>
                                                    <p class="card-text font-small-3 mb-0">Voters</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                            <div class="d-flex flex-row">
                                                <div class="avatar bg-light-info me-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="user" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="my-auto">
                                                    <h4 class="fw-bolder mb-0">{{number_format($candidates,0)}}</h4>
                                                    <p class="card-text font-small-3 mb-0">Candidates</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                            <div class="d-flex flex-row">
                                                <div class="avatar bg-light-danger me-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="box" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="my-auto">
                                                    <h4 class="fw-bolder mb-0">{{number_format($elcoms,0)}}</h4>
                                                    <p class="card-text font-small-3 mb-0">ELCOMs</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-12">
                                            <div class="d-flex flex-row">
                                                <div class="avatar bg-light-success me-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="tool" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="my-auto">
                                                    <h4 class="fw-bolder mb-0">{{number_format($sa,0)}}</h4>
                                                    <p class="card-text font-small-3 mb-0">Admins </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Statistics Card -->
                    </div>
                </section>
               {{-- my ow --}}
            </section>
            <!-- Dashboard Analytics end -->

        </div>
    </div>
</div>
<!-- END: Content-->

@endsection
@section('js')
<script src="/app-assets/js/scripts/pages/dashboard-analytics.js"></script>
@endsection
