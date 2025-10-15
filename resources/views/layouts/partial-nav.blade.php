
<div class="col-md-3 p-0">
    <div class="bg-white shadow h-100 sidebar d-flex flex-column" style="min-height: 100vh;">
        <div class="p-4 border-bottom">
            <a href="{{ route('dashboard') }}" class="btn btn-outline-primary w-100 mb-3">
                <i class="bi bi-arrow-left"></i> Back to Dashboard
            </a>
            <h5 class="text-primary">Settings</h5>
        </div>
            <ul class="nav flex-column p-3">
            <li class="nav-item mb-2">
                <a href="{{ route('add-phone-name.index') }}" class="nav-link  align-items-center {{ request()->routeIs('add-phone-name.index') ? 'active bg-primary text-white rounded' : 'text-dark' }}">
                    <i class="bi bi-phone"></i> Phone Brand
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('add-phone-model.index') }}" class="text-primary nav-link align-items-center {{ request()->routeIs('add-phone-model.index') ? 'active bg-primary text-white rounded' : 'text-dark' }}">
                    <i class="bi bi-phone-fill"></i> Phone Model
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('products.create') }}" class="nav-link  align-items-center {{ request()->routeIs('products.create') ? 'active bg-primary text-white rounded' : 'text-dark' }}">
                    <i class="bi bi-box-fill"></i> Products
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="{{ route('priority.index') }}" class="nav-link  align-items-center {{ request()->routeIs('priority.index') ? 'active bg-primary text-white rounded' : 'text-dark' }}">
                    <i class="bi bi-flag-fill"></i> Priority
                </a>
            </li>

            <div class="nav-item mb-2">
                <a href="{{ route('status.index') }}" class="nav-link  align-items-center {{ request()->routeIs('status.index') ? 'active bg-primary text-white rounded' : 'text-dark' }}">
                    <i class="bi bi-info-circle-fill"></i> Status
                </a>
            </div>
        </ul>
    </div>
</div>
