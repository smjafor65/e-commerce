<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return true;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    // public function rules(): array
    // {
    //     return [
    //         //
    //     ];
    // }

     public function authorize(): bool
    {
        return true; // auth middleware already applied
    }

    public function rules(): array
    {
        return [
            // customer_profiles
            'customer_name'   => 'required|string|max:255',
            'email'           => 'nullable|email|unique:customer_profiles,email',
            'gender'          => 'nullable|in:male,female,other',
            'date_of_birth'   => 'nullable|date',
            'phone'           => 'nullable|string|max:20',
            'password'        => 'required|min:6',

              'photos'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            // customer_addresses
            'country'         => 'required|string|max:100',
            'city'            => 'required|string|max:100',
            'address'         => 'required|string',
            'postal_code'     => 'nullable|string|max:20',

            // customer_notes
            'note'            => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'customer_name.required' => 'Customer name is required',
            'country.required'       => 'Country is required',
            'city.required'          => 'City is required',
            'address.required'       => 'Address is required',
            'password.required'      => 'Password is mandatory',
        ];
    }
}
