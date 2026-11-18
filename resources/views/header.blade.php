@php
    use App\Models\Cart;
    use Illuminate\Support\Facades\Session;

    $user = Session::get('user');
    $count = 0;

    if($user) {
        $count = Cart::where('user_id', $user['id'])->count();
    } else {
        $count = Session::has('cart') ? count(Session::get('cart')) : 0;
    }
@endphp

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<nav class="navbar navbar-expand-lg shadow-sm sticky-top" style="background-color: #1A1A1A; min-height:70px;">
    <div class="container">
        
        <a class="navbar-brand me-4" href="{{ url('/') }}">
            <img src="{{ asset('assets/common-images/logo.png') }}" 
                 alt="Elite Canvas Logo" 
                 style="width:110px; height: 60px; object-fit: contain;">
        </a>

        <div class="d-flex align-items-center d-lg-none gap-2">
            <a class="nav-link bg-light rounded-circle d-flex align-items-center justify-content-center position-relative" href="/cartlist" style="width: 35px; height: 35px;">
                <i class="bi bi-cart3 text-dark fs-6"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.5rem;">
                    {{ $count }}
                </span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#eliteNav">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="eliteNav">
            
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fw-medium"">
                <li class="nav-item"><a class="nav-link text-white" href="{{ url('/') }}">HOME</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">CATERING</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">CLOTHING</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">EVENT MANAGEMENT</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('services') }}">SERVICES</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('about') }}">ABOUT</a></li>
                
                @if($user)
                    <li class="nav-item"><a class="nav-link text-white" href="/myorders">MY ORDERS</a></li>
                    @if($user['role'] == 1)
                        <li class="nav-item"><a class="nav-link text-warning fw-bold" href="/admin/orders">
                            <i class="bi bi-speedometer2 me-1"></i> ADMIN</a>
                        </li>
                    @endif
                @endif
            </ul>

            <form action="/search" class="d-flex mx-lg-4 my-3 my-lg-0" style="flex-grow: 1; border:none; border-radius: 20px 20px 20px 20px; height: 40px; max-width: 200px;">
                <div class="input-group">
                    <input name="query" class="form-control border-0" type="search" placeholder="Search..." style="border-radius: 20px 0 0 20px; color: #F7F5F2; ">
                    <button class="btn btn-teal" type="submit" style="background-color: #1BA8A8; border-radius: 0 20px 20px 0; border: none; ">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>

            <ul class="navbar-nav align-items-center gap-3">

                <li class="nav-item d-none d-lg-block">
                    <a class="nav-link bg-light rounded-circle d-flex align-items-center justify-content-center position-relative" href="/cartlist" style="width: 40px; height: 40px;">
                        <i class="bi bi-cart3 text-dark fs-5"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                            {{ $count }}
                        </span>
                    </a>
                </li>

               
            </ul>
            <ul>
                <div class="d-flex gap-2" style="margin-top:15px;">
                    <a class="nav-link bg-light rounded-circle d-flex align-items-center justify-content-center shadow-sm" 
                    href="https://facebook.com/Elitecanvasbd" 
                    target="_blank" 
                    style="width: 40px; height: 40px; transition: 0.3s;">
                        <i class="bi bi-facebook" style="color: #1877F2; font-size: 1.2rem;"></i>
                    </a>

                    <a class="nav-link bg-light rounded-circle d-flex align-items-center justify-content-center shadow-sm" 
                    href="https://wa.me/+8801731012053" 
                    target="_blank" 
                    style="width: 40px; height: 40px; transition: 0.3s;">
                        <i class="bi bi-whatsapp" style="color: #25D366; font-size: 1.2rem;"></i>
                    </a>
                </div>
                 
            </ul>
            <ul>
            <div class="d-flex gap-2" style="margin-top:15px;">
                 @if($user)
                    <li class="nav-item"><a class="btn btn-outline-light btn-sm rounded-pill px-3" href="/logout">LOGOUT</a></li>
                @else
                    <li class="nav-item d-flex align-items-center">
                        <a class="btn btn-teal text-white btn-sm rounded-pill px-4 d-flex align-items-center justify-content-center" 
                        href="/login" 
                        style="background-color: #1BA8A8; height: 40px; min-width: 100px; font-weight: 600; border: none;">
                        LOGIN
                        </a>
                    </li>
                @endif
            </div>
            </ul>
           
        </div>
    </div>
</nav>