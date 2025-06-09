<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [
            [
                'name' => 'Standard Single Room',
                'description' => 'Comfortable single room with a queen-size bed, perfect for solo travelers.',
            ],
            [
                'name' => 'Deluxe Double Room',
                'description' => 'Spacious double room with two queen-size beds, ideal for couples or small families.',
            ],
            [
                'name' => 'Executive Suite',
                'description' => 'Luxurious suite with a separate living area and premium amenities.',
            ],
            [
                'name' => 'Family Room',
                'description' => 'Large family room with multiple beds and extra space for children.',
            ],
            [
                'name' => 'Presidential Suite',
                'description' => 'Our most luxurious accommodation with panoramic views and premium services.',
            ],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}
