<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoomTypeFactory extends Factory
{
    public function definition(): array
    {
        $types = [
            ['name' => 'Standard', 'price' => 300000],
            ['name' => 'Deluxe', 'price' => 500000],
            ['name' => 'Suite', 'price' => 850000],
        ];

        $type = $this->faker->randomElement($types);

        return [
            'name' => $type['name'],
            'description' => $this->faker->sentence(10),
            'price_per_night' => $type['price'],
        ];
    }
}