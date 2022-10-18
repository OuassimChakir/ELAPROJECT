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
        public function selectAbsence(){
            return $this::all();
        }
        public function checkAbsence($dateAbsence,$idGroup){
             return $this::where('dateAbsence',$dateAbsence)
                    ->where('idGroup',$idGroup)
                    ->count();
        }
        //          gt
        public function getOneAbsence($idAttendance){
            return $this::find($idAttendance);
        }
        // ------------ add Absence ------------//     
        public function insertAbsence(array $absence,array $matricule,$dateAbsence,$idGroup){

            if($this->checkAbsence($dateAbsence,$idGroup) == 0){
                for($i=0;$i<count($matricule);$i++)
                {
                    $datesave =[
                        'absence'=>$absence[$i],
                        'dateAbsence'=>$dateAbsence,
                        'matricule'=>$matricule[$i],
                        'idGroup'=>$idGroup,
                    ];
                    DB::table('Attendance')->insert($datesave);
                }
                return 'true';
            }
            else 
                return 'false';       
        }
        // ---------- Update absence ---------- //
        public function updateAbsence($idAttendance,$absence){
            $updatedAbsence = $this::find($idAttendance);
            $updatedAbsence->absence = $absence;
            $updatedAbsence->save();
        }

        public function selectListeAbsenceByDateIdgroup($dateAbsence,$idGroup){
            return $this::select('*')
                    ->join('students','students.matricule','=','attendance.matricule')
                    ->where('dateAbsence',$dateAbsence)
                    ->where('idGroup',$idGroup)
                    ->get();
       }
    
        // ---------- Total absence for Each Month in the Scolare Year ---------- //
        public function totalAbsenceMonth($firstYear,$secondYear){
           return DB::table('attendance')
                    ->selectRaw('count(idAttendance) AS absence, MONTH(dateAbsence) AS mois ,absence AS etatabsence')
                    ->whereYear("dateAbsence",$firstYear)
                    ->orWhereYear("dateAbsence",$secondYear)
                    ->whereRaw("MONTH(dateAbsence) BETWEEN '09' AND '12'")
                    ->orWhereRaw("MONTH(dateAbsence) BETWEEN '01' AND '08'")
                    ->groupByRaw("absence")
                    ->groupByRaw("MONTH(dateAbsence)")
                    ->get();
        }
        public function totalAbsenceDay($firstYear,$secondYear,$month){
            return DB::table('attendance')
                     ->selectRaw('count(idAttendance) AS absence, DAY(dateAbsence) AS day ,absence AS etatabsence')
                     ->whereMonth("dateAbsence",$month)
                     ->whereYear("dateAbsence",$firstYear)
                     ->orWhereYear("dateAbsence",$secondYear)
                     ->groupByRaw("DAY(dateAbsence),etatabsence")
                     ->get();
         }
            
}
