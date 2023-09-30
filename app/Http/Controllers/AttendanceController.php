<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Attendance;
use App\Models\Group;
use App\Models\GroupElements;
use App\Models\Incomes\Income;
use App\Models\Incomes\Payment;
use App\Models\Responsible\Student;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AttendanceController extends Controller
{
    /* --------------------------------------
    / Attendance (Absence)
    / ---------------------------------------*/

    public function addAbsence(Request $request,$idGroup)
    {
        if ($request->has('markAttendance')) {
            $flag = 0;
            $date = explode('-',$request->dateAbsence);
            $income = Income::getIncomeByDate($date[1]);
            if(session()->get('user')){
                $typeActivity = 0; 
                $activityDescription = "l'absence de groupe"." "."(".$idGroup.")"." "."par"." ".session()->get('user')->name; 
                Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription,session()->get('user')->name);
            }
            for ($i=0; $i < count($request->students); $i++) { 
                $element = GroupElements::getElement($idGroup,$request->students[$i]);
                if(Attendance::checkAbsence($request->dateAbsence, $element->idElement) != 0){
                    $flag = 1;
                    break;
                }
                Attendance::markAttendance($request->absence[$i],$request->dateAbsence,$element->idElement);
                if(Attendance::countAttendances($element->idElement, $date[1]) >= 2){
                    $paiment = Payment::selectPayment($idGroup, $element->idStudent,$income->idIncome);
                    if(is_null($paiment->etat))
                        Payment::activatePaiment($element->idGroup,$element->idStudent, $date[1]);  
                }
            }

            // Reset Paiments


            if($flag == 1)
                return Redirect::back()->with('updateMessage', "L'absence de ce groupe était déjà marquée.");
            return Redirect::back()->with('successMessage', "L'ajout du Abssence est faite avec succès.");
        }
    }

    public function allAbsences(Request $request)
    {
        $role = Roles::getRole(Auth::user()->idRole);
        if($role->codeRole == '22')
            $allGroups = Group::getStudentGroups(Auth::user()->idStudent);
        elseif($role->codeRole == '33')
            $allGroups = Group::getProfGroups(Auth::user()->idProfesseur);
        else
            $allGroups = Group::selectGroup();
        if ($request->has('getAttendance')) {
            if($role->codeRole != '22'){
                $students = GroupElements::groupElements($request->idGroup);
                for ($i=0; $i < count($students); $i++){
                    $students[$i]->attendance = Attendance::getGroupAttendanceByDate($request->dateAbsence, $students[$i]->idElement);
                    if($students[$i]->attendance->count() == 0) $students[$i]->attendance = null;
                }
                return view('pages.groupes.presence')->with([
                    'groups' => $allGroups,
                    'idGroup' => $request->idGroup,
                    'studentsAttendance' => $students,
                    'dateAbsence' => explode('-',$request->dateAbsence),
                ]);
            }else{
                $student = Student::getStudent(Auth::user()->idStudent);
                $element = GroupElements::getElement($request->idGroup,$student->idStudent);
                $student->attendance =  Attendance::getGroupAttendanceByDate($request->dateAbsence, $element->idElement);
                if($student->attendance->count() == 0) $student->attendance = null;
                return view('pages.groupes.presence')->with([
                    'groups' => $allGroups,
                    'idGroup' => $request->idGroup,
                    'student' => $student,
                    'dateAbsence' => explode('-',$request->dateAbsence),
                ]);
            }


        }
        return view('pages.groupes.presence')->with('groups', $allGroups);
    }


    //-------- liste absence by date and idGroup
    public function getListeAbsence($dateAbsence, $idGroup)
    {
        $gradeData['data'] = Attendance::selectListeAbsenceByDateIdgroup($dateAbsence, $idGroup);
        return response()->json($gradeData);
    }

    public function getAttendanceMonthDates($idGroup,$dateAbsence){
        $date = explode('-',$dateAbsence);
        $response = Attendance::select('dateAbsence')
                            ->join('groupelements','groupelements.idElement','=','attendance.idElement')
                            ->where('idGroup',$idGroup)
                            ->whereRaw('MONTH(dateAbsence) = '.$date[1].' AND YEAR(dateAbsence) = '.$date[0])
                            ->groupBy('dateAbsence')
                            ->orderBy('dateAbsence')
                            ->get();
        return response()->json($response);
    }
    // ---------------- Update Absence -------------- //
    public function updateAttendanceAjax($idGroup, $dateAbsence)
    {
        $response = Attendance::select('*')
                    ->join('groupelements','groupelements.idElement','=','attendance.idElement')
                    ->join('students','students.idStudent','=','groupelements.idStudent')
                    ->where('idGroup',$idGroup)
                    ->where('dateAbsence',$dateAbsence)
                    ->get();
                    
        return response()->json($response);
    }

    public function updateAttendance(Request $request){
        if($request->has('updateAttendance')){
            $income = Income::getIncomeByDate(explode('-',$request->deletionDateAbsence)[1]);
            if(session()->get('user')){
                $typeActivity = 2; 
                $activityDescription = "l'absence de groupe"." "."(".$request->idGroup.")"." "."par"." ".session()->get('user')->name;
                Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription,session()->get('user')->name);
            }
            for ($i=0; $i < count($request->attendances); $i++) {
                Attendance::updateAbsence($request->attendances[$i], $request->absence[$i],$request->dateAbsence);
                // Disactivated Payment if the absence was deleted
                $student = Attendance::getAttendance($request->attendances[$i]);
                $paiment = Payment::getElementActivatedPaiment($request->idGroup,$student->idStudent,$income->idIncome);
                if(is_null($paiment) && Attendance::countAttendances($student->idElement,explode('-',$request->dateAbsence)[1]) >= 2)
                    Payment::activatePaiment($request->idGroup,$student->idStudent,explode('-',$request->dateAbsence)[1]);
                elseif($paiment->count() > 0 && Attendance::countAttendances($student->idElement,explode('-',$request->dateAbsence)[1]) < 2)
                    Payment::disactivatePaiment($paiment->idPayment);
            }
            return Redirect::back()->with('successMessage', "Mise à jour des présences réussie !");

        }
        return Redirect::back()->with('deleteMessage', "Une erreur s'est produite");
    }
    // Delete Attendance
    public function deleteAttendance(Request $request){
        if($request->has('deleteAttendance')){
            $income = Income::getIncomeByDate(explode('-',$request->deletionDateAbsence)[1]);
            if(session()->get('user')){
                $typeActivity = 1; 
                $activityDescription = "l'absence de groupe"." "."(".$request->idGroup.")"." "."par"." ".session()->get('user')->name;
                Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription,session()->get('user')->name);
            }
            for ($i=0; $i < count($request->attendances); $i++) {
                // Delete Attendance
                $student = Attendance::getAttendance($request->attendances[$i]);
                Attendance::deleteGroupAttendance($request->attendances[$i]);
                // Disactivated Payment if the absence was deleted
                $paiment = Payment::getElementActivatedPaiment($request->idGroup,$student->idStudent,$income->idIncome);
                if(!is_null($paiment))
                    if($paiment->count() > 0 && Attendance::countAttendances($student->idElement,explode('-',$request->deletionDateAbsence)[1]) < 2)
                        Payment::disactivatePaiment($paiment->idPayment);
                
            }
            return Redirect::back()->with('successMessage', "Présences supprimées avec succès");
        }
        return Redirect::back()->with('deleteMessage', "Une erreur s'est produite");
    }
}
