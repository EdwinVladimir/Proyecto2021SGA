<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TiposangreStoreRequest;
use App\Http\Resources\TiposangreResource;
use App\Models\tiposangre;
use Illuminate\Http\Request;

class TiposangreController extends Controller
{
    public function index()
    {
        return TiposangreResource::collection(tiposangre::all());
    }

    public function store(TiposangreStoreRequest $request)
    {
        // sleep(3);
        if($request->hasFile('thumbnail')){
            $filename = $request->thumbnail->getClientOriginalName();
            info($filename); //log
        }
        $tiposangre = Tiposangre::create($request->validated());

        return new TiposangreResource($tiposangre);
    }

    public function show(Tiposangre $tiposangre)
    {
        return new TiposangreResource($tiposangre);
    }

    public function update(Tiposangre $tiposangre, TiposangreStoreRequest $request)
    {
        $tiposangre->update($request->validated());
        return new TiposangreResource(($tiposangre));
    }

    public function destroy(Tiposangre $tiposangre)
    {
        $tiposangre->delete();
        return response()->noContent();
    }

}
