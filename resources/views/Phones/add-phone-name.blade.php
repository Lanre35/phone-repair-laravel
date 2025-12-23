@extends('layouts.app')
@section('content')
    <div class="container-fluid">
     <div class="row">

        @include('layouts.partial-nav')

         <div class="col-md-9">
            {{-- modal Action --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Phone Brand</h2>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPhoneModel">
                    <i class="bi bi-plus-circle"></i> New Brand
                </button>
            </div>

            {{-- add-modal --}}

            <div class="modal fade" id="addPhoneModel" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content rounded-4 border-0">
                        <div class="modal-header bg-primary text-white rounded-top-4">
                            <h4 class="modal-title fw-bold"><i class="bi bi-phone me-2"></i>Add New Brand</h4>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body p-4">
                            <form id="brand" action="{{ route('add-phone-name.store') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="Brand" class="form-label">Brand</label>
                                        <input type="text" name="brand" class="form-control" id="Brand" required>
                                        @error('brand')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer bg-light rounded-bottom-4 px-4 py-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" form="brand">Save</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="m-0 fw-bold"><i class="bi bi-phone me-2"></i>Recent Brands</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" id="brandsTable">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Brands</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brands as $key=>$brand)
                                    <tr>
                                        <td class="fw-bold text-primary">{{ $key + 1 }}</td>
                                        <td>
                                            <span class="badge bg-info text-dark">{{ $brand->brand }}</span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('phones.show', $brand->id) }}" class="btn btn-sm btn-info" title="View">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('phones.edit', $brand->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('phones.destroy', $brand->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')" title="Delete">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center mt-3 d-flex justify-content-end">
                @if ($brands->hasPages())
                    {{ $brands->links() }}
                @endif
            </div>
        </div>
     </div>
    </div>
@endsection
