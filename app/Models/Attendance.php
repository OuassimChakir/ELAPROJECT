<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table = "attendance";
    protected $primaryKey = "idAttendance";


        // ------------ add Absence ------------//     
        public function addAbsence($absence,$dateAbsence,$matricule,$idGroup){
            $this->absence=$absence;
            $this->dateAbsence=$dateAbsence;    
            $this->matricule=$matricule;
            $this->idGroup=$idGroup;
            $this->save();
        } 
        //------------- select Absence----------//
        public function selectAbsence(){
            return $this::all();
        }
    
}
