<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\ProductsService;
use Illuminate\Http\JsonResponse;
use App\Modules\Core\ResponseCodes;

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
            return response()->json($this->service->all());
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
            return response()->json($this->service->get($id));
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
            
            return response()->json($this->service->store($newData));
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
                
            return response()->json($this->service->update($id, $newData));
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
            return response()->json($this->service->delete($id));
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
