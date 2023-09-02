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
    protected $fillable = ['cnie', 'nom', 'prenom', 'sexe', 'email', 'numTel', 'idStaffType', 'idSubject', 'dateEngagement', 'UPDATED_AT'];

    // Get All Staff & Teachers
    public static function getStaffs()
    {
        return Staff::where('staff.idSubject', NULL)
            ->join('staffType', 'staff.idStaffType', '=', 'staffType.idStaffType')
            ->get();
    }
    public static function getProfesseurs()
    {
        return Staff::where('staff.idStaffType', NULL)
            ->leftJoin('subjects', 'subjects.idSubject', '=', 'staff.idSubject')
            ->get();
    }
    // Select one Staff || One Teacher
    public static function getStaff($idStaff)
    {
        return Staff::where('staff.idStaff', $idStaff)
            ->join('staffType', 'staff.idStaffType', '=', 'staffType.idStaffType')
            ->first();
    }

    public static function getProfesseur($idProfesseur)
    {
        return Staff::where('staff.idStaff', $idProfesseur)
            ->join('subjects', 'subjects.idSubject', '=', 'staff.idSubject')
            ->first();
    }
    // Adding a new staff || new Professeur
    public static function addStaff($cine, $prenom, $nom, $sexe, $email, $numTel, $idStaffType)
    {
        Staff::Create([
            'cine' => $cine,
            'prenom' => $prenom,
            'nom' => $nom,
            'sexe' => $sexe,
            'email' => $email,
            'numTel' => $numTel,
            'idStaffType' => $idStaffType,
            'dateEngagement' => date('Y-m-d H:i:s'),
            'UPDATED_AT' => date('Y-m-d H:i:s')
        ]);
    }

    public static function addProfesseur($cine, $prenom, $nom, $sexe, $email, $numTel, $idSubject)
    {
        Staff::Create([
            'cine' => $cine,
            'prenom' => $prenom,
            'nom' => $nom,
            'sexe' => $sexe,
            'email' => $email,
            'numTel' => $numTel,
            'idSubject' => $idSubject,
            'dateEngagement' => date('Y-m-d H:i:s'),
            'UPDATED_AT' => date('Y-m-d H:i:s')
        ]);
    }

    // Update Staff || Professeur
    public static function updateStaff($idStaff, $cine, $prenom, $nom, $sexe, $email, $numTel, $idStaffType)
    {
        $staff = Staff::find($idStaff);
        $staff->cnie = $cine;
        $staff->nom = $nom;
        $staff->prenom = $prenom;
        $staff->sexe = $sexe;
        $staff->email = $email;
        $staff->numTel = $numTel;
        $staff->idStaffType = $idStaffType;
        $staff->save();
    }

    public static function updateProfesseur($idStaff, $cine, $prenom, $nom, $sexe, $email, $numTel, $idStaffType, $idSubject)
    {
        $staff = Staff::find($idStaff);
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
    public static function deleteStaff($idStaff)
    {
        Staff::find($idStaff)->delete();
    }

    public static function deleteProfesseur($idStaff)
    {
        Staff::find($idStaff)->delete();
    }

    // --------------- Staff ARCHIVE ------------------ //

    // Select deleted Staff
    public static function softDeletedStaffs()
    {
        return Staff::onlyTrashed()->where('staff.idSubject', NULL)
            ->join('stafftype', 'staff.idStaffType', '=', 'stafftype.idStaffType')
            ->get();
    }

    public static function getDeletedStaff($idStaff)
    {
        return Staff::onlyTrashed()
            ->join('stafftype', 'staff.idStaffType', '=', 'stafftype.idStaffType')
            ->where('staff.idStaff', $idStaff)
            ->where('staff.idSubject', NULL)
            ->first();
    }

    public static function restoreStaff($idStaff)
    {
        Staff::withTrashed()
            ->where('idStaff', $idStaff)
            ->restore();
    }

    public static function forceDeleteStaff($idStaff)
    {
        Staff::withTrashed()
            ->where('idStaff', $idStaff)
            ->forceDelete();
    }

    // --------------- TEACHER ARCHIVE ------------------ //

    // Select deleted Staff
    public static function softDeletedTeachers()
    {
        return Staff::onlyTrashed()->where('staff.idStaffType', NULL)
            ->leftJoin('subjects', 'subjects.idSubject', '=', 'staff.idSubject')
            ->get();
    }

    public static function getDeletedTeacher($idStaff)
    {
        return Staff::onlyTrashed()
            ->where('staff.idStaff', $idStaff)
            ->where('staff.idStaffType', NULL)
            ->leftJoin('subjects', 'subjects.idSubject', '=', 'staff.idSubject')
            ->first();
    }

    public static function restoreTeacher($idStaff)
    {
        Staff::withTrashed()
            ->where('idStaff', $idStaff)
            ->restore();
    }

    public static function forceDeleteTeacher($idStaff)
    {
        Staff::withTrashed()
            ->where('idStaff', $idStaff)
            ->forceDelete();
    }
}
