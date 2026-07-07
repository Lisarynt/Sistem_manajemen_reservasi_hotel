<?php

namespace Database\Factories;

use App\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    public function definition(): array
    {
        return [
            'room_type_id' => RoomType::inRandomOrder()->first()?->id ?? RoomType::factory(),
            'room_number' => $this->faker->unique()->numerify('R-###'),
            'status' => $this->faker->randomElement(['available', 'occupied', 'maintenance']),
            'image' => null,
        ];
    }
}