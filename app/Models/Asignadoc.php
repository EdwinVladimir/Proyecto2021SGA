<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class asignadoc extends Model
{
    use HasFactory; 
    
    protected $fillable = ['id','periodo_id','seccion_id','materia_id','docente_id','aula_id'];    

    //Relación uno a muchos (Inversa)
    public function periodos(){
    
        return $this->belongsTo(periodo::class,'periodo_id','id');
    }

    //Relación uno a muchos (Inversa)
    public function seccions(){
    
        return $this->belongsTo(seccion::class,'seccion_id','id');
    }

    //Relación uno a muchos (Inversa)
    public function materias(){
    
        return $this->belongsTo(materia::class,'materia_id','id');
    }

    //Relación uno a muchos (Inversa)
    public function docentes(){
    
        return $this->belongsTo(Docente::class,'docente_id','id');
    }

    //Relación uno a muchos (Inversa)
    public function aulas(){
    
        return $this->belongsTo(aula::class,'aula_id','id');
    }


}
