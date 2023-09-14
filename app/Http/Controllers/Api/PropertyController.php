<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\PropertyResource;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PropertyResource::collection(Property::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255']
        ]);


        $property = new Property();
        $property->fill($request->only($property->getFillable()));
        $property->save();

        return redirect(route('property.index'), 303);

    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        return new PropertyResource($property);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        $property->update($request->only($property->getFillable()));

        return redirect(route('property.index'), 303);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $property->delete();

        return redirect(route('property.index'), 303);
    }
}
