<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(?string $ignoreProductId = null)
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('products', 'name')->ignore($ignoreProductId)],
            'price' => ['required', 'numeric', 'integer', 'min:0'],
            'thumbnail' => ['sometimes', 'nullable', 'image', 'max:1024'],
        ];
    }

    public function messages()
    {
        return [
            'required' => __('messages.validations.required'),
            'name.max' => __('messages.validations.max_char', ['max' => 255]),
            'name.unique' => __('messages.validations.product_already_created'),
            'price.numeric' => __('messages.validations.only_numbers'),
            'price.integer' => __('messages.validations.integer'),
            'price.min' => __('messages.validations.price_min_zero'),
            'thumbnail.image' => __('messages.validations.only_images'),
            'thumbnail.max' => __('messages.validations.big_file'),
        ];
    }
}
