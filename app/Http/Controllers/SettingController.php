<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Expenses\Facture;
use App\Models\Group;
use App\Models\GroupElements;
use App\Models\GroupGrades;
use App\Models\Incomes\Payment;
use App\Models\responsible\Professeurs;
use App\Models\Responsible\Responsible;
use App\Models\Responsible\Staff;
use App\Models\Responsible\Student;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SettingController extends Controller
{
    //

    public function index(Request $request)
    {
        $currentYear = intval(date('Y'));
        if ($request->has('newYear')) {
            $students = Student::getStudents();
            $oldStudents = Student::softDeletedStudents();
            $professeurs = Professeurs::getProfesseurs();
            $staffs = Staff::getStaffs();
            $groupes = Group::getGroups();
            dd($oldStudents);
            foreach ($groupes as $groupe) {
                // Payment::updatePaimentidGroup($groupe->idGroup);
                $groupElements = GroupElements::groupElements($groupe->idGroup);
                foreach ($groupElements as $goupElements) {
                    Attendance::deleteGroupAttendancebyidElement($goupElements->idElement);
                    GroupElements::cancelAssignment($goupElements->idElement);
                }
                GroupGrades::deleteGroupGrades($groupe->idGroup);
                $payments = Payment::getPaymentByidGroup($groupe->idGroup);
                foreach ($payments as $payment) {
                    if ($payment->idGroup != null) {
                        Payment::updatePaimentidGroup($payment->idPayment);
                    }
                }
                Group::deleteGroup($groupe->idGroup);
            }

            $allfacture = Payment::allPayment();
            foreach ($allfacture as $payment) {
                Payment::deletePayment($payment->idPayment);
            }

            foreach ($oldStudents as $oldStudent) {
                $date = date_create($oldStudent->deleted_at);
                $anneeSortie = (int)date_format($date,'Y') + 1;
                if ($anneeSortie == $currentYear) {
                    $payments = Payment::getOldPaymentByidStudent($oldStudent->idStudent);
                    foreach ($payments as $payment)
                        Payment::forceDeletePayment($payment->idPayment);
                    
                    User::forceStudentAccount($oldStudent->idStudent);
                    if(!is_null($oldStudent->idResponsible))
                        Responsible::deleteResponsible($oldStudent->idResponsible);
                    Student::forceDeleteStudent($oldStudent->idStudent);
                }
            }

            foreach ($students as $student) {
                User::deleteStudentAccount($student->idStudent);
                Student::deleteStudent($student->idStudent);
                $payments = Payment::getPaymentByidStudent($student->idStudent);
                foreach ($payments as $payment)
                    Payment::deletePayment($payment->idPayment);
            }

            foreach ($professeurs as $professeur) {
                User::deleteProfAccount($professeur->idProfesseur);
                Professeurs::deleteProfesseur($professeur->idProfesseur);
                $factures = Facture::getFacturesByProf($professeur->idProfesseur);
                foreach ($factures as $facture)
                    Payment::forceDeleteFacture($facture->idExpensePayment);
            }

            foreach ($staffs as $staff) {
                User::deleteStaffAccount($staff->idStaff);
                Staff::deleteStaff($staff->idStaff);
                $factures = Facture::getFacturesByStaff($staff->idStaff);
                foreach ($factures as $facture)
                    Payment::forceDeleteFacture($facture->idExpensePayment);
            }
            return Redirect::back()->with('NewYearSuccess', "La nouvelle Année fait avec succès");
        }
        return view('setting');
    }
}
