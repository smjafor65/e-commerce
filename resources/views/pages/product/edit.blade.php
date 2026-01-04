
@extends('layout.app')
@section('content')

<div class="content">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <div>
            <h4 class="fw-bold">Edit Product</h4>
            <h6 class="text-muted">Update product details below</h6>
        </div>
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
            <i class="ti ti-arrow-left me-1"></i> Back to Products
        </a>
    </div>

    <!-- Form Card -->
    <div class="card shadow-sm rounded-3">
        <div class="card-body">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    <!-- Product Name -->
                    <div class="col-md-6">
                        <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $product->name) }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- SKU -->
                    <div class="col-md-6">
                        <label for="sku" class="form-label">SKU <span class="text-danger">*</span></label>
                        <input type="text" name="sku" id="sku"
                               class="form-control @error('sku') is-invalid @enderror"
                               value="{{ old('sku', $product->sku) }}">
                        @error('sku')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div class="col-md-6">
                        <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                        <input type="text" name="category" id="category"
                               class="form-control @error('category') is-invalid @enderror"
                               value="{{ old('category', $product->category) }}">
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Brand -->
                    <div class="col-md-6">
                        <label for="brand" class="form-label">Brand</label>
                        <input type="text" name="brand" id="brand"
                               class="form-control @error('brand') is-invalid @enderror"
                               value="{{ old('brand', $product->brand) }}">
                        @error('brand')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div class="col-md-6">
                        <label for="price" class="form-label">Price ($) <span class="text-danger">*</span></label>
                        <input type="number" name="price" id="price" step="0.01"
                               class="form-control @error('price') is-invalid @enderror"
                               value="{{ old('price', $product->price) }}">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Sale Price -->
                    <div class="col-md-6">
                        <label for="sale_price" class="form-label">Sale Price ($)</label>
                        <input type="number" name="sale_price" id="sale_price" step="0.01"
                               class="form-control @error('sale_price') is-invalid @enderror"
                               value="{{ old('sale_price', $product->sale_price) }}">
                        @error('sale_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Stock -->
                    <div class="col-md-6">
                        <label for="stock" class="form-label">Stock <span class="text-danger">*</span></label>
                        <input type="number" name="stock" id="stock"
                               class="form-control @error('stock') is-invalid @enderror"
                               value="{{ old('stock', $product->stock) }}">
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Unit -->
                    <div class="col-md-6">
                        <label for="unit" class="form-label">Unit <span class="text-danger">*</span></label>
                        <select name="unit" id="unit" class="form-select @error('unit') is-invalid @enderror">
                            <option value="">Select unit</option>
                            <option value="pcs" {{ old('unit', $product->unit)=='pcs' ? 'selected' : '' }}>pcs</option>
                            <option value="pair" {{ old('unit', $product->unit)=='pair' ? 'selected' : '' }}>pair</option>
                            <option value="kg" {{ old('unit', $product->unit)=='kg' ? 'selected' : '' }}>kg</option>
                            <option value="ltr" {{ old('unit', $product->unit)=='ltr' ? 'selected' : '' }}>ltr</option>
                        </select>
                        @error('unit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="col-md-6">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="active" {{ old('status', $product->status)=='active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $product->status)=='inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="out_of_stock" {{ old('status', $product->status)=='out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Current Thumbnail -->
                    <div class="col-md-6">
                        <label class="form-label">Current Thumbnail</label>
                        <div class="mb-2">
                            @if($product->thumbnail)
                                <img src="{{ asset('storage/products/' . $product->thumbnail) }}"
                                     alt="{{ $product->name }}" class="img-thumbnail" style="max-width: 150px;">
                            @else
                                <span class="text-muted">No thumbnail uploaded</span>
                            @endif
                        </div>

                        <!-- Change Thumbnail -->
                        <label for="thumbnail" class="form-label">Change Thumbnail</label>
                        <input type="file" name="thumbnail" id="thumbnail"
                               class="form-control @error('thumbnail') is-invalid @enderror" accept="image/*">
                        @error('thumbnail')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="col-12">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" rows="4"
                                  class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- Submit Button -->
                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-success">
                        Update Product
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>

@endsection
