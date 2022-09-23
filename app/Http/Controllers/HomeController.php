<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\responsible\Student;
use App\Models\Group;
use App\Models\Incomes\Payment;
use App\Models\Expenses\Facture;


class HomeController extends Controller
{
    public function index(){
        $student=new Student();
        $Group=new Group();
        $Payment=new Payment();
        $Facture=new Facture();
        $students=$student->totalStudents(); 
        $NumGroups=$Group->totalGroups(); 
        $Payments=$Payment->totalAmount(); 
        $Factures=$Facture->totalAmountExpense();  
        return view('home')->with('students',$students)
                           ->with('NumGroups',$NumGroups)
                           ->with('Payments',$Payments)
                           ->with('Factures',$Factures);
    }
     

}
