<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Group;
use App\Models\GroupElements;
use App\Models\Incomes\Income;
use App\Models\Incomes\Payment;
use App\Models\responsible\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class IncomesController extends Controller
{

    //-------------- List of Incomes Types ---------------- //
    public static function incomeStats(Request $request)
    {
        if ($request->has('getStats')) {
            if ($request->statsType == 0) {
                // Monthly
                $inscription_stats = Payment::stats_inscriptionPaimentsByMonth($request->statsMonth);
                $groups = Group::getGroups();
                for ($i = 0; $i < $groups->count(); $i++)
                    $groups[$i]->stats = Payment::stats_groupsPaimentsByMonth($request->statsMonth, $groups[$i]->idGroup);

                return view('pages.incomes.incomestats')->with([
                    'inscription_stats' => $inscription_stats,
                    'groups' => $groups,
                    'statsType' => 0,
                    'datePayment' => $request->statsMonth
                ]);
            } else {
                // Daily
                $inscription_stats = Payment::stats_inscriptionPaimentsByDay($request->statsDay);
                $inscription_stats->monthTotal = Payment::stats_inscriptionPaimentsByMonth($request->statsDay)->total;
                $groups = Group::getGroups();
                for ($i = 0; $i < $groups->count(); $i++) {
                    $groups[$i]->stats = Payment::stats_groupPaimentsByDay($request->statsDay, $groups[$i]->idGroup);
                    $groups[$i]->stats->totalMonth = Payment::stats_groupsPaimentsByMonth($request->statsDay, $groups[$i]->idGroup)->totalGroup;
                }
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

    // ---------------delete Income------//

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

    // ---------------Update Income-----//

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

    //-------------------Income de Payment----------------------//
    //-------------- List of Payment  ---------------- //

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

    public function allPayment(Request $request)
    {
        // List of Payment
        $Incomes = Income::allIncome();
        // list of Payment
        $incomePayment = Payment::allPayment();
        if ($request->has('validatePaiment')) {
            $select = explode('|', $request->idIncome);
            $income = Income::find($select[0]);
            $note = $income->description . ' - ' . date('Y');
            $idIncome = $income->idIncome;
            if ($request->amount == $request->amountPaid)
                $etat = 1;
            elseif ($request->amount > $request->amountPaid)
                $etat = 0;

            if (is_null($income->activationDate)) {
                Payment::create([
                    'numeroRecu' => $request->numeroRecu,
                    'datePayment' => $request->datePayment,
                    'paymentMode' => $request->paymentMode,
                    'amount' => $request->amount,
                    'amountPaid' => $request->amountPaid,
                    'note' => $note,
                    'etat' => $etat,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'idIncome' => $idIncome,
                ]);
                if (session()->get('user')) {
                    $typeActivity = 0; // 0 = Ajout | 1 = Suppression | 2 = Modification | 3 = Réstauration | 10 = Suppression définitive
                    $activityDescription = 'Un Payment (Description: ' . $note . ")";
                    Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription, session()->get('user')->name);
                }
                return Redirect::back()->with('successMessage', "L'ajout est fait avec succès");
            }

            $dataidstudent = Student::selectStudent($request->search);
            $idStudent = $dataidstudent->idStudent;
            $count = Payment::checkElementPaiment($request->idGroup, $idStudent, $idIncome);
            if ($count == 0) {
                Payment::createPayment(
                    $request->numeroRecu,
                    $request->datePayment,
                    $request->paymentMode,
                    $request->amount,
                    $request->amountPaid,
                    $note,
                    $etat,
                    $request->idGroup,
                    $idStudent,
                    $idIncome
                );
                if (session()->get('user')) {
                    $typeActivity = 0; // 0 = Ajout | 1 = Suppression | 2 = Modification | 3 = Réstauration | 10 = Suppression définitive
                    $activityDescription = 'Un Payment (Description: ' . $note . ")";
                    Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription, session()->get('user')->name);
                }
                return Redirect::back()->with('successMessage', "L'ajout est fait avec succès");
            } else return Redirect::back()->with('deleteMessage', "Ce facture est déja existé !!!");
        }
        return view('pages.incomes.incomePayment')
            ->with('incomePayment', $incomePayment)
            ->with('incomes', $Incomes);
    }

    public function groupPayments($idGroup, $datePayment)
    {
        $group = Group::getGroup($idGroup);
        $incomePayment = Payment::getGroupPaiments($idGroup, $datePayment);
        return view('pages.groupes.groupIncomes')->with([
            'incomePayment' => $incomePayment,
            'group' => $group,
            'datePayment' => $datePayment,
        ]);
    }

    public function generatePayments(Request $request){
        $group = Group::getGroup($request->idGroup);
        if($request->has('generatePayments') && !is_null($request->payments)){
            foreach ($request->payments as $paymentItem){
                $payment = explode('|',$paymentItem);
                $income = Income::getIncomeByDate($payment[1]);
                if((int)$payment[1] < 10)
                    $income = Income::getIncomeByDate('0'.$payment[1]);

                if (Payment::checkElementPaiment($request->idGroup, $payment[0], $income->idIncome) != 0)
                    continue;
                else
                    Payment::initialGroupPayment($group->amount,$income->description . ' - ' . $payment[2], $request->idGroup, $payment[0], $income->idIncome);
            }

            return Redirect::back()->with('successAlert','Les paiements des étudiants a été créé avec succès !');
        }
        return Redirect::back()->with('dangerAlert','Erreur lors de la creation des factures des étudiants!');
    }

    public function studentPaiments(Request $request, $idStudent)
    {
        $student = Student::getStudent($idStudent);
        if ($request->has('datePayment')) {
            $incomePayment = Payment::getStudentPaiments($idStudent, $request->datePayment);
            $datePayment = $request->datePayment;
        } else {
            $incomePayment = Payment::getStudentPaiments($idStudent);
            $datePayment = date('Y-m');
        }
        return view('pages.students.studentIncomes')->with([
            'incomePayment' => $incomePayment,
            'student' => $student,
            'datePayment' => $datePayment,
        ]);
    }

    public function paimentPage(Request $request, $idPayment)
    {
        $paiment = Payment::getStudentPaiment($idPayment);
        if ($request->has('validatePaiment')) {
            if ($paiment->amount - $paiment->amountPaid != 0){
                Payment::where('idPayment', $idPayment)->update([
                    'amount' => $request->amount+$paiment->amountPaid
                ]);
                $amountPaid = $request->amountPaid + $paiment->amountPaid;
                Payment::validateStudentPaiment($idPayment, $request->numeroRecu, $request->datePayment, $amountPaid, $request->paymentMode);
            } else {
                Payment::where('idPayment', $idPayment)->update([
                    'amount' => $request->amount
                ]);
                Payment::validateStudentPaiment($idPayment, $request->numeroRecu, $request->datePayment, $request->amountPaid, $request->paymentMode);
            }
            return Redirect::route('student.profil', ['idStudent' => $paiment->idStudent])->with('successMessage', 'Paiement Validé avec succès');
        }
        return view('pages.incomes.paimentPage')->with([
            'paiment' => $paiment,
        ]);
    }

    /* --------------------------------------------------
    / Page Statistique des Groups
    / -------------------------------------------------- */

    public function ajaxPaimentModal($idPayment)
    {
        $paiment = Payment::getStudentPaiment($idPayment);
        return response()->json($paiment);
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
        if (!empty($query)) {
            if ($request->ajax()) {
                $data = DB::table('students')->where('matricule', 'like', '%' . $query . '%')
                    ->orderBy('idStudent', 'desc')->get();
                $output = '';
                if (count($data) > 0) {
                    $output = '<ul class="list-group">';
                    foreach ($data as $row) {
                        $output .= '<li class="list-group-item userListElement" value="' . $row->matricule . '">' . $row->matricule . '</li>';
                    }
                    $output .= '</ul>';
                } else {
                    $output = '<li class="list-group-item">' . 'No results' . '</li>';
                }
                return $output;
            }
        }
    }

    public function searchGroup(Request $request)
    {
        $query = $request->get('matricule');
        if (!empty($query))
            if ($request->ajax()) {
                $data = GroupElements::select('*')
                    ->join('groups', 'groups.idGroup', '=', 'groupelements.idGroup')
                    ->join('subjects', 'subjects.idSubject', '=', 'groups.idSubject')
                    ->join('coursetype', 'coursetype.idCourseType', '=', 'subjects.idCourseType')
                    ->join('students', 'students.idStudent', '=', 'groupelements.idStudent')
                    ->where('students.matricule', $query)
                    ->get();
                return response()->json($data);
            }
    }

    public function searchRecu(Request $request)
    {
        $query = $request->get('numRecuQuery');
        $output = 0;
        if (!empty($query)) {
            if ($request->ajax()) {
                $data = DB::table('payment')->where('numeroRecu', $query)->get();
                if (count($data) > 0) {
                    return $output = 1;
                }
                return $output;
            }
        } else {
            return $output;
        }
    }

    public function activatePaiment(Request $request)
    {
        if ($request->has('idPayment')) {
            Payment::where('idPayment', $request->idPayment)->update([
                'etat' => 0,
            ]);
            return response()->json(true);

        }
        return response()->json(false);
    }
}
