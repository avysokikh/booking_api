<?php

namespace App\Repositories;

use App\Models\Booking;
use App\Models\Room;
use App\Repositories\Interfaces\BookingRepositoryInterface;

class BookingRepository implements BookingRepositoryInterface
{
    public function __construct(protected Booking $model)
    {
    }

    public function isRoomAvailable(int $roomId, string $checkInDate, string $checkOutDate): bool
    {
        return Room::where('id', $roomId)
            ->whereDoesntHave('bookings', function ($query) use ($checkInDate, $checkOutDate) {
                $query->where(function ($q) use ($checkInDate, $checkOutDate) {
                    $q->whereBetween('check_in_date', [$checkInDate, $checkOutDate])
                        ->orWhereBetween('check_out_date', [$checkInDate, $checkOutDate])
                        ->orWhere(function ($q) use ($checkInDate, $checkOutDate) {
                            $q->where('check_in_date', '<=', $checkInDate)
                                ->where('check_out_date', '>=', $checkOutDate);
                        });
                });
            })
            ->exists();
    }

    public function create(array $data): Booking
    {
        return $this->model->create($data);
    }
}
