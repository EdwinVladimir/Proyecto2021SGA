<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class evaluacion extends Model
{
       
    protected $fillable = ['id','alumno_id', 'fecreg_eval', 'actividad_id', 'nota_deteva'];


  
    //Relacion uno a Muchos
    public function alumnos() {
    
    return $this->hasMany('App\Models\Alumno');
    }
    
      //Relacion Uno a Uno
      public function actividad() {

        return $this->belongsTo(Actividad::class,'actividad_id');
    }

    //Relacion uno a Muchos
   // public function periodos() {
    
    //    return $this->hasMany('App\Models\Periodo');
     //   }
    //Relacion uno a Muchos
    
  //  public function cursos() {
    
 //       return $this->hasMany('App\Models\Curso');
 //       }

    }