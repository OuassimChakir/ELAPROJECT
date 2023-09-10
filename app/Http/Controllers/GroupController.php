<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Classrooms;
use App\Models\Attendance;
use App\Models\Courses\CourseType;
use App\Models\Courses\Subjects;
use App\Models\Grades\Grades;
use App\Models\Grades\GradesCategory;
use App\Models\Group;
use App\Models\responsible\Professeurs;
use App\Models\Responsible\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class GroupController extends Controller
{ 
    // Groups List
    public function groups(Request $request)
    {
        $gradesCategories = GradesCategory::getGradeCategories();
        $subjects = Subjects::getSubjects();
        $courseTypes = CourseType::selectCourses();
        $teachers = Professeurs::getProfesseurs();
        $groups = Group::getGroups();
        foreach ($groups as $group) {
            $group->nbElement = Classrooms::classroomElements($group->idGroup);
        }
        if ($request->has('CreateGroup')) {
            $numGroups = Group::getNumGroups($request->idSubject, $request->idGrade) + 1;
            $matiere = Subjects::getSubject($request->idSubject);
            $designation = "G" . $numGroups . "-" . $matiere->short;

            if (!is_null($request->description))
                $designation = "G" . $numGroups . "-" . $matiere->short . "-" . $request->description;
            Group::createGroup($designation, $request->capacity, $request->idSubject, $request->idGrade, $request->idStaff);
            if (session()->get('user')) {
                $typeActivity = 0; // 0 = Ajout | 1 = Suppression | 2 = Modification | 3 = Réstauration | 10 = Suppression définitive
                $activityDescription = "Le Groupe " . $designation;
                Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription,session()->get('user')->name);
            }
            return Redirect::back()
                ->with('successMessage', "La Creation du Groupe est faite avec succès");
        }
        return view('pages.groupes.groupes')
            ->with('groupes', $groups)
            ->with('gradesCategories', $gradesCategories)
            ->with('professeurs', $teachers)
            ->with('subjects', $subjects)
            ->with('courseTypes', $courseTypes);
    }

    public function groupPage($idGroup)
    {
        $students = Classrooms::groupClassroom($idGroup);
        $absen = Attendance::selectAbsence();
        // Queries
        $gradesCategories = GradesCategory::getGradeCategories();

        $subjects = Subjects::getSubjects();
        $courseTypes = CourseType::selectCourses();
        $teachers = Staff::getProfesseurs();
        $groupInfo = Group::getGroup($idGroup);

        // Logic
        $groupInfo->nbElements = Classrooms::classroomElements($idGroup);
        $description = explode('-', $groupInfo->designation);
        $groupInfo->description = $description[2];
        $groupInfo->idGradeCategory = Grades::getGrade($groupInfo->idGrade)->idGradeCategory;
        $grades = Grades::selectGradesByCategory($groupInfo->idGradeCategory);
        return view('pages.groupes.group')
            ->with('group', $groupInfo)
            ->with('gradesCategories', $gradesCategories)
            ->with('professeurs', $teachers)
            ->with('subjects', $subjects)
            ->with('niveaux', $grades)
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
        if (session()->get('user')) {
            $groupInfo = Group::getGroup($idGroup);
            $typeActivity = 1; // 0 = Ajout | 1 = Suppression | 2 = Modification | 3 = Réstauration | 10 = Suppression définitive
            $activityDescription = "Le Groupe " . $groupInfo->designation . " (ID = " . $groupInfo->idGroup . ")";
            Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription,session()->get('user')->name);
        }
        Attendance::deleteGroupAbsence($idGroup);
        Classrooms::deleteGroupClassroom($idGroup);
        Group::deleteGroup($idGroup);

        return Redirect::back()->with('deleteMessage', "La Suppression du Groupe est faite avec succès");
    }

    // Update Group
    public function updateGroup(Request $request, $idGroup)
    {
        if ($request->has('updateGroup') && isset($idGroup)) {

            $groupName = explode('-', Group::getGroup($idGroup)->designation)[0];
            $matiere = Subjects::getSubject($request->idSubject);
            $designation = $groupName . "-" . $matiere->short;
            if (!is_null($request->description))
                $designation .= "-" . $request->description;
            Group::updateGroup($idGroup, $designation, $request->capacity, $request->idSubject, $request->idGrade, $request->idStaff);
            if (session()->get('user')) {
                $typeActivity = 2; // 0 = Ajout | 1 = Suppression | 2 = Modification | 3 = Réstauration | 10 = Suppression définitive
                $activityDescription = "Le Groupe " . $designation . " (ID = " . $idGroup . ")";
                Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription,session()->get('user')->name);
            }
            return Redirect::back()->with('updateMessage', 'La Modification du Groupe est faite avec Succès');
        }
    }

    public function cancelAssignment($id)
    {
        if (session()->get('user')) {
            $assignment = Classrooms::getAssignment($id);
            $typeActivity = 1; // 0 = Ajout | 1 = Suppression | 2 = Modification | 3 = Réstauration | 10 = Suppression définitive
            $activityDescription = "L'Etudiant " . $assignment->nom_fr . " " . $assignment->prenom_fr . " (" . $assignment->matricule . ') du Group ' . $assignment->designation . " (ID = " . $assignment->idGroup . ")";
            Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription,session()->get('user')->name);
        }
        Classrooms::cancelAssignment($id);
        return Redirect::back()->with('deleteMessage', "L'étudiant a été retiré du groupe avec succès");
    }

    public function multipleCancelAssignment(Request $request)
    {
        foreach ($request->students as $student) {
        }
        Classrooms::cancelAssignment($student);
        return Redirect::back()->with('deleteMessage', "Les étudiants séléctionés ont été retirés du groupe avec succès");
    }

    //----------------add absence---------------// 
    public function addAbsence(Request $request)
    {
        if ($request->has('addabssence')) {
            $absence = $request->absence;
            $dateAbsence = $request->dateAbsence;
            $matricule = $request->matricule;
            $idGroup = $request->idGroup;
            $result = Attendance::insertAbsence($absence, $matricule, $dateAbsence, $idGroup);
            if ($result == 'true')
                return Redirect::back()->with('successMessage', "L'ajout du Abssence est faite avec succès");
            else
                return Redirect::back()->with('updateMessage', "L'absence de ce groupe était déjà marquée.");
        }
    }
    public function allAbsences(Request $request)
    {
        $allGroups = Group::selectGroup();
        if ($request->has('getAbsence')) {
            $dateAbsence = $request->dateAbsence;
            $idGroup = $request->idGroup;
            $etudiants = Attendance::selectListeAbsenceByDateIdgroup($dateAbsence, $idGroup);
            return view('pages.groupes.presence')->with('allGroups', $allGroups)->with('etudiants', $etudiants);
        }
        return view('pages.groupes.presence')->with('allGroups', $allGroups);
    }
    //-------- liste absence by date and idGroup
    public function getListeAbsence($dateAbsence, $idGroup)
    {
        $gradeData['data'] = Attendance::selectListeAbsenceByDateIdgroup($dateAbsence, $idGroup);
        return response()->json($gradeData);
    }
    // ---------------- Update Absence -------------- //
    public function updateAbsence($idAttendance, $absence)
    {
        Attendance::updateAbsence($idAttendance, $absence);
        $absenceData['data'] = Attendance::getOneAbsence($idAttendance);
        return response()->json($absenceData);
    }
}
