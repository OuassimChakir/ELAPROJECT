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
   protected $fillable = ['category', 'description', 'idCourseType'];

   public static function getGradeCategory($idGradeCategory){
      return GradesCategory::find($idGradeCategory);
   }

   public static function getGradeCategories(){
      return GradesCategory::select('*')->get();
   }

   public static function getGroupsGradeCatgories(){
      return GradesCategory::select('gradescategories.*')
         ->join('grades','grades.idGradeCategory','=','gradescategories.idGradeCategory')
         ->join('group_grades','group_grades.idGrade','=','grades.idGrade')
         ->groupBy('gradescategories.idGradeCategory')
         ->get();
   }

   public static function getGroupsGradeCatgoriesStudent($idStudent){
      return GradesCategory::select('gradescategories.*')
         ->join('grades','grades.idGradeCategory','=','gradescategories.idGradeCategory')
         ->join('group_grades','group_grades.idGrade','=','grades.idGrade')
         ->join('groupelements','groupelements.idGroup','=','group_grades.idGroup')
         ->where('idStudent',$idStudent)
         ->groupBy('gradescategories.idGradeCategory')
         ->get();
   }

   public static function getGroupsGradeCatgoriesProfesseur($idProfesseur){
      return GradesCategory::select('gradescategories.*')
         ->join('grades','grades.idGradeCategory','=','gradescategories.idGradeCategory')
         ->join('group_grades','group_grades.idGrade','=','grades.idGrade')
         ->join('groups','groups.idGroup','=','group_grades.idGroup')
         ->where('idProfesseur',$idProfesseur)
         ->groupBy('gradescategories.idGradeCategory')
         ->get();
   }
   // INSERT DATA (New Subject)
   public static function addGradeCategory($category,$description,$idCourseType){
      GradesCategory::create([
         'category' => $category,
         'description' => $description,
         'idCourseType' => $idCourseType,
      ]);
   }

   //    Update Subject
   public static function updateGradeCategory($idGradeCategory, $category){
      $gradeCategory = GradesCategory::find($idGradeCategory);
      $gradeCategory->category = $category;
      $gradeCategory->save();
   }

   //    Delete Subject
   public static function deleteGradeCategory($idGradeCategory){
      GradesCategory::find($idGradeCategory)->delete();
   }
}
