<?php

namespace App\Http\Controllers;
use App\Models\responsible\Staff;
use App\Models\responsible\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function Student(Request $request){
        $Student = new Student();
        // List of Staff
        $student = $Student->selectStudent();
        $lastid = $Student->lastid();
         // add student
         if($request->has('addstudent')){
            $matricule = $request->matricule;
            $nom_fr =$request-> nom_fr;
            $nom_ar = $request->nom_ar;
            $prenom_fr = $request->prenom_fr;
            $prenom_ar =$request->prenom_ar;
            $cnie =$request->cnie;
            $email =$request->email;
            $numTel = $request->numTel;
            $sexe =$request->sexe;
            $adresse =$request->adresse;
            $dateNaissance =$request->dateNaissance;     
            $Student->addStudent($matricule,$nom_fr,$nom_ar,$prenom_fr,$prenom_ar,$cnie,
            $email,$numTel,$sexe,$adresse,$dateNaissance);          
            return redirect()->route('student.add')->with([
                'success'=>'Etudiant ajouté avec success',
                 ]); 
        }
  
        return view('pages.responsible.student')->with(['student' => $student,
                                                        'lastid' => $lastid,
                                                     ]);
    }
}
