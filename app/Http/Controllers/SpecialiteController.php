<?php

namespace App\Http\Controllers;

use App\Models\Responsible\Stafftype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SpecialiteController extends Controller
{
    public function staffType(Request $request){
        $staffTypes = Stafftype::getStaffTypes();
        if($request->has('addStaffType')){
            if($request->has('is_mod'))
                Stafftype::addStaffType($request->designation,$request->is_mod);
            else
                Stafftype::addStaffType($request->designation);
            return Redirect::back()->with(['successMessage' => "Spécialitée Ajoutée avec succée!"]);
        }
        return view('pages.staff.staffType')->with([
            'staffTypes' => $staffTypes
        ]);
    }

    /* ------------------------
    / Update
    / ----------------------- */
    public function updateStaffType(Request $request, $idStaffType){
        $updatedStaffType = Stafftype::getStaffType($idStaffType);
        if($request->has('updateStaffType')){
            if($request->has('is_mod'))
                Stafftype::updateStaffType($idStaffType, $request->designation, $request->is_mod);
            else
                Stafftype::updateStaffType($idStaffType, $request->designation);
            return Redirect::route('specialite')->with(['updateMessage' => "Spécialitée Modifiée avec succée!"]);
        }
        return view('pages.staff.staffType')->with([
            'updatedStaffType' => $updatedStaffType
        ]); 
    }

    /* ------------------------
    / Delete
    / ----------------------- */

    public function deleteStaffType($idStaffType){
        Stafftype::deleteStaffType($idStaffType);
        return Redirect::back()->with(['deleteMessage' => "Spécialitée Supprimée avec succée!"]);
    }
}
