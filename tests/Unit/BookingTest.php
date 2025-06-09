<?php

namespace Tests\Unit;

use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    public function testBookingHasCorrectRelationships(): void
    {
        $user = User::factory()->create();
        $room = Room::factory()->create();

        $booking = Booking::factory()->create([
            'user_id' => $user->id,
            'room_id' => $room->id
        ]);

        $this->assertInstanceOf(User::class, $booking->user);
        $this->assertInstanceOf(Room::class, $booking->room);
        $this->assertEquals($user->id, $booking->user->id);
        $this->assertEquals($room->id, $booking->room->id);
    }
}
