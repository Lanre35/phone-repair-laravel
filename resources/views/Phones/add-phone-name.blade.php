@extends('layouts.app')
@section('content')
    <div class="container-fluid">
     <div class="row">
        <div class="col-md-3">
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
                </div>
            </div>
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
            <div class="modal-content">
                <div class="modal-header modal-primary">
                    <h5 class="modal-title">Add New Brand</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="brand" action="{{ route('add-phone-name.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="Brand" class="form-label">Brand</label>
                            <input type="text" name="brand" class="form-control" id="Brand">
                        </div>

                         <div class="mb-3">
                            <select name="model" class="form-control">
                                <option value="default">Default</option>
                                @foreach ($models as $model)
                                    <option value="{{ $model->id }}">{{ $model->model }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('brand')
                            <span class="text text-danger">{{ $message }}</span>
                        @enderror
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" form="brand">Save</button>
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
                                    <th>Brands</th>
                                    <th>Model</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Repairs will be populated here -->
                                @foreach ($brands as $key=>$brand)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $brand->brand }}</td>
                                        <td>{{ $brand->model_number }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="#" class="btn btn-sm btn-info">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="#" class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="#" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
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
