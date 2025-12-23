@extends('layouts.app')
@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-lg portfolio-card">
                <div class="row g-0">
                    <div class="col-md-4 d-flex flex-column align-items-center justify-content-center bg-light p-4">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($repair->customer->name ?? 'Customer') }}&background=0D8ABC&color=fff&size=128" class="rounded-circle mb-3" alt="Customer Avatar">
                        <h4 class="mb-1">{{ $repair->customer->name ?? '-' }}</h4>
                        <span class="badge bg-primary mb-2">{{ $repair->status->name ?? '-' }}</span>
                        <p class="text-muted small text-center mb-1">Ticket #: {{ $repair->ticket_number }}</p>
                        @can('edit',$repair)<a href="{{ route('repairs.edit', $repair->id) }}" class="btn btn-warning btn-sm mb-2">Edit</a>@endcan
                        <a href="{{ route('repairs.index') }}" class="btn btn-secondary btn-sm">Back</a>

                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Repair Portfolio</h5>
                            <ul class="list-group list-group-flush">
                                {{-- <li class="list-group-item"><strong>Phone:</strong> {{ $repair->phone->brand ?? '-' }}</li> --}}
                                <li class="list-group-item"><strong>Model:</strong> {{ $repair->model->model_number ?? '-' }}</li>
                                <li class="list-group-item"><strong>Phone Number:</strong> {{ $repair->phone_number }}</li>
                                <li class="list-group-item"><strong>Issue:</strong> {{ $repair->issue_description }}</li>
                                <li class="list-group-item"><strong>Priority:</strong> {{ $repair->priority->priority ?? '-' }}</li>
                                <li class="list-group-item"><strong>Estimated Cost:</strong> {{ $repair->estimated_cost }}</li>
                                <li class="list-group-item"><strong>Final Cost:</strong> {{ $repair->final_cost }}</li>
                                <li class="list-group-item"><strong>Repair Date:</strong> {{ $repair->repair_date }}</li>
                                <li class="list-group-item"><strong>Completion Date:</strong> {{ $repair->completion_date }}</li>
                                <li class="list-group-item"><strong>Notes:</strong> {{ $repair->notes }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
