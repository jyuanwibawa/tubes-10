@extends('layouts.pickup')

@section('title', 'Create Pickup Request - Cleansweep')

@section('hero-content')
<p class="lead mb-4">Butuh pengambilan sampah mendesak? Kami siap membantu Anda.</p>
<a href="#pickup-form" class="btn btn-primary btn-lg">Buat Permintaan Pickup</a>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card" id="pickup-form">
            <div class="card-body p-4">
                <h2 class="text-center mb-4">Create Pickup Request</h2>

                <form action="{{ route('pickup.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="address" class="form-label">Pickup Address</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" id="address"
                            name="address" rows="3" required>{{ old('address') }}</textarea>
                        @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label">Waste Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                            name="description" rows="3" required>{{ old('description') }}</textarea>
                        <small class="text-muted">Please describe the type and amount of waste to be collected.</small>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="jenis_sampah" class="form-label">Jenis Sampah</label>
                        <select class="form-select @error('jenis_sampah') is-invalid @enderror" name="jenis_sampah"
                            id="jenis_sampah">
                            <option value="" disabled selected>Pilih jenis sampah</option>
                            <option value="TPA" {{ old('jenis_sampah') == 'TPA' ? 'selected' : '' }}>TPA (Tempat
                                Pembuangan Akhir)</option>
                            <option value="TPS" {{ old('jenis_sampah') == 'TPS' ? 'selected' : '' }}>TPS (Tempat
                                Pembuangan Sementara)</option>
                        </select>
                        @error('jenis_sampah')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="pickup_time" class="form-label">Preferred Pickup Time</label>
                        <input type="datetime-local" class="form-control @error('pickup_time') is-invalid @enderror"
                            id="pickup_time" name="pickup_time" value="{{ old('pickup_time') }}">
                        <small class="text-muted">Select a date and time for pickup (optional).</small>
                        @error('pickup_time')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="bi bi-check-circle"></i> Submit Request
                        </button>
                        <a href="{{ route('pickup.request-page') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Additional Information -->
        <div class="card mt-4">
            <div class="card-body">
                <h3 class="h5 mb-3">Important Information</h3>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="bi bi-info-circle text-success me-2"></i>Pickup requests are processed
                        within 24 hours.</li>
                    <li class="mb-2"><i class="bi bi-info-circle text-success me-2"></i>Our team will contact you to
                        confirm the pickup time.</li>
                    <li class="mb-2"><i class="bi bi-info-circle text-success me-2"></i>Please ensure waste is properly
                        packaged and accessible.</li>
                    <li><i class="bi bi-info-circle text-success me-2"></i>For urgent pickups, please call our support
                        team at (123) 456-7890.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Set minimum datetime for pickup time
    document.addEventListener('DOMContentLoaded', function() {
        const pickupTimeInput = document.getElementById('pickup_time');
        const now = new Date();
        const minDateTime = new Date(now.getTime() + 24 * 60 * 60 * 1000); // 24 hours from now
        pickupTimeInput.min = minDateTime.toISOString().slice(0, 16);
    });
</script>
@endpush