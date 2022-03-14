<?php

namespace App\Http\Controllers;

use App\Models\Credential;
use App\Http\Requests\CredentialRequest;
use App\Http\Resources\CredentialResource;


class CredentialController extends Controller
{
    public function index()
    {
        return response()->json(CredentialResource::collection(Credential::get()));
    }

    public function store(CredentialRequest $request)
    {
      
        $response = Credential::create($request->only([
            'name',
            'issuing_body',
            'month',
            'year'
        ]));

        return response()->json($response, 201);
    }
    public function show($id)
    {
        $credential = Credential::whereId($id)->first();

        return response()->json($credential);
    }

    public function update($id, CredentialRequest $request)
    {
        $credential = Credential::whereId($id)
                    ->update($request->only([
                        'name',
                        'issuing_body',
                        'month',
                        'year'
                    ]));

        return response()->json($credential);
    }
 
    public function destroy($id)
    {
        $credential = Credential::whereId($id)->delete();

        return response()->json($credential);
    }
}
