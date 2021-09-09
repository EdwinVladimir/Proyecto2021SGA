<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlanevaController extends Controller
{
    public function index()
    {
        return PlanevaResource::collection(planeva::all());
    }

    public function store(PlanevaStoreRequest $request)
    {
        // sleep(3);
        if($request->hasFile('thumbnail')){
            $filename = $request->thumbnail->getClientOriginalName();
            info($filename); //log
        }
        $planva = Planeva::create($request->validated());

        return new PlanevaResource($planeva);
    }

    public function show(Planeva $planeva)
    {
        return new PlanevaResource($planeva);
    }

    public function update(Planeva $planestudio, PlanevaStoreRequest $request)
    {
        $planestudio->update($request->validated());
        return new PlanevaResource(($planeva));
    }

    public function destroy(Planeva $planeva)
    {
        $planeva->delete();
        return response()->noContent();
    }
}
