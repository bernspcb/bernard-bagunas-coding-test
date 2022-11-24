<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductsTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_retrieve_products_successfully()
    {
        $product = Product::factory()->create([
            'name'        => 'Product 1',
            'description' => 'Product description',
            'price'       => 999
        ]);
        
        $this->json('GET', 'api/products', [], ['Accept' => 'application/json'])
             ->assertStatus(200);
    }

    public function test_create_product_successfully()
    {
        $product = [
            'name'        => 'Product 1',
            'description' => 'Product description',
            'price'       => 999
        ];

        $this->json('POST', 'api/products', $product, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJson([
                'data'    => $product,
                'message' => 'Request has been successfully created.'
            ]);
    }

    public function test_create_product_failure_missing_name_field()
    {
        $product = [
            'description' => 'Product description',
            'price'       => 999
        ];

        $this->json('POST', 'api/products', $product, ['Accept' => 'application/json'])
            ->assertStatus(400)
            ->assertJson([
                'exception' => "Illuminate\\Validation\\ValidationException",
                'error'     => 'The name field is required.'
            ]);
    }

    public function test_create_product_failure_maximum_characters_name_field()
    {
        $product = [
            'name'        => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dictum elit sed lobortis dignissim. Etiam ultricies diam vel venenatis aliquet. Integer placerat ex sollicitudin dui consequat laoreet. Donec sed rutrum elit. Nullam finibus nisl ac amam.',
            'description' => 'Product description',
            'price'       => 999
        ];

        $this->json('POST', 'api/products', $product, ['Accept' => 'application/json'])
            ->assertStatus(400)
            ->assertJson([
                'exception' => "Illuminate\\Validation\\ValidationException",
                'error'     => 'The name must not be greater than 255 characters.'
            ]);
    }

    public function test_create_product_failure_missing_description_field()
    {
        $product = [
            'name'  => 'Product 1',
            'price' => 999
        ];

        $this->json('POST', 'api/products', $product, ['Accept' => 'application/json'])
            ->assertStatus(400)
            ->assertJson([
                'exception' => "Illuminate\\Validation\\ValidationException",
                'error'     => 'The description field is required.'
            ]);
    }

    public function test_create_product_failure_missing_price_field()
    {
        $product = [
            'name'        => 'Product 1',
            'description' => 'Product description'
        ];

        $this->json('POST', 'api/products', $product, ['Accept' => 'application/json'])
            ->assertStatus(400)
            ->assertJson([
                'exception' => "Illuminate\\Validation\\ValidationException",
                'error'     => 'The price field is required.'
            ]);
    }

    public function test_create_product_failure_non_numeric_price_field()
    {
        $product = [
            'name'        => 'Product 1',
            'description' => 'Product description',
            'price'       => 'one thousand'
        ];

        $this->json('POST', 'api/products', $product, ['Accept' => 'application/json'])
            ->assertStatus(400)
            ->assertJson([
                'exception' => "Illuminate\\Validation\\ValidationException",
                'error'     => 'The price must be a number.'
            ]);
    }

    public function test_update_product_successfully()
    {
        $product = Product::factory()->create([
            'name'        => 'Product 1',
            'description' => 'Product description',
            'price'       => 999
        ]);

        $newProductData = [
            'name'        => 'New Product 1',
            'description' => 'New Product description',
            'price'       => 999
        ];

        $this->json('PUT', 'api/products/' . $product->id, $newProductData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                'data'    => $newProductData,
                'message' => 'Request has been updated successfully.'
            ]);
    }

    public function test_update_product_failure_missing_name_field()
    {
        $product = Product::factory()->create([
            'name'        => 'Product 1',
            'description' => 'Product description',
            'price'       => 999
        ]);

        $newProductData = [
            'description' => 'Product description',
            'price'       => 999
        ];

        $this->json('PUT', 'api/products/' . $product->id, $newProductData, ['Accept' => 'application/json'])
            ->assertStatus(400)
            ->assertJson([
                'exception' => "Illuminate\\Validation\\ValidationException",
                'error'     => 'The name field is required.'
            ]);
    }

    public function test_update_product_failure_maximum_characters_name_field()
    {
        $product = Product::factory()->create([
            'name'        => 'Product 1',
            'description' => 'Product description',
            'price'       => 999
        ]);

        $newProductData = [
            'name'        => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dictum elit sed lobortis dignissim. Etiam ultricies diam vel venenatis aliquet. Integer placerat ex sollicitudin dui consequat laoreet. Donec sed rutrum elit. Nullam finibus nisl ac amam.',
            'description' => 'Product description',
            'price'       => 999
        ];

        $this->json('PUT', 'api/products/' . $product->id, $newProductData, ['Accept' => 'application/json'])
            ->assertStatus(400)
            ->assertJson([
                'exception' => "Illuminate\\Validation\\ValidationException",
                'error'     => 'The name must not be greater than 255 characters.'
            ]);
    }

    public function test_update_product_failure_missing_description_field()
    {
        $product = Product::factory()->create([
            'name'        => 'Product 1',
            'description' => 'Product description',
            'price'       => 999
        ]);
        
        $newProductData = [
            'name'  => 'Product 1',
            'price' => 999
        ];

        $this->json('PUT', 'api/products/' . $product->id, $newProductData, ['Accept' => 'application/json'])
            ->assertStatus(400)
            ->assertJson([
                'exception' => "Illuminate\\Validation\\ValidationException",
                'error'     => 'The description field is required.'
            ]);
    }

    public function test_update_product_failure_missing_price_field()
    {
        $product = Product::factory()->create([
            'name'        => 'Product 1',
            'description' => 'Product description',
            'price'       => 999
        ]);
        
        $newProductData = [
            'name'        => 'Product 1',
            'description' => 'Product description'
        ];

        $this->json('PUT', 'api/products/' . $product->id, $newProductData, ['Accept' => 'application/json'])
            ->assertStatus(400)
            ->assertJson([
                'exception' => "Illuminate\\Validation\\ValidationException",
                'error'     => 'The price field is required.'
            ]);
    }

    public function test_update_product_failure_non_numeric_price_field()
    {
        $product = Product::factory()->create([
            'name'        => 'Product 1',
            'description' => 'Product description',
            'price'       => 999
        ]);
        
        $newProductData = [
            'name'        => 'Product 1',
            'description' => 'Product description',
            'price'       => 'one thousand'
        ];

        $this->json('PUT', 'api/products/' . $product->id, $newProductData, ['Accept' => 'application/json'])
            ->assertStatus(400)
            ->assertJson([
                'exception' => "Illuminate\\Validation\\ValidationException",
                'error'     => 'The price must be a number.'
            ]);
    }

    public function test_delete_successfully()
    {
        $product = Product::factory()->create([
            'name'        => 'Product 1',
            'description' => 'Product description',
            'price'       => 999
        ]);

        $this->json('DELETE', 'api/products/' . $product->id, [], ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                'data'    => ['id' => $product->id],
                'message' => 'Request has been deleted successfully.'
            ]);
    }

    public function test_delete_failure()
    {
        $productId = 9999;

        $this->json('DELETE', 'api/products/' . $productId, [], ['Accept' => 'application/json'])
            ->assertStatus(400)
            ->assertJson([
                'data'    => ['id' => $productId],
                'message' => 'Server failed to process the request.'
            ]);
    }
}
