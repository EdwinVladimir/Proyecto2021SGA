<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AsignadocStoreRequest;
use App\Http\Resources\AsignadocResource;
use App\Models\Asignadoc;
use Illuminate\Http\Request;

class AsignadocController extends Controller
{
    public function index()
    {
        return AsignadocResource::collection(asignadoc::all());
    }

    public function store(AsignadocStoreRequest $request)
    {
        // sleep(3);
        if($request->hasFile('thumbnail')){
            $filename = $request->thumbnail->getClientOriginalName();
            info($filename); //log
        }
        $asignadoc = Asignadoc::create($request->validated());

        return new AsignadocResource($asignadoc);
    }

    public function show(Asignadoc $asignadoc)
    {
        return new AsignadocResource($asignadoc);
    }

    public function update(Asignadoc $asignadoc, AsignadocStoreRequest $request)
    {
        $asignadoc->update($request->validated());
        return new AsignadocResource(($asignadoc));
    }

    public function destroy(Asignadoc $asignadoc)
    {
        $asignadoc->delete();
        return response()->noContent();
    }

}
