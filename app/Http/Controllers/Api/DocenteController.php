<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DocenteStoreRequest;
use App\Http\Resources\DocenteResource;
use App\Models\Docente;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->input('name');

        return DocenteResource::collection(docente::Filtername($buscar)->Filterapel($buscar)->Filterdni($buscar)->get()->all());

        //return DocenteResource::collection(docente::all());
    }

    public function store(DocenteStoreRequest $request)
    {
        // sleep(3);
        if($request->hasFile('thumbnail')){
            $filename = $request->thumbnail->getClientOriginalName();
            info($filename); //log
        }
        $docente = Docente::create($request->validated());

        return new DocenteResource($docente);
    }

    public function show(Docente $docente)
    {
        return new DocenteResource($docente);
    }

    public function update(Docente $docente, DocenteStoreRequest $request)
    {
        $docente->update($request->validated());
        return new DocenteResource(($docente));
    }

    public function destroy(Docente $docente)
    {
        $docente->delete();
        return response()->noContent();
    }
    
}
