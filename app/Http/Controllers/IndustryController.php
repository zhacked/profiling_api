<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Industry;
use App\Http\Requests\IndustryRequest;
use App\Http\Resources\IndustryResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IndustryController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return IndustryResource::collection(
            Industry::query()
                ->orderBy('name')
                ->get()
        );
    }

    public function store(IndustryRequest $request)
    {

        $response = Industry::create($request->only([
            'name',
        ]));

        return response()->json($response, 201);

    }
    public function show($id)
    {
        $industry = Industry::whereId($id)->first();

        return response()->json($industry);
    }

    public function update($id, IndustryRequest $request)
    {
        $industry = Industry::whereId($id)->update($request->only(['name']));

        return response()->json($industry);
    }
 
    public function destroy($id)
    {
        $industry = Industry::whereId($id)->delete();

        return response()->json($industry);
    }
}
