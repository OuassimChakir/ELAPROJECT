<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Stafftype;
use App\Models\Subjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class StaffController extends Controller
{    // Staff Type Controller
    public function staff(Request $request){
        $Staf = new Staff();
        // List of Staff
        $Staff = $Staf->selectStaff();
        // Creating new staffType
        $Stafftype = new Stafftype();
        // select of Stafftype
        $stafft = $Stafftype->selectStaffType();
        // Creating new Subjects
        $Subjects = new Subjects();
        // select of Stafftype
        $subjects = $Subjects->selectSubjects();
        // add staff
        if($request->has('ajouterClient')){
            $cnie = $request->cnie;
            $prenom = $request->prenom;
            $nom = $request->nom;
            $email = $request->email;
            $numTel = $request->numTel;
            $idStaffType = $request->idStaffType;
            $idSubject = $request->idSubject;
            $Staf->addStaff($cnie,$prenom,$nom,$email,$numTel,$idStaffType,$idSubject);
            return Redirect::back()->with('successType',"L'ajout se fait avec succès");
        }
                // Deletion
                if($request->has('delete')){
                    $idStaff = $request->delete;
                    $Staf ->deleteStaff($idStaff);
                    return Redirect::back()->with('deleteType',"La suppression est faite avec succès");
                }
       
        return view('pages.responsible.staff')->with(['Staff' => $Staff,
                                                      'stafft' => $stafft,
                                                      'subjects'=>$subjects,]);
    }


}