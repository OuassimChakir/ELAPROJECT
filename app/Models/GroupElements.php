<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupElements extends Model
{
    use HasFactory;
    protected $table = "groupelements";
    protected $fillable = ['created_at', 'updated_at', 'idStudent', 'idGroup'];
    public static function addElement($idGroup, $idStudent)
    {
        return GroupElements::insertGetId([
            'create_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s'),
            'idStudent' => $idStudent,
            'idGroup' => $idGroup
        ]);
    }
    
    public static function getElement($idGroup, $idStudent){
        return GroupElements::select('*')->where('idGroup',$idGroup)->where('idStudent',$idStudent)->first();
    }

    public static function checkElement($idGroup, $idStudent)
    {
        return GroupElements::where('idGroup', $idGroup)
            ->where('idStudent', $idStudent)
            ->count();
    }

    // SELECT GROUPS OF A STUDENT
    public static function studentClassrooms($matricule)
    {
        return GroupElements::select('classrooms.*', 'groups.*', 'staff.nom', 'staff.prenom')
            ->join('groups', 'groups.idGroup', '=', 'classrooms.idGroup')
            ->join('staff', 'staff.idStaff', '=', 'groups.idStaff')
            ->where('classrooms.idStudent', $matricule)
            ->get();
    }

    // Select ALL STUDENTS OF A SPECIFIC GROUP
    public static function groupElements($idGroup)
    {
        return GroupElements::select('students.*', 'groupelements.idElement','groupelements.created_at as dateAjout')
            ->join('students', 'students.idStudent', '=', 'groupelements.idStudent')
            ->where('idGroup', $idGroup)
            ->get();
    }

    public static function countGroupElements($idGroup)
    {
        return GroupElements::select('*')
            ->where('idGroup', $idGroup)
            ->count();
    }

    // Remove Student from Group
    public static function cancelAssignment($id)
    {
        return GroupElements::find($id)->delete();
    }

    /* ---------------------------------
    /  Delete Group classroom Relations
    /----------------------------------*/
    public static function deleteGroupClassroom($idGroup)
    {
        GroupElements::where('idGroup', $idGroup)->delete();
    }

    // Get Assignment
    public static function getAssignment($id)
    {
        return GroupElements::select('*')
            ->join('groups', 'classrooms.idGroup', '=', 'groups.idGroup')
            ->join('students', 'classrooms.idStudent', '=', 'students.idStudent')
            ->where('id', $id)
            ->first();
    }
}
