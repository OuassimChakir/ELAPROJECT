<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Stafftype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class StaffController extends Controller
{    // Staff Type Controller
    public function staff(Request $request){
        $Staf = new Staff();
        // List of Staff
        $Staff = $Staf->selectStaff();
        // Creating new Type
        $Stafftype = new Stafftype();
        // liste of Stafftype
        $stafft = $Stafftype->selectStaffType();
        // Creating new Type
       
        return view('pages.responsible.staff')->with(['Staff' => $Staff,'stafft' => $stafft]);
    }


}