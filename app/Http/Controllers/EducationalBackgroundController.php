<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EducationalBackground;
use App\Http\Requests\EducationalBackgroundRequest;
use App\Http\Resources\EducationalBackgroundResource;

class EducationalBackgroundController extends Controller
{
    public function index()
    {
        return response()->json(EducationalBackgroundResource::collection(EducationalBackground::get()));
    }

    public function store(EducationalBackgroundRequest $request)
    {
      
        $response = EducationalBackground::create($request->only([
            'user_id',
            'education_id',
            'study_from_month',
            'study_from_year',
            'study_to_month',
            'study_to_year',
            'degree'
        ]));

        return response()->json($response, 201);
    }
    public function show($id)
    {
        $educationalbackground = EducationalBackground::whereId($id)->first();

        return response()->json($educationalbackground);
    }

    public function update($id, EducationalBackgroundRequest $request)
    {
        $educationalbackground = EducationalBackground::whereId($id)
                    ->update($request->only([
                        'user_id',
                        'education_id',
                        'study_from_month',
                        'study_from_year',
                        'study_to_month',
                        'study_to_year',
                        'degree'
                    ]));

        return response()->json($educationalbackground);
    }
 
    public function destroy($id)
    {
        $educationalbackground = EducationalBackground::whereId($id)->delete();

        return response()->json($educationalbackground);
    }
}
