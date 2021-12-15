@extends('layouts.master')
@section('PageTitle', 'Generate SRA Forms')
@section('content')
 <!-- BEGIN: Content-->
  <div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">

        <div class="content-body">
            <section class="form-control-repeater">
                <div class="row">
                    <!-- Invoice repeater -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title pull-left">Generate SRA Forms</h4>
                                <a href="{{route('forms.index')}}" class="btn btn-info  pull-right"><i data-feather="list" class="me-25"></i>Form Lists</a>
                            </div>
                            <hr style="margin-top: -10px;">
                            <div class="card-body">

                                <form class="form-horizontal" method="POST" action="{{(@$editData)? route('generate.form.sra.update',@$editData->id) : route('generate.form.sra.store',$id) }}">
                                   @csrf

                                <div class="add_item">
                                    <div class="row">
                                     <div class="row d-flex align-items-end">
                                            <div class="col-md-3 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="election">Election</label>
                                                    <select name="election_id" class="form-control" required>
                                                        <option value=""></option>
                                                        @foreach ($elections as $election)
                                                        <option value="{{$election->id}}" {{$id == $election->id?'selected':''}}>{{$election->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                        </div>
                                        <hr />
                                    </div>

                                    @php
                                    $elect = App\Models\Election::findorFail($id);
                                    @endphp
                                    @if($elect->sra == 'all')
                                    <div class="row">
                                        <div class="row d-flex align-items-end">
                                            <div class="col-md-3 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="itemname">Post</label>
                                                    <select name="type[]" class="form-control" required>
                                                        <option value="faculty">Faculty Senator</option>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-2 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="itemcost">Level</label>
                                                    <select name="level[]" class="form-control" required>
                                                        <option value=""></option>
                                                        <option value="1" {{@$editData->level == '1'? 'selected':''}}>100L</option>
                                                        <option value="2" {{@$editData->level == '2'? 'selected':''}}>200L</option>
                                                        <option value="3" {{@$editData->level == '3'? 'selected':''}}>300L</option>
                                                        <option value="4" {{@$editData->level == '4'? 'selected':''}}>400L</option>
                                                        <option value="5" {{@$editData->level == '5'? 'selected':''}}>500L</option>
                                                        <option value="6" {{@$editData->level == '6'? 'selected':''}}>600L</option>
                                                    </select>
                                                  </div>
                                            </div>

                                            <div class="col-md-2 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="cgpa">Minimun CGPA</label>
                                                    <input type="text" class="form-control" id="cgpa" name="cgpa[]" max="5" aria-describedby="cgpa" value="{{@$editData->cgpa}}" required/>
                                                </div>
                                            </div>

                                            <div class="col-md-2 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="price">Form Price</label>
                                                    <input type="number"  class="form-control" name="price[]" id="price" value="{{@$editData->price}}" required/>
                                                </div>
                                            </div>

                                        </div>
                                        <hr />
                                    </div>
                                    @endif
                                    {{-- @php
                                        $elect = App\Models\Election::findorFail($id);
                                    @endphp
                                    @if($elect->sra == 'all') --}}
                                     <div class="row">
                                        <div class="row d-flex align-items-end">
                                            <div class="col-md-3 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="itemname">Post</label>
                                                    <select name="type[]" class="form-control" required>
                                                        <option value="department">Departmental Senator</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-2 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="itemcost">Level</label>
                                                    <select name="level[]" class="form-control" required>
                                                        <option value=""></option>
                                                        <option value="1" {{@$editData->level == '1'? 'selected':''}}>100L</option>
                                                        <option value="2" {{@$editData->level == '2'? 'selected':''}}>200L</option>
                                                        <option value="3" {{@$editData->level == '3'? 'selected':''}}>300L</option>
                                                        <option value="4" {{@$editData->level == '4'? 'selected':''}}>400L</option>
                                                        <option value="5" {{@$editData->level == '5'? 'selected':''}}>500L</option>
                                                        <option value="6" {{@$editData->level == '6'? 'selected':''}}>600L</option>
                                                    </select>
                                                  </div>
                                            </div>

                                            <div class="col-md-2 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="cgpa">Minimun CGPA</label>
                                                    <input type="text" class="form-control" id="cgpa" name="cgpa[]" max="5" aria-describedby="cgpa" value="{{@$editData->cgpa}}" required/>
                                                </div>
                                            </div>

                                            <div class="col-md-2 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="price">Form Price</label>
                                                    <input type="number"  class="form-control" name="price[]" id="price" value="{{@$editData->price}}" required/>
                                                </div>
                                            </div>

                                        </div>
                                        <hr />
                                        {{-- @endif --}}

                                </div>

                                <button type="submit" class="btn btn-info">{{(@$editData)?'Update':'Submit'}}</button>
                                <span style="color: red">{{($errors->has('name'))?($errors->first('name')):''}}</span>
                              </form>

                            </div>
                        </div>
                    </div>
                    <!-- /Invoice repeater -->

                </div>
            </section>

        </div>
    </div>
</div>
<!-- END: Content-->


@endsection
