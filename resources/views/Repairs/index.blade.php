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
            {{-- modal Action --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Repair Jobs</h2>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRepairModal">
                    <i class="bi bi-plus-circle"></i> New Repair Job
                </button>
            </div>

            {{-- add-modal --}}

            <div class="modal fade" id="addRepairModal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">New Repair Job</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addRepairForm" action="{{ route('repairs.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            {{-- <label for="customerName" class="form-label">Customer Name</label>
                                            <input value="{{ old('customer_name') }}" type="text" class="form-control" id="customerName" name="customer_name" required> --}}
                                           <label for="name" class="form-label">Name</label>
                                            <select class="form-select" id="deviceBrand" name="name" required>
                                                <option value="">Select Name</option>
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="customerPhone" class="form-label">Phone Number</label>
                                            <input type="tel" class="form-control" id="customerPhone" name="phone_number" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="deviceBrand" class="form-label">Device Brand</label>
                                            <select class="form-select" id="deviceBrand" name="device_brand" required>
                                                <option value="">Select Brand</option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->brand }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            {{-- <label for="deviceModel" class="form-label">Device Model</label>
                                            <input type="text" class="form-control" id="deviceModel" required> --}}
                                            <label for="deviceBrand" class="form-label">Device Model</label>
                                            <select class="form-select" id="deviceModel" name="device_model" required>
                                                <option value="">Select Model</option>
                                                @foreach ($models as $model)
                                                    <option value="{{ $model->id }}">{{ $model->model_number }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="issueDescription" class="form-label">Issue Description</label>
                                    <textarea name="issue" class="form-control" id="issueDescription" rows="3" required></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="estimatedCost" class="form-label">Estimated Cost</label>
                                            <input name="cost" type="number" class="form-control" id="estimatedCost" step="0.01">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="priority" class="form-label">Priority</label>
                                            <select name="priority" class="form-select" id="priority">
                                                <option value="">Default</option>
                                                @foreach ($priorities as $priority)
                                                    <option value="{{ $priority->id }}">{{ $priority->priority }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                     <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="statusFilter" class="form-label">Status</label>
                                            <select name="status" class="form-select" id="statusFilter">
                                                <option value="">All Status</option>
                                                @foreach ($statuses as $status)
                                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" form="addRepairForm">Create Repair Job</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <select class="form-select" id="statusFilter">
                                <option value="">All Status</option>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="date" class="form-control" id="dateFilter">
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="searchFilter" placeholder="Search customer or ticket...">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-outline-secondary" onclick="clearFilters()">Clear</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="repairsTable">
                            <thead>
                                <tr>
                                    <th>Ticket #</th>
                                    <th>Customer</th>
                                    <th>Phone</th>
                                    <th>Device</th>
                                    <th>Issue</th>
                                    <th>Status</th>
                                    {{-- <th>Cost</th> --}}
                                    {{-- <th>Date</th> --}}
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Repairs will be populated here -->
                                @forelse ($repairs as $repair)
                                <tr>
                                    <td>{{ $repair->ticket_number }}</td>
                                    <td>{{ $repair->customer->name }}</td>
                                    <td>{{ $repair->phone_number }}</td>
                                    <td>{{ $repair->phone->brand }}</td>
                                    <td>{{ $repair->issue_description }}</td>
                                    <td>
                                        <form action="{{ route('repairs.update', $repair->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <select name="status_id" class="form-select form-select-sm" onchange="this.form.submit()">
                                                @foreach($statuses as $status)
                                                    <option value="{{ $status->id }}" {{ $repair->status_id == $status->id ? 'selected' : '' }}>
                                                        {{ $status->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('repairs.show', $repair->id) }}" class="btn btn-sm btn-info">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('repairs.edit', $repair->id) }}" class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('repairs.destroy', $repair->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center">No repairs found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
