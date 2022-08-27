<?php

namespace App\Models\Responsible;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "staff";
    protected $primaryKey = "idStaff";
    const CREATED_AT = "dateEngagement";
    // Get All Staff & Teachers
    public function getStaffs(){
        return $this::where('staff.idSubject',NULL)
            ->join('staffType','staff.idStaffType','=','staffType.idStaffType')
            ->get();
    }
    public function getProfesseurs(){
        return $this::where('staff.idStaffType',NULL)
            ->leftJoin('subjects','subjects.idSubject','=','staff.idSubject')
            ->get();
    }
    // Select one Staff || One Teacher
    public function getStaff($idStaff){
        return $this::where('staff.idStaff',$idStaff)
                ->join('staffType','staff.idStaffType','=','staffType.idStaffType')
                ->first();
    }

    public function getProfesseur($idProfesseur){
        return $this::where('staff.idStaff',$idProfesseur)
                ->join('subjects','subjects.idSubject','=','staff.idSubject')
                ->first();
    }

    // Adding a new staff || new Professeur
    public function addStaff($cine,$prenom,$nom,$sexe,$email,$numTel,$idStaffType){
        $this->cnie = $cine;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->sexe = $sexe;
        $this->email = $email;
        $this->numTel = $numTel;
        $this->idStaffType = $idStaffType;
        $this->save();
    }

    public function addProfesseur($cine,$prenom,$nom,$sexe,$email,$numTel,$idSubject){
        $this->cnie = $cine;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->sexe = $sexe;
        $this->email = $email;
        $this->numTel = $numTel;
        $this->idSubject = $idSubject;
        $this->save();
    }

    // Update Staff || Professeur
    public function updateStaff($idStaff,$cine,$prenom,$nom,$sexe,$email,$numTel,$idStaffType){
        $staff = $this::find($idStaff);
        $staff->cnie = $cine;
        $staff->nom = $nom;
        $staff->prenom = $prenom;
        $staff->sexe = $sexe;
        $staff->email = $email;
        $staff->numTel = $numTel;
        $staff->idStaffType = $idStaffType;
        $staff->save();
    }

    public function updateProfesseur($idStaff,$cine,$prenom,$nom,$sexe,$email,$numTel,$idStaffType,$idSubject){
        $staff = $this::find($idStaff);
        $staff->cnie = $cine;
        $staff->nom = $nom;
        $staff->prenom = $prenom;
        $staff->sexe = $sexe;
        $staff->email = $email;
        $staff->numTel = $numTel;
        $staff->idStaffType = $idStaffType;
        $staff->idSubject = $idSubject;
        $staff->save();
    }

    // Delete Staff || Delete Professeur
    public function deleteStaff($idStaff){
        $this::find($idStaff)->delete();
    }

    public function deleteProfesseur($idStaff){
        $this::find($idStaff)->delete();
    }

    // --------------- Staff ARCHIVE ------------------ //

    // Select deleted Staff
    public function softDeletedStaffs(){
        return $this::onlyTrashed()->where('staff.idSubject',NULL)
        ->join('stafftype','staff.idStaffType','=','stafftype.idStaffType')
        ->get();
    }

    public function getDeletedStaff($idStaff){
        return $this::onlyTrashed()
                    ->join('stafftype','staff.idStaffType','=','stafftype.idStaffType')
                    ->where('staff.idStaff',$idStaff)
                    ->where('staff.idSubject',NULL)
                    ->first();
    }

    public function restoreStaff($idStaff){
        $this::withTrashed()
            ->where('idStaff',$idStaff)
            ->restore();
    }
   
    public function forceDeleteStaff($idStaff){
        $this::withTrashed()
            ->where('idStaff',$idStaff)
            ->forceDelete();
    }

    // --------------- TEACHER ARCHIVE ------------------ //

    // Select deleted Staff
    public function softDeletedTeachers(){
        return $this::onlyTrashed()->where('staff.idStaffType',NULL)
        ->leftJoin('subjects','subjects.idSubject','=','staff.idSubject')
        ->get();
    }

    public function getDeletedTeacher($idStaff){
        return $this::onlyTrashed()
                    ->where('staff.idStaff',$idStaff)
                    ->where('staff.idStaffType',NULL)
                    ->leftJoin('subjects','subjects.idSubject','=','staff.idSubject')
                    ->first();
    }

    public function restoreTeacher($idStaff){
        $this::withTrashed()
            ->where('idStaff',$idStaff)
            ->restore();
    }
   
    public function forceDeleteTeacher($idStaff){
        $this::withTrashed()
            ->where('idStaff',$idStaff)
            ->forceDelete();
    }
}
