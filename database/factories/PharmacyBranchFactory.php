<?php

namespace Database\Factories;

use App\Models\Pharmacy;
use App\Models\PharmacyBranch;
use Illuminate\Database\Eloquent\Factories\Factory;

class PharmacyBranchFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PharmacyBranch::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'commercial_registration_number' => $this->faker->regexify('[A-Z0-9]{8}'),
            'tax_number' => $this->faker->regexify('[A-Z0-9]{8}'),
            'is_open' => $this->faker->boolean,
            'lat' => $this->faker->latitude,
            'lng' => $this->faker->longitude,
            'pharmacy_id' => Pharmacy::factory(), // Will create a pharmacy and assign its ID
        ];
    }
}
