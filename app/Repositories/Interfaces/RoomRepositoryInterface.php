<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;
 
interface RoomRepositoryInterface
{
    public function getAvailableRooms(?string $checkInDate, ?string $checkOutDate): Collection;
} 