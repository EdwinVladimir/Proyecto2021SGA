<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalleva extends Model
{
    use HasFactory;

    protected $fillable =  [ 'evaluacion_id','planeva_id','materia_id','actividad_id','detalacti_id', 'nota_deteva'];

    //Relacion Uno a Uno
    public function evaluacion() {

        return $this->belongsTo(Evaluacion::class,'evaluacion_id');
    }

    //Relacion Uno a Uno
    public function planeva() {

        return $this->belongsTo(Planeva::class,'planeva_id');
    }

    //Relacion Uno a Uno
    public function materia() {

        return $this->belongsTo(Materia::class,'materia_id');
    }

    //Relacion Uno a Uno
    public function actividad() {

        return $this->belongsTo(Actividad::class,'actividad_id');
    }

    //Relacion Uno a Uno
    public function detalacti() {

        return $this->belongsTo(Detalacti::class,'detalacti_id');
    }
    

}



