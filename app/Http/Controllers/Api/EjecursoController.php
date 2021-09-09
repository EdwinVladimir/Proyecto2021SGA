<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EjecursoStoreRequest;
use App\Http\Resources\EjecursoResource;
use App\Models\Ejecurso;
use Illuminate\Http\Request;

class EjecursoController extends Controller
{
    public function index()
    {
        return EjecursoResource::collection(ejecurso::all());
    }

    public function store(EjecursoStoreRequest $request)
    {
        // sleep(3);
        if($request->hasFile('thumbnail')){
            $filename = $request->thumbnail->getClientOriginalName();
            info($filename); //log
        }
        $ejecurso = Ejecurso::create($request->validated());

        return new EjecursoResource($ejecurso);
    }

    public function show(Ejecurso $ejecurso)
    {
        return new EjecursoResource($ejecurso);
    }

    public function update(Ejecurso $ejecurso, EjecursoStoreRequest $request)
    {
        $ejecurso->update($request->validated());
        return new EjecursoResource(($ejecurso));
    }

    public function destroy(Ejecurso $ejecurso)
    {
        $ejecurso->delete();
        return response()->noContent();
    }

}
