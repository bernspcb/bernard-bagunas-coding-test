<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\ProductsService;
use App\Modules\Core\ResponseCodes;

class ProductsController
{
    private ProductsService $service;

    public function __construct(ProductsService $service)
    {
        $this->service = $service;
    }

    public function show() : Response
    {
        try {
            return new Response(
                $this->service->all(),
                ResponseCodes::SUCCESS['code']
            );
        } catch (Exception $exception) {
            return new Response(
                [
                    'exception' => get_class($exception),
                    'error'     => $exception->getMessage()
                ],
                ResponseCodes::BAD_REQUEST['code']
            );
        }
    }

    public function get(int $id) : Response
    {
        try {
            return new Response(
                $this->service->get($id),
                ResponseCodes::SUCCESS['code']
            );
        } catch (Exception $exception) {
            return new Response(
                [
                    'exception' => get_class($exception),
                    'error'     => $exception->getMessage()
                ],
                ResponseCodes::BAD_REQUEST['code']
            );
        }
    }

    public function update(Request $request) : Response
    {
        try {
            $dataArray = ($request->toArray() !== [])
                ? $request->toArray()
                : $request->json()->all();

            return new Response(
                $this->service->update($dataArray),
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

    public function delete(int $id) : Response
    {
        try {
            return new Response(
                $this->service->delete($id),
                ResponseCodes::SUCCESS['code']
            );
        } catch (Exception $exception) {
            return new Response(
                [
                    'exception' => get_class($exception),
                    'error'     => $exception->getMessage()
                ],
                ResponseCodes::BAD_REQUEST['code']
            );
        }
    }
}
