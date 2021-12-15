@extends('layouts.master')
@section('PageTitle', 'Home')
@section('content')
 <!-- BEGIN: Content-->
 <div class="app-content content ">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper container-xxl p-0">
      <div class="content-header row">
      </div>
      <div class="content-body">
          <!-- Dashboard Analytics Start -->
          <section id="dashboard-analytics">
              <div class="row match-height">
                  <!-- Greetings Card starts -->
                  <div class="col-lg-6 col-md-12 col-sm-12">
                      <div class="card card-congratulations">
                          <div class="card-body text-center">
                              <img src="/app-assets/images/elements/decore-left.png" class="congratulations-img-left" alt="card-img-left" />
                              <img src="/app-assets/images/elements/decore-right.png" class="congratulations-img-right" alt="card-img-right" />
                              <div class="avatar avatar-xl bg-primary shadow">
                                  <div class="avatar-content">
                                      <i data-feather="award" class="font-large-1"></i>
                                  </div>
                              </div>
                              <div class="text-center">
                                  <h1 class="mb-1 text-white">&#x20A6;{{number_format($sum+$sum2,0)}}</h1>
                                  <p class="card-text m-auto w-75">
                                     Forms Sold
                                  </p>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- Greetings Card ends -->

                  <!-- Subscribers Chart Card starts -->
                  <div class="col-lg-3 col-sm-6 col-12">
                      <div class="card">
                          <div class="card-header flex-column align-items-start pb-0">
                              <div class="avatar bg-light-primary p-50 m-0">
                                  <div class="avatar-content">
                                      <i data-feather="users" class="font-medium-5"></i>
                                  </div>
                              </div>
                              <h2 class="fw-bolder mt-1">{{number_format($interests+$interest_sra,0)}}</h2>
                              <p class="card-text">Interests Declared</p>
                          </div>
                          <div id="gained-chart"></div>
                      </div>
                  </div>
                  <!-- Subscribers Chart Card ends -->

                  <!-- Orders Chart Card starts -->
                  <div class="col-lg-3 col-sm-6 col-12">
                      <div class="card">
                          <div class="card-header flex-column align-items-start pb-0">
                              <div class="avatar bg-light-warning p-50 m-0">
                                  <div class="avatar-content">
                                      <i data-feather="package" class="font-medium-5"></i>
                                  </div>
                              </div>
                              <h2 class="fw-bolder mt-1">{{number_format($paid+$paid_sra,0)}}</h2>
                              <p class="card-text">Forms paid</p>
                          </div>
                          <div id="order-chart"></div>
                      </div>
                  </div>
                  <!-- Orders Chart Card ends -->
              </div>


          </section>
          <!-- Dashboard Analytics end -->

      </div>
  </div>
</div>
<!-- END: Content-->

@endsection
@section('js')
<script src="/app-assets/js/scripts/pages/dashboard-analytics.js"></script>
@endsection
