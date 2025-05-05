@extends('layouts.auth')

@section('main-content')
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-9">
            <div class="card border-0 shadow-lg">
                <div class="row g-0">
                    <!-- Left side - Image -->
                    <div class="col-md-6 d-none d-md-block bg-image">
                        <div class="h-100 d-flex flex-column justify-content-center text-white p-5">
                            <h2 class="fw-bold mb-4">Welcome to CleanSweep</h2>
                            <p class="lead">Join us in making our world cleaner, one waste at a time.</p>
                        </div>
                    </div>
                    
                    <!-- Right side - Login Form -->
                    <div class="col-md-6">
                        <div class="card-body p-5">
                            <div class="text-center mb-5">
                                <i class="fas fa-recycle fa-3x text-primary mb-3"></i>
                                <h4 class="fw-bold">Sign In</h4>
                                <p class="text-muted">Access your CleanSweep account</p>
                            </div>

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-4">
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-envelope text-muted"></i>
                                        </span>
                                        <input type="email" 
                                               class="form-control border-start-0 @error('email') is-invalid @enderror" 
                                               name="email" 
                                               value="{{ old('email') }}" 
                                               placeholder="Enter your email"
                                               required>
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-lock text-muted"></i>
                                        </span>
                                        <input type="password" 
                                               class="form-control border-start-0 @error('password') is-invalid @enderror" 
                                               name="password" 
                                               placeholder="Enter your password"
                                               required>
                                        <button class="btn btn-light border border-start-0" type="button" onclick="togglePassword(this)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                        <label class="form-check-label text-muted" for="remember">
                                            Remember me
                                        </label>
                                    </div>
                                    <a href="#" class="text-decoration-none text-primary">
                                        Forgot Password?
                                    </a>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 py-3 mb-4">
                                    <i class="fas fa-sign-in-alt me-2"></i> Sign In
                                </button>

                                <p class="text-center text-muted">
                                    Don't have an account? 
                                    <a href="{{ route('register') }}" class="text-decoration-none text-primary">Register here</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .bg-image {
        background: linear-gradient(rgba(75, 127, 82, 0.9), rgba(75, 127, 82, 0.9)),
                    url('https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80');
        background-size: cover;
        background-position: center;
        border-radius: 10px 0 0 10px;
    }

    .card {
        border-radius: 10px;
        overflow: hidden;
    }

    .input-group-text {
        border-radius: 8px 0 0 8px;
        padding: 0.75rem 1rem;
    }

    .form-control {
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
    }

    .form-control:focus {
        border-color: #4B7F52;
        box-shadow: 0 0 0 0.2rem rgba(75, 127, 82, 0.25);
    }

    .btn-primary {
        background-color: #4B7F52;
        border-color: #4B7F52;
        font-weight: 500;
    }

    .btn-primary:hover {
        background-color: #3d6642;
        border-color: #3d6642;
        transform: translateY(-1px);
    }

    .btn-light {
        border-radius: 0 8px 8px 0;
    }

    .form-check-input:checked {
        background-color: #4B7F52;
        border-color: #4B7F52;
    }

    .text-primary {
        color: #4B7F52 !important;
    }

    .fa-recycle {
        color: #4B7F52;
    }
</style>
@endpush

@push('scripts')
<script>
function togglePassword(button) {
    const input = button.previousElementSibling;
    const type = input.type === 'password' ? 'text' : 'password';
    input.type = type;
    
    const icon = button.querySelector('i');
    icon.classList.toggle('fa-eye');
    icon.classList.toggle('fa-eye-slash');
}
</script>
@endpush
@endsection