<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Requests\JobRequest;
use App\Http\Resources\JobResource;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $job = new Job();

        if ($request->has('filter')) {
            if ($request->get('filter') == 'highest_paying_job') {
                $highestPayingJob = Job::orderBy('max_salary', 'desc')->first();

                return response()->json($highestPayingJob);
            }
        }

        if ($request->has('limit')) {
            $job = $job->take($request->get('limit'));
        }

        if($request->has('related')){
            $relatedJobs = Job::where('location', 'LIKE', '%'. 'philippines'. '%')->latest()->get();
            return response()->json($relatedJobs);
        }


        if ($request->has('search')) {
            $filterJobs = Job::where('job_title', 'LIKE', '%'. $request->get('search'). '%')->get();

            return response()->json($filterJobs);

        }
        return response()->json(JobResource::collection($job->get()));
    }

    public function store(JobRequest $request)
    {

        $response = Job::create($request->only([
            'industry_id',
            'department_id',
            'job_level_id',
            'job_type_id',
            'education_id',
            'job_title',
            'contract',
            'description',
            'minimum_requirements',
            'min_salary',
            'max_salary',
            'location',
            'perks_benefits',
            'no_of_vacancy'
        ]));

        return response()->json($response, 201);

    }
    public function show($id)
    {
        $job = Job::with(['industry','department','job_level','job_type','education'])->whereId($id)->first();

        return response()->json($job);
    }

    public function update($id, JobRequest $request)
    {
        $job = Job::whereId($id)->update($request->only([
            'industry_id',
            'department_id',
            'job_level_id',
            'job_type_id',
            'education_id',
            'job_title',
            'contract',
            'description',
            'minimum_requirements',
            'min_salary',
            'max_salary',
            'location',
            'perks_benefits',
            'no_of_vacancy'
        ]));

        return response()->json($job);
    }

    public function destroy($id)
    {
        $job = Job::whereId($id)->delete();

        return response()->json($job);
    }


}
