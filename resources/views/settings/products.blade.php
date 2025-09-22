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
        <!-- Sidebar -->
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
        </div>

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
