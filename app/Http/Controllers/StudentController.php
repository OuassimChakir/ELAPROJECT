<?php

namespace App\Http\Controllers;
use App\Models\responsible\Staff;
use App\Models\responsible\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function student(Request $request){
        // Restart from 0 EACH YEAR
        if(date('d-m') == "01-01")
            Storage::disk('local')->put('student.txt',0);
        $Student = new Student();
        $students = $Student->getStudents();

        // New Student
        if($request->has('addStudent')){
            $studentsCounter = 1;
            if(!Storage::exists('student.txt'))
                Storage::disk('local')->put('student.txt',0);
            $studentsCounter += Storage::get('student.txt');
            Storage::disk('local')->put('student.txt',$studentsCounter);
            $matricule = "ELA".$studentsCounter."-".date('Y');
            $prenom_fr = $request->prenom_fr;
            $prenom_ar = $request->prenom_ar;
            $nom_fr = $request->nom_fr;
            $nom_ar = $request->nom_ar;
            $email = $request->email;
            $numTel = $request->numTel;
            $dateNaissance = $request->dateNaissance;
            $cnie = $request->cnie;
            $sexe = $request->sexe;
            $adresse = $request->adresse;
            $Student->addStudent($matricule,$nom_fr,$nom_ar,$prenom_fr,$prenom_ar,$cnie,$email,$numTel,$sexe,$adresse,$dateNaissance);
            return Redirect::back()->with('successType',"L'ajout est fait avec succès")->with('students',$students);
        }
        return view('pages.responsible.student')->with('students',$students);
    }

    public function studentProfil(Request $request){
        $Student = new Student();
        $studentInfo = $Student->getStudent($request->matricule);
        return view('pages.responsible.studentprofil')->with('student',$studentInfo);
    }
}
