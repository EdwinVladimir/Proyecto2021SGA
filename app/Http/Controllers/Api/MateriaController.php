<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MateriaStoreRequest;
use App\Http\Resources\MateriaResource;
use App\Models\Materia;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    public function index()
    {
        return MateriaResource::collection(materia::all());
     
    }

    public function store(MateriaStoreRequest $request)
    {
        // sleep(3);
        if($request->hasFile('thumbnail')){
            $filename = $request->thumbnail->getClientOriginalName();
            info($filename); //log
        }
        $materia = Materia::create($request->validated());

        return new MateriaResource($materia);
    }

    public function show(Materia $materia)
    {
        return new MateriaResource($materia);
    }

    public function update(Materia $materia, MateriaStoreRequest $request)
    {
        $materia->update($request->validated());
        return new MateriaResource(($materia));
    }

    public function destroy(Materia $materia)
    {
        $materia->delete();
        return response()->noContent();
    }
}
