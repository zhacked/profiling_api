<?php

namespace App\Http\Controllers;

use App\Models\Scheduler;
use Illuminate\Http\Request;
use App\Http\Requests\SchedulerRequest;
use App\Http\Resources\SchedulerResource;

class SchedulerController extends Controller
{
    public function index()
    {
        return response()->json(SchedulerResource::collection(Scheduler::get()));
    }

    public function store(SchedulerRequest $request)
    {
      
        $response = Scheduler::create($request->only([
            'interview_date',
            'interview_start',
            'interview_end',
            'interview_link',
            'email',
            'name',
            'position',
            'address',
            'note'
        ]));

        return response()->json($response, 201);
    }
    public function show($id)
    {
        $scheduler = Scheduler::whereId($id)->first();

        return response()->json($scheduler);
    }

    public function update($id, SchedulerRequest $request)
    {
        $scheduler = Scheduler::whereId($id)
        ->update($request->only([
                'interview_date',
                'interview_start',
                'interview_end',
                'interview_link',
                'email',
                'name',
                'position',
                'address',
                'note'
            ])
        );

        return response()->json($scheduler);
    }
 
    public function destroy($id)
    {
        $scheduler = Scheduler::whereId($id)->delete();

        return response()->json($scheduler);
    }
}
