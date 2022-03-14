<?php

namespace App\Http\Controllers;

use App\Models\JobType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\JobTypeRequest;
use App\Http\Resources\JobTypeResource;


class JobTypeController extends Controller
{
    public function index()
    {
        return response()->json(JobTypeResource::collection(JobType::get()));
    }

    public function store(JobTypeRequest $request)
    {
        $response = JobType::create($request->only([
            'name',
        ]));

        return response()->json($response, 201);
    }

    public function update($id, JobTypeRequest $request)
    {
        $response = JobType::whereId($id)->update($request->only([
            'name',
        ]));

        return response()->json($response);
    }

    public function show($id)
    {
        $response = JobType::find($id);

        return response()->json($response);
    }

    public function destroy($id)
    {
        $response = JobType::whereId($id)->delete();

        return response()->json($response);
    }
}
