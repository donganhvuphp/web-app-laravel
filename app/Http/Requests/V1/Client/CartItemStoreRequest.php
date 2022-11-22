<?php

namespace App\Http\Requests\V1\Client;

use App\Rules\CheckExistProductRule;
use Illuminate\Foundation\Http\FormRequest;

class CartItemStoreRequest extends FormRequest
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
            'product_id' => [
                'bail',
                'numeric',
                new CheckExistProductRule(
                    __('validation.custom.foreignkey.exists',
                        [
                            'id' => request('product_id'),
                            'name' => 'cart_item'
                        ]
                    )
                )
            ]
        ];
    }
}
