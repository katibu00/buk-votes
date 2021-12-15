@extends('layouts.master')
@section('PageTitle', 'Create New Election')
@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">

            <div class="content-body">
                <!-- Basic Horizontal form layout section start -->
                <section id="basic-horizontal-layouts">
                    <div class="row">
                        <div class="col-md-12 col-12 mx-auto">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title pull-left">
                                    @if(isset($editData))
                                        Edit Election: {{@$editData->title}}
                                    @else
                                        Add New Election
                                    @endif </h4>
                                    <a href="{{route('election.index')}}" class="btn btn-info  pull-right"><i data-feather='list'></i><span>Election List</span></a>
                                </div>
                                <hr style="margin-top: -10px;">
                                <div class="card-body">
                                    <form class="form form-horizontal" action="{{(@$editData)? route('election.update',@$editData->id) : route('election.store') }} " method="post">
                                        @csrf
                                        @if(@$editData) @method('PATCH') @endif
                                        <div class="row">
                                            <div class="col-xl-4 col-md-6 col-12">
                                                <div class="mb-1 row">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="title">Election Title</label>
                                                        <input type="text" class="form-control" id="title" name="title" value="{{@$editData->title}}" placeholder="Enter Election Title" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-4 col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="">Election Committee</label>
                                                    <select name="elcom" class="form-control" required>
                                                        <option value=""></option>
                                                        @foreach ($elcoms as $elcom)
                                                        <option value="{{$elcom->id}}" {{@$editData->elcom_id == $elcom->id? 'selected':''}}>{{$elcom->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-xl-4 col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="address">SRA</label>
                                                    <select name="sra" class="form-control" required>
                                                        <option value=""></option>
                                                        <option value="none" {{@$editData->sra == 'none'? 'selected':''}}>None</option>
                                                        <option value="all" {{@$editData->sra == 'all'? 'selected':''}}>Faculty + Departmental</option>
                                                        <option value="one" {{@$editData->sra == 'one'? 'selected':''}}>Departmental</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-xl-4 col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="start_date">Start Date</label>
                                                    <input type="date" class="form-control" id="start_date" value="{{@$editData->start_date}}" name="start_date" />
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="start_time">Start Time</label>
                                                    <input type="time" class="form-control" id="start_time" value="{{@$editData->start_time}}" name="start_time" />
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="end_date">End Date</label>
                                                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{@$editData->end_date}}"/>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="endtime">End Time</label>
                                                    <input type="time" class="form-control" id="endtime" name="end_time" value="{{@$editData->end_time}}" />
                                                </div>
                                            </div>

                                            <div class="col-xl-4 col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="basicInput">Faculty</label>
                                                    <select name="faculty" id="faculty" class="form-control" required>
                                                        <option value=""></option>
                                                        <option value="all" {{@$editData->faculty == 'all'? 'selected':''}}>All</option>
                                                        @foreach ($faculties as $faculty)
                                                        <option value="{{$faculty->id}}" {{@$editData->faculty == $faculty->id? 'selected':''}}>{{$faculty->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="department">Department</label>
                                                    <select name="department" id="department" class="form-control" required>
                                                        {{-- <option value=""></option>
                                                        <option value="all"  {{@$editData->department == 'all'? 'selected':''}}>All</option>
                                                        @foreach ($departments as $department)
                                                        <option value="{{$department->id}}" {{@$editData->department == $department->id? 'selected':''}} >{{$department->name}}</option>
                                                        @endforeach --}}
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="basicInput">State</label>
                                                    <select
                                                    onchange="toggleLGA(this);"
                                                    name="state"
                                                    id="state"
                                                    class="form-control mb-3"
                                                    >
                                                    <option value="" selected="selected">- Select State-</option>
                                                    <option value="All"  {{@$editData->state == 'All'? 'selected':''}}>All</option>
                                                    <option value="Abia">Abia</option>
                                                    <option value="Adamawa">Adamawa</option>
                                                    <option value="AkwaIbom">AkwaIbom</option>
                                                    <option value="Anambra">Anambra</option>
                                                    <option value="Bauchi">Bauchi</option>
                                                    <option value="Bayelsa">Bayelsa</option>
                                                    <option value="Benue">Benue</option>
                                                    <option value="Borno">Borno</option>
                                                    <option value="Cross River">Cross River</option>
                                                    <option value="Delta">Delta</option>
                                                    <option value="Ebonyi">Ebonyi</option>
                                                    <option value="Edo">Edo</option>
                                                    <option value="Ekiti">Ekiti</option>
                                                    <option value="Enugu">Enugu</option>
                                                    <option value="FCT">FCT</option>
                                                    <option value="Gombe">Gombe</option>
                                                    <option value="Imo">Imo</option>
                                                    <option value="Jigawa">Jigawa</option>
                                                    <option value="Kaduna">Kaduna</option>
                                                    <option value="Kano">Kano</option>
                                                    <option value="Katsina">Katsina</option>
                                                    <option value="Kebbi">Kebbi</option>
                                                    <option value="Kogi">Kogi</option>
                                                    <option value="Kwara">Kwara</option>
                                                    <option value="Lagos">Lagos</option>
                                                    <option value="Nasarawa">Nasarawa</option>
                                                    <option value="Niger">Niger</option>
                                                    <option value="Ogun">Ogun</option>
                                                    <option value="Ondo">Ondo</option>
                                                    <option value="Osun">Osun</option>
                                                    <option value="Oyo">Oyo</option>
                                                    <option value="Plateau">Plateau</option>
                                                    <option value="Rivers">Rivers</option>
                                                    <option value="Sokoto">Sokoto</option>
                                                    <option value="Taraba">Taraba</option>
                                                    <option value="Yobe">Yobe</option>
                                                    <option value="Zamfara">Zamafara</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="basicInput">LGA</label>
                                                    <select
                                                        name="lga"
                                                        id="lga"
                                                        class="form-control select-lga mb-3"
                                                        required
                                                    >
                                                    </select>
                                                </div>
                                            </div>
                                  

                                            <div class="col-xl-4 col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="account_name">Account Name</label>
                                                    <input type="text" class="form-control" id="account_name" name="account_name" placeholder="Account Name" value="{{@$editData->account_name}}"/>
                                                </div>
                                            </div>

                                            <div class="col-xl-4 col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="account_number">Account Number</label>
                                                    <input type="text" class="form-control" id="account_number" name="account_number" placeholder="Account Number[Bank Name]"  value="{{@$editData->account_number}}"/>
                                                </div>
                                            </div>

                                            <div class="col-xl-4 col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="phone">Contact Number</label>
                                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Contact Phone Number" value="{{@$editData->phone}}"/>
                                                </div>
                                            </div>

                                            <div class="col-xl-4 col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="email">Contact Email</label>
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Contact Email" value="{{@$editData->email}}" />
                                                </div>
                                            </div>

                                            <div class="col-xl-12 col-md-12 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="address">Contact Address</label>
                                                    <input type="text" class="form-control" id="address" name="address" placeholder="Contact Address" value="{{@$editData->address}}"/>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-4 col-md-6 col-12">
                                                    <button type="submit" class="btn btn-primary me-1">{{(@$editData)?'Update':'Submit'}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>
                <!-- Basic Horizontal form layout section end -->


            </div>
        </div>
    </div>
    <!-- END: Content-->

@endsection
@section('js')
<script src="/lga/lga.min.js"></script>

{{-- Dependent Dropdown --}}
<script type="text/javascript">
    $(function() {
        $(document).on('change', '#faculty', function() {

            var faculty = $('#faculty').val();

            if(faculty == ''){
                    alert('All Fields are Required');
                    return;
                }

            $.ajax({
                type: 'GET',
                url: '{{ route('get-departments') }}',
                data: {
                    'faculty': faculty
                },
                success: function(data) {
                    var html = '<option value="">Select Department</option>';
                    var html = '<option value="all">All</option>';
                    $.each(data, function(key, v) {
                        html += '<option value="' + v.department.id + '">' + v.department.name  + '</option>';
                    });
                    html = $('#department').html(html);
                }
            });

        });

    });
</script>
@endsection
