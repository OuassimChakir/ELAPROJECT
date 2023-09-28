<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupGrades extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['idGrade','idGroup'];

    public static function newGroupGrade($idGrade,$idGroup){
        GroupGrades::insert([
            'idGroup' => $idGroup,
            'idGrade' => $idGrade
        ]);
    }

    public static function getGroupGrades($idGroup){
        return GroupGrades::select('*')
                ->join('grades','group_grades.idGrade','=','grades.idGrade')
                ->where('idGroup',$idGroup)
                ->get();
    }

    public static function deleteGroupGrades($idGroup){
        GroupGrades::where('idGroup',$idGroup)->delete();
    }
}
