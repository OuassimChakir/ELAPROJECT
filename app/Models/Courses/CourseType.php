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

    // Adding a new Course Type
    public function addType($course,$shortForm){
        $this->course = $course;
        $this->shortForm = $shortForm;
        $this->save();
    }

    // Select all Course Types
    public function selectCourses(){
        return $this::all();
    }

    // Select One Course Type
    public function selectCourse($idCourseType){
        return $this::find($idCourseType);
    }

    // Update Course Type
    public function updateCourse($idCourseType,$course,$shortForm){
        $courseType = $this::find($idCourseType);
        $courseType->course = $course;
        $courseType->shortForm = $shortForm;
        $courseType->save();
    }

    // Delete Course Type
    public function deleteCourse($id){
        $this::find($id)->delete();
    }


}
