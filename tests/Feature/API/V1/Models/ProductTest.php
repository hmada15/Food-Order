<?php

namespace Tests\Feature\API\V1\Models;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $product;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();

        $this->user = User::whereId(2)->first();

        $product_category = factory(ProductCategory::class)->create([
            'is_publish' => 'option-yes',
        ]);

        $this->product = factory(Product::class)->create([
            "name" => "test product name",
            'is_publish' => 'option-yes',
            'category_id' => $product_category->id,
        ]);

    }

    public function test_everyone_can_access_products()
    {
        $this->json('get', 'api/v1/products')
            ->assertStatus(Response::HTTP_OK);
    }

    public function test_can_get_single_product()
    {
        $this->json('get', "api/v1/products/{$this->product->id}")
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonFragment([
                "name" => "test product name",
            ]);
    }

    public function test_canoot_access_unpublished_products()
    {
        $this->json('get', 'api/v1/products')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonMissing([
                "is_publish" => "option-no",
            ]);
    }

}
