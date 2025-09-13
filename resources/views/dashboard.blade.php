@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="sidebar">
                <div class="list-group">
                    <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                    <a href="{{ route('repairs.index') }}" class="list-group-item list-group-item-action">
                        <i class="bi bi-tools"></i> Repair Jobs
                    </a>
                    <a href="{{ route('customers.index') }}" class="list-group-item list-group-item-action">
                        <i class="bi bi-people"></i> Customers
                    </a>
                    <a href="{{ route('inventories.index') }}" class="list-group-item list-group-item-action">
                        <i class="bi bi-box"></i> Inventory
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="bi bi-graph-up"></i> Reports
                    </a>
                    <a href="{{ route('setting.index') }}" class="list-group-item list-group-item-action">
                        <i class="bi bi-gear"></i> Settings
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="col-md-9">
            <h2 class="mb-4">Dashboard</h2>

            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Active Repairs
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['active_repairs'] }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-tools fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Completed Today
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['completed_today'] }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-check-circle fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Revenue (Today)
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">${{ $stats['daily_revenue'] }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-currency-dollar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Pending Pickup
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['pending_pickup'] }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-clock fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Repairs Table -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Repairs</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="recentRepairsTable">
                            <thead>
                                <tr>
                                    <th>Ticket #</th>
                                    <th>Customer</th>
                                    <th>Device</th>
                                    <th>Issue</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recent_repairs as $repair)
                                <tr>
                                    <td>{{ $repair->ticket_number }}</td>
                                    <td>{{ $repair->customer->name }}</td>
                                    <td>{{ $repair->phone->brand  }} - {{ $repair->phoneModel->model_number }}</td>
                                    <td>{{ $repair->issue_description }}</td>
                                    <td>{{ ucfirst($repair->status->name ?? 'unknown') }}</td>
                                    @if(!$repair->repair_date)
                                        <td>N/A</td>
                                    @else
                                        <td>{{ $repair->repair_date->format('Y-m-d') }}</td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Custom scripts for dashboard can be added here
</script>
@endsection

