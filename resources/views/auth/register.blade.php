@extends('layouts.auth')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <i class="fas fa-recycle fa-3x text-primary mb-3 text-success"></i>
                        <h4 class="fw-bold">Create Your Account</h4>
                        <p class="text-muted">Enter your details to register</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       name="name" 
                                       placeholder="Full Name" 
                                       value="{{ old('name') }}" 
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <select class="form-select @error('jenis_kelamin') is-invalid @enderror" 
                                        name="jenis_kelamin" 
                                        required>
                                    <option value="">Select Gender</option>
                                    <option value="Laki-Laki" {{ old('jenis_kelamin') == 'Laki-Laki' ? 'selected' : '' }}>
                                        Male
                                    </option>
                                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                        Female
                                    </option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" 
                                       class="form-control @error('no_telepon') is-invalid @enderror" 
                                       name="no_telepon" 
                                       placeholder="Phone Number" 
                                       value="{{ old('no_telepon') }}" 
                                       required>
                                @error('no_telepon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="date" 
                                       class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                                       name="tanggal_lahir" 
                                       value="{{ old('tanggal_lahir') }}" 
                                       required>
                                @error('tanggal_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   name="email" 
                                   placeholder="Email Address" 
                                   value="{{ old('email') }}" 
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                      name="alamat" 
                                      placeholder="Address" 
                                      required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <input type="text" 
                                   class="form-control @error('domisili') is-invalid @enderror" 
                                   name="domisili" 
                                   placeholder="Domisili" 
                                   value="{{ old('domisili') }}" 
                                   required>
                            @error('domisili')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="input-group">
                                    <input type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           name="password" 
                                           placeholder="Password" 
                                           required>
                                    <button class="btn btn-outline-secondary toggle-password" type="button">
                                        <i class="fas fa-eye-slash"></i>
                                    </button>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="input-group">
                                    <input type="password" 
                                           class="form-control" 
                                           name="password_confirmation" 
                                           placeholder="Confirm Password" 
                                           required>
                                    <button class="btn btn-outline-secondary toggle-password" type="button">
                                        <i class="fas fa-eye-slash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-3">
                            Register
                        </button>

                        <div class="text-center">
                            <small class="text-muted">
                                Already have an account? 
                                <a href="{{ route('login') }}" class="text-primary text-decoration-none text-success">
                                    Login
                                </a>
                            </small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    body {
        background-color: #f4f6f9;
    }

    .card {
        border-radius: 10px;
    }

    .form-control, .form-select {
        border-color: #e0e0e0;
        padding: 0.625rem;
        font-size: 0.95rem;
    }

    .form-control:focus, .form-select:focus {
        border-color: #4B7F52;
        box-shadow: 0 0 0 0.2rem rgba(75, 127, 82, 0.15);
    }

    .btn-primary {
        background-color: #4B7F52;
        border: none;
        padding: 0.625rem;
        transition: all 0.2s ease;
    }

    .btn-primary:hover {
        background-color: #3a6341;
    }

    .input-group .btn {
        border: 1px solid #e0e0e0;
        border-left: none;
    }

    .toggle-password i {
        color: #6b7280;
    }
</style>
@endpush

@push('scripts')
<script>
document.querySelectorAll('.toggle-password').forEach(button => {
    button.addEventListener('click', function() {
        const input = this.previousElementSibling;
        const icon = this.querySelector('i');
        
        input.type = input.type === 'password' ? 'text' : 'password';
        icon.classList.toggle('fa-eye-slash');
        icon.classList.toggle('fa-eye');
    });
});
</script>
@endpush