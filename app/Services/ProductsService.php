<?php

namespace App\Services;

use App\Models\Product;
use App\Modules\Core\ResponseCodes;
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
        $this->validator->validateProducts();
        return $this->repository->createProduct($data);
    }

    public function update(int $id, array $data)
    {
        $this->validator->validateUpdateProducts();
        $query = $this->repository->getProductById($id);
        $this->repository->updateProduct($id, $data);
        return $this->repository->getProductById($id);
    }

    public function delete(int $id)
    {
        $query = $this->repository->deleteProduct($id);

        if ($query === 0) {
            return ResponseCodes::NOT_FOUND;
        }
        
        return ResponseCodes::SUCCESS;
    }
}
