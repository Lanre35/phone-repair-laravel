@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        {{-- <div class="col-md-3 p-0">
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
                        <a href="{{ route('add-phone-model.index') }}" class="nav-link text-dark">
                            <i class="bi bi-phone"></i> Model
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('products.index') }}" class="nav-link active bg-primary text-white rounded">
                            <i class="bi bi-box"></i> Products
                        </a>
                    </li>
                </ul>
            </nav>
        </div> --}}

        @include('layouts.partial-nav')

        <!-- Main Content -->
        <div class="col-md-9">
             @if($errors->all())
                <div class="alert alert-danger" style="width: 50%; margin: 0 auto;">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="d-flex justify-content-center align-items-center" style="min-height: 60vh;">
                <div class="card shadow w-100" style="max-width: 500px;">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="bi bi-box"></i> Add Product</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('products.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter product name">
                            </div>
                            <div class="mb-3">
                                <label for="product_abbreviation" class="form-label">Product Abbreviation</label>
                                <input type="text" class="form-control" id="product_abbreviation" name="product_abbreviation" placeholder="Enter abbreviation">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Add Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
