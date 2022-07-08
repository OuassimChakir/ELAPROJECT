<?php

namespace App\Http\Controllers;

use App\Models\Courses\CourseType;
use App\Models\Courses\Subjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SubjectController extends Controller
{
    //----------------- Course Type ---------------- //
    public function courseType(Request $request){
        $courseType = new CourseType();
        // List of Courses
        $courses = $courseType->selectCourses();
        // Creating new Type
        if($request->has('ajouter')){
            $course = $request->course;
            $shortForm = $request->shortForm;
            $courseType->addType($course,$shortForm);
            return Redirect::back()->with('successType',"L'ajout se fait avec succès");
        }


        return view('pages.courses.courseType')->with(['courses' => $courses]);
    }

    // Course Type Deletion or Update
    public function actionCourseType(Request $request,$action,$idCourseType){
        $courseType = new CourseType();
        // List of Courses
        $courses = $courseType->selectCourses();

        // Deletion
        if($request->action == 'delete'){
            $courseType ->deleteCourse($idCourseType);
            return Redirect::back()->with('deleteType',"La suppression est faite avec succès");
        }

        if($request->action == 'update'){
            // Update of Course Type (ACTION)
            if($request->has('update')){
                $courseType->updateCourse($request->idCourseType,$request->course,$request->shortForm);
                return Redirect::route('courseType')->with('updateType',"La Modification est faite avec succès");
            }
            // Update of Course Type (PAGE)
            $updatedCourse = $courseType->selectCourse($idCourseType);
            return view('pages.courses.courseType')
                ->with('courses', $courses)
                ->with('courseInfo', $updatedCourse);
        }
        
    }

    //----------------- Subjects ---------------- //
    // Subjects Controller
    public function subjects(){
        $courseType = new CourseType();
        $subjectsClass = new Subjects();
        $subjects = $subjectsClass->getSubjects();
        $courses = $courseType->selectCourses();
        return view('pages.courses.subjects')
            ->with('subjects',$subjects)
            ->with('courses',$courses);
    }
}
