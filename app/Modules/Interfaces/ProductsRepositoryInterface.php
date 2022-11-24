<?php

namespace App\Modules\Interfaces;

interface ProductsRepositoryInterface
{
    public function getAllProducts(int $limit);

    public function getProductById(int $id);

    public function createProduct(array $data);

    public function updateProduct(int $id, array $newData);

    public function deleteProduct(int $id);
}
