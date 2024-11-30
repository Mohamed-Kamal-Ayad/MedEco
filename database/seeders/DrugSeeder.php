<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DrugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Paracetamol',
                'description' => 'Paracetamol is a common painkiller used to treat aches and pain. It can also be used to reduce a high temperature. It is available over the counter in pharmacies.',
                'price' => 100,
                'qty' => 100,
                'production_date' => '2024-09-21',
                'expiry_date' => '2024-09-21',
                'is_valid' => true,
                'is_available' => true,
                'is_expired' => false,
                'drug_type_id' => 1,
                'pharmacy_branch_id' => null,
                'is_donated' => false,
                'user_id' => 1,
            ],
            [
                'name' => 'Ibuprofen',
                'description' => 'Ibuprofen is a painkiller available over the counter without a prescription. It is one of a group of painkillers called non-steroidal anti-inflammatory drugs (NSAIDs) and can be used to ease mild to moderate pain, inflammation and fever.',
                'price' => 150,
                'qty' => 100,
                'production_date' => '2024-09-21',
                'expiry_date' => '2024-09-21',
                'is_valid' => true,
                'is_available' => true,
                'is_expired' => false,
                'drug_type_id' => 2,
                'pharmacy_branch_id' => null,
                'is_donated' => false,
                'user_id' => 1,
            ],
            [
                'name' => 'Aspirin',
                'description' => 'Aspirin is a common painkiller that has a number of additional benefits. It can reduce the risk of heart attacks and certain strokes, and is used to treat or prevent heart attacks, strokes and chest pain (angina).',
                'price' => 200,
                'qty' => 100,
                'production_date' => '2024-09-21',
                'expiry_date' => '2024-09-21',
                'is_valid' => true,
                'is_available' => true,
                'is_expired' => false,
                'drug_type_id' => 3,
                'pharmacy_branch_id' => null,
                'is_donated' => false,

                'user_id' => 1,
            ],
        ];

        foreach ($data as $drug) {
            \App\Models\Drug::create($drug);
        }
    }
}
