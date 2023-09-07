<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classrooms extends Model
{
    use HasFactory;
    protected $table = "classrooms";
    protected $fillable = ['CREATED_AT', 'UPDATED_AT', 'matricule', 'idGroup'];

    public static function add2Class($idGroup, $matricule)
    {
        Classrooms::create([
            'CREATED_AT' => date('Y-m-d h:i:s'),
            'UPDATED_AT' => date('Y-m-d h:i:s'),
            'matricule' => $matricule,
            'idGroup' => $idGroup
        ]);
    }

    public static function checkClassroom($idGroup, $matricule)
    {
        return Classrooms::where('idGroup', $idGroup)
            ->where('matricule', $matricule)
            ->count();
    }

    // SELECT GROUPS OF A STUDENT
    public static function studentClassrooms($matricule)
    {
        return Classrooms::select('classrooms.*', 'groups.*', 'staff.nom', 'staff.prenom')
            ->join('groups', 'groups.idGroup', '=', 'classrooms.idGroup')
            ->join('staff', 'staff.idStaff', '=', 'groups.idStaff')
            ->where('classrooms.idStudent', $matricule)
            ->get();
    }

    // Select ALL STUDENTS OF A SPECIFIC GROUP
    public static function groupClassroom($idGroup)
    {
        return Classrooms::select('students.*', 'classrooms.*')
            ->join('students', 'students.idStudent', '=', 'classrooms.idStudent')
            ->where('classrooms.idGroup', $idGroup)
            ->get();
    }

    public static function classroomElements($idGroup)
    {
        return Classrooms::select('*')
            ->where('idGroup', $idGroup)
            ->count();
    }

    // Remove Student from Group
    public static function cancelAssignment($id)
    {
        return Classrooms::find($id)->delete();
    }

    /* ---------------------------------
    /  Delete Group classroom Relations
    /----------------------------------*/
    public static function deleteGroupClassroom($idGroup)
    {
        Classrooms::where('idGroup', $idGroup)->delete();
    }

    // Get Assignment
    public static function getAssignment($id)
    {
        return Classrooms::select('*')
            ->join('groups', 'classrooms.idGroup', '=', 'groups.idGroup')
            ->join('students', 'classrooms.idStudent', '=', 'students.idStudent')
            ->where('id', $id)
            ->first();
    }
}
