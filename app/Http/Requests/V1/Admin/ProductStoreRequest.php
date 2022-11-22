<?php

namespace App\Http\Requests\V1\Admin;

use App\Rules\CheckExistBrandRule;
use App\Rules\CheckExistCategoryRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'name' => 'bail|required|max:100|unique:products',
            'price' => 'bail|required',
            'image' => 'bail|nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
            'description' => 'bail|nullable|max:10000',
            'status' => 'bail|numeric',
            'category_id' => [
                'bail',
                'numeric',
                new CheckExistCategoryRule(
                    __('validation.custom.foreignkey.exists',
                        [
                            'id' => request('category_id'),
                            'name' => 'category_product'
                        ]
                    )
                )
            ],
            'brand_id' => [
                'bail',
                'numeric',
                new CheckExistBrandRule(
                    __('validation.custom.foreignkey.exists',
                        [
                            'id' => request('brand_id'),
                            'name' => 'brands'
                        ]
                    )
                )
            ],
        ];
    }
}
