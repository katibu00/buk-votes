@extends('layouts.master')
@section('PageTitle', 'Preferences')
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
                                    <h4 class="card-title pull-left">Preferences</h4>
                                </div>
                                <hr style="margin-top: -10px;">
                                <div class="card-body"  style="margin-top: -20px;">

                                    <div class="row">
                                        <div class="col-12 col-md-8">
                                            <form action="{{route('settings.save')}}" method="post">
                                                @csrf
                                                <div class="row">
                                                    <label for="" class="col-sm-3 col-form-label-sm">Commission Charged</label>
                                                    <div class=" col-sm-4">
                                                        <input type="number" class="form-control" name="commission" style="margin-top: 10px;" value="{{$settings->commission}}"/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="" class="col-sm-3 col-form-label-sm">Inquiry Number</label>
                                                    <div class=" col-sm-4">
                                                        <input type="text" class="form-control" name="phone" style="margin-top: 10px;" value="{{$settings->phone}}"/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="" class="col-sm-3 col-form-label-sm">Inquiry Email</label>
                                                    <div class=" col-sm-4">
                                                        <input type="email" class="form-control" name="email" style="margin-top: 10px;" value="{{$settings->email}}"/>
                                                    </div>
                                                </div>

                                                
                                                <div class="mb-1 row">
                                                    <label for="colFormLabelLg" class="col-sm-3 col-form-label-lg">Frontend</label>
                                                    <div class="form-check form-switch col-sm-9">
                                                        <input type="checkbox" class="form-check-input" name="frontend" style="margin-top: 10px;" {{($settings->frontend=='on')?'checked':''}}/>
                                                    </div>
                                                </div>
                                                <div class="mb-1 row">
                                                    <label for="colFormLabel" class="col-sm-3 col-form-label">Live Result</label>
                                                    <div class="form-check form-switch col-sm-9">
                                                        <input type="checkbox" class="form-check-input" name="live" style="margin-top: 10px;"  {{($settings->live=='on')?'checked':''}}/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="colFormLabelSm" class="col-sm-3 col-form-label-sm">Force Voters to vote in all posts</label>
                                                    <div class="form-check form-switch col-sm-9">
                                                        <input type="checkbox" class="form-check-input" name="force" style="margin-top: 10px;"  {{($settings->force=='on')?'checked':''}}/>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <label for="colFormLabelSm" class="col-sm-3 col-form-label-sm">Certificate of Return</label>
                                                    <div class="form-check form-switch col-sm-9">
                                                        <input type="checkbox" class="form-check-input" name="certificate" style="margin-top: 10px;"  {{($settings->certificate=='on')?'checked':''}}/>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-9 offset-sm-3">
                                                    <button type="submit" class="btn btn-primary me-1 mt-2">Save Changes</button>
    
                                                </div>

                                            </form>
                                        </div>
                                    </div>

                                 </div>
                            </div>
                        </div>
                    </div>


            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
