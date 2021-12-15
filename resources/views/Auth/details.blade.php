@extends('layouts.master')
@section('PageTitle', 'User Details')
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">

            <div class="content-body">
                <div class="row">
                    <div class="col-12">

                    </div>
                </div>
                <!-- Basic table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title pull-left">User Details - {{$user->reg_number}}</h4>
                                </div>
                                <hr style="margin-top: -10px;">
                                <div class="card-body"  style="margin-top: -20px;">
                                    <table class="table table-striped table-hover table-bordered" style="width: 50%">
                                        <thead>
                                            <tr>
                                                {{-- <th style="width: %"></th> --}}
                                                <td colspan="2"> <img src="/uploads/users/{{$user->image}}"  class="rounded me-50" alt="profile image" height="150" width="150" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="width: %">Full Name</th>
                                                <td>{{$user->first_name}} {{$user->middle_name}} {{$user->last_name}}</td>
                                            </tr>

                                            <tr>
                                                <th style="width: %">Nickname</th>
                                                <td>{{$user->nickname}}</td>
                                            </tr>
                                            <tr>
                                                <th style="width: %">Registration Number</th>
                                                <td>{{$user->reg_number}}</td>
                                            </tr>
                                            <tr>
                                                <th style="width: %">Phone</th>
                                                <td>{{$user->phone}}</td>
                                            </tr>
                                            <tr>
                                                <th style="width: %">Email</th>
                                                <td>{{$user->email}}</td>
                                            </tr>
                                            <tr>
                                                <th style="width: %">Faculty</th>
                                                <td>{{$user['faculty']['name']}}</td>
                                            </tr>

                                            <tr>
                                                <th style="width: %">Department</th>
                                                <td>{{$user['department']['name']}}</td>
                                            </tr>

                                            <tr>
                                                <th style="width: %">Level</th>
                                                <td>{{$user->level}}00L</td>
                                            </tr>
                                            <tr>
                                                <th style="width: %">State</th>
                                                <td>{{$user->state}}</td>
                                            </tr>
                                            <tr>
                                                <th style="width: %">LGA</th>
                                                <td>{{$user->lga}}</td>
                                            </tr>
                                        </thead>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal to add new record -->

                <!--/ Basic table -->


            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
