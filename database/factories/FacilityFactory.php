<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FacilityFactory extends Factory
{
    public function definition(): array
    {
        $facilities = [
            ['name' => 'Extra Bed', 'price' => 100000],
            ['name' => 'Breakfast', 'price' => 50000],
            ['name' => 'Airport Pickup', 'price' => 150000],
            ['name' => 'Late Check-out', 'price' => 75000],
        ];

        $facility = $this->faker->randomElement($facilities);

        return [
            'name' => $facility['name'],
            'price' => $facility['price'],
        ];
    }
}