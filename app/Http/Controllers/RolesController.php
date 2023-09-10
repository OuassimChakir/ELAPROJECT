<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RolesController extends Controller
{
    public function role(Request $request){
        $roles =Roles::getRoles();
        if($request->has('ajouterRoles')){
            $roles = $request->role;
            $codeRole = $request->codeRole;
            $color = $request->color;
            Roles::addRoles($roles,$codeRole,$color);
            return Redirect::back()->with('successMessage',"L'ajout est fait avec succès");
        }
        return view('pages.users.role')->with('roles',$roles);
    }
    // ---------------delete Roles------//
    public function deleteRoles($idRole){
            Roles::deleteRoles($idRole);
            $roles =Roles::getRoles();
            return Redirect::route('roles')
                            ->with('deleteMessage',"La suppression est faite avec succès")
                            ->with('roles',$roles);
    }
    // ---------------Update Roles-----//
    public function updateRoles(Request $request,$idRole){
            $roles = Roles::getRoles();
            $updatedRoles =Roles::selectRoles($idRole);
            if($request->has('updateRoles')){ 
           Roles::updateRoles($idRole,$request->role,$request->codeRole,$request->color);
            return Redirect::route('roles')
                            ->with('updateMessage',"La Modification est faite avec succès")
                            ->with('roles',$roles);
            }
            return view('pages.users.role')
                ->with('updatedRoles',$updatedRoles)
                ->with('roles',$roles);
    }    
    



}
