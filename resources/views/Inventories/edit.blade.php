{{-- filepath: c:\Users\Acer\Herd\phone-repair-laravel\resources\views\Inventories\edit.blade.php --}}
@extends('layouts.app')

@section('content')

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4 d-flex align-items-center">
                    <i class="bi bi-pencil-square fs-3 me-3"></i>
                    <div>
                        <h4 class="mb-0 fw-bold">Edit Inventory Part</h4>
                        <small class="text-light">Update details for your inventory part below</small>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('inventories.update', $inventory->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="partName" class="form-label fw-semibold">Part Name</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-box"></i></span>
                                    <input type="text" class="form-control" id="partName" name="part_name" value="{{ old('part_name', $inventory->part_name) }}" readonly required>
                                </div>
                                @error('part_name')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="skuId" class="form-label fw-semibold">SKU</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-upc-scan"></i></span>
                                    <input type="text" class="form-control" id="skuId" name="skuId" value="{{ old('skuId', $inventory->skuId) }}" readonly required>
                                </div>
                                @error('skuId')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="categoryId" class="form-label fw-semibold">Category</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-tags"></i></span>
                                    <select disabled style="cursor: not-allowed;" class="form-select" id="categoryId" name="categoryId" required>
                                        <option value="">Select Category</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}" {{ $inventory->categoryId == $product->id ? 'selected' : '' }}>
                                                {{ $product->product }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('categoryId')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="stock_quantity" class="form-label fw-semibold">Stock Quantity</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-stack"></i></span>
                                    <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity', $inventory->stock_quantity) }}" required>
                                </div>
                                @error('stock_quantity')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="cost_price" class="form-label fw-semibold">Cost Price</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-currency-dollar"></i></span>
                                    <input type="number" class="form-control" id="cost_price" name="cost_price" step="0.01" value="{{ old('cost_price', $inventory->cost_price) }}" required>
                                </div>
                                @error('cost_price')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="selling_price" class="form-label fw-semibold">Selling Price</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-cash-stack"></i></span>
                                    <input type="number" class="form-control" id="selling_price" name="selling_price" step="0.01" value="{{ old('selling_price', $inventory->selling_price) }}" required>
                                </div>
                                @error('selling_price')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="description" class="form-label fw-semibold">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Add more details about this part...">{{ old('description', $inventory->description) }}</textarea>
                                @error('description')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-4 d-flex justify-content-between">
                            <a href="{{ route('inventories.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Cancel</a>
                            <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-1"></i>Save Changes</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer bg-light rounded-bottom-4 px-4 py-3">
                    <div class="row g-2">
                        <div class="col-md-4">
                            <div class="bg-white border rounded-3 p-3 h-100 d-flex align-items-center">
                                <i class="bi bi-calendar me-2 text-primary"></i>
                                <span class="fw-semibold">Created: </span>
                                <span class="ms-1">{{ $inventory->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="bg-white border rounded-3 p-3 h-100 d-flex align-items-center">
                                <i class="bi bi-calendar-check me-2 text-success"></i>
                                <span class="fw-semibold">Last Updated: </span>
                                <span class="ms-1">{{ $inventory->updated_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="bg-white border rounded-3 p-3 h-100 d-flex align-items-center">
                                <i class="bi bi-person me-2 text-info"></i>
                                <span class="fw-semibold">SKU Owner: </span>
                                <span class="ms-1">{{ Auth::user()->name ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
