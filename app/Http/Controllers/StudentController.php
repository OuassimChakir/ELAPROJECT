<?php

namespace App\Http\Controllers;
use App\Models\responsible\Staff;
use App\Models\responsible\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function Student(Request $request){
        $Student = new Student();
        // List of Staff
        $student = $Student->selectStudent();
  
        return view('pages.responsible.student')->with(['student' => $student,
                                                     ]);
    }
}
