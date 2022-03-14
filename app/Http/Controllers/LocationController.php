<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Requests\LocationRequest;
use App\Http\Resources\LocationResource;

class LocationController extends Controller
{
    public function index()
    {
        return response()->json(LocationResource::collection(Location::get()));
    }

    public function store(LocationRequest $request)
    {
      
        $response = Location::create($request->only(['name']));

        return response()->json($response, 201);
    }
    public function show($id)
    {
        $location = Location::whereId($id)->first();

        return response()->json($location);
    }

    public function update($id, LocationRequest $request)
    {
        $location = Location::whereId($id)
                    ->update($request->only(['name']));

        return response()->json($location);
    }
 
    public function destroy($id)
    {
        $location = Location::whereId($id)->delete();

        return response()->json($location);
    }
}
