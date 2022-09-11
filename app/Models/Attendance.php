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


        // ------------ add Absence ------------//     
        public function insertAbsence(array $absence,array $matricule,$dateAbsence,$idGroup){
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
        }
        //------------- select Absence----------//
        public function selectAbsence(){
            return $this::all();
        }
    
}
