@extends('layouts.app')
@section('content')


<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('layouts.nav')
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
                    <div class="modal-content rounded-4 border-0">
                        <div class="modal-header bg-primary text-white rounded-top-4">
                            <h4 class="modal-title fw-bold"><i class="bi bi-tools me-2"></i>New Repair Job</h4>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body p-4">
                            <form id="addRepairForm" action="{{ route('repairs.store') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Name</label>
                                        <select class="form-select" id="deviceBrand" name="name" required>
                                            <option value="">Select Name</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="customerPhone" class="form-label">Phone Number</label>
                                        <input type="tel" class="form-control" id="customerPhone" name="phone_number" required>
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <label for="deviceBrand" class="form-label">Device Brand</label>
                                        <select class="form-select" id="deviceBrand" name="device_brand" required>
                                            <option value="">Select Brand</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->brand }}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                                    <div class="col-md-6">
                                        <label for="deviceModel" class="form-label">Device Model</label>
                                        <select class="form-select" id="deviceModel" name="device_model" required>
                                            <option value="">Select Model</option>
                                            @foreach ($models as $model)
                                                <option value="{{ $model->id }}">{{ $model->model_number }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="estimatedCost" class="form-label">Estimated Cost</label>
                                        <input name="cost" type="number" class="form-control" id="estimatedCost" step="0.01">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="priority" class="form-label">Priority</label>
                                        <select name="priority" class="form-select" id="priority">
                                            <option value="">Default</option>
                                            @foreach ($priorities as $priority)
                                                <option value="{{ $priority->id }}">{{ $priority->priority }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="statusFilter" class="form-label">Status</label>
                                        <select name="status" class="form-select" id="statusFilter">
                                            <option value="">All Status</option>
                                            @foreach ($statuses as $status)
                                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                     <div class="col-12">
                                        <label for="issueDescription" class="form-label">Issue Description</label>
                                        <textarea name="issue" class="form-control" id="issueDescription" rows="3" required></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer bg-light rounded-bottom-4 px-4 py-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" form="addRepairForm">Create Repair Job</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        {{-- <div class="col-md-3">
                            <form action="{{ route('search.by.status') }}" method="GET">
                                @csrf
                                <select name="selected_status" class="form-select" id="statusFilter" onchange="this.form.submit()">
                                    <option value="">All Status</option>
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div> --}}
                        {{-- <div class="col-md-3">
                            <input type="date" class="form-control" id="dateFilter">
                        </div> --}}

                        <div class="col-md-4">
                            <form id="searchForm" class="d-flex" method="GET" action="{{ route('search.by.ticket') }}">
                                @csrf
                                <input type="text" name="search" class="form-control  mx-2" id="searchFilter" placeholder="Search By ticket...">
                            </form>
                        </div>
                        {{-- <div class="col-md-2">
                            <button class="btn btn-outline-secondary" onclick="clearFilters()">Clear</button>
                        </div> --}}
                    </div>
                </div>
            </div>

            <div class="card shadow rounded-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="m-0 fw-bold"><i class="bi bi-tools me-2"></i>Recent Repair Jobs</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" id="repairsTable" style="font-size: 0.95rem;">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Ticket #</th>
                                    <th scope="col">Customer</th>
                                    {{-- <th scope="col">Phone</th> --}}
                                    <th scope="col">Device</th>
                                    <th scope="col">Issue</th>
                                    <th scope="col">Status</th>
                                    {{-- <th scope="col">Priority</th> --}}
                                    <th scope="col">Cost</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($repairs as $repair)
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
                                    {{-- <td>{{ $repair->phone_number }}</td> --}}
                                    <td><span class="badge bg-info text-dark">{{ $repair->model->model_number }}</span></td>
                                    <td>{{ $repair->issue_description }}</td>
                                    <td>
                                        <form action="{{ route('status.update', $repair->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                                @foreach($statuses as $status)
                                                    @if($repair->status_id == $status->id && empty($repair->completion_date))
                                                        <option value="{{ $status->id }}" selected>Pending</option>
                                                    @else
                                                        <option value="{{ $status->id }}" {{ $repair->status_id == $status->id ? 'selected' : '' }}>
                                                            {{ $status->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </form>
                                        @if(!empty($repair->completion_date))
                                            <span class="badge bg-success ms-2">Completed</span>
                                        @endif
                                    </td>
                                    {{-- <td>
                                        @if(isset($repair->priority))
                                            <span class="badge bg-primary">{{ $repair->priority->priority ?? '' }}</span>
                                        @else
                                            <span class="text-muted">Default</span>
                                        @endif
                                    </td> --}}
                                    <td><span class="badge bg-warning text-dark">{{ $repair->final_cost }}</span></td>
                                    <td>
                                        @if(!empty($repair->completion_date))
                                            <span class="badge bg-secondary">{{ $repair->completion_date }}</span>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('repairs.show', $repair->id) }}" class="btn btn-sm btn-info" title="View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('repairs.edit', $repair->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('repairs.destroy', $repair->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="text-center">No repairs found.</td>
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
