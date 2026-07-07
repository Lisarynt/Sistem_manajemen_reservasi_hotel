<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Facility;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $bookings = Booking::factory(12)->create();

        // Attach 0-2 fasilitas random ke tiap booking (isi pivot table)
        $facilityIds = Facility::pluck('id');

        foreach ($bookings as $booking) {
            $randomFacilities = $facilityIds->random(rand(0, 2));
            foreach ($randomFacilities as $facilityId) {
                $booking->facilities()->attach($facilityId, ['quantity' => rand(1, 2)]);
            }
        }
    }
}