<?php

namespace Tests\Feature\Api;

use App\Models\Drug;
use App\Models\Pharmacy;
use App\Models\PharmacyBranch;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class OrderTest extends TestCase
{
    public function test_user_can_create_order(): void
    {
        $user = User::factory()->create();

        Drug::query()->create([
            'name' => 'test',
            'price' => 100,
            'user_id' => $user->id,
            'qty' => 10,
            'production_date' => now(),
            'expiry_date' => now()->addYear(),

        ]);
        Pharmacy::query()->create([
            'name' => 'test',
            'hotline' => '123456789',
            'is_accept_expired' => true,
            'user_id' => $user->id,
        ]);
        PharmacyBranch::query()->create([
            'name' => 'test',
            'phone' => '123456789',
            'pharmacy_id' => 1,
            'address' => 'test',
            'commercial_registration_number' => '123456789',
            'tax_number' => '123456789',
            'is_open' => true,
        ]);

        Auth::login($user);
        $response = $this->actingAs($user)->postJson(route('api.user.orders.store'), [
            'drug_id' => 1,
            'pharmacy_branch_id' => 1,
        ],
        );

        $response->assertCreated();
    }


}
