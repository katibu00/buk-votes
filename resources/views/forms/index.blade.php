@extends('layouts.master')
@section('PageTitle', 'Sales of Forms')
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
                                    <h4 class="card-title pull-left">Sales of Forms</h4>
                                    {{-- <a href="{{route('generate.form.index')}}" class="btn btn-info  pull-right"><i data-feather="plus" class="me-25"></i>Generate Forms</a> --}}
                                </div>
                                <hr style="margin-top: -10px;">
                                <div class="card-body"  style="margin-top: -20px;">
                                    <table class="table table-striped table-hover" id="example1">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" class="text-center" style="vertical-align:middle;">S/N</th>
                                                <th rowspan="2" class="text-center" style="vertical-align:middle;">Election</th>
                                                <th rowspan="2" class="text-center" style="vertical-align:middle;">Sales Duration</th>
                                                {{-- <th rowspan="2" class="text-center" style="vertical-align:middle;">Status</th> --}}


                                                <th colspan="3" class="text-center" style="vertical-align:middle; width: 35%;">Forms
                                                    <tr>
                                                        <th class="text-center btn present_all" style="display: table-cell; background-color: #114190;color: white;">Exco</th>
                                                        <th class="text-center btn leave_all" style="display: table-cell; background-color: #114190; color: white;">SRA</th>

                                                    </tr>
                                                </th>
                                            </tr>

                                        </thead>
                                        <tbody class="">
                                            @foreach ($elections as $key => $election)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$election->title}}</td>

                                                @php
                                                $exco = App\Models\Forms::where('election_id',$election->id)->first();
                                                if($election->sra != 'none'){
                                                    $sra = App\Models\SRAForm::where('election_id',$election->id)->first();
                                                }

                                                @endphp

                                                @if($exco)
                                                 <td>{{\Carbon\Carbon::parse(@$data->start_date)->format('l, jS M Y')}} - {{\Carbon\Carbon::parse(@$data->end_date)->format('l, jS M Y')}}   @if($election->sra != 'none') @if(!$sra) <br/><span class="text-danger">SRA Forms not Generated </span>@endif @endif</td>
                                                @else
                                                <td class="text-danger">Exco Forms not Generate @if($election->sra != 'none')  @if(!$sra) <br/>SRA Forms not Generated  @endif @endif</td>
                                                @endif





                                                <td class="text-center">
                                                    <a title="Add" class="btn btn-sm btn-info mb-1" href="{{ route('generate.form.index', $election->id) }}"><i data-feather="plus" class="me-25"></i></a>
                                                    <a title="Details" class="btn btn-sm btn-success mb-1" data-bs-toggle="modal" data-bs-target="#details{{$key}}"><i data-feather='eye'></i></a>
                                                    <a title="Edit" class="btn btn-sm btn-warning" href="{{ route('form.edit.exco', $election->id) }}"><i data-feather='edit'></i></a>
                                                    <a title="Delete" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#excodel{{$election->id}}"><i data-feather="trash" class="me-25"></i></a>

                                                </td>
                                                @if($election->sra != 'none')
                                                <td class="text-center">
                                                    <a title="Add" class="btn btn-sm btn-info mb-1" href="{{ route('generate.form.sra.index', $election->id) }}"><i data-feather="plus" class="me-25"></i></a>
                                                    <a title="Details" class="btn btn-sm btn-success mb-1" data-bs-toggle="modal" data-bs-target="#detailssra{{$election->id}}"><i data-feather='eye'></i></a>
                                                    <a title="Edit" class="btn btn-sm btn-warning" href="{{ route('form.edit.sra', $election->id) }}"><i data-feather='edit'></i></a>
                                                    <a title="Delete" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#sradel{{$election->id}}"><i data-feather="trash" class="me-25"></i></a>

                                                </td>
                                                @else
                                                 <td class="text-center"><a title="Not Allowed" class="btn btn-sm btn-danger"><i data-feather="x-square" class="me-25"></i></a></td>
                                                @endif
                                            </tr>

                                               <!--Details Exco Modal -->
                                            <div class="modal fade" id="details{{$key}}" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterTitle">Executives: {{$election->title}} Details</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">

                                                            @php
                                                            $posts = App\Models\Forms::where('election_id',$election->id)->get();
                                                            @endphp
                                                            @foreach ($posts as $key => $post)
                                                            <h4 class="text-info">{{$key+1}}. {{$post['position']['name']}}</h4>
                                                                <p><strong>price</strong> N{{number_format($post->price,0)}} ;
                                                            <strong>CGPA:</strong> {{$post->cgpa}} ;
                                                            <strong>Min Level:</strong> {{$post->level}}</p>
                                                            @endforeach
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Dismiss</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                               <!--Details sra Modal -->
                                               <div class="modal fade" id="detailssra{{$election->id}}" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterTitle">SRA: {{$election->title}} Details</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">

                                                            @php
                                                            $postsra = App\Models\SRAForm::where('election_id',$election->id)->get();
                                                            @endphp
                                                            @foreach ($postsra as $key => $post)
                                                            <h4 class="text-info">{{$key+1}}. @if($post->type == 'faculty') Faculty Senator @elseif($post->type == 'department') Departmental Senator @endif</h4>
                                                                <p><strong>price</strong> N{{number_format($post->price,0)}} ;
                                                            <strong>CGPA:</strong> {{$post->cgpa}}
                                                            <strong>Min Level:</strong> {{$post->level}}00L</p>
                                                            @endforeach
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Dismiss</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                             <!-- Exco Delete Modal -->
                                             <div class="modal fade modal-danger text-start" id="excodel{{$election->id}}" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myModalLabel120">Delete Exco Forms for {{$election->title}} elecion?</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{route('forms.delete.exco',$election->id)}}" method="post">
                                                            @csrf
                                                        <div class="modal-body">
                                                          <p>This action can not be undone. Are you sure you want to continue?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Delete Modal -->
                                            <div class="modal fade modal-danger text-start" id="sradel{{$election->id}}" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myModalLabel120">Delete SRA Forms for {{$election->title}} elecion?</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{route('forms.delete.sra',$election->id)}}" method="post">
                                                        @csrf
                                                    <div class="modal-body">
                                                        <p>This action can not be undone. Are you sure you want to continue?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
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
