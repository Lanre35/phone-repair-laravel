@extends('layouts.app')

@section('content')
<div class="container-fluid">
    {{-- @if(session('success'))
        <div aria-live="polite" aria-atomic="true" class="position-fixed top-0 start-50 translate-middle-x p-3" style="z-index: 1080;">
            <div class="toast align-items-center text-bg-success border-0 show" id="successToast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="2500">
                <div class="d-flex">
                    <div class="toast-body">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current me-2" fill="none" viewBox="0 0 24 24" style="width:1.5em;height:1.5em;vertical-align:middle;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var toastEl = document.getElementById('successToast');
                if (toastEl) {
                    var toast = new bootstrap.Toast(toastEl, { delay: 2500 });
                    toast.show();
                }
            });
        </script>
    @endif --}}
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
            {{-- modal Action --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Customer</h2>
                <button id="inventory" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
                    <i class="bi bi-plus-circle"></i> Add New Customer
                </button>
            </div>

            <div class="modal fade" id="addCustomerModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content rounded-4 border-0">
                        <div class="modal-header bg-primary text-white rounded-top-4">
                            <h4 class="modal-title fw-bold"><i class="bi bi-person-plus me-2"></i>Add Customer</h4>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body p-4">
                            <form id="addCustomerForm" action="{{ route('customers.store') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="newCustomerName" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="newCustomerName" name="name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="newCustomerPhone" class="form-label">Phone Number</label>
                                        <input type="tel" class="form-control" name="phone_number" id="newCustomerPhone" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="newCustomerEmail" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="newCustomerEmail" name="email">
                                    </div>
                                    <div class="col-12">
                                        <label for="newCustomerAddress" class="form-label">Address</label>
                                        <textarea class="form-control" id="newCustomerAddress" name="address" rows="2"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer bg-light rounded-bottom-4 px-4 py-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" form="addCustomerForm">Add Customer</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow rounded-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="m-0 fw-bold"><i class="bi bi-people me-2"></i>Recent Customers</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Total Repairs</th>
                                    <th scope="col">Last Visit</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($customers as $key => $customer)
                                <tr>
                                    <td class="fw-bold text-primary">{{ $key+1 }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="bg-light rounded-circle p-2 me-2">
                                                <i class="bi bi-person-circle text-secondary"></i>
                                            </span>
                                            <span>{{ $customer->name }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $customer->email }}</td>
                                    <td><span class="badge bg-info text-dark">{{ $customer->phone_number }}</span></td>
                                    <td><span class="badge bg-success">{{ $customer->repairs->count() }}</span></td>
                                    <td><span class="badge bg-secondary">{{ $customer->updated_at->format('Y-m-d') }}</span></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('customers.show', $customer) }}" class="btn btn-sm btn-info" title="View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('customers.edit', $customer) }}" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('customers.destroy', $customer) }}" method="POST" style="display: inline;">
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
                                    <td colspan="7" class="text-center">No customers found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center p-3">
                        {{ $customers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
