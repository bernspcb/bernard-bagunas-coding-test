<?php

declare(strict_types=1);

namespace App\Modules\Common;

use App\Models\Product;
use App\Modules\Common\Helpers;

class ProductsMapper
{
    public static function mapFrom(array $data) : Product
    {
        return new Product(
            Helpers::nullStringToInteger($data['id'] ?? null),
            $data['name'],
            $data['description'],
            $data['price'],
            $data['createdAt'],
            $data['updatedAt']
        );
    }
}
