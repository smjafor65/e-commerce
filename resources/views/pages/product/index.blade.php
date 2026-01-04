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
                    <img src="{{ asset('storage/products/' . $product->thumbnail) }}"
                         class="card-img-top"
                         style="height:220px; object-fit:cover;">

                    <!-- Card Body -->
                    <div class="card-body d-flex flex-column p-3">
<!-- Product Info -->
<h5 class="card-title fw-bold fs-4 text-dark mb-2">{{ $product->name }}</h5>

<p class="mb-1 text-dark"><strong>SKU:</strong> <span class="text-dark">{{ $product->sku }}</span></p>

<p class="mb-1 text-dark fw-semibold"><strong>Price:</strong> ${{ number_format($product->price, 2) }}

@if($product->sale_price)
    <span class="mb-1  text-success fw-bold"><strong>Sale:</strong> ${{ number_format($product->sale_price, 2) }}</span></p>
@endif

<p class="mb-2  text-dark"><strong>Stock:</strong> {{ $product->stock }} <span class="text-dark">{{ $product->unit }}</span></p>

                        <!-- Buttons 2x2 Grid -->
                        <div class="d-grid gap-2 mt-auto">
                            <div class="d-flex gap-2 justify-content-center flex-wrap">
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning flex-fill fw-semibold ">Edit</a>
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-info flex-fill fw-semibold  text-white">View</a>
                            </div>
                            <div class="d-flex gap-2 justify-content-center flex-wrap">
                                <button class="btn btn-danger flex-fill fw-semibold " data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $product->id }}" data-name="{{ $product->name }}">Delete</button>
                                <form action="" method="POST" class="flex-fill">
                                    @csrf
                                    <button type="submit" class="btn btn-success flex-fill fw-semibold  ">Add to Cart</button>
                                </form>
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

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form method="POST" id="deleteForm">
        @csrf
        @method('DELETE')
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">Delete Product</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete <strong id="productName"></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Yes, Delete</button>
            </div>
        </div>
    </form>
  </div>
</div>

<!-- Delete Modal Script -->
@push('scripts')
<script>
    var deleteModal = document.getElementById('deleteModal')
    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget
        var productId = button.getAttribute('data-id')
        var productName = button.getAttribute('data-name')

        var modalTitle = deleteModal.querySelector('#productName')
        modalTitle.textContent = productName

        var form = deleteModal.querySelector('#deleteForm')
        form.action = '/products/' + productId
    })
</script>
@endpush

@endsection
