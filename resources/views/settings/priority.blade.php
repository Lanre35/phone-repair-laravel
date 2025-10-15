@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">


        @include('layouts.partial-nav')

         <div class="col-9">
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
                        <table class="table table-hover" id="priorityTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Priority</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($priorities as $priority)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $priority->priority }}</td>
                                        <td>
                                            <form action="{{ route('priority.destroy', $priority->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
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
                @if ($priorities->hasPages())
                    {{ $priorities->links() }}
                @endif
            </div>
        </div>

    </div>

</div>
@endsection
