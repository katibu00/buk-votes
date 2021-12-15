@extends('layouts.master')
@section('PageTitle', 'Create New Election')
@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">

            <div class="content-body">
                <!-- Basic Horizontal form layout section start -->
                <section id="basic-horizontal-layouts">
                    <div class="row">
                        <div class="col-md-12 col-12 mx-auto">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title pull-left">
                                        Add New Administrator
                                   </h4>
                                    <a href="{{route('users.sa.index')}}" class="btn btn-info  pull-right"><i data-feather='list'></i><span>Admin List</span></a>
                                </div>
                                <hr style="margin-top: -10px;">
                                <div class="card-body">
                                    <form class="form form-horizontal" action="{{route('register')}}" method="post">
                                        @csrf
                                      
                                        <div class="row">
                                            <div class="col-xl-4 col-md-6 col-12">
                                                <div class="mb-1 row">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="title">First Name</label>
                                                        <input type="text" class="form-control"  name="first_name" placeholder="First Name"/>
                                                        @error('first_name')
                                                            <div class="text-danger mt-2 text-sm">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-4 col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="">Middle Name</label>
                                                    <input type="text" class="form-control" name="last_name" placeholder="Middle Name"/>
                                                   
                                                </div>
                                            </div>

                                            <div class="col-xl-4 col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="address">Last Name</label>
                                                    <input type="text" class="form-control" name="last_name" placeholder="Last Name"/>
                                                    @error('last_name')
                                                    <div class="text-danger mt-2 text-sm">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="col-xl-4 col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="start_date">Email</label>
                                                    <input type="email" class="form-control" id="register-email" name="email" placeholder="Enter Email" aria-describedby="register-email" tabindex="2" required/>
                                                    @error('email')
                                                       <div class="text-danger mt-2 text-sm">{{$message}}</div>
                                                    @enderror                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="start_time">Password</label>
                                                    <input type="password" class="form-control" id="register-password" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="register-password" tabindex="3" required/>
                                                    @error('password')
                                                        <div class="text-danger mt-2 text-sm">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="end_date">Confirm Password</label>
                                                    <input type="password" class="form-control" id="register-password" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="register-password" tabindex="3" required/>                                          
                                                </div>
                                            </div>
                                           
                                            <div class="row">
                                                <div class="col-xl-4 col-md-6 col-12">
                                                    <button type="submit" class="btn btn-primary me-1">Register Admin</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>
                <!-- Basic Horizontal form layout section end -->


            </div>
        </div>
    </div>
    <!-- END: Content-->

@endsection

