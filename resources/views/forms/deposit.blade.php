@extends('layouts.master')
@section('PageTitle', 'Deposit Slip')
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
                                    <h4 class="card-title pull-left">Deposit Slip</h4>
                                </div>
                                <hr style="margin-top: -10px;">
                                <div class="card-body"  style="margin-top: -20px;">

                                    <p>Please note that deposit slip will be generated for all your declared interest which you have not paid yet.</p>
                                    <form action="{{route('deposit.slip')}}" method="post" target="_blank">
                                        @csrf
                                    <button type="submit" class="btn btn-relief-info"><i data-feather='download-cloud'></i> Generate Deposit Slip</button>
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
