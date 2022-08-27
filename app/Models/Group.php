<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $table = "groups";
    protected $primaryKey = "idGroup";

    // ------- Selections ----------- //

        // ***** Select Groupes ******* //
        public function getGroups(){
            return $this::select('groups.*','subjects.*','grades.*','coursetype.*','staff.idStaff','staff.nom','staff.prenom')
                ->join('subjects','groups.idSubject','=','subjects.idSubject')
                ->Join('coursetype','subjects.idCourseType','=','coursetype.idCourseType')
                ->leftJoin('grades','groups.idGrade','=','grades.idGrade')
                ->join('staff','groups.idStaff','=','staff.idStaff')
                ->get();
        }

        // ***** Select a Specific Group ******* ///
        public function getGroup($idGroup){
            return $this::select('groups.*','subjects.*','grades.*','staff.idStaff','staff.nom','staff.prenom')
                ->join('subjects','groups.idSubject','=','subjects.idSubject')
                ->Join('coursetype','subjects.idCourseType','=','coursetype.idCourseType')
                ->leftJoin('grades','groups.idGrade','=','grades.idGrade')
                ->join('staff','groups.idStaff','=','staff.idStaff')
                ->where('idGroup',$idGroup)
                ->first();
        }

        // ***** CHECK HOW MANY GROUPES OF A SPECIFIC SAME SUBJECT AND GRADE
        public function getNumGroups($idSubject,$idGrade){
            return $this::select('*')
                ->where('idSubject',$idSubject)
                ->where('idGrade',$idGrade)
                ->count();
        }

        // ****** GET SUBJECTS OF EXISTED GROUPS ************ // 
        public function existedGroupSubjects(){
            return $this::select('subjects.*')
                ->join('subjects','groups.idSubject','=','subjects.idSubject')
                ->distinct('groups.idSubject')
                ->get();
        }

        public function existedGroupCourseTypes(){
            return $this::select('coursetype.*')
                ->join('subjects','groups.idSubject','=','subjects.idSubject')
                ->Join('coursetype','subjects.idCourseType','=','coursetype.idCourseType')
                ->distinct()
                ->get();
        }

        public function existedGroupGradesBySubject($idSubject){
            return $this::select('grades.*','gradescategories.*')
                        ->join('grades','groups.idGrade','=','grades.idGrade')
                        ->join('gradescategories','grades.idGradeCategory','=','gradescategories.idGradeCategory')
                        ->distinct('groups.idGrade')
                        ->where('idSubject',$idSubject)
                        ->get();
        }

        public function selectGroupsBySubjectAndGrade($idSubject,$idGrade,$matricule){
            return $this::select('groups.*','classrooms.matricule','classrooms.id','staff.idStaff','staff.nom','staff.prenom')
            ->selectRaw('count(classrooms.idGroup) as nbElement')
            ->join('staff','groups.idStaff','=','staff.idStaff')
            ->leftJoin('classrooms','groups.idGroup','=','classrooms.idGroup')
            ->where('groups.idSubject',$idSubject)
            ->where('groups.idGrade',$idGrade)
            ->groupBy('groups.idGroup')
            ->having('matricule','!=',$matricule)
            ->orHavingRaw('id IS NULL')
            ->get();
        }
    // ------ Creation ----------- //
        public function createGroup($designation,$capacity,$idSubject,$idGrade,$idStaff){
            $this->designation = $designation;
            $this->capacity = $capacity;
            $this->idSubject = $idSubject;
            $this->idGrade = $idGrade;
            $this->idStaff = $idStaff;
            $this->save();
        }

    // --------- Update ------------- //
        public function updateGroup($idGroup,$designation,$capacity,$idSubject,$idGrade,$idStaff){
            $group = $this::find($idGroup);
            $group->designation = $designation;
            $group->capacity = $capacity;
            $group->idSubject = $idSubject;
            $group->idGrade = $idGrade;
            $group->idStaff = $idStaff;
            $group->save();
        }

    // ---------- Deletion ----------- //
        public function deleteGroup($idGroup){
            $this::find($idGroup)->delete();
        }
}
