<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PeriodoStoreRequest;
use App\Http\Resources\PeriodoResource;
use App\Models\Periodo;
use Illuminate\Http\Request;

class PeriodoController extends Controller
{
    public function index()
    {
        return PeriodoResource::collection(periodo::all());
    }

    public function store(PeriodoStoreRequest $request)
    {
        // sleep(3);
        if($request->hasFile('thumbnail')){
            $filename = $request->thumbnail->getClientOriginalName();
            info($filename); //log
        }
        $periodo = Periodo::create($request->validated());

        return new PeriodoResource($periodo);
    }

    public function show(Periodo $periodo)
    {
        return new PeriodoResource($periodo);
    }

    public function update(Periodo $periodo, PeriodoStoreRequest $request)
    {
        $periodo->update($request->validated());
        return new PeriodoResource(($periodo));
    }

    public function destroy(Periodo $periodo)
    {
        $periodo->delete();
        return response()->noContent();
    }

}
