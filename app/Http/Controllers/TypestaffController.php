<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stafftype;

class TypestaffController extends Controller
{
    public function StaffType(Request $request){
        $Stafftype = new Stafftype();
        // liste of Stafftype
        $stafft = $Stafftype->selectStaffType();
        // Creating new Type
       
        return view('pages.responsible.add_staff')->with(['stafft' => $stafft]);
    

}
}
