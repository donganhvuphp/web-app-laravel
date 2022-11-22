<?php

namespace App\Rules;

use App\Models\Product;
use Illuminate\Contracts\Validation\Rule;

class CheckExistProductRule implements Rule
{
    protected $message;

    /**
     * @param $message
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    public function passes($attribute, $value)
    {
        return Product::where('id', $value)->count() > 0;
    }

    public function message()
    {
        return $this->message;
    }
}
