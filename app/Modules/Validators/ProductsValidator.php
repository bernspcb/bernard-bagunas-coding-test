<?php

declare(strict_types=1);

namespace App\Modules\Validators;

use InvalidArgumentsException;

class ProductsValidator
{
    public function validateProducts(array $data) : void
    {
        $validator = validator($data, [
            'name'        => 'required|max:255',
            'description' => 'required|string',
            'price'       => 'required'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentsException(json_encode($validator->errors()->all()));
        }
    }
}
