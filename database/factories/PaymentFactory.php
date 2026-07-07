<?php

namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'booking_id' => Booking::inRandomOrder()->first()?->id ?? Booking::factory(),
            'amount' => $this->faker->numberBetween(300000, 2000000),
            'method' => $this->faker->randomElement(['cash', 'transfer', 'debit', 'credit']),
            'status' => $this->faker->randomElement(['pending', 'paid', 'failed']),
            'paid_at' => $this->faker->optional()->dateTime(),
        ];
    }
}