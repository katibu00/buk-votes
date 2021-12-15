@extends('layouts.master')
@section('PageTitle', 'Registered Users')
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
                                    <h4 class="card-title pull-left">Registered Students</h4>
                                    {{-- <a href="{{route('posts.create')}}" class="btn btn-info  pull-right"><i data-feather="home" class="me-25"></i>Add New Post</a> --}}
                                </div>
                                <hr style="margin-top: -10px;">
                                <div class="card-body"  style="margin-top: -20px;">
                                    <table class="table table-striped table-hover" id="example1">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Matric Number</th>
                                                <th>Name</th>
                                                <th>Department</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody class="">
                                            @foreach ($datas as $key => $data)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$data->reg_number}}</td>
                                                <td>{{$data->first_name}} {{$data->middle_name}} {{$data->last_name}}</td>
                                                <td>{{$data['department']['name']}}</td>
                                                <td>
                                                    <a title="Appoint ELCOM" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#elcom{{$data->id}}"><i data-feather='user-plus'></i></a>

                                                </td>
                                            </tr>

                                                <!-- Modal -->
                                                <div class="modal fade" id="elcom{{$data->id}}" tabindex="-1"  aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">Make {{$data->reg_number}} ELCOM</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{route('make.elcom',$data->id)}}" method="post">
                                                                    @csrf
                                                                <div class="col-xl-12 col-md-12 col-12">
                                                                    <div class="mb-1">
                                                                        <label class="form-label" for="">Election Committee</label>
                                                                        <select name="election_id" class="form-control" required>
                                                                            <option value=""></option>
                                                                            @foreach ($elcoms as $elcom)
                                                                            <option value="{{$elcom->id}}">{{$elcom->name}}</option>
                                                                            @endforeach
                                                                        </select>
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
                                            
                                            <!-- Vertical modal end-->
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
