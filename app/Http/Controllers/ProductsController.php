<?php

namespace App\Http\Controllers;

use App\Services\ProductsService;
use Illuminate\Http\JsonResponse;

class ProductsController
{
    private ProductsService $service;

    public function __construct(ProductsService $service)
    {
        $this->service = $service;
    }

    public function index() : JsonResponse
    {
        return response()->json($this->service->all());
    }

    public function show(int $id) : JsonResponse
    {
        $result = $this->service->get($id);
        
        return response()->json(
            [
                'data'    => $result['data'],
                'message' => $result['message'],
            ],
            $result['code']
        );
    }

    public function store() : JsonResponse
    {
        $result = $this->service->store();
        
        return response()->json(
            [
                'data'    => $result['data'],
                'message' => $result['message'],
            ],
            $result['code']
        );
    }

    public function update(int $id) : JsonResponse
    {
        $result = $this->service->update($id);
        
        return response()->json(
            [
                'data'    => $result['data'],
                'message' => $result['message'],
            ],
            $result['code']
        );
    }

    public function delete(int $id) : JsonResponse
    {
        $result = $this->service->delete($id);
         
        return response()->json(
            [
                'data'    => $result['data'],
                'message' => $result['message'],
            ],
            $result['code']
        );
    }
}
