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
            ['name' => 'Paracetamol', 'points' => 10, 'drug_type_id' => 1],
            ['name' => 'Ibuprofen', 'points' => 20, 'drug_type_id' => 2],
            ['name' => 'Aspirin', 'points' => 30, 'drug_type_id' => 1],
            ['name' => 'Cetirizine', 'points' => 40, 'drug_type_id' => 1],
            ['name' => 'Loratadine', 'points' => 50, 'drug_type_id' => 2],
            ['name' => 'Diphenhydramine', 'points' => 60, 'drug_type_id' => 3],
            ['name' => 'Ranitidine', 'points' => 70, 'drug_type_id' => 4],
            ['name' => 'Omeprazole', 'points' => 80, 'drug_type_id' => 2],
            ['name' => 'Famotidine', 'points' => 90, 'drug_type_id' => 3],
            ['name' => 'Lansoprazole', 'points' => 100, 'drug_type_id' => 2],
        ];

        foreach ($data as $drug) {
            \App\Models\Drug::create($drug);
        }
    }
}
