<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition(): array
    {
        $checkIn = $this->faker->dateTimeBetween('2025-06-15', '2025-12-31');
        $checkOut = $this->faker->dateTimeBetween($checkIn, '2025-12-31');

        return [
            'user_id' => User::factory(),
            'room_id' => Room::factory(),
            'check_in_date' => $checkIn->format('Y-m-d'),
            'check_out_date' => $checkOut->format('Y-m-d'),
        ];
    }
} 