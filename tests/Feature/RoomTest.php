<?php

namespace Tests\Feature;

use App\Models\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoomTest extends TestCase
{
    use RefreshDatabase;

    public function testCanListAvailableRooms(): void
    {
        Room::factory()->count(3)->create();

        $response = $this->getJson('/api/rooms?check_in_date=2025-06-15&check_out_date=2025-06-20');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'description',
                    ]
                ],
                'meta' => [
                    'total'
                ]
            ]);
    }

    public function testRoomListingValidatesDateFormat(): void
    {
        $response = $this->getJson('/api/rooms?check_in_date=invalid&check_out_date=invalid');

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['check_in_date', 'check_out_date']);
    }

    public function testRoomListingValidatesDateOrder(): void
    {
        $response = $this->getJson('/api/rooms?check_in_date=2025-06-20&check_out_date=2025-06-15');

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['check_out_date']);
    }
}
