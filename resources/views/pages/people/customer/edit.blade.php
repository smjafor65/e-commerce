@extends('layout.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Edit Customer</h4>

    <form action="{{ route('customers.update', $customer->id) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')


        <div class="card mb-3">
            <div class="card-header">Basic Information</div>
            <div class="card-body row">

                <div class="col-md-6 mb-3">
                    <label>Name</label>
                    <input type="text"
                           name="customer_name"
                           class="form-control @error('customer_name') is-invalid @enderror"
                           value="{{ old('customer_name', $customer->customer_name) }}">
                    @error('customer_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label>Email</label>
                    <input type="email"
                           name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email', $customer->email) }}">
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label>Phone</label>
                    <input type="text"
                           name="phone"
                           class="form-control @error('phone') is-invalid @enderror"
                           value="{{ old('phone', $customer->phone) }}">
                    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label>Gender</label>
                    <select name="gender" class="form-control">
                        <option value="">Select</option>
                        <option value="male" {{ old('gender', $customer->gender) == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender', $customer->gender) == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ old('gender', $customer->gender) == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label>Date of Birth</label>
                    <input type="date"
                           name="date_of_birth"
                           class="form-control"
                           value="{{ old('date_of_birth', $customer->date_of_birth) }}">
                </div>

            </div>
        </div>


        <div class="card mb-3">
            <div class="card-header">Profile Photo</div>
            <div class="card-body">
                <input type="file" name="photo" class="form-control mb-2">
                @error('photo') <div class="text-danger small">{{ $message }}</div> @enderror

                @if($customer->photos)
                    <img src="{{ asset('storage/'.$customer->photos) }}"
                         width="100"
                         class="img-thumbnail">
                @endif
            </div>
        </div>


        <div class="card mb-3">
            <div class="card-header">Change Password (Optional)</div>
            <div class="card-body row">
                <div class="col-md-6">
                    <input type="password" name="password" class="form-control" placeholder="New Password">
                </div>
                <div class="col-md-6">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                </div>
            </div>
        </div>


        <div class="card mb-3">
            <div class="card-header">Address</div>
            <div class="card-body row">

                @php
    $address = $customer->address->first();
@endphp

<div class="col-md-4 mb-3">
    <label>Address Type</label>
    <select name="address_type" class="form-control">
        <option value="shipping" {{ optional($address)->type == 'shipping' ? 'selected' : '' }}>
            Shipping
        </option>
        <option value="billing" {{ optional($address)->type == 'billing' ? 'selected' : '' }}>
            Billing
        </option>
    </select>
</div>

                <div class="col-md-4 mb-3">
                    <label>Country</label>
                    <input type="text"
                           name="country"
                           class="form-control"
                           value="{{ $address->country }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label>City</label>
                    <input type="text"
                           name="city"
                           class="form-control"
                           value="{{ $address->city }}">
                </div>

                <div class="col-md-8 mb-3">
                    <label>Address</label>
                    <input type="text"
                           name="address"
                           class="form-control"
                           value="{{ $address->address }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Postal Code</label>
                    <input type="text"
                           name="postal_code"
                           class="form-control"
                           value="{{ $address->postal_code }}">
                </div>

            </div>
        </div>
                        @php
    $note = $customer->notes->first();
@endphp


        <div class="card mb-3">
            <div class="card-header">Note</div>
            <div class="card-body">
                <textarea name="note" class="form-control" rows="3">{{$note->note }}</textarea>
            </div>
        </div>


        <div class="text-end">
            <a href="{{ route('customers.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Update Customer</button>
        </div>

    </form>
</div>
@endsection
