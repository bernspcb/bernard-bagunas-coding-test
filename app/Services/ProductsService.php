<?php

namespace App\Services;

use App\Modules\Validators\ProductsValidator;
use App\Modules\Interfaces\ProductsRepositoryInterface;
use App\Modules\Common\ResponseCodes;
use Illuminate\Support\Facades\Cache;

class ProductsService
{
    private ProductsRepositoryInterface $repository;
    
    private ProductsValidator $validator;

    public function __construct(
        ProductsRepositoryInterface $repository,
        ProductsValidator $validator
    )
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function all()
    {
        try {
            if (request('limit') !== null) {
                return $this->repository->getAllProducts(request('limit'));
            }

            $products = Cache::remember('products-page-' . request('page', 1), now()->addMinutes(5), function() {
                return $this->repository->getAllProducts(request('limit', 10));
            });

            return $products;
        } catch (Exception $exception) {
            return [
                'exception' => get_class($exception),
                'error'     => $exception->getMessage(),
                'code'      => ResponseCodes::BAD_REQUEST['code']
            ];
        }
    }

    public function get(int $id)
    {
        try {
            return [
                'data'    => $this->repository->getProductById($id),
                'message' => ResponseCodes::SUCCESS['message'],
                'code'    => ResponseCodes::SUCCESS['code']
            ];
        } catch (Exception $exception) {
            return [
                'exception' => get_class($exception),
                'error'     => $exception->getMessage(),
                'code'      => ResponseCodes::BAD_REQUEST['code']
            ];
        }
    }

    public function store()
    {
        try {
            $this->validator->validateProducts();
            $result = $this->repository->createProduct(request()->toArray());
            
            return [
                'data'    => $result,
                'message' => ResponseCodes::CREATED['message'],
                'code'    => ResponseCodes::CREATED['code']
            ];
        } catch (Exception $exception) {
            return [
                'exception' => get_class($exception),
                'error'     => $exception->getMessage(),
                'code'      => ResponseCodes::BAD_REQUEST['code']
            ];
        }
    }

    public function update(int $id)
    {
        try {
            $this->validator->validateProducts();
            $this->repository->updateProduct($id, request()->toArray());
            $query = $this->repository->getProductById($id);
            
            return [
                'data'    => $query,
                'message' => ResponseCodes::UPDATED['message'],
                'code'    => ResponseCodes::UPDATED['code']
            ];
        } catch (Exception $exception) {
            return [
                'exception' => get_class($exception),
                'error'     => $exception->getMessage(),
                'code'      => ResponseCodes::BAD_REQUEST['code']
            ];
        }
    }

    public function delete(int $id)
    {
        try {
            $result = $this->repository->deleteProduct($id);
            
            return [
                'data'    => ['id' => $id],
                'message' => ($result === 1) ? ResponseCodes::DELETED['message'] : ResponseCodes::BAD_REQUEST['message'],
                'code'    => ($result === 1) ? ResponseCodes::DELETED['code'] : ResponseCodes::BAD_REQUEST['code']
            ];
        } catch (Exception $exception) {
            return [
                'exception' => get_class($exception),
                'error'     => $exception->getMessage(),
                'code'      => ResponseCodes::BAD_REQUEST['code']
            ];
        }
    }
}
