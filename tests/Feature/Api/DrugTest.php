<?php

namespace Tests\Feature\Api;

use App\Models\DrugType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class DrugTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->getJson('/api/user/drugs');
        $response->assertStatus(200);
    }

    public function testStore()
    {
        $user = User::factory()->create();
        DrugType::create([
            'name' => 'Test Drug Type',
            'unit' => 'Test Unit',
        ]);
        $response = $this->actingAs($user)->postJson('/api/user/drugs', [
            'name' => 'Test Drug',
            'drug_type_id' => 1,
            'unit' => 'Test Unit',
            'price' => 0,
            'quantity' => 10,
            'description' => 'Test Description',
            'production_date' => '2022-01-01',
            'expiry_date' => '2026-01-01',
            'is_donated' => 1,
            'user_id' => 1,
            'qty' => 10,

        ]);

        $response->assertStatus(201);
    }
}
