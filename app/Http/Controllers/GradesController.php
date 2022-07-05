<?php

namespace App\Http\Controllers;

use App\Models\Grades\Grades;
use App\Models\Grades\GradesCategory;
use Illuminate\Http\Request;

class GradesController extends Controller
{
    public function grades(){
        return view('pages.grades.grades');
    }

    public function gradesCategory(){
        return view('pages.grades.gradesCategory');
    }
}
