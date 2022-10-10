<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    // Select Users + Roles
    public function getUsers(){
        return $this::select('*')
            ->join('roles','roles.idRole','=','users.idRole')
            ->get();
    }

    // Add a new User
    public function addUser($name,$email,$password,$role){
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->idRole = $role;
        $this->save();
    }
}
