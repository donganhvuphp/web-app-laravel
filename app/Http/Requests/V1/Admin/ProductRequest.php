<?php

namespace App\Http\Requests\V1\Admin;

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
            'name'        => ['bail', 'required'],
            'price'       => ['bail', 'required'],
            'image'       => ['bail', 'nullable'],
            'description' => ['bail'],
            'status'      => ['bail', 'numeric'],
            'category_id' => ['bail', 'numeric'],
            'brand_id'    => ['bail', 'numeric'],
        ];
    }
}
