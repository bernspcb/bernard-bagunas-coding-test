<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductsRepository;
use App\Modules\Validators\ProductsValidator;

class ProductsService
{
    private ProductsValidator $validator;
    private ProductsRepository $repository;

    public function __construct(
        ProductsValidator $validator,
        ProductsRepository $repository
    )
    {
        $this->validator = $validator;
        $this->repository = $repository;
    }

    public function all()
    {
        return $this->repository->getAllProducts();
    }

    public function get(int $id)
    {
        return $this->repository->getProductById($id);
    }

    public function store(array $data)
    {
        return $this->repository->createProduct($data);
    }

    public function update(array $data)
    {
        return $this->repository->updateProduct($data);
    }

    public function delete(int $id)
    {
        return $this->repository->deleteProduct($id);
    }
}
