@extends('layouts.master')
@section('PageTitle', 'Election Timetable')
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
                                    <h4 class="card-title pull-left">Election Timetable</h4>
                                </div>
                                <hr style="margin-top: -10px;">
                                <div class="card-body"  style="margin-top: -20px;">
                                    <table class="table table-striped table-hover" id="example1">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">S/N</th>
                                                <th>Name</th>
                                                <th>Sales of Forms</th>
                                                <th>Status</th>
                                                <th>Election Date</th>
                                                <th>Time</th>
                                                <th>Status</th>


                                            </tr>
                                        </thead>
                                        <tbody class="">
                                            @foreach ($datas as $key => $data)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$data->title}}</td>
                                                @php
                                                    $form = App\Models\Forms::where('election_id',$data->id)->first();
                                                    if($form){
                                                    $form_close = Carbon\Carbon::createFromFormat('Y-m-d',$form->end_date);
                                                    $form_start = Carbon\Carbon::createFromFormat('Y-m-d', $form->start_date);
                                                    $today_date = carbon\Carbon::createFromFormat('Y-m-d', date('Y-m-d'));
                                                    $start_date = Carbon\Carbon::createFromFormat('Y-m-d', $data->start_date);
                                                    }
                                                @endphp
                                                @if($form)
                                                <td>{{\Carbon\Carbon::parse($form->start_date)->format('jS M')}} - {{\Carbon\Carbon::parse($form->end_date)->format('jS M')}}</td>

                                                @if($today_date->lt($form_start))
                                                <td><span class="badge rounded-pill badge-light-warning me-1">Pending</span></td>
                                                @elseif($today_date->lte($form_close))
                                                <td><span class="badge rounded-pill badge-light-success me-1">Ongoing</span></td>
                                                @elseif($today_date->gt($form_close))
                                                <td><span class="badge rounded-pill badge-light-danger me-1">Closed</span></td>
                                               @endif

                                                <td>{{\Carbon\Carbon::parse($data->start_date)->format('l, jS M')}} ({{\Carbon\Carbon::now()->diffForHumans($start_date)}})</td>
                                                <td>{{\Carbon\Carbon::parse($data->start_time)->format('h:i A')}} - {{\Carbon\Carbon::parse($data->end_time)->format('h:i A')}}</td>

                                                @if($today_date->lt($start_date))
                                                  <td><span class="badge rounded-pill badge-light-warning me-1">Pending</span></td>
                                                  @elseif($today_date->eq($start_date))
                                                  <td><span class="badge rounded-pill badge-light-success me-1">Ongoing</span></td>
                                                  @elseif($today_date->gt($start_date))
                                                  <td><span class="badge rounded-pill badge-light-danger me-1">Closed</span></td>
                                                 @endif
                                                 @endif

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
