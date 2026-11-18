@extends('admin.admin_master') 

@section('content')

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark mb-0">Menu Management</h2>
        <button class="btn btn-dark shadow-sm px-4 py-2" data-bs-toggle="modal" data-bs-target="#addProductModal">
            <i class="bi bi-plus-lg me-2"></i> Add New Item
        </button>
    </div>

    {{-- Product Table (Same as before) --}}
    <div class="card shadow-sm border-0 w-100">
        <div class="card-header bg-dark text-white py-3">
            <h5 class="mb-0 small fw-bold text-uppercase">Current Inventory</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr class="small text-uppercase">
                            <th class="ps-4">Image</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Variants</th>
                            <th class="text-center">Edit</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td class="ps-4">
                                {{-- Update the path here to 'uploads/products/' --}}
                                <img src="{{ asset($product->gallery) }}" width="50" height="50" class="rounded border shadow-sm object-fit-cover">
                            </td>
                            <td class="fw-bold text-dark">{{$product->name}}</td>
                            <td><span class="badge {{ $product->category == 'clothing' ? 'bg-primary' : 'bg-info' }} text-white">{{$product->category}}</span></td>
                            <td>
                                <span class="badge bg-secondary">
                                    {{ $product->variants->count() }} 
                                    {{ $product->category == 'clothing' ? 'Sizes' : 'Days Set' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="/admin/edit-product/{{$product->id}}" class="btn btn-sm btn-outline-primary border-0">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            </td>
                            <td class="text-center">
                                <form action="/delete-product" method="POST" onsubmit="return confirm('Remove this package?')">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$product->id}}">
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

    {{-- Modal --}}
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title fw-bold">Add Variable Product</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="/add-product" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">PRODUCT NAME</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">CATEGORY</label>
                                <select name="category" class="form-select" id="categorySelect" onchange="toggleCategoryFields()">
                                    <option value="Package1">Package 1</option>
                                    <option value="Package2">Package 2</option>
                                    <option value="Package3">Package 3</option>
                                    <option value="Diet">Diet</option>
                                    <option value="clothing">Clothing</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold">MAIN THUMBNAIL</label>
                            <input type="file" name="gallery" class="form-control" required>
                        </div>
                        <div class="mb-3">
    <label class="form-label small fw-bold">DESCRIPTION</label>
    <textarea name="description" 
              class="form-control" 
              rows="12" 
              placeholder="Write your detailed description here..." 
              required></textarea>
</div>

                        <hr>
                        
                        {{-- Catering Section --}}
                        <div id="cateringFields">
                            <h6 class="fw-bold text-primary mb-3">Daily Menus</h6>
                            <div class="row g-3">
                                @foreach(['SAT', 'SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI'] as $day)
                                    <div class="col-md-4">
                                        <div class="card border p-3 variant-card" style="background-color: #f8f9fa;">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input variant-checkbox" type="checkbox" name="variant_names[]" value="{{ $day }}">
                                                <label class="form-check-label fw-bold">{{ $day }}</label>
                                            </div>
                                            <div class="variant-inputs" style="opacity: 0.4;">
                                                <input type="number" name="variant_prices[]" class="form-control form-control-sm mb-2" placeholder="Price" disabled>
                                                <input type="file" name="variant_images[]" class="form-control form-control-sm" disabled>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Clothing Section (Hidden) --}}
                        <div id="clothingFields" style="display: none;">
                            <h6 class="fw-bold text-primary mb-3">Select Sizes</h6>
                            <div class="row g-3">
                                @foreach(['S', 'M', 'L', 'XL', 'XXL', 'Free Size'] as $size)
                                    <div class="col-md-4">
                                        <div class="card border p-3 variant-card" style="background-color: #f8f9fa;">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input variant-checkbox" type="checkbox" name="variant_names[]" value="{{ $size }}">
                                                <label class="form-check-label fw-bold">{{ $size }}</label>
                                            </div>
                                            <div class="variant-inputs" style="opacity: 0.4;">
                                                <input type="number" name="variant_prices[]" class="form-control form-control-sm mb-2" placeholder="Price" disabled>
                                                <input type="file" name="variant_images[]" class="form-control form-control-sm" disabled>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-dark px-5">Save Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    // 1. Toggle Categories
    function toggleCategoryFields() {
        const category = document.getElementById('categorySelect').value;
        document.getElementById('cateringFields').style.display = (category === 'clothing') ? 'none' : 'block';
        document.getElementById('clothingFields').style.display = (category === 'clothing') ? 'block' : 'none';
    }

    // 2. Enable/Disable Inputs for both types
    document.querySelectorAll('.variant-checkbox').forEach((checkbox) => {
        checkbox.addEventListener('change', function() {
            const card = this.closest('.variant-card');
            const inputs = card.querySelectorAll('input[type="number"], input[type="file"]');
            
            if (this.checked) {
                card.style.backgroundColor = "#fff";
                card.style.borderColor = "#0d6efd";
                card.querySelector('.variant-inputs').style.opacity = "1";
                inputs.forEach(i => i.disabled = false);
            } else {
                card.style.backgroundColor = "#f8f9fa";
                card.style.borderColor = "#dee2e6";
                card.querySelector('.variant-inputs').style.opacity = "0.4";
                inputs.forEach(i => { i.disabled = true; i.value = ''; });
            }
        });
    });
    </script>
@endsection