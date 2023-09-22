<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Models\Incomes\Income;
use App\Models\Incomes\Payment;
use App\Models\responsible\Student;
use Illuminate\Support\Facades\DB;
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
            Income::addIncome($request->designation, $request->description, $request->activationDate, $request->fixedAmount);

            // =========== Creation of the Activity ============== //
            if (session()->get('user')) {
                $typeActivity = 0; // 0 = Ajout | 1 = Suppression | 2 = Modification | 3 = Réstauration | 10 = Suppression définitive
                $activityDescription = 'Le type de Revenue: ' . $request->designation;
                Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription, session()->get('user')->name);
            }
            return Redirect::back()->with('successMessage', "L'ajout est fait avec succès");
        }
        return view('pages.incomes.income')->with('Incomes', $Incomes);
    }
    // ---------------delete Income------//
    public function deleteIncome($idIncome)
    {
        $Incomes = Income::allIncome();
        if (session()->get('user')) {
            $incomeInfo = Income::selectIncome($idIncome);
            $typeActivity = 1; // 0 = Ajout | 1 = Suppression | 2 = Modification | 3 = Réstauration | 10 = Suppression définitive
            $activityDescription = 'Le type de Revenue: ' . $incomeInfo->designation;
            Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription, session()->get('user')->name);
        }
        Income::deleteIncome($idIncome);
        return Redirect::route('typeIncome')
            ->with('deleteMessage', "La suppression est faite avec succès")
            ->with('Incomes', $Incomes);
    }

    // ---------------Update Income-----//
    public function updateIncome(Request $request, $idIncome)
    {
        $Incomes = Income::allIncome();
        $updatedIncome = Income::selectIncome($idIncome);
        if ($request->has('updateIncome')) {
            if (isset($request->activationDate))
                Income::updateIncome($idIncome, $request->designation, $request->description, $request->activationDate, $request->fixedAmount);
            else
                Income::updateIncome($idIncome, $request->designation, $request->description);

            // creative activity
            if (session()->get('user')) {
                $typeActivity = 2; // 0 = Ajout | 1 = Suppression | 2 = Modification | 3 = Réstauration | 10 = Suppression définitive
                $activityDescription = 'Le type de Revenue: ' . $updatedIncome->designation . " => " . $request->designation;
                Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription, session()->get('user')->name);
            }

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
        $students = Student::getStudents();
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
                Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription, session()->get('user')->name);
            }
            return Redirect::back()->with('successMessage', "L'ajout est fait avec succès");
        }
        return view('pages.incomes.incomePayment')
            ->with('incomePayment', $incomePayment)
            ->with('incomes', $Incomes);
    }

    public function paimentPage(Request $request, $idPayment)
    {
        $paiment = Payment::getStudentPaiment($idPayment);
        if ($request->has('validatePaiment')) {
            Payment::validateStudentPaiment($idPayment, $request->numeroRecu, $request->datePayment, $request->amountPaid, $request->paymentMode);
            return Redirect::route('student.profil', ['idStudent' => $paiment->idStudent])->with('successMessage', 'Paiement Validé avec succès');
        }
        return view('pages.incomes.paimentPage')->with([
            'paiment' => $paiment,
        ]);
    }

    public function ajaxPaimentModal($idPayment)
    {
        $paiment = Payment::getStudentPaiment($idPayment);
        return response()->json($paiment);
    }

    /* --------------------------------------------------
    / Page Statistique des Groups
    / -------------------------------------------------- */
    public static function incomeStats(Request $request){
        if($request->has('getStats')){
            if($request->statsType == 0){
                // Monthly
                $inscription_stats = Payment::stats_inscriptionPaimentsByMonth($request->statsMonth);
                $groups = Group::getGroups();
                for ($i=0; $i < $groups->count(); $i++)
                    $groups[$i]->stats = Payment::stats_groupsPaimentsByMonth($request->statsMonth,$groups[$i]->idGroup);
                // dd($groups);
                return view('pages.incomes.incomestats')->with([
                    'inscription_stats' => $inscription_stats,
                    'groups' => $groups,
                    'statsType' => 0,
                    'datePayment' => $request->statsMonth
                ]);
            }else{
                // Daily
                $inscription_stats = Payment::stats_inscriptionPaimentsByDay($request->statsDay);
                $inscription_stats->monthTotal = Payment::stats_inscriptionPaimentsByMonth($request->statsDay)->total;
                $groups = Group::getGroups();
                for ($i=0; $i < $groups->count(); $i++){
                    $groups[$i]->stats = Payment::stats_groupPaimentsByDay($request->statsDay,$groups[$i]->idGroup);
                    $groups[$i]->stats->totalMonth = Payment::stats_groupsPaimentsByMonth($request->statsDay,$groups[$i]->idGroup)->totalGroup;
                }
                // dd($groups);
                return view('pages.incomes.incomestats')->with([
                    'inscription_stats' => $inscription_stats,
                    'groups' => $groups,
                    'statsType' => 1,
                    'datePayment' => $request->statsDay
                ]);
            }
        }
        return view('pages.incomes.incomestats');
    }

    // ------------ Suppression du Payment --------- //
    public function deletePayment($idPayment)
    {
        if (session()->get('user')) {
            $typeActivity = 1; // 0 = Ajout | 1 = Suppression | 2 = Modification | 3 = Réstauration | 10 = Suppression définitive
            $activityDescription = "Un Payment (ID = " . $idPayment . ")";
            Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription, session()->get('user')->name);
        }
        Payment::deletePayment($idPayment);
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
            Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription, session()->get('user')->name);
        }
        return Redirect::route('incomePayment.archive')->with('restoreMessage', "Le Reçus a été restorer avec succès")->with('incomePayment', $incomePayment);
    }

    public function deleteArchivedPayment($idPayment)
    {
        Payment::forceDeletePayment($idPayment);
        if (session()->get('user')) {
            $typeActivity = 10; // 0 = Ajout | 1 = Suppression | 2 = Modification | 3 = Réstauration | 10 = Suppression définitive
            $activityDescription = "Un Payment (ID = " . $idPayment . ")";
            Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription, session()->get('user')->name);
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
                    Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription, session()->get('user')->name);
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
                    Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription, session()->get('user')->name);
                }
            }
            return Redirect::back()->with('deleteMessage', "Les Reçues séléctionés ont été supprimer Définitivement");
        }
    }
    //------------------seach etudiant ---------------------- //
    public function searchEtudiant(Request $request)
    {
        $query = $request->get('query');
        Student::where('matricule', 'like', '%'.$query.'%')
        ->orderBy('idStudent', 'desc')
        ->get();
        if(!empty($query)){
        if ($request->ajax()) {
            $data =  DB::table('students')->
            where('matricule', 'like', '%'.$query.'%')
            ->orderBy('idStudent', 'desc')->get();
            $output = '';
            if (count($data) > 0) {
                $output = '<ul class="list-group">';
                foreach ($data as $row) {
                    $output .= '<li class="list-group-item">' . $row->matricule . '</li>';
                }
                $output .= '</ul>';
            } else {
                $output .= '<li class="list-group-item">' . 'No results' . '</li>';
            }
            return $output;
        }}
    }

    
}
