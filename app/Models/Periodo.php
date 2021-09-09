<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class periodo extends Model
{
    use HasFactory;
    
    protected $fillable = ['id','ano_per','peri_per','finic_per','ffin_per'];


    //Relacion uno a Muchos
    public function asignadoc() {
    
        return $this->hasMany('App\Models\Asignadoc');
    }

    //Relacion uno a Muchos
    public function matriculas() {
    
        return $this->hasMany('App\Models\matricula');
    }

    //Relacion uno a Muchos
    public function planevas() {
    
        return $this->hasMany('App\Models\Planeva');
    }

}
