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
            
            public function actionExpense(Request $request,$action,$idExpense){
                $Expenses = new Expenses();
                // List of Expense
                $expenses = $Expenses->selectExpense();
        
                // Deletion Expense
                if($request->action == 'deleteExpense'){
                    $Expenses ->deleteExpense($idExpense);
                    return Redirect::back()->with('deleteMessage',"La suppression est faite avec succès");
                }
        
                if($request->action == 'update'){
                    // Update of Expense Type (ACTION)
                    if($request->has('update')){
                        $Expenses->updateExpense($request->idExpense,$request->designation,$request->code,$request->description);
                        return Redirect::route('Expenses')->with('updateMessage',"La Modification est faite avec succès");
                    }
                    // Update of Expense Type (PAGE)
                    $updatedexpenses = $Expenses->selectExpense($idExpense);
                    return view('pages.expense.typesDepenses')
                        ->with('expenses', $expenses)
                        ->with('updatedexpenses', $updatedexpenses);
                }
                
            }
}
