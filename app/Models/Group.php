<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $table = "groups";
    protected $primaryKey = "idGroup";
    protected $fillable = ['designation', 'capacity', 'idSubject', 'idGrade', 'idStaff', 'CREATED_AT', 'UPDATED_AT'];

    // ------- Selections ----------- //
    public static function totalGroups()
    {
        return Group::select()->get()->count();
    }

    // ***** Select Groupes ******* //
    public static function getGroups()
    {
        return Group::select('groups.*', 'subjects.*', 'grades.*', 'coursetype.*', 'staff.idStaff', 'staff.nom', 'staff.prenom')
            ->join('subjects', 'groups.idSubject', '=', 'subjects.idSubject')
            ->Join('coursetype', 'subjects.idCourseType', '=', 'coursetype.idCourseType')
            ->leftJoin('grades', 'groups.idGrade', '=', 'grades.idGrade')
            ->join('staff', 'groups.idStaff', '=', 'staff.idStaff')
            ->get();
    }

    // ***** Select a Specific Group ******* //
    public static function getGroup($idGroup)
    {
        return Group::select('groups.*', 'subjects.*', 'grades.*', 'staff.idStaff', 'staff.nom', 'staff.prenom')
            ->join('subjects', 'groups.idSubject', '=', 'subjects.idSubject')
            ->Join('coursetype', 'subjects.idCourseType', '=', 'coursetype.idCourseType')
            ->leftJoin('grades', 'groups.idGrade', '=', 'grades.idGrade')
            ->join('staff', 'groups.idStaff', '=', 'staff.idStaff')
            ->where('idGroup', $idGroup)
            ->first();
    }

    // ***** CHECK HOW MANY GROUPES OF A SPECIFIC SAME SUBJECT AND GRADE
    public static function getNumGroups($idSubject, $idGrade)
    {
        return Group::select('*')
            ->where('idSubject', $idSubject)
            ->where('idGrade', $idGrade)
            ->count();
    }

    // ****** GET SUBJECTS OF EXISTED GROUPS ************ // 
    public static function existedGroupSubjects()
    {
        return Group::select('subjects.*')
            ->join('subjects', 'groups.idSubject', '=', 'subjects.idSubject')
            ->distinct('groups.idSubject')
            ->get();
    }

    public static function existedGroupCourseTypes()
    {
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

    public static function selectGroupsBySubjectAndGrade($idSubject, $idGrade, $matricule)
    {
        return Group::select('groups.*', 'classrooms.idStudent', 'classrooms.id', 'staff.idStaff', 'staff.nom', 'staff.prenom')
            ->selectRaw('count(classrooms.idGroup) as nbElement')
            ->join('staff', 'groups.idStaff', '=', 'staff.idStaff')
            ->leftJoin('classrooms', 'groups.idGroup', '=', 'classrooms.idGroup')
            ->where('groups.idSubject', $idSubject)
            ->where('groups.idGrade', $idGrade)
            ->groupBy('groups.idGroup')
            ->having('matricule', '!=', $matricule)
            ->orHavingRaw('id IS NULL')
            ->get();
    }
    // ------ Creation ----------- //
    public static function createGroup($designation, $capacity, $idSubject, $idGrade, $idStaff)
    {
        Group::create([
            'designation' => $designation,
            'capacity' => $capacity,
            'idSubject' => $idSubject,
            'idGrade' => $idGrade,
            'idStaff' => $idStaff,
            'CREATED_AT' => date('Y-m-d H:i:s'),
            'UPDATED_AT' => date('Y-m-d H:i:s')
        ]);
    }

    // --------- Update ------------- //
    public static function updateGroup($idGroup, $designation, $capacity, $idSubject, $idGrade, $idStaff)
    {
        $group = Group::find($idGroup);
        $group->designation = $designation;
        $group->capacity = $capacity;
        $group->idSubject = $idSubject;
        $group->idGrade = $idGrade;
        $group->idStaff = $idStaff;
        $group->save();
    }

    // ---------- Deletion ----------- //
    public static function deleteGroup($idGroup)
    {
        Group::find($idGroup)->delete();
    }
    //----------- all Group---------------//    
    public static function selectGroup()
    {
        return Group::all();
    }
    // statistic des types groupes

    public static function StatisticTypesGroupes()
    {
        return Group::select('course')
            ->selectRaw('COUNT(groups.idGroup) as nbtypegroupes')
            ->rightJoin('subjects', 'groups.idSubject', '=', 'subjects.idSubject')
            ->rightJoin('coursetype', 'coursetype.idCourseType', '=', 'subjects.idCourseType')
            ->GROUPBY('subjects.idCourseType')
            ->get();
    }
}
