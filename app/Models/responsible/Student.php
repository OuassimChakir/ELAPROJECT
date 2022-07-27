<?php

namespace App\Models\Responsible;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Response;

class Student extends Model
{
    use HasFactory;
    protected $table = "students";
    protected $primaryKey = "matricule";
    public $incrementing = false;

    // Get All Students
    public function getStudents(){
        return $this::all();
    }
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

        // Select one Student
    public function getStudent($matricule){
        return $this::find($matricule);
    }
   
}
