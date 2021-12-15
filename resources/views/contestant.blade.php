@extends('layouts.master')
@section('PageTitle', 'Home')
@section('content')
  <!-- BEGIN: Content-->
  <div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">



        <section id="animated-progress">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <p class="card-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This represent the total progress made on your last declared interest.">
                                Total Progress
                            </p>
                            <div class="demo-vertical-spacing">
                                <div class="progress progress-bar-primary">
                                    <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow=" {{$check->progress}}" aria-valuemin="0" aria-valuemax="100" style="width:  {{$check->progress}}%">
                                        {{$check->progress}}%
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Animated Progress end -->

<!-- Stats Vertical Card -->
<div class="row">
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card text-center">
            <div class="card-body">
                @if($check->profile == 1)
                <div class="avatar bg-light-success p-50 mb-1">
                    <div class="avatar-content">
                        <i data-feather="check" class="font-medium-5 text-success"></i>
                    </div>
                </div>
                <p class="card-text">Profile</p>
                <h6 class="fw-bolder">Updated</h6>
                @else
                <div class="avatar bg-light-danger p-50 mb-1">
                    <div class="avatar-content">
                        <i data-feather="x-circle" class="font-medium-5 text-danger"></i>
                    </div>
                </div>
                <p class="card-text">Profile</p>
                <h6 class="fw-bolder">Not Updated</h6>
                @endif
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card text-center">
            <div class="card-body">
                @if(auth()->user()->image != 'default.png')
                <div class="avatar bg-light-success p-50 mb-1">
                    <div class="avatar-content">
                        <i data-feather="check" class="font-medium-5 text-success"></i>
                    </div>
                </div>
                <p class="card-text">Picture</p>
                <h6 class="fw-bolder">Updated</h6>
                @else
                <div class="avatar bg-light-danger p-50 mb-1">
                    <div class="avatar-content">
                        <i data-feather="x-circle" class="font-medium-5 text-danger"></i>
                    </div>
                </div>
                <p class="card-text">Picture</p>
                <h6 class="fw-bolder">Not Updated</h6>
                @endif
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card text-center">
            <div class="card-body">
                @php
                    $exco = App\Models\FormCheck::where('user_id',auth()->user()->id)->where('post_id','!=',0)->get()->count();
                    $sra = App\Models\SRACandidates::where('user_id',auth()->user()->id)->get()->count();
                @endphp
                @if($exco+$sra > 0)
                <div class="avatar bg-light-success p-50 mb-1">
                    <div class="avatar-content">
                        <i data-feather="check" class="font-medium-5 text-success"></i>
                    </div>
                </div>
                <p class="card-text">Interest</p>
                <h6 class="fw-bolder">{{$exco+$sra}} Declared</h6>
                @else
                <div class="avatar bg-light-danger p-50 mb-1">
                    <div class="avatar-content">
                        <i data-feather="x-circle" class="font-medium-5 text-danger"></i>
                    </div>
                </div>
                <p class="card-text">Interest</p>
                <h6 class="fw-bolder">Not Declared</h6>
                @endif
            </div>
        </div>
    </div>
    @php
    $exco = App\Models\FormCheck::where('user_id',auth()->user()->id)->where('payment',1)->get()->count();
    $sra = App\Models\SRACandidates::where('user_id',auth()->user()->id)->where('payment',1)->get()->count();
    @endphp
     @if($exco+$sra > 0)
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card text-center">
            <div class="card-body">
                <div class="avatar bg-light-success p-50 mb-1">
                    <div class="avatar-content">
                        <i data-feather="check" class="font-medium-5 text-success"></i>
                    </div>
                </div>
                <p class="card-text">Forms</p>
                <h6 class="fw-bolder">{{$exco+$sra}} Paid</h6>
            </div>
        </div>
    </div>
    @else
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card text-center">
            <div class="card-body">
                <div class="avatar bg-light-danger p-50 mb-1">
                    <div class="avatar-content">
                        <i data-feather="x-circle" class="font-medium-5 text-danger"></i>
                    </div>
                </div>
                <p class="card-text">Forms</p>
                <h6 class="fw-bolder">0 Paid</h6>
            </div>
        </div>
    </div>
    @endif
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card text-center">
            <div class="card-body">
                <div class="avatar bg-light-danger p-50 mb-1">
                    <div class="avatar-content">
                        <i data-feather="x-circle" class="font-medium-5 text-danger"></i>
                    </div>
                </div>
                <p class="card-text">HOD Consent</p>
                <h6 class="fw-bolder">0 uploaded</h6>
            </div>
        </div>
    </div>
    @php
    $exco = App\Models\FormCheck::where('user_id',auth()->user()->id)->where('qualify',1)->get()->count();
    $sra = App\Models\SRACandidates::where('user_id',auth()->user()->id)->where('qualify',1)->get()->count();
    @endphp
     @if($exco+$sra > 0)
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card text-center">
            <div class="card-body">
                <div class="avatar bg-light-success p-50 mb-1">
                    <div class="avatar-content">
                        <i data-feather="x-circle" class="font-medium-5 text-success"></i>
                    </div>
                </div>
                <p class="card-text">Qualified</p>
                <h6 class="fw-bolder">{{$exco+$sra}} Qualified</h6>
            </div>
        </div>
    </div>
    @else
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card text-center">
            <div class="card-body">
                <div class="avatar bg-light-danger p-50 mb-1">
                    <div class="avatar-content">
                        <i data-feather="x-circle" class="font-medium-5 text-danger"></i>
                    </div>
                </div>
                <p class="card-text">Qualifed</p>
                <h6 class="fw-bolder">0 Qualified</h6>
            </div>
        </div>
    </div>
    @endif
</div>
</div>
</div>
<!-- END: Content-->
<!--/ Stats Vertical Card -->
@endsection
