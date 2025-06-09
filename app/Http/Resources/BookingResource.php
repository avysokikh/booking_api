<?php

namespace App\Http\Resources;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => new UserResource($this->user),
            'room' => new RoomResource($this->room),
            'check_in_date' => $this->check_in_date->setTime(Booking::DEFAULT_CHECK_IN_HOUR, 0),
            'check_out_date' => $this->check_out_date->setTime(Booking::DEFAULT_CHECK_OUT_HOUR, 0),
        ];
    }
}
