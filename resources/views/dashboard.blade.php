@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 p-0">
            <nav class="bg-gradient bg-light shadow h-100 sidebar d-flex flex-column" style="min-height: 100vh;">
                <div class="p-4 border-bottom">
                    <h5 class="text-primary fw-bold">Menu</h5>
                </div>
                <ul class="nav flex-column p-3 gap-2">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('dashboard') ? 'active bg-primary text-white rounded' : 'text-dark' }}">
                            <span class="me-2"><i class="bi bi-speedometer2"></i></span> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('repairs.index') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('repairs.index') ? 'active bg-primary text-white rounded' : 'text-dark' }}">
                            <span class="me-2"><i class="bi bi-tools"></i></span> Repair Jobs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('customers.index') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('customers.index') ? 'active bg-primary text-white rounded' : 'text-dark' }}">
                            <span class="me-2"><i class="bi bi-people"></i></span> Customers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('inventories.index') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('inventories.index') ? 'active bg-primary text-white rounded' : 'text-dark' }}">
                            <span class="me-2"><i class="bi bi-box"></i></span> Inventory
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link d-flex align-items-center text-dark">
                            <span class="me-2"><i class="bi bi-graph-up"></i></span> Reports
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('setting.index') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('setting.index') ? 'active bg-primary text-white rounded' : 'text-dark' }}">
                            <span class="me-2"><i class="bi bi-gear"></i></span> Settings
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main Content Area -->
        <div class="col-md-9">
            <h2 class="mb-4">Dashboard</h2>
            {{ session('name') }}

            <!-- Stats Cards -->
            <div class="row g-4 mb-4">
                <div class="col-xl col-md-4 col-6 d-flex">
                    <div class="card shadow-sm border-0 text-center flex-fill h-100">
                        <div class="card-body py-4">
                            <div class="mb-2">
                                <span class="bg-primary text-white rounded-circle p-3">
                                    <i class="bi bi-tools fa-2x"></i>
                                </span>
                            </div>
                            <div class="mb-3"></div>
                            <h6 class="text-primary fw-bold mb-1">Active Repairs</h6>
                            <div class="display-6 fw-bold">{{ $stats['active_repairs'] }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl col-md-4 col-6 d-flex">
                    <div class="card shadow-sm border-0 text-center flex-fill h-100">
                        <div class="card-body py-4">
                            <div class="mb-2">
                                <span class="bg-success text-white rounded-circle p-3">
                                    <i class="bi bi-truck fa-2x"></i>
                                </span>
                            </div>
                            <div class="mb-3"></div>
                            <h6 class="text-success fw-bold mb-1">Pick Up</h6>
                            <div class="display-6 fw-bold">{{ $stats['pick_up'] }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl col-md-4 col-6 d-flex">
                    <div class="card shadow-sm border-0 text-center flex-fill h-100">
                        <div class="card-body py-4">
                            <div class="mb-2">
                                <span class="bg-info text-white rounded-circle p-3">
                                    <i class="bi bi-check-circle fa-2x"></i>
                                </span>
                            </div>
                            <div class="mb-3"></div>
                            <h6 class="text-info fw-bold mb-1">Completed Today</h6>
                            <div class="display-6 fw-bold">{{ $stats['completed_today'] }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl col-md-4 col-6 d-flex">
                    <div class="card shadow-sm border-0 text-center flex-fill h-100">
                        <div class="card-body py-4">
                            <div class="mb-2">
                                <span class="bg-warning text-white rounded-circle p-3">
                                    <i class="bi bi-currency-dollar fa-2x"></i>
                                </span>
                            </div>
                            <div class="mb-3"></div>
                            <h6 class="text-warning fw-bold mb-1">Revenue (Today)</h6>
                            <div class="display-6 fw-bold">${{ $stats['daily_revenue'] }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl col-md-4 col-6 d-flex">
                    <div class="card shadow-sm border-0 text-center flex-fill h-100">
                        <div class="card-body py-4">
                            <div class="mb-2">
                                <span class="bg-secondary text-white rounded-circle p-3">
                                    <i class="bi bi-clock fa-2x"></i>
                                </span>
                            </div>
                            <div class="mb-3"></div>
                            <h6 class="text-secondary fw-bold mb-1">Pending Pickup</h6>
                            <div class="display-6 fw-bold">{{ $stats['pending_pickup'] }}</div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Recent Repairs Table -->
            <div class="card shadow mb-4 rounded-4">
                <div class="card-header py-3 bg-primary text-white">
                    <h5 class="m-0 fw-bold"><i class="bi bi-clock-history me-2"></i>Recent Repairs</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" id="recentRepairsTable">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Ticket #</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Device</th>
                                    <th scope="col">Issue</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recent_repairs as $repair)
                                    <tr>
                                        <td class="fw-bold text-primary">{{ $repair->ticket_number }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="bg-light rounded-circle p-2 me-2">
                                                    <i class="bi bi-person-circle text-secondary"></i>
                                                </span>
                                                <span>{{ $repair->customer->name }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            {{-- <span class="badge bg-info text-dark">{{ $repair->phone->brand }}</span> --}}
                                            <span class="ms-1 text-muted">{{ $repair->model->model_number }}</span>
                                        </td>
                                        <td>{{ $repair->issue_description }}</td>
                                        <td>
                                            @if(empty($repair->completion_date))
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            @else
                                                <span class="badge bg-success">{{ ucfirst($repair->status->name ?? 'unknown') }}</span>
                                                <span class="ms-1 text-muted">({{ $repair->completion_date->diffForHumans() }})</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(!$repair->repair_date && empty($repair->completion_date))
                                                <span class="text-muted">N/A</span>
                                            @else
                                                <span class="badge bg-secondary">{{ $repair->repair_date->format('d-m-Y') }}</span>
                                            @endif
                                        </td>
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

