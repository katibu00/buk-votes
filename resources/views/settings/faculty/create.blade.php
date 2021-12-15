@extends('layouts.master')
@section('PageTitle', 'Create New Faculty')
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
                                    <h4 class="card-title pull-left">Add New Faculty</h4>
                                    <a href="{{route('faculty.index')}}" class="btn btn-info  pull-right"><i data-feather="list" class="me-25"></i>Faculty List</a>
                                </div>
                                <hr style="margin-top: -10px;">
                                <div class="card-body col-md-8 mx-auto">
                                    <form class="form form-horizontal" action="{{(@$editData)? route('faculty.update',@$editData->id) : route('faculty.store') }} " method="post">
                                        @csrf
                                        @if(@$editData) @method('PATCH') @endif
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-1 row">
                                                    <div class="col-sm-3">
                                                        <label class="col-form-label" >Faculty Name</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="name" class="form-control" placeholder="Enter Faculty Name" value="{{@$editData->name}}" />
                                                    </div>
                                                </div>
                                                <div class="mb-1 row">
                                                    <div class="col-sm-3">
                                                        <label class="col-form-label">Faculty Code</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="text"name="code" class="form-control" placeholder="Enter Faculty Code" value="{{@$editData->code}}" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-9 offset-sm-3">
                                                <button type="submit" class="btn btn-primary me-1">{{(@$editData)?'Update':'Submit'}}</button>

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
