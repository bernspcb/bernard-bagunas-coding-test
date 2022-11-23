<?php

namespace App\Services;

use App\Models\Product;
use App\Modules\Common\ResponseCodes;
use App\Modules\Validators\ProductsValidator;
use App\Modules\Interfaces\ProductsRepositoryInterface;

class ProductsService
{
    private ProductsValidator $validator;
    private ProductsRepositoryInterface $repository;

    public function __construct(
        ProductsValidator $validator,
        ProductsRepositoryInterface $repository
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
        $this->validator->validateProducts();
        return $this->repository->createProduct($data);
    }

    public function update(int $id, array $data)
    {
        $this->validator->validateUpdateProducts();
        $this->repository->updateProduct($id, $data);
        return $this->repository->getProductById($id);
    }

    public function delete(int $id)
    {
        return $this->repository->deleteProduct($id);
    }
}
