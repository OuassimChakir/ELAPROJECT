<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $table = "staff";
    protected $primaryKey = "idStaff";
    public $timestamps = false;

        // Adding a new staff 
        public function addStaff($cnie,$prenom,$nom,$email,$numTel,$idStaffType,$idSubject){
            $this->cnie = $cnie;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->email = $email;
            $this->numTel = $numTel;
            $this->idStaffType = $idStaffType;
            $this->idSubject = $idSubject;
            $this->save();
        }
    
        // Select all Course Types
        public function selectStaff(){
            return $this::all();
        }
        // Delete Course Type
        public function deleteStaff($id){
        $this::find($id)->delete();
        }
}
