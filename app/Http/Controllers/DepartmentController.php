<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Http\Requests\DepartmentRequest;
use App\Http\Resources\DepartmentResource;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        return response()->json(DepartmentResource::collection(Department::get()));
    }

    public function store(DepartmentRequest $request)
    {
      
        $response = Department::create($request->only([
            'name',
        ]));

        return response()->json($response, 201);
    }
    public function show($id)
    {
        $education = Department::whereId($id)->first();

        return response()->json($education);
    }

    public function update($id, Request $request)
    {
        $education = Department::whereId($id)->update($request->only(['name']));

        return response()->json($education);
    }
 
    public function destroy($id)
    {
        $education = Department::whereId($id)->delete();

        return response()->json($education);
    }
}
