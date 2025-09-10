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
                <h2>Customer</h2>
                <button id="inventory" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
                    <i class="bi bi-plus-circle"></i> Add New Customer
                </button>
            </div>

            <div class="modal fade" id="addCustomerModal" tabindex="-1">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-primary">
                    <h5 class="modal-title">Add Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addCustomerForm" action="{{ route('customers.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="newCustomerName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="newCustomerName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="newCustomerPhone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" name="phone_number" id="newCustomerPhone" required>
                        </div>
                        <div class="mb-3">
                            <label for="newCustomerEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="newCustomerEmail" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="newCustomerAddress" class="form-label">Address</label>
                            <textarea class="form-control" id="newCustomerAddress" name="address" rows="2"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" form="addCustomerForm">Add Customer</button>
                </div>
            </div>
        </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Total Repairs</th>
                                    <th>Last Visit</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($customers as $customer)
                                <tr>
                                    <td>{{ $customer->id }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->phone_number }}</td>
                                    <td>{{ $customer->repairs->count() }}</td>
                                    <td>{{ $customer->updated_at->format('Y-m-d') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('customers.show', $customer) }}" class="btn btn-sm btn-info">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('customers.edit', $customer) }}" class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('customers.destroy', $customer) }}" method="POST" style="display: inline;">
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
                                    {{-- <td colspan="7" class="text-center">No customers found.</td> --}}
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center">
                        {{ $customers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
