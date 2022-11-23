<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Product;
use App\Modules\Validators\ProductsValidator;

class ProductsService
{
    private ProductsValidator $validator;

    public function __construct(ProductsValidator $validator)
    {
        $this->validator = $validator;
    }

    public function all() : string
    {
        return 'asdas';
    }

    public function get(int $id) : Product
    {
        return 'asdas';
    }

    public function update(array $data) : Product
    {
        return 'asdas';
    }

    public function delete(int $id) : Product
    {
        return 'asdas';
    }
}
