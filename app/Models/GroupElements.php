<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GroupElements extends Model
{
    use HasFactory;
    protected $table = "groupelements";
    protected $primaryKey = "idElement";
    protected $fillable = ['created_at', 'updated_at', 'idStudent', 'idGroup'];
    public static function addElement($idGroup, $idStudent)
    {
        GroupElements::create([
            'created_at' => date('Y-m-d h:i:s'),
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
    public static function studentGroups($idStudent)
    {
        return GroupElements::select('*','groupelements.created_at','groupelements.updated_at')
            ->join('groups', 'groups.idGroup', '=', 'groupelements.idGroup')
            ->join('professeurs', 'professeurs.idProfesseur', '=', 'groups.idProfesseur')
            ->join('subjects', 'subjects.idSubject', '=', 'groups.idSubject')
            ->join('coursetype', 'coursetype.idCourseType', '=', 'subjects.idCourseType')
            ->where('groupelements.idStudent', $idStudent)
            ->get();
    }

    public static function paimentStudents($idGroup){
        return DB::select("select groupelements.*, students.*, count(idPayment) as payments from groupelements inner join students on groupelements.idStudent = students.idStudent left join payment on (payment.idGroup = groupelements.idGroup) AND (payment.idStudent = groupelements.idStudent) group by idElement having idGroup = ".$idGroup." order by payments asc");
    }

    public static function countElementPaiments($idGroup){
        return GroupElements::select('*')
            ->selectRaw('(select count(idPayment) from payment where idStudent = groupelements.idStudent AND idGroup = groupelements.idGroup) as payments')
            ->where('idGroup',$idGroup)
            ->groupBy('idElement')
            ->having('payments',0)
            ->count();
    }

    // Select ALL STUDENTS OF A SPECIFIC GROUP
    public static function groupElements($idGroup)
    {
        return GroupElements::select('students.*', 'groupelements.idElement','groupelements.created_at as dateAjout')
            ->selectRaw('count(idPayment) - sum(etat) as pendingPaiment')
            ->join('students', 'students.idStudent', '=', 'groupelements.idStudent')
            ->leftjoin('payment','payment.idStudent','=','students.idStudent')
            ->where('groupelements.idGroup', $idGroup)
            ->whereNotNull('etat')
            ->where('etat','!=',2)
            ->whereNull('payment.deleted_at')
            ->groupBy('students.idStudent')
            ->get();
    }

    public static function countGroupElements($idGroup)
    {
        return GroupElements::select('*')
            ->where('idGroup', $idGroup)
            ->count();
    }

    // Remove Student from Group
    public static function cancelAssignment($idElement)
    {
        return GroupElements::find($idElement)->delete();
    }

    public static function cancelStudentAssignments($idStudent){
        return GroupElements::where('idStudent',$idStudent)->delete();
    }

    /* ---------------------------------
    /  Delete Group classroom Relations
    /----------------------------------*/
    public static function deleteGroupClassroom($idGroup)
    {
        GroupElements::where('idGroup', $idGroup)->delete();
    }


    // Get Assignment
    public static function getAssignment($idElement)
    {
        return GroupElements::select('*')
            ->join('groups', 'groupelements.idGroup', '=', 'groups.idGroup')
            ->join('students', 'groupelements.idStudent', '=', 'students.idStudent')
            ->where('idElement', $idElement)
            ->first();
    }

    /* --------------------------------
    / Student Status in Group
    / -------------------------------- */
}
