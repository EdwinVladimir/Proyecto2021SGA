<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EvaluacionsResource extends JsonResource
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
            'alumno_id' => $this->alumno_id,
            'fecreg_eval' => $this->fecreg_eval,
            'actividad_id' => $this->nactividad_id,
            'nota_deteva' => $this->nota_deteva
        ];
    }
}


