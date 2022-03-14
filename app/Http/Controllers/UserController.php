<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(UserResource::collection(User::get()));
    }

    public function store(UserRequest $request)
    {
        $payload = $request->only([
            'name',
            'email',
            'password'
        ]);

        $result = User::create($payload);

        return response()->json($result, 201);
    }

    public function update($id, Request $request)
    {
        $user = User::whereId($id)->update($request->only([
            'name',
            'email',
            'password'
        ]));

        return response()->json($user);
    }

    public function show($id)
    {
        $user = User::find($id);

        return response()->json($user);
    }
}
