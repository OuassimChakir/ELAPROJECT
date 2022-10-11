<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Users as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Users extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    

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
