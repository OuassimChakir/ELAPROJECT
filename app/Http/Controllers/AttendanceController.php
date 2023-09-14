<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Group;
use App\Models\GroupElements;
use Illuminate\Http\Request;
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
            for ($i=0; $i < count($request->students); $i++) { 
                $element = GroupElements::getElement($idGroup,$request->students[$i]);
                if(Attendance::checkAbsence($request->dateAbsence, $element->idElement) != 0){
                    $flag = 1;
                    break;
                }
                Attendance::markAttendance($request->absence[$i],$request->dateAbsence,$element->idElement);
            }
            if($flag == 1)
                return Redirect::back()->with('updateMessage', "L'absence de ce groupe était déjà marquée.");
            return Redirect::back()->with('successMessage', "L'ajout du Abssence est faite avec succès.");
        }
    }

    public function allAbsences(Request $request)
    {
        $allGroups = Group::selectGroup();
        if ($request->has('getAttendance')) {
            $students = GroupElements::groupElements($request->idGroup);
            for ($i=0; $i < count($students); $i++){
                $students[$i]->attendance = Attendance::getGroupAttendaceByDate($request->dateAbsence, $students[$i]->idElement);
                if($students[$i]->attendance->count() == 0) $students[$i]->attendance = null;
            }
            return view('pages.groupes.presence')->with([
                'allGroups' => $allGroups,
                'studentsAttendance' => $students,
                'dateAbsence' => explode('-',$request->dateAbsence),
            ]);
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
