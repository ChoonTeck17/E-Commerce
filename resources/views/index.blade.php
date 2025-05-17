@extends('layouts.app')
@section('content')

    <style>
        body {
            color: #2d3748;
        }

        .hero-section {
            background: linear-gradient(135deg, #2d3748, #000000);
            color: white;
            padding: 5rem 0;
        }

        .hero-section h1 {
            font-weight: 800;
            color: #f8fafc;
        }

        .hero-section p {
            font-size: 1.25rem;
            opacity: 0.9;
        }

        .btn-primary {
            background-color: #000000;
            border-color: #000000;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #1f1f1f;
            border-color: #1f1f1f;
            transform: translateY(-2px);
        }

        .feature-card {
            padding: 1.5rem;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        .feature-card i {
            font-size: 2.5rem;
        }

        .about-section {
            background-color: #f8fafc;
            padding: 5rem 0;
        }

        .about-section img {
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .cta-section {
            background: linear-gradient(135deg, #000000, #1e1b4b);
            color: white;
            padding: 5rem 0;
        }

        .btn-outline-primary {
            border-color: #000000;
            color: #000000;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
        }

        .btn-outline-primary:hover {
            background-color: #000000;
            color: white;
        }
    </style>
</head>
<body>
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">Welcome to On-White</h1>
            <p class="lead mb-4">Your one-stop store for quality and affordable products.</p>
            <a href="{{ route('shop.index') }}" class="btn btn-primary">Shop Now</a>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Why Choose Us?</h2>
            <div class="row text-center">
                <div class="col-md-4 mb-4">
                    <div class="feature-card">
                        <i class="fa-solid fa-truck-fast text-primary mb-3"></i>
                        <h5 class="fw-semibold mt-3">Fast & Reliable Shipping</h5>
                        <p>We deliver your orders quickly and safely right to your doorstep.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-card">
                        <i class="fa-solid fa-star text-warning mb-3"></i>
                        <h5 class="fw-semibold mt-3">Top Quality Products</h5>
                        <p>We curate only the best products for your lifestyle and comfort.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-card">
                        <i class="fa-solid fa-shield-halved text-success mb-3"></i>
                        <h5 class="fw-semibold mt-3">Secure Checkout</h5>
                        <p>Your data and payments are fully protected with us.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0">
                    <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="About us" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <h2 class="fw-bold mb-3">Who We Are</h2>
                    <p class="text-muted mb-4">
                        At <strong>On-White</strong>, we are passionate about bringing quality, affordability, and style to our customers. 
                        Based in Malaysia, we aim to redefine the online shopping experience by focusing on customer satisfaction, curated collections, and transparent service.
                    </p>
                    <a href="#" class="btn btn-outline-primary">Learn More</a>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section text-center">
        <div class="container">
            <h2 class="fw-bold mb-3 text-white">Join Thousands of Happy Shoppers!</h2>
            <p class="lead mb-4">Browse our collections and enjoy your next shopping adventure with us.</p>
            <a href="{{ route('shop.index') }}" class="btn btn-primary">Start Shopping</a>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>




@endsection