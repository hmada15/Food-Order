<?php

namespace Tests\Feature\API\V1\Models;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $product;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();

        $this->user = User::whereId(2)->first();

    }

    public function test_current_user_can_access_his_orders()
    {
        $this->actingAs($this->user)->getJson('api/v1/orders')
            ->assertStatus(Response::HTTP_OK);
    }

    /* public function test_can_get_single_product()
    {
        $this->getJson("api/v1/products/{$this->product->id}")
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonFragment([
                "name" => "test product name",
            ]);
    }

    public function test_canoot_access_unpublished_products()
    {
        $this->getJson('api/v1/products')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonMissing([
                "is_publish" => "option-no",
            ]);
    } */

}
