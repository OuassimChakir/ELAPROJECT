<?php

namespace App\Http\Controllers;

use App\Models\Responsible\Responsible;
use App\Models\responsible\Staff;
use App\Models\responsible\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    // -------------- Students -------------- //
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

    public function studentProfil(Request $request,$matricule){
        $Student = new Student();
        $studentInfo = $Student->getStudent($matricule);
        return view('pages.responsible.studentprofil')->with('student',$studentInfo);
    }

    public function updateStudent(Request $request,$matricule){
        $Student = new Student();
        $studentInfo = $Student->getStudent($matricule);
        if($request->has('updateStudent')){
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
            $Student->updateStudent($request->matricule,$nom_fr,$nom_ar,$prenom_fr,$prenom_ar,$cnie,$email,$numTel,$sexe,$adresse,$dateNaissance);
            
            return Redirect::back()
                ->with('updateStudent',"La Modification est faite avec succès")
                ->with('student',$studentInfo);
        }
    }

    public function deleteStudent(Request $request,$matricule){
        $Student = new Student();
        $Student->deleteStudent($matricule);
        $studentInfo = $Student->getStudents();
        return Redirect::route('student.liste')
            ->with('deleteType',"La suppression est faite avec succès")
            ->with('students',$studentInfo);;
    }

    // -------------- Responsible -------------- //
    public function addResponsible(Request $request){
        if($request->has('addReponsible')){
            $Responsible = new Responsible();
            $cnieResponsible = $request->cine;
            $nom = $request->nom;
            $prenom = $request->prenom;
            $numTel = $request->numTel;
            $sexe = $request->sexe;
            $matricule = $request->matricule;
            $Responsible->addResponsible($cnieResponsible,$nom,$prenom,$numTel,$sexe,$matricule);
            return Redirect::back()->with('successType',"L'ajout du Responsable est faite avec succès");
        }
    }

    public function updateResponsible(Request $request,$cnieResponsible){
        $Responsible = new Responsible();
        $Responsible->updateResponsible($request->cine,$request->nom,$request->prenom,$request->numTel,$request->sexe);
        return Redirect::back()->with('updateMessage',"La Modification du Responsable est faite avec succès");
    }

    public function deleteResponsible(Request $request,$matricule, $cnieResponsible){
        $Responsible = new Responsible();
        $Responsible->deleteResponsible($cnieResponsible,$matricule);
        return Redirect::back()->with('deleteType',"La suppression du Responsable est faite avec succès")->with('matricule',$matricule);
    }


    // ----------- ARCHIVE ------------- //
    public function archive(){
        $Student = new Student();
        $students = $Student->softDeletedStudents();
        return view('pages.responsible.studentArchive')->with('students',$students);
    }

    public function archivedStudent($matricule){
        $Student = new Student();
        $studentInfo = $Student->getDeletedStudent($matricule);
        return view('pages.responsible.archivedStudentProfil')->with('student',$studentInfo);
    }

    public function restoreArchivedStudent($matricule){
        $Student = new Student();
        $Student->restoreStudent($matricule);
        return Redirect::back()->with('restoreMessage',"L'étudiant a été restorer avec succès");
    }

    public function deleteArchivedStudent($matricule){
        $Student = new Student();
        $Student->forceDeleteStudent($matricule);
        return Redirect::back()->with('deleteMessage',"L'étudiant a été supprimer Définitivement");
    }

    public function multipleArchivedStudents(Request $request){
        $Student = new Student();
        if($request->has('restoreAll')){
            foreach($request->archivedStudents as $matricule){
                $Student->restoreStudent($matricule);
            }
            return Redirect::back()->with('restoreMessage',"Les étudiants séléctionés ont été restorer avec succès");
        }
        if($request->has('deleteAll')){
            foreach($request->archivedStudents as $matricule){
                $Student->forceDeleteStudent($matricule);
            }
            return Redirect::back()->with('deleteMessage',"Les étudiants séléctionés ont été supprimer Définitivement");
        }
    }
}
