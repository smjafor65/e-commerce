@extends('layout.app')
@section('content')

<div class="content">

    <!-- Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h4 class="fw-bold">Products</h4>
        <a href="{{ route('products.create') }}" class="btn btn-primary btn-lg">Add Product</a>
    </div>

    <!-- Search & Per Page -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <form method="GET" class="d-flex flex-grow-1 flex-md-auto gap-2">
            <input type="search" name="search" value="{{ request('search') }}" class="form-control form-control-lg" placeholder="Search products...">
            <button class="btn btn-primary btn-lg">Search</button>
        </form>

        <form method="GET" class="d-flex align-items-center gap-2">
            <label class="mb-0 fw-semibold">Show:</label>
            <select name="per_page" class="form-select form-select-lg" onchange="this.form.submit()">
                @foreach([6,12,24,50] as $size)
                    <option value="{{ $size }}" {{ $perPage==$size ? 'selected' : '' }}>{{ $size }} per page</option>
                @endforeach
            </select>
        </form>
    </div>

    <!-- Products Grid -->
    <div class="row g-4">
        @forelse($products as $product)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card shadow-sm border-0 rounded-4 overflow-hidden h-100 text-center">

                    <!-- Product Image -->
                    @if($product->thumbnail && file_exists(public_path('storage/products/' . $product->thumbnail)))
                        <img src="{{ asset('storage/products/' . $product->thumbnail) }}"
                            class="card-img-top"
                            style="height:220px; object-fit:cover;">
                    @else
                        <img src="{{ asset('assets/img/products/product-01.jpg') }}"
                            class="card-img-top"
                            style="height:220px; object-fit:cover;">
                    @endif

                    <!-- Card Body -->
                    <div class="card-body d-flex flex-column p-3">
                        <!-- Product Info -->
                        <h5 class="card-title fw-bold fs-4 text-dark mb-2">{{ $product->name }}</h5>

                        <p class="mb-1 text-dark"><strong>SKU:</strong> {{ $product->sku }}</p>
                        <p class="mb-1 text-dark fw-semibold"><strong>Price:</strong> ${{ number_format($product->price, 2) }}
                        @if($product->sale_price)
                            <span class="mb-1 text-success fw-bold"><strong>Sale:</strong> ${{ number_format($product->sale_price, 2) }}</span>
                        @endif
                        </p>
                        <p class="mb-2 text-dark"><strong>Stock:</strong> {{ $product->stock }} {{ $product->unit }}</p>

                        <!-- Buttons 2x2 Grid -->
                        <div class="d-grid gap-2 mt-auto">
                            <div class="d-flex gap-2 justify-content-center flex-wrap">
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning flex-fill fw-semibold">Edit</a>
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-info flex-fill fw-semibold text-white">View</a>
                            </div>
                            <div class="d-flex gap-2 justify-content-center flex-wrap">
                                <!-- Delete Button triggers reusable modal -->
                                <button class="btn btn-danger flex-fill fw-semibold delete-btn" data-bs-toggle="modal" data-bs-target="#delete-modal-{{ $product->id }}" href="#">
                                               Delete

                                </button>

                                <form action="#" method="POST" class="flex-fill">
                                    @csrf
                                    <button type="submit" class="btn btn-success flex-fill fw-semibold">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                         <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="delete-modal-{{ $product->id }}" tabindex="-1" aria-hidden="true">
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
                                                    Are you sure you want to delete <strong>{{ $product->name }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="fs-5 text-muted">No products found.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>

</div>

<!-- Reusable Delete Modal -->


@endsection


