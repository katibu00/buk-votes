@extends('layouts.master')
@section('PageTitle', 'Assign Department')
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
                                    <h4 class="card-title pull-left">Assign Department</h4>
                                    <a href="{{route('assign.department')}}" class="btn btn-info  pull-right"><i data-feather="plus" class="me-25"></i>Assign New Departments</a>
                                </div>
                                <hr style="margin-top: -10px;">
                                <div class="card-body"  style="margin-top: -20px;">
                                    <table class="table table-striped table-hover" id="example1">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Faculty</th>
                                                <th>Code</th>
                                                <th>Assigned Departments</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody class="">
                                            @foreach ($datas as $key => $data)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$data['faculty']['name']}}</td>
                                                <td>{{$data['faculty']['code']}}</td>
                                                @php
                                                    $depts = App\Models\AssignDepartment::where('faculty_id',$data['faculty']['id'])->get();
                                                @endphp
                                                <td>{{$depts->count()}}</td>
                                                <td>
                                                    <a title="View Details" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#default{{$key}}"><i data-feather="eye" class="me-25"></i></a>
                                                    <a title="Reset" class="btn btn-sm btn-danger"data-bs-toggle="modal" data-bs-target="#danger{{$key}}"><i data-feather="trash" class="me-25"></i></a>


                                                </td>
                                            </tr>

                                            {{-- View Details Modal --}}
                                            <div class="modal fade text-start" id="default{{$key}}" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel1">Details for {{$data['faculty']['name']}}</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h5>Assigned Departments</h5>
                                                           @foreach ($depts as $sn => $dept)
                                                            <p>{{$sn+1}}) {{$dept['department']['name']}} -  {{$dept['department']['code']}}</p>
                                                           @endforeach

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Dismiss</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                             <!-- Modal Delete -->
                                             <div class="modal fade modal-danger text-start" id="danger{{$key}}" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myModalLabel120">Reset {{$data['faculty']['name']}} Assignment?</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to reset the Assignment?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{route('assign.delete',$data['faculty']['id'])}}" method="post">
                                                                @csrf
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                            <button type="submit" class="btn btn-danger" >Yes</button>
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
