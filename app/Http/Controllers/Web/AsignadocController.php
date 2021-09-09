<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AsignadocController extends Controller
{
    public function asignadoc(){

        return view('web.asignadoc');
        
    }
}
