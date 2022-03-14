<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Requests\BannerRequest;
use App\Http\Resources\BannerResource;

class BannerController extends Controller
{
    public function index()
    {
        return response()->json(BannerResource::collection(Banner::get()));
    }

    public function store(BannerRequest $request)
    {
      
        $response = Banner::create($request->only([
            'tag',
            'image',
            'description'
        ]));

        return response()->json($response, 201);
    }
    public function show($id)
    {
        $banner = Banner::whereId($id)->first();

        return response()->json($banner);
    }

    public function update($id, BannerRequest $request)
    {
        $banner = Banner::whereId($id)
                    ->update($request->only([
                        'tag',
                        'image',
                        'description'
                    ]));

        return response()->json($banner);
    }
 
    public function destroy($id)
    {
        $banner = Banner::whereId($id)->delete();

        return response()->json($banner);
    }
}
