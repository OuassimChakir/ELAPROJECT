<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Group;
use App\Models\GroupElements;
use App\Models\GroupGrades;
use App\Models\Incomes\Payment;
use App\Models\responsible\Professeurs;
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
        $datesortie = intval(date('Y'));
        if ($request->has('newYear')) {
            $students = Student::getStudents();
            $oldeStudents = Student::softDeletedStudents();
            $archiveGroupes = Group::softDeletedGroups();
            $professuers = Professeurs::getProfesseurs();
            $groupes = Group::getGroups();
            $allfacture= Payment::allPayment();
            foreach ($allfacture as $payment) {
                Payment::deletePayment($payment->idPayment);
            }
            foreach ($groupes as $groupe) {
                $payments = Payment::getPaymentByidGroup($groupe->idGroup);
                Group::deleteGroup($groupe->idGroup);
            }
            foreach ($oldeStudents as $oldeStudent) {
                $deleted = Student::getDeletedStudent($oldeStudent->idStudent);
                $date = new DateTime($deleted->deleted_at);
                $futureDate = $date->format('Y') + 1;
                if ($futureDate == $datesortie) {
                    $payments = Payment::getPaymentByidStudent($oldeStudent->idStudent);
                    foreach ($payments as $payment) {
                        Payment::updatePaiment($payment->idPayment);
                        Payment::deletePayment($payment->idPayment);
                    }
                    User::forceStudentAccount($oldeStudent->idStudent);
                    Student::forceDeleteStudent($oldeStudent->idStudent);
                }
            }
            foreach ($students as $student) {
                User::deleteStudentAccount($student->idStudent);
                Student::deleteStudent($student->idStudent);
            }
            foreach ($professuers as $professuer) {
                User::deleteProfAccount($professuer->idProfesseur);
                Professeurs::deleteProfesseur($professuer->idProfesseur);
            }
            foreach ($archiveGroupes as $groupe) {
               // Payment::updatePaimentidGroup($groupe->idGroup);
                $groupElements = GroupElements::groupElements($groupe->idGroup);
                foreach ($groupElements as $goupElements) {
                    Attendance::deleteGroupAttendancebyidElement($goupElements->idElement);
                    GroupElements::cancelAssignment($goupElements->idElement);
                }
                GroupGrades::deleteGroupGrades($groupe->idGroup);
                $payments = Payment::getPaymentByidGroup($groupe->idGroup);
                foreach ($payments as $payment) {
                    if($payment->idGroup != null){
                       Payment::updatePaimentidGroup($payment->idPayment); 
                    }  
                }
                Group::forceDeleteGroup($groupe->idGroup);
            }
            return Redirect::back()->with('successMessage', "La nouvelle Année fait avec succès");
        }
        return view('setting');
    }
}
