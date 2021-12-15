@extends('layouts.master')
@section('PageTitle', 'Reports/Suggestions')
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
                                    <h4 class="card-title pull-left">Suggestion Box</h4>
                                    <a href="{{route('message.delete')}}" class="btn btn-danger  pull-right"><i data-feather="trash" class="me-25"></i>Delete All</a>
                                </div>
                                <hr style="margin-top: -10px;">
                                <div class="card-body"  style="margin-top: -20px;">
                                    <table class="table table-striped table-hover" id="example1">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Message Body</th>
                                                <th>Contact Details</th>
                                                <th>Date Sent</th>


                                            </tr>
                                        </thead>
                                        <tbody class="">
                                            @foreach ($messages as $key => $data)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$data->message}}</td>
                                                <td>{{$data->contact}}</td>
                                                <td>{{$data->created_at->diffForHumans()}}</td>
                                                {{-- <td>
                                                    <a title="Edit" class="btn btn-sm btn-info" href="{{ route('clubs.edit', $data->id) }}"><i class="fa fa-edit"></i></a>
                                                    <a title="Edit" class="btn btn-sm btn-danger" href="{{ route('clubs.delete', $data->id) }}"><i class="fa fa-edit"></i></a>

                                                </td> --}}
                                            </tr>
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
