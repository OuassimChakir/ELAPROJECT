<?php

namespace App\Models\Courses;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseType extends Model
{
    use HasFactory;
    protected $table = "coursetype"; 
    protected $primaryKey = "idCourseType";
    public $timestamps = false;
    protected $fillable = ['course','shortForm'];

    // Adding a new Course Type
    public static function addType($course,$shortForm){
        CourseType::create([
            'course' => $course,
            'shortForm' => $shortForm
        ]);
    }

    // Select all Course Types
    public static function selectCourses(){
        return CourseType::all();
    }

    // Select One Course Type
    public static function selectCourse($idCourseType){
        return CourseType::find($idCourseType);
    }

    // Update Course Type
    public static function updateCourse($idCourseType,$course,$shortForm){
        $courseType = CourseType::find($idCourseType);
        $courseType->course = $course;
        $courseType->shortForm = $shortForm;
        $courseType->save();
    }

    // Delete Course Type
    public static function deleteCourse($id){
        CourseType::find($id)->delete();
    }


}
