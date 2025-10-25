@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">
        @include('layouts.partial-nav')

         <div class="col-9">
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
                                    <label for="model" class="form-label">Status</label>
                                    <input type="text" name="status" class="form-control" id="model">
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
                        <table class="table table-hover" id="priorityTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Status</S></th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($statuses as $status)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $status->name }}</td>
                                        <td>
                                            <form action="{{ route('status.destroy', $status->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure? Before deleted')" title="delete">
                                                    <i class="bi bi-trash"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="card-footer text-center mt-3 d-flex justify-content-end">
                @if ($statuses->hasPages())
                    {{ $statuses->links() }}
                @endif
            </div>
        </div>

</div>

@endsection
