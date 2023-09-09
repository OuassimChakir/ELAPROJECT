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

    public static function addResponsible($cnie,$nom,$prenom,$numTel,$sexe){
        $idResponsible = Responsible::insertGetId([
            'nom' => $nom,
            'prenom' => $prenom,
            'numTel' => $numTel,
            'cnie' => $cnie,
            'sexe' => $sexe,            
        ]);

        return $idResponsible;
    }
    public static function getResponsible($idResponsible){
        return Responsible::find($idResponsible);
    }

    public static function deleteResponsible($idResponsible){
        Responsible::find($idResponsible)->delete();
    }
    public static function fordeleteResponsible($idResponsible){
          Responsible::find($idResponsible)->delete();
    }

    public static function updateResponsible($idResponsible,$cnie,$nom,$prenom,$numTel,$sexe){
        $responsible = Responsible::find($idResponsible);
        $responsible->cnie = $cnie;
        $responsible->nom = $nom;
        $responsible->prenom = $prenom;
        $responsible->numTel = $numTel;
        $responsible->sexe = $sexe;
        $responsible->save();
    }
}
