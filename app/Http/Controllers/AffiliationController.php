<?php

namespace App\Http\Controllers;

use App\Models\Affiliation;
use Illuminate\Http\Request;
use App\Http\Requests\AffiliationRequest;
use App\Http\Resources\AffiliationResource;

class AffiliationController extends Controller
{
    public function index()
    {
        return response()->json(AffiliationResource::collection(Affiliation::get()));
    }

    public function store(AffiliationRequest $request)
    {
      
        $response = Affiliation::create($request->only([
                        'name',
                        'description'
                    ]));

        return response()->json($response, 201);
    }
    public function show($id)
    {
        $affiliation = Affiliation::whereId($id)->first();

        return response()->json($affiliation);
    }

    public function update($id, AffiliationRequest $request)
    {
        $affiliation = Affiliation::whereId($id)
                        ->update($request->only([
                        'name',
                        'description'
                        ]));

        return response()->json($affiliation);
    }
 
    public function destroy($id)
    {
        $affiliation = Affiliation::whereId($id)->delete();

        return response()->json($affiliation);
    }
}
