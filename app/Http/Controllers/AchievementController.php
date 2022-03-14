<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;
use App\Http\Requests\AchievementRequest;
use App\Http\Resources\AchievementResource;

class AchievementController extends Controller
{
    public function index()
    {
        return response()->json(AchievementResource::collection(Achievement::get()));
    }

    public function store(AchievementRequest $request)
    {
      
        $response = Achievement::create($request->only([
            'name',
            'description'
        ]));

        return response()->json($response, 201);
    }
    public function show($id)
    {
        $achievement = Achievement::whereId($id)->first();

        return response()->json($achievement);
    }

    public function update($id, AchievementRequest $request)
    {
        $achievement = Achievement::whereId($id)
                        ->update($request->only([
                        'name',
                        'description'
                        ]));

        return response()->json($achievement);
    }
 
    public function destroy($id)
    {
        $achievement = Achievement::whereId($id)->delete();

        return response()->json($achievement);
    }
}
