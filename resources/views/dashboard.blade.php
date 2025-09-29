@extends('layouts.app')

@section('body')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

@if($msg = Session::get('message'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>{{ $msg  }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-12 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <p>Welcome to Multi-Tenant Flat & Bill Management System! <b>{{ auth()->user()->name }}</b></p>
            </div>
        </div>
    </div>
</div>



@endsection