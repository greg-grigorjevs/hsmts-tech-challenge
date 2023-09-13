<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoomResource;
use App\Models\Property;
use App\Models\Room;
use Illuminate\Http\Request;

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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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

        return new RoomResource($newRoom);
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();
    }
}
