<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use App\Services\ProductsService;
use App\Repositories\ProductsRepository;
use App\Http\Controllers\ProductsController;
use App\Modules\Validators\ProductsValidator;

class ProductsTest extends TestCase
{
    public function test_if_all_products_is_success()
    {
        $data = (new ProductsController(new ProductsService(new ProductsRepository, new ProductsValidator)))->index();
        $this->assertNotEmpty($data);
    }

    public function test_if_get_product_is_success()
    {
        $newProduct = Product::factory()->create([
            'name'        => 'Product 1',
            'description' => 'Product description',
            'price'       => 999
        ]);

        $data = (new ProductsController(new ProductsService(new ProductsRepository, new ProductsValidator)))->show($newProduct->id);
        $this->assertNotEmpty($data);
    }

    public function test_if_create_product_is_success()
    {
        $newProduct = [
            'name'        => 'Product 1',
            'description' => 'Product description',
            'price'       => 999
        ];
        
        $data = $this->call('POST', 'api/products', $newProduct);
        $this->assertNotEmpty($data);
    }

    public function test_if_update_product_is_success()
    {
        $product = Product::factory()->create([
            'name'        => 'Product 1',
            'description' => 'Product description',
            'price'       => 999
        ]);

        $newProduct = [
            'name'        => 'Product 1',
            'description' => 'Product description',
            'price'       => 999
        ];
        
        $data = $this->call('PUT', 'api/products/' . $product->id, $newProduct);
        $this->assertNotEmpty($data);
    }

    public function test_if_delete_product_is_success()
    {
        $product = Product::factory()->create([
            'name'        => 'Product 1',
            'description' => 'Product description',
            'price'       => 999
        ]);
        
        $data = (new ProductsController(new ProductsService(new ProductsRepository, new ProductsValidator)))->delete($product->id);;
        $this->assertNotEmpty($data);
    }
}
