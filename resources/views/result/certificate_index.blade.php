
    @extends('layouts.master')
    @section('PageTitle', 'Certificate of Return')

    @section('content')
        <!-- BEGIN: Content-->
        <div class="app-content content ">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-wrapper container-xxl p-0">

                <div class="content-body">
                    <div class="row">
                        @if($wins->count()  > 0)
                        @foreach($wins as $win)
                        <!-- Congratulations Card -->
                        <div class="col-12 col-md-6 col-lg-6">
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
                                        <h1 class="mb-1 text-white">Congratulations, {{Auth::user()->nickname}}</h1>
                                        <p class="card-text m-auto w-100">
                                            You won the post of <strong>{{$win['post']['name']}}</strong> in {{$win['election']['title']}} Election
                                        </p>
                                        <a href="{{route('certificate.download')}}" target="_blank" class="btn btn-warning mt-1">Downlaod Certificate of Return</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Congratulations Card -->
                        @endforeach
                        @else
                            <!-- pricing free trial -->
                            <div class="pricing-free-trial">
                                <div class="row">
                                    <div class="col-12 col-lg-10 col-lg-offset-3 mx-auto">
                                        <div class="pricing-trial-content d-flex justify-content-between">
                                            <div class="text-center text-md-start mt-3">
                                                <h3 class="text-primary">No Certificate Issued you Yet.</h3>
                                                <h5>Please note that Certificate of return is issued to only successful candidates.</h5>

                                            </div>

                                            <!-- image -->
                                            <img src="/app-assets/images/illustration/pricing-Illustration.svg" class="pricing-trial-img img-fluid" alt="svg img" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/ pricing free trial -->
                        @endif

                    </div>
                </div>
            </div>
        </div>
        <!-- END: Content-->
    @endsection
