<?php

namespace App\Repositories;

use App\Modules\Interfaces\ProductsRepositoryInterface;
use App\Models\Product;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;

class ProductsRepository implements ProductsRepositoryInterface
{
    public function getAllProducts()
    {
        return Product::paginate(10);
    }

    public function getProductById(int $id)
    {
        return Product::findOrFail($id);
    }

    public function createProduct(array $data)
    {
        return Product::create($data);
    }

    public function updateProduct(int $id, array $newData)
    {
        return Product::whereId($id)->update($newData);
    }

    public function deleteProduct(int $id)
    {
        return Product::destroy($id);
    }
}
