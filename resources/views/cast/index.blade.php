@extends('layouts.master')
@section('PageTitle', 'Cast Vote')
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
                            <div class="row">

                    @if(@!$election)
                        <div class="col-12 mt-5">
                            <div class="row">
                                <form action="{{route('vote.search')}}" method="post">
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
                        @endif

                          @if(@$election)
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title text-center mx-auto">{{$election->title}} General Election</h4>
                                </div>
                                <hr style="margin-top: -10px;">
                                <div class="card-body"  style="margin-top: -20px;">
                                <form class="form form-vertical" action="{{route('cast.submit')}}" method="post">
                                    @csrf
                                    @php
                                        $posts = App\Models\Forms::where('election_id',$election->id)->get();
                                    @endphp

                                    @foreach ($posts as $key => $post)

                                    <input type="hidden" value="{{$election->id}}" name="election_id">

                                    <input type="hidden" name="posts[]" value="{{$key+1}}">

                                    {{-- table start --}}
                                    <div class="table-responsive mb-50"  style=" border: 1px solid black;">
                                        <table class="table table-striped table-hover-animation">
                                            <thead class="table-dark">
                                                <tr>
                                                    {{-- <th style="width: 10%"></th> --}}
                                                    <th style="width: 35%"></th>
                                                    <th style="width: 30%; text-align: center;">{{$post['position']['name']}}</th>
                                                    <th style="width: 20%"></th>
                                                    <th style="width: 15%"></th>
                                                </tr>

                                            </thead>
                                            <tbody>
                                                @php
                                                 $contestants = App\Models\FormCheck::where('election_id',$election->id)->where('post_id',$post['position']['id'])->where('qualify',1)->whereHas('user', function ($query)  {
                                                        $query->orderBy('first_name','desc');
                                                    })->get();

                                                @endphp

                                                @foreach ($contestants as $num => $contestant)


                                                <tr>
                                                    <td>
                                                        <h5>{{$contestant['user']['first_name']}} {{$contestant['user']['middle_name']}} {{$contestant['user']['last_name']}}</h5>
                                                     </td>

                                                    <td><h5>{{$contestant['user']['nickname']}}</h5></td>
                                                    <td>

                                                        <div class="avatar-group">
                                                            <div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up my-0" title="{{$contestant['user']['nickname']}}">
                                                                <img src="/uploads/users/{{$contestant['user']['image']}}" alt="Avatar" height="60" width="60" />
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check form-check-success">
                                                            <input type="radio" value="{{$contestant['user']['id']}}" id="post" name="contestant_id{{$key}}" class="form-check-input" {{($settings->force=='on')?'required':''}}/>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    @endforeach
                                    @if($election->sra == 'all')
                                    {{-- Faculty Senator --}}
                                    <div class="table-responsive mb-50"  style=" border: 1px solid black;">
                                        <table class="table table-striped table-hover-animation">
                                            <thead class="table-dark">
                                                <tr>
                                                    {{-- <th style="width: 10%"></th> --}}
                                                    <th style="width: 35%"></th>
                                                    <th style="width: 30%; text-align: center;">Faculty Senator</th>
                                                    <th style="width: 20%"></th>
                                                    <th style="width: 15%"></th>
                                                </tr>

                                            </thead>
                                            <tbody>
                                                @php
                                                    $reg = explode("/", auth()->user()->reg_number);
                                                    $fac =  $reg[0];
                                                    $contestants = App\Models\SRACandidates::where('election_id',$election->id)->where('type','faculty')->where('qualify',1)->where('code',$fac)->get();
                                                @endphp

                                                @foreach ($contestants as $fac => $contestant)


                                                <tr>
                                                    <td>
                                                        <h5>{{$contestant['user']['first_name']}} {{$contestant['user']['middle_name']}} {{$contestant['user']['last_name']}}</h5>
                                                     </td>

                                                    <td><h5>{{$contestant['user']['nickname']}}</h5></td>
                                                    <td>

                                                        <div class="avatar-group">
                                                            <div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up my-0" title="{{$contestant['user']['nickname']}}">
                                                                <img src="/uploads/users/{{$contestant['user']['image']}}" alt="Avatar" height="60" width="60" />
                                                            </div>

                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check form-check-success">
                                                            <input type="hidden" value="faculty" name="type">
                                                            @php
                                                                  $split = explode("/", auth()->user()->reg_number);
                                                                  $code =  $split[0];
                                                            @endphp
                                                            <input type="hidden" value="{{$code}}" name="code">
                                                            <input type="radio" value="{{$contestant['user']['id']}}" id="post" name="faculty{{$key}}" class="form-check-input"  {{($settings->force=='on')?'required':''}} />
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @endif

                                    @if($election->sra == 'one' || $election->sra == 'all')
                                    {{-- Faculty Senator --}}
                                    <div class="table-responsive mb-50"  style=" border: 1px solid black;">
                                        <table class="table table-striped table-hover-animation">
                                            <thead class="table-dark">
                                                <tr>
                                                    {{-- <th style="width: 10%"></th> --}}
                                                    <th style="width: 35%"></th>
                                                    <th style="width: 30%; text-align: center;">Departmental Senator</th>
                                                    <th style="width: 20%"></th>
                                                    <th style="width: 15%"></th>
                                                </tr>

                                            </thead>
                                            <tbody>
                                                @php
                                                    $reg = explode("/", auth()->user()->reg_number);
                                                    $dept =  $reg[2];
                                                    $contestants = App\Models\SRACandidates::where('election_id',$election->id)->where('type','department')->where('qualify',1)->where('code',$dept)->get();
                                                @endphp

                                                @foreach ($contestants as $dept => $contestant)


                                                <tr>
                                                    <td>
                                                        <h5>{{$contestant['user']['first_name']}} {{$contestant['user']['middle_name']}} {{$contestant['user']['last_name']}}</h5>
                                                     </td>

                                                    <td><h5>{{$contestant['user']['nickname']}}</h5></td>
                                                    <td>

                                                        <div class="avatar-group">
                                                            <div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up my-0" title="{{$contestant['user']['nickname']}}">
                                                                <img src="/uploads/users/{{$contestant['user']['image']}}" alt="Avatar" height="60" width="60" />
                                                            </div>

                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check form-check-success">
                                                            <input type="hidden" value="department" name="type">
                                                            @php
                                                                  $split1 = explode("/", auth()->user()->reg_number);
                                                                  $code1 =  $split1[2];
                                                            @endphp
                                                            <input type="hidden" value="{{$code1}}" name="code1">
                                                            <input type="radio" value="{{$contestant['user']['id']}}" name="departmental{{$key}}" class="form-check-input"  {{($settings->force=='on')?'required':''}} />
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @endif

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-danger me-1">Submit</button>
                                        <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                    </div>
                                    {{-- table end --}}
                                </form>

                                </div>
                            </div>
                        </div>
                        @endif
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
