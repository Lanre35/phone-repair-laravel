@extends('layouts.app')
@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card shadow-lg border-0 rounded-lg portfolio-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 d-flex flex-column align-items-center justify-content-start bg-light p-4 rounded-start">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($repair->customer->name ?? 'Customer') }}&background=0D8ABC&color=fff&size=96" class="rounded-circle border-3 border-white shadow mb-2" alt="Customer Avatar">
                            <h4 class="mb-1">{{ $repair->customer->name ?? '-' }}</h4>
                            <span class="badge bg-primary mb-2">{{ $repair->status->name ?? '-' }}</span>
                            <p class="text-muted small mb-1">Ticket #: {{ $repair->ticket_number }}</p>
                            <a href="{{ route('repairs.show', $repair->id) }}" class="btn btn-info btn-sm mb-2">View</a>
                            <a href="{{ route('repairs.index') }}" class="btn btn-secondary btn-sm">Back</a>
                        </div>
                        <div class="col-md-8">
                        <h5 class="card-title mb-3 mt-4">Edit Repair Portfolio</h5>
                        <form action="{{ route('repairs.update', $repair->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="customer_id" class="form-label">Customer</label>
                                    <input type="text" name="customer_name" id="customer_name" class="form-control" value="{{ $repair->customer->name ?? '' }}">
                                </div>
                                <div class="mb-3">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $repair->phone_number }}" >
                                </div>
                                <div class="mb-3">
                                    <label for="device_brand" class="form-label">Device Brand</label>
                                    <input type="text" name="device_brand" id="device_brand" class="form-control" value="{{ $repair->phone->brand ?? '' }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="device_model_id" class="form-label">Device Model</label>
                                    <input type="text" name="device_model" id="device_model" class="form-control" value="{{ $repair->phoneModel->model ?? '' }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="issue_description" class="form-label">Issue Description</label>
                                    <textarea name="issue_description" id="issue_description" class="form-control">{{ $repair->issue_description }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="status_id" class="form-label">Status</label>
                                    <input type="text" name="status" id="status" class="form-control" value="{{ $repair->status->name ?? '' }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="priority_id" class="form-label">Priority</label>
                                    <input type="text" name="priority" id="priority" class="form-control" value="{{ $repair->priority->priority ?? '' }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="estimated_cost" class="form-label">Estimated Cost</label>
                                    <input type="number" step="0.01" name="estimated_cost" id="estimated_cost" class="form-control" value="{{ $repair->estimated_cost }}">
                                </div>
                                <div class="mb-3">
                                    <label for="final_cost" class="form-label">Final Cost</label>
                                    <input type="number" step="0.01" name="final_cost" id="final_cost" class="form-control" value="{{ $repair->final_cost }}">
                                </div>
                                <div class="mb-3">
                                    <label for="repair_date" class="form-label">Repair Date</label>
                                    <input type="date" name="repair_date" id="repair_date" class="form-control" value="{{ $repair->repair_date }}">
                                </div>
                                <div class="mb-3">
                                    <label for="completion_date" class="form-label">Completion Date</label>
                                    <input type="date" name="completion_date" id="completion_date" class="form-control" value="{{ $repair->completion_date }}">
                                </div>
                                <div class="mb-3">
                                    <label for="notes" class="form-label">Notes</label>
                                    <textarea name="notes" id="notes" class="form-control">{{ $repair->notes }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Update Repair</button>
                                <a href="{{ route('repairs.index') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
