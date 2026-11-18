@extends('admin.admin_master')

@section('content')
<div class="container my-5">
    <div class="card shadow-sm border-0 p-4">
        <h3 class="mb-4">Edit Product: {{ $product->name }}</h3>
        
        {{-- POST to the update route --}}
        <form action="/update-product" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $product->id }}">

            <div class="mb-3">
                <label>Product Name</label>
                <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
            </div>

            <div class="mb-3">
                <label>Category</label>
                <select name="category" class="form-select">
                    <option value="clothing" {{ $product->category == 'clothing' ? 'selected' : '' }}>Clothing</option>
                    <option value="catering" {{ $product->category == 'catering' ? 'selected' : '' }}>Catering</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="3">{{ $product->description }}</textarea>
            </div>

            <div class="mb-3">
                <label>Update Image (Optional)</label>
                <input type="file" name="gallery" class="form-control">
                <small class="text-muted">Current: {{ $product->gallery }}</small>
            </div>

            <button type="submit" class="btn btn-dark px-4">Save Changes</button>
            <a href="/admin/products" class="btn btn-link">Cancel</a>
        </form>
    </div>
</div>
@endsection