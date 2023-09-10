<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;
    protected $table = "roles";
    protected $primaryKey = "idRole"; 
    public $timestamps = false;
    // Select all roles
    public static function getRoles(){
        return Roles::all();
    }

    public static function getRole($idRole){
        return Roles::find($idRole);
    }
    public static function selectRoles($idRole){
        return Roles::find($idRole);
    }
    public static function getProfRole(){
        return Roles::where('codeRole','33')->first();
    }
    public static function getStaffRole(){
        return Roles::where('codeRole','11')->first();
    }
    public static function getStudentRole(){
        return Roles::where('codeRole','22')->first();
    }
    // ------ Creation roles ----------- //
    public static function addRoles($role,$codeRole,$color){
            $Roles = new Roles();
            $Roles->role = $role;
            $Roles->codeRole = $codeRole;
            $Roles->color = $color;
            $Roles->save();
    }
    //----------- Update  roles -----------//
    public static function updateRoles($idRole,$role,$codeRole,$color){
            $incomes = Roles::find($idRole);
            $incomes->role=$role;
            $incomes->codeRole=$codeRole;
            $incomes->color=$color;
            $incomes->save();
    }
                
    //---------- Delete roles -------------//
    public static function deleteRoles($idRole){
        Roles::find($idRole)->delete();
    }
        
    
}
