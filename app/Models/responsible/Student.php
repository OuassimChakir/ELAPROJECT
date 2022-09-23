<?php

namespace App\Models\Responsible;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Http\Response;

class Student extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = "students";
    protected $primaryKey = "matricule";
    public $incrementing = false;
    
        // Adding a new student 
    public function addStudent($matricule,$nom_fr,$nom_ar,$prenom_fr,$prenom_ar,$cnie,
        $email,$numTel,$sexe,$adresse,$dateNaissance){
            $this->matricule = $matricule;
            $this->nom_fr = $nom_fr;
            $this->nom_ar = $nom_ar;
            $this->prenom_fr = $prenom_fr;
            $this->prenom_ar = $prenom_ar;
            $this->cnie = $cnie;
            $this->email = $email;
            $this->numTel = $numTel;
            $this->sexe = $sexe;
            $this->adresse = $adresse;
            $this->dateNaissance = $dateNaissance;
            $this->save();
    }

    // Get All Students
    public function getStudents(){
        return $this::all();
    
    }
    public function totalStudents(){
        return $this::select()->get()->count();
    
    }
    public function selectStudents($matricule){
        return $this::find($matricule);
    }
    // Select one Student
    public function getStudent($matricule){
        return $this::select('students.*','responsibles.*','students.sexe as sSexe','students.numTel as sNumTel','students.CREATED_AT as sCREATED_AT','students.UPDATED_AT as sUPDATED_AT','students.deleted_at as sDELETED_AT','responsibles.sexe as rSexe', 'responsibles.numTel as rTel',)
                ->where('students.matricule',$matricule)
                ->leftJoin('responsibles','students.cnieResponsible','=','responsibles.cnieResponsible')->first();
    }

    // Adding a new student 


    // Update Student
    public function updateStudent($matricule,$nom_fr,$nom_ar,$prenom_fr,$prenom_ar,$cnie,$email,$numTel,$sexe,$adresse,$dateNaissance){
        $student = $this::find($matricule);
        $student->nom_fr = $nom_fr;
        $student->nom_ar = $nom_ar;
        $student->prenom_fr = $prenom_fr;
        $student->prenom_ar = $prenom_ar;
        $student->cnie = $cnie;
        $student->email = $email;
        $student->numTel = $numTel;
        $student->sexe = $sexe;
        $student->adresse = $adresse;
        $student->dateNaissance = $dateNaissance;
        $student->save();
    }

    // Delete Student
    public function deleteStudent($matricule){
        $this::find($matricule)->delete();
    }

    // Select deleted Students
    public function softDeletedStudents(){
        return $this::onlyTrashed()->get();
    }

    public function getDeletedStudent($matricule){
        return $this::onlyTrashed()
            ->select('students.*','responsibles.*','students.sexe as sSexe','students.numTel as sNumTel','students.CREATED_AT as sCREATED_AT','students.UPDATED_AT as sUPDATED_AT','students.deleted_at as sDELETED_AT','responsibles.sexe as rSexe', 'responsibles.numTel as rTel',)
            ->where('students.matricule',$matricule)
            ->leftJoin('responsibles','students.cnieResponsible','=','responsibles.cnieResponsible')->first();
    }

    public function restoreStudent($matricule){
        $this::withTrashed()
            ->where('matricule',$matricule)
            ->restore();
    }
   
    public function forceDeleteStudent($matricule){
        $this::withTrashed()
            ->where('matricule',$matricule)
            ->forceDelete();
    }
}
