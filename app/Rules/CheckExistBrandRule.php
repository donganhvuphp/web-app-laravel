<?php

namespace App\Rules;

use App\Models\Brand;
use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Contracts\Validation\Rule;

class CheckExistBrandRule implements Rule
{
    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Brand::where('id', $value)->count() > 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
