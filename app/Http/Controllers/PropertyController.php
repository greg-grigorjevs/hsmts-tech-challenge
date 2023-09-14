<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = Property::query()->orderBy('created_at', 'DESC')->paginate(10)->through(function (Property $property) {
            return [
                'id' => $property->id,
                'name' => $property->name,
                'address' => $property->address,
                'edit_url' => route('property.edit', $property),
                'delete_url' => route('api.property.destroy', $property)
            ];
        });

        return inertia('Property/Index', [
            'properties' => $properties,
            'create_url' => route('property.create')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Property/Create', ['store_url' => route('api.property.store')]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        return inertia('Property/Edit', [
            'property' => $property,
            'update_url' => route('api.property.update', $property),
        ]);
    }
}
