<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'email',
                Rule::unique('customer_profiles', 'email')->ignore($this->customer),
            ],

            'phone' => [
                'required',
                Rule::unique('customer_profiles', 'phone')->ignore($this->customer),
            ],

            'gender'        => ['nullable', 'in:male,female,other'],
            'date_of_birth' => ['nullable', 'date'],

            // password optional on update
            'password' => ['nullable', 'min:6', 'confirmed'],

            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],

            // address
            'address_type' => ['required', 'in:shipping,billing'],
            'country'      => ['required', 'string', 'max:100'],
            'city'         => ['required', 'string', 'max:100'],
            'address'      => ['required', 'string'],
            'postal_code'  => ['nullable', 'string', 'max:20'],

            // note
            'note' => ['nullable', 'string'],
        ];
    }
}
