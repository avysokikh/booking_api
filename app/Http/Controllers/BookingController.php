<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Resources\BookingResource;
use App\Services\BookingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BookingController extends Controller
{
    public function __construct(
        protected BookingService $bookingService
    ) {
    }

    public function store(StoreBookingRequest $request): JsonResponse
    {
        try {
            $booking = $this->bookingService->createBooking([
                'room_id' => $request->room_id,
                'user_id' => auth()->id(),
                'check_in_date' => $request->check_in_date,
                'check_out_date' => $request->check_out_date,
            ]);

            return response()->json(new BookingResource($booking), Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
