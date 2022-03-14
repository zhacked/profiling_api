<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\EductationRequest;
use App\Http\Resources\EducationResource;

class EducationController extends Controller
{
    public function index()
    {
        return response()->json(EducationResource::collection(Education::get()));
    }

    public function store(EductationRequest $request)
    {
      
        $response = Education::create($request->only([
            'name',
        ]));

        return response()->json($response, 201);
    }
    public function show($id)
    {
        $education = Education::whereId($id)->first();

        return response()->json($education);
    }

    public function update($id, Request $request)
    {
        $education = Education::whereId($id)->update($request->only(['name']));

        return response()->json($education);
    }
 
    public function destroy($id)
    {
        $education = Education::whereId($id)->delete();

        return response()->json($education);
    }
}
