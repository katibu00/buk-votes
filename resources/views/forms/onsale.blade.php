@extends('layouts.master')
@section('PageTitle', 'Sales of Form')
@section('css')
   <!-- BEGIN: Page CSS-->
   <link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-menu.css">
   <link rel="stylesheet" type="text/css" href="/app-assets/css/pages/page-faq.css">
   <!-- END: Page CSS-->
@endsection
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">

            <div class="content-body">

                <!-- frequently asked questions tabs pills -->
                <section id="faq-tabs">
                    <!-- vertical tab pill -->
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-12">
                            <div class="faq-navigation d-flex justify-content-between flex-column mb-2 mb-md-0">
                                <!-- pill tabs navigation -->
                                <ul class="nav nav-pills nav-left flex-column" role="tablist">

                                    @foreach ($elections as $key => $election)
                                    <!-- payment -->
                                    <li class="nav-item">
                                        <a class="nav-link @if($loop->first) active @endif" id="payment{{$key+1}}" data-bs-toggle="pill" href="#election{{$key+1}}" aria-expanded="@if($loop->first) true @else false @endif" role="tab">
                                            <i data-feather="credit-card" class="font-medium-3 me-1"></i>
                                            <span class="fw-bold">{{$election->title}}</span>
                                        </a>
                                    </li>

                                    @endforeach


                                </ul>

                                <!-- FAQ image -->
                                <img src="/app-assets/images/illustration/faq-illustrations.svg" class="img-fluid d-none d-md-block" alt="demand img" />
                            </div>
                        </div>

                        <div class="col-lg-9 col-md-8 col-sm-12">
                            <!-- pill tabs tab content -->
                            <div class="tab-content">


                                @foreach ($elections as $key => $election)
                                <!-- payment panel -->
                                @php
                                  $posts = App\Models\Forms::where('election_id',$election->id)->get()
                               @endphp
                                <div role="tabpanel" class="tab-pane  @if($loop->first) active @endif" id="election{{$key+1}}" aria-labelledby="payment{{$key+1}}" aria-expanded="@if($loop->first) true @else false @endif">
                                    <!-- icon and header -->

                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-tag bg-light-primary me-1">
                                            <i data-feather="credit-card" class="font-medium-4"></i>
                                        </div>
                                        <div>
                                            <h4 class="mb-0">{{$election->title}}</h4>
                                            {{-- <span>{{$election->start_date}} ({{$election->start_time}}) - {{$election->end_date}} ({{$election->end_time}})</span> --}}
                                        </div>
                                    </div>

                                    @foreach ($posts as $position => $post)
                                    <div class="accordion accordion-margin mt-2" id="post{{$position+1}}1">
                                        <div class="card accordion-item">
                                            <h2 class="accordion-header" id="paymentOne3{{$position+1}}">
                                                <button class="accordion-button collapsed" data-bs-toggle="collapse" role="button" data-bs-target="#post{{$position+1}}2" aria-expanded="false" aria-controls="post{{$position+1}}2">
                                                  <h5>{{$post['position']['name']}}</h5>
                                                </button>
                                            </h2>

                                            <div id="post{{$position+1}}2" class="collapse accordion-collapse" aria-labelledby="paymentOne3{{$position+1}}" data-bs-parent="#post{{$position+1}}1">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-md-5 col-6">
                                                            <p></p>
                                                            <p><strong>Election Title:</strong> {{$election->title}}</p>
                                                            <p><strong>Date:</strong>  {{\Carbon\Carbon::parse($election->start_date)->format('jS M Y')}} - {{\Carbon\Carbon::parse($election->end_date)->format('jS M Y')}}</p>
                                                            <p><strong>Time:</strong> {{\Carbon\Carbon::parse($election->start_time)->format('h:i A')}} - {{\Carbon\Carbon::parse($election->end_time)->format('h:i A')}}</p>
                                                        </div>
                                                        <div class="col-md-5 col-6">
                                                            <p><strong>Sales of Form Closes:</strong> {{\Carbon\Carbon::parse($post->end_date)->format('jS M Y')}}</p>
                                                            <p><strong>Form Price:</strong> &#x20A6;{{number_format($post->price,0)}}</p>
                                                            <p><strong>Minimum Level: </strong> {{$post->level}}00L</p>
                                                            <p><strong>Minimum CGPA: </strong> {{$post->cgpa}}</p>
                                                        </div>
                                                        <div class="col-md-2 col-12">
                                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#default{{$election->id}}{{$post->id}}">
                                                                Contest
                                                            </button>
                                                        </div>


                                                        <div class="modal fade text-start" id="default{{$election->id}}{{$post->id}}" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title" id="myModalLabel1">{{$election->title}} - {{$post['position']['name']}}</h4>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <form action="{{route('form.contest')}}" method="post">
                                                                        @csrf
                                                                    <div class="modal-body">
                                                                        <h4>Are you sure?</h4>
                                                                        <input type="hidden" value="{{$election->id}}" name="election_id">
                                                                        <input type="hidden" value="{{$post['position']['id']}}" name="post_id">
                                                                        <p>
                                                                           By clicking the Accept button you agreed to the terms and conditions governing the conduct of this election. If you are found with any form of misconduct or falsification of credentials, you will be disqualified even while in office.
                                                                           <br /><strong class="text-danger">You may contest only one post in this election.</strong>
                                                                        </p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
                                                                        <button type="submit" class="btn btn-danger">Accept</button>
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @if($election->sra == 'all')
                                    @if($loop->last)
                                    @php
                                    $sra = App\Models\SRAForm::where('election_id',$election->id)->where('type','faculty')->first();
                                    @endphp
                                    <div class="accordion accordion-margin mt-2" id="faq-payment-qna{{$election->id}}">
                                        <div class="card accordion-item">
                                            <h2 class="accordion-header" id="paymentOne">
                                                <button class="accordion-button collapsed" data-bs-toggle="collapse" role="button" data-bs-target="#faq-payment-one{{$election->id}}" aria-expanded="false" aria-controls="faculty1">
                                                  <h5>Faculty Senator</h5>
                                                </button>
                                            </h2>

                                            <div id="faq-payment-one{{$election->id}}" class="collapse accordion-collapse" aria-labelledby="paymentOne" data-bs-parent="#faq-payment-qna{{$election->id}}">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-md-5 col-6">
                                                            <p></p>
                                                            <p><strong>Election Title:</strong> {{$election->title}}</p>
                                                            <p><strong>Date:</strong>  {{\Carbon\Carbon::parse($election->start_date)->format('jS M Y')}} - {{\Carbon\Carbon::parse($election->end_date)->format('jS M Y')}}</p>
                                                            <p><strong>Time:</strong> {{\Carbon\Carbon::parse($election->start_time)->format('h:i A')}} - {{\Carbon\Carbon::parse($election->end_time)->format('h:i A')}}</p>
                                                        </div>
                                                        <div class="col-md-5 col-6">
                                                            <p><strong>Sales of Form Closes:</strong> {{\Carbon\Carbon::parse($post->end_date)->format('jS M Y')}}</p>
                                                            @if(@$sra->price)
                                                            <p><strong>Form Price:</strong> &#x20A6;{{number_format(@$sra->price,0)}}</p>
                                                            <p><strong>Minimum Level: </strong> {{@$sra->level}}00L</p>
                                                            <p><strong>Minimum CGPA: </strong> {{@$sra->cgpa}}</p>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-2 col-12">
                                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#faculty{{$election->id}}">
                                                                Contest
                                                            </button>
                                                        </div>


                                                        <div class="modal fade text-start" id="faculty{{$election->id}}" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title" id="myModalLabel1">{{$election->title}} - Faculty Senator</h4>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <form action="{{route('form.contest.sra')}}" method="post">
                                                                        @csrf
                                                                    <div class="modal-body">
                                                                        <h4>Are you sure?</h4>
                                                                        <input type="hidden" value="{{$election->id}}" name="election_id">
                                                                        <input type="hidden" value="faculty" name="type">
                                                                        <p>
                                                                           By clicking the Accept button you agreed to the terms and conditions governing the conduct of this election. If you are found with any form of misconduct or falsification of credentials, you will be disqualified even while in office.
                                                                           <br /><strong class="text-danger">You may contest only one post in this election.</strong>
                                                                        </p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
                                                                        <button type="submit" class="btn btn-danger">Accept</button>
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endif


                                    @if($election->sra == 'one' ||$election->sra == 'all')
                                    @if($loop->last)
                                    @php
                                    $sra = App\Models\SRAForm::where('election_id',$election->id)->where('type','department')->first();
                                    @endphp
                                    <div class="accordion accordion-margin mt-2" id="faq-dept-qna{{$election->id}}">
                                        <div class="card accordion-item">
                                            <h2 class="accordion-header" id="deptOne">
                                                <button class="accordion-button collapsed" data-bs-toggle="collapse" role="button" data-bs-target="#faq-dept-one{{$election->id}}" aria-expanded="false" aria-controls="faculty1">
                                                  <h5>Departmental Senator</h5>
                                                </button>
                                            </h2>

                                            <div id="faq-dept-one{{$election->id}}" class="collapse accordion-collapse" aria-labelledby="deptOne" data-bs-parent="#faq-dept-qna{{$election->id}}">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-md-5 col-6">
                                                            <p></p>
                                                            <p><strong>Election Title:</strong> {{$election->title}}</p>
                                                            <p><strong>Date:</strong>  {{\Carbon\Carbon::parse($election->start_date)->format('jS M Y')}} - {{\Carbon\Carbon::parse($election->end_date)->format('jS M Y')}}</p>
                                                            <p><strong>Time:</strong> {{\Carbon\Carbon::parse($election->start_time)->format('h:i A')}} - {{\Carbon\Carbon::parse($election->end_time)->format('h:i A')}}</p>
                                                        </div>
                                                        <div class="col-md-5 col-6">
                                                            <p><strong>Sales of Form Closes:</strong> {{\Carbon\Carbon::parse($post->end_date)->format('jS M Y')}}</p>
                                                            @if(@$sra->price)
                                                            <p><strong>Form Price:</strong> &#x20A6;{{number_format(@$sra->price,0)}}</p>
                                                            <p><strong>Minimum Level: </strong> {{@$sra->level}}00L</p>
                                                            <p><strong>Minimum CGPA: </strong> {{@$sra->cgpa}}</p>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-2 col-12">
                                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#dept{{$election->id}}">
                                                                Contest
                                                            </button>
                                                        </div>


                                                        <div class="modal fade text-start" id="dept{{$election->id}}" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title" id="myModalLabel1">{{$election->title}} - Depatmental Senator</h4>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <form action="{{route('form.contest.sra')}}" method="post">
                                                                        @csrf
                                                                    <div class="modal-body">
                                                                        <h4>Are you sure?</h4>
                                                                        <input type="hidden" value="{{$election->id}}" name="election_id">
                                                                        <input type="hidden" value="department" name="type">
                                                                        <p>
                                                                           By clicking the Accept button you agreed to the terms and conditions governing the conduct of this election. If you are found with any form of misconduct or falsification of credentials, you will be disqualified even while in office.
                                                                           <br /><strong class="text-danger">You may contest only one post in this election.</strong>
                                                                        </p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
                                                                        <button type="submit" class="btn btn-danger">Accept</button>
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endif

                                    @endforeach
                                </div>

                                @endforeach


                            </div>
                        </div>
                    </div>
                </section>
                <!-- / frequently asked questions tabs pills -->

                <!-- contact us -->
                <section class="faq-contact">
                    <div class="row mt-5 pt-75">
                        <div class="col-12 text-center">
                            <h2>You still have a question?</h2>
                            <p class="mb-3">
                                If you cannot find a question in our FAQ in the front page, you can always contact us. We will answer to you shortly!
                            </p>
                        </div>
                        @php
                            $data = App\Models\Settings::where('id',1)->first();
                        @endphp
                        <div class="col-sm-6">
                            <div class="card text-center faq-contact-card shadow-none py-1">
                                <div class="accordion-body">
                                    <div class="avatar avatar-tag bg-light-primary mb-2 mx-auto">
                                        <i data-feather="phone-call" class="font-medium-3"></i>
                                    </div>
                                    <h4>{{ $data->phone }}</h4>
                                    <span class="text-body">We are always happy to help!</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card text-center faq-contact-card shadow-none py-1">
                                <div class="accordion-body">
                                    <div class="avatar avatar-tag bg-light-primary mb-2 mx-auto">
                                        <i data-feather="mail" class="font-medium-3"></i>
                                    </div>
                                    <h4>{{ $data->email }}</h4>
                                    <span class="text-body">Best way to get answer faster!</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ contact us -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
