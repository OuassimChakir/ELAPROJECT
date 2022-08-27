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
            return Redirect::back()->with('successMessage',"L'ajout est fait avec succès");
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
            return Redirect::back()->with('deleteMessage',"La suppression est faite avec succès");
        }

        if($request->action == 'update'){
            // Update of Course Type (ACTION)
            if($request->has('update')){
                $courseType->updateCourse($request->idCourseType,$request->course,$request->shortForm);
                return Redirect::route('courseType')->with('updateMessage',"La Modification est faite avec succès");
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
    public function subjects(Request $request){
        $courseType = new CourseType();
        $subjectsClass = new Subjects();
        
        // Adding new Subject
        if($request->has('ajouterSubject')){
            $libelle = $request->libelle;
            $idCourseType = $request->courseType;
            $subjectsClass->addSubject($libelle,$request->short,$idCourseType);
            return Redirect::back()->with('successMessage',"L'ajout est fait avec succès");
        }
        $subjects = $subjectsClass->getSubjects();
        $courses = $courseType->selectCourses();
        return view('pages.courses.subjects')
            ->with('subjects',$subjects)
            ->with('courses',$courses);
    }

        // Subjects Deletion or Update
        public function actionSubject(Request $request,$action,$idSubject){
            $subjectsClass = new Subjects();
            $courseType = new CourseType();
            // List of Courses
            $courses = $courseType->selectCourses();

            // List of Subjects
            $subjects = $subjectsClass->getSubjects();
    
            // Deletion of Subject
            if($request->action == 'delete'){
                $subjectsClass ->deleteSubject($idSubject);
                return Redirect::back()->with('deleteMessage',"La suppression est faite avec succès");
            }
    
            if($request->action == 'update'){
                // Update of Subject (ACTION)
                if($request->has('update')){
                    $subjectsClass->updateSubject($request->idSubject,$request->libelle,$request->short,$request->courseType);
                    return Redirect::route('subjects')->with('updateMessage',"La Modification est faite avec succès");
                }
                // Update of Subject (PAGE)
                $updatedSubject = $subjectsClass->getSubject($idSubject);
                return view('pages.courses.subjects')
                    ->with('subjects', $subjects)
                    ->with('updatedSubject', $updatedSubject)
                    ->with('courses',$courses);
            }
            
        }
}
