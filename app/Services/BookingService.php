<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Room;
use App\Repositories\Interfaces\BookingRepositoryInterface;
use Illuminate\Support\Facades\Mail;

class BookingService
{
    public function __construct(
        protected BookingRepositoryInterface $bookingRepository
    ) {
    }

    public function createBooking(array $data): Booking
    {
        if (!$this->bookingRepository->isRoomAvailable(
            $data['room_id'],
            $data['check_in_date'],
            $data['check_out_date']
        )) {
            throw new \Exception('Room is not available for the selected dates');
        }

        $booking = $this->bookingRepository->create($data);
        $this->sendConfirmationEmail($booking);

        return $booking;
    }

    protected function sendConfirmationEmail(Booking $booking): void
    {
        $user = $booking->user;
        $room = $booking->room;

        Mail::raw(
            "Dear {$user->name},\n\n" .
            "Your booking has been confirmed:\n" .
            "Room: {$room->name}\n" .
            "Check-in: {$booking->check_in_date}\n" .
            "Check-out: {$booking->check_out_date}\n\n" .
            "Thank you for choosing our hotel!",
            function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('Booking Confirmation');
            }
        );
    }
} 