<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Courses\CourseType;
use App\Models\Grades\Grades;
use App\Models\Grades\GradesCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class GradesController extends Controller
{
    // ------------- Grades ----------------- //
    public function grades(Request $request){
        $gradeCategories = GradesCategory::getGradeCategories();
        $gradesTable = Grades::getGrades();
        $flag = 0;
        if ($request->has('idGradeCategory')) {
            $gradesTable = Grades::getGradesByCategory($request->idGradeCategory);
            $flag = 1;
        }
        // Add new Grade
        if ($request->has('addGrade')) {
            $gradesArray = array();
            $idGradeCategory = $request->gradeCategory;
            for ($i = 0; $i < count($request->grade); $i++) {
                $gradesArray[] = array('grade' => $request->grade[$i], 'idGradeCategory' => $idGradeCategory);
            }
            Grades::insert($gradesArray);
            return Redirect::back()->with('successMessage', "L'ajout est fait avec succès");
        }
        return view('pages.grades.grades')
            ->with('grades', $gradesTable)
            ->with('flag', $flag)
            ->with('gradeCategories', $gradeCategories);
    }
    // Grade Deletion or Update
    public function updateGrade(Request $request, $idGrade){
        // List of Grade Categories
        $gCategories = GradesCategory::getGradeCategories();
        // List of Grades
        $gradesTable = Grades::getGrades();
        // Update GradeCategory (ACTION)
        if ($request->has('update')) {
            Grades::updateGrade($request->idGrade, $request->grade, $request->gradeCategory);
            return Redirect::route('grades')->with('updateGrade', "La Modification est faite avec succès");
        }
        // Update GradeCategory (PAGE)
        $updatedGrade = Grades::getGrade($idGrade);
        return view('pages.grades.grades')
            ->with('grades', $gradesTable)
            ->with('gradeCategories', $gCategories)
            ->with('updatedGrade', $updatedGrade);
    }

    public function deleteGrade($idGrade)
    {
        Grades::deleteGrade($idGrade);
        return Redirect::back()->with('deleteMessage', "La suppression est faite avec succès");
    }
    // ------------- Grade Category ----------------- //
    public function gradesCategory(Request $request){
        $courses =CourseType::selectCourses();
        $gCategories = GradesCategory::getGradeCategories();
        // Add new Grade
        if ($request->has('addGrade')) {
            GradesCategory::addGradeCategory($request->category);
            return Redirect::back()->with('successMessage', "L'ajout est fait avec succès");
        }
        return view('pages.grades.gradesCategory')
            ->with('courses', $courses)
            ->with('gCategories', $gCategories);
    }
    // Grade Category Deletion or Update
    public function updateGradeCategory(Request $request, $idGradeCategory){
        // List of Course Types
        $courses = CourseType::selectCourses();
        // List of Grade Categories
        $gCategories = GradesCategory::getGradeCategories();
        // Update GradeCategory (ACTION)
        if ($request->has('update')) {
            GradesCategory::updateGradeCategory($request->idGradeCategory, $request->category);
            return Redirect::route('gradesCategory')->with('updateCategory', "La Modification est faite avec succès");
        }
        // Update GradeCategory (PAGE)
        $updatedCategory = GradesCategory::getGradeCategory($idGradeCategory);
        return view('pages.grades.gradesCategory')
            ->with('courses', $courses)
            ->with('gCategories', $gCategories)
            ->with('updatedCategory', $updatedCategory);
    }

    public function deleteGradeCategory($idGradeCategory){
        GradesCategory::deleteGradeCategory($idGradeCategory);
        return Redirect::back()->with('deleteMessage', "La suppression est faite avec succès");
    }
}
