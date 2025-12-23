<div class="col-md-3 p-0">
            <nav class="bg-gradient bg-light shadow h-100 sidebar d-flex flex-column" style="min-height: 100vh;">
                <div class="p-4 border-bottom">
                    <h5 class="text-primary fw-bold">Menu</h5>
                </div>
                <ul class="nav flex-column p-3 gap-2">
                    <li class="nav-item">
                        <a  href="{{ route('dashboard') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('dashboard') ? 'active bg-primary text-white rounded' : 'text-dark' }}">
                            <span class="me-2"><i class="bi bi-speedometer2"></i></span> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('repairs.index') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('repairs.index') ? 'active bg-primary text-white rounded' : 'text-dark' }}">
                            <span class="me-2"><i class="bi bi-tools"></i></span> Repair Jobs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('customers.index') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('customers.index') ? 'active bg-primary text-white rounded' : 'text-dark' }}">
                            <span class="me-2"><i class="bi bi-people-fill"></i></span> Customers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('inventories.index') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('inventories.index') ? 'active bg-primary text-white rounded' : 'text-dark' }}">
                            <span class="me-2"><i class="bi bi-box-fill"></i></span> Inventory
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link d-flex align-items-center text-dark">
                            <span class="me-2"><i class="bi bi-graph-up"></i></span> Reports
                        </a>
                    </li>
                    <li class="nav-item">
                        @can('setting')
                            
                        <a href="{{ route('setting.index') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('setting.index') ? 'active bg-primary text-white rounded' : 'text-dark' }}">
                            <span class="me-2"><i class="bi bi-gear-fill"></i></span> Settings
                        </a>
                        @endcan
                    </li>
                </ul>
            </nav>
        </div>
