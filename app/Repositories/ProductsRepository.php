<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Modules\Interfaces\ProductsRepositoryInterface;

class ProductsRepository implements ProductsRepositoryInterface
{
    public function getAllProducts($limit)
    {
        return Product::paginate($limit);
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
