<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AulaStoreRequest;
use App\Http\Resources\AulaResource;
use App\Models\Aula;
use Illuminate\Http\Request;

class AulaController extends Controller
{
    public function index()
    {
        return AulaResource::collection(aula::all());
    }

    public function store(AulaStoreRequest $request)
    {
        // sleep(3);
        if($request->hasFile('thumbnail')){
            $filename = $request->thumbnail->getClientOriginalName();
            info($filename); //log
        }
        $aula = Aula::create($request->validated());

        return new AulaResource($aula);
    }

    public function show(Aula $aula)
    {
        return new AulaResource($aula);
    }

    public function update(Aula $aula, AulaStoreRequest $request)
    {
       
        $aula->update($request->validated());
        //dd($aula); 
        return new AulaResource(($aula));
    }

    public function destroy(Aula $aula)
    {
        $aula->delete();
        return response()->noContent();
    }
}
