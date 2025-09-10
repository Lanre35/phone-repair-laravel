@extends('layouts.app')
@section('content')
 <!-- Sidebar -->
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
     </div>
 </div>


@endsection
