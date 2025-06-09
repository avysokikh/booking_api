<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $rooms = Room::all();

        // Создаем 30 бронирований
        for ($i = 1; $i <= 30; $i++) {
            $checkIn = now()->addMonths(rand(1, 6))->addDays(rand(1, 15));
            $checkOut = $checkIn->copy()->addDays(rand(1, 7));

            Booking::factory()->create([
                'user_id' => $users->random()->id,
                'room_id' => $rooms->random()->id,
                'check_in_date' => $checkIn->format('Y-m-d'),
                'check_out_date' => $checkOut->format('Y-m-d'),
            ]);
        }
    }
} 