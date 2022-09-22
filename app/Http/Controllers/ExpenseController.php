<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expenses\Expenses;
use App\Models\Expenses\Facture;
use App\Models\Responsible\Staff;
use Illuminate\Support\Facades\Redirect;

class ExpenseController extends Controller
{
        //-------------- List of Expenses Types ---------------- //
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
                return Redirect::route('typeDepenses')
                    ->with('deleteMessage',"La suppression est faite avec succès")
                    ->with('expenses',$expenses);;
            }
            // ---------------Update Expense-----//
            public function updateExpense(Request $request,$idExpense){
                $Expenses = new Expenses();
                $expenses = $Expenses->selectExpenses();
                $updatedExpense = $Expenses->selectExpense($idExpense);
                if($request->has('updateExpense')){ 
                    $Expenses->updateExpense($idExpense,$request->designation,$request->code,$request->description);
                    return Redirect::route('typeDepenses')
                        ->with('updateMessage',"La Modification est faite avec succès")
                        ->with('expenses',$expenses);
                }
                return view('pages.expense.updateTypeDepense')
                        ->with('updatedExpense',$updatedExpense);
            }
        //-------------------Facture de dépenses----------------------//
            //-------------- List of Facture  ---------------- //
            public function allFacture(Request $request){
                $Facture = new Facture();
                $Expenses = new Expenses();
                // List of Expenses
                $expenses = $Expenses->selectExpenses();
                // list of facture
                $factureDepenses = $Facture->allFacture();
                if($request->has('addFacture')){
                    $datePayment = $request->datePayment;
                    $amout = $request->amout;
                    $description = $request->description;
                    $idStaff = $request->idStaff;
                    $idExpense = $request->idExpense;
                    $Facture->createFacture($datePayment,$amout,$description,$idStaff,$idExpense);
                    return Redirect::back()->with('successMessage',"L'ajout est fait avec succès");
                }
                return view('pages.expense.factures')
                      ->with('factureDepenses',$factureDepenses)
                      ->with('expenses',$expenses);
            }

            // ------------ Suppression du Facture --------- //
            public function deleteFacture($idExpensePayment){
                $Facture = new Facture();
                $Facture->deleteFacture($idExpensePayment);
                return Redirect::back()->with('deleteMessage',"La Suppression du Facture est faite avec succès");
            }

            public function getStaffData($idExpense){           
                $Expenses = new Expenses();
                $Staff = new Staff();
                $expense = $Expenses->selectExpense($idExpense);
                $data = '';
                if($expense->code == '000')
                    $data = $Staff->getProfesseurs();
                elseif($expense->code == '111')
                    $data = $Staff->getStaffs();
                $selectData['data'] = $data;
                return response()->json($selectData);  
            }
                // ----------- ARCHIVE ------------- //
            public function archive(){
                $Facture = new Facture();
                $factures = $Facture->softDeletedFactures();
                return view('pages.expense.FactureArchive')->with('factureDepenses',$factures);
            }

            public function restoreArchivedFacture($idExpensePayment){
                $Facture = new Facture();
                $Facture->restoreFacture($idExpensePayment);
                $factures = $Facture->softDeletedFacture();
                return Redirect::route('factures.archive')->with('restoreMessage',"Le Professeur a été restorer avec succès")->with('factures',$factures);
            }

            public function deleteArchivedFacture($idExpensePayment){
                $Facture = new Facture();
                $Facture->forceDeleteFacture($idExpensePayment);
                return Redirect::back()->with('deleteMessage',"Le Professeur a été supprimer Définitivement");
            }

            public function multipleArchivedFacture(Request $request){
                $Facture = new Facture();
                if($request->has('restoreAll')){
                foreach($request->archivedFacture as $idExpensePayment){
                $Facture->restoreFacture($idExpensePayment);
                }
                return Redirect::back()->with('restoreMessage',"Les Professeurs séléctionés ont été restorer avec succès");
                }
                if($request->has('deleteAll')){
                foreach($request->archivedFacture as $idExpensePayment){
                $Facture->forceDeleteFacture($idExpensePayment);
                }
                return Redirect::back()->with('deleteMessage',"Les Professeurs séléctionés ont été supprimer Définitivement");
                }
            }
}
