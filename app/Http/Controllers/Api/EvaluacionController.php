<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EvaluacionController extends Controller
{
    public function index()
    {
        return EvaluacionResource::collection(Evaluacion::all());
    }

    public function store(EvaluacionStoreRequest $request)
    {
        // sleep(3);
        if($request->hasFile('thumbnail')){
            $filename = $request->thumbnail->getClientOriginalName();
            info($filename); //log
        }
        $evaluacion = Evaluacion::create($request->validated());

        return new EvaluacionResource($evaluacion);
    }

    public function show(Evaluacion $evaluacion)
    {
        return new EvaluacionResource($evaluacion);
    }

    public function update(Evaluacion $evaluacion, EvaluacionStoreRequest $request)
    {
        $evaluacion->update($request->validated());
        return new EvaluacionResource(($evaluacion));
    }

    public function destroy(Evaluacion $evaluacion)
    {
        $evaluacion->delete();
        return response()->noContent();
    }
