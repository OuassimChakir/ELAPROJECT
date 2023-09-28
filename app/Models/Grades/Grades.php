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
    protected $fillable = ['grade', 'idGradeCategory'];

    public static function getGrade($idGrade){
        return Grades::select('*')
            ->join('gradescategories', 'grades.idGradeCategory', '=', 'gradescategories.idGradeCategory')
            ->where('grades.idGrade', $idGrade)
            ->first();
    }

    public static function getGradesByCategory($idGradeCategory){
        return Grades::where('grades.idGradeCategory', $idGradeCategory)
            ->join('gradescategories', 'grades.idGradeCategory', '=', 'gradescategories.idGradeCategory')
            ->orderBy('grade', 'ASC')
            ->paginate(20)->withQueryString();
    }
    public static function selectGradesByCategory($idGradeCategory){
        return Grades::select('*')
            ->join('gradescategories', 'grades.idGradeCategory', '=', 'gradescategories.idGradeCategory')
            ->where('grades.idGradeCategory', $idGradeCategory)
            ->orderBy('grade', 'ASC')
            ->get();
    }
    public static function getGrades(){
        return Grades::select('*')
            ->join('gradescategories', 'grades.idGradeCategory', '=', 'gradescategories.idGradeCategory')
            ->paginate(20)->withQueryString();
    }


    // INSERT DATA (New Subject)
    public static function addGrade($grade, $idGradeCategory){
        Grades::create([
            'grade' => $grade,
            'idGradeCategory' => $idGradeCategory
        ]);
    }
    //    Update Subject
    public static function updateGrade($idGrade, $grade, $idGradeCategory){
        $gradeClass = Grades::find($idGrade);
        $gradeClass->grade = $grade;
        $gradeClass->idGradeCategory = $idGradeCategory;
        $gradeClass->save();
    }
    //    Delete Subject
    public static function deleteGrade($idGrade){
        Grades::find($idGrade)->delete();
    }
}
