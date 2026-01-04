@extends('layout.app')
@section('content')

<div class="content">

    <!-- Page Header -->
    <div class="page-header d-flex justify-content-between align-items-center flex-wrap">
        <div>
            <h4 class="fw-bold">Customers</h4>
            <h6>Manage your customers</h6>
        </div>

        <div class="d-flex align-items-center gap-2">
            <a data-bs-toggle="tooltip" title="Pdf" href="#"><img src="{{ asset('assets/img/icons/pdf.svg') }}" alt="Pdf"></a>
            <a data-bs-toggle="tooltip" title="Excel" href="#"><img src="{{ asset('assets/img/icons/excel.svg') }}" alt="Excel"></a>
            <a data-bs-toggle="tooltip" title="Refresh" href="#"><i class="ti ti-refresh"></i></a>
            <a data-bs-toggle="tooltip" title="Collapse" href="#" id="collapse-header"><i class="ti ti-chevron-up"></i></a>
            <a href="{{ route('customers.create') }}" class="btn btn-primary text-white ms-2">
                <i class="ti ti-circle-plus me-1"></i> Add Customer
            </a>
        </div>
    </div>

    <!-- Search & Status Filter -->
    <div class="d-flex justify-content-between mb-3 align-items-center">
        <!-- Search -->
        <form method="GET" class="d-flex gap-2">
            <input type="search" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search customers">
            <button class="btn btn-primary">Search</button>
            <input type="hidden" name="per_page" value="{{ $perPage }}">
        </form>

        <!-- Status Filter -->
        <div class="dropdown">
            <a href="javascript:void(0);" class="btn btn-white dropdown-toggle" data-bs-toggle="dropdown">
                Status
            </a>
            <ul class="dropdown-menu dropdown-menu-end p-3">
                <li><a href="{{ request()->fullUrlWithQuery(['status' => 'active']) }}" class="dropdown-item rounded-1">Active</a></li>
                <li><a href="{{ request()->fullUrlWithQuery(['status' => 'inactive']) }}" class="dropdown-item rounded-1">Inactive</a></li>
            </ul>
        </div>
    </div>

    <!-- Customers Table -->
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="thead-light">
                        <tr>
                            <th>
                                <label class="checkboxs">
                                    <input type="checkbox" id="select-all">
                                    <span class="checkmarks"></span>
                                </label>
                            </th>
                            <th>Code</th>
                            <th>Customer</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $customer)
                        <tr>
                            <td>
                                <label class="checkboxs">
                                    <input type="checkbox">
                                    <span class="checkmarks"></span>
                                </label>
                            </td>
                            <td>CU00{{ $customer->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="javascript:void(0);" class="avatar avatar-md me-2">
                                        <img src="{{ asset('storage/' . $customer->photos) }}" alt="{{ $customer->customer_name }}">
                                    </a>
                                    <span>{{ $customer->customer_name }}</span>
                                </div>
                            </td>
                            <td>{{ $customer->email }}</td>
                            <td>+{{ $customer->phone }}</td>
                            <td>{{ $customer->address->first()?->address ?? '-' }}</td>
                            <td>{{ $customer->address->first()?->city ?? '-' }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                             <a class="dropdown-item" href="{{ route('customers.show', $customer->id) }}">
                    <i class="feather feather-eye me-1"></i> View
                </a>
            
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('customers.edit', $customer->id) }}">
                                                <i class="feather feather-edit me-1"></i> Edit
                                            </a>
                                        </li>
                                        <li>
                                            <!-- Delete triggers modal -->
                                            <a class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#delete-modal-{{ $customer->id }}" href="#">
                                                <i class="feather feather-trash-2 me-1"></i> Delete
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="delete-modal-{{ $customer->id }}" tabindex="-1" aria-hidden="true">
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
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">No customers found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination & Row-Per-Page -->
                <div class="d-flex justify-content-between align-items-center p-3">

                    <!-- Row-per-page selector -->
                    <form method="GET" id="perPageForm" class="d-flex align-items-center gap-2">
                        <label class="me-2">Row Per Page:</label>
                        <select name="per_page" class="form-select form-select-sm" style="width:auto;"
                                onchange="document.getElementById('perPageForm').submit()">
                            <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                        </select>

                        <input type="hidden" name="search" value="{{ request('search') }}">
                    </form>

                    <!-- Pagination links -->
                    <div>
                        {{ $customers->links('pagination::bootstrap-5') }}
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

@endsection
