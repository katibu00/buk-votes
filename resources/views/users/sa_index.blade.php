@extends('layouts.master')
@section('PageTitle', 'Student Affairs')
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
                                    <h4 class="card-title pull-left">Student Affairs (Admins)</h4>
                                    <a href="{{route('register')}}" class="btn btn-info  pull-right"><i data-feather='plus'></i>Register New Admin</a>
                                </div>
                                <hr style="margin-top: -10px;">
                                <div class="card-body"  style="margin-top: -20px;">
                                    <table class="table table-striped table-hover" id="example1">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody class="">
                                            @foreach ($datas as $key => $data)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$data->first_name}} {{$data->middle_name}} {{$data->last_name}}</td>
                                                <td>{{$data->email}}</td>
                                                <td>
                                                    <a title="Change Password" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#password{{$data->id}}"><i data-feather='lock'></i></a>
                                                    <a title="Delete Admin" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{$data->id}}"><i data-feather='trash'></i></a>

                                                </td>
                                            </tr>

                                                <!--Change Password Modal -->
                                                <div class="modal fade" id="password{{$data->id}}" tabindex="-1"  aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">Change Password for {{$data->first_name}} {{$data->middle_name}} {{$data->last_name}}?</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{route('user.password')}}" method="post">
                                                                    @csrf
                                                                <div class="col-xl-12 col-md-12 col-12">
                                                                    <div class="mb-1">
                                                                        <label class="form-label" for="">New Password</label>
                                                                        <input type="text" name="password" class="form-control">
                                                                        <input type="hidden" name="user_id" value="{{$data->id}}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                            </div>
                                                        </form>
                                                        </div>
                                                    </div>
                                                </div>
                                           
                                                <!--Change Password Modal -->
                                                <div class="modal fade" id="delete{{$data->id}}" tabindex="-1"  aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">Delete {{$data->first_name}} {{$data->middle_name}} {{$data->last_name}}? You cannot undo the operation</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{route('user.delete')}}" method="post">
                                                                    @csrf
                                                                <div class="col-xl-12 col-md-12 col-12">
                                                                    <div class="mb-1">
                                                                        {{-- <label class="form-label" for="">New Password</label>
                                                                        <input type="text" name="password" class="form-control"> --}}
                                                                        <input type="hidden" name="user_id" value="{{$data->id}}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                                            </div>
                                                        </form>
                                                        </div>
                                                    </div>
                                                </div>
                                     
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>

    <!-- END: Content-->
@endsection
