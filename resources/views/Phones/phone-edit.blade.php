@extends('layouts.app')
@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-lg border-0 p-4 mb-4" style="background: linear-gradient(135deg, #e0e7ff 60%, #f8fafc 100%);">
                <div class="card-header bg-primary text-white rounded mb-3">
                    <h4 class="mb-0">Edit Phone Details</h4>
                </div>
                <form action="{{ route('phones.update', $edit->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-4 d-flex flex-column align-items-center justify-content-center">
                            <img src="{{ $show->image_url ?? asset('images/default-phone.png') }}" alt="" class="rounded-circle shadow mb-2" style="width:110px;height:110px;object-fit:cover;border:4px solid #fff;">
                            <label class="btn btn-outline-secondary btn-sm mt-2">
                                Change Image <input type="file" name="image" hidden>
                            </label>
                        </div>
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="brand" class="form-label">Brand</label>
                                <input type="text" class="form-control" id="brand" name="brand" value="{{ old('brand', $edit->brand) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="model_number" class="form-label">Model</label>
                                <input type="text" class="form-control" id="model_number" name="model_number" value="{{ old('model_number', $edit->phoneModel->model_number ?? '') }}" required>
                            </div>
                            {{-- <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $edit->description ?? '') }}</textarea>
                            </div> --}}
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                        <a href="{{ route('phones.show', $edit->id) }}" class="btn btn-outline-dark px-4">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
