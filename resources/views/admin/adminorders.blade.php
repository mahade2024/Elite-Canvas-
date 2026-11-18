@extends('admin.admin_master')
@section('content')

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark mb-0">Order Management</h2>
        <span class="badge bg-white text-dark border shadow-sm px-3 py-2">{{ date('D, d M Y') }}</span>
    </div>

    <div class="card shadow-sm border-0 w-100">
        <div class="card-header bg-dark text-white py-3">
            <h5 class="mb-0 small fw-bold text-uppercase tracking-wider">All Customer Orders</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr class="small text-uppercase">
                            <th class="ps-3">Order No.</th>
                            <th>Product</th>
                            <th>Customer Name</th>
                            <th>Mobile</th>
                            <th>Location/Area</th>
                            <th>Address</th>
                            <th>Payment & TrxID</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $item)
                        <tr>
                            <td class="ps-3 fw-bold">#{{$item->id}}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{asset($item->product_img)}}" width="40" height="40" class="rounded border me-2 object-fit-cover">
                                    <span class="small fw-bold">{{$item->product_name}}</span>
                                </div>
                            </td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->phone}}</td>
                            <td><span class="badge bg-info text-dark font-monospace">{{$item->delivery_area}}</span></td>
                            <td class="small text-muted" style="max-width: 150px;">{{$item->address}}</td>
                            <td>
                                <div class="small"><strong>{{strtoupper($item->payment_method)}}</strong></div>
                                <small class="text-danger fw-bold">{{$item->transaction_id}}</small>
                            </td>
                            <td>
                                <form action="/update-order-status" method="POST">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{$item->id}}">
                                    <select name="status" onchange="this.form.submit()" 
                                        class="form-select form-select-sm border-0 shadow-sm
                                        @if($item->status == 'completed') bg-success text-white 
                                        @elseif($item->status == 'canceled') bg-danger text-white 
                                        @elseif($item->status == 'processing') bg-primary text-white 
                                        @else bg-warning text-dark @endif">
                                        <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="processing" {{ $item->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="completed" {{ $item->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="holding" {{ $item->status == 'holding' ? 'selected' : '' }}>Holding</option>
                                        <option value="canceled" {{ $item->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                    </select>
                                </form>
                            </td>
                            <td class="text-center">
                                <form action="/delete-order" method="POST" onsubmit="return confirm('Delete this order permanently?')">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{$item->id}}">
                                    <button class="btn btn-sm btn-outline-danger border-0">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection