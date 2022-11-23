<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\ProductsService;
use Illuminate\Http\JsonResponse;
use App\Modules\Common\ResponseCodes;
use Illuminate\Support\Facades\Cache;

class ProductsController
{
    private ProductsService $service;

    public function __construct(ProductsService $service)
    {
        $this->service = $service;
    }

    public function index() : JsonResponse
    {
        try {
            $products = Cache::remember('products-page-' . request('page', 1), now()->addMinutes(5), function() {
                return response()->json($this->service->all());
            });

            return $products;
        } catch (Exception $exception) {
            return response()->json(
                [
                    'exception' => get_class($exception),
                    'error'     => $exception->getMessage()
                ],
                ResponseCodes::BAD_REQUEST['code']
            );
        }
    }

    public function show(int $id) : JsonResponse
    {
        try {
            return response()->json(
                [
                    'data'    => $this->service->get($id),
                    'message' => ResponseCodes::SUCCESS['message']
                ],
                ResponseCodes::SUCCESS['code']
            );
        } catch (Exception $exception) {
            return response()->json(
                [
                    'exception' => get_class($exception),
                    'error'     => $exception->getMessage()
                ],
                ResponseCodes::BAD_REQUEST['code']
            );
        }
    }

    public function store(Request $request) : JsonResponse
    {
        try {
            $newData = ($request->toArray() !== [])
                ? $request->toArray()
                : $request->json()->all();
            
            return response()->json(
                [
                    'data'    => $this->service->store($newData),
                    'message' => ResponseCodes::CREATED['message']
                ],
                ResponseCodes::CREATED['code']
            );
        } catch (Exception $exception) {
            return response()->json(
                [
                    'exception' => get_class($exception),
                    'error'     => $exception->getMessage()
                ],
                ResponseCodes::BAD_REQUEST['code']
            );
        }
    }

    public function update(int $id, Request $request) : JsonResponse
    {
        try {
            $newData = ($request->toArray() !== [])
                ? $request->toArray()
                : $request->json()->all();
                
            return response()->json(
                [
                    'data'    => $this->service->update($id, $newData),
                    'message' => ResponseCodes::UPDATED['message']
                ],
                ResponseCodes::UPDATED['code']
            );
        } catch (Exception $exception) {
            return response()->json(
                [
                    'exception' => get_class($exception),
                    'error'     => $exception->getMessage()
                ],
                ResponseCodes::BAD_REQUEST['code']
            );
        }
    }

    public function delete(int $id) : JsonResponse
    {
        try {
            $result = $this->service->delete($id);
            
            return response()->json(
                [
                    'data'    => ['id' => $id],
                    'message' => ($result === 1)
                            ? ResponseCodes::DELETED['message']
                            : ResponseCodes::BAD_REQUEST['message'] 
                ],
                ($result === 1)
                    ? ResponseCodes::DELETED['code'] 
                    : ResponseCodes::BAD_REQUEST['code']
            );
        } catch (Exception $exception) {
            return response()->json(
                [
                    'exception' => get_class($exception),
                    'error'     => $exception->getMessage()
                ],
                ResponseCodes::BAD_REQUEST['code']
            );
        }
    }
}
