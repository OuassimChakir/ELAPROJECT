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
   public  function addStaffType($designation){
        $this->designation = $designation;
        $this->save();
    }

    public static function updateStaffType($id,$designation){
        $staffType = Stafftype::find($id);
        $staffType->designation = $designation;
        $staffType->save();
    }
    public static function deleteStaffType($id){
        Stafftype::find($id)->delete();
    }
    public static function getStaffTypes(){
        return Stafftype::all();
    }
    public static function getStaffType($id){
        return Stafftype::find($id);
    }
}
