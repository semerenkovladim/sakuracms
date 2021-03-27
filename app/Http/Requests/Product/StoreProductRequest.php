<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create-product');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255|min:3',
            'price' => 'required|numeric|min:0',
            'description' => 'required|min:3|max:2000',
            'short_description' => 'required|max:255|min:3',
            'meta_tags' => 'nullable|max:255|min:3',
            'meta_description' => 'nullable|max:255|min:3',
            'meta_title' => 'nullable|max:255|min:3',
            'category_id' => 'nullable|exists:categories',
            'images' => 'required|array'
        ];
    }
}
