<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RolesController extends Controller
{
    public function role(Request $request)
    {
        $roles = Roles::getRoles();
        if ($request->has('ajouterRoles')) {
            if($request->codeRole == '00' || $request->codeRole == '11' || $request->codeRole == '22' || $request->codeRole == '33')
                return Redirect::back()->with('deleteMessage',"Vous ne pouvez pas ajouter ce Rôle");
            $roles = $request->role;
            $codeRole = $request->codeRole;
            $color = $request->color;
            Roles::addRoles($roles, $codeRole, $color);
            return Redirect::back()->with('successMessage', "L'ajout est fait avec succès");
        }
        return view('pages.users.role')->with('roles', $roles);
    }
    // ---------------delete Roles------//
    public function deleteRoles($idRole)
    {
        $role = Roles::getRole($idRole);
        if($role->codeRole == '00' || $role->codeRole == '11' || $role->codeRole == '22' || $role->codeRole == '33')
            return Redirect::back()->with('deleteMessage',"Vous ne pouvez pas supprimer ce Rôle");
        Roles::deleteRoles($idRole);
        return Redirect::back()->with('successMessage', "La suppression est faite avec succès");
    }
    
    // ---------------Update Roles-----//
    public function updateRoles(Request $request, $idRole)
    {
        $role = Roles::getRole($idRole);
        if($role->codeRole == '00' || $role->codeRole == '11' || $role->codeRole == '22' || $role->codeRole == '33')
            return Redirect::back()->with('deleteMessage',"Vous ne pouvez pas modifier ce Rôle");
        $roles = Roles::getRoles();
        $updatedRoles = Roles::selectRoles($idRole);
        if ($request->has('updateRoles')) {
            Roles::updateRoles($idRole, $request->role, $request->codeRole, $request->color);
            return Redirect::route('roles')
                ->with('updateMessage', "La Modification est faite avec succès")
                ->with('roles', $roles);
        }
        return view('pages.users.role')
            ->with('updatedRoles', $updatedRoles)
            ->with('roles', $roles);
    }
}
