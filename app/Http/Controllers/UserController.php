<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /* --------------------------
    / User Page 
    / --------------------------*/
    public function users(Request $request){
        // Declarations
        $RolesObject = new Roles();
        $UsersObject = new User();

        $roles = $RolesObject -> getRoles();
        $users = $UsersObject ->getUsers();
        if($request->has('addUser')){
            $UsersObject->addUser($request->name,$request->email,$request->password,$request->role);
            return Redirect::back()->with('SuccessMessage','Le compte a été créé avec Succès');
        }
        return view('pages.users.users')
                        ->with('roles',$roles)
                        ->with('users',$users);
    }
    public function login(Request $request){
        // Declarations
        $Roles = new Roles();

        return view('pages.users.login');
    }
}
