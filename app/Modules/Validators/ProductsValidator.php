<?php

namespace App\Modules\Validators;

use InvalidArgumentsException;

class ProductsValidator
{
    public function validateProducts() : void
    {
        $validator = request()->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric'
        ]);
    }
}
