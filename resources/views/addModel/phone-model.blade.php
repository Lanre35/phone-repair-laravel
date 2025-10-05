@extends('layouts.app')
@section('content')
    <div class="container-fluid">
     <div class="row">
         <div class="col-md-3 p-0">
            <nav class="bg-white shadow h-100 sidebar d-flex flex-column" style="min-height: 100vh;">
                <div class="p-4 border-bottom">
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-primary w-100 mb-3">
                        <i class="bi bi-arrow-left"></i> Back to Dashboard
                    </a>
                    <h5 class="text-primary">Settings</h5>
                </div>
                <ul class="nav flex-column p-3">
                    <li class="nav-item mb-2">
                        <a href="{{ route('add-phone-name.index') }}" class="nav-link text-dark">
                            <i class="bi bi-phone"></i> Brand
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('add-phone-model.index') }}" class="nav-link active bg-primary text-white rounded">
                            <i class="bi bi-phone"></i> Model
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('products.create') }}" class="nav-link text-dark">
                            <i class="bi bi-box"></i> Products
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="col-md-9">
            {{-- modal Action --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Phone Model</h2>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#PhoneModel">
                    <i class="bi bi-plus-circle"></i> New Model
                </button>
            </div>

            {{-- add-modal --}}

            <div class="modal fade" id="PhoneModel" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content rounded-4 border-0">
                        <div class="modal-header bg-primary text-white rounded-top-4">
                            <h4 class="modal-title fw-bold"><i class="bi bi-phone me-2"></i>Add New Model</h4>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body p-4">
                            <form id="phoneModel" action="{{ route('add-phone-model.store') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="model" class="form-label">Model</label>
                                        <input type="text" name="model" class="form-control" id="model">
                                        @error('model')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="model_number" class="form-label">Model Number</label>
                                        <input type="text" name="model_number" class="form-control" id="model_number">
                                        @error('model_number')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <select class="form-select" name="brand" id="">
                                            <option value="">Select Brand</option>
                                            @forelse ($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->brand }}</option>
                                            @empty

                                            @endforelse
                                        </select>
                                        @error('brand')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer bg-light rounded-bottom-4 px-4 py-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button id="save" type="submit" class="btn btn-primary" form="phoneModel">Save</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="m-0 fw-bold"><i class="bi bi-phone me-2"></i>Recent Phone Models</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" id="modelsTable">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Model Name</th>
                                    <th scope="col">Model Number</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($models as $key => $model)
                                    <tr>
                                        <td class="fw-bold text-primary">{{ $key + 1 }}</td>
                                        <td><span class="badge bg-info text-dark">{{ $model->model }}</span></td>
                                        <td><span class="badge bg-secondary">{{ $model->model_number }}</span></td>
                                        <td>
                                             <div class="btn-group" role="group">
                                                <a href="#" class="btn btn-sm btn-info" title="View">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="#" class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="#" method="POST" style="display: inline;">
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

            <hr>
            {{-- Priority --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Priority</h2>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Priority">
                    <i class="bi bi-plus-circle"></i> New Priority
                </button>
            </div>

            <div class="modal fade" id="Priority" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header modal-primary">
                            <h5 class="modal-title">Add New Model</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form id="priority" action="{{ route('priority.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="model" class="form-label">Priority</label>
                                    <input type="text" name="priority" class="form-control" id="model">
                                </div>
                                @error('priority')
                                    <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button id="save" type="submit" class="btn btn-primary" form="priority">Save</button>
                        </div>
                    </div>
                </div>
            </div>

             {{-- <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="repairsTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Priority</th>

                                </tr>
                            </thead>
                            <tbody>
                                <!-- Repairs will be populated here -->

                            </tbody>
                        </table>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection


