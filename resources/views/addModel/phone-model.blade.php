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
                <h2>Phone Model</h2>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#PhoneModel">
                    <i class="bi bi-plus-circle"></i> New Model
                </button>
            </div>

            {{-- add-modal --}}

            <div class="modal fade" id="PhoneModel" tabindex="-1">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-primary">
                    <h5 class="modal-title">Add New Model</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="phoneModel" action="{{ route('add-phone-model.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="model" class="form-label">Model</label>
                            <input type="text" name="model" class="form-control" id="model">
                        </div>
                        @error('model')
                            <span class="text text-danger">{{ $message }}</span>
                        @enderror

                          <div class="mb-3">
                            <label for="model_number" class="form-label">Model Number</label>
                            <input type="text" name="model_number" class="form-control" id="model_number">
                        </div>
                        @error('model_number')
                            <span class="text text-danger">{{ $message }}</span>
                        @enderror
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button id="save" type="submit" class="btn btn-primary" form="phoneModel">Save</button>
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
                                    <th>Model Name</th>
                                    <th>Model</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Repairs will be populated here -->
                                @foreach ($models as $key => $model)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $model->model }}</td>
                                        <td>{{ $model->model_number }}</td>
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

                                        <td></td>
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

             <div class="card shadow">
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
            </div>
        </div>
    </div>
@endsection


