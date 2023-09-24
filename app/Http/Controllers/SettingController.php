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
        $datesortie = date('Y');
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
                dd($futureDate);
                if ($futureDate == $datesortie) {
                    Payment::deletePaymentByidStudent($oldeStudent->idStudent);
                    Payment::updatePaiment($oldeStudent->idStudent);
                    Student::forceDeleteStudent($oldeStudent->idStudent);
                }
            }
            foreach ($etudiants as $student) {
                Student::deleteStudent($student->idStudent);
            }
            foreach ($professuers as $professuer) {
                Professeurs::deleteProfesseur($professuer->idProfesseur);
            }
            return Redirect::back()->with('successMessage', "La nouvelle Année fait avec succès");
        }
        return view('setting');
    }
}
