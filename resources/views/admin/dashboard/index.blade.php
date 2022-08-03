@extends('admin.layouts.admin')
@section('content')

<div class="row">
<div class="col-md-4 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
        <div>
            <p class="mb-2 text-md-center text-lg-left">Total Leads</p>
            <h1 class="mb-0">{{ $total_leads }}</h1>
        </div>
        <i class="typcn typcn-briefcase icon-xl text-secondary"></i>
        </div>
        <canvas id="expense-chart" height="80"></canvas>
    </div>
    </div>
</div>
<div class="col-md-4 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
        <div>
            <p class="mb-2 text-md-center text-lg-left">Total User | Clients</p>
            <h1 class="mb-0">{{ $total_users }}</h1>
        </div>
        <i class="typcn typcn-chart-pie icon-xl text-secondary"></i>
        </div>
        <canvas id="budget-chart" height="80"></canvas>
    </div>
    </div>
</div>
<div class="col-md-4 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
        <div>
            <p class="mb-2 text-md-center text-lg-left">Total Tickets</p>
            <h1 class="mb-0">{{ $total_tickets }}</h1>
        </div>
        <i class="typcn typcn-clipboard icon-xl text-secondary"></i>
        </div>
        <canvas id="balance-chart" height="80"></canvas>
    </div>
    </div>
</div>
</div>
@endsection