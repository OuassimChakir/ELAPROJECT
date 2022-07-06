<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Stafftype;
use App\Models\Subjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class StaffController extends Controller
{    // Staff Type Controller
    public function staff(Request $request){
        $Staf = new Staff();
        // List of Staff
        $Staff = $Staf->selectStaff();
        // Creating new staffType
        $Stafftype = new Stafftype();
        // select of Stafftype
        $stafft = $Stafftype->selectStaffType();
        // Creating new Subjects
        $Subjects = new Subjects();
        // select of Stafftype
        $subjects = $Subjects->selectSubjects();
       
        return view('pages.responsible.staff')->with(['Staff' => $Staff,
                                                      'stafft' => $stafft,
                                                      'subjects'=>$subjects,]);
    }


}