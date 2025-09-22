@extends('layouts.app')
@section('content')
    <div class="container-fluid">
         @if(session('success'))
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
    @endif
     <div class="row">
        {{-- <div class="col-md-3">
            <div class="sidebar">
                <div class="list-group">
                    <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                    <hr>
                    <h5 class="mx-3">Settings</h5>
                    <a href="{{ route('add-phone-name.index') }}" class="list-group-item list-group-item-action">
                        <i class="bi bi-phone"></i> Brand
                    </a>

                    <a href="{{ route('add-phone-model.index') }}" class="list-group-item list-group-item-action">
                        <i class="bi bi-phone"></i> Model
                    </a>

                    <a href="{{ route('products.index') }}" class="list-group-item list-group-item-action">
                        <i class="bi bi-box"></i> Products
                    </a>
                </div>
            </div>
        </div> --}}

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
                        <a href="{{ route('add-phone-name.index') }}" class="nav-link active bg-primary text-white rounded">
                            <i class="bi bi-phone"></i> Brand
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('add-phone-model.index') }}" class="nav-link text-dark">
                            <i class="bi bi-phone"></i> Model
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('products.index') }}" class="nav-link text-dark">
                            <i class="bi bi-box"></i> Products
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

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
                                        <input type="text" name="brand" class="form-control" id="Brand">
                                        @error('brand')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="model" class="form-label">Select Model</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="bi bi-phone"></i></span>
                                            <select name="model" class="form-select" id="model">
                                                <option value="default" disabled selected>Select a model</option>
                                                @foreach ($models as $model)
                                                    <option value="{{ $model->id }}">{{ $model->model }}</option>
                                                @endforeach
                                            </select>
                                        </div>
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
                                    <th scope="col">Brand</th>
                                    <th scope="col">Model</th>
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
                                            <span class="badge bg-secondary">{{ $brand->phoneModel->model_number }}</span>
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


            <hr>
               {{-- Status --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Status</h2>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Status">
                    <i class="bi bi-plus-circle"></i> New Status
                </button>
            </div>

            <div class="modal fade" id="Status" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header modal-primary">
                            <h5 class="modal-title">Add New Status</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form id="status" action="{{ route('status.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <input type="text" name="status" class="form-control" id="status">
                                </div>
                                @error('status')
                                    <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button id="save" type="submit" class="btn btn-primary" form="status">Save</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="repairsTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                <!-- Repairs will be populated here -->

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
     </div>
 </div>
@endsection
