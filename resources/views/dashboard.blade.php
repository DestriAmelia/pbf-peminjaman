@extends('layouts/app')
@section('content')

<!-- page Heading -->
    <h1 class="h3 mb-4 text-gray-800">
       <i class="fas fa-tachometer-alt mr-2"></i>
       {{$title}}
    </h1>
@if(session('role') === 'admin')
    <div class="row">
    
    <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                TOTAL USER</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_users }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
@endif
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                TOTAL RUANGAN</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_rooms }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-home fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
@endsection