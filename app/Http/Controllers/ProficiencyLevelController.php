<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProficiencyLevel;
use App\Http\Requests\ProficiencyLevelRequest;
use App\Http\Resources\ProficiencyLevelResource;

class ProficiencyLevelController extends Controller
{
    public function index()
    {
        return response()->json(ProficiencyLevelResource::collection(ProficiencyLevel::get()));
    }

    public function store(ProficiencyLevelRequest $request)
    {

        $response = ProficiencyLevel::create($request->only([
            'name',
        ]));

        return response()->json($response, 201);

    }
    public function show($id)
    {
        $proficiencylevel = ProficiencyLevel::whereId($id)->first();

        return response()->json($proficiencylevel);
    }

    public function update($id, ProficiencyLevelRequest $request)
    {
        $proficiencylevel = ProficiencyLevel::whereId($id)->update($request->only(['name']));

        return response()->json($proficiencylevel);
    }
 
    public function destroy($id)
    {
        $proficiencylevel = ProficiencyLevel::whereId($id)->delete();

        return response()->json($proficiencylevel);
    }
}
