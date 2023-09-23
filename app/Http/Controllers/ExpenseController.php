<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use Illuminate\Http\Request;
use App\Models\Expenses\Expenses;
use App\Models\Expenses\Facture;
use App\Models\responsible\Professeurs;
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
            if(isset($request->code)) $code = $request->code;
            else$code = NULL;
            $designation = $request->designation;
            Expenses::createExpense($designation,$code);
            // Add to Activity Ajout
            if (session()->get('user')) {
                $typeActivity = 0;
                $activityDescription = 'un Type de Dépenses ' . $designation;
                Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription,session()->get('user')->name);
            }
            return Redirect::back()->with('successMessage', "L'ajout est fait avec succès");
        }
        return view('pages.expense.typesDepenses')->with('expenses', $expenses);
    }
    // ---------------delete Expense------//
    public function deleteExpense($idExpense)
    {
        Expenses::deleteExpense($idExpense);
        $expenses = Expenses::selectExpenses();
        // Add to Activity Supp
        if (session()->get('user')) {
            $typeActivity = 1;
            $activityDescription = 'un Type de Dépenses';
            Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription,session()->get('user')->name);
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
            Expenses::updateExpense($idExpense,$request->designation,$request->code);
            // Add to Activity Modification
            if (session()->get('user')) {
                $typeActivity = 2;
                $activityDescription = 'un Type de Dépenses';
                Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription,session()->get('user')->name);
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
        $Professeurs= Professeurs::getProfesseurs();
        $staffs= Staff::getStaffs();
        // list of facture
        $factureDepenses = Facture::allFacture();            
        $idProfesseur=null;$prenom=null;$idStaff=null;$nom=null;
        if ($request->has('addFacture')) {
           if(isset($request->idStaff)){
             $row=explode('|',$request->idStaff);
             $idStaff=$row[0];
             $nom=strtoupper($row[1]);
             $prenom=strtoupper($row[2]);
             $idProfesseur =null;
           }elseif(isset($request->idProfesseur)){
            $row=explode('|',$request->idProfesseur);
            $idProfesseur=$row[0];
            $nom=strtoupper($row[1]);
            $prenom=strtoupper($row[2]);
            $idStaff = null;
           }
            $datePayment = $request->datePayment;
            $amount = $request->amount;
            $description = $request->description;  
            $idExpense = explode('|',$request->idExpense);
            $id=session()->get('user')->id;
            $idFacture = Facture::createFacture($datePayment,$nom,$prenom, $amount, $description, $idStaff, $idProfesseur, $idExpense[0],$id);
            if (session()->get('user')) {
                $typeActivity = 0; // 0 = Ajout | 1 = Suppression | 2 = Modification
                $activityDescription = 'La Facture ' . $idFacture;
                Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription,session()->get('user')->name);
            }
            return Redirect::back()->with('successMessage', "L'ajout est fait avec succès");
        }
        return view('pages.expense.factures')
            ->with('factureDepenses', $factureDepenses)
            ->with('expenses', $expenses)
            ->with('Professeurs',$Professeurs)
            ->with('staffs',$staffs);
    }

    // ------------ Suppression du Facture --------- //
    public function deleteFacture($idExpensePayment)
    {
        Facture::deleteFacture($idExpensePayment);
        if (session()->get('user')) {
            $typeActivity = 1; // 0 = Ajout | 1 = Suppression | 2 = Modification
            $activityDescription = 'La Facture ' . $idExpensePayment;
            Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription,session()->get('user')->name);
        }
        return Redirect::back()->with('deleteMessage', "La Suppression du Facture est faite avec succès");
    }

    public function getStaffData($idExpense){
        $expense = Expenses::selectExpense($idExpense);
        $data = '';
        if ($expense->code == '1')
            $data = Professeurs::getProfesseurs();
        elseif ($expense->code == '0')
            $data = Staff::getStaffs();
        $selectData['data'] = $data;
        return response()->json($selectData);
    }

    // ----------- ARCHIVE ------------- //
    public function archive(){
        $factures = Facture::softDeletedFactures();
        return view('pages.expense.FactureArchive')->with('factureDepenses', $factures);
    }

    public function restoreArchivedFacture($idExpensePayment){
        Facture::restoreFacture($idExpensePayment);
        $factures = Facture::softDeletedFactures();
        if (session()->get('user')) {
            $typeActivity = 3; // 0 = Ajout | 1 = Suppression | 2 = Modification | 3 = Réstauration | 10 = Suppression définitive
            $activityDescription = 'La Facture ' . $idExpensePayment;
            Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription,session()->get('user')->name);
        }
        return Redirect::route('factureDepenses.archive')->with('restoreMessage', "La facture a été restorer avec succès")->with('factures', $factures);
    }

    public function deleteArchivedFacture($idExpensePayment)
    {
        Facture::forceDeleteFacture($idExpensePayment);
        if (session()->get('user')) {
            $typeActivity = 10; // 0 = Ajout | 1 = Suppression | 2 = Modification | 3 = Réstauration | 10 = Suppression définitive
            $activityDescription = 'La Facture ' . $idExpensePayment;
            Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription,session()->get('user')->name);
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
                    $activityDescription = 'La Facture ' . $idExpensePayment;
                    Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription,session()->get('user')->name);
                }
            }
            return Redirect::back()->with('restoreMessage', "Les factures séléctionés ont été restorer avec succès");
        }
        if ($request->has('deleteAll')) {
            foreach ($request->archivedFacture as $idExpensePayment) {
                Facture::forceDeleteFacture($idExpensePayment);
                if (session()->get('user')) {
                    $typeActivity = 10; // 0 = Ajout | 1 = Suppression | 2 = Modification | 3 = Réstauration | 10 = Suppression définitive
                    $activityDescription = 'La Facture ' . $idExpensePayment;
                    Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription,session()->get('user')->name);
                }
            }
            return Redirect::back()->with('deleteMessage', "Les factures séléctionés ont été supprimer Définitivement");
        }
    }
}
