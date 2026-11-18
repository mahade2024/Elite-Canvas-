@extends('master')
@section('content')

<div class="page-bg flex-column">
    @if($products->count() > 0)
    
    {{-- 1. HERO CAROUSEL --}}
    <div class="container-fluid p-0 w-100 overflow-hidden hero-container">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3"></button>
            </div>

            
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('assets/common-images/hero1.png') }}" class="d-block hero-img" alt="Elite Catering">
                    <div class="carousel-caption hero-caption">
                        <h1 class="display-4 fw-bold text-uppercase hero-title">Elite Catering</h1>
                        <p class="fs-5 hero-subtitle">Premium Taste for Every Occasion</p>
                        <div class="mt-3"><a href="/products" class="btn btn-hero-order">ORDER NOW</a></div>
                    </div>
                </div>
                <div class="carousel-item active">
                    <img src="{{ asset('assets/common-images/hero2.png') }}" class="d-block hero-img" alt="Elite Catering">
                    <div class="carousel-caption hero-caption">
                        <h1 class="display-4 fw-bold text-uppercase hero-title">Elite Catering</h1>
                        <p class="fs-5 hero-subtitle">Premium Taste for Every Occasion</p>
                        <div class="mt-3"><a href="/products" class="btn btn-hero-order">ORDER NOW</a></div>
                    </div>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>

    {{-- 2. BEST SELLING --}}
    <div class="container custom-products py-5">
        <h1 class="text-center mb-5 fw-bold">Best Selling Products</h1>
        
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
            <h2 class="fw-bold text-uppercase mb-0">Clothing Arrivals</h2>
            <div class="slider-controls">
                <button class="btn btn-outline-dark btn-sm rounded-circle" data-bs-target="#clothingCarousel" data-bs-slide="prev"><i class="bi bi-chevron-left"></i></button>
                <button class="btn btn-outline-dark btn-sm rounded-circle ms-2" data-bs-target="#clothingCarousel" data-bs-slide="next"><i class="bi bi-chevron-right"></i></button>
            </div>
        </div>

        <div id="clothingCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($products->where('category', 'clothing')->chunk(4) as $chunk)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <div class="row g-3">
                        @foreach ($chunk as $item)
                        <div class="col-md-3 col-6">
                            <div class="trending-item p-2 border rounded shadow-sm h-100 d-flex flex-column bg-white">
                                <a href="detail/{{$item['id']}}" class="text-decoration-none text-dark">
                                    <img class="trending-image img-fluid rounded w-100" src="{{asset($item['gallery'])}}" alt="{{$item['name']}}">
                                    <div class="mt-2">
                                        <h6 class="fw-bold mb-1 text-truncate">{{$item['name']}}</h6>
                                        <p class="price-text mb-2 text-teal fw-bold">
                                            @if($item->variants && $item->variants->count() > 0)
                                                ৳ {{ (int)$item->variants->min('price') }} - {{ (int)$item->variants->max('price') }}
                                            @else
                                                ৳ {{ (int)$item['price'] }}
                                            @endif
                                        </p>
                                    </div>
                                </a>
                                <div class="mt-auto">
                                    <a href="detail/{{$item['id']}}" class="btn btn-sm btn-outline-teal w-100 py-2">Quick View</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- 3. TRENDING PRODUCTS (5-Column Grid) --}}
    <div class="container-fluid py-5 bg-light">
        <div class="container">
            <h1 class="text-center mb-5 fw-bold">Trending Products</h1>
            <div class="row g-3 row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5"> 
                @foreach ($products as $item)
                <div class="col">
                    <div class="trending-item p-2 border bg-white rounded shadow-sm h-100 d-flex flex-column">
                        <a href="detail/{{$item['id']}}" class="text-decoration-none text-dark">
                            <img class="trending-image img-fluid rounded" src="{{asset($item['gallery'])}}" alt="{{$item['name']}}">
                            <div class="mt-2 text-center">
                                <h6 class="fw-bold mb-1 text-truncate">{{ $item['name'] }}</h6>
                                <p class="price-text mb-2 text-teal fw-bold">
                                    ৳ {{ (int)$item['price'] }}
                                </p>
                            </div>
                        </a>
                        <div class="mt-auto">
                            <a href="detail/{{$item['id']}}" class="btn btn-sm btn-outline-teal w-100">BUY NOW</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- 4. CLIENT REVIEWS (1 Slide at a time, Centered) --}}
    <div id="carouselTwoView" class="carousel slide carousel-dark text-center py-5" data-bs-ride="carousel">
        <h1 class="text-center mb-4 fw-bold" style="margin-top: 10px;">Our Clients Review</h1>
        <div class="mx-auto bg-teal mb-5" style="height: 3px; width: 80px;"></div>

        <div class="carousel-inner">
            @php
                $testimonials = [
                    ['name' => 'Anna Deynah 1', 'role' => 'UX Designer', 'img' => 'img%20(1).webp'],
                    ['name' => 'Anna Deynah 2', 'role' => 'UX Designer', 'img' => 'img%20(3).webp'],
                    ['name' => 'Anna Deynah 3', 'role' => 'UX Designer', 'img' => 'img%20(5).webp'],
                ];
            @endphp

            @foreach($testimonials as $index => $testi)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-8 text-center"> 
                            <img class="testimonial-avatar shadow-1-strong mb-4 d-block mx-auto" 
                                src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/{{ $testi['img'] }}" 
                                alt="avatar"
                                style="width: 130px; height: 130px; border-radius: 50%; object-fit: cover; border: 3px solid #1BA8A8;">
                            
                            <h5 class="mb-1 fw-bold">{{ $testi['name'] }}</h5>
                            <p class="mb-3 fw-bold" style="color: #1BA8A8;">{{ $testi['role'] }}</p>
                            
                            <p class="text-muted italic px-4">
                                <i class="bi bi-quote fs-2 text-teal opacity-25 pe-2"></i>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod eos id officiis hic tenetur quae quaerat ad velit ab hic tenetur.
                            </p>
                            
                            <ul class="list-unstyled d-flex justify-content-center text-warning mb-0 mt-3">
                                <li><i class="bi bi-star-fill mx-1"></i></li>
                                <li><i class="bi bi-star-fill mx-1"></i></li>
                                <li><i class="bi bi-star-fill mx-1"></i></li>
                                <li><i class="bi bi-star-fill mx-1"></i></li>
                                <li><i class="bi bi-star-fill mx-1"></i></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        {{-- Side Arrows --}}
        <button class="carousel-control-prev side-arrow" type="button" data-bs-target="#carouselTwoView" data-bs-slide="prev">
            <i class="bi bi-chevron-left"></i>
        </button>
        <button class="carousel-control-next side-arrow" type="button" data-bs-target="#carouselTwoView" data-bs-slide="next">
            <i class="bi bi-chevron-right"></i>
        </button>
    </div>

    @else
        <div class="container text-center py-5">
            <h1 class="display-1">🍽️</h1>
            <h2 class="fw-bold">No Products Found!</h2>
            <a href="/" class="btn btn-warning mt-3">View All Products</a>
        </div>
    @endif
</div>

@endsection