<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activite;

class ActiviteController extends Controller
{
    // all activites 
    public function activite(Request $request){
        $activites =Activite::selectaActivite();
        if($request->has('getActivite')){
            $dateActivite = $request->dateActivite;
            $Activitedate = Activite::selectListeActiviteByDate($dateActivite);
           // dd($Activitedate);
            return view('activation')->with('Activitedate',$Activitedate);
        }
        return view('activation')->with('activites',$activites);
    }
}
