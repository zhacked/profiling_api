<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index()
    {
        return response()->json(RoleResource::collection(Role::get()));
    }

    public function show($id)
    {
        $role = Role::whereId($id)->first();

        return response()->json($role);
    }

    public function update($id, Request $request)
    {
        $role = Role::whereId($id)->update($request->only(['name']));

        return response()->json($role);
    }
}
