@extends('layouts.master')
@section('PageTitle', 'Elections')
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
                                    <h4 class="card-title pull-left">Elections</h4>
                                    <a href="{{route('election.create')}}" class="btn btn-info  pull-right"><i data-feather='plus'></i>Add New Election</a>
                                </div>
                                <hr style="margin-top: -10px;">
                                <div class="card-body"  style="margin-top: -20px;">
                                    <table class="table table-striped table-hover" id="example1">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%;">S/N</th>
                                                <th>Title</th>
                                                {{-- <th>Committee</th> --}}
                                                <th>Duration</th>
                                                {{-- <th>Rules</th> --}}
                                                <th>Contact</th>
                                                <th style="width: 20%">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody class="">
                                            @foreach ($elections as $key => $election)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$election->title}}</td>
                                                <td>{{\Carbon\Carbon::parse($election->start_date)->format('l, jS M Y')}} ( {{\Carbon\Carbon::parse($election->start_time)->format('h:i A')}}) - {{\Carbon\Carbon::parse($election->end_date)->format('l, jS M Y')}} ( {{\Carbon\Carbon::parse($election->end_time)->format('h:i A')}})</td>
                                                <td>Phone: {{$election->phone}}<br/>Email: {{$election->email}}</td>
                                                <td>
                                                    <a title="Details" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#details{{$key}}"><i data-feather='eye'></i></a>
                                                    <a title="Edit" class="btn btn-sm btn-info" href="{{ route('election.edit', $election->id) }}"><i data-feather='edit'></i></a>
                                                    <a title="Delete" class="btn btn-sm btn-danger"data-bs-toggle="modal" data-bs-target="#danger{{$key}}"><i data-feather='trash'></i></a>

                                                </td>
                                            </tr>

                                              <!-- Modal -->
                                              <div class="modal fade" id="details{{$key}}" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterTitle">{{$election->title}} Details</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="divider divider-dark">
                                                                <div class="divider-text">Committee</div>
                                                            </div>

                                                            <p>{{$election['elcom']['name']}}</p>

                                                            <div class="divider divider-dark">
                                                                <div class="divider-text">Sales of Form</div>
                                                            </div>
                                                            @php
                                                                $data = App\Models\Forms::where('election_id',$election->id)->first();
                                                            @endphp
                                                            @if($data)
                                                              <p><strong>Open Date:</strong>{{\Carbon\Carbon::parse(@$data->start_date)->format('l, jS M Y')}}</p>
                                                              <p><strong>Close Date:</strong>{{\Carbon\Carbon::parse(@$data->end_date)->format('l, jS M Y')}}</p>
                                                              @else
                                                              <h5>Forms not Generated</h5>
                                                              @endif

                                                            <div class="divider divider-dark">
                                                                <div class="divider-text">Election Duration</div>
                                                            </div>
                                                            <p><strong>Start Date:</strong>{{\Carbon\Carbon::parse($election->start_date)->format('l, jS M Y')}}</p>
                                                            <p><strong>End Date:</strong> {{\Carbon\Carbon::parse($election->end_date)->format('l, jS M Y')}}</p>
                                                            <p><strong>Start Time:</strong> {{\Carbon\Carbon::parse($election->start_time)->format('h:i A')}}</p>
                                                            <p><strong>End Time:</strong>  {{\Carbon\Carbon::parse($election->end_time)->format('h:i A')}}</p>
                                                            <div class="divider divider-dark">
                                                                <div class="divider-text">SRA</div>
                                                            </div>
                                                            <p><strong>Open to:</strong>@if($election->sra == 'all') Faculty & Departmental Senators @elseif($election->sra == 'none') None @elseif($election->sra == 'one') Departmental Senator only @endif</p>

                                                            <div class="divider divider-dark">
                                                                <div class="divider-text">Rules</div>
                                                            </div>
                                                            <p><strong>Faculty:</strong> @if($election->faculty != 'all') Specified @else All @endif</p>
                                                            <p><strong>Department:</strong>  @if($election->department != 'all') Specified @else All @endif</p>
                                                            <p><strong>State:</strong>  @if($election->state != 'All') Specified @else All @endif</p>
                                                            <p><strong>LGA:</strong>  @if($election->lga != 'All') Specified @else All @endif</p>
                                                          
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Dismiss</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                             <!-- Delete Modal -->
                                            <div class="modal fade modal-danger text-start" id="danger{{$key}}" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myModalLabel120">Delete {{$election->title}}?</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{route('election.delete',$election->id)}}" method="post">
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
