<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test user can log in with correct credentials.
     *
     * @return void
     */
    public function test_user_can_login_with_valid_credentials()
    {
        // Create a user with type 'user'
        $user = User::factory()->create([
            'email' => 'testuser@example.com',
            'password' => Hash::make('password123'),  // Hashed password
            'type' => 'user'
        ]);

        // Simulate login request
        $response = $this->postJson('/api/login', [
            'email' => 'testuser@example.com',
            'password' => 'password123',  // Plain text password
            'type' => 'user'
        ]);

        // Assert that the user received a successful response
        $response->assertStatus(200)
            ->assertJsonStructure([
                'user' => [
                    'id',
                    'name',
                    'email',
                    'type'
                ],
                'token',
                'message',
            ]);
    }

    /**
     * Test user cannot log in with invalid credentials.
     *
     * @return void
     */
    public function test_user_cannot_login_with_invalid_credentials()
    {
        // Create a user with type 'user'
        $user = User::factory()->create([
            'email' => 'testuser@example.com',
            'password' => Hash::make('password123'),
            'type' => 'user'
        ]);

        // Simulate invalid login request
        $response = $this->postJson('/api/login', [
            'email' => 'testuser@example.com',
            'password' => 'wrongpassword',  // Wrong password
            'type' => 'user'
        ]);

        // Assert that the user received an unauthorized response
        $response->assertStatus(401)
            ->assertJson([
                'message' => 'Invalid credentials or user type.'
            ]);
    }

    /**
     * Test pharmacy can log in with correct credentials.
     *
     * @return void
     */
}
