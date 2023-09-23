<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    /*
    if(session()->get('user')){
        $typeActivity = 0; // 0 = Ajout | 1 = Suppression | 2 = Modification | 3 = Réstauration | 10 = Suppression définitive
        $activityDescription = 'DESCRIPTION';
        Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription,session()->get('user')->name);
    }
    */
    protected $table = "activities";
    protected $primaryKey = "idActivity";
    use HasFactory;
    
        public static function addActivity($idUser,$typeActivity,$description,$name){
            /* @typeActivity
            /   0 = Ajout | 1 = Suppression | 2 = Modification
            */
                      
            switch ($typeActivity) {
                case 0: $type = "a Ajouté"; break;
                case 1: $type = "a Supprimé"; break;
                case 2: $type = "a Modifié"; break;
                case 3: $type = "a Réstauré"; break;
                case 10: $type = "a Supprimé définitivement"; break;
            }
            $activity = new Activite();
            $activity->typeActivity = $type;
            $activity->idUser = $idUser;
            $activity->name = $name;
            $activity->description = $description;
            $activity->dateActivite = date('Y-m-d');
            $activity->save();
        }

        //------------- select all activites----------//
        public static function selectaActivite(){
            return Activite::select('*')
            ->leftJoin('users','users.id','=','activities.idUser')
            ->orderby('activities.created_at','DESC')
            ->get();
        }
        //------------------ select activite by date 
        public static function selectListeActiviteByDate($dateActivite){
            return Activite::select('*')
            ->leftJoin('users','users.id','=','activities.idUser')
            ->where('dateActivite',$dateActivite)
            ->orderby('activities.created_at','DESC')
            ->get();
       }
}
