<?php

namespace Tests\Unit;

use App\Models\Store;
use Tests\TestCase;

class StoreTest extends TestCase
{
    public function test_model_creation()
    {
        $store = Store::factory()->make();
        $this->assertInstanceOf(Store::class, $store);
    }
}
