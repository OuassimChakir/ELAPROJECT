<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emploi extends Model
{
    use HasFactory;
    protected $table = "emplois";
    protected $primaryKey = 'idEmploi';
    protected $fillable = ['jour','debut','fin','idGroup'];
    public $timestamps = false;

    public static function addEmploi($jour, $debut, $fin, $idGroup){
        Emploi::create([
            'jour' => $jour,
            'debut' => $debut,
            'fin' => $fin,
            'idGroup' => $idGroup,
        ]);
    }

    public static function getGroupEmploi($idGroup){
        return Emploi::where('idGroup', $idGroup)->get();
    }

    public static function deleteEmploi($idGroup){
        return Emploi::where('idGroup', $idGroup)->delete();
    }
}
