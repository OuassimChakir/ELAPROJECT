<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;
    // Select all roles
    public function getRoles(){
        return $this::all();
    }
    // ------ Creation roles ----------- //
    public function addRoles($roles,$codeRole,$color){
            $this->roles = $roles;
            $this->codeRole = $codeRole;
            $this->color = $color;
            $this->save();
    }
    
}
