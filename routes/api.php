<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(ProductsController::class)->group(function() {
    Route::get('/products', 'show');
    Route::get('/products/:id', 'get');
    Route::post('/products', 'update');
    Route::put('/products/:id', 'update');
    Route::delete('/products/:id', 'delete');
});
