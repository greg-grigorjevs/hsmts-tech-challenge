<?php

namespace Tests\Feature;

use Illuminate\Testing\Fluent\AssertableJson;
use App\Models\Property;
use App\Models\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoomControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_by_property_endpoint(): void
    {
        $rightProperty = Property::factory()->has(Room::factory()->count(3))->create();
        $wrongProperty = Property::factory()->has(Room::factory()->count(5))->create();

        $response = $this->get("/api/room/$rightProperty->id");

        $response->assertOk()
            // assert that each all returned rooms belongs to the same property
            ->assertJson(fn (AssertableJson $json) =>
                $json->has('data', fn (AssertableJson $json) =>
                    $json->each(fn (AssertableJson $json) =>
                        $json->where('property.id', $rightProperty->id)
                            ->etc()
                    )
                )
            ->count('data', 3)
            ->etc()
        );
    }

    public function test_index_endpoint(): void
    {
        Room::factory(3)->create();

        $response = $this->get('/api/room');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'size',
                        'property' => [
                            'id',
                            'name',
                            'address'
                        ],
                    ],
                ],
            ]);
    }

    public function test_store_endpoint()
    {
        $data = [
            'name' => 'testRoomName',
            'size' => '69.9',
            'property_id' => Property::factory()->create()->id,
        ];

        $response = $this->post('/api/room', $data);

        $response->assertCreated();

        $this->assertDatabaseCount('rooms', 1);
        $this->assertDatabaseHas('rooms', $data);
    }

    public function test_update_endpoint()
    {
        $oldData = [
            'name' => 'oldRoomName',
            'size' => '42.0',
            'property_id' => Property::factory()->create()->id,
        ];

        $newData = [
            'name' => 'newRoomName',
            'size' => '69.9',
            'property_id' => Property::factory()->create()->id,
        ];

        $room = Room::create($oldData);

        $response = $this->put("/api/room/$room->id", $newData);

        $response->assertOk();

        $this->assertDatabaseHas('rooms', $newData);
        $this->assertDatabaseMissing('rooms', $oldData);
    }

    public function test_delete_endpoint()
    {
        $room = Room::factory()->create();

        $response = $this->delete("/api/room/$room->id");

        $response->assertOk();

        $this->assertDatabaseEmpty('rooms');
    }


}
