<?php

namespace App\Http\Controllers;

use App\Models\Courses\CourseType;
use App\Models\Grades\Grades;
use App\Models\Grades\GradesCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class GradesController extends Controller
{
    // ------------- Grades ----------------- //
    public function grades(Request $request){
        $gradesCategory = new GradesCategory();
        $gradeCategories = $gradesCategory -> getGradeCategories();
        $grades = new Grades();
        $gradesTable = $grades->getGrades();
        $flag = 0;
        if($request->has('idGradeCategory')){
            $gradesTable = $grades->getGradesByCategory($request->idGradeCategory);
            $flag = 1;
        }
        // Add new Grade
        if($request->has('addGrade')){
            $gradesArray = array();
            $idGradeCategory = $request->gradeCategory;
            for ($i=0; $i < count($request->grade); $i++) {
                $gradesArray[] = array('grade' => $request->grade[$i], 'idGradeCategory' => $idGradeCategory);
            }
            Grades::insert($gradesArray);
            return Redirect::back()->with('successMessage',"L'ajout est fait avec succès");
        }
        return view('pages.grades.grades')
            ->with('grades',$gradesTable)
            ->with('flag',$flag)
            ->with('gradeCategories',$gradeCategories);
    }
    // Grade Deletion or Update
    public function actionGrade(Request $request,$action,$idGrade){
        $gradesCategory = new GradesCategory();
        $grades = new Grades();
        // List of Grade Categories
        $gCategories = $gradesCategory -> getGradeCategories();

        // List of Grades
        $gradesTable = $grades->getGrades();

        // Deletion of GradeCategory
        if($request->action == 'delete'){
            $grades ->deleteGrade($idGrade);
            return Redirect::back()->with('deleteMessage',"La suppression est faite avec succès");
        }

        if($request->action == 'update'){
            // Update GradeCategory (ACTION)
            if($request->has('update')){
                $grades->updateGrade($request->idGrade,$request->grade,$request->gradeCategory);
                return Redirect::route('grades')->with('updateGrade',"La Modification est faite avec succès");
            }
            // Update GradeCategory (PAGE)
            $updatedGrade = $grades->getGrade($idGrade);
            return view('pages.grades.grades')
                ->with('grades', $gradesTable)
                ->with('gradeCategories',$gCategories)
                ->with('updatedGrade', $updatedGrade);
        }
        
    }

    // ------------- Grade Category ----------------- //
    public function gradesCategory(Request $request){
        $gradesCategory = new GradesCategory();
        $courseType = new CourseType();
        $courses = $courseType->selectCourses();
        $gCategories = $gradesCategory -> getGradeCategories();

        // Add new Grade
        if($request->has('addGrade')){
            $gradesCategory->addGradeCategory($request->category,$request->description,$request->courseType);
            return Redirect::back()->with('successMessage',"L'ajout est fait avec succès");
        }
        return view('pages.grades.gradesCategory')
            ->with('courses',$courses)
            ->with('gCategories',$gCategories);
    }
        // Grade Category Deletion or Update
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
                return Redirect::back()->with('deleteMessage',"La suppression est faite avec succès");
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
