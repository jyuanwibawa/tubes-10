<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Help Keep Our Homes Clean')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="{{ asset('images/login.png') }}" rel="icon" type="image/png">
    
    <style>
        .min-h-screen {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .content {
            flex: 1;
        }
        .hero-section {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                              url('{{ asset('images/cleanup-bg.jpg') }}');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
        }
        .service-icon {
            color: #4CAF50;
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        .btn-primary {
            background-color: #4CAF50;
            border-color: #4CAF50;
        }
        .btn-primary:hover {
            background-color: #45a049;
            border-color: #45a049;
        }
        .bg-primary {
            background-color: #4CAF50 !important;
        }
        .text-success {
            color: #4CAF50 !important;
        }
        .bg-success {
            background-color: #4CAF50 !important;
        }
        .border-success {
            border-color: #4CAF50 !important;
        }
        .hover-opacity:hover {
            opacity: 0.8;
        }
        .card {
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .btn-success {
            background-color: #4CAF50;
            border-color: #4CAF50;
        }
        .btn-success:hover {
            background-color: #45a049;
            border-color: #45a049;
        }
    </style>
</head>
<body class="min-h-screen">
    @include('partial.navbar')

    <section class="hero-section">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">Join us in making our world cleaner,<br>one waste at a time</h1>
            @yield('hero-content')
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center text-success mb-5">Our Services</h2>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-truck text-success fs-1 me-3"></i>
                                <h3 class="card-title mb-0">Waste Pickup</h3>
                            </div>
                            <p class="card-text">Schedule a pickup for your waste and we'll handle it professionally. Our team will collect your waste at your preferred time.</p>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Flexible scheduling</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Professional handling</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Real-time tracking</li>
                            </ul>
                            @auth
                                <a href="{{ route('pickup.create') }}" class="btn btn-success mt-3">
                                    <i class="bi bi-truck"></i> Request Pickup
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="btn btn-success mt-3">
                                    <i class="bi bi-person-plus"></i> Sign Up to Request
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-recycle text-success fs-1 me-3"></i>
                                <h3 class="card-title mb-0">Recycling</h3>
                            </div>
                            <p class="card-text">We help you recycle your waste properly, ensuring it's processed in an environmentally friendly way.</p>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Eco-friendly processing</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Waste segregation</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Sustainable solutions</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-graph-up text-success fs-1 me-3"></i>
                                <h3 class="card-title mb-0">Waste Tracking</h3>
                            </div>
                            <p class="card-text">Monitor your waste management activities and track the progress of your pickup requests in real-time.</p>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Real-time updates</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Detailed history</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Status notifications</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-exclamation-triangle text-success fs-1 me-3"></i>
                                <h3 class="card-title mb-0">Report Litter</h3>
                            </div>
                            <p class="card-text">Help keep your community clean by reporting any litter you see. Our team will respond promptly.</p>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Quick reporting</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Location tracking</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Community impact</li>
                            </ul>
                            @auth
                                <a href="{{ route('waste-reports.create') }}" class="btn btn-success mt-3">
                                    <i class="bi bi-exclamation-triangle"></i> Laporkan Sampah
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="btn btn-success mt-3">
                                    <i class="bi bi-person-plus"></i> Sign Up to Report
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-info-circle text-success fs-1 me-3"></i>
                                <h3 class="card-title mb-0">In-Depth Information</h3>
                            </div>
                            <p class="card-text">Access comprehensive information about waste management, including pickup schedules and facility capacities.</p>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Pickup schedules</li>
                                <a href="{{route('peta.index')}}">Facility capacities</a>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Waste guidelines</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-5">
        <div class="container">
            @yield('content')
        </div>
    </section>

    <footer class="bg-success text-white py-5 mt-auto">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <h3 class="h5 mb-3">About Us</h3>
                    <p class="mb-0">We're dedicated to keeping our communities clean and environmentally friendly.</p>
                </div>
                <div class="col-md-4">
                    <h3 class="h5 mb-3">Contact</h3>
                    <p class="mb-0">Email: info@cleansweep.com<br>Phone: (123) 456-7890</p>
                </div>
                <div class="col-md-4">
                    <h3 class="h5 mb-3">Follow Us</h3>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white text-decoration-none hover-opacity">Facebook</a>
                        <a href="#" class="text-white text-decoration-none hover-opacity">Twitter</a>
                        <a href="#" class="text-white text-decoration-none hover-opacity">Instagram</a>
                    </div>
                </div>
            </div>
            <div class="mt-4 pt-4 border-top border-light text-center">
                <p class="mb-0">&copy; {{ date('Y') }} Clean Homes Initiative. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html