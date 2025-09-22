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


        <div class="col-md-9">
            {{-- modal Action --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Inventory</h2>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPartModal">
                    <i class="bi bi-plus-circle"></i> Add Inventory
                </button>
            </div>

            <div class="modal fade" id="addPartModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content rounded-4 border-0">
                        <div class="modal-header bg-primary text-white rounded-top-4">
                            <h4 class="modal-title fw-bold"><i class="bi bi-box me-2"></i>Add Inventory Part</h4>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body p-4">
                            <form id="addPartForm">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="partName" class="form-label">Part Name</label>
                                        <input type="text" class="form-control" id="partName" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="partSKU" class="form-label">SKU</label>
                                        <input type="text" class="form-control" id="partSKU" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="partCategory" class="form-label">Category</label>
                                        <select class="form-select" id="partCategory" required>
                                            <option value="">Select Category</option>
                                            <option value="screen">Screen</option>
                                            <option value="battery">Battery</option>
                                            <option value="camera">Camera</option>
                                            <option value="speaker">Speaker</option>
                                            <option value="charging">Charging Port</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="partStock" class="form-label">Stock Quantity</label>
                                        <input type="number" class="form-control" id="partStock" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="partCost" class="form-label">Cost Price</label>
                                        <input type="number" class="form-control" id="partCost" step="0.01" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="partPrice" class="form-label">Selling Price</label>
                                        <input type="number" class="form-control" id="partPrice" step="0.01" required>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer bg-light rounded-bottom-4 px-4 py-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" onclick="addPart()">Add Part</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="inventoryTable">
                            <thead>
                                <tr>
                                    <th>Part Name</th>
                                    <th>SKU</th>
                                    <th>Category</th>
                                    <th>Stock</th>
                                    <th>Cost</th>
                                    <th>Selling Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                                    <tbody>
                                        <!-- Inventory will be populated here -->
                                    </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
