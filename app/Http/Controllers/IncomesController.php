<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use Illuminate\Http\Request;
use App\Models\Incomes\Income;
use App\Models\Incomes\Payment;
use App\Models\responsible\Student;
use Illuminate\Support\Facades\Redirect;

class IncomesController extends Controller
{

    //-------------- List of Incomes Types ---------------- //
    public function allIncomes(Request $request)
    {
        // List of Income
        $Incomes = Income::allIncome();
        // add income
        if ($request->has('ajouterIncome')) {
            $designation = $request->designation;
            $code = $request->code;
            $description = $request->description;
            Income::addIncome($designation, $description, $code);
            if (session()->get('user')) {
                $typeActivity = 0; // 0 = Ajout | 1 = Suppression | 2 = Modification | 3 = Réstauration | 10 = Suppression définitive
                $activityDescription = 'Le type de Revenue: ' . $designation;
                Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription);
            }
            return Redirect::back()->with('successMessage', "L'ajout est fait avec succès");
        }
        return view('pages.incomes.income')->with('Incomes', $Incomes);
    }
    // ---------------delete Income------//
    public function deleteIncome(Request $request, $idIncome)
    {
        $Income = new Income();
        Income::deleteIncome($idIncome);
        $Incomes = Income::allIncome();
        if (session()->get('user')) {
            $incomeInfo = Income::selectIncome($idIncome);
            $typeActivity = 1; // 0 = Ajout | 1 = Suppression | 2 = Modification | 3 = Réstauration | 10 = Suppression définitive
            $activityDescription = 'Le type de Revenue: ' . $incomeInfo->designation;
            Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription);
        }
        return Redirect::route('typeIncome')
            ->with('deleteMessage', "La suppression est faite avec succès")
            ->with('Incomes', $Incomes);
    }
    // ---------------Update Income-----//
    public function updateIncome(Request $request, $idIncome)
    {
        $Income = new Income();
        $Incomes = Income::allIncome();
        $updatedIncome = Income::selectIncome($idIncome);
        if ($request->has('updateIncome')) {
            if (session()->get('user')) {
                $typeActivity = 2; // 0 = Ajout | 1 = Suppression | 2 = Modification | 3 = Réstauration | 10 = Suppression définitive
                $activityDescription = 'Le type de Revenue: ' . $updatedIncome->designation . " => " . $request->designation;
                Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription);
            }
            Income::updateIncome($idIncome, $request->designation, $request->code, $request->description);
            return Redirect::route('typeIncome')
                ->with('updateMessage', "La Modification est faite avec succès")
                ->with('Incomes', $Incomes);
        }
        return view('pages.incomes.updatetypeIncome')
            ->with('updatedIncome', $updatedIncome);
    }

    //-------------------Income de Payment----------------------//
    //-------------- List of Payment  ---------------- //
    public function allPayment(Request $request)
    {
        $Student = new Student();
        $students = $Student->getStudents();
        // List of Payment
        $Incomes = Income::allIncome();
        // list of Payment
        $incomePayment = Payment::allPayment();
        if ($request->has('addPayment')) {
            $datePayment = $request->datePayment;
            $paymentMode = $request->paymentMode;
            $amount = $request->amount;
            $description = $request->description;
            $idIncome = $request->idIncome;
            $matricule = $request->matricule;
            Payment::createPayment($datePayment, $paymentMode, $amount, $description, $matricule, $idIncome);
            if (session()->get('user')) {
                $typeActivity = 0; // 0 = Ajout | 1 = Suppression | 2 = Modification | 3 = Réstauration | 10 = Suppression définitive
                $activityDescription = 'Un Payment (Description: ' . $description . ")";
                Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription);
            }
            return Redirect::back()->with('successMessage', "L'ajout est fait avec succès");
        }
        return view('pages.incomes.incomePayment')
            ->with('incomePayment', $incomePayment)
            ->with('incomes', $Incomes);
    }
    // ------------ Suppression du Payment --------- //
    public function deletePayment($idPayment)
    {
        Payment::deletePayment($idPayment);
        if (session()->get('user')) {
            $typeActivity = 1; // 0 = Ajout | 1 = Suppression | 2 = Modification | 3 = Réstauration | 10 = Suppression définitive
            $activityDescription = "Un Payment (ID = " . $idPayment . ")";
            Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription);
        }
        return Redirect::back()->with('deleteMessage', "La Suppression du Reçus est faite avec succès");
    }


    // ----------- ARCHIVE ------------- //
    public function archive()
    {
        $incomePayment = Payment::softDeletedPayment();
        return view('pages.incomes.archiveReçus')->with('incomePayment', $incomePayment);
    }

    public function restoreArchivedPayment($idPayment)
    {
        Payment::restorePayment($idPayment);
        $incomePayment = Payment::softDeletedPayment();
        if (session()->get('user')) {
            $typeActivity = 3; // 0 = Ajout | 1 = Suppression | 2 = Modification | 3 = Réstauration | 10 = Suppression définitive
            $activityDescription = "Un Payment (ID = " . $idPayment . ")";
            Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription);
        }
        return Redirect::route('incomePayment.archive')->with('restoreMessage', "Le Reçus a été restorer avec succès")->with('incomePayment', $incomePayment);
    }

    public function deleteArchivedPayment($idPayment)
    {
        Payment::forceDeletePayment($idPayment);
        if (session()->get('user')) {
            $typeActivity = 10; // 0 = Ajout | 1 = Suppression | 2 = Modification | 3 = Réstauration | 10 = Suppression définitive
            $activityDescription = "Un Payment (ID = " . $idPayment . ")";
            Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription);
        }
        return Redirect::back()->with('deleteMessage', "Le Reçue a été supprimer Définitivement");
    }

    public function multipleArchivedPayment(Request $request)
    {
        if ($request->has('restoreAll')) {
            foreach ($request->archivedPayment as $idPayment) {
                Payment::restorePayment($idPayment);
                if (session()->get('user')) {
                    $typeActivity = 3; // 0 = Ajout | 1 = Suppression | 2 = Modification | 3 = Réstauration | 10 = Suppression définitive
                    $activityDescription = "Un Payment (ID = " . $idPayment . ")";
                    Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription);
                }
            }
            return Redirect::back()->with('restoreMessage', "Les Reçues séléctionés ont été restorer avec succès");
        }
        if ($request->has('deleteAll')) {
            foreach ($request->archivedPayment as $idPayment) {
                Payment::forceDeletePayment($idPayment);
                if (session()->get('user')) {
                    $typeActivity = 10; // 0 = Ajout | 1 = Suppression | 2 = Modification | 3 = Réstauration | 10 = Suppression définitive
                    $activityDescription = "Un Payment (ID = " . $idPayment . ")";
                    Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription);
                }
            }
            return Redirect::back()->with('deleteMessage', "Les Reçues séléctionés ont été supprimer Définitivement");
        }
    }
}
