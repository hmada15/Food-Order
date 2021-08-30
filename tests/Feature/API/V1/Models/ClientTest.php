<?php

namespace Tests\Feature\API\V1\Models;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $product_cateogry;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();

        $this->user = factory(Client::class)->create([
            'name' => 'client name',
            'email' => 'client@client.com',
            'phone_number' => '62541745',
        ]);

    }

    public function test_can_get_current_client()
    {
        $this->actingAs($this->user)->json('get', 'api/v1/clients')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonFragment([
                'name' => 'client name',
                'email' => 'client@client.com',
            ]);
    }

    public function test_can_update_current_client()
    {
        $this->actingAs($this->user)->putJson("api/v1/clients", [
            'name' => 'client name update',
            'email' => 'clientupdate@client.com',
        ])
            ->assertStatus(Response::HTTP_ACCEPTED)
            ->assertJsonFragment([
                'name' => 'client name update',
                'email' => 'clientupdate@client.com',
            ]);
    }

    public function test_can_delete_current_client()
    {
        $this->actingAs($this->user)->deleteJson('api/v1/clients')
            ->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseMissing("clients", [
            'name' => 'client name',
            'email' => 'client@client.com',
            'phone_number' => '62541745',
        ]);
    }

    public function test_cannot_send_user_id()
    {
        $this->actingAs($this->user)->getJson('api/v1/clients/1')
            ->assertStatus(Response::HTTP_NOT_FOUND);

        $this->actingAs($this->user)->getJson("api/v1/clients/{$this->user->id}")
            ->assertStatus(Response::HTTP_NOT_FOUND);
    }

}
