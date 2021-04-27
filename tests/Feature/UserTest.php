<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_register_user()
    {
        $name = $this->faker->name();

        $response = $this->postJson(
            '/api/register',
            [
                'name'     => $name,
                'email'    => $this->faker->unique()->safeEmail(),
                'password' => $this->faker->lexify('????????')
            ]
        );

        $response
            ->assertStatus(201)
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->where('user.name', $name)
                    ->missing('user.password')
                    ->etc()
            );
    }

    public function test_register_duplicate()
    {
        $email = $this->faker->unique()->safeEmail();

        $this->postJson(
            '/api/register',
            [
                'name'     => $this->faker->name(),
                'email'    => $email,
                'password' => $this->faker->lexify('????????')
            ]
        );

        $response = $this->postJson(
            '/api/register',
            [
                'name'     => $this->faker->name(),
                'email'    => $email,
                'password' => $this->faker->lexify('????????')
            ]
        );

        $response
            ->assertStatus(422)
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->where('errors.email.0', 'The email has already been taken.')
                    ->etc()
            );
    }

    public function test_create_token()
    {
        $name = $this->faker->name();
        $email = $this->faker->unique()->safeEmail();
        $password = $this->faker->lexify('????????');

        $this->postJson(
            '/api/register',
            [
                'name'     => $name,
                'email'    => $email,
                'password' => $password
            ]
        );

        $response = $this->postJson(
            '/api/token',
            [
                'email'    => $email,
                'password' => $password,
                'device_name' => "{$name}'s Device"
            ]
        );

        $response
            ->assertStatus(201)
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->whereType('token', 'string')
            );
    }

    public function test_create_token_with_bad_credentials()
    {
        $response = $this->postJson(
            '/api/token',
            [
                'email'    => $this->faker->unique()->safeEmail(),
                'password' => $this->faker->lexify('????????'),
                'device_name' => 'Device'
            ]
        );

        $response
            ->assertStatus(422)
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->where('errors.email.0', 'The provided credentials are incorrect.')
                    ->etc()
            );
    }
}
