@extends('layout.app')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header">
            <h4>Create Customer</h4>
        </div>

        <div class="card-body">

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Customer Info --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Customer Name *</label>
                        <input type="text" name="customer_name" class="form-control"
                               value="{{ old('customer_name') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control"
                               value="{{ old('email') }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control"
                               value="{{ old('phone') }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Gender</label>
                        <select name="gender" class="form-control">
                            <option value="">Select</option>
                            <option value="male" {{ old('gender')=='male'?'selected':'' }}>Male</option>
                            <option value="female" {{ old('gender')=='female'?'selected':'' }}>Female</option>
                            <option value="other" {{ old('gender')=='other'?'selected':'' }}>Other</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Date of Birth</label>
                        <input type="date" name="date_of_birth" class="form-control"
                               value="{{ old('date_of_birth') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Password *</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Photo</label>
                        <input type="file" name="photo" class="form-control">
                    </div>
                </div>

                <hr>

                {{-- Address --}}
                <h5>Address Information</h5>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Country *</label>
                        <input type="text" name="country" class="form-control"
                               value="{{ old('country') }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>City *</label>
                        <input type="text" name="city" class="form-control"
                               value="{{ old('city') }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Postal Code</label>
                        <input type="text" name="postal_code" class="form-control"
                               value="{{ old('postal_code') }}">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Address *</label>
                        <textarea name="address" class="form-control" rows="3">{{ old('address') }}</textarea>
                    </div>
                </div>

                <hr>

                {{-- Notes --}}
                <div class="mb-3">
                    <label>Note</label>
                    <textarea name="note" class="form-control" rows="3">{{ old('note') }}</textarea>
                </div>

                {{-- Submit --}}
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        Save Customer
                    </button>
                    <a href="{{ route('customers.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
