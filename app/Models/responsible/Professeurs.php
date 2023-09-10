<?php

namespace App\Models\responsible;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Professeurs extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "professeurs";
    protected $primaryKey = "idProfesseur";
    protected $fillable = ['cnie', 'nom', 'prenom', 'sexe', 'email', 'numTel','idSubject', 'created_at', 'updated_at'];


    public static function getProfesseurs(){
        return Professeurs::select('*')
            ->leftJoin('subjects', 'subjects.idSubject', '=', 'professeurs.idSubject')
            ->get();
    }
    public static function getProfesseur($idProfesseur){
        return Professeurs::select('*')
            ->join('subjects', 'subjects.idSubject', '=', 'professeurs.idSubject')
            ->where('idProfesseur',$idProfesseur)           
            ->first();
    }

    // elete Professeur  //
    public static function deleteProfesseur($idProfesseur){
        Professeurs::find($idProfesseur)->delete();
    }
    public static function addProfesseur($cine, $prenom, $nom, $sexe, $numTel, $idSubject)
    {
        $professeurs = Professeurs::Create([
            'cine' => $cine,
            'prenom' => $prenom,
            'nom' => $nom,
            'sexe' => $sexe,
            'numTel' => $numTel,
            'idSubject' => $idSubject,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        return $professeurs;
    }
    
    public static function updateProfesseur($idProfesseur, $cine, $prenom, $nom, $sexe, $numTel, $idSubject)
    {
        $staff = Professeurs::find($idProfesseur);
        $staff->cnie = $cine;
        $staff->nom = $nom; 
        $staff->prenom = $prenom;
        $staff->sexe = $sexe;
        $staff->numTel = $numTel;
        $staff->idSubject = $idSubject;
        $staff->save();
    }


    // --------------- TEACHER ARCHIVE ------------------ //
    // Select deleted Professeur
    public static function softDeletedTeachers(){
        return Professeurs::onlyTrashed()
            ->select('*','professeurs.created_at','professeurs.updated_at')
            ->leftJoin('subjects', 'subjects.idSubject', '=', 'professeurs.idSubject')
            ->get();
    }

    public static function getDeletedTeacher($idProfesseur){
        return Professeurs::onlyTrashed()->select('*')
            ->leftJoin('subjects', 'subjects.idSubject', '=', 'professeurs.idSubject')
            ->where('idProfesseur', $idProfesseur)
            ->first();
    }

    public static function restoreTeacher($idProfesseur){
        Professeurs::withTrashed()
            ->where('idProfesseur', $idProfesseur)
            ->restore();
    }

    public static function forceDeleteTeacher($idProfesseur){
        Professeurs::withTrashed()
            ->where('idProfesseur', $idProfesseur)
            ->forceDelete();
    }
}