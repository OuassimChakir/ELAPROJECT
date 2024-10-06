<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Attendance;
use App\Models\Emploi;
use App\Models\Expenses\Facture;
use App\Models\Group;
use App\Models\GroupElements;
use App\Models\GroupGrades;
use App\Models\Incomes\Payment;
use App\Models\Notes;
use App\Models\responsible\Professeurs;
use App\Models\Responsible\Responsible;
use App\Models\Responsible\Staff;
use App\Models\Responsible\Student;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    //

    public function index(Request $request)
    {
        $currentYear = intval(date('Y'));
        if ($request->has('newYear')) {
            if (Hash::check($request->password, auth()->user()->password)) {
                /* ------------------------------------
                / Reset annnéeScolaire File
                / ------------------------------------*/
                Storage::disk('local')->put('anneeScolaire.txt', $currentYear . "\n" . ((int)date('Y') + 1));

                // Delete All Attendances Histories:
                Attendance::select('*')->delete();

                // Supprimer les Emplois
                Emploi::select('*')->delete();

                // Supprimer les Notes
                Notes::select('*')->delete();

                // Modifier les paiements id group null
                Payment::select('*')->update([
                    'idGroup' => null,
                ]);
                Payment::withTrashed()->forceDelete();

                // Supprimer les Groupes Elements
                GroupElements::select('*')->delete();

                // Groupe Grades
                GroupGrades::select('*')->delete();

                // Supprimer les Groupes
                Group::select('*')->delete();

                // Supprimer les activités
                Activite::select('*')->delete();

                // expenses Paiements
                Facture::select('*')->delete();

                // Supprimer les professeurs
                $deleted_profs = Professeurs::withTrashed()->get();
                foreach($deleted_profs as $prof){
                    Facture::where('idProfesseur', $prof->idProfesseur)->forceDelete();
                    User::where('idProfesseur', $prof->idProfesseur)->forceDelete();
                    $prof->forceDelete();
                }
                Professeurs::select('*')->delete();

                // Supprimer les staffs
                $deleted_staff = Staff::withTrashed()->get();
                foreach($deleted_staff as $staff){
                    Facture::where('idStaff', $staff->idStaff)->forceDelete();
                    User::where('idStaff', $staff->idStaff)->forceDelete();
                    $staff->forceDelete();
                }
                Staff::select('*')->delete();

                // Supprimer les étudiants
                $deleted_students = Student::withTrashed()->get();
                foreach($deleted_students as $student){
                    Payment::where('idStudent', $student->idStudent)->forceDelete();
                    User::where('idStudent', $student->idStudent)->forceDelete();
                    $student->forceDelete();
                }
                Student::select('*')->delete();

                return response()->json(true);
            } else {
                return response()->json(false);
            }
        }

        return view('setting');
    }
}
