<?php

namespace Tests\Feature\API\V1\Models;

use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ProductCateogryTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $product_cateogry;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();

        $this->user = User::whereId(2)->first();

        $this->product_cateogry = factory(ProductCategory::class)->create([
            'name' => 'category name test',
            'is_publish' => 'option-yes',
        ]);

    }

    public function test_everyone_can_access_product_categories()
    {
        $this->getJson('api/v1/products')
            ->assertStatus(Response::HTTP_OK);
    }

    public function test_can_get_single_product_category()
    {
        $this->getJson("api/v1/product-categories/{$this->product_cateogry->id}")
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonFragment([
                "name" => "category name test",
            ]);
    }

    public function test_canoot_access_unpublished_products()
    {
        $this->getJson('api/v1/product-categories')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonMissing([
                "is_publish" => "option-no",
            ]);
    }

    public function test_get_404_on_unknown_category()
    {
        $this->getJson('api/v1/product-categories/55516621031547')
            ->assertStatus(Response::HTTP_NOT_FOUND);
    }

}
