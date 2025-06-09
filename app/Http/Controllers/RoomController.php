<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListRoomsRequest;
use App\Http\Resources\RoomCollection;
use App\Services\RoomService;

class RoomController extends Controller
{
    public function __construct(
        protected RoomService $roomService
    ) {
    }

    public function index(ListRoomsRequest $request): RoomCollection
    {
        $rooms = $this->roomService->getAvailableRooms(
            $request->input('check_in_date'),
            $request->input('check_out_date')
        );

        return new RoomCollection($rooms);
    }
}
