<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'price' => 'required|max:20',
            'price_sale' => 'required|max:20|lt:price',
            'content' => 'string|nullable',
            'detail' => 'string|nullable',
            'img_list' => 'image|nullable',
            'thumbnail' => 'image|nullable',
            'view' => 'integer',
            'count_in_sock' => 'integer',
            'category_id' => 'required'
        ];
    }
}
