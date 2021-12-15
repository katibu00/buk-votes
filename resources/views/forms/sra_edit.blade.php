@extends('layouts.master')
@section('PageTitle', 'Edit SRA Forms')
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
                                <h4 class="card-title pull-left">Edit SRA Forms</h4>
                                <a href="{{route('forms.index')}}" class="btn btn-info  pull-right"><i data-feather="list" class="me-25"></i>Form Lists</a>
                            </div>
                            <hr style="margin-top: -10px;">
                            <div class="card-body">

                                <form class="form-horizontal" method="POST" action="{{route('generate.form.sra.update',$id) }}">
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

                                    @php
                                          $faculty =  App\Models\SRAForm::where('election_id',$id)->where('type','faculty')->first();
                                    @endphp
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
                                                        <option value="1" {{$faculty->level == '1'? 'selected':''}}>100L</option>
                                                        <option value="2" {{$faculty->level == '2'? 'selected':''}}>200L</option>
                                                        <option value="3" {{$faculty->level == '3'? 'selected':''}}>300L</option>
                                                        <option value="4" {{$faculty->level == '4'? 'selected':''}}>400L</option>
                                                        <option value="5" {{$faculty->level == '5'? 'selected':''}}>500L</option>
                                                        <option value="6" {{$faculty->level == '6'? 'selected':''}}>600L</option>
                                                    </select>
                                                  </div>
                                            </div>

                                            <div class="col-md-2 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="cgpa">Minimun CGPA</label>
                                                    <input type="text" class="form-control" id="cgpa" name="cgpa[]" max="5" aria-describedby="cgpa" value="{{@$faculty->cgpa}}" required/>
                                                </div>
                                            </div>

                                            <div class="col-md-2 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="price">Form Price</label>
                                                    <input type="number"  class="form-control" name="price[]" id="price" value="{{@$faculty->price}}" required/>
                                                </div>
                                            </div>

                                        </div>
                                        <hr />
                                    </div>
                                    @endif

                                    @php
                                      $dept = App\Models\SRAForm::where('election_id',$id)->where('type','department')->first();
                                    @endphp
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
                                                        <option value="1" {{@$dept->level == '1'? 'selected':''}}>100L</option>
                                                        <option value="2" {{@$dept->level == '2'? 'selected':''}}>200L</option>
                                                        <option value="3" {{@$dept->level == '3'? 'selected':''}}>300L</option>
                                                        <option value="4" {{@$dept->level == '4'? 'selected':''}}>400L</option>
                                                        <option value="5" {{@$dept->level == '5'? 'selected':''}}>500L</option>
                                                        <option value="6" {{@$dept->level == '6'? 'selected':''}}>600L</option>
                                                    </select>
                                                  </div>
                                            </div>

                                            <div class="col-md-2 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="cgpa">Minimun CGPA</label>
                                                    <input type="text" class="form-control" id="cgpa" name="cgpa[]" max="5" aria-describedby="cgpa" value="{{@$dept->cgpa}}" required/>
                                                </div>
                                            </div>

                                            <div class="col-md-2 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="price">Form Price</label>
                                                    <input type="number"  class="form-control" name="price[]" id="price" value="{{@$dept->price}}" required/>
                                                </div>
                                            </div>

                                        </div>
                                        <hr />


                                </div>

                                <button type="submit" class="btn btn-info">Update</button>
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
