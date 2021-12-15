@extends('layouts.master')
@section('PageTitle', 'Sales of Form')
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
                                    <h4 class="card-title pull-left">Sales of Form</h4>
                                </div>
                                <hr style="margin-top: -10px;">
                                <div class="card-body"  style="margin-top: -20px;">

                                    <div class="row">
                                        <form action="{{route('sales.search')}}" method="post">
                                            @csrf
                                        <div class="col-md-4 col-12 mb-1">
                                            <div class="input-group">
                                                <select name="election_id" class="form-control" required>
                                                    <option value="">Select Election</option>
                                                    @foreach ($elections as $election)
                                                    <option value="{{$election->id}}" {{@$result->id == $election->id?'selected':''}}>{{$election->title}}</option>
                                                    @endforeach
                                                </select>
                                                <button class="btn btn-outline-primary" id="button-addon2" type="submit">Search</button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                    @if(@$result)
                                    <table class="table table-striped table-hover" id="example">
                                        @php
                                            $posts = App\Models\Forms::where('election_id',$result->id)->get();
                                            $last =0;
                                        @endphp
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th style="width: 30%;">Post</th>
                                                <th>s/n</th>
                                                <th>Contestant</th>
                                                <th>Payment</th>
                                                <th>Qualification</th>
                                                <th style="width: 20%; text-align: center;">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody class="">
                                            @foreach ($posts as $key => $post)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$post['position']['name']}}</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            @php
                                            $contestants = App\Models\FormCheck::where('election_id',$result->id)->where('post_id',$post['position']['id'])->get();
                                        @endphp
                                        @foreach ($contestants as $num => $contestant)
                                            <tr>

                                                <td></td>
                                                <td></td>
                                                <td class="text-center">{{$num+1}}</td>
                                                <td> <a href="{{route('user.details',$contestant['user']['id'])}}" target="_blank"> {{$contestant['user']['first_name']}} {{$contestant['user']['middle_name']}} {{$contestant['user']['last_name']}}</a></td>
                                                <td class="text-center">{!! $contestant->payment == 1? ' <i data-feather="check-square" class="font-medium-5 text-success"></i>':'<i data-feather="x-square" class="font-medium-5 text-danger"></i>' !!}</td>
                                                <td class="text-center">{!! $contestant->qualify == 1? ' <i data-feather="check-square" class="font-medium-5 text-success"></i>':'<i data-feather="x-square" class="font-medium-5 text-danger"></i>' !!}</td>
                                                <td class="text-center">
                                                    <a title="Record Payment" class="btn btn-sm btn-info mb-1" data-bs-toggle="modal" data-bs-target="#payment{{$num}}{{$key}}"><i data-feather="dollar-sign" class="me-25"></i></a>
                                                    <a title="Qualify" class="btn btn-sm btn-warning mb-1"  data-bs-toggle="modal" data-bs-target="#qualify{{$num}}{{$key}}"><i data-feather='skip-forward'></i></a>
                                                </td>
                                            </tr>

                                            <div class="modal fade text-start" id="payment{{$num}}{{$key}}" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel1">Record Payment for {{$contestant['user']['first_name']}} {{$contestant['user']['middle_name']}} {{$contestant['user']['last_name']}}?</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p class="text-danger">
                                                                You can not undo this Operation. Are you sure you want to continue?
                                                            </p>
                                                            <h6><strong>Post:</strong> {{$post['position']['name']}}</h6>
                                                            <h6><strong>Amount:</strong> {{number_format($post->price,0)}}</h6>
                                                            <h6><strong>Received By:</strong> {{Auth::user()->first_name}} {{Auth::user()->middle_name}} {{Auth::user()->last_name}}</h6>

                                                        </div>
                                                        <form action="{{route('sales.payment')}}" method="post">
                                                            @csrf
                                                            <input type="hidden" value="{{$post['position']['id']}}" name="post_id">
                                                            <input type="hidden" value="{{$result->id}}" name="election_id">
                                                            <input type="hidden" value="{{$post->price}}" name="amount">
                                                            <input type="hidden" value="{{$contestant['user']['id']}}" name="contestant_id">

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
                                                            <button type="submit" class="btn btn-danger">Record</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Qualify Modal exco --}}

                                            <div class="modal fade text-start" id="qualify{{$num}}{{$key}}" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel1">Qualify {{$contestant['user']['first_name']}} {{$contestant['user']['middle_name']}} {{$contestant['user']['last_name']}}?</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="modal-body">
                                                                <p class="text-danger">
                                                                    You can not undo this Operation. Are you sure you want to continue?
                                                                </p>
                                                                <h6><strong>Post:</strong> {{$post['position']['name']}}</h6>
                                                                <h6><strong>Qualified By:</strong> {{Auth::user()->first_name}} {{Auth::user()->middle_name}} {{Auth::user()->last_name}}</h6>
                                                             </div>
                                                             <form action="{{route('sales.qualify.exco')}}" method="post">
                                                                @csrf
                                                                <input type="hidden" value="{{$post['position']['id']}}" name="post_id">
                                                                <input type="hidden" value="{{$result->id}}" name="election_id">
                                                                <input type="hidden" value="{{$contestant['user']['id']}}" name="contestant_id">
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
                                                                <button type="submit" class="btn btn-danger">Qualify</button>
                                                            </div>
                                                            </form>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach

                                            @endforeach
                                        {{-- SRA --}}
                                        @php
                                            $last += $key;
                                        @endphp
                                            {{-- Faculty --}}
                                        @if($result->sra == 'all')
                                            @php
                                                $posts = App\Models\SRAForm::where('election_id',$result->id)->where('type','faculty')->get();
                                                $final = 0;
                                            @endphp

                                                @foreach ($posts as $key => $post)
                                                <tr>
                                                    <td>{{$last+2}}</td>
                                                    <td>Faculty Senator</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                @php
                                                 $contestants = App\Models\SRACandidates::where('election_id',$result->id)->where('type','faculty')->get();
                                                @endphp
                                            @foreach ($contestants as $num => $contestant)
                                                <tr>

                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-center">{{$num+1}}</td>
                                                    <td>  <a href="{{route('user.details',$contestant['user']['id'])}}" target="_blank"> {{$contestant['user']['first_name']}} {{$contestant['user']['middle_name']}} {{$contestant['user']['last_name']}} ({{$contestant['faculty']['name']}}) </a></td>
                                                    <td class="text-center">{!! $contestant->payment == 1? ' <i data-feather="check-square" class="font-medium-5 text-success"></i>':'<i data-feather="x-square" class="font-medium-5 text-danger"></i>' !!}</td>
                                                    <td class="text-center">{!! $contestant->qualify == 1? ' <i data-feather="check-square" class="font-medium-5 text-success"></i>':'<i data-feather="x-square" class="font-medium-5 text-danger"></i>' !!}</td>
                                                    <td class="text-center">
                                                        <a title="Record Payment" class="btn btn-sm btn-info mb-1" data-bs-toggle="modal" data-bs-target="#paymentfac{{$num}}{{$key}}"><i data-feather="dollar-sign" class="me-25"></i></a>
                                                        <a title="Qualify" class="btn btn-sm btn-warning mb-1"  data-bs-toggle="modal" data-bs-target="#qualifyfac{{$num}}{{$key}}"><i data-feather='skip-forward'></i></a>
                                                    </td>
                                                </tr>

                                                <div class="modal fade text-start" id="paymentfac{{$num}}{{$key}}" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel1">Record Payment for {{$contestant['user']['first_name']}} {{$contestant['user']['middle_name']}} {{$contestant['user']['last_name']}}?</h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p class="text-danger">
                                                                    You can not undo this Operation. Are you sure you want to continue?
                                                                </p>
                                                                <h6><strong>Post:</strong> Faculty Senator</h6>
                                                                <h6><strong>Amount:</strong> {{number_format($post->price,0)}}</h6>
                                                                <h6><strong>Received By:</strong> {{Auth::user()->first_name}} {{Auth::user()->middle_name}} {{Auth::user()->last_name}}</h6>

                                                            </div>
                                                            <form action="{{route('sales.payment.sra')}}" method="post">
                                                                @csrf
                                                                <input type="hidden" value="faculty" name="type">
                                                                <input type="hidden" value="{{$result->id}}" name="election_id">
                                                                <input type="hidden" value="{{$contestant['user']['id']}}" name="user_id">

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
                                                                <button type="submit" class="btn btn-danger">Record</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Qualify Modal fac--}}

                                                <div class="modal fade text-start" id="qualifyfac{{$num}}{{$key}}" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel1">Qualify {{$contestant['user']['first_name']}} {{$contestant['user']['middle_name']}} {{$contestant['user']['last_name']}}?</h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p class="text-danger">
                                                                    You can not undo this Operation. Are you sure you want to continue?
                                                                </p>
                                                                <h6><strong>Post:</strong> Faculty Senator</h6>
                                                                <h6><strong>Received By:</strong> {{Auth::user()->first_name}} {{Auth::user()->middle_name}} {{Auth::user()->last_name}}</h6>
                                                            </div>
                                                            <form action="{{route('sales.qualify.sra')}}" method="post">
                                                                @csrf
                                                                <input type="hidden" value="faculty" name="type">
                                                                <input type="hidden" value="{{$result->id}}" name="election_id">
                                                                <input type="hidden" value="{{$contestant['user']['id']}}" name="user_id">

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
                                                                <button type="submit" class="btn btn-danger">Qualify</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endforeach
                                            @php
                                                $final +=$last;
                                            @endphp
                                                @endforeach
                                         @endif



                                         {{-- departmental --}}
                                         @if($result->sra == 'all' || $result->sra == 'one')



                                             <tr>
                                                 <td>@if(@$final) {{$final+3}} @else {{$last+2}} @endif</td>
                                                 <td>Departmental Senator</td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                             </tr>
                                             @php
                                             $contestants = App\Models\SRACandidates::where('election_id',$result->id)->where('type','department')->get();
                                         @endphp
                                         @foreach ($contestants as $num => $contestant)
                                             <tr>

                                                 <td></td>
                                                 <td></td>
                                                 <td class="text-center">{{$num+1}}</td>
                                                 <td>  <a href="{{route('user.details',$contestant['user']['id'])}}" target="_blank"> {{$contestant['user']['first_name']}} {{$contestant['user']['middle_name']}} {{$contestant['user']['last_name']}} ({{$contestant['department']['name']}}) </a></td>
                                                 <td class="text-center">{!! $contestant->payment == 1? ' <i data-feather="check-square" class="font-medium-5 text-success"></i>':'<i data-feather="x-square" class="font-medium-5 text-danger"></i>' !!}</td>
                                                 <td class="text-center">{!! $contestant->qualify == 1? ' <i data-feather="check-square" class="font-medium-5 text-success"></i>':'<i data-feather="x-square" class="font-medium-5 text-danger"></i>' !!}</td>
                                                 <td class="text-center">
                                                     <a title="Record Payment" class="btn btn-sm btn-info mb-1" data-bs-toggle="modal" data-bs-target="#paymentdept{{$num}}{{$key}}"><i data-feather="dollar-sign" class="me-25"></i></a>
                                                     <a title="Qualify" class="btn btn-sm btn-warning mb-1"  data-bs-toggle="modal" data-bs-target="#qualifydept{{$num}}{{$key}}"><i data-feather='skip-forward'></i></a>
                                                 </td>
                                             </tr>

                                             <div class="modal fade text-start" id="paymentdept{{$num}}{{$key}}" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                 <div class="modal-dialog">
                                                     <div class="modal-content">
                                                         <div class="modal-header">
                                                             <h4 class="modal-title" id="myModalLabel1">Record Payment for {{$contestant['user']['first_name']}} {{$contestant['user']['middle_name']}} {{$contestant['user']['last_name']}}?</h4>
                                                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                         </div>
                                                         <div class="modal-body">
                                                             <p class="text-danger">
                                                                 You can not undo this Operation. Are you sure you want to continue?
                                                             </p>
                                                             <h6><strong>Post:</strong> Departmental Senator</h6>
                                                             <h6><strong>Amount:</strong> {{number_format($post->price,0)}}</h6>
                                                             <h6><strong>Received By:</strong> {{Auth::user()->first_name}} {{Auth::user()->middle_name}} {{Auth::user()->last_name}}</h6>

                                                         </div>
                                                         <form action="{{route('sales.payment.sra')}}" method="post">
                                                             @csrf
                                                             <input type="hidden" value="department" name="type">
                                                             <input type="hidden" value="{{$post->price}}" name="amount">
                                                             <input type="hidden" value="{{$result->id}}" name="election_id">
                                                             <input type="hidden" value="{{$contestant['user']['id']}}" name="user_id">

                                                         <div class="modal-footer">
                                                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
                                                             <button type="submit" class="btn btn-danger">Record</button>
                                                         </div>
                                                         </form>
                                                     </div>
                                                 </div>
                                             </div>

                                             {{-- Qualify Modal dept--}}

                                             <div class="modal fade text-start" id="qualifydept{{$num}}{{$key}}" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                 <div class="modal-dialog">
                                                     <div class="modal-content">
                                                         <div class="modal-header">
                                                             <h4 class="modal-title" id="myModalLabel1">Qualify {{$contestant['user']['first_name']}} {{$contestant['user']['middle_name']}} {{$contestant['user']['last_name']}}?</h4>
                                                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                         </div>
                                                         <div class="modal-body">
                                                            <p class="text-danger">
                                                                You can not undo this Operation. Are you sure you want to continue?
                                                            </p>
                                                            <h6><strong>Post:</strong> Departmental Senator</h6>
                                                            <h6><strong>Qualified By:</strong> {{Auth::user()->first_name}} {{Auth::user()->middle_name}} {{Auth::user()->last_name}}</h6>
                                                         </div>
                                                         <form action="{{route('sales.qualify.sra')}}" method="post">
                                                            @csrf
                                                            <input type="hidden" value="department" name="type">
                                                            <input type="hidden" value="{{$result->id}}" name="election_id">
                                                            <input type="hidden" value="{{$contestant['user']['id']}}" name="user_id">

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
                                                            <button type="submit" class="btn btn-danger">Qualify</button>
                                                        </div>
                                                        </form>
                                                     </div>
                                                 </div>
                                             </div>

                                         @endforeach
                                             {{-- @endforeach --}}
                                      @endif
                                         {{-- departmental --}}
                                        {{-- SRA --}}
                                        </tbody>
                                    </table>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
