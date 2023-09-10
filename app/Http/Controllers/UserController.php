<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Laravel\Jetstream\Rules\Role;

class UserController extends Controller
{
    /* --------------------------
    / User Page 
    / --------------------------*/
    public function users(Request $request){
        $roles =Roles::getRoles();
        $users =User::getUsers();
        if($request->has('addUser')){
            User::addUser($request->name,$request->username,$request->password,$request->idRole);
            return Redirect::back()->with('SuccessMessage','Le compte a été créé avec Succès');
        }
        return view('pages.users.users')
                        ->with('roles',$roles)
                        ->with('users',$users);
    }
    public function login(){
        User::getUsers();
        return view('pages.users.login');
    }
}
