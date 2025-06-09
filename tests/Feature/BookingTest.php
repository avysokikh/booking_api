<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    private function createAuthenticatedUser()
    {
        $user = User::factory()->create();
        $token = $user->createToken('test-token')->plainTextToken;
        return ['user' => $user, 'token' => $token];
    }

    public function testAuthenticatedUserCanCreateBooking(): void
    {
        $auth = $this->createAuthenticatedUser();
        $room = Room::factory()->create();

        $response = $this->withHeader('Authorization', 'Bearer ' . $auth['token'])
            ->postJson('/api/bookings', [
                'room_id' => $room->id,
                'check_in_date' => '2025-06-15',
                'check_out_date' => '2025-06-20'
            ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'user' => [
                    'id',
                    'name',
                    'email'
                ],
                'room' => [
                    'id',
                    'name',
                    'description',
                ],
                'check_in_date',
                'check_out_date',
            ]);
    }

    public function testUnauthenticatedUserCannotCreateBooking(): void
    {
        $room = Room::factory()->create();

        $response = $this->postJson('/api/bookings', [
            'room_id' => $room->id,
            'check_in_date' => '2025-06-15',
            'check_out_date' => '2025-06-20'
        ]);

        $response->assertStatus(401);
    }

    public function testBookingRequiresAllFields(): void
    {
        $auth = $this->createAuthenticatedUser();

        $response = $this->withHeader('Authorization', 'Bearer ' . $auth['token'])
            ->postJson('/api/bookings', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['room_id', 'check_in_date', 'check_out_date']);
    }

    public function testCannotBookUnavailableRoom(): void
    {
        $auth = $this->createAuthenticatedUser();
        $user = User::factory()->create();
        $room = Room::factory()->create();
        Booking::factory()->create([
            'user_id' => $user->id,
            'room_id' => $room->id,
            'check_in_date' => '2025-06-10',
            'check_out_date' => '2025-06-16',
        ]);

        $response = $this->withHeader('Authorization', 'Bearer ' . $auth['token'])
            ->postJson('/api/bookings', [
                'room_id' => $room->id,
                'check_in_date' => '2025-06-15',
                'check_out_date' => '2025-06-20'
            ]);

        $response->assertStatus(422);
    }
}
