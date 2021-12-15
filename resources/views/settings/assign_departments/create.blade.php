@extends('layouts.master')
@section('PageTitle', 'Assign Department')
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
                                <h4 class="card-title pull-left">Assign Departments</h4>
                                <a href="{{route('department.create')}}" class="btn btn-info  pull-right"><i data-feather="list" class="me-25"></i>Assigned Department List</a>
                            </div>
                            <hr style="margin-top: -10px;">
                            <div class="card-body">

                                <form class="form-horizontal" id="quickForm" method="POST" action="{{(@$editData?route('assign.department.store',$editData->id):route('assign.department.store'))}}">                            @csrf
                                    @if (@isset($editData))
                                    @method('PATCH')
                                    @endif
                                <div class="add_item">
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="itemquantity">Faculty</label>
                                                <select name="faculty_id" class="form-control" required>
                                                    <option value="">Select Faculty</option>
                                                    @foreach ($faculties as $faculty)
                                                    <option value="{{$faculty->id}}">{{$faculty->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="itemquantity">Department</label>
                                                <select name="department_id[]" class="form-control" required>
                                                    <option value="">Select Department</option>
                                                    @foreach($departments as $department)
                                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-1" style="padding-top: 27px;">
                                            <span class="btn btn-success btn-sm addeventmore"><i data-feather="plus" class="me-25"></i></span>
                                        </div>

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
                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <select name="department_id[]" class="form-control" required>
                                                <option value="">Select Department</option>
                                                @foreach($departments as $department)
                                                <option value="{{$department->id}}">{{$department->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-1" style="padding-top: 0px;">
                                        <span class="btn btn-success btn-sm addeventmore"><i data-feather="plus" class="me-25"></i></span>
                                    </div>

                                    <div class="col-md-1" style="padding-top: 0px; margin-left: -30px;">
                                        <span class="btn btn-danger btn-sm removeeventmore"><i data-feather="minus" class="me-25"></i></span>
                                    </div>

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
