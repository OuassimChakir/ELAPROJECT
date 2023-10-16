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

    public static function checkAbsence($dateAbsence, $idGroup, $idStudent)
    {
        return Attendance::where('dateAbsence', $dateAbsence)
            ->where('idGroup', $idGroup)
            ->where('idStudent', $idStudent)
            ->count();
    }

    //          gt
    public static function getAttendance($idAttendance)
    {
        return Attendance::select('*')
                ->join('students','students.idStudent','=','attendance.idStudent')
                ->where('idAttendance',$idAttendance)
                ->first();
    }

    public static function getGroupAttendanceByDate($dateAbsence, $idStudent, $idGroup)
    {
        $date = explode('-',$dateAbsence);
        return Attendance::selectRaw('*, DAY(dateAbsence) as day')
            ->join('students','students.idStudent','=','attendance.idStudent')
            ->where('idGroup', $idGroup)
            ->where('attendance.idStudent', $idStudent)
            ->whereRaw('MONTH(dateAbsence) = '.$date[1].' AND YEAR(dateAbsence) = '.$date[0])
            ->get();
    }

    public static function getAttendanceStudents($dateAbsence, $idGroup){
        $date = explode('-',$dateAbsence);
        return Attendance::selectRaw('students.*')
            ->join('students','students.idStudent','=','attendance.idStudent')
            ->where('idGroup', $idGroup)
            ->whereRaw('MONTH(dateAbsence) = '.$date[1].' AND YEAR(dateAbsence) = '.$date[0])
            ->groupBy('students.idStudent')
            ->get();
    }

    public static function studentLastestAttendances($idStudent){
        return Attendance::select('*')
            ->join('groups','groups.idGroup','=','attendance.idGroup')
            ->where('idStudent',$idStudent)
            ->orderBy('dateAbsence','DESC')
            ->skip(0)
            ->take(20)
            ->get();
    }

    // ------------ add Absence ------------//
    public static function markAttendance($absence, $dateAbsence, $idGroup, $idStudent)
    {
        Attendance::insert([
            'absence' => $absence,
            'dateAbsence' => $dateAbsence,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'idStudent' => $idStudent,
            'idGroup' => $idGroup,
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
    public static function countAttendances($idStudent, $idGroup, $month){
        return Attendance::select('*')
                ->where('idStudent',$idStudent)
                ->where('idGroup',$idGroup)
                ->where('absence',0)
                ->whereRaw('MONTH(dateAbsence) = '.$month)
                ->count();
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
    public static function deleteGroupAttendancebyidElement($idGroup, $idStudent)
    {
        Attendance::where('idStudent', $idStudent)
            ->where('idGroup',$idGroup)
            ->delete();
    }


    public static function deleteGroupAttendancebyidStudent($idStudent){
        Attendance::select('*')
            ->where('idStudent', $idStudent)
            ->delete();
    }

    public static function deleteGroupAttendancebyidGroup($idGroup){
        Attendance::select('*')
            ->where('idGroup', $idGroup)
            ->delete();
    }
}
