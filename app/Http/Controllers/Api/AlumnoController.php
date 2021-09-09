<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AlumnoStoreRequest;
use App\Http\Resources\AlumnoResource;
use App\Models\Alumno;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    public function index(Request $request)
    {   
        $buscar = $request->input('name');
        //Filtername($buscara)->get()->all()
        return AlumnoResource::collection(alumno::Filtername($buscar)->Filterapel($buscar)->Filterdni($buscar)->get()->all());
    }

    public function store(AlumnoStoreRequest $request)
    {
        // sleep(3);
        if($request->hasFile('thumbnail')){
            $filename = $request->thumbnail->getClientOriginalName();
            info($filename); //log
        }
        $alumno = Alumno::create($request->validated());

        return new AlumnoResource($alumno);
    }

    public function show(Alumno $alumno)
    {
        return new AlumnoResource($alumno);
    }

    public function update(Alumno $alumno, AlumnoStoreRequest $request)
    {
        $alumno->update($request->validated());
        return new AlumnoResource(($alumno));
    }

    public function destroy(Alumno $alumno)
    {
        $alumno->delete();
        return response()->noContent();
    }
 
}
