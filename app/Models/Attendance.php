<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table = "attendance";
    protected $primaryKey = "idAttendance";

    //------------- select Absence----------//
    public static function selectAbsence()
    {
        return Attendance::all();
    }

    public static function checkAbsence($dateAbsence, $idGroup)
    {
        return Attendance::where('dateAbsence', $dateAbsence)
            ->where('idGroup', $idGroup)
            ->count();
    }

    //          gt
    public static function getOneAbsence($idAttendance)
    {
        return Attendance::find($idAttendance);
    }
    // ------------ add Absence ------------//     
    public static function insertAbsence(array $absence, array $matricule, $dateAbsence, $idGroup)
    {
        if (Attendance::checkAbsence($dateAbsence, $idGroup) == 0) {
            for ($i = 0; $i < count($matricule); $i++) {
                $datesave = [
                    'absence' => $absence[$i],
                    'dateAbsence' => $dateAbsence,
                    'matricule' => $matricule[$i],
                    'idGroup' => $idGroup,
                ];
                DB::table('Attendance')->insert($datesave);
            }
            return 'true';
        } else
            return 'false';
    }

    // ---------- Update absence ---------- //
    public static function updateAbsence($idAttendance, $absence)
    {
        $updatedAbsence = Attendance::find($idAttendance);
        $updatedAbsence->absence = $absence;
        $updatedAbsence->save();
    }

    public static function selectListeAbsenceByDateIdgroup($dateAbsence, $idGroup)
    {
        return Attendance::select('*')
            ->join('students', 'students.idStudent', '=', 'attendance.idStudent')
            ->where('dateAbsence', $dateAbsence)
            ->where('idGroup', $idGroup)
            ->get();
    }

    // ---------- Total absence for Each Month in the Scolare Year ---------- //
    public static function totalAbsenceMonth($firstYear, $secondYear)
    {
        return DB::table('attendance')
            ->selectRaw('count(idAttendance) AS absence, MONTH(dateAbsence) AS mois ,absence AS etatabsence')
            ->whereYear("dateAbsence", $firstYear)
            ->orWhereYear("dateAbsence", $secondYear)
            ->whereRaw("MONTH(dateAbsence) BETWEEN '09' AND '12'")
            ->orWhereRaw("MONTH(dateAbsence) BETWEEN '01' AND '08'")
            ->groupByRaw("absence")
            ->groupByRaw("MONTH(dateAbsence)")
            ->get();
    }


    public static function totalAbsenceDay($firstYear, $secondYear, $month)
    {
        return DB::table('attendance')
            ->selectRaw('count(idAttendance) AS absence, DAY(dateAbsence) AS day ,absence AS etatabsence')
            ->whereMonth("dateAbsence", $month)
            ->whereYear("dateAbsence", $firstYear)
            ->orWhereYear("dateAbsence", $secondYear)
            ->groupByRaw("DAY(dateAbsence),etatabsence")
            ->get();
    }

    /* ---------------------------------
    /  Delete Attendance by Group
    /----------------------------------*/
    public static function deleteGroupAbsence($idGroup)
    {
        Attendance::where('idGroup', $idGroup)->delete();
    }
}
