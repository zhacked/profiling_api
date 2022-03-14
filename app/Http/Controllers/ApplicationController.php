<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use App\Http\Requests\ApplicationRequest;
use App\Http\Resources\ApplicationResource;

class ApplicationController extends Controller
{
    public function index(Request $request, Application $application)
    {
        $application = $application->newQuery();

        if ($request->has('sort_by')) {
            $application->orderBy($request->get('sort_by'), 'asc');
        }

        if ($request->has('sort_salary')) {
            if ($request->get('sort_salary') == 'lowest') {
                $application->orderBy('salary');
            } else {
                $application->orderBy('salary', 'desc');
            }
        }

        if($request->has('recommended')){
            $recommendedJobs = Application::with(['user'])->where('location_id', 'LIKE', '%'. 'b5adf5a4-abe6-4785-8864-83e3e44b93fa'. '%')
                                    ->latest() 
                                    ->take(3)  
                                    ->get();

            return response()->json($recommendedJobs);
        }


        return response()->json(ApplicationResource::collection($application->get()));
    }

    public function store(ApplicationRequest $request)
    {
        $response = Application::create($request->only([
            'recruiter_id',
            'location_id',
            'logo',
            'job_title',
            'company_name',
            'apply_before',
            'salary',
        ]));

        return response()->json($response, 201);
    }
    public function show($id)
    {
        $application = Application::whereId($id)->first();

        return response()->json($application);
    }

    public function update($id, ApplicationRequest $request)
    {
        $application = Application::whereId($id)
                        ->update($request->only([
                            'recruiter_id',
                            'location_id',
                            'logo',
                            'job_title',
                            'company_name',
                            'apply_before',
                            'salary',
                        ]));

        return response()->json($application);
    }

    public function destroy($id)
    {
        $application = Application::whereId($id)->delete();

        return response()->json($application);
    }
}
