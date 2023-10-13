<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Attendance;
use App\Models\Courses\CourseType;
use App\Models\Courses\Subjects;
use App\Models\Emploi;
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
use Illuminate\Support\Facades\DB;
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
        // Filter Groups
        if ($request->has('filterGroups')) {
            if ($request->idGradeCategory != 0) {
                $groups = Group::getGroupsByGradeCategory($request->idGradeCategory);
                for ($i = 0; $i < $groups->count(); $i++)
                    $groups[$i]->grades = GroupGrades::getGroupGrades($groups[$i]->idGroup);
                return view('pages.groupes.groupes')
                    ->with('groupes', $groups)
                    ->with('gradesCategories', $gradesCategories)
                    ->with('professeurs', $professeurs)
                    ->with('subjects', $subjects)
                    ->with('idGradeCategory', $request->idGradeCategory)
                    ->with('courseTypes', $courseTypes);
            }
        }

        $role = Roles::getRole(Auth::user()->idRole);
        if ($role->codeRole == '22')
            $groups = Group::getStudentGroups(Auth::user()->idStudent);
        elseif ($role->codeRole == '33')
            $groups = Group::getProfGroups(Auth::user()->idProfesseur);
        else
            $groups = Group::getGroups();

        for ($i = 0; $i < $groups->count(); $i++)
            $groups[$i]->grades = GroupGrades::getGroupGrades($groups[$i]->idGroup);

        if ($request->has('CreateGroup')) {
            $matiere = Subjects::getSubject($request->idSubject);
            $gradeCategory = GradesCategory::getGradeCategory($request->gradeCategory);
            $designation = $gradeCategory->category . '-' . strtoupper($matiere->short) . '-G' . $request->nbGroup;
            if (!is_null($request->grades))
                if (count($request->grades) == 1) {
                    $grade = Grades::getGrade($request->grades[0]);
                    $designation = $grade->brev . '-' . $gradeCategory->category . '-' . strtoupper($matiere->short) . '-G' . $request->nbGroup;
                }
            $newGroup = Group::createGroup($designation, $request->capacity, $request->debutFormation, $request->finFormation, $request->amount, $request->idSubject, $request->idProfesseur);

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

    public function getGrade($idGradeCategory)
    {
        $gradeData['data'] = Grades::selectGradesByCategory($idGradeCategory);
        return response()->json($gradeData);
    }

    public function groupPage($idGroup)
    {
        $students = GroupElements::groupElements($idGroup);
        $paimentStudents = GroupElements::paimentStudents($idGroup);
        $absen = Attendance::selectAbsence();
        // Queries
        $gradesCategories = GradesCategory::getGradeCategories();

        $subjects = Subjects::getSubjects();
        $courseTypes = CourseType::selectCourses();
        $teachers = Professeurs::getProfesseurs();
        $groupInfo = Group::getGroup($idGroup);
        $groupGrades = GroupGrades::getGroupGrades($idGroup);
        // Logic
        $description = explode('-', $groupInfo->designation);
        $groupInfo->description = $description[2];
        if (isset($groupGrades[0]))
            $grades = Grades::selectGradesByCategory($groupGrades[0]->idGradeCategory);
        else
            $grades = Grades::selectGradesByCategory(null);

        $emploi = Emploi::getGroupEmploi($idGroup);

        $pendingOutElements = Payment::select('students.*')
            ->join('students','students.idStudent','=','payment.idStudent')
            ->leftJoin('groupelements','groupelements.idStudent','=','payment.idStudent')
            ->where('etat',0)
            ->where('payment.idGroup',$idGroup)
            ->whereNull('groupelements.idStudent')
            ->get();

        return view('pages.groupes.group')
            ->with('group', $groupInfo)
            ->with('paimentStudents', $paimentStudents)
            ->with('groupGrades', $groupGrades)
            ->with('gradesCategories', $gradesCategories)
            ->with('professeurs', $teachers)
            ->with('subjects', $subjects)
            ->with('grades', $grades)
            ->with('students', $students)
            ->with('courseTypes', $courseTypes)
            ->with('absen', $absen)
            ->with('pendingOutElements',$pendingOutElements)
            ->with('emploi', $emploi);
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
            Payment::where('idGroup', $idGroup)
                ->whereNull('etat')
                ->orWhere('etat', 2)
                ->forceDelete();

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
            Emploi::deleteEmploi($idGroup);
            Group::deleteGroup($idGroup);
            return response()->json(true);
        } elseif ($payments > 0) {
            return response()->json(false);
        }
        return response()->json(false);
    }

    // Update Group
    public function updateGroup(Request $request, $idGroup)
    {
        if ($request->has('updateGroup') && isset($idGroup)) {
            $matiere = Subjects::getSubject($request->idSubject);
            $gradeCategory = GradesCategory::getGradeCategory($request->gradeCategory);
            $designation = $gradeCategory->category . '-' . strtoupper($matiere->short) . '-G' . $request->nbGroup;
            if (!is_null($request->grades))
                if (count($request->grades) == 1) {
                    $grade = Grades::getGrade($request->grades[0]);
                    $designation = $grade->brev . '-' . $gradeCategory->category . '-' . strtoupper($matiere->short) . '-G' . $request->nbGroup;
                }

            Group::updateGroup($idGroup, $designation, $request->capacity, $request->amount, $request->debutFormation, $request->finFormation, $request->idSubject, $request->idProfesseur);

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
        $group = Group::getGroup($idGroup);
        if (is_null($group->debutFormation) || is_null($group->finFormation)) {
            return response()->json('null');
        }
        GroupElements::addElement($idGroup, $idStudent);
//        $debut = (int)explode('-', $group->debutFormation)[1];
//        $year = (int)explode('-', $group->debutFormation)[0];
//        if (date('Y-m-d') > $group->debutFormation) {
//            $debut = (int)date('m');
//            $year = (int)date('Y');
//        }
//        $fin = (int)explode('-', $group->finFormation)[1];
//        $breakpoint = $fin + 13;
////
//        for ($i = $debut; $i <= $breakpoint; $i++) {
//            $income = Income::getIncomeByDate($i);
//            // Log::info("Iterations ".$i." - idIncome ".$income->idIncome." - Result: ".Payment::checkElementPaiment($idGroup,$idStudent, $income->idIncome)." - idStudent: ".$idStudent." & idGroup ".$idGroup);
//            if (Payment::checkElementPaiment($idGroup, $idStudent, $income->idIncome) != 0)
//                continue;
//            else {
//                Payment::initialGroupPayment($group->amount, $income->description . ' - ' . $year, $idGroup, $idStudent, $income->idIncome);
//                if ($i == 12) {
//                    $i = 0;
//                    $breakpoint = $fin;
//                    $year++;
//                }
//            }
////        }


        return response()->json('true');
    }

    public function multipleCancelAssignment(Request $request)
    {
        foreach ($request->elements as $idElement) {
            $assignment = GroupElements::getAssignment($idElement);
            if (session()->get('user')) {
                $typeActivity = 1; // 0 = Ajout | 1 = Suppression | 2 = Modification | 3 = Réstauration | 10 = Suppression définitive
                $activityDescription = "L'Etudiant " . $assignment->nom_fr . " " . $assignment->prenom_fr . " (" . $assignment->matricule . ') du Group ' . $assignment->designation . " (ID = " . $assignment->idGroup . ")";
                Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription, session()->get('user')->name);
            }

            Payment::deleteDisactivatedPaiments($assignment->idGroup, $assignment->idStudent);
            Attendance::deleteGroupAttendancebyidElement($idElement);
            $group = Group::find($assignment->idGroup);
            Group::where('idGroup',$assignment->idGroup)->update([
                'nbElements' => $group->nbElements-count($request->elements)
            ]);
            GroupElements::cancelAssignment($idElement);
        }
        return Redirect::back()->with('deleteMessage', "Les étudiants séléctionés ont été retirés du groupe avec succès");
    }

    public function cancelAssignment($idElement)
    {
        $assignment = GroupElements::getAssignment($idElement);
        if (session()->get('user')) {
            $typeActivity = 1; // 0 = Ajout | 1 = Suppression | 2 = Modification | 3 = Réstauration | 10 = Suppression définitive
            $activityDescription = "L'Etudiant " . $assignment->nom_fr . " " . $assignment->prenom_fr . " (" . $assignment->matricule . ') du Group ' . $assignment->designation . " (ID = " . $assignment->idGroup . ")";
            Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription, session()->get('user')->name);
        }
        $group = Group::find($assignment->idGroup);
        Payment::deleteDisactivatedPaiments($assignment->idGroup, $assignment->idStudent);
        Attendance::deleteGroupAttendancebyidElement($idElement);
        Group::where('idGroup',$group->idGroup)->update([
            'nbElements' => $group->nbElements-1
        ]);
        GroupElements::cancelAssignment($idElement);
        return Redirect::back()->with('deleteMessage', "L'étudiant a été retiré du groupe avec succès");
    }

    public function searchNbGroup(Request $request)
    {
        $matiere = Subjects::getSubject($request->idSubject);
        $gradeCategory = GradesCategory::getGradeCategory($request->idGradeCategory);
        $designation = $gradeCategory->category . '-' . strtoupper($matiere->short) . '-G' . $request->nbGroupQuery;
        if ($request->has('grades'))
            if (count($request->grades) == 1) {
                $grade = Grades::getGrade($request->grades[0]);
                $designation = $grade->brev . '-' . $gradeCategory->category . '-' . strtoupper($matiere->short) . '-G' . $request->nbGroupQuery;
            }
        $output = 0;
        $data = DB::table('groups')->where('designation', $designation)->get();
        if (count($data) > 0) {
            $output = 1;
        }
        return response()->json($output);
    }
}
