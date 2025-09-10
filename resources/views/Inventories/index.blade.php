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
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Inventory Part</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addPartForm">
                                <div class="mb-3">
                                    <label for="partName" class="form-label">Part Name</label>
                                    <input type="text" class="form-control" id="partName" required>
                                </div>
                                <div class="mb-3">
                                    <label for="partSKU" class="form-label">SKU</label>
                                    <input type="text" class="form-control" id="partSKU" required>
                                </div>
                                <div class="mb-3">
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
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="partStock" class="form-label">Stock Quantity</label>
                                            <input type="number" class="form-control" id="partStock" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="partCost" class="form-label">Cost Price</label>
                                            <input type="number" class="form-control" id="partCost" step="0.01" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="partPrice" class="form-label">Selling Price</label>
                                            <input type="number" class="form-control" id="partPrice" step="0.01" required>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
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
