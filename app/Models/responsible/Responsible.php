<?php

namespace App\Models\Responsible;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsible extends Model
{
    protected $table = "responsibles";
    protected $primaryKey = "cnieResponsible";
    public $incrementing = false;
    protected $keyType = 'varchar';
    use HasFactory;

    public function addResponsible($cnieResponsible,$nom,$prenom,$numTel,$sexe,$matricule){
        $this->cnieResponsible = $cnieResponsible;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->numTel = $numTel;
        $this->sexe = $sexe;
        $this->save();

        $Student = new Student();
        $updatedStudent = $Student::find($matricule);
        $updatedStudent->cnieResponsible = $cnieResponsible;
        $updatedStudent->save();
    }
    public function getResponsible($cnieResponsible){
        return $this::find($cnieResponsible);
    }

    public function deleteResponsible($cnieResponsible,$matricule){
        $student = new Student();
        $updatedStudent = $student::find($matricule);
        $updatedStudent -> cnieResponsible = NULL;
        $updatedStudent -> save();
        $this::find($cnieResponsible)->delete();
    }
    public static function fordeleteResponsible($cnieResponsible){
          Responsible::find($cnieResponsible)->delete();
    }

    public function updateResponsible($cnieResponsible,$nom,$prenom,$numTel,$sexe){
        $responsible = $this::find($cnieResponsible);
        $responsible->cnieResponsible = $cnieResponsible;
        $responsible->nom = $nom;
        $responsible->prenom = $prenom;
        $responsible->numTel = $numTel;
        $responsible->sexe = $sexe;
        $responsible->save();
    }
}
