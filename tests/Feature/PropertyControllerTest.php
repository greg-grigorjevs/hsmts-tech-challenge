<?php

namespace Tests\Feature;

use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PropertyControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_index_endpoint(): void
    {
        Property::factory(3)->create();

        $response = $this->get('/api/property');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'address',
                    ],
                ],
            ]);
    }

    public function test_store_endpoint()
    {
        $data = [
            'name' => 'testPropertyName',
            'address' => 'testPropertyAddress',
        ];

        $response = $this->post('/api/property', $data);

        $response->assertOk();

        $this->assertDatabaseCount('properties', 1);
        $this->assertDatabaseHas('properties', $data);
    }

    public function test_update_endpoint()
    {
        $oldData = [
            'name' => 'oldPropertyName',
            'address' => 'oldPropertyAddress',
        ];

        $newData = [
            'name' => 'newPropertyName',
            'address' => 'newPropertyAddress',
        ];

        $property = Property::create($oldData);

        $response = $this->put("/api/property/$property->id", $newData);

        $response->assertOk();

        $this->assertDatabaseHas('properties', $newData);
        $this->assertDatabaseMissing('properties', $oldData);
    }

    public function test_show_endpoint()
    {
        $property = Property::factory()->create();

        $response = $this->get("/api/property/$property->id");

        $response->assertOk()
            ->assertJson([
                'data' => [
                    'id' => $property->id,
                    'name' => $property->name,
                    'address' => $property->address,
                ],
            ]);
    }

    public function test_delete_endpoint()
    {
        $property = Property::factory()->create();

        $response = $this->delete("/api/property/$property->id");

        $response->assertOk();

        $this->assertDatabaseEmpty('properties');
    }
}
