<?php

namespace App\Repositories;

use App\Models\Room;
use App\Repositories\Interfaces\RoomRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

class RoomRepository implements RoomRepositoryInterface
{
    public function __construct(protected Room $model)
    {
    }

    public function getAvailableRooms(?string $checkInDate, ?string $checkOutDate): Collection
    {
        $query = $this->model->query();

        if ($checkInDate && $checkOutDate) {
            $query->whereDoesntHave('bookings', function ($query) use ($checkInDate, $checkOutDate) {
                $query->where(function ($q) use ($checkInDate, $checkOutDate) {
                    $q->whereBetween('check_in_date', [$checkInDate, $checkOutDate])
                        ->orWhereBetween('check_out_date', [$checkInDate, $checkOutDate])
                        ->orWhere(function ($q) use ($checkInDate, $checkOutDate) {
                            $q->where('check_in_date', '<=', $checkInDate)
                                ->where('check_out_date', '>=', $checkOutDate);
                        });
                });
            });
        } else {
            $nextWeek = Carbon::now()->addWeek();
            $query->whereDoesntHave('bookings', function ($query) use ($nextWeek) {
                $query->whereBetween('check_in_date', [Carbon::now(), $nextWeek])
                    ->orWhereBetween('check_out_date', [Carbon::now(), $nextWeek])
                    ->orWhere(function ($q) use ($nextWeek) {
                        $q->where('check_in_date', '<=', Carbon::now())
                            ->where('check_out_date', '>=', $nextWeek);
                    });
            });
        }

        return $query->get();
    }
}
