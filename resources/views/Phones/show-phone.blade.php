
@extends('layouts.app')
@section('content')
<div class="container py-5">
	<div class="row justify-content-center">
		<div class="col-md-7">
			<div class="card shadow-lg border-0 p-0 overflow-hidden" style="background: linear-gradient(135deg, #f8fafc 60%, #e0e7ff 100%);">
				<div class="row g-0 align-items-center">
					<div class="col-md-5 d-flex flex-column align-items-center justify-content-center bg-primary text-white" style="min-height: 320px;">
						<img src="{{ $show->image_url ?? asset('https://tse1.mm.bing.net/th/id/OIP.r0ZvmFj_lKeKuPDzoXRXfQHaHa?rs=1&pid=ImgDetMain&o=7&rm=3') }}" alt="Phone Image" class="rounded-circle shadow mb-3" style="width:140px;height:140px;object-fit:cover;border:5px solid #fff;">
						<h4 class="fw-bold mb-0">{{ $show->brand ?? 'Brand' }}</h4>
						<span class="text-light small">{{ $show->phoneModel->model_number ?? 'Model' }}</span>
					</div>
					<div class="col-md-7 p-4">
						<div class="d-flex flex-column h-100 justify-content-between">
							<div>
								<h2 class="fw-bold mb-2" style="letter-spacing:1px;">{{ $show->brand ?? 'Brand' }}</h2>
								<h5 class="text-secondary mb-4">Model: <span class="fw-bold">{{ $show->phoneModel->model_number ?? 'Model' }}</span></h5>
								{{-- <p class="text-muted">Showcase your device details here. You can add more info, specs, or a short description to make it look like a portfolio card.</p> --}}
							</div>
							<div class="d-flex gap-2 mt-2">
								<a href="{{ route('phones.edit', $show->id) }}" class="btn btn-primary px-4">Edit</a>
								<a href="{{ url('/add-phone-name') }}" class="btn btn-outline-dark px-4">Back</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
