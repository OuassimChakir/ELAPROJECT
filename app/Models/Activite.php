<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    use HasFactory;
    
        //------------- select all activites----------//
        public function selectaActivite(){
            return $this::select('*')
            ->leftJoin('users','users.id','=','activite.idUser')
            ->get();
        }
}
