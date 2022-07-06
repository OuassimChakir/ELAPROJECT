<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class StaffController extends Controller
{    // Staff Type Controller
    public function staff(Request $request){
        $Staf = new Staff();
        // List of Staff
        $Staff = $Staf->selectStaff();
        // Creating new Type
       
        return view('pages.responsible.staff')->with(['Staff' => $Staff]);
    }

}
