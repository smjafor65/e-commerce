@extends('layout.app')

@section('content')
<div class="container">


    <h3 class="text-danger mb-3">
        🔴 Critical Stock (Below {{ config('inventory.critical') }})
    </h3>

    @forelse($criticalStock as $category => $brands)
        <h4 class="mt-3">{{ $category }}</h4>

        @foreach($brands as $brand => $products)
            <span class="badge bg-primary mb-2">{{ $brand }}</span>

            <table class="table table-bordered table-sm">
                <thead class="table-danger">
                    <tr>
                        <th>Name</th>
                        <th>SKU</th>
                        <th>Stock</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->sku }}</td>
                            <td class="fw-bold text-danger">{{ $product->stock }}</td>
                            <td><span class="badge bg-danger">Critical</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
    @empty
        <p class="text-muted">No critical stock products </p>
    @endforelse


    <h3 class="text-warning mt-5 mb-3">
        🟠 Low Stock (Below {{ config('inventory.warning') }})
    </h3>

    @forelse($warningStock as $category => $brands)
        <h4 class="mt-3">{{ $category }}</h4>

        @foreach($brands as $brand => $products)
            <span class="badge bg-secondary mb-2">{{ $brand }}</span>

            <table class="table table-bordered table-sm">
                <thead class="table-warning">
                    <tr>
                        <th>Name</th>
                        <th>SKU</th>
                        <th>Stock</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->sku }}</td>
                            <td class="fw-bold text-warning">{{ $product->stock }}</td>
                            <td><span class="badge bg-warning text-dark">Low</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
    @empty
        <p class="text-muted">No warning stock products</p>
    @endforelse


    <h3 class="mt-5">📊 Category Stock Summary</h3>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Category</th>
                <th>Total Products</th>
                <th>Total Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categorySummary as $row)
                <tr>
                    <td>{{ $row->category }}</td>
                    <td>{{ $row->items }}</td>
                    <td>{{ $row->total_stock }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
