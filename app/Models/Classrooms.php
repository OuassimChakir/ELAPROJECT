<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classrooms extends Model
{
    use HasFactory;
    protected $table = "classrooms";
    
    public function add2Class($idGroup,$matricule){
        $this->matricule = $matricule;
        $this->idGroup = $idGroup;
        $this->save();
    }

    public function checkClassroom($idGroup,$matricule){
        return $this->where('idGroup',$idGroup)
                    ->where('matricule',$matricule)
                    ->count();
    }

    // SELECT GROUPS OF A STUDENT
    public function studentClassrooms($matricule){
        return $this::select('classrooms.*','groups.*','staff.nom','staff.prenom')
            ->join('groups','groups.idGroup','=','classrooms.idGroup')
            ->join('staff','staff.idStaff','=','groups.idStaff')
            ->where('classrooms.matricule',$matricule)
            ->get();
    }

    // Select ALL STUDENTS OF A SPECIFIC GROUP
    public function groupClassroom($idGroup){
        return $this::select('students.*','classrooms.*')
            ->join('students','students.matricule','=','classrooms.matricule')
            ->where('classrooms.idGroup',$idGroup)
            ->get();
    }

    public function classroomElements($idGroup){
        return $this::select('*')
            ->where('idGroup',$idGroup)
            ->count();
    }

    // Remove Student from Group
    public function cancelAssignment($id){
        return $this::find($id)->delete();
    }

    // Get Assignment
    public function getAssignment($id){
        return $this::select('*')
            ->join('groups','classrooms.idGroup','=','groups.idGroup')
            ->join('students','classrooms.matricule','=','students.matricule')
            ->where('id',$id)
            ->first();
    }
}
