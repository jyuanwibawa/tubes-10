@extends('layouts.pickup')

@section('title', 'Request Pickup - Cleansweep')

@section('content')
<div class="row">
    <!-- Hero Section -->
    <div class="col-12 mb-5">
        <div class="card bg-success text-white">
            <div class="card-body p-5">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h1 class="display-4 fw-bold mb-4">Request a Pickup</h1>
                        <p class="lead mb-4">Schedule a waste pickup at your convenience. Our team will handle your waste professionally and responsibly.</p>
                        @auth
                            <a href="{{ route('pickup.create') }}" class="btn btn-light btn-lg">
                                <i class="bi bi-plus-circle"></i> Create Pickup Request
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-light btn-lg">
                                <i class="bi bi-person-plus"></i> Sign Up to Request
                            </a>
                        @endauth
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('images/pickup-hero.jpg') }}" alt="Waste Pickup" class="img-fluid rounded">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="col-12 mb-5">
        <h2 class="text-center mb-4">Why Choose Our Pickup Service?</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="step-icon mx-auto">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <h3 class="h5">Flexible Scheduling</h3>
                        <p class="card-text">Choose a pickup time that works best for you. We're available 7 days a week.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="step-icon mx-auto">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h3 class="h5">Professional Handling</h3>
                        <p class="card-text">Our trained team ensures safe and proper waste handling and disposal.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="step-icon mx-auto">
                            <i class="bi bi-truck"></i>
                        </div>
                        <h3 class="h5">Real-time Tracking</h3>
                        <p class="card-text">Track your pickup status in real-time and receive notifications.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- How It Works Section -->
    <div class="col-12 mb-5">
        <h2 class="text-center mb-4">How It Works</h2>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="step-icon mx-auto">
                            <span class="h4 mb-0">1</span>
                        </div>
                        <h3 class="h5">Request Pickup</h3>
                        <p class="card-text">Fill out the pickup request form with your details and preferred time.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="step-icon mx-auto">
                            <span class="h4 mb-0">2</span>
                        </div>
                        <h3 class="h5">Confirmation</h3>
                        <p class="card-text">Receive confirmation of your pickup request and estimated arrival time.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="step-icon mx-auto">
                            <span class="h4 mb-0">3</span>
                        </div>
                        <h3 class="h5">Pickup Day</h3>
                        <p class="card-text">Our team arrives at your location to collect the waste.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="step-icon mx-auto">
                            <span class="h4 mb-0">4</span>
                        </div>
                        <h3 class="h5">Completion</h3>
                        <p class="card-text">Receive notification when your waste has been collected and processed.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="col-12">
        <div class="card">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h3 class="h4 mb-3">Need Help?</h3>
                        <p class="mb-4">Our support team is here to help you with any questions about our pickup service.</p>
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-telephone text-success me-2"></i>
                            <span>(123) 456-7890</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-envelope text-success me-2"></i>
                            <span>support@cleansweep.com</span>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <img src="{{ asset('images/support.jpg') }}" alt="Support" class="img-fluid rounded" style="max-height: 200px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 