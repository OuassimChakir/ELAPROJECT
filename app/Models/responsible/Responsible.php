<?php

namespace App\Models\Responsible;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsible extends Model
{
    protected $table = "responsibles";
    protected $primaryKey = "idResponsible";
    public $incrementing = false;
    use HasFactory;
    protected $fillable = ['nom','prenom','cnie','numTel','sexe','created_at','updated_at'];

    public static function addResponsible($cnie,$nom,$prenom,$numTel,$sexe,$matricule){
        $responsible = Responsible::create([
            'nom' => $nom,
            'prenom' => $prenom,
            'numTel' => $numTel,
            'cnie' => $cnie,
            'sexe' => $sexe,            
        ]);

        return $responsible->idResponsible;
    }
    public static function getResponsible($cnieResponsible){
        return Responsible::find($cnieResponsible);
    }

    public static function deleteResponsible($cnieResponsible,$matricule){
        $student = new Student();
        $updatedStudent = $student::find($matricule);
        $updatedStudent -> cnieResponsible = NULL;
        $updatedStudent -> save();
        Responsible::find($cnieResponsible)->delete();
    }
    public static function fordeleteResponsible($cnieResponsible){
          Responsible::find($cnieResponsible)->delete();
    }

    public static function updateResponsible($cnieResponsible,$nom,$prenom,$numTel,$sexe){
        $responsible = Responsible::find($cnieResponsible);
        $responsible->cnieResponsible = $cnieResponsible;
        $responsible->nom = $nom;
        $responsible->prenom = $prenom;
        $responsible->numTel = $numTel;
        $responsible->sexe = $sexe;
        $responsible->save();
    }
}
