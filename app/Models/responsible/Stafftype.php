<?php

namespace App\Models;

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

    // Select all Staff Type
    public function selectStaffType(){
        return $this::all();
    }

    // Delete Staff Type
    public function deleteStaffType($id){
        $this::find($id)->delete();
    }
}
