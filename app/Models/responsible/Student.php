<?php

namespace App\Models\Responsible;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = "students";
    protected $primaryKey = "matricule";
    public $timestamps = false;
    // add new Staff Type
 /*   public function addStaffType($designation){
        $this->designation = $designation;
        $this->save();
    }

    // Select all Staff Type
    public function selectStaffType(){
        return $this::all();
    }

    // Delete Staff Type
    public function deleteStaffType($id){
        $this::find($id)->delete();
    }*/
    public function selectStudent(){
        return $this::all();
    }
}
