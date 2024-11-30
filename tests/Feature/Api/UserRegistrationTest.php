<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRegistrationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test that a user can register successfully.
     *
     * @return void
     */
    public function test_user_can_register()
    {
        // Prepare the request payload
        $payload = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '01012345678',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'type' => 'user',
            'gender' => 'male',
            'national_id' => '30311061601058',
            'birthdate' => '2003-11-06',
        ];

        // Make the request to the register route
        $response = $this->postJson('/api/register', $payload);

        // Assert the response status
        $response->assertStatus(201);

        // Assert the response contains a token
        $response->assertJsonStructure([
            'message',
            'token',
        ]);

        // Verify that the user is created in the database
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'phone' => '01012345678',
        ]);
    }

    /**
     * Test validation errors for the registration endpoint.
     */
    public function test_registration_validation_errors()
    {
        // Missing required fields
        $payload = [
            'name' => '',
            'email' => '',
            'password' => '',
        ];

        // Send request with incomplete payload
        $response = $this->postJson('/api/register', $payload);

        // Assert that validation errors are returned
        $response->assertStatus(422); // 422 Unprocessable Entity
        $response->assertJsonValidationErrors(['name', 'email', 'password']);
    }
}
