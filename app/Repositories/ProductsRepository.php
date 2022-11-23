<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductsRepository
{
    private $tableName = 'products';
    private $selectedColumns = [
        'products.id',
        'products.name',
        'products.description',
        'products.price',
        'products.created_at AS createdAt',
        'products.updated_at AS updatedAt'
    ];

    public function all() : Product
    {

    }

    public function get(int $id) : Product
    {

    }

    public function update(Product $product) : Product
    {
        
    }

    public function delete(int $id) : Product
    {

    }

}
