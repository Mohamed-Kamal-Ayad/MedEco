<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = Order::create([
            'user_id' => 24,
            'pharmacy_branch_id' => 1,
            'order_number' => 'ORD-0001',
            'is_completed' => true,
        ]);

        $orders->items()->create([
            'drug_id' => 1,
            'quantity' => 2,
        ]);

        $orders->items()->create([
            'drug_id' => 2,
            'quantity' => 3,
        ]);

        $orders->items()->create([
            'drug_id' => 3,
            'quantity' => 1,
        ]);

    }
}
