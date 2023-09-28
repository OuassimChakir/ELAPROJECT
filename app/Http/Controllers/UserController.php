<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;


class UserController extends Controller
{
    /* --------------------------
    / User Page 
    / --------------------------*/
    public function users(Request $request){
        $roles = Roles::getRoles();
        $users = User::getUsers();
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

    public function register(Request $request){
        if($request->has('addUser')){
            if(User::checkEmail($request->email) == 0 && User::checkUsername($request->username) == 0){
                User::create([
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => $request->email,
                    'idRole' => $request->idRole,
                    'password' => Hash::make($request->password),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
                $newUser = array(
                    'name' => $request->name,
                    'username' => $request->username,
                    'password' => $request->password
                );
                return Redirect::back()->with([
                    'newUser' => $newUser,
                ]);
            }else
                return Redirect::back()->with('deleteMessage',"Ce nom d'utilisateur ou cet e-mail a déjà été utilisé.");
        }
    }



    /* -------------------------------
    / Reset Password
    / -------------------------------*/
    public function resetPassword(Request $request){
        User::resetPassword($request->id, $request->newPassword);
        $user = User::find($request->id);
        $user->newPassword = $request->newPassword;
        return response()->json($user);
    }

    
    /* -------------------------------
    / Archive
    / -------------------------------*/
    public function softDeleteUser($id){
        $user = User::getUserById($id);
        if($user->codeRole == '00'){
            if(User::countAdmins() > 1)
                return Redirect::back()->with('deleteMessage','Impossible de supprimer cet administrateur !');
        }
        User::find($id)->forceDelete();
        return Redirect::back()->with('successMessage','Utilisateur supprimé avec succès !');
    }
}
