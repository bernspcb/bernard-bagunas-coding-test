<?php

namespace App\Repositories;

use App\Models\Product;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use App\Modules\Common\ProductsMapper;

class ProductsRepository
{
    public function getAllProducts()
    {
        return Product::paginate(10);
    }

    public function getProductById(int $id)
    {
        return Product::findOrFail($id);
    }

    public function createProduct(Product $product)
    {
        
    }

    public function updateProduct(Product $product)
    {
        
    }

    public function deleteProduct(int $id)
    {

    }

}
