<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">CleanSweep</a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/articles">Articles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('waste-reports.index') }}">Waste Reports</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">About</a>
                </li>
            </ul>
            
            <div class="d-flex gap-2">
                @auth
                    <a href="{{ route('pickup.create') }}" class="btn btn-light me-2">
                        <i class="bi bi-truck"></i> Request Pickup
                    </a>
                    <div class="dropdown">
                        <button class="btn btn-link text-white text-decoration-none dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('pickup.index') }}">My Pickups</a></li>
                            <li><a class="dropdown-item" href="{{ route('waste-reports.index') }}">My Waste Reports</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('auth.user.logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light">Sign In</a>
                    <a href="{{ route('register') }}" class="btn btn-light">Sign Up</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

@push('styles')
<style>
    .dropdown-menu {
        border: none;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    
    .dropdown-item {
        padding: 0.5rem 1rem;
    }
    
    .dropdown-item:hover {
        background-color: #f8f9fa;
        color: #4B7F52;
    }
    
    .btn-link {
        color: white;
        text-decoration: none;
    }
    
    .btn-link:hover {
        color: rgba(255, 255, 255, 0.8);
    }
</style>
@endpush
