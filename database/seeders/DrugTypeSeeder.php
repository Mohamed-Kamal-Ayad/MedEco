<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DrugTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $drugTypes = [
            ['name' => 'أقراص', 'unit' => 'قرص'],      // Tablet
            ['name' => 'كبسولات', 'unit' => 'كبسولة'], // Capsule
            ['name' => 'شراب', 'unit' => 'مل'],        // Syrup (ml)
            ['name' => 'حقن', 'unit' => 'مل'],         // Injection (ml)
            ['name' => 'كريم', 'unit' => 'جرام'],      // Cream (g)
            ['name' => 'مرهم', 'unit' => 'جرام'],      // Ointment (g)
            ['name' => 'بخاخ', 'unit' => 'رشات'],      // Spray (sprays)
            ['name' => 'محلول', 'unit' => 'مل'],       // Solution (ml)
            ['name' => 'قطرات', 'unit' => 'قطرة'],     // Drops (drop)
            ['name' => 'تحاميل', 'unit' => 'تحميلة'],  // Suppository
            ['name' => 'لاصقات', 'unit' => 'لاصقة'],   // Patch
        ];

        foreach ($drugTypes as $drugType) {
            \App\Models\DrugType::create($drugType);
        }
    }
}
