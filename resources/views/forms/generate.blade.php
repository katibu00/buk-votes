@extends('layouts.master')
@section('PageTitle', 'Generate Forms')
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
                                <h4 class="card-title pull-left">Generate Forms</h4>
                                <a href="{{route('forms.index')}}" class="btn btn-info  pull-right"><i data-feather="list" class="me-25"></i>Form Lists</a>
                            </div>
                            <hr style="margin-top: -10px;">
                            <div class="card-body">

                                <form class="form-horizontal" method="POST" action="{{route('generate.form.store')}}">
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

                                            <div class="col-md-3 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="start_date">Start Date</label>
                                                    <input type="date" class="form-control" id="start_date" name="start_date" name="cost" aria-describedby="start_date" required/>
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="end_date">End Date</label>
                                                    <input type="date" class="form-control" id="end_date" name="end_date" aria-describedby="end_date" required/>
                                                </div>
                                            </div>


                                        </div>
                                        <hr />
                                    </div>


                                    <div class="row">
                                        <div class="row d-flex align-items-end">
                                            <div class="col-md-3 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="itemname">Post</label>
                                                    <select name="post_id[]" class="form-control" required>
                                                        <option value=""></option>
                                                        @foreach ($posts as $post)
                                                        <option value="{{$post->id}}">{{$post->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-2 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="itemcost">Level</label>
                                                    <select name="level[]" class="form-control" required>
                                                        <option value=""></option>
                                                        <option value="1">100L</option>
                                                        <option value="2">200L</option>
                                                        <option value="3">300L</option>
                                                        <option value="4">400L</option>
                                                        <option value="5">500L</option>
                                                        <option value="6">600L</option>

                                                    </select>
                                                  </div>
                                            </div>

                                            <div class="col-md-2 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="cgpa">Minimun CGPA</label>
                                                    <input type="text" class="form-control" id="cgpa" name="cgpa[]" max="5" aria-describedby="cgpa" required/>
                                                </div>
                                            </div>

                                            <div class="col-md-2 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="price">Form Price</label>
                                                    <input type="number"  class="form-control" name="price[]" id="price" required/>
                                                </div>
                                            </div>

                                            <div class="col-md-2 col-12 mb-50">
                                                <div class="mb-1">
                                                    <span class="btn btn-success btn-sm addeventmore"><i data-feather="plus" class="me-25"></i></span>
                                                    <span class="btn btn-danger btn-sm removeeventmore"><i data-feather="minus" class="me-25"></i></span>
                                                </div>

                                            </div>
                                        </div>
                                        <hr />
                                    </div>

                                </div>

                                <button type="submit" class="btn btn-info">{{(@$editData)?'Update':'Submit'}}</button>
                                <span style="color: red">{{($errors->has('name'))?($errors->first('name')):''}}</span>
                              </form>

                            </div>
                        </div>
                    </div>
                    <!-- /Invoice repeater -->

                    <div style="visibility: hidden;">
                        <div class="whole_extra_item_add" id="whole_extra_item_add">
                            <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">

                            <div class="row">
                                <div class="row d-flex align-items-end">
                                    <div class="col-md-3 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="itemname">Post</label>
                                            <select name="post_id[]" class="form-control" required>
                                                <option value=""></option>
                                                @foreach ($posts as $post)
                                                <option value="{{$post->id}}">{{$post->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="itemcost">Level</label>
                                            <select name="level[]" class="form-control" required>
                                                <option value=""></option>
                                                <option value="1">100L</option>
                                                <option value="2">200L</option>
                                                <option value="3">300L</option>
                                                <option value="4">400L</option>
                                                <option value="5">500L</option>
                                                <option value="6">600L</option>

                                            </select>
                                          </div>
                                    </div>

                                    <div class="col-md-2 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="cgpa">Minimun CGPA</label>
                                            <input type="text" class="form-control" id="cgpa" name="cgpa[]" max="5" aria-describedby="cgpa" required/>
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="price">Form Price</label>
                                            <input type="number"  class="form-control" name="price[]" id="price" required/>
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-12 mb-50">
                                        <div class="mb-1">
                                            <span class="btn btn-success btn-sm addeventmore"><i data-feather="plus" class="me-25"></i></span>
                                            <span class="btn btn-danger btn-sm removeeventmore"><i data-feather="minus" class="me-25"></i></span>
                                        </div>

                                    </div>
                                </div>
                                <hr />
                            </div>
                             </div>
                            </div>
                        </div>
                 </div>

                </div>
            </section>

        </div>
    </div>
</div>
<!-- END: Content-->

@endsection

@section('js')

<script type="text/javascript">
    $(document).ready(function(){
        var counter = 0;
        $(document).on("click",".addeventmore", function(){
            var whole_extra_item_add = $("#whole_extra_item_add").html();
            $(this).closest(".add_item").append(whole_extra_item_add);
            counter++
        });
        $(document).on("click", ".removeeventmore", function(event){
             $(this).closest(".delete_whole_extra_item_add").remove();
             counter -= 1;
        });
    });
</script>


@endsection
