@extends('master')
@section("content")
<div class="container my-5">
    <div class="row">
        <div class="col-md-5">
            <div class="main-card shadow-sm border mb-3">
                <img src="{{ asset($product->gallery) }}" id="mainImage" class="img-fluid w-100 rounded" alt="{{ $product->name }}">
            </div>
            
            <div class="d-flex gap-2 overflow-auto py-2">
                <div class="thumb-box border active-thumb" onclick="changeImg('{{ asset($product->gallery) }}', this)">
                    <img src="{{ asset($product->gallery) }}" class="img-fluid rounded">
                </div>
                @foreach($product->galleryImages as $img)
                <div class="thumb-box border" onclick="changeImg('{{ asset($img->image_path) }}', this)">
                    <img src="{{ asset($img->image_path) }}" class="img-fluid rounded">
                </div>
                @endforeach
            </div>
        </div>

        <div class="col-md-7 ps-md-5">
            <h1 class="display-6 fw-bold mb-1">{{ $product->name }}</h1>
            <p class="text-muted small">{{ $product->category }}</p>
            
            <p class="mb-4">
                <span class="text-muted">MRP:</span> 
                <strong>৳ {{ (int)$product->variants->min('price') }} - {{ (int)$product->variants->max('price') }}</strong>
            </p>

            <form action="/add_to_cart" method="POST">
                @csrf
                <p class="fw-bold mb-2">Select Your Item</p>
                
                <div class="d-flex flex-wrap gap-2 mb-4">
                    @foreach($product->variants as $variant)
                        <input type="radio" class="btn-check" name="variant_id" id="var_{{ $variant->id }}" 
                               value="{{ $variant->id }}" 
                               data-price="{{ (int)$variant->price }}" 
                               data-variant-img="{{ asset($variant->variant_image ?? $product->gallery) }}"
                               autocomplete="off">
                        
                        <label class="btn btn-variant-box" for="var_{{ $variant->id }}" 
                               onclick="selectVariant('{{ (int)$variant->price }}', '{{ asset($variant->variant_image ?? $product->gallery) }}')">
                            {{ strtoupper($variant->variant_name) }}
                        </label>
                    @endforeach
                </div>

                <div id="price-and-action" style="display: none;">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="price-display" style="background-color: #f8d7da; color: #dc3545; padding: 10px 20px; border-radius: 5px; font-weight: bold; font-size: 1.5rem;">
                            ৳ <span id="displayPrice">0</span>
                        </div>
                        <div class="quantity-input border d-flex align-items-center">
                            <button type="button" class="btn btn-sm" onclick="this.parentNode.querySelector('input').stepDown()">-</button>
                            <input type="number" name="quantity" value="1" min="1" class="border-0 text-center" style="width: 40px;">
                            <button type="button" class="btn btn-sm" onclick="this.parentNode.querySelector('input').stepUp()">+</button>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-outline-dark px-4 py-2">Add to Cart</button>
                        <button type="submit" formaction="/buy_now" class="btn btn-teal px-4 py-2 text-white">Buy Now</button>
                    </div>
                </div>

                <div id="selection-prompt" class="text-muted italic">
                    <p><i class="bi bi-info-circle"></i> Please select an item to see the price and order.</p>
                </div>
            </form>

        </div>
        
        {{-- Updated Description Section --}}
        <div class="mt-5">
            <ul class="nav nav-tabs border-bottom-0">
                <li class="nav-item">
                    <a class="nav-link active border-bottom-0 shadow-sm" href="#">Description</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-teal" href="#">Reviews</a>
                </li>
            </ul>
            <div class="p-4 border border-top-0 rounded-bottom">
                <ul class="list-unstyled text-secondary">
                    @foreach(explode("\n", $product->description) as $line)
                        @if(trim($line) !== "")
                            <li class="mb-2">
                                <i class="bi bi-check2-circle text-teal me-2"></i> {{ trim($line) }}
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    function selectVariant(price, variantImg) {
        document.getElementById('price-and-action').style.display = 'block';
        document.getElementById('selection-prompt').style.display = 'none';
        document.getElementById('displayPrice').innerText = price;
        document.getElementById('mainImage').src = variantImg;
        document.querySelectorAll('.thumb-box').forEach(el => el.classList.remove('active-thumb'));
    }

    function changeImg(src, element) {
        document.getElementById('mainImage').src = src;
        document.querySelectorAll('.thumb-box').forEach(el => el.classList.remove('active-thumb'));
        element.classList.add('active-thumb');
    }
</script>
@endsection