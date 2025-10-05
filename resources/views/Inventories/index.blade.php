@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 p-0">
            <nav class="bg-white shadow h-100 sidebar d-flex flex-column" style="min-height: 100vh;">
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

        <!-- Main Content -->
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-primary"><i class="bi bi-box-seam me-2"></i>Inventory</h2>
                <button type="button" class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addPartModal">
                    <i class="bi bi-plus-circle"></i> Add Inventory
                </button>
            </div>

            <!-- Inventory Stats Cards -->
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 rounded-4 h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width:48px;height:48px;">
                                <i class="bi bi-box-seam fs-4"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 fw-bold">Total Parts</h6>
                                <span class="fs-5 fw-semibold">{{ $inventories->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 rounded-4 h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width:48px;height:48px;">
                                <i class="bi bi-stack fs-4"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 fw-bold">In Stock</h6>
                                <span class="fs-5 fw-semibold">
                                    {{ $inventories->sum('stock_quantity') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 rounded-4 h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width:48px;height:48px;">
                                <i class="bi bi-exclamation-triangle fs-4"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 fw-bold">Low Stock</h6>
                                <span class="fs-5 fw-semibold">
                                    {{ $inventories->where('stock_quantity', '<', 5)->count() }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Inventory Modal -->
            <div class="modal fade" id="addPartModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content rounded-4 border-0">
                        <div class="modal-header bg-primary text-white rounded-top-4">
                            <h4 class="modal-title fw-bold"><i class="bi bi-box me-2"></i>Add Inventory Part</h4>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body p-4">
                            <form id="addPartForm" action="{{ route('inventories.store') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="partName" class="form-label">Part Name</label>
                                        <input type="text" class="form-control" id="partName" name="part_name">
                                        @error('part_name')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="partSKU" class="form-label">SKU</label>
                                        <select class="form-select" id="partCategory" name="skuId">
                                            <option value="">Select Category</option>
                                            @forelse ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->abbreviation }}</option>
                                            @empty
                                                <p>No data found</p>
                                            @endforelse
                                        </select>
                                        @error('skuId')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="partCategory" class="form-label">Category</label>
                                        <select class="form-select" id="partCategory" name="categoryId">
                                            <option value="">Select Category</option>
                                            @forelse ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->product }}</option>
                                            @empty
                                                <p>No data found</p>
                                            @endforelse
                                        </select>
                                        @error('categoryId')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label for="partStock" class="form-label">Stock Quantity</label>
                                        <input type="number" class="form-control" id="partStock" name="stock_quantity">
                                         @error('stock_quantity')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="partCost" class="form-label">Cost Price</label>
                                        <input type="number" class="form-control" id="partCost" step="0.01" name="cost_price">
                                         @error('cost_price')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="partPrice" class="form-label">Selling Price</label>
                                        <input type="number" class="form-control" id="partPrice" step="0.01" name="selling_price">
                                         @error('selling_price')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer bg-light rounded-bottom-4 px-4 py-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" form="addPartForm">Add Part</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Inventory Table Card -->
            <div class="card shadow rounded-4 border-0">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="inventoryTable">
                            <thead class="table-light">
                                <tr>
                                    <th><i class="bi bi-box"></i> Part Name</th>
                                    <th><i class="bi bi-upc-scan"></i> SKU</th>
                                    <th><i class="bi bi-tags"></i> Category</th>
                                    <th><i class="bi bi-stack"></i> Stock</th>
                                    <th><i class="bi bi-currency-dollar"></i> Cost</th>
                                    <th><i class="bi bi-cash-stack"></i> Selling Price</th>
                                    <th><i class="bi bi-gear"></i> Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($inventories as $inventory)
                                <tr>
                                    <tr>
                                        <td>
                                            <span class="fw-semibold"><i class="text-primary me-1"></i>{{ $inventory->part_name }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary">{{ $inventory->product->abbreviation }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-info text-dark">{{ $inventory->product->product ?? 'N/A' }}</span>
                                        </td>
                                        <td>
                                            <span class="badge {{ $inventory->stock_quantity > 10 ? 'bg-success' : ($inventory->stock_quantity > 0 ? 'bg-warning text-dark' : 'bg-danger') }}">
                                                {{ $inventory->stock_quantity }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-success">&#8358;{{ number_format($inventory->cost_price, 2) }}</span>
                                        </td>
                                        <td>
                                            <span class="text-primary">&#8358;{{ number_format($inventory->selling_price, 2) }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('inventories.edit', $inventory->id) }}" class="btn btn-sm btn-outline-primary me-1" title="Edit"><i class="bi bi-pencil"></i></a>
                                            <form action="{{ route('inventories.destroy', $inventory->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this item?');"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">No inventory parts found.</td>
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
