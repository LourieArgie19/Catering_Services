@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')
<div class="row gy-4">
    <!-- Congratulations card -->
    <div class="col-md-12 col-lg-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-1">Good Day {{Auth::user()->fullname}}!</h4>
                <p class="mb-2 pb-1">Welcome to Catering  Service Management System</p>
                <a href="/menu" class="btn btn-sm btn-primary">View Services</a>
            </div>
            <img src="{{asset('assets/img/icons/misc/triangle-light.png')}}"
                class="scaleX-n1-rtl position-absolute bottom-0 end-0" width="166" alt="triangle background">
        </div>
    </div>
    <!--/ Congratulations card -->


    <div class="col-xl-4 col-lg-5 col-md-12">
    <div class="row g-6">
      <div class="col-sm-6">
        <div class="card h-100">
          <div class="card-header d-flex align-items-center justify-content-between">
            <div class="avatar">
            <a href="{{ route('menu') }}" style="color: white;">
              <div class="avatar-initial bg-success rounded-circle shadow-xs">
              <span class="mdi mdi-account-switch"></span>
              </div>
            </a>
            </div>
            
          </div>
          <div class="card-body">
            <h6 class="mb-1">Users</h6>
            <div class="d-flex flex-wrap mb-1 align-items-center">
              <h4 class="mb-0 me-2">{{ $totalUsers }}</h4>
            </div>
            <small>Total Users</small>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card h-100">
          <div class="card-header d-flex align-items-center justify-content-between">
            <div class="avatar">
                <a href="{{ route('view.reservations') }}" style="color: white;">
                    <div class="avatar-initial bg-info rounded-circle shadow-xs">
                    <span class="mdi mdi-book-edit-outline"></span>
                </a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <h6 class="mb-1">Reservations</h6>
            <div class="d-flex flex-wrap mb-1 align-items-center">
              <h4 class="mb-0 me-2">{{ $totalReservations }}</h4>
            </div>
            <small>Total Reservations</small>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection