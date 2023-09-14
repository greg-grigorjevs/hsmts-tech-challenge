<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function indexByProperty(Property $property)
    {
        /* return RoomResource::collection($property->rooms()->with('property')->paginate(10)); */

        $rooms = $property->rooms()->orderBy('created_at', 'DESC')->paginate(10)->through(function ($room) {
            return [
                'id' => $room->id,
                'name' => $room->name,
                'size' => $room->size,
                'edit_url' => route('room.edit', $room),
                'delete_url' => route('api.room.destroy', $room)
            ];
        });

        return inertia('Room/IndexByProperty', [
            'property' => $property,
            'rooms' => $rooms,
            'create_url' => route('room.create', $property)
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Property $property)
    {
        return inertia('Room/Create', [
            'property' => $property,
            'store_url' => route('api.room.store')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        return inertia('Room/Edit', [
            'room' => $room,
            'update_url' => route('api.room.update', $room),
            'property' => $room->property
        ]);
    }
}
