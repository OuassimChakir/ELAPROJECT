<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Activite;

class ActiviteController extends Controller
{
    // all activites 
    public function activite(){
        $Activite = new Activite();
        $activites = $Activite->selectaActivite();
        return view('activation')->with('activites',$activites);
    }
}
