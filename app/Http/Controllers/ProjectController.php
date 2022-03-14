<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResource;

class ProjectController extends Controller
{
    public function index()
    {
        return response()->json(ProjectResource::collection(Project::get()));
    }

    public function store(ProjectRequest $request)
    {
      
        $response = Project::create($request->only([
            'name',
            'description'
        ]));

        return response()->json($response, 201);
    }
    public function show($id)
    {
        $project = Project::whereId($id)->first();

        return response()->json($project);
    }

    public function update($id, ProjectRequest $request)
    {
        $project = Project::whereId($id)
                    ->update($request->only([
                    'name',
                    'description'
                    ]));

        return response()->json($project);
    }
 
    public function destroy($id)
    {
        $project = Project::whereId($id)->delete();

        return response()->json($project);
    }
}
