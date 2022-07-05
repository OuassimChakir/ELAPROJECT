<?php

namespace App\Http\Controllers;

use App\Models\Courses\CourseType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SubjectController extends Controller
{
    // Course Type Controller
    public function courseType(Request $request){
        $courseType = new CourseType();
        // List of Courses
        $courses = $courseType->selectCourses();
        // Creating new Type
        if($request->has('ajouter')){
            $course = $request->course;
            $shortForm = $request->shortForm;
            $courseType->addType($course,$shortForm);
            $flag = 1;
            return Redirect::back()->with('successType',"L'ajout se fait avec succès");
        }

        // Deletion
        if($request->has('delete')){
            $idCourseType = $request->delete;
            $courseType ->deleteCourse($idCourseType);
            return Redirect::back()->with('deleteType',"La suppression est faite avec succès");
        }
        return view('pages.courses.courseType')->with(['courses' => $courses]);
    }

    // Subjects Controller
    public function subjects(){
        return view('pages.courses.subjects');
    }
}
