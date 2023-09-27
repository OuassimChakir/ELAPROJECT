<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activite;
use Illuminate\Support\Facades\Redirect;

class ActiviteController extends Controller
{
    // all activites 
    public function activite(Request $request)
    {
        $activites = Activite::selectaActivite();
        if ($request->has('getActivite')) {
            $dateActivite = $request->dateActivite;
            $Activitedate = Activite::selectListeActiviteByDate($dateActivite);
            // dd($Activitedate);
            return view('activation')->with('Activitedate', $Activitedate);
        }
        return view('activation')->with('activites', $activites);
    }
    public function activitedeleteAll()
    {
        $activites = Activite::selectaActivite();
        foreach ($activites as $activite) {
            Activite::deleteAllActivty($activite->idActivity);
        }
        return Redirect::back()->with('deleteMessage', "Les Activités séléctionés ont été supprimer Définitivement");
    }
}
