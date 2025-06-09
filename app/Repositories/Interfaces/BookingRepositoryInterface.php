<?php

namespace App\Repositories\Interfaces;

use App\Models\Booking;
 
interface BookingRepositoryInterface
{
    public function isRoomAvailable(int $roomId, string $checkInDate, string $checkOutDate): bool;
    public function create(array $data): Booking;
} 