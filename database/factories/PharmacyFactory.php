<?php

namespace Database\Factories;

use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class PharmacyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Pharmacy::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'hotline' => $this->faker->phoneNumber,
            'is_active' => $this->faker->boolean,
            'image' => UploadedFile::fake()->image('pharmacy.jpg')->store('pharmacies', 'public'),
            'is_accept_expired' => $this->faker->boolean,
            'user_id' => User::factory(),
        ];
    }
}
