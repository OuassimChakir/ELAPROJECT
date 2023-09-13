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
use App\Models\responsible\Professeurs;
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
        $Groups = Professeurs::getProfesseurs();
        $groups = Group::getGroups();
        if ($request->has('CreateGroup')) {
            $numGroups = Group::getNumGroups($request->idSubject, $request->idProfesseur) + 1;
            $matiere = Subjects::getSubject($request->idSubject);
            $gradeCategory = GradesCategory::getGradeCategory($request->gradeCategory);
            $designation = $gradeCategory->category.'-'.$matiere->short.'-G'.$numGroups;
            $newGroup = Group::createGroup($designation, $request->capacity, $request->amount, $request->idSubject, $request->idProfesseur);

            foreach ($request->grades as $idGrade)
                GroupGrades::newGroupGrade($idGrade,$newGroup);
            

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
            ->with('professeurs', $Groups)
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
        $grades = Grades::selectGradesByCategory($groupGrades[0]->idGradeCategory);
        return view('pages.groupes.group')
            ->with('group', $groupInfo)
            ->with('groupGrades',$groupGrades)
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
        if (session()->get('user')) {
            $groupInfo = Group::getGroup($idGroup);
            $typeActivity = 1; // 0 = Ajout | 1 = Suppression | 2 = Modification | 3 = Réstauration | 10 = Suppression définitive
            $activityDescription = "Le Groupe " . $groupInfo->designation . " (ID = " . $groupInfo->idGroup . ")";
            Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription,session()->get('user')->name);
        }
        Attendance::deleteGroupAbsence($idGroup);
        GroupElements::deleteGroupClassroom($idGroup);
        Group::deleteGroup($idGroup);

        return Redirect::back()->with('deleteMessage', "La Suppression du Groupe est faite avec succès");
    }

    // Update Group
    public function updateGroup(Request $request, $idGroup)
    {
        if ($request->has('updateGroup') && isset($idGroup)) {
            $group = Group::getGroup($idGroup);
            Group::updateGroup($idGroup, $request->capacity,$request->amount, $request->idSubject, $request->idProfesseur);
            GroupGrades::deleteGroupGrades($idGroup);

            foreach ($request->grades as $idGrade)
                GroupGrades::newGroupGrade($idGrade,$idGroup);

            if (session()->get('user')) {
                $typeActivity = 2; // 0 = Ajout | 1 = Suppression | 2 = Modification | 3 = Réstauration | 10 = Suppression définitive
                $activityDescription = "Le Groupe " . $group->designation . " (ID = " . $idGroup . ")";
                Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription,session()->get('user')->name);
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
        $debut = (int)explode('-',$group->debutFormation)[1];
        $year = (int)explode('-',$group->debutFormation)[0];
        if(date('Y-m-d') > $group->debutFormation){
            $debut = (int)date('m');
            $year = (int)date('Y');
        }
        $fin = (int)explode('-',$group->finFormation)[1];
        $breakpoint = $fin + 13;
        
        for ($i = $debut; $i <= $breakpoint; $i++){
            $income = Income::getIncomeByDate($i);
            Payment::initialPayment($group->amount,$income->description.' - '.$year,$idStudent,$income->idIncome);
            if($i == 12){
                $i = 0;
                $breakpoint = $fin;
                $year++;
            }
        }

        // Update Group Capacity
        Group::updateElements($idGroup);

        return response()->json('true');
    }

    public function cancelAssignment($idElement)
    {
        if (session()->get('user')) {
            $assignment = GroupElements::getAssignment($idElement);
            $typeActivity = 1; // 0 = Ajout | 1 = Suppression | 2 = Modification | 3 = Réstauration | 10 = Suppression définitive
            $activityDescription = "L'Etudiant " . $assignment->nom_fr . " " . $assignment->prenom_fr . " (" . $assignment->matricule . ') du Group ' . $assignment->designation . " (ID = " . $assignment->idGroup . ")";
            Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription,session()->get('user')->name);
        }
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

        // ----------- ARCHIVE ------------- //
        public function archive(){
            $group = Group::softDeletedGroups();
            return view('pages.groupes.groupArchive')->with('group',$group);
        }
    
        public function archivedGroup($idGroup){
            $Group = Group::softDeletedGroups($idGroup);
            return view('pages.Groups.archivedGroupProfil')->with('Group',$Group);
        }
    
        public function restoreArchivedGroup($idGroup){
            Group::restoreGroup($idGroup);
            $Groups = Group::softDeletedGroups();
            $group=Group::getGroup($idGroup);
            if(session()->get('user')){
                $typeActivity = 3; 
                $activityDescription = 'Le profisseur'." ".$group->nom." ".$group->prenom ." (".$group->idGroup.")"; 
                Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription,session()->get('user')->name);
            }
            return Redirect::route('Groups.archive')->with('restoreMessage',"Le Professeur a été restorer avec succès")->with('Groups',$Groups);
        }
    
        public function deleteArchivedGroup($idGroup){
            $group=Group::softDeletedGroups($idGroup);
            if(session()->get('user')){
                $typeActivity = 10; 
                $activityDescription = 'Le profisseur'." ".$group->nom." ".$group->prenom ."(".$group->idGroup.")"; 
                Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription,session()->get('user')->name);
            }
            GroupElements::deleteGroupClassroom($idGroup);
            Group::forceDeleteGroup($idGroup);
            
            return Redirect::back()->with('deleteMessage',"Le Professeur a été supprimer Définitivement");
        }
}
