@extends('layouts.master')
@section('PageTitle', 'Sales Report')
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
                                    <h4 class="card-title pull-left">Sales Report</h4>
                                </div>
                                <hr style="margin-top: -10px;">
                                <div class="card-body"  style="margin-top: -20px;">

                                    <div class="col-12 my-3">
                                        <div class="row">
                                            <form action="{{route('report.sales')}}" method="post" target="_blank">
                                                @csrf
                                            <div class="col-md-4 col-12 mb-1 lmx-auto">
                                                <div class="input-group">
                                                    <select name="election_id" class="form-control" required>
                                                        <option value="">Select Election</option>
                                                        @foreach ($elections as $elect)
                                                        <option value="{{$elect->id}}">{{$elect->title}}</option>
                                                        @endforeach
                                                    </select>
                                                    <button class="btn btn-outline-primary" id="button-addon2" type="submit">Generate</button>
                                                </div>
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
    </div>
    <!-- END: Content-->
@endsection
