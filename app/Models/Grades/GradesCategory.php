<?php

namespace App\Models\Grades;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradesCategory extends Model
{
    use HasFactory;
    protected $table = "gradescategories";
    protected $primaryKey = "idGradeCategory";
    public $timestamps = false;

       public function getGradeCategory($idGradeCategory){
        return $this::find($idGradeCategory);
       }

       public function getGradeCategories(){
        return $this::select('*')
            ->join('coursetype','gradescategories.idCourseType','=','coursetype.idCourseType')
            ->get();
       }

       // INSERT DATA (New Subject)
       public function addGradeCategory($category,$description,$idCourseType){
        $this->category = $category;
        $this->description = $description;
        $this->idCourseType = $idCourseType;
        $this->save();
       }

    //    Update Subject
       public function updateSubject($idGradeCategory,$category,$idCourseType){
        $gradeCategory = $this::find($idGradeCategory);
        $gradeCategory->category = $category;
        $gradeCategory->idCourseType = $idCourseType;
        $gradeCategory->save();
       }
    
    //    Delete Subject
       public function deleteSubject($idGradeCategory){
        $this::find($idGradeCategory)->delete();
       }
}
