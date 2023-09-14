<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\RoomResource;
use App\Models\Property;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return RoomResource::collection(Room::paginate(10));
    }

    public function indexByProperty(Property $property)
    {
        return RoomResource::collection($property->rooms()->with('property')->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'property_id' => ['required', 'exists:App\Models\Property,id'],
            'name' => ['required', 'string', 'max:255'],
            'size' => ['required', 'numeric'],
        ]);

        $newRoom = new Room();
        $newRoom->fill($request->only($newRoom->getFillable()));
        $newRoom->save();

        /* return new RoomResource($newRoom); */
        return redirect(route('room.indexByProperty', $request->input('property_id')));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'size' => ['sometimes', 'required', 'numeric'],
        ]);

        $room->update($request->only($room->getFillable()));

        return redirect(route('room.indexByProperty', $room->property->id), 303);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $propertyId = $room->property->id;

        $room->delete();

        return redirect(route('room.indexByProperty', $propertyId), 303);
    }
}
