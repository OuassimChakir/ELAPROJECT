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
}
