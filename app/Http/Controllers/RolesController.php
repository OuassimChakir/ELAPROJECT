<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RolesController extends Controller
{
    public function role(Request $request){
        $RoleObject = new Roles();
        $roles = $RoleObject->getRoles();
        if($request->has('ajouterRoles')){
            $roles = $request->role;
            $codeRole = $request->codeRole;
            $color = $request->color;
            $RoleObject->addRoles($roles,$codeRole,$color);
            return Redirect::back()->with('successMessage',"L'ajout est fait avec succès");
        }
        return view('pages.users.role')->with('roles',$roles);
    }
    // ---------------delete Roles------//
    public function deleteRoles($idRole){
            $role = new Roles();
            $role->deleteRoles($idRole);
            $roles = $role->getRoles();
            return Redirect::route('roles')
                            ->with('deleteMessage',"La suppression est faite avec succès")
                            ->with('roles',$roles);
    }
    // ---------------Update Roles-----//
    public function updateRoles(Request $request,$idRole){
            $role = new Roles();
            $roles = $role->getRoles();
            $updatedRoles = $role->selectRoles($idRole);
            if($request->has('updateRoles')){ 
            $role->updateRoles($idRole,$request->role,$request->codeRole,$request->color);
            return Redirect::route('roles')
                            ->with('updateMessage',"La Modification est faite avec succès")
                            ->with('roles',$roles);
            }
            return view('pages.users.role')
                ->with('updatedRoles',$updatedRoles)
                ->with('roles',$roles);
    }    
    



}
