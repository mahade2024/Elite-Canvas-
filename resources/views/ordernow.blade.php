@extends('master')

@push('styles')
<style>
    .btn-submit-order {
        background-color: #1aa1a5;
        color: white;
        font-weight: bold;
        padding: 12px;
        transition: 0.3s;
        border: none;
    }
    .btn-submit-order:hover {
        background-color: #148084;
        color: white;
    }
    .service-area-info {
        background-color: rgba(26, 161, 165, 0.1);
        border-left: 4px solid #1aa1a5;
        font-size: 0.85rem;
    }
    /* Added this so the boxes appear correctly */
    .payment-info-box {
        background-color: #f8f9fa;
        border: 1px dashed #1aa1a5;
    }
</style>
@endpush

@section("content")
<div class="container my-5">
    <div class="row">
        <div class="col-md-7">
            <h3 class="fw-bold mb-3">Place Order</h3>
            <p class="text-muted">Already a customer? <a href="/login" class="text-info text-decoration-none">Click here to sign in.</a></p>
            
            <form action="/orderplace" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Phone</label>
                    <div class="input-group">
                        <span class="input-group-text">+88</span>
                        <input type="text" name="phone" class="form-control" placeholder="017XXXXXXXX" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Select Your Thana (Dhaka Only)</label>
                    <select name="thana" class="form-select" required>
                        <option value="" selected disabled>Choose your area...</option>
                        <optgroup label="Dhaka North">
                            <option value="Uttara">Uttara (Min 20 Box)</option>
                            <option value="Gulshan">Gulshan</option>
                            <option value="Banani">Banani</option>
                            <option value="Mirpur">Mirpur</option>
                            <option value="Mohammadpur">Mohammadpur</option>
                            <option value="Badda">Badda</option>
                            <option value="Khilkhet">Khilkhet (Min 10 Box)</option>
                        </optgroup>
                        <optgroup label="Dhaka South">
                            <option value="Dhanmondi">Dhanmondi (Min 15 Box)</option>
                            <option value="Motijheel">Motijheel</option>
                            <option value="Paltan">Paltan</option>
                            <option value="Shahbagh">Shahbagh</option>
                            <option value="New Market">New Market</option>
                            <option value="Lalbagh">Lalbagh</option>
                            <option value="Jatrabari">Jatrabari</option>
                        </optgroup>
                    </select>
                    <div class="service-area-info p-2 mt-2">
                        <i class="bi bi-truck me-1"></i> Elite Canvas internal courier serves all Dhaka Thanas.
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Detailed Address</label>
                    <textarea name="address" class="form-control" rows="2" placeholder="House No, Road No, Flat..." required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Order Note (Optional)</label>
                    <textarea name="note" class="form-control" rows="2" placeholder="Special instructions..."></textarea>
                </div>

                <hr class="my-4">

                <h5 class="fw-bold mb-3">Payment Method</h5>
                <div class="form-check mb-2">
                    <input class="form-check-input payment-radio" type="radio" name="payment" id="cod" value="cash" checked>
                    <label class="form-check-label fw-bold" for="cod">Cash On Delivery</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input payment-radio" type="radio" name="payment" id="bkash" value="bkash">
                    <label class="form-check-label fw-bold" for="bkash">Pay with bKash</label>
                    <div id="bkash-info" class="payment-info-box d-none mt-2 p-3 rounded">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-phone-vibrate fs-4 me-2 text-danger"></i>
                            <span>Send Money to: <strong>01771133850</strong></span>
                        </div>
                        <input type="text" name="bkash_trx" id="bkash_trx" class="form-control form-control-sm" placeholder="Enter bKash TrxID">
                    </div>
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input payment-radio" type="radio" name="payment" id="nagad" value="nagad">
                    <label class="form-check-label fw-bold" for="nagad">Pay with Nagad <span class="text-danger">🔥</span></label>
                    <div id="nagad-info" class="payment-info-box d-none mt-2 p-3 rounded">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-phone-vibrate fs-4 me-2 text-warning"></i>
                            <span>Send Money to: <strong>01771133850</strong></span>
                        </div>
                        <input type="text" name="nagad_trx" id="nagad_trx" class="form-control form-control-sm" placeholder="Enter Nagad TrxID">
                    </div>
                </div>

                <button type="submit" class="btn btn-submit-order w-100 shadow-sm">Confirm Order</button>
            </form>
        </div>

        <div class="col-md-5">
            <div class="card border-0 bg-light p-4 shadow-sm sticky-top" style="top: 20px;">
                <h4 class="fw-bold mb-3">Order Summary</h4>
                @foreach($products as $item)
                <div class="cart-summary-box p-2 bg-white border rounded mb-2">
                    <div class="d-flex align-items-center">
                        <img src="{{$item->gallery}}" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                        <div class="ms-3 flex-grow-1">
                            <h6 class="mb-0 small fw-bold text-truncate">{{$item->name}}</h6>
                            <small class="text-muted">৳ {{$item->price}}</small>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="mt-4">
                    <div class="d-flex justify-content-between fw-bold fs-4 pt-2">
                        <span>Total</span>
                        <span style="color: #1aa1a5;">৳ {{ $total }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Moving this inside the section ensures it loads with the page
    document.querySelectorAll('.payment-radio').forEach(radio => {
        radio.addEventListener('change', function() {
            document.querySelectorAll('.payment-info-box').forEach(box => box.classList.add('d-none'));
            document.getElementById('bkash_trx').required = false;
            document.getElementById('nagad_trx').required = false;

            const selectedInfo = document.getElementById(this.id + '-info');
            if (selectedInfo) {
                selectedInfo.classList.remove('d-none');
                const trxInput = selectedInfo.querySelector('input');
                if (trxInput) trxInput.required = true;
            }
        });
    });
</script>
@endsection