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
    
}
