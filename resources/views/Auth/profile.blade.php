@extends('layouts.master')
@section('PageTitle', 'Profile')
@section('content')
   <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">

            <div class="content-body">
                <!-- account setting page -->
                <section id="page-account-settings">
                    <div class="row">
                        <!-- left menu section -->
                        <div class="col-md-3 mb-2 mb-md-0">
                            <ul class="nav nav-pills flex-column nav-left">

                                @if (auth()->user()->role == 'voter')
                                   <!-- Instructions -->
                                   <li class="nav-item">
                                    <a class="nav-link {{auth()->user()->role == 'voter'? 'active': ''}}" id="account-pill-instructions" data-bs-toggle="pill" href="#instructions" aria-expanded="{{auth()->user()->role == 'voter'? 'true': 'false'}}">
                                        <i data-feather='alert-circle'></i>
                                        <span class="fw-bold">Instructions</span>
                                    </a>
                                </li>
                                @endif
                                <!-- general -->
                                <li class="nav-item">
                                    <a class="nav-link {{auth()->user()->role == 'candidate'? 'active': ''}}" id="account-pill-general" data-bs-toggle="pill" href="#account-vertical-general" aria-expanded="{{auth()->user()->role == 'candidate'? 'true': 'false'}}">
                                        <i data-feather="user" class="font-medium-3 me-1"></i>
                                        <span class="fw-bold">Account Settings</span>
                                    </a>
                                </li>

                                @if (auth()->user()->role == 'candidate')
                                <!-- change password -->
                                <li class="nav-item">
                                    <a class="nav-link" id="account-pill-password" data-bs-toggle="pill" href="#account-vertical-password" aria-expanded="false">
                                        <i data-feather="lock" class="font-medium-3 me-1"></i>
                                        <span class="fw-bold">Change Password</span>
                                    </a>
                                </li>
                                @endif

                            </ul>
                        </div>
                        <!--/ left menu section -->

                        <!-- right content section -->
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-body">
                                    <div class="tab-content">

                                        @if (auth()->user()->role == 'voter')

                                         <!-- Instructions -->
                                         <div class="tab-pane {{auth()->user()->role == 'voter'? 'active': ''}}" id="instructions" role="tabpanel" aria-labelledby="account-pill-instructions" aria-expanded="{{auth()->user()->role == 'voter'? 'true': 'false'}}">
                                            <!-- form -->
                                            <div class="col-lg-12 col-md-12">

                                                        {{-- <h4 class="card-title">How to Contest in an Election</h4> --}}
                                                    </div>
                                                    <div class="card-body">
                                                        {{-- <p class="card-text">
                                                            Use anchors to create actionable list group items with hover, disabled, and active states by adding
                                                            <code>.list-group-item-action</code>. This separate class contains a few overrides to add compatibility for
                                                            <code>&lt;a&gt;</code> as well as the hover and focus states.
                                                        </p> --}}
                                                        <div class="list-group">
                                                            <a href="#" class="list-group-item list-group-item-action active">How to Become a Candidate? </a>
                                                            <a href="#" class="list-group-item list-group-item-action">1. Click on the Account Settings on the left side</a>
                                                            <a href="#" class="list-group-item list-group-item-action">2. Update your Profile by providng the required informations</a>
                                                            <a href="#" class="list-group-item list-group-item-action">3. Additional security is required by creating password</a>
                                                            <a href="#" class="list-group-item list-group-item-action">4. You may only login using the "Candidate Login" page.</a>
                                                            <a href="#" class="list-group-item list-group-item-action">6. You should upload a good passport photograph preferably on a white background and square in size as it will be displayed on the electronic Ballot.</a>
                                                            <a href="#" class="list-group-item list-group-item-action">8. All other conditions governing the University Election is held valid and you agreed.</a>
                                                        </div>

                                            </div>
                                            <!--/ form -->
                                        </div>
                                        <!--/ Instruction -->
                                        @endif

                                        <!-- general tab -->
                                        <div role="tabpanel" class="tab-pane {{auth()->user()->role == 'candidate'? 'active': ''}}" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="{{auth()->user()->role == 'candidate'? 'true': 'false'}}">
                                            <!-- header section -->
                                            <div class="d-flex">
                                                <a href="#" class="me-25">
                                                    <img src="/uploads/users/{{auth()->user()->image}}" id="account-upload-img" class="rounded me-50" alt="profile image" height="80" width="80" />
                                                </a>
                                                <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                <!-- upload and reset button -->
                                                <div class="mt-75 ms-1">
                                                    <label for="account-upload" class="btn btn-sm btn-primary mb-75 me-75">Choose File</label>
                                                    <input type="file" id="account-upload" name="image" hidden accept="image/*" />
                                                    <p>Allowed JPG, GIF or PNG. (Should be square in size and clearly shows your face).</p>
                                                </div>
                                                <!--/ upload and reset button -->
                                            </div>
                                            <!--/ header section -->

                                            <!-- form -->
                                                <div class="row">
                                                    <div class="col-12 col-sm-4">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="account-username">First Name</label>
                                                            <input type="text" class="form-control" name="first_name" placeholder="First Name" value="{{@$user->first_name}}" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-4">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="name">Middle Name</label>
                                                            <input type="text" class="form-control" id="name" name="middle_name" placeholder="Middle Name" value="{{@$user->middle_name}}"/>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-4">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="account-name">Last Name</label>
                                                            <input type="text" class="form-control"name="last_name" placeholder="Last Name" value="{{@$user->last_name}}" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-4">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="account-name">Nickname</label>
                                                            <input type="text" class="form-control"  name="nickname" placeholder="Nickname" value="{{@$user->nickname}}" required/>
                                                        </div>
                                                    </div>
                                               

                                                    <div class="col-12 col-sm-4">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="account-company">Faculty</label>
                                                            <select name="faculty_id" id="faculty" class="form-control" required>
                                                                <option value=""></option>
                                                                @foreach ($faculties as $faculty)
                                                                <option value="{{$faculty->id}}" @if(@$user->faculty_id == $faculty->id) selected @endif>{{$faculty->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-4">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="account-company">Department</label>
                                                            <select name="department_id" id="department" class="form-control" required>

                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-6">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="account-company">Current CGPA</label>
                                                            <input type="number" step="0.01" class="form-control"  name="cgpa" placeholder="Current CGPA" value="{{@$user->cgpa}}" required/>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-6">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="account-company">Level</label>
                                                            <select name="level" class="form-control" required>
                                                                <option value=""></option>
                                                                <option value="1"  @if(@$user->level == '1') selected @endif>100L</option>
                                                                <option value="2"  @if(@$user->level == '2') selected @endif>200L</option>
                                                                <option value="3"  @if(@$user->level == '3') selected @endif>300L</option>
                                                                <option value="4"  @if(@$user->level == '4') selected @endif>400L</option>
                                                                <option value="5"  @if(@$user->level == '5') selected @endif>500L</option>
                                                                <option value="6"  @if(@$user->level == '6') selected @endif>600L</option>
                                                            </select>
                                                       </div>
                                                    </div>

                                                  
                                                    @if (auth()->user()->role == 'voter')
                                                    <div class="col-12 col-sm-6">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="account-company">Password</label>
                                                            <input type="password" class="form-control"  name="password" placeholder="******" required/>
                                                        </div>
                                                        @error('password')
                                                          <div class="text-danger mt-2 text-sm">{{$message}}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="col-12 col-sm-6">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="account-company">Confirm Password</label>
                                                            <input type="password" class="form-control"  name="confirm" placeholder="******" required/>
                                                        </div>
                                                        @error('confirm')
                                                        <div class="text-danger mt-2 text-sm">{{$message}}</div>
                                                       @enderror
                                                    </div>
                                                   @endif
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-primary mt-2 me-1"> {{auth()->user()->role == 'voter'? 'Become a Candidate': 'Save changes'}}</button>
                                                        <button type="reset" class="btn btn-outline-secondary mt-2">Cancel</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <!--/ form -->
                                        </div>
                                        <!--/ general tab -->

                                        <!-- change password -->
                                        <div class="tab-pane fade" id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                            <!-- form -->
                                            <form class="validate-form">
                                                <div class="row">
                                                    <div class="col-12 col-sm-6">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="account-old-password">Old Password</label>
                                                            <div class="input-group form-password-toggle input-group-merge">
                                                                <input type="password" class="form-control" id="account-old-password" name="password" placeholder="Old Password" />
                                                                <div class="input-group-text cursor-pointer">
                                                                    <i data-feather="eye"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-sm-6">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="account-new-password">New Password</label>
                                                            <div class="input-group form-password-toggle input-group-merge">
                                                                <input type="password" id="account-new-password" name="new-password" class="form-control" placeholder="New Password" />
                                                                <div class="input-group-text cursor-pointer">
                                                                    <i data-feather="eye"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="account-retype-new-password">Retype New Password</label>
                                                            <div class="input-group form-password-toggle input-group-merge">
                                                                <input type="password" class="form-control" id="account-retype-new-password" name="confirm-new-password" placeholder="New Password" />
                                                                <div class="input-group-text cursor-pointer"><i data-feather="eye"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-primary me-1 mt-1">Save changes</button>
                                                        <button type="reset" class="btn btn-outline-secondary mt-1">Cancel</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <!--/ form -->
                                        </div>
                                        <!--/ change password -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ right content section -->
                    </div>
                </section>
                <!-- / account setting page -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section('js')


{{-- Dependent Dropdown --}}
<script type="text/javascript">
    $(function() {
        $(document).on('change', '#faculty', function() {

            var faculty = $('#faculty').val();

            if(faculty == ''){
                    alert('All Fields are Required');
                    return;
                }

            $.ajax({
                type: 'GET',
                url: '{{ route('get-departments') }}',
                data: {
                    'faculty': faculty
                },
                success: function(data) {
                    var html = '<option value="">Select Department</option>';
                    $.each(data, function(key, v) {
                        html += '<option value="' + v.department.id + '">' + v.department.name  + '</option>';
                    });
                    html = $('#department').html(html);
                }
            });

        });

    });
</script>
<script src="/app-assets/js/scripts/pages/page-account-settings.js"></script>
<script src="/lga/lga2.min.js"></script>
@endsection

