@extends('layouts.app')

@section('content')


{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="bg-light text-center p-5">
    <h1 class="display-4">Style that Speaks</h1>
    <p class="lead">Discover the latest fashion trends with FashionHub</p>
    <a href="{{route('shop.index')}}" class="btn btn-primary">Shop Now</a>
</div>

<!-- Why Choose Us -->
<section class="container my-5">
    <h2 class="text-center mb-4">Why Choose Us</h2>
    <div class="row text-center">
        <div class="col-md-4">
            <i class="bi bi-truck display-5 text-primary"></i>
            <h5 class="mt-3">Fast Delivery</h5>
            <p>We ensure quick and safe delivery of your orders.</p>
        </div>
        <div class="col-md-4">
            <i class="bi bi-stars display-5 text-warning"></i>
            <h5 class="mt-3">Premium Quality</h5>
            <p>All items are made from top-grade materials for durability.</p>
        </div>
        <div class="col-md-4">
            <i class="bi bi-tags display-5 text-success"></i>
            <h5 class="mt-3">Affordable Prices</h5>
            <p>Fashion that fits your budget without compromising style.</p>
        </div>
    </div>
</section>

<!-- Our Collection -->
<section id="collection" class="container my-5">
    <h2 class="text-center mb-4">Our Collection</h2>
    <div class="row">
        @foreach (['Men\'s Wear', 'Women\'s Wear', 'Accessories'] as $item)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/350x200?text={{ urlencode($item) }}" class="card-img-top" alt="{{ $item }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item }}</h5>
                        <p class="card-text">Explore our {{ strtolower($item) }} collection.</p>
                        <a href="#" class="btn btn-outline-primary">View More</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

<!-- Awards Section -->
<section class="bg-light py-5">
    <div class="container text-center">
        <h2 class="mb-4">Our Awards</h2>
        <div class="row">
            <div class="col-md-4">
                <h5>Best Fashion Retailer 2024</h5>
                <p>Global Fashion Awards</p>
            </div>
            <div class="col-md-4">
                <h5>Top 100 Online Stores</h5>
                <p>Asia E-Commerce Awards</p>
            </div>
            <div class="col-md-4">
                <h5>Customer Excellence Award</h5>
                <p>Retail Industry Association</p>
            </div>
        </div>
    </div>
</section>

@endsection
