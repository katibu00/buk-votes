@php
$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();
$settings = App\Models\Settings::findorFail(1);
@endphp

    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item me-auto"><a class="navbar-brand" @if(auth()->user()->role == 'candidate') href="{{route('candidate.home')}}" @elseif(auth()->user()->role == 'sa') href="{{route('admin.home')}}" @endif><span class="brand-logo">
                    <img src="/uploads/logo.png" style="width: 30px; height: 30px;">  </span>
                        <h2 class="brand-text">BUK VOTES</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

                @if(auth()->user()->role == 'sa')

                <li class="{{($route=='admin.home')?'active':''}} nav-item"><a class="d-flex align-items-center" href="{{route('admin.home')}}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Chat">Home</span></a>
                </li>

                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='grid'></i><span class="menu-title text-truncate" data-i18n="Card">Elections</span></a>
                    <ul class="menu-content">
                        <li class="{{($route=='election.index')?'active':''}} {{($route=='election.edit')?'active':''}} {{($route=='election.create')?'active':''}}"><a class="d-flex align-items-center" href="{{route('election.index')}}"><i data-feather="disc"></i><span class="menu-item text-truncate" data-i18n="Basic">Elections</span></a></li>
                        <li class="{{($route=='election.form')?'active':''}}"><a class="d-flex align-items-center" href="{{route('election.form')}}"><i data-feather="disc"></i><span class="menu-item text-truncate" data-i18n="Basic">Request Form</span></a></li>
                    </ul>
                </li>

                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='user-check'></i><span class="menu-title text-truncate" data-i18n="Card">ELCOM</span></a>
                    <ul class="menu-content">
                        <li class="{{($route=='electcom.index')?'active':''}}"><a class="d-flex align-items-center" href="{{route('electcom.index')}}"><i data-feather="disc"></i><span class="menu-item text-truncate" data-i18n="Basic">Committees</span></a></li>
                    </ul>
                </li>



                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="copy"></i><span class="menu-title text-truncate" data-i18n="Card">Forms</span></a>
                    <ul class="menu-content">
                        <li class="{{($route=='generate.form.index')?'active':''}} {{($route=='forms.index')?'active':''}}  {{($route=='form.edit.sra')?'active':''}} {{($route=='form.edit.exco')?'active':''}} {{($route=='generate.form.sra.index')?'active':''}}"><a class="d-flex align-items-center" href="{{route('forms.index')}}"><i data-feather="disc"></i><span class="menu-item text-truncate" data-i18n="Basic">Generate</span></a></li>
                        <li class="{{($route=='sales.index')?'active':''}} {{($route=='sales.search')?'active':''}}" ><a class="d-flex align-items-center" href="{{route('sales.index')}}"><i data-feather="disc"></i><span class="menu-item text-truncate" data-i18n="Basic">Sales</span></a></li>
                    </ul>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='calendar'></i><span class="menu-title text-truncate" data-i18n="Card">Timetable</span></a>
                    <ul class="menu-content">
                        <li class="{{($route=='timetable.backend')?'active':''}} "><a class="d-flex align-items-center" href="{{route('timetable.backend')}}"><i data-feather="disc"></i><span class="menu-item text-truncate" data-i18n="Basic">Timetable</span></a></li>
                    </ul>
                </li>

                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='trending-up'></i><span class="menu-title text-truncate" data-i18n="Card">Return</span></a>
                    <ul class="menu-content">
                        <li class="{{($route=='return.exco')?'active':''}} {{($route=='return.exco.search')?'active':''}}"><a class="d-flex align-items-center" href="{{route('return.exco')}}"><i data-feather="disc"></i><span class="menu-item text-truncate" data-i18n="Basic">Exco</span></a></li>
                        <li class="{{($route=='return.sra')?'active':''}} {{($route=='return.sra.search')?'active':''}}"><a class="d-flex align-items-center" href="{{route('return.sra')}}"><i data-feather="disc"></i><span class="menu-item text-truncate" data-i18n="Basic">SRA</span></a></li>
                    </ul>
                </li>

                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='watch'></i><span class="menu-title text-truncate" data-i18n="Card">Live Result</span></a>
                    <ul class="menu-content">
                        <li class="{{($route=='live.result')?'active':''}} {{($route=='live.result.search')?'active':''}}"><a class="d-flex align-items-center" href="{{route('live.result')}}"><i data-feather="disc"></i><span class="menu-item text-truncate" data-i18n="Basic">Exco</span></a></li>
                        <li class="{{($route=='live.result.sra')?'active':''}} {{($route=='live.result.search.sra')?'active':''}}"><a class="d-flex align-items-center" href="{{route('live.result.sra')}}"><i data-feather="disc"></i><span class="menu-item text-truncate" data-i18n="Basic">SRA</span></a></li>
                    </ul>
                </li>


                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="clipboard"></i><span class="menu-title text-truncate" data-i18n="Card">Reports</span></a>
                    <ul class="menu-content">
                        <li class="{{($route=='report.sales')?'active':''}} "><a class="d-flex align-items-center" href="{{route('report.sales')}}"><i data-feather="disc"></i><span class="menu-item text-truncate" data-i18n="Basic">Sales Report</span></a></li>

                    </ul>
                </li>

                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='users'></i><span class="menu-title text-truncate" data-i18n="Card">Users</span></a>
                    <ul class="menu-content">
                        <li class="{{($route=='users.index')?'active':''}} "><a class="d-flex align-items-center" href="{{route('users.index')}}"><i data-feather="disc"></i><span class="menu-item text-truncate" data-i18n="Basic">Students</span></a></li>
                        <li class="{{($route=='users.candidate.index')?'active':''}} "><a class="d-flex align-items-center" href="{{route('users.candidate.index')}}"><i data-feather="disc"></i><span class="menu-item text-truncate" data-i18n="Basic">Candidates</span></a></li>
                        <li class="{{($route=='users.sa.index')?'active':''}} {{($route=='register')?'active':''}}"><a class="d-flex align-items-center" href="{{route('users.sa.index')}}"><i data-feather="disc"></i><span class="menu-item text-truncate" data-i18n="Basic">Student Affairs</span></a></li>
                    </ul>
                </li>

                @php
                    $messages = App\Models\Message::all()->count();
                @endphp

                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='box'></i><span class="menu-title text-truncate" data-i18n="Card">Suggestion Box</span> @if($messages != 0)<span class="badge badge-light-info rounded-pill ms-auto me-2">{{$messages}}</span> @endif</a>
                    <ul class="menu-content">
                        <li class="{{($route=='message.index')?'active':''}}"><a class="d-flex align-items-center" href="{{route('message.index')}}"><i data-feather="disc"></i><span class="menu-item text-truncate" data-i18n="Basic">View All</span></a></li>
                    </ul>
                </li>

                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='tool'></i><span class="menu-title text-truncate" data-i18n="Card">Settings</span></a>
                    <ul class="menu-content">
                        <li class="{{($route=='preference.index')?'active':''}}"><a class="d-flex align-items-center" href="{{route('preference.index')}}"><i data-feather="disc"></i><span class="menu-item text-truncate" data-i18n="Basic">Preferences</span></a></li>
                        <li class="{{($route=='faculty.index')?'active':''}} {{($route=='faculty.edit')?'active':''}} {{($route=='faculty.create')?'active':''}}"><a class="d-flex align-items-center" href="{{route('faculty.index')}}"><i data-feather="disc"></i><span class="menu-item text-truncate" data-i18n="Basic">Facultys</span></a></li>
                        <li class="{{($route=='department.index')?'active':''}} {{($route=='department.edit')?'active':''}} {{($route=='department.create')?'active':''}}"><a class="d-flex align-items-center" href="{{route('department.index')}}"><i data-feather="disc"></i><span class="menu-item text-truncate" data-i18n="Basic">Departments</span></a></li>

                        <li class="{{($route=='assign.department')?'active':''}} {{($route=='assign.index')?'active':''}}"><a class="d-flex align-items-center" href="{{route('assign.index')}}"><i data-feather="disc"></i><span class="menu-item text-truncate" data-i18n="Basic">Assign Departments</span></a></li>

                            <li class="{{($route=='elcom.index')?'active':''}} {{($route=='elcom.edit')?'active':''}} {{($route=='elcom.create')?'active':''}}"><a class="d-flex align-items-center" href="{{route('elcom.index')}}"><i data-feather="disc"></i><span class="menu-item text-truncate" data-i18n="Basic">Electoral Committees</span></a></li>
                            <li class="{{($route=='posts.index')?'active':''}} {{($route=='posts.edit')?'active':''}} {{($route=='posts.create')?'active':''}}"><a class="d-flex align-items-center" href="{{route('posts.index')}}"><i data-feather="disc"></i><span class="menu-item text-truncate" data-i18n="Basic">Posts</span></a></li>
                            {{-- <li class="{{($route=='clubs.index')?'active':''}} {{($route=='clubs.edit')?'active':''}} {{($route=='clubs.create')?'active':''}}"><a class="d-flex align-items-center" href="{{route('clubs.index')}}"><i data-feather="disc"></i><span class="menu-item text-truncate" data-i18n="Basic">Clubs</span></a></li>
                            <li class="{{($route=='associations.index')?'active':''}} {{($route=='associations.edit')?'active':''}} {{($route=='associations.create')?'active':''}}"><a class="d-flex align-items-center" href="{{route('associations.index')}}"><i data-feather="disc"></i><span class="menu-item text-truncate" data-i18n="Basic">State Associations</span></a></li> --}}

                    </ul>
                </li>
                @endif


                {{-- ELCOM MENU --}}

                @if(auth()->user()->role == 'elcom')

                <li class="{{($route=='elcom.home')?'active':''}}" ><a class="d-flex align-items-center" href="{{route('elcom.home')}}"><i data-feather="home"></i><span class="menu-item text-truncate" data-i18n="Basic">Home</span></a></li>
                <li class="{{($route=='sales.index')?'active':''}} {{($route=='sales.search')?'active':''}}" ><a class="d-flex align-items-center" href="{{route('sales.index')}}"><i data-feather="trending-up"></i><span class="menu-item text-truncate" data-i18n="Basic">Sales of Forms</span></a></li>
                <li class="{{($route=='report.sales')?'active':''}} "><a class="d-flex align-items-center" href="{{route('report.sales')}}"><i data-feather="clipboard"></i><span class="menu-item text-truncate" data-i18n="Basic">Sales Report</span></a></li>
                <li class="{{($route=='timetable.backend')?'active':''}} "><a class="d-flex align-items-center" href="{{route('timetable.backend')}}"><i data-feather="calendar"></i><span class="menu-item text-truncate" data-i18n="Basic">Timetable</span></a></li>


                @endif

                {{-- CANDIDATE MENU --}}
                @if(auth()->user()->role == 'candidate')

                <li class="{{($route=='candidate.home')?'active':''}} "><a class="d-flex align-items-center" href="{{route('candidate.home')}}"><i data-feather="home"></i><span class="menu-item text-truncate" data-i18n="Basic">Home</span></a></li>
                <li class="{{($route=='timetable.backend')?'active':''}} "><a class="d-flex align-items-center" href="{{route('timetable.backend')}}"><i data-feather="calendar"></i><span class="menu-item text-truncate" data-i18n="Basic">Timetable</span></a></li>
                <li class="{{($route=='onsale.index')?'active':''}} "><a class="d-flex align-items-center" href="{{route('onsale.index')}}"><i data-feather="user-plus"></i><span class="menu-item text-truncate" data-i18n="Basic">Declare Interest</span></a></li>
                <li class="{{($route=='deposit.slip')?'active':''}} "><a class="d-flex align-items-center" href="{{route('deposit.slip')}}"><i data-feather="dollar-sign"></i><span class="menu-item text-truncate" data-i18n="Basic">Deposit Slip</span></a></li>
                <li class="{{($route=='interests.index')?'active':''}} "><a class="d-flex align-items-center" href="{{route('interests.index')}}"><i data-feather="users"></i><span class="menu-item text-truncate" data-i18n="Basic">My Interests</span></a></li>
                <li class="{{($route=='cast.vote')?'active':''}} {{($route=='vote.search')?'active':''}}"><a class="d-flex align-items-center" href="{{route('cast.vote')}}"><i data-feather='edit'></i><span class="menu-item text-truncate" data-i18n="Basic">Cast Vote</span></a></li>
                @if($settings->live == 'on')
                <li class="{{($route=='live.result')?'active':''}} {{($route=='live.result.search')?'active':''}}"><a class="d-flex align-items-center" href="{{route('live.result')}}"><i data-feather='trending-up'></i><span class="menu-item text-truncate" data-i18n="Basic">Live Result</span></a></li>
                @endif
                <li class="{{($route=='certificate.return')?'active':''}} "><a class="d-flex align-items-center" href="{{route('certificate.return')}}"><i data-feather='file-text'></i><span class="menu-item text-truncate" data-i18n="Basic">Certificate of Return</span></a></li>
                @endif

                @if(auth()->user()->role == 'voter')

                <li class="{{($route=='voter.home')?'active':''}} "><a class="d-flex align-items-center" href="{{route('voter.home')}}"><i data-feather="home"></i><span class="menu-item text-truncate" data-i18n="Basic">Home</span></a></li>
                <li class=""><a class="d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#send-invoice-sidebar"><i data-feather="lock"></i><span class="menu-item text-truncate" data-i18n="Basic">Authenticate</span></a></li>
                <li class="{{($route=='cast.vote')?'active':''}}  {{($route=='vote.search')?'active':''}}"><a class="d-flex align-items-center" href="{{route('cast.vote')}}"><i data-feather='edit'></i><span class="menu-item text-truncate" data-i18n="Basic">Cast Vote</span></a></li>
                @if($settings->live == 'on')
                <li class="{{($route=='live.result')?'active':''}} "><a class="d-flex align-items-center" href="{{route('live.result')}}"><i data-feather='trending-up'></i><span class="menu-item text-truncate" data-i18n="Basic">Live Result</span></a></li>
                @endif
                <li class="{{($route=='profile')?'active':''}} "><a class="d-flex align-items-center" href="{{route('profile')}}"><i data-feather='user'></i><span class="menu-item text-truncate" data-i18n="Basic">Become Candidate</span></a></li>

                @endif

            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->

