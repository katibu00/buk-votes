@extends('layouts.master')
@section('PageTitle', 'My Interests')
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
                                    <h4 class="card-title pull-left">My Interests</h4>

                                </div>
                                <hr style="margin-top: -10px;">
                                <div class="card-body"  style="margin-top: -20px;">
                                    <table class="table table-striped table-hover" id="example1">
                                        <thead>
                                            <tr>
                                                {{-- <th>S/N</th> --}}
                                                <th>Election</th>
                                                <th>Post</th>
                                                <th class="text-center">payment</th>
                                                <th class="text-center">Qualified</th>
                                            </tr>
                                        </thead>
                                        <tbody class="">

                                            @foreach ($excos as $key => $exco)
                                            <tr>
                                                {{-- <td>{{$key+1}}</td> --}}
                                                <td>{{$exco['election']['title']}}</td>
                                                <td>{{$exco['post']['name']}}</td>
                                                <td class="text-center">{!! $exco->payment == 1? ' <i data-feather="check-square" class="font-medium-5 text-success"></i>':'<i data-feather="x-square" class="font-medium-5 text-danger"></i>' !!}</td>
                                                <td class="text-center">{!! $exco->qualify == 1? ' <i data-feather="check-square" class="font-medium-5 text-success"></i>':'<i data-feather="x-square" class="font-medium-5 text-danger"></i>' !!}</td>
                                            </tr>
                                            @endforeach

                                            @foreach ($sras as $num => $sra)
                                            <tr>
                                                {{-- <td>{{$key+1}}</td> --}}
                                                <td>{{$sra['election']['title']}}</td>
                                                <td>{{$sra->type == 'faculty'?'Faculty Senator':'Departmental Senator'}}</td>
                                                <td class="text-center">{!! $sra->payment == 1? ' <i data-feather="check-square" class="font-medium-5 text-success"></i>':'<i data-feather="x-square" class="font-medium-5 text-danger"></i>' !!}</td>
                                                <td class="text-center">{!! $sra->qualify == 1? ' <i data-feather="check-square" class="font-medium-5 text-success"></i>':'<i data-feather="x-square" class="font-medium-5 text-danger"></i>' !!}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
