<?php

namespace App\Models\Grades;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grades extends Model
{
    use HasFactory;
    protected $table = "grades";
    protected $primaryKey = "idGrade";
    public $timestamps = false;

    public function getGrade($idGrade){
        return $this::find($idGrade);
       }

    public function getGradesByCategory($idGradeCategory){
        return $this::where('grades.idGradeCategory',$idGradeCategory)
                    ->join('gradescategories','grades.idGradeCategory','=','gradescategories.idGradeCategory')
                    ->orderBy('grade','ASC')
                    ->paginate(20)->withQueryString();
    }
    public function getGrades(){
        return $this::select('*')
            ->join('gradescategories','grades.idGradeCategory','=','gradescategories.idGradeCategory')
            ->paginate(20)->withQueryString();
    }

       // INSERT DATA (New Subject)
    public function addGrade($grade,$idGradeCategory){
        $this->grade = $grade;
        $this->idGradeCategory = $idGradeCategory;
        $this->save();
    }
    

    //    Update Subject
    public function updateGrade($idGrade,$grade,$idGradeCategory){
        $gradeClass = $this::find($idGrade);
        $gradeClass->grade = $grade;
        $gradeClass->idGradeCategory = $idGradeCategory;
        $gradeClass->save();
    }
    
    //    Delete Subject
    public function deleteGrade($idGrade){
        $this::find($idGrade)->delete();
    }
}
