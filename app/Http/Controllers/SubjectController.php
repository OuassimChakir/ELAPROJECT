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
        // List of Courses
        $courses = CourseType::selectCourses();
        // Creating new Type
        if ($request->has('ajouter')) {
            $course = $request->course;
            $shortForm = $request->shortForm;
            CourseType::addType($course, $shortForm);
            return Redirect::back()->with('successMessage', "L'ajout est fait avec succès");
        }
        return view('pages.courses.courseType')->with(['courses' => $courses]);
    }

    // Course Type Deletion or Update
    public function updateCourseType(Request $request, $idCourseType){
        // List of Courses
        $courses = CourseType::selectCourses();
        // Update of Course Type (ACTION)
        if ($request->has('update')) {
            CourseType::updateCourse($request->idCourseType, $request->course, $request->shortForm);
            return Redirect::route('courseType')->with('updateMessage', "La Modification est faite avec succès");
        }
        // Update of Course Type (PAGE)
        $updatedCourse = CourseType::selectCourse($idCourseType);
        return view('pages.courses.courseType')
            ->with('courses', $courses)
            ->with('courseInfo', $updatedCourse);
    }

    public function deleteCourseType($idCourseType){
        CourseType::deleteCourse($idCourseType);
        return Redirect::back()->with('deleteMessage', "La suppression est faite avec succès");
    }

    //----------------- Subjects ---------------- //
    // Subjects Controller
    public function subjects(Request $request){
        // Adding new Subject
        if ($request->has('ajouterSubject')) {
            Subjects::addSubject($request->libelle, $request->courseType);
            return Redirect::back()->with('successMessage', "L'ajout est fait avec succès");
        }
        $subjects = Subjects::getSubjects();
        $courses = CourseType::selectCourses();
        return view('pages.courses.subjects')
            ->with('subjects', $subjects)
            ->with('courses', $courses);
    }

    // Subjects Deletion or Update
    public function updateSubject(Request $request, $idSubject){
        // List of Courses
        $courses = CourseType::selectCourses();
        // List of Subjects
        $subjects = Subjects::getSubjects();
        // Update of Subject (ACTION)
        if ($request->has('update')) {
            Subjects::updateSubject($request->idSubject, $request->libelle, $request->courseType);
            return Redirect::route('subjects')->with('updateMessage', "La Modification est faite avec succès");
        }
        // Update of Subject (PAGE)
        $updatedSubject = Subjects::getSubject($idSubject);
        return view('pages.courses.subjects')
            ->with('subjects', $subjects)
            ->with('updatedSubject', $updatedSubject)
            ->with('courses', $courses);
    }
    public function deleteSubject($idSubject){
            Subjects::deleteSubject($idSubject);
            return Redirect::back()->with('deleteMessage', "La suppression est faite avec succès");
        
    }
}
