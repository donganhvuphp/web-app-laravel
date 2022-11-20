<?php

namespace App\Http\Requests\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
            'name'        => 'bail|required|max:100|unique:brands,name,' . request('id') ,
            'image'       => 'bail|nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
            'description' => 'nullable|max:10000',
        ];
    }
}
