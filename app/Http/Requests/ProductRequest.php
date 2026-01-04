<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public function authorize()
    {

        return true;
    }

    public function rules()
    {
        $productId = $this->route('product')?->id ?? null; // For update

        return [
            'name'        => 'required|string|max:255',
            'sku'         => [
                'required',
                'string',
                'max:50',
                $productId
                    ? Rule::unique('products','sku')->ignore($productId)
                    : 'unique:products,sku'
            ],
            'category'    => 'required|string|max:100',
            'brand'       => 'required|string|max:100',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'sale_price'  => 'nullable|numeric|lt:price',
            'stock'       => 'required|integer|min:0',
            'unit'        => ['required', Rule::in(['pcs','kg','pack','pair'])],
            'status'      => ['required', Rule::in(['active','inactive','out_of_stock'])],
            'thumbnail'   => $productId ? 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' : 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'sale_price.lt' => 'Sale price must be less than the regular price.',
            'unit.in'       => 'Unit must be pcs, kg,  pack or pair .',
            'status.in'     => 'Status must be active, inactive, or out_of_stock.',
        ];
    }
}
