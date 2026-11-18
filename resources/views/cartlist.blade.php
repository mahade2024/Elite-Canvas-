@extends('master')
@section("content")
<div class="container my-5">
    <div class="cart-page-container">
        <table class="table cart-table">
            <thead>
                <tr>
                    <th class="text-start">Item</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $item)
                <tr>
                    <td class="item-details">
                        <div class="d-flex align-items-center">
                            <img src="{{$item->gallery}}" class="cart-product-img">
                            <div class="ms-3 text-start">
                                <h5 class="mb-0">{{$item->name}}</h5>
                                <p class="text-muted small mb-1">{{$item->category}}</p>
                                <a href="/removecart/{{ Session::has('user') ? $item->cart_id : $loop->index }}" class="remove-link text-danger">
                                   × Remove Item
                                </a>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="quantity-control">
                            {{-- Minus Button --}}
                            <button class="btn-qty" onclick="updateQty('{{$item->id}}', 'minus', {{$item->price}})">-</button>
                            
                            {{-- Unique ID for each input --}}
                            <input type="text" value="1" readonly class="qty-input" id="qty-{{$item->id}}">
                            
                            {{-- Plus Button --}}
                            <button class="btn-qty" onclick="updateQty('{{$item->id}}', 'plus', {{$item->price}})">+</button>
                        </div>
                    </td>
                    <td>৳ {{ $item->price }}</td>
                    {{-- Unique ID for each row total --}}
                    <td class="fw-bold text-dark">৳ <span class="row-total" id="total-{{$item->id}}">{{ $item->price }}</span></td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-5">Your cart is empty!</td>
                </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <tfoot>
                            <tr>
                                <td colspan="2"></td>
                                <td class="text-end fw-bold">Cart Total</td>
                                {{-- Fixed the sum error by adding collect() --}}
                                <td class="fw-bold text-dark">৳ 
                                    <span id="grand-total">{{ collect($products)->sum('price') }}</span>
                                </td>
                            </tr>
                        </tfoot>
                </tr>
            </tfoot>
        </table>

        <div class="text-center mt-4">
            <a href="/ordernow" class="btn btn-checkout">Proceed to Checkout</a>
        </div>
    </div>
</div>

{{-- JavaScript to make the buttons work --}}
<script>
    function updateQty(id, action, price) {
        let qtyInput = document.getElementById('qty-' + id);
        let rowTotal = document.getElementById('total-' + id);
        let currentQty = parseInt(qtyInput.value);

        if (action === 'plus') {
            currentQty++;
        } else if (action === 'minus' && currentQty > 1) {
            currentQty--;
        }

        // Update the input box
        qtyInput.value = currentQty;

        // Update row total (Qty * Price)
        rowTotal.innerText = (currentQty * price);

        // Update the final Grand Total
        calculateGrandTotal();
    }

    function calculateGrandTotal() {
        let total = 0;
        document.querySelectorAll('.row-total').forEach(function(el) {
            total += parseInt(el.innerText);
        });
        document.getElementById('grand-total').innerText = total;
    }
</script>

@endsection