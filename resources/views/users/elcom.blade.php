@extends('layouts.master')
@section('PageTitle', 'Electoral Committees')
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
                                    <h4 class="card-title pull-left">Electoral Committees</h4>
                                    {{-- <a href="{{route('posts.create')}}" class="btn btn-info  pull-right"><i data-feather="home" class="me-25"></i>Add New Post</a> --}}
                                </div>
                                <hr style="margin-top: -10px;">
                                <div class="card-body"  style="margin-top: -20px;">
                                    <table class="table table-striped table-hover" id="example1">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Committee</th>
                                                <th>Members</th>
                                                <th class="text-center">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody class="">
                                            @foreach ($datas as $key => $data)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$data->name}}</td>
                                                @php
                                                    $members = App\Models\User::where('role','elcom')->where('elcom_id',$data->id)->get()
                                                @endphp
                                                <td>{{$members->count()}}</td>

                                                <td class="text-center">
                                                    <a title="Members" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#details{{$key}}"><i data-feather='eye'></i></a>
                                                    <a title="Members" class="btn btn-sm btn-secondary" href="{{route('users.index')}}"><i data-feather='plus'></i></a>
                                                    <a title="Dissolve" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#dissolve{{$key}}"><i data-feather='activity'></i></a>
                                                    {{-- <a title="Issue Certificate" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#elcom{{$data->id}}"><i data-feather='book'></i></a> --}}

                                                </td>
                                            </tr>

                                            <!-- Modal Details -->
                                            <div class="modal fade" id="details{{$key}}" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterTitle">{{$data->name}} Details</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            

                                                            <div class="divider divider-dark">
                                                                <div class="divider-text">Members</div>
                                                            </div>
                                                            @foreach ($members as $member)
                                                            <p>Name: <strong>{{$member->first_name}} {{$member->middle_name}} {{$member->last_name}}</strong></p> 
                                                            <p>Faculty/Department: {{$member['faculty']['name']}} - {{$member['department']['name']}}</p>
                                                            <p>Phone Number: {{$member->phone}}</p>
                                                            <p>Password: {{$member->nickname}}</p><hr />
                                                            @endforeach
                                                          
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Dismiss</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal Dissolve-->
                                            <div class="modal fade" id="dissolve{{$key}}" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Dissolve members of {{$data->name}}?</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{route('elcom.dissolve')}}" method="post">
                                                        @csrf
                                                    <div class="modal-body">
                                                        
                                                        <input type="hidden" name="elcom_id" value="{{$data->id}}">
                                            
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">No</button>
                                                        <button type="submit" class="btn btn-danger">Yes, Dissolve</button>
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
