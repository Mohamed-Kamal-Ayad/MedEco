<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Pharmacy;
use App\Models\PharmacyBranch;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PharmacyBranchTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test retrieving all pharmacy branches without filtering.
     *
     * @return void
     */
    public function test_can_retrieve_all_pharmacy_branches(): void
    {
        // Create a user
        $user = User::factory()->create();
        // Create a pharmacy and its branches
        $pharmacy = Pharmacy::factory()->create(['user_id' => $user->id]);
        $branches = PharmacyBranch::factory()->count(3)->create(['pharmacy_id' => $pharmacy->id]);

        // Make a GET request to the index endpoint
        $response = $this->getJson('/api/pharmacy-branches');

        // Assert the response status and structure
        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }
    /**
     * Test retrieving pharmacy branches with filtering by `is_accept_expired`.
     *
     * @return void
     */
    public function test_can_filter_pharmacy_branches_by_is_accept_expired(): void
    {
        // Create a user
        $user = User::factory()->create();

        // Create two pharmacies with different `is_accept_expired` values
        $pharmacy1 = Pharmacy::factory()->create(['user_id' => $user->id, 'is_accept_expired' => true]);
        $pharmacy2 = Pharmacy::factory()->create(['user_id' => $user->id, 'is_accept_expired' => false]);

        // Create branches for both pharmacies
        PharmacyBranch::factory()->create(['pharmacy_id' => $pharmacy1->id]);
        PharmacyBranch::factory()->create(['pharmacy_id' => $pharmacy2->id]);

        // Make a GET request with filtering `is_accept_expired=1`
        $response = $this->getJson('/api/pharmacy-branches?is_accept_expired=1');

        // Assert the response contains only branches from pharmacies where `is_accept_expired = 1`
        $response->assertStatus(200)
            ->assertJsonCount(1, 'data');
    }

    /**
     * Test creating a new pharmacy branch.
     *
     * @return void
     */
}
