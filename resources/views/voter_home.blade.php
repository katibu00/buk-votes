@extends('layouts.master')
@section('PageTitle', 'Voter Dashboard')
@section('content')

   <!-- BEGIN: Content-->
   <div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section class="invoice-preview-wrapper">
                <div class="row invoice-preview">
                    <!-- Invoice -->
                    <div class="col-xl-9 col-md-8 col-12">
                        <div class="card invoice-preview-card">
                            <div class="card-body invoice-padding pb-0">
                                <!-- Header starts -->
                                <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                    <div>
                                        <ul class="list-group">
                                            <li class="list-group-item active ">
                                                <span>How to cast your Vote</span>
                                            </li>
                                            <li class="list-group-item">
                                                <span>1. Click on Authenticate and a code will be sent to your email/phone</span>
                                            </li>
                                            <li class="list-group-item">
                                                <span>2. Provide the code and click on "Authenticate Now".</span>
                                            </li>
                                            <li class="list-group-item">
                                                <span>3. You may continue to vote after successfull authentication.</span>
                                            </li>
                                        </ul>
                                    </div>


                                    @php
                                    $longcheck = App\Models\VoterAuth::where('user_id',Auth::user()->id)->whereBetween('updated_at', array(Carbon\Carbon::now()->subHours(24)->toDateTimeString(), Carbon\Carbon::now()->toDateTimeString()))->latest()->first();
                                    $shortcheck = App\Models\VoterAuth::where('user_id',Auth::user()->id)->whereBetween('updated_at', array(Carbon\Carbon::now()->subMinutes(10)->toDateTimeString(), Carbon\Carbon::now()->toDateTimeString()))->latest()->first();
                                   @endphp

                                   @if($longcheck == null || $longcheck->verified != 1)
                                   {{-- @if (@$longcheck->verified == 1)

                                   @endif --}}

                                    <div class="card hadow-none bg-transparent border-danger">
                                        <div class="card-body text-center">
                                            <div class="avatar bg-light-warning p-50 mb-1">
                                                <div class="avatar-content ">
                                                    <i data-feather="x-circle" class="font-medium-5 text-danger"></i>
                                                </div>
                                            </div>
                                            <h5 class="fw-bolder text-center text-danger">Not Authenticated</h5>
                                            @php
                                            $user = App\Models\VoterAuth::where('user_id',Auth::user()->id)->first();
                                            if(@$user->verified == 1){
                                                $user->verified = false;
                                                $user->update();
                                            }

                                            @endphp
                                        </div>
                                    </div>
                                    @else

                                    <div class="card hadow-none bg-transparent border-success">
                                        <div class="card-body text-center">
                                            <div class="avatar bg-light-success p-50 mb-1">
                                                <div class="avatar-content ">
                                                    <i data-feather="check-circle" class="font-medium-5 text-success"></i>
                                                </div>
                                            </div>
                                            <h5 class="fw-bolder text-center text-success">Authenticated</h5>

                                        </div>
                                    </div>
                                    @endif

                                </div>
                                <!-- Header ends -->
                            </div>

                            <hr class="invoice-spacing" />
                            <div class="divider divider-primary" style="margin:0 20px;">
                                <div class="divider-text">Today's Elections</div>
                            </div>
                            <!-- Address and Contact starts -->
                            <div class="card-body invoice-padding pt-0 mt-2" style="margin:0 20px;">
                                <div class="row invoice-spacing">

                                    @php
                                        $today_date = date('Y-m-d');
                                        $current_time = carbon\Carbon::createFromFormat('H:i:s', date('H:i:s'));
                                        $elections = App\Models\Election::where('start_date',$today_date)->get();
                                    @endphp
                                    @if ($elections->count() > 0)

                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Election</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center">End Time</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($elections as $election)
                                            <tr>
                                                <td>{{$election->title}}</td>
                                                @php
                                                    $end_time = Carbon\Carbon::createFromFormat('H:i:s', $election->end_time);
                                                @endphp

                                                <td class="text-center">
                                                    @if($current_time->gt($end_time))
                                                    <span class="badge bg-danger">Ended</span>
                                                    @else
                                                    <span class="badge bg-success">Ongoing</span>
                                                    @endif
                                                </td>


                                                <td class="text-center">{{\Carbon\Carbon::parse($election->end_time)->format('h:i A')}}</td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>

                                        @else

                                        <span class="badge d-block bg-warning">
                                            <span class="text-center">No Ongoing Election Today</span>
                                        </span>

                                        @endif
                                    </div>


                            </div>
                            <!-- Address and Contact ends -->




                        </div>
                    </div>
                    <!-- /Invoice -->

                    <!-- Invoice Actions -->
                    <div class="col-xl-3 col-md-4 col-12 invoice-actions mt-md-0 mt-2">
                        <div class="card">
                            <div class="card-body">
                                {{-- <h5 class="text-center mb-35">Authenticate using</h5> --}}
                                <button class="btn btn-info w-100 mb-75" data-bs-toggle="modal" data-bs-target="#send-invoice-sidebar">
                                    {{-- <i data-feather="send" class="me-25"></i> --}}
                                    <span>Authenticate</span>
                                </button>

                                <a class="btn btn-secondary w-100 mb-75" href="{{route('cast.vote')}}">
                                    <span>Cast Vote</span>
                                </a>
                                @php
                                     $settings = App\Models\Settings::findorFail(1);
                                @endphp
                                   @if($settings->live == 'on')
                                <a class="btn btn-secondary w-100 mb-75" href="{{route('live.result')}}">
                                    <span>Live Result</span>
                                </a>
                                @endif

                            </div>
                        </div>

                    </div>



                    <!-- /Invoice Actions -->
                </div>
            </section>

            <!-- Send Invoice Sidebar -->
            <div class="modal modal-slide-in fade" id="send-invoice-sidebar" aria-hidden="true">
                <div class="modal-dialog sidebar-lg">
                    <div class="modal-content p-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                        <div class="modal-header mb-1">
                            <h5 class="modal-title">
                                <span class="align-middle">Authenticate Yourself</span>
                            </h5>
                        </div>
                        <div class="modal-body flex-grow-1 mb-25">

                            
                           
                         

                            @if($longcheck == null || $longcheck->verified != 1)

                            @if( $shortcheck == null)

                            <p>Select your preferred method and click on send button. A code will be send to your phone. Click on authenticate again and provide the code sent.</p><br/>

                            <form action="{{route('authenticate.send')}}" method="post">
                             @csrf
                                @php
                                    $phone = Auth::user()->phone;
                                    $email = Auth::user()->email;
                                @endphp

                                {{-- @if ($email != null)
                                <div class="mb-1">
                                    <input class="form-check-input" type="radio" name="verify" id="email" value="email" checked/>
                                    <label for="email" class="form-label">EMAIL: {{substr_replace($email,str_repeat('*',strlen($email)-5),2,-4)}}</label>
                                </div>
                                @endif --}}

                                @if ($phone != null)
                                <div class="mb-1">
                                    <input class="form-check-input" type="radio" name="verify" id="phone" value="phone" />
                                    <label for="phone" class="form-label">PHONE: {{substr_replace($phone,str_repeat('*',strlen($phone)-2),0,-2)}}</label>
                                </div>
                                @endif


                                <div class="mb-1 d-flex flex-wrap mt-2">
                                    <button type="submit" class="btn btn-primary me-1">Send</button>
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                            @elseif($shortcheck->verified != 1)

                            <p>Check your phone and enter the code sent. Sometimes the OTP may take upto 15 minutes to arrive. Never share your code with anyone.</p><br/>

                            <form action="{{route('authenticate.verify')}}" method="post">
                                @csrf

                                <div class="input-group">
                                    <input type="text" class="form-control" name="code" placeholder="######" aria-describedby="button-addon2" />
                                    <button class="btn btn-outline-primary" id="button-addon2" type="submit">Verify</button>
                                </div>

                                <div class="mb-1 d-flex flex-wrap mt-2">
                                    {{-- <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button> --}}
                                    {{-- <a href="{{route('voter.home')}}" class="btn btn-outline-warning mx-1">Refresh Page</a> --}}
                                </div>
                            </form>
                            <p>Didn't receive code? You may try again after few 10 minutes.<a href="{{route('voter.home')}}"> Click here to refresh the page</a></p>
                            @else
                            <li class=" nav-item"><a class="d-flex align-items-center" href="form-validation.html"><i data-feather="check-circle"></i><span class="menu-title text-truncate" data-i18n="Form Validation">Form Validation</span></a>

                            <h3 style="color: green">You are verified</h3>
                            @endif

                            @else

                            <h3 style="color: green">You are verified</h3>

                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Send Invoice Sidebar -->


             <!-- verify -->
             <div class="modal modal-slide-in fade" id="verify" aria-hidden="true">
                <div class="modal-dialog sidebar-lg">
                    <div class="modal-content p-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                        <div class="modal-header mb-1">
                            <h5 class="modal-title">
                                <span class="align-middle">Verify the Code</span>
                            </h5>
                        </div><br/><br/><br/>
                        <div class="modal-body flex-grow-1 mb-25">
                            <p>Check your email/phone and enter the code sent. Never share your code with anyone.</p><br/>

                            <form action="{{route('authenticate.verify')}}" method="post">
                                @csrf

                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="######" aria-describedby="button-addon2" />
                                    <button class="btn btn-outline-primary" id="button-addon2" type="submit">Verify</button>
                                </div>

                                <div class="mb-1 d-flex flex-wrap mt-2">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                    <a href="{{route('voter.home')}}" class="btn btn-outline-warning mx-1">Refresh Page</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Send Invoice Sidebar -->



        </div>
    </div>
</div>
<!-- END: Content-->

@endsection
