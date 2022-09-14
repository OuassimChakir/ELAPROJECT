<?php

namespace App\Http\Controllers;

use App\Models\Classrooms;
use App\Models\Attendance;
use App\Models\Courses\CourseType;
use App\Models\Courses\Subjects;
use App\Models\Grades\Grades;
use App\Models\Grades\GradesCategory;
use App\Models\Group;
use App\Models\Responsible\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Student;

class GroupController extends Controller
{
    // Groups List
    public function groups(Request $request){
        $Group = new Group();
        $Staff = new Staff();
        $Subject = new Subjects();
        $CourseType = new CourseType();
        $GradesCategory = new GradesCategory();
        $Classroom = new Classrooms();

        $gradesCategories = $GradesCategory->getGradeCategories();
        $subjects = $Subject->getSubjects();
        $courseTypes = $CourseType->selectCourses();
        $teachers = $Staff->getProfesseurs();
        $groups = $Group->getGroups();
        foreach($groups as $group){
            $group->nbElement = $Classroom->classroomElements($group->idGroup);
        }
        if($request->has('CreateGroup')){
            $numGroups = $Group->getNumGroups($request->idSubject,$request->idGrade)+1;
            $matiere = $Subject->getSubject($request->idSubject);
            $designation = "G".$numGroups."-".$matiere->short;
            if(!is_null($request->description))
                $designation = "G".$numGroups."-".$matiere->short."-".$request->description;
            $Group -> createGroup($designation,$request->capacity, $request->idSubject,$request->idGrade,$request->idStaff);
            return Redirect::back() 
                ->with('successMessage',"La Creation du Groupe est faite avec succès");
        }
        return view('pages.groupes.groupes')
                ->with('groupes',$groups)
                ->with('gradesCategories',$gradesCategories)
                ->with('professeurs',$teachers)
                ->with('subjects',$subjects)
                ->with('courseTypes',$courseTypes)
                ;
    }

    public function groupPage(Request $request,$idGroup){
        // Creation of Objects
        $Group = new Group();
        $Staff = new Staff();
        $Subject = new Subjects();
        $CourseType = new CourseType();
        $GradesCategory = new GradesCategory();
        $Grade = new Grades();
        $Classroom = new Classrooms();
        $students = $Classroom->groupClassroom($idGroup);
        $Absence = new Attendance();
        $absen= $Absence->selectAbsence();
        // Queries
        $gradesCategories = $GradesCategory->getGradeCategories();
        
        $subjects = $Subject->getSubjects();
        $courseTypes = $CourseType->selectCourses();
        $teachers = $Staff->getProfesseurs();
        $groupInfo = $Group->getGroup($idGroup);

        // Logic
        $groupInfo->nbElements = $Classroom->classroomElements($idGroup);
        $description = explode('-',$groupInfo->designation);
        $groupInfo->description = $description[2];
        $groupInfo->idGradeCategory = $Grade->getGrade($groupInfo->idGrade)->idGradeCategory;
        $grades = $Grade->selectGradesByCategory($groupInfo->idGradeCategory);
        return view('pages.groupes.group')
            ->with('group',$groupInfo)
            ->with('gradesCategories',$gradesCategories)
            ->with('professeurs',$teachers)
            ->with('subjects',$subjects)
            ->with('niveaux',$grades)
            ->with('students',$students)
            ->with('courseTypes',$courseTypes)
            ->with('absen',$absen);
    }

    public function getGrade($idGradeCategory){
        $Grade = new Grades();
        $gradeData['data'] = $Grade->selectGradesByCategory($idGradeCategory);
        return response()->json($gradeData);
    }

    //  DELETION 
    public function deleteGroup($idGroup){
        $Group = new Group();
        $Group->deleteGroup($idGroup);
        return Redirect::back()->with('deleteMessage',"La Suppression du Groupe est faite avec succès");
    }

    // Update Group
    public function updateGroup(Request $request,$idGroup){
        if($request->has('updateGroup') && isset($idGroup)){
            $Group = new Group();
            $Subject = new Subjects();
            $groupName = explode('-',$Group->getGroup($idGroup)->designation)[0];
            $matiere = $Subject->getSubject($request->idSubject);
            $designation = $groupName."-".$matiere->short;
            if(!is_null($request->description))
                $designation .= "-".$request->description;
            $Group->updateGroup($idGroup,$designation,$request->capacity,$request->idSubject,$request->idGrade,$request->idStaff);
            return Redirect::back()->with('updateMessage','La Modification du Groupe est faite avec Succès');
        }
    }

    public function cancelAssignment($id){
        $Classroom = new Classrooms();
        $Classroom->cancelAssignment($id);
        return Redirect::back()->with('deleteMessage',"L'étudiant a été retiré du groupe avec succès");
    }

    public function multipleCancelAssignment(Request $request){
        $Classroom = new Classrooms();
        foreach($request->students as $student)
            $Classroom->cancelAssignment($student);
        return Redirect::back()->with('deleteMessage',"Les étudiants séléctionés ont été retirés du groupe avec succès");
    }
    
    //----------------add absence---------------// 
    public function addAbsence(Request $request){
        if($request->has('addabssence')){
        $Absence = new Attendance();
        $absence = $request->absence;
        $dateAbsence = $request->dateAbsence;
        $matricule = $request->matricule;
        $idGroup = $request->idGroup;
        $result = $Absence->insertAbsence($absence,$matricule,$dateAbsence,$idGroup);
        if($result == 'true')
            return Redirect::back()->with('successMessage',"L'ajout du Abssence est faite avec succès");
        else
            return Redirect::back()->with('updateMessage',"L'absence de ce groupe était déjà marquée.");
        }
    }
    public function allAbsences(Request $request){
        $Absence = new Attendance();
        $Group = new Group(); 
        $allGroups=$Group->selectGroup();
        if($request->has('getAbsence')){
            $dateAbsence = $request->dateAbsence;
            $idGroup = $request->idGroup;
            $etudiants = $Absence->selectListeAbsenceByDateIdgroup($dateAbsence,$idGroup);
            return view('pages.groupes.presence')->with('allGroups',$allGroups)->with('etudiants',$etudiants);
        }
        return view('pages.groupes.presence')->with('allGroups',$allGroups);
        
    }
    //-------- liste absence by date and idGroup
    public function getListeAbsence($dateAbsence,$idGroup){
        $Grade = new Attendance();
        $gradeData['data'] = $Grade->selectListeAbsenceByDateIdgroup($dateAbsence,$idGroup);
        return response()->json($gradeData);
    }
    // ----------------Update Absence
    public function updateAbsence(Request $request,$idAttendance){
        $absence = new Attendance();
        $Absence = $absence->getProfesseur($idAttendance);
        if($request->has('modifierAbsence')){
            $absence->updateProfesseur($idAttendance,$request->absence,$request->dateAbsence,$request->matricule,$request->idGroup);
            return Redirect::back()
                ->with('updateMessage',"La Modification est faite avec succès")
                ->with('Absence',$Absence);
        }
    }

}