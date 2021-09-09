<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DetalactiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'descrip_detac' => $this->descrip_detac,
            'poreva_detac' => $this->poreva_detac,
            'actividad_i' => $this->actividad_i,
        ];
    }
}



