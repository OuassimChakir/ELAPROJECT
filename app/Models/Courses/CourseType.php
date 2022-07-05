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

    // Delete Course Type
    public function deleteCourse($id){
        $this::find($id)->delete();
    }
}
