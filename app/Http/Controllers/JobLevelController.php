<?php

namespace App\Http\Controllers;

use App\Models\JobLevel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\JobLevelRequest;
use App\Http\Resources\JobLevelResource;

class JobLevelController extends Controller
{
    public function index()
    {
        return response()->json(JobLevelResource::collection(JobLevel::get()));
    }

    public function store(JobLevelRequest $request)
    {

        $response = JobLevel::create($request->only([
            'name',
        ]));

        return response()->json($response, 201);

    }
    public function show($id)
    {
        $joblevel = JobLevel::whereId($id)->first();

        return response()->json($joblevel);
    }

    public function update($id, JobLevelRequest $request)
    {
        $joblevel = JobLevel::whereId($id)->update($request->only(['name']));

        return response()->json($joblevel);
    }
 
    public function destroy($id)
    {
        $joblevel = JobLevel::whereId($id)->delete();

        return response()->json($joblevel);
    }
}
