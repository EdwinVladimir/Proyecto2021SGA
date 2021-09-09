<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MatriculaStoreRequest;
use App\Http\Resources\MatriculaResource;
use App\Http\Resources\ModalidadcursoResource;
use App\Models\Matricula;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->input('name');
        
        return MatriculaResource::collection(matricula::Filteralumnoid($buscar)->get()->all());
    }

    public function store(MatriculaStoreRequest $request)
    {
        // sleep(3);
        if($request->hasFile('thumbnail')){
            $filename = $request->thumbnail->getClientOriginalName();
            info($filename); //log
        }
        $matricula = Matricula::create($request->validated());

        return new MatriculaResource($matricula);
    }

    public function show(Matricula $matricula)
    {
        return new MatriculaResource($matricula);
    }

    public function update(Matricula $matricula, MatriculaStoreRequest $request)
    {
        $matricula->update($request->validated());
        return new MatriculaResource(($matricula));
    }

    public function destroy(Matricula $matricula)
    {
        $matricula->delete();
        return response()->noContent();
    }

}
