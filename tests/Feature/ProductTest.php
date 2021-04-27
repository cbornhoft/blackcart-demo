<?php

namespace Tests\Feature;

use App\Models\{Product, Store};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Store::factory()->count(3)->create();
        Product::factory()->count(20)->create();
    }

    public function test_get_product_list()
    {
        $response = $this->getJson('/api/stores/3/products');

        $response
            ->assertOk()
            ->assertJsonCount(6, '0');
    }
}
