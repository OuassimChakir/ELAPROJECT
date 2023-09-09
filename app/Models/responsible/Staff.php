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

    // Get All Staff 
    public static function getStaffs()
    {
        return Staff::where('staff.idSubject', NULL)
            ->join('staffType', 'staff.idStaffType', '=', 'staffType.idStaffType')
            ->get();
    }
    // Select one Staff || 
    public static function getStaff($idStaff)
    {
        return Staff::where('staff.idStaff', $idStaff)
            ->join('staffType', 'staff.idStaffType', '=', 'staffType.idStaffType')
            ->first();
    }
    // Adding a new staff ||
    public static function addStaff($cine, $prenom, $nom, $sexe, $numTel, $idStaffType){
        Staff::Create([
            'cine' => $cine,
            'prenom' => $prenom,
            'nom' => $nom,
            'sexe' => $sexe,
            'numTel' => $numTel,
            'idStaffType' => $idStaffType,
            'dateEngagement' => date('Y-m-d H:i:s'),
            'UPDATED_AT' => date('Y-m-d H:i:s')
        ]);
    }

    // Update Staff || 
    public static function updateStaff($idStaff, $cine, $prenom, $nom, $sexe, $numTel, $idStaffType){
        $staff = Staff::find($idStaff);
        $staff->cnie = $cine;
        $staff->nom = $nom;
        $staff->prenom = $prenom;
        $staff->sexe = $sexe;   
        $staff->numTel = $numTel;
        $staff->idStaffType = $idStaffType;
        $staff->save();
    }
    // Delete Staff ||
    public static function deleteStaff($idStaff){
        Staff::find($idStaff)->delete();
    }
    // --------------- Staff ARCHIVE ------------------ //

    // Select deleted Staff
    public static function softDeletedStaffs(){
        return Staff::onlyTrashed()->where('staff.idSubject', NULL)
            ->join('stafftype', 'staff.idStaffType', '=', 'stafftype.idStaffType')
            ->get();
    }

    public static function getDeletedStaff($idStaff){
        return Staff::onlyTrashed()
            ->join('stafftype', 'staff.idStaffType', '=', 'stafftype.idStaffType')
            ->where('staff.idStaff', $idStaff)
            ->where('staff.idSubject', NULL)
            ->first();
    }

    public static function restoreStaff($idStaff){
        Staff::withTrashed()
            ->where('idStaff', $idStaff)
            ->restore();
    }

    public static function forceDeleteStaff($idStaff){
        Staff::withTrashed()
            ->where('idStaff', $idStaff)
            ->forceDelete();
    }

}
