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

    public static function checkAbsence($dateAbsence, $idElement)
    {
        return Attendance::where('dateAbsence', $dateAbsence)
            ->where('idElement', $idElement)
            ->count();
    }

    //          gt
    public static function getOneAbsence($idAttendance)
    {
        return Attendance::find($idAttendance);
    }
    // ------------ add Absence ------------//     
    public static function markAttendance($absence, $dateAbsence, $idElement)
    {
        Attendance::insert([
            'absence' => $absence,
            'dateAbsence' => $dateAbsence,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'idElement' => $idElement,
        ]);
    }

    // ---------- Update absence ---------- //
    public static function updateAbsence($idAttendance, $absence)
    {
        $updatedAbsence = Attendance::find($idAttendance);
        $updatedAbsence->absence = $absence;
        $updatedAbsence->save();
    }

    public static function getGroupAttendaceByDate($dateAbsence, $idElement)
    {
        $date = explode('-',$dateAbsence);
        return Attendance::selectRaw('*, DAY(dateAbsence) as day')
            ->where('idElement', $idElement)
            ->whereRaw('MONTH(dateAbsence) = '.$date[1].' AND YEAR(dateAbsence) = '.$date[0])
            ->get();
    }
    // ---------- Total attendances in a month ---------- //
    public static function countAttendances($idElement, $month){
        return Attendance::select('*')
                ->where('idElement',$idElement)
                ->where('absence',0)
                ->whereRaw('MONTH(dateAbsence) = '.$month)
                ->count();
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
    public static function deleteGroupAttendance($idElement)
    {
        Attendance::where('idElement', $idElement)->delete();
    }
}
