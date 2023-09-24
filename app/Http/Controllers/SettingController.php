<?php

namespace App\Http\Controllers;

use App\Models\Group;
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
            $etudiants = Student::getStudents();
            $oldeStudents = Student::softDeletedStudents();
            $professuers = Professeurs::getProfesseurs();
            $user = User::getUsers();
            $groupes = Group::getGroups();
            foreach ($oldeStudents as $oldeStudent) {
                $deleted = Student::getDeletedStudent($oldeStudent->idStudent);
                $date = new DateTime($deleted->deleted_at);
                $futureDate = $date->format('Y') + 1;
                if ($futureDate == $datesortie) {
                    $payments= Payment::getPaymentByidStudent($oldeStudent->idStudent);
                    //dd($payments);
                    foreach($payments as $payment){
                        Payment::updatePaiment($payment->idPayment);
                        Payment::deletePayment($payment->idPayment);
                    }
                    User::forceStudentAccount($oldeStudent->idStudent);
                    Student::forceDeleteStudent($oldeStudent->idStudent);
                }
            }
            dd($etudiants);
            foreach ($etudiants as $student) {
                User::deleteStudentAccount($etudiants->idStudent);
                Student::deleteStudent($student->idStudent);
            }
            foreach ($professuers as $professuer) {
                User::deleteProfAccount($professuer->idProfesseur);
                Professeurs::deleteProfesseur($professuer->idProfesseur);
            }
            return Redirect::back()->with('successMessage', "La nouvelle Année fait avec succès");
        }
        return view('setting');
    }
}
