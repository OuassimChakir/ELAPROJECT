<?php

namespace App\Http\Controllers;

use App\Models\Courses\CourseType;
use App\Models\Grades\Grades;
use App\Models\Grades\GradesCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class GradesController extends Controller
{
    public function grades(){
        return view('pages.grades.grades');
    }

    public function gradesCategory(Request $request){
        $gradesCategory = new GradesCategory();
        $courseType = new CourseType();
        $courses = $courseType->selectCourses();
        $gCategories = $gradesCategory -> getGradeCategories();

        // Add new Grade
        if($request->has('addGrade')){
            $gradesCategory->addGradeCategory($request->category,$request->description,$request->courseType);
            return Redirect::back()->with('successType',"L'ajout est fait avec succès");
        }
        return view('pages.grades.gradesCategory')
            ->with('courses',$courses)
            ->with('gCategories',$gCategories);
    }
        // Course Type Deletion or Update
        public function actionGradeCategory(Request $request,$action,$idGradeCategory){
            $gradesCategory = new GradesCategory();
            $courseType = new CourseType();
            // List of Course Types
            $courses = $courseType->selectCourses();
            // List of Grade Categories
            $gCategories = $gradesCategory -> getGradeCategories();

            // Deletion of GradeCategory
            if($request->action == 'delete'){
                $gradesCategory ->deleteGradeCategory($idGradeCategory);
                return Redirect::back()->with('deleteType',"La suppression est faite avec succès");
            }
    
            if($request->action == 'update'){
                // Update GradeCategory (ACTION)
                if($request->has('update')){
                    $gradesCategory->updateGradeCategory($request->idGradeCategory,$request->category,$request->description,$request->courseType);
                    return Redirect::route('gradesCategory')->with('updateCategory',"La Modification est faite avec succès");
                }
                // Update GradeCategory (PAGE)
                $updatedCategory = $gradesCategory->getGradeCategory($idGradeCategory);
                return view('pages.grades.gradesCategory')
                    ->with('courses', $courses)
                    ->with('gCategories',$gCategories)
                    ->with('updatedCategory', $updatedCategory);
            }
            
        }
}
