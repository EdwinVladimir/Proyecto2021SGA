<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActividadController extends Controller
{
    public function index()
    {
        return ActividadResource::collection(actividad::all());
    }

    public function store(ActividadStoreRequest $request)
    {
        // sleep(3);
        if($request->hasFile('thumbnail')){
            $filename = $request->thumbnail->getClientOriginalName();
            info($filename); //log
        }
        $actividad = Actividad::create($request->validated());

        return new ActividadResource($actividad);
    }

    public function show(Actividad $actividad)
    {
        return new ActividadResource($actividad);
    }

    public function update(Actividad $actividad, ActividadStoreRequest $request)
    {
        $actividad->update($request->validated());
        return new ActividadResource(($actividad));
    }

    public function destroy(Actividad $actividad)
    {
        $actividad->delete();
        return response()->noContent();
    }
}
