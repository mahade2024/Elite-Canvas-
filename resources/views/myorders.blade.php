@extends('master')
@section("content")
<div class="container my-5" style="min-height: 70vh;">
    
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm d-flex align-items-center mb-4" role="alert">
            <i class="fas fa-check-circle me-2 fs-4"></i>
            <div>
                <h5 class="mb-0 fw-bold">Success!</h5>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0">My Orders</h3>
            @if(Session::has('guest_phone') && !Session::has('user'))
                <span class="badge bg-light text-dark border mt-2">
                    <i class="fas fa-user-secret me-1"></i> Guest Mode: {{ Session::get('guest_phone') }}
                </span>
            @endif
        </div>
        <a href="/" class="btn btn-outline-primary btn-sm">Continue Shopping</a>
    </div>

    <div class="row">
        @forelse($orders as $item)
        <div class="col-12 mb-3">
            <div class="card shadow-sm border-0 p-3 hover-shadow">
                <div class="row align-items-center">
                    <div class="col-md-2">
                        <img src="{{$item->gallery}}" class="img-fluid rounded shadow-sm" style="height: 100px; width: 100%; object-fit: cover;">
                    </div>
                    <div class="col-md-4">
                        <h5 class="fw-bold mb-1">{{$item->name}}</h5>
                        <p class="text-muted small mb-0">
                            <i class="fas fa-map-marker-alt me-1"></i> {{$item->address}}
                        </p>
                        <p class="text-muted mb-0" style="font-size: 0.8rem;">Order ID: #EC-{{$item->id}}</p>
                    </div>
                    <div class="col-md-2 text-center">
                        @php
                            $statusColor = 'bg-warning text-dark';
                            if($item->status == 'delivered') $statusColor = 'bg-success text-white';
                            if($item->status == 'cancelled') $statusColor = 'bg-danger text-white';
                        @endphp
                        <span class="badge {{ $statusColor }} px-3 py-2">{{ ucfirst($item->status) }}</span>
                    </div>
                    <div class="col-md-2 text-center">
                        <p class="mb-0 fw-bold fs-5">৳{{$item->product_price}}</p>
                        <small class="badge rounded-pill bg-light text-muted border">{{$item->payment_method}}</small>
                    </div>
                    <div class="col-md-2 text-end">
                        <p class="small text-muted mb-0">Placed on:</p>
                        <p class="small fw-bold text-dark">{{ \Carbon\Carbon::parse($item->created_at)->format('d M, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5 bg-light rounded border-dashed">
            <i class="fas fa-shopping-basket fa-3x text-muted mb-3"></i>
            <h4 class="text-muted">No orders found!</h4>
            <p>Looks like you haven't ordered anything yet.</p>
            <a href="/" class="btn btn-info px-4 text-white fw-bold">Order Your First Meal</a>
        </div>
        @endforelse
    </div>
</div>


@endsection