<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use Illuminate\Http\Request;
use App\Models\Expenses\Expenses;
use App\Models\Expenses\Facture;
use App\Models\Responsible\Staff;
use Illuminate\Support\Facades\Redirect;

class ExpenseController extends Controller
{
    //-------------- List of Expenses Types ---------------- //
    public function allExpenses(Request $request)
    {
        // List of Expenses
        $expenses = Expenses::selectExpenses();
        if ($request->has('ajouterexpense')) {
            $designation = $request->designation;
            $code = $request->code;
            $description = $request->description;
            Expenses::createExpense($designation, $code, $description);
            // Add to Activity Ajout
            if (session()->get('user')) {
                $typeActivity = 0;
                $activityDescription = 'un Type de Dépenses ' . $designation;
                Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription);
            }
            return Redirect::back()->with('successMessage', "L'ajout est fait avec succès");
        }
        return view('pages.expense.typesDepenses')->with('expenses', $expenses);
    }
    // ---------------delete Expense------//
    public function deleteExpense(Request $request, $idExpense)
    {
        Expenses::deleteExpense($idExpense);
        $expenses = Expenses::selectExpenses();
        // Add to Activity Supp
        if (session()->get('user')) {
            $typeActivity = 1;
            $description = 'un Type de Dépenses';
            Activite::addActivity(session()->get('user')->id, $typeActivity, $description);
        }
        return Redirect::route('typeDepenses')
            ->with('deleteMessage', "La suppression est faite avec succès")
            ->with('expenses', $expenses);;
    }
    // ---------------Update Expense-----//
    public function updateExpense(Request $request, $idExpense)
    {
        $expenses = Expenses::selectExpenses();
        $updatedExpense = Expenses::selectExpense($idExpense);
        if ($request->has('updateExpense')) {
            Expenses::updateExpense($idExpense, $request->designation, $request->code, $request->description);
            // Add to Activity Modification
            if (session()->get('user')) {
                $typeActivity = 2;
                $description = 'un Type de Dépenses';
                Activite::addActivity(session()->get('user')->id, $typeActivity, $description);
            }
            return Redirect::route('typeDepenses')
                ->with('updateMessage', "La Modification est faite avec succès")
                ->with('expenses', $expenses);
        }
        return view('pages.expense.updateTypeDepense')
            ->with('updatedExpense', $updatedExpense);
    }
    //-------------------Facture de dépenses----------------------//
    //-------------- List of Facture  ---------------- //
    public function allFacture(Request $request)
    {
        // List of Expenses
        $expenses = Expenses::selectExpenses();
        // list of facture
        $factureDepenses = Facture::allFacture();
        if ($request->has('addFacture')) {
            $datePayment = $request->datePayment;
            $amount = $request->amount;
            $description = $request->description;
            $idStaff = $request->idStaff;
            $idExpense = $request->idExpense;
            $idFacture = Facture::createFacture($datePayment, $amount, $description, $idStaff, $idExpense);
            if (session()->get('user')) {
                $typeActivity = 0; // 0 = Ajout | 1 = Suppression | 2 = Modification
                $description = 'La Facture ' . $idFacture;
                Activite::addActivity(session()->get('user')->id, $typeActivity, $description);
            }
            return Redirect::back()->with('successMessage', "L'ajout est fait avec succès");
        }
        return view('pages.expense.factures')
            ->with('factureDepenses', $factureDepenses)
            ->with('expenses', $expenses);
    }

    // ------------ Suppression du Facture --------- //
    public function deleteFacture($idExpensePayment)
    {
        Facture::deleteFacture($idExpensePayment);
        if (session()->get('user')) {
            $typeActivity = 1; // 0 = Ajout | 1 = Suppression | 2 = Modification
            $description = 'La Facture ' . $idExpensePayment;
            Activite::addActivity(session()->get('user')->id, $typeActivity, $description);
        }
        return Redirect::back()->with('deleteMessage', "La Suppression du Facture est faite avec succès");
    }

    public function getStaffData($idExpense)
    {
        $expense = Expenses::selectExpense($idExpense);
        $data = '';
        if ($expense->code == '000')
            $data = Staff::getProfesseurs();
        elseif ($expense->code == '111')
            $data = Staff::getStaffs();
        $selectData['data'] = $data;
        return response()->json($selectData);
    }
    // ----------- ARCHIVE ------------- //
    public function archive()
    {
        $factures = Facture::softDeletedFactures();
        return view('pages.expense.FactureArchive')->with('factureDepenses', $factures);
    }

    public function restoreArchivedFacture($idExpensePayment)
    {
        Facture::restoreFacture($idExpensePayment);
        $factures = Facture::softDeletedFactures();
        if (session()->get('user')) {
            $typeActivity = 3; // 0 = Ajout | 1 = Suppression | 2 = Modification | 3 = Réstauration | 10 = Suppression définitive
            $description = 'La Facture ' . $idExpensePayment;
            Activite::addActivity(session()->get('user')->id, $typeActivity, $description);
        }
        return Redirect::route('factures.archive')->with('restoreMessage', "La facture a été restorer avec succès")->with('factures', $factures);
    }

    public function deleteArchivedFacture($idExpensePayment)
    {
        Facture::forceDeleteFacture($idExpensePayment);
        if (session()->get('user')) {
            $typeActivity = 10; // 0 = Ajout | 1 = Suppression | 2 = Modification | 3 = Réstauration | 10 = Suppression définitive
            $description = 'La Facture ' . $idExpensePayment;
            Activite::addActivity(session()->get('user')->id, $typeActivity, $description);
        }
        return Redirect::back()->with('deleteMessage', "La facture a été supprimer Définitivement");
    }

    public function multipleArchivedFacture(Request $request)
    {
        if ($request->has('restoreAll')) {
            foreach ($request->archivedFacture as $idExpensePayment) {
                Facture::restoreFacture($idExpensePayment);
                if (session()->get('user')) {
                    $typeActivity = 3; // 0 = Ajout | 1 = Suppression | 2 = Modification | 3 = Réstauration | 10 = Suppression définitive
                    $description = 'La Facture ' . $idExpensePayment;
                    Activite::addActivity(session()->get('user')->id, $typeActivity, $description);
                }
            }
            return Redirect::back()->with('restoreMessage', "Les factures séléctionés ont été restorer avec succès");
        }
        if ($request->has('deleteAll')) {
            foreach ($request->archivedFacture as $idExpensePayment) {
                Facture::forceDeleteFacture($idExpensePayment);
                if (session()->get('user')) {
                    $typeActivity = 10; // 0 = Ajout | 1 = Suppression | 2 = Modification | 3 = Réstauration | 10 = Suppression définitive
                    $description = 'La Facture ' . $idExpensePayment;
                    Activite::addActivity(session()->get('user')->id, $typeActivity, $description);
                }
            }
            return Redirect::back()->with('deleteMessage', "Les factures séléctionés ont été supprimer Définitivement");
        }
    }
}
