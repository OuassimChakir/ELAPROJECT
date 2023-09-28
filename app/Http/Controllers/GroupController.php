<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Attendance;
use App\Models\Courses\CourseType;
use App\Models\Courses\Subjects;
use App\Models\Grades\Grades;
use App\Models\Grades\GradesCategory;
use App\Models\Group;
use App\Models\GroupElements;
use App\Models\GroupGrades;
use App\Models\Incomes\Income;
use App\Models\Incomes\Payment;
use App\Models\Notes;
use App\Models\responsible\Professeurs;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;


class GroupController extends Controller
{
    // Groups List
    public function groups(Request $request)
    {
        $gradesCategories = GradesCategory::getGradeCategories();
        $subjects = Subjects::getSubjects();
        $courseTypes = CourseType::selectCourses();
        $professeurs = Professeurs::getProfesseurs();
        $role = Roles::getRole(Auth::user()->idRole);
        if ($role->codeRole == '22')
            $groups = Group::getStudentGroups(Auth::user()->idStudent);
        elseif ($role->codeRole == '33')
            $groups = Group::getProfGroups(Auth::user()->idProfesseur);
        else
            $groups = Group::getGroups();
        if ($request->has('CreateGroup')) {
            $numGroups = Group::getNumGroups($request->idSubject, $request->idProfesseur) + 1;
            $matiere = Subjects::getSubject($request->idSubject);
            $gradeCategory = GradesCategory::getGradeCategory($request->gradeCategory);
            $designation = $gradeCategory->category . '-' . $matiere->short . '-G' . $numGroups;
            $newGroup = Group::createGroup($designation, $request->capacity, $request->amount, $request->idSubject, $request->idProfesseur);

            if (isset($request->grades))
                foreach ($request->grades as $idGrade)
                    GroupGrades::newGroupGrade($idGrade, $newGroup);


            if (session()->get('user')) {
                $typeActivity = 0; // 0 = Ajout | 1 = Suppression | 2 = Modification | 3 = Réstauration | 10 = Suppression définitive
                $activityDescription = "Le Groupe " . $designation;
                Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription, session()->get('user')->name);
            }
            return Redirect::back()
                ->with('successMessage', "La Creation du Groupe est faite avec succès");
        }
        return view('pages.groupes.groupes')
            ->with('groupes', $groups)
            ->with('gradesCategories', $gradesCategories)
            ->with('professeurs', $professeurs)
            ->with('subjects', $subjects)
            ->with('courseTypes', $courseTypes);
    }
 
    public function groupPage($idGroup)
    {
        $students = GroupElements::groupElements($idGroup);
        $absen = Attendance::selectAbsence();
        // Queries
        $gradesCategories = GradesCategory::getGradeCategories();

        $subjects = Subjects::getSubjects();
        $courseTypes = CourseType::selectCourses();
        $teachers = Professeurs::getProfesseurs();
        $groupInfo = Group::getGroup($idGroup);
        $groupGrades = GroupGrades::getGroupGrades($idGroup);
        // Logic
        $groupInfo->nbElements = GroupElements::countGroupElements($idGroup);
        $description = explode('-', $groupInfo->designation);
        $groupInfo->description = $description[2];
        if (isset($groupGrades[0]))
            $grades = Grades::selectGradesByCategory($groupGrades[0]->idGradeCategory);
        else
            $grades = Grades::selectGradesByCategory(null);
        return view('pages.groupes.group')
            ->with('group', $groupInfo)
            ->with('groupGrades', $groupGrades)
            ->with('gradesCategories', $gradesCategories)
            ->with('professeurs', $teachers)
            ->with('subjects', $subjects)
            ->with('grades', $grades)
            ->with('students', $students)
            ->with('courseTypes', $courseTypes)
            ->with('absen', $absen);
    }

    public function getGrade($idGradeCategory)
    {
        $gradeData['data'] = Grades::selectGradesByCategory($idGradeCategory);
        return response()->json($gradeData);
    }

    //  DELETION 
    public function deleteGroup($idGroup)
    {
        $payments = Payment::getGroupPendingPaiments($idGroup);
        if ($payments == 0) {
            Payment::where('etat', 1)->where('idGroup', $idGroup)->update([
                'idGroup' => null,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            Payment::whereNull('etat')->where('idGroup', $idGroup)->delete();
            GroupGrades::deleteGroupGrades($idGroup);
            if (session()->get('user')) {
                $groupInfo = Group::getGroup($idGroup);
                $typeActivity = 1; // 0 = Ajout | 1 = Suppression | 2 = Modification | 3 = Réstauration | 10 = Suppression définitive
                $activityDescription = "Le Groupe " . $groupInfo->designation . " (ID = " . $groupInfo->idGroup . ")";
                Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription, session()->get('user')->name);
            }
            Attendance::deleteGroupAttendancebyidGroup($idGroup);
            Notes::deleteGroupNotes($idGroup);
            GroupElements::deleteGroupClassroom($idGroup);
            Group::deleteGroup($idGroup);
            return  response()->json(true);
        } elseif ($payments > 0) {
            return response()->json(false);
            
        }
    }

    // Update Group
    public function updateGroup(Request $request, $idGroup)
    {
        if ($request->has('updateGroup') && isset($idGroup)) {
            Group::updateGroup($idGroup, $request->capacity, $request->amount, $request->debutFormation, $request->finFormation, $request->idSubject, $request->idProfesseur);

            if (isset($request->grades)) {
                GroupGrades::deleteGroupGrades($idGroup);
                foreach ($request->grades as $idGrade)
                    GroupGrades::newGroupGrade($idGrade, $idGroup);
            }

            $group = Group::getGroup($idGroup);
            if (session()->get('user')) {
                $typeActivity = 2; // 0 = Ajout | 1 = Suppression | 2 = Modification | 3 = Réstauration | 10 = Suppression définitive
                $activityDescription = "Le Groupe " . $group->designation . " (ID = " . $idGroup . ")";
                Activite::addActivity(auth()->user()->id, $typeActivity, $activityDescription, auth()->user()->name);
            }
            return Redirect::back()->with('updateMessage', 'La Modification du Groupe est faite avec Succès');
        }
    }


    /* --------------------------------------
    / Assignements (Ajout au Groupe)
    / ---------------------------------------*/

    public function assignElement($idGroup, $idStudent)
    {
        GroupElements::addElement($idGroup, $idStudent);
        $group = Group::getGroup($idGroup);
        $debut = (int)explode('-', $group->debutFormation)[1];
        $year = (int)explode('-', $group->debutFormation)[0];
        if (date('Y-m-d') > $group->debutFormation) {
            $debut = (int)date('m');
            $year = (int)date('Y');
        }
        $fin = (int)explode('-', $group->finFormation)[1];
        $breakpoint = $fin + 13;

        for ($i = $debut; $i <= $breakpoint; $i++) {
            $income = Income::getIncomeByDate($i);
            // Log::info("Iterations ".$i." - idIncome ".$income->idIncome." - Result: ".Payment::checkElementPaiment($idGroup,$idStudent, $income->idIncome)." - idStudent: ".$idStudent." & idGroup ".$idGroup);
            if (Payment::checkElementPaiment($idGroup, $idStudent, $income->idIncome) != 0)
                continue;
            else {
                Payment::initialGroupPayment($group->amount, $income->description . ' - ' . $year, $idGroup, $idStudent, $income->idIncome);
                if ($i == 12) {
                    $i = 0;
                    $breakpoint = $fin;
                    $year++;
                }
            }
        }

        // Update Group Capacity
        Group::updateElements($idGroup);

        return response()->json('true');
    }

    public function cancelAssignment($idElement)
    {
        $assignment = GroupElements::getAssignment($idElement);
        if (session()->get('user')) {
            $typeActivity = 1; // 0 = Ajout | 1 = Suppression | 2 = Modification | 3 = Réstauration | 10 = Suppression définitive
            $activityDescription = "L'Etudiant " . $assignment->nom_fr . " " . $assignment->prenom_fr . " (" . $assignment->matricule . ') du Group ' . $assignment->designation . " (ID = " . $assignment->idGroup . ")";
            Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription, session()->get('user')->name);
        }

        Payment::deleteDisactivatedPaiments($assignment->idGroup, $assignment->idStudent);
        Attendance::deleteGroupAttendancebyidElement($idElement);
        GroupElements::cancelAssignment($idElement);
        return Redirect::back()->with('deleteMessage', "L'étudiant a été retiré du groupe avec succès");
    }

    public function multipleCancelAssignment(Request $request)
    {
        foreach ($request->students as $student) {
        }
        GroupElements::cancelAssignment($student);
        return Redirect::back()->with('deleteMessage', "Les étudiants séléctionés ont été retirés du groupe avec succès");
    }
}
