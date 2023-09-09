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

   // INSERT DATA (New Subject)
   public static function addGradeCategory($category){
      GradesCategory::create([
         'category' => $category,
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
