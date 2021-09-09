<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class planeva extends Model
{
    use HasFactory;

    protected $fillable = ['id','docente_id','periodo_id','materia_id','fecent_plaeva'];


    //Relación uno a muchos (Inversa)
    public function docentes(){
    
        return $this->belongsTo(Docente::class,'docente_id','id');
    }

   //Relación uno a muchos (Inversa)
    public function periodos(){
    
        return $this->belongsTo(periodo::class,'periodo_id','id');
    }


     //Relación uno a muchos (Inversa)
    public function materias(){
    
        return $this->belongsTo(materia::class,'materia_id','id');
    }
    
    //Relacion uno a Muchos
    public function actividads() {
        
        return $this->hasMany('App\Models\Actividad');
    }
}