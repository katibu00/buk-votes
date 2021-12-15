
@extends('layouts.master')
@section('PageTitle', 'Election Request Form')
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
                                    <h4 class="card-title pull-left">Election Request Form</h4>
                                </div>
                                <hr style="margin-top: -10px;">
                                <div class="card-body"  style="margin-top: -20px;">
                                    <form action="{{route('election.form')}}" method="post" target="_blank">
                                        @csrf
                                    <button type="submit" class="btn btn-relief-info"><i data-feather='download-cloud'></i> Generate Offline Form</button>
                                    </form>
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
