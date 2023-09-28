<?php

namespace App\Http\Controllers;

use App\Models\Emploi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EmploiController extends Controller
{
    public function addEmploi(Request $request, $idGroup){
        if($request->has('addEmploi')){
            if(Emploi::getGroupEmploi($idGroup)->count() > 0)
                return Redirect::back()->with('deleteMessage',"Ce groupe dispose déjà d'un programme! ");

            for ($i=0; $i < count($request->jour); $i++)
                Emploi::addEmploi($request->jour[$i], $request->debut[$i], $request->fin[$i], $idGroup);
            
            return Redirect::back()->with('successMessage','Programme ajouté avec succès !');
        }
    }

    public function updateEmploi(Request $request){
        if($request->has('updateEmploi')){
            Emploi::deleteEmploi($request->idGroup);
            for ($i=0; $i < count($request->jour); $i++)
                Emploi::addEmploi($request->jour[$i], $request->debut[$i], $request->fin[$i], $request->idGroup);
            return Redirect::back()->with('updateMessage','Programme Modifier avec succès !');
        }
    }

    public function deleteEmploi(Request $request){
        if($request->has('deleteEmploi')){
            Emploi::deleteEmploi($request->deleteEmploi);
            return Redirect::back()->with('deleteMessage','Programme Supprimé avec succès !');
        }
    }
}
