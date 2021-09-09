<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class actividad extends Model
{
    use HasFactory;

    protected $fillable =  ['tipoact_acti','planeva_id'];

    //Relacion Uno a Varios
    public function planevas() {
        
        return $this->belongsTo(Planeva::class,'planeva_id','id');
    }


}
