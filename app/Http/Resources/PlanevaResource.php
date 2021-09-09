<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlanevaResource extends JsonResource
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

            'fecent_plaeva' => $this->fecent_plaeva,

            'feins_matri' => $this->feins_matri,

            
            'docente_id' => $this->docente_id,
            'docente'=>$this->alumnos()->get(['dni_doc','nom_doc','ape_doc']),

            'periodo_id' => $this->periodo_id,
            'periodo'=>$this->periodos()->get(['ano_per']),

            'materia_id' => $this->materia_id,
            'materia'=>$this->materias()->get(['nom_mat']),
           

            ];
    }
}


