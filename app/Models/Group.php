<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "groups";
    protected $primaryKey = "idGroup";
    protected $fillable = ['designation', 'capacity', 'idSubject', 'idGrade', 'idStaff', 'CREATED_AT', 'UPDATED_AT'];

    // ------- Selections ----------- //
    public static function totalGroups(){
        return Group::select()->get()->count();
    }

    // ***** Select Groupes ******* //
    public static function getGroups(){
        return Group::select('groups.*', 'subjects.*', 'professeurs.*','courseType.*')
            ->selectRaw('(SELECT count(idStudent) FROM `groups` as g
            INNER JOIN payment ON payment.idGroup = g.idGroup
            WHERE etat = 0 AND g.idGroup = groups.idGroup) as pendingPaiment')
            ->join('professeurs', 'groups.idProfesseur', '=', 'professeurs.idProfesseur')
            ->join('subjects', 'groups.idSubject', '=', 'subjects.idSubject')
            ->join('courseType', 'courseType.idCourseType', '=', 'subjects.idCourseType')
            ->get();
    }

    public static function getStudentGroups($idStudent){
        return Group::select('groups.*', 'subjects.*', 'professeurs.*','courseType.*')
            ->selectRaw('(SELECT count(idPayment) FROM  payment
            WHERE etat = 0 AND idStudent = '.$idStudent.') as pendingPaiment')
            ->join('professeurs', 'groups.idProfesseur', '=', 'professeurs.idProfesseur')
            ->join('subjects', 'groups.idSubject', '=', 'subjects.idSubject')
            ->join('courseType', 'courseType.idCourseType', '=', 'subjects.idCourseType')
            ->join('groupelements','groupelements.idGroup','=','groups.idGroup')
            ->where('groupelements.idStudent',$idStudent)
            ->get();
    }

    public static function getProfGroups($idProfesseur){
        return Group::select('groups.*', 'subjects.*', 'professeurs.*','courseType.*')
            ->join('professeurs', 'groups.idProfesseur', '=', 'professeurs.idProfesseur')
            ->join('subjects', 'groups.idSubject', '=', 'subjects.idSubject')
            ->join('courseType', 'courseType.idCourseType', '=', 'subjects.idCourseType')
            ->where('groups.idProfesseur',$idProfesseur)
            ->get();
    }

    // ***** Select a Specific Group ******* //
    public static function getGroup($idGroup){
        return Group::select('groups.*', 'subjects.*', 'professeurs.idProfesseur', 'professeurs.nom', 'professeurs.prenom')
            ->join('subjects', 'groups.idSubject', '=', 'subjects.idSubject')
            ->Join('coursetype', 'subjects.idCourseType', '=', 'coursetype.idCourseType')
            ->join('professeurs', 'groups.idProfesseur', '=', 'professeurs.idProfesseur')
            ->where('idGroup', $idGroup)
            ->first();
    }

    // ***** CHECK HOW MANY GROUPES OF A SPECIFIC SAME SUBJECT AND GRADE
    public static function getNumGroups($idSubject,$idProfesseur){
        return Group::select('*')
            ->where('idSubject', $idSubject)
            ->where('idProfesseur', $idProfesseur)
            ->count();
    }

    // Only groups where a student have invoices
    public static function getGroupWithStudentInvoices($idStudent){
        return Group::select('groups.*')
            ->join('payment','payment.idGroup','=','groups.idGroup')
            ->whereNotNull('etat')
            ->where('idStudent',$idStudent)
            ->groupBy('groups.idGroup')
            ->get();
    }

    // Student Groups

    // ****** GET SUBJECTS OF EXISTED GROUPS ************ // 
    public static function existedGroupSubjects(){
        return Group::select('subjects.*')
            ->join('subjects', 'groups.idSubject', '=', 'subjects.idSubject')
            ->distinct('groups.idSubject')
            ->get();
    }

    public static function existedGroupCourseTypes(){
        return Group::select('coursetype.*')
            ->join('subjects', 'groups.idSubject', '=', 'subjects.idSubject')
            ->Join('coursetype', 'subjects.idCourseType', '=', 'coursetype.idCourseType')
            ->distinct()
            ->get();
    }


    
    public static function existedGroupGradesBySubject($idSubject)
    {
        return Group::select('grades.*', 'gradescategories.*')
            ->join('grades', 'groups.idGrade', '=', 'grades.idGrade')
            ->join('gradescategories', 'grades.idGradeCategory', '=', 'gradescategories.idGradeCategory')
            ->distinct('groups.idGrade')
            ->where('idSubject', $idSubject)
            ->get();
    }

    public static function selectGroupsBySubject($idSubject, $idStudent){
        return Group::select('groups.*', 'groupelements.created_at','groupelements.idStudent', 'professeurs.idProfesseur', 'professeurs.nom', 'professeurs.prenom')
            ->selectRaw('sum(CASE WHEN (idStudent = '.$idStudent.') THEN 1 ELSE 0 END) as response')
            ->join('professeurs', 'groups.idProfesseur', '=', 'professeurs.idProfesseur')
            ->leftJoin('groupelements', 'groups.idGroup', '=', 'groupelements.idGroup')
            ->where('groups.idSubject', $idSubject)
            ->groupBy('groups.idGroup')
            ->having('response', '=', 0)
            ->get();
    }
    // ------ Creation ----------- //
    public static function createGroup($designation, $capacity, $amount, $idSubject, $idProfesseur){
        return Group::insertGetId([
            'designation' => $designation,
            'capacity' => $capacity,
            'amount' => $amount,
            'idSubject' => $idSubject,
            'idProfesseur' => $idProfesseur,
            'CREATED_AT' => date('Y-m-d H:i:s'),
            'UPDATED_AT' => date('Y-m-d H:i:s')
        ]);
    }

    // --------- Update ------------- //
    public static function updateGroup($idGroup, $capacity, $amount, $idSubject, $idProfesseur){
        $group = Group::find($idGroup);
        $group->amount = $amount;
        $group->capacity = $capacity;
        $group->idSubject = $idSubject;
        $group->idProfesseur = $idProfesseur;
        $group->save();
    }

    public static function updateElements($idGroup){
        $nbElements = GroupElements::countGroupElements($idGroup);
        $group = Group::find($idGroup);
        $group->nbElements = $nbElements;
        $group->save();
    }

    // ---------- Deletion ----------- //
    public static function deleteGroup($idGroup) {
        Group::find($idGroup)->delete();
    }
    //----------- all Group---------------//    
    public static function selectGroup(){
        return Group::all();
    }
    // statistic des types groupes

    public static function StatisticTypesGroupes(){
        return Group::select('course')
            ->selectRaw('COUNT(groups.idGroup) as nbtypegroupes')
            ->rightJoin('subjects', 'groups.idSubject', '=', 'subjects.idSubject')
            ->rightJoin('coursetype', 'coursetype.idCourseType', '=', 'subjects.idCourseType')
            ->GROUPBY('subjects.idCourseType')
            ->get();
    }

        // --------------- Group ARCHIVE ------------------ //

    // Select deleted Group
    public static function softDeletedGroups(){
        return Group::onlyTrashed()
        ->select('groups.*', 'subjects.*', 'professeurs.*','courseType.*')
        ->join('professeurs', 'groups.idProfesseur', '=', 'professeurs.idProfesseur')
        ->join('subjects', 'groups.idSubject', '=', 'subjects.idSubject')
        ->join('courseType', 'courseType.idCourseType', '=', 'subjects.idCourseType')
        ->get();
    }

    public static function getDeletedGroups($idGroup){
        return Group::onlyTrashed()
        -> select('groups.*', 'subjects.*', 'professeurs.idProfesseur', 'professeurs.nom', 'professeurs.prenom')
        ->join('subjects', 'groups.idSubject', '=', 'subjects.idSubject')
        ->Join('coursetype', 'subjects.idCourseType', '=', 'coursetype.idCourseType')
        ->join('professeurs', 'groups.idProfesseur', '=', 'professeurs.idProfesseur')
        ->where('idGroup', $idGroup)
        ->first();
    }

    public static function restoreGroup($idGroup){
        Group::withTrashed()
            ->where('idGroup', $idGroup)
            ->restore();
    }

    public static function forceDeleteGroup($idGroup){
        Group::withTrashed()
            ->where('idGroup', $idGroup)
            ->forceDelete();
    }

}
