<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DetalactiController extends Controller
{
    public function index()
    {
        return DetalactiResource::collection(detalacti::all());
    }

    public function store(DetalactiStoreRequest $request)
    {
        // sleep(3);
        if($request->hasFile('thumbnail')){
            $filename = $request->thumbnail->getClientOriginalName();
            info($filename); //log
        }
        $detalacti = Detalacti::create($request->validated());

        return new DetalactiResource($detalacti);
    }

    public function show(Detalacti $detalacti)
    {
        return new DetalactiResource($detalacti);
    }

    public function update(Detalacti $detalacti, DetalactiStoreRequest $request)
    {
       
        $detalacti->update($request->validated());
        //dd($Detallevas); 
        return new DetalactiResource(($detalleva));
    }

    public function destroy(Detalacti $detalacti)
    {
        $detalacti->delete();
        return response()->noContent();
    }
}
