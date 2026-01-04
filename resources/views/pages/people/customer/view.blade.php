@extends('layout.app')
@section('content')

<div class="content">

    <!-- Page Header -->
    <div class="page-header d-flex justify-content-between align-items-center flex-wrap mb-4">
        <div>
            <h4 class="fw-bold text-primary">Customer Details</h4>
            <h6 class="text-muted">Complete information for {{ $customer->customer_name }}</h6>
        </div>
        <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary">
            <i class="ti ti-arrow-left me-1"></i> Back to List
        </a>
    </div>

    <!-- Customer Card -->
    <div class="card shadow border-0 mb-4">
        <div class="card-body">

            <!-- Top: Avatar and Basic Info -->
            {{-- <div class="d-flex align-items-center gap-4 mb-4">
                <div class="avatar avatar-xl">
                    <img src="{{ asset('storage/' . $customer->photos) }}" alt="{{ $customer->customer_name }}" class="rounded-circle border border-3 border-primary">
                </div>
                <div>
                    <h3 class="mb-1 text-primary">{{ $customer->customer_name }}</h3>
                    <p class="mb-0"><i class="feather feather-mail me-1"></i> {{ $customer->email }}</p>
                    <p class="mb-0"><i class="feather feather-phone me-1"></i> +{{ $customer->phone }}</p>
                    <span class="badge {{ $customer->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                        {{ ucfirst($customer->status) }}
                    </span>
                </div>
            </div> --}}
            <!-- Top: Avatar and Basic Info -->
<div class="d-flex align-items-center gap-4 mb-4 flex-wrap">
    <!-- Big Avatar -->
    <div class="avatar avatar-xxl position-relative">
        <img src="{{ asset('storage/' . $customer->photos) }}"
             alt="{{ $customer->customer_name }}"
             class=" border border-4 border-primary shadow-sm"
             style="width:160px; height:100px; object-fit:cover;">
    </div>

    <!-- Customer Info -->
    <div class="flex-grow-1">
        <h2 class="mb-1 text-primary fw-bold">{{ $customer->customer_name }}</h2>

        <div class="d-flex flex-wrap gap-3 align-items-center mb-2">
            {{-- <span class="badge {{ $customer->status == 'active' ? 'bg-success' : 'bg-danger' }} fs-6">
                {{ ucfirst($customer->status) }}
            </span> --}}
            <span class="text-muted"><i class="feather feather-mail "></i> {{ $customer->email }}</span>
        </div>
        <p class="text-muted"><i class="feather feather-phone me-1"></i> +{{ $customer->phone }}</p>
    </div>
</div>


            <!-- Two-column Info Cards -->
            <div class="row g-4 mb-4">

                <!-- Addresses & Postal Code -->
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm p-3 h-100 bg-light">
                        <h6 class="text-primary mb-3">Addresses</h6>
                        <p><strong>Shipping:</strong> {{ $customer->address->firstWhere('type', 'shipping')?->address ?? '-' }}</p>
                        <p><strong>Billing:</strong> {{ $customer->address->firstWhere('type', 'billing')?->address ?? '-' }}</p>
                        <p><strong>City:</strong> {{ $customer->address->first()?->city ?? '-' }}</p>
                        <p><strong>Country:</strong> {{ $customer->address->first()?->country ?? '-' }}</p>
                        <p><strong>Postal Code:</strong> {{ $customer->address->first()?->postal_code ?? '-' }}</p>
                    </div>
                </div>

                <!-- Metadata & Personal Info -->
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm p-3 h-100 bg-light">
                        <h6 class="text-primary mb-3">Personal Info & Metadata</h6>
                        <p><strong>Customer ID:</strong> CU00{{ $customer->id }}</p>
                        <p><strong>Gender:</strong> {{ ucfirst($customer->gender ?? '-') }}</p>
                        <p><strong>Date of Birth:</strong> {{ $customer->dob?->format('d M Y') ?? '-' }}</p>
                        <p><strong>Created At:</strong> {{ $customer->created_at->format('d M Y, h:i A') }}</p>
                        <p><strong>Updated At:</strong> {{ $customer->updated_at->format('d M Y, h:i A') }}</p>
                        <p><strong>Total Notes:</strong> {{ $customer->notes->count() }}</p>
                    </div>
                </div>

            </div>

            <!-- Notes Section -->
            <div class="card border-0 shadow-sm p-3 mb-4 bg-light">
                <h6 class="text-primary mb-3">Customer Notes</h6>
                @forelse($customer->notes as $note)
                    <div class="alert alert-info rounded-2 mb-2 p-2">
                        <i class="feather feather-message-square me-1"></i> {{ $note->note }}
                        <span class="float-end text-muted small">{{ $note->created_at->format('d M Y') }}</span>
                    </div>
                @empty
                    <p class="text-muted">No notes available</p>
                @endforelse
            </div>

            <!-- Actions: Edit & Delete -->
            <div class="d-flex gap-2">
                <!-- Edit Button -->
                <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-primary">
                    <i class="feather feather-edit me-1"></i> Edit Customer
                </a>

                <!-- Delete Button triggers modal -->
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-modal">
                    <i class="feather feather-trash-2 me-1"></i> Delete Customer
                </button>
            </div>

        </div>
    </div>

</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="delete-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('customers.destroy', $customer->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title">Delete Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete <strong>{{ $customer->customer_name }}</strong>?
                    <p class="text-danger mt-2">This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
