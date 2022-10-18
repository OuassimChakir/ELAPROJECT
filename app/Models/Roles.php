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
    public function getRoles(){
        return $this::all();
    }

    public static function getRole($idRole){
        return Roles::find($idRole);
    }
    public function selectRoles($idRole){
        return $this::find($idRole);
    }
    // ------ Creation roles ----------- //
    public function addRoles($role,$codeRole,$color){
            $this->role = $role;
            $this->codeRole = $codeRole;
            $this->color = $color;
            $this->save();
    }
    //----------- Update  roles -----------//
    public function updateRoles($idRole,$role,$codeRole,$color){
            $incomes = $this::find($idRole);
            $incomes->role=$role;
            $incomes->codeRole=$codeRole;
            $incomes->color=$color;
            $incomes->save();
    }
                
    //---------- Delete roles -------------//
    public function deleteRoles($idRole){
            $this::find($idRole)->delete();
    }
        
    
}
