<?php

namespace Database\Factories;

use App\Models\Guest;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    public function definition(): array
    {
        $checkin = $this->faker->dateTimeBetween('-10 days', '+5 days');
        $checkout = (clone $checkin)->modify('+' . rand(1, 5) . ' days');

        return [
            'guest_id' => Guest::inRandomOrder()->first()?->id ?? Guest::factory(),
            'room_id' => Room::inRandomOrder()->first()?->id ?? Room::factory(),
            'booking_code' => strtoupper($this->faker->unique()->bothify('BK-####??')),
            'checkin_date' => $checkin,
            'checkout_date' => $checkout,
            'actual_checkin_at' => null,
            'actual_checkout_at' => null,
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'checked_in', 'checked_out', 'cancelled']),
        ];
    }
}