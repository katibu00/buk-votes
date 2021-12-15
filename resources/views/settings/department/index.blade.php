@extends('layouts.master')
@section('PageTitle', 'Department')
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
                                    <h4 class="card-title pull-left">Department</h4>
                                    <a href="{{route('department.create')}}" class="btn btn-info  pull-right"><i data-feather="plus" class="me-25"></i>Add New Department</a>
                                </div>
                                <hr style="margin-top: -10px;">
                                <div class="card-body"  style="margin-top: -20px;">
                                    <table class="table table-striped table-hover" id="example1">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Name</th>
                                                <th>Code</th>
                                                <th>Duration</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody class="">
                                            @foreach ($datas as $key => $data)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$data->name}}</td>
                                                <td>{{$data->code}}</td>
                                                <td>{{$data->duration}}</td>
                                                <td>
                                                    <a title="Edit" class="btn btn-sm btn-info" href="{{ route('department.edit', $data->id) }}"><i data-feather="edit" class="me-25"></i></a>
                                                    <a title="Edit" class="btn btn-sm btn-danger" href="{{ route('department.delete', $data->id) }}"><i data-feather="trash" class="me-25"></i></a>


                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
                <!--/ Basic table -->


            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
