<?php

namespace App\Services;

use App\Repositories\Interfaces\RoomRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class RoomService
{
    public function __construct(
        protected RoomRepositoryInterface $roomRepository
    ) {
    }

    public function getAvailableRooms(?string $checkInDate, ?string $checkOutDate): Collection
    {
        return $this->roomRepository->getAvailableRooms($checkInDate, $checkOutDate);
    }
} 