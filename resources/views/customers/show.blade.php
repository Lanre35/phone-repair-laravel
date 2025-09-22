@extends('layouts.app')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 mb-4">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Customer Details</h4>
                    <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-sm btn-light">Edit</a>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h5 class="text-secondary">Name</h5>
                            <p class="fw-bold">{{ $customer->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-secondary">Email</h5>
                            <p class="fw-bold">{{ $customer->email }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h5 class="text-secondary">Phone Number</h5>
                            <p class="fw-bold">{{ $customer->phone_number }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-secondary">Address</h5>
                            <p class="fw-bold">{{ $customer->address ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Repair History</h5>
                    <a href="{{ route('customers.index') }}" class="btn btn-sm btn-light">Back</a>
                </div>
                <div class="card-body">
                    @if($customer->repairs && $customer->repairs->count())
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Ticket #</th>
                                    <th>Device</th>
                                    <th>Issue</th>
                                    <th>Status</th>
                                    <th>Cost</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customer->repairs as $repair)
                                    <tr>
                                        <td>{{ $repair->ticket_number }}</td>
                                        <td>{{ $repair->phoneModel->model_number ?? 'N/A' }}</td>
                                        <td>{{ $repair->issue_description }}</td>
                                        <td><span class="badge bg-warning">{{ $repair->status->name ?? 'N/A' }}</span></td>
                                        <td>{{ $repair->final_cost }}</td>
                                        <td>{{ $repair->completion_date ? $repair->completion_date->format('d M Y') : 'N/A' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">No repairs found for this customer.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
