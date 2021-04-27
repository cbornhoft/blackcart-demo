<?php

namespace Tests\Feature;

use App\Models\{Store, User};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    protected $currentId;

    protected function setUp(): void
    {
        parent::setUp();

        $stores = Store::factory()->count(3)->create();
        $this->currentId = $stores[0]->id;

        Sanctum::actingAs(
            User::factory()->create()
        );
    }

    public function test_get_store_list()
    {
                $response = $this->getJson('/api/stores');

        $response
            ->assertJson(
                fn(AssertableJson $json) => $json->first(
                        fn($json) => $json->where('id', $this->currentId)
                            ->whereType('platform', 'string')
                    )
            );
    }

    public function test_find_store()
    {
        $response = $this->getJson("/api/stores/{$this->currentId}");

        $response
            ->assertOk()
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->where('id', $this->currentId)
                    ->etc()
            );
    }

    public function test_create_store()
    {
        $response = $this->postJson('/api/stores', ['platform' => 'blackcart']);

        $response
            ->assertCreated()
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->where('platform', 'blackcart')
                    ->etc()
            );
    }

    public function test_update_store()
    {
        $response = $this->putJson("/api/stores/{$this->currentId}", ['platform' => 'blackcart-edit']);

        $response
            ->assertOk()
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->where('platform', 'blackcart-edit')
                    ->etc()
            );
    }

    public function test_delete_store()
    {
        $response = $this->deleteJson("/api/stores/{$this->currentId}");

        $response
            ->assertOk()
            ->assertSee('1');
    }
}
