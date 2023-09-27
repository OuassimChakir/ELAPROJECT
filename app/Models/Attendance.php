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
    public static function getAttendance($idAttendance)
    {
        return Attendance::select('*')
                ->join('groupelements','groupelements.idElement','=','attendance.idElement')
                ->join('students','students.idStudent','=','groupelements.idStudent')
                ->where('idAttendance',$idAttendance)
                ->first();
    }

    public static function getGroupAttendanceByDate($dateAbsence, $idElement)
    {
        $date = explode('-',$dateAbsence);
        return Attendance::selectRaw('*, DAY(dateAbsence) as day')
            ->where('idElement', $idElement)
            ->whereRaw('MONTH(dateAbsence) = '.$date[1].' AND YEAR(dateAbsence) = '.$date[0])
            ->get();
    }

    public static function studentLastestAttendances($idStudent){
        return Attendance::select('*')
            ->join('groupelements','groupelements.idElement','=','attendance.idElement')
            ->join('groups','groups.idGroup','=','groupelements.idGroup')
            ->where('idStudent',$idStudent)
            ->orderBy('dateAbsence','DESC')
            ->skip(0)
            ->take(20)
            ->get();
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
    public static function updateAbsence($idAttendance, $absence, $dateAbsence)
    {
        Attendance::where('idAttendance',$idAttendance)->update([
            'absence' => $absence,
            'dateAbsence' => $dateAbsence,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
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


    public static function totalAbsenceDay($currentYear, $month)
    {
        return Attendance::selectRaw('count(idAttendance) AS absence, DAY(dateAbsence) AS day ,absence AS etatabsence')
            ->whereMonth("dateAbsence", $month)
            ->whereYear("dateAbsence", $currentYear)
            ->groupByRaw("DAY(dateAbsence),etatabsence")
            ->get();
    }

    /* ---------------------------------
    /  Delete Attendance by Group
    /----------------------------------*/
    public static function deleteGroupAttendance($idAttendance)
    {
        Attendance::find($idAttendance)->delete();
    }
    /* ---------------------------------
    /  Delete Attendance by Group Element
    /----------------------------------*/
    public static function deleteGroupAttendancebyidElement($idElement)
    {
        Attendance::where('idElement', $idElement)->delete();
    }


    public static function deleteGroupAttendancebyidStudent($idStudent){
        Attendance::select('*')
            ->join('groupelements','groupelements.idElement','=','attendance.idElement')
            ->where('groupelements.idStudent', $idStudent)
            ->delete();
    }

    public static function deleteGroupAttendancebyidGroup($idGroup){
        Attendance::select('*')
            ->join('groupelements','groupelements.idElement','=','attendance.idElement')
            ->where('groupelements.idGroup', $idGroup)
            ->delete();
    }
}
