<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Classrooms;
use App\Models\Attendance;
use App\Models\Expenses;
use App\Models\Courses\CourseType;
use App\Models\Courses\Subjects;
use App\Models\Grades\Grades;
use App\Models\Grades\GradesCategory;
use App\Models\Group;
use App\Models\Responsible\Staff;
use Illuminate\Support\Facades\Redirect;

class ExpenseController extends Controller
{
        //-------------- List of Expenses ---------------- //
        public function allExpenses(Request $request){
            $Expenses = new Expenses();
            // List of Expenses
            $expenses = $Expenses->selectExpenses();
            if($request->has('ajouterexpense')){
                $designation = $request->designation;
                $code = $request->code;
                $description = $request->description;
                $Expenses->createExpense($designation,$code,$description);
                return Redirect::back()->with('successMessage',"L'ajout est fait avec succès");
            }
            return view('pages.expense.typesDepenses')->with('expenses',$expenses);
            }
            // ---------------delete Expense------//
            public function deleteExpense(Request $request,$idExpense){
                $Expenses = new Expenses();
                $Expenses->deleteExpense($idExpense);
                $expenses = $Expenses->selectExpenses();
                return Redirect::route('expenses')
                    ->with('deleteMessage',"La suppression est faite avec succès")
                    ->with('expenses',$expenses);;
            }
            // ---------------Update Expense-----//
            public function updateExpense(Request $request,$idExpense){
                $Expenses = new Expenses();
                $expenses = $Expenses->selectExpenses($idExpense);
                if($request->has('updateExpenses')){ 
                    $Expenses->updateExpense($idExpense,$request->designation,$request->code,$request->description);
                    return Redirect::back()
                        ->with('updateMessage',"La Modification est faite avec succès")
                        ->with('expenses',$expenses);
                }
            }
        
        

}
