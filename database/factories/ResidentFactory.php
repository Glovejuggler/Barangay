<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ResidentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName($gender = null),
            'last_name' => $this->faker->lastName(),
            'middle_name' => $this->faker->lastName(),
            'barangay_id' => $this->faker->numberBetween(1, 17),
            'address' => $this->faker->streetAddress(),
        ];
    }
}
