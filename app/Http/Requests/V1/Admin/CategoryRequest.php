<?php

namespace App\Http\Requests\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'description' => ['bail', 'required'],
            'parent_id'   => ['bail', 'numeric', 'nullable'],
            'status'      => ['bail', 'numeric']
        ];
    }
}
