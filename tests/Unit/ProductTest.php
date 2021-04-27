<?php

namespace Tests\Unit;

use App\Models\Product;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public function test_model_creation()
    {
        $product = Product::factory()->make();
        $this->assertInstanceOf(Product::class, $product);
    }
}
