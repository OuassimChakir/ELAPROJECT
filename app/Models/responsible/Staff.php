<?php

namespace App\Models\Responsible;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "staffs";
    protected $primaryKey = "idStaff";
    protected $fillable = ['cnie', 'nom', 'prenom', 'sexe', 'numTel', 'idStaffType', 'idSubject', 'created_at', 'UPDATED_AT'];

    // Get All Staff 
    public static function getStaffs(){
        return Staff::select('*')
            ->join('stafftype', 'staffs.idStaffType', '=', 'stafftype.idStaffType')
            ->get();
    }
    // Select one Staff || 
    public static function getStaff($idStaff){
        return Staff::where('staffs.idStaff', $idStaff)
            ->join('stafftype', 'staffs.idStaffType', '=', 'stafftype.idStaffType')
            ->first();
    }
    // Adding a new staff ||
    public static function addStaff($cine, $prenom, $nom, $sexe, $numTel, $idStaffType){
        $idStaff=  Staff::Create([
            'cine' => $cine,
            'prenom' => $prenom,
            'nom' => $nom,
            'sexe' => $sexe,
            'numTel' => $numTel,
            'idStaffType' => $idStaffType,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        return $idStaff;
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
        return Staff::onlyTrashed()
            ->select('*')
            ->join('stafftype', 'staffs.idStaffType', '=', 'stafftype.idStaffType')
            ->get();
    }

    public static function getDeletedStaff($idStaff){
        return Staff::onlyTrashed()
            ->join('stafftype', 'staffs.idStaffType', '=', 'stafftype.idStaffType')
            ->where('staffs.idStaff', $idStaff)
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
