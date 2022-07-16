<?php

namespace App\Models\Responsible;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $table = "staff";
    protected $primaryKey = "idStaff";
    public $timestamps = false;

        // Adding a new staff 
        public function addStaff($cnie,$shortForm){
            $this->cnie = $cnie;
            $this->nom = $shortForm;
            $this->prenom = $shortForm;
            $this->email = $shortForm;
            $this->numTel = $shortForm;
            $this->idStaffType = $shortForm;
            $this->idSubject = $shortForm;
            $this->save();
        }
    
        // Select all Course Types
        public function selectStaff(){
            return $this::all();
        }
}
