@extends('layout.app')

@section('content')
<div class="content">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">Product Details</h4>
        <a href="{{ route('products.index') }}" class="btn btn-secondary btn-lg">← Back</a>
    </div>

    <div class="row g-4">

        <!-- Product Image -->
        <div class="col-md-5">
            <div class="card border-0 shadow-sm rounded-4">
                <img
                    src="{{ asset('storage/products/' . $product->thumbnail) }}"
                    class="img-fluid rounded-4"
                    style="height:420px; object-fit:cover;"
                >
            </div>
        </div>

        <!-- Product Info -->
        <div class="col-md-7">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4 d-flex flex-column">

                    <h2 class="fw-bold mb-2">{{ $product->name }}</h2>

                    <p class="text-muted mb-2">
                        <strong>SKU:</strong> {{ $product->sku }}
                    </p>

                    <p class="mb-2">
                        <strong>Brand:</strong> {{ $product->brand }}
                    </p>

                    <p class="mb-2">
                        <strong>Category:</strong> {{ $product->category }}
                    </p>

                    <!-- Price -->
                    <div class="mb-3">
                        <span class="fs-3 fw-bold text-dark">
                            ${{ number_format($product->price, 2) }}
                        </span>

                        @if($product->sale_price)
                            <span class="fs-4 text-success fw-bold ms-2">
                                Sale: ${{ number_format($product->sale_price, 2) }}
                            </span>
                        @endif
                    </div>

                    <!-- Stock -->
                    <div class="mb-3">
                        <strong>Stock:</strong>
                        <span class="fw-bold {{ $product->stock < 10 ? 'text-danger' : 'text-success' }}">
                            {{ $product->stock }} {{ $product->unit }}
                        </span>

                        @if($product->stock < 10)
                            <div class="text-danger mt-1 fw-semibold">
                                ⚠ Only few items left in stock!
                            </div>
                        @endif
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <h6 class="fw-bold">Description</h6>
                        <p class="text-muted">{{ $product->description }}</p>
                    </div>

                    <!-- Buttons -->
                    <div class="mt-auto d-flex flex-wrap gap-2">

                        <a href="{{ route('products.edit', $product->id) }}"
                           class="btn btn-warning btn-lg flex-fill fw-semibold">
                            ✏️ Edit
                        </a>

                        <button class="btn btn-danger btn-lg flex-fill fw-semibold"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteModal">
                            🗑 Delete
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="modal-header">
                    <h5 class="modal-title">Delete Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    Are you sure you want to delete
                    <strong>{{ $product->name }}</strong>?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-danger">
                        Yes, Delete
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
