<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Requests\SkillRequest;
use App\Http\Resources\SkillResource;

class SkillController extends Controller
{
    public function index()
    {
        return response()->json(SkillResource::collection(Skill::get()));
    }

    public function store(SkillRequest $request)
    {
      
        $response = Skill::create($request->only([
            'name',
        ]));

        return response()->json($response, 201);
    }
    public function show($id)
    {
        $Skill = Skill::whereId($id)->first();

        return response()->json($Skill);
    }

    public function update($id, Request $request)
    {
        $Skill = Skill::whereId($id)->update($request->only(['name']));

        return response()->json($Skill);
    }
 
    public function destroy($id)
    {
        $Skill = Skill::whereId($id)->delete();

        return response()->json($Skill);
    }
}
