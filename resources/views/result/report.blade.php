@extends('layouts.master')
@section('PageTitle', 'Election Return')
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">

            @if(@!$election)
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="col-12 mt-5">
                            <div class="row">
                                <form action="{{route('return.exco.search')}}" method="post">
                                    @csrf
                                <div class="col-md-4 col-12 mb-1 mx-auto">
                                    <div class="input-group">
                                        <select name="election_id" class="form-control" required>
                                            <option value="">Select Election</option>
                                            @foreach ($electionss as $elect)
                                            <option value="{{$elect->id}}" {{@$result->id == $elect->id?'selected':''}}>{{$elect->title}}</option>
                                            @endforeach
                                        </select>
                                        <button class="btn btn-outline-primary" id="button-addon2" type="submit">GO</button>
                                    </div>
                                </div>
                                </form>
                               </div>
                           </div>
                        </div>
                    </div>
                </div>
                @endif

                @if(@$election)
                <!-- Basic table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title text-center mx-auto">{{$election->title}} General Election - Election Return</h4>
                                </div>
                                <hr style="margin-top: -10px;">
                                <div class="card-body"  style="margin-top: -20px;">

                                    @php
                                        $posts = App\Models\Forms::where('election_id',$election->id)->get();
                                    @endphp

                                    @foreach ($posts as $key => $post)



                                    {{-- table start --}}
                                    <div class="table-responsive mb-50"  style=" border: 1px solid black;">
                                        <table class="table table-striped table-hover-animation">
                                            <thead class="table-dark">
                                                <tr>
                                                    {{-- <th style="width: 10%"></th> --}}
                                                    <th style="width: 30%"></th>
                                                    <th style="width: 40%; text-align: center;">{{$post['position']['name']}}</th>
                                                    <th style="width: 15%;"></th>
                                                    <th style="width: 30%;">Winner</th>

                                                </tr>

                                            </thead>
                                            <tbody>
                                                @php
                                                    $contestants = App\Models\FormCheck::where('election_id',$election->id)->where('post_id',$post['position']['id'])->get();
                                                @endphp

                                                @foreach ($contestants->sortBy('') as $num => $contestant)

                                                @php
                                                  $votes = App\Models\Cast::where('election_id',$election->id)->where('post_id',$post['position']['id'])->where('contestant_id',$contestant['user']['id'])->get()->count();
                                                  $total = DB::table('casts')->where('election_id',$election->id)->where('post_id',$post['position']['id'])->whereNotNull('contestant_id')->get()->count();
                                                @endphp

                                                <tr>

                                                    <td>
                                                        <h5>{{$contestant['user']['first_name']}} {{$contestant['user']['middle_name']}} {{$contestant['user']['last_name']}}</h5>
                                                     </td>

                                                    <td>
                                                        <div class="progress progress-bar-primary">
                                                            <div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="25" aria-valuemax="100" style="width: {{number_format($votes/$total*100,0)}}%">
                                                                {{number_format($votes/$total*100,0)}}%
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{$votes}} Votes</td>
                                                    @php
                                                         $check = App\Models\Winner::where('election_id',$election->id)->where('post_id',$post['position']['id'])->first();
                                                    @endphp

                                                    <td>
                                                        @if(!$check)
                                                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#danger{{$num}}{{$key}}">
                                                        Declare
                                                        </button>
                                                        @else
                                                        @if($check->contestant_id == $contestant['user']['id'])
                                                        <span class="badge badge-glow bg-success">WINNER</span>
                                                        @endif
                                                        @endif

                                                     </td>
                                                </tr>

                                                @if($loop->last)
                                                <tr>
                                                    <td></td>
                                                    <td style="text-align:right;">Total Votes</td>
                                                    <td>{{@$total}}  </td>
                                                </tr>
                                                @endif

                                                    <!-- Modal -->
                                                <div class="modal fade modal-danger text-start" id="danger{{$num}}{{$key}}" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="myModalLabel120">Declare {{$contestant['user']['first_name']}} {{$contestant['user']['middle_name']}} {{$contestant['user']['last_name']}} Winner for the post of {{$post['position']['name']}}?</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                               <p><strong>Post:</strong> {{$post['position']['name']}}</p>
                                                               <p><strong>Total Votes Casted:</strong> {{@$total}}</p>
                                                               <p><strong>Votes Obtained:</strong> {{@$votes}}</p>
                                                            </div>
                                                            <form action="{{route('return.exco')}}" method="post">
                                                                @csrf
                                                                <input type="hidden" value="{{$election->id}}" name="election_id">
                                                                <input type="hidden" value="{{$post['position']['id']}}" name="post_id">
                                                                <input type="hidden" value="{{$contestant['user']['id']}}" name="contestant_id">
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-danger">Declare {{$contestant['user']['first_name']}} {{$contestant['user']['last_name']}} Winner</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                @endif
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
