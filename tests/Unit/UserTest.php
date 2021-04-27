<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_model_creation()
    {
        $user = User::factory()->make();
        $this->assertInstanceOf(User::class, $user);
    }
}
