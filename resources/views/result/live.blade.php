@extends('layouts.master')
@section('PageTitle', 'Live Result')
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
                                <form action="{{route('live.result.search')}}" method="post">
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
                                    <h4 class="card-title text-center mx-auto">{{$election->title}} General Election - Live Result</h4>
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
                                                    <th style="width: 20%"></th>
                                                    <th style="width: 10%;"></th>
                                                    <th style="width: 50%; text-align: center;">{{$post['position']['name']}}</th>
                                                    <th style="width: 20%;"></th>
                                                </tr>

                                            </thead>
                                            <tbody>
                                                @php
                                                    $contestants = App\Models\FormCheck::where('election_id',$election->id)->where('post_id',$post['position']['id'])->where('qualify',1)->get();
                                                @endphp

                                                @foreach ($contestants->sortBy('first_name') as $num => $contestant)

                                                @php
                                                  $votes = App\Models\Cast::where('election_id',$election->id)->where('post_id',$post['position']['id'])->where('contestant_id',$contestant['user']['id'])->get()->count();
                                                  $total = DB::table('casts')->where('election_id',$election->id)->where('post_id',$post['position']['id'])->whereNotNull('contestant_id')->get()->count();
                                                @endphp

                                                <tr>

                                                    <td>
                                                        <h5>{{$contestant['user']['first_name']}} {{$contestant['user']['middle_name']}} {{$contestant['user']['last_name']}} ({{$contestant['user']['nickname']}})</h5>
                                                     </td>

                                                     <td>
                                                        <div class="avatar-group">
                                                            <div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up my-0" title="{{$contestant['user']['nickname']}}">
                                                                <img src="/uploads/users/{{$contestant['user']['image']}}" alt="Avatar" height="60" width="60" />
                                                            </div>
                                                        </div>
                                                     </td>

                                                    <td>
                                                        <div class="progress progress-bar-primary">
                                                            <div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="25" aria-valuemax="100" style="width: {{number_format($votes/$total*100,0)}}%">
                                                                {{number_format($votes/$total*100,0)}}%
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{$votes}} Votes</td>

                                                </tr>

                                                @if($loop->last)
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td style="text-align:right;">Total Votes</td>
                                                    <td>{{@$total}}  </td>
                                                </tr>
                                                @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    @endforeach

                                    @if(Auth::user()->role != 'sa')

                                    @if($election->sra == 'all')
                                     {{-- Faculty row --}}

                                            <div class="table-responsive mb-50"  style=" border: 1px solid black;">
                                                <table class="table table-striped table-hover-animation">
                                                    <thead class="table-dark">
                                                        <tr>
                                                            {{-- <th style="width: 10%"></th> --}}
                                                            <th style="width: 20%"></th>
                                                            <th style="width: 10%"></th>
                                                            <th style="width: 50%; text-align: center;">Faculty Senator</th>
                                                            <th style="width: 20%;"></th>

                                                        </tr>
                                                    </thead>
                                                <tbody>
                                            @php
                                             $reg = explode("/", auth()->user()->reg_number);
                                             $fac =  $reg[0];
                                            $contestants = App\Models\SRACandidates::where('election_id',$election->id)->where('type','faculty')->where('code',$fac)->where('qualify',1)->get();
                                            @endphp

                                            @foreach ($contestants as $num => $contestant)

                                            @php
                                            $votes = App\Models\SRAVotes::where('election_id',$election->id)->where('type','faculty')->where('contestant_id',$contestant->user_id)->get()->count();
                                            $total = DB::table('s_r_a_votes')->where('election_id',$election->id)->where('type','faculty')->where('code',$fac)->whereNotNull('contestant_id')->get()->count();
                                            @endphp

                                            <tr>
                                                <td>
                                                    <h5>{{$contestant['user']['first_name']}} {{$contestant['user']['middle_name']}} {{$contestant['user']['last_name']}} ({{$contestant['user']['nickname']}})</h5>
                                                </td>

                                                <td>
                                                    <div class="avatar-group">
                                                        <div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up my-0" title="{{$contestant['user']['nickname']}}">
                                                            <img src="/uploads/users/{{$contestant['user']['image']}}" alt="Avatar" height="60" width="60" />
                                                        </div>
                                                    </div>
                                                 </td>

                                                <td>
                                                    <div class="progress progress-bar-primary">
                                                        <div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="25" aria-valuemax="100" style="width: {{number_format($votes/$total*100,0)}}%">
                                                            {{number_format($votes/$total*100,0)}}%
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{$votes}} Votes</td>
                                            </tr>

                                            @if($loop->last)
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td style="text-align:right;">Total Votes</td>
                                                <td>{{@$total}}  </td>
                                            </tr>
                                            @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{-- Faculty End --}}
                                    @endif

                                            @if($election->sra == 'all' || $election->sra == 'one')
                                            {{-- Department row --}}

                                            <div class="table-responsive mb-50"  style=" border: 1px solid black;">
                                                <table class="table table-striped table-hover-animation">
                                                    <thead class="table-dark">
                                                        <tr>
                                                            {{-- <th style="width: 10%"></th> --}}
                                                            <th style="width: 20%"></th>
                                                            <th style="width: 10%"></th>
                                                            <th style="width: 50%; text-align: center;">Departmental Senator</th>
                                                            <th style="width: 20%;"></th>

                                                        </tr>
                                                    </thead>
                                                <tbody>
                                            @php
                                             $reg = explode("/", auth()->user()->reg_number);
                                             $dept =  $reg[2];
                                            $contestants = App\Models\SRACandidates::where('election_id',$election->id)->where('type','department')->where('code',$dept)->get();
                                            @endphp

                                            @foreach ($contestants as $num => $contestant)

                                            @php
                                            $votes = App\Models\SRAVotes::where('election_id',$election->id)->where('type','department')->where('contestant_id',$contestant->user_id)->get()->count();
                                            $total = DB::table('s_r_a_votes')->where('election_id',$election->id)->where('type','department')->where('code',$dept)->whereNotNull('contestant_id')->get()->count();
                                            @endphp

                                            <tr>
                                                <td>
                                                    <h5>{{$contestant['user']['first_name']}} {{$contestant['user']['middle_name']}} {{$contestant['user']['last_name']}} ({{$contestant['user']['nickname']}})</h5>
                                                </td>
                                                <td>
                                                    <div class="avatar-group">
                                                        <div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up my-0" title="{{$contestant['user']['nickname']}}">
                                                            <img src="/uploads/users/{{$contestant['user']['image']}}" alt="Avatar" height="60" width="60" />
                                                        </div>
                                                    </div>
                                                 </td>
                                                <td>
                                                    <div class="progress progress-bar-primary">
                                                        <div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="25" aria-valuemax="100" style="width: {{number_format($votes/$total*100,0)}}%">
                                                            {{number_format($votes/$total*100,0)}}%
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{$votes}} Votes</td>
                                            </tr>
                                            @if($loop->last)
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td style="text-align:right;">Total Votes</td>
                                                <td>{{@$total}}  </td>
                                            </tr>
                                            @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{-- Department End --}}
                                    @endif
                                    @endif

                                    <div class="col-12">
                                        <p>Last Refreshed: {{now()}}</p>

                                        <form action="{{route('live.result.search')}}" method="post">
                                            @csrf

                                                <input type="hidden" value="{{$election->id}}" name="election_id">
                                                <button class="btn btn-info me-1" id="button-addon2" type="submit">Refresh</button>

                                        </form>

                                    </div>
                                    {{-- table end --}}
                                {{-- </form> --}}

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
