<?php

namespace App\Models\Responsible;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stafftype extends Model
{
    use HasFactory;
    protected $table = "stafftype";
    protected $primaryKey = "idStaffType";
    public $timestamps = false;
    // add new Staff Type
   public function addStaffType($designation){
        $this->designation = $designation;
        $this->save();
    }

    public function updateStaffType($id,$designation){
        $staffType = $this::find($id);
        $staffType->designation = $designation;
        $staffType->save();
    }
    public function deleteStaffType($id){
        $this::find($id)->delete();
    }
    public function getStaffTypes(){
        return $this::all();
    }
    public function getStaffType($id){
        return $this::find($id);
    }
}
