<?php

namespace App\Http\Controllers;

use App\Http\Requests\LanguageRequest;
use App\Http\Resources\LanguageResource;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index()
    {
        return response()->json(LanguageResource::collection(Language::all()));
    }

    public function store(LanguageRequest $request)
    {
        $response = Language::create($request->only([
            'name',
            'proficiency'
        ]));

        return response()->json($response, 201);
    }

    public function update($id, LanguageRequest $request)
    {
        $response = Language::whereId($id)->update($request->only([
            'name',
            'proficiency'
        ]));

        return response()->json($response);
    }

    public function show($id)
    {
        $response = Language::find($id);

        return response()->json($response);
    }

    public function destroy($id)
    {
        $response = Language::whereId($id)->delete();

        return response()->json($response);
    }
}
