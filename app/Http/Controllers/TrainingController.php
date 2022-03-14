<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;
use App\Http\Requests\TrainingRequest;
use App\Http\Resources\TrainingResource;

class TrainingController extends Controller
{
    public function index()
    {
        return response()->json(TrainingResource::collection(Training::get()));
    }

    public function store(TrainingRequest $request)
    {
      
        $response = Training::create($request->only([
            'name',
            'description',
            'month',
            'year'
        ]));

        return response()->json($response, 201);
    }
    public function show($id)
    {
        $training = Training::whereId($id)->first();

        return response()->json($training);
    }

    public function update($id, TrainingRequest $request)
    {
        $training = Training::whereId($id)
                    ->update($request->only([
                        'name',
                        'description',
                        'month',
                        'year'
                    ]));

        return response()->json($training);
    }
 
    public function destroy($id)
    {
        $training = Training::whereId($id)->delete();

        return response()->json($training);
    }
}
