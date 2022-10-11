<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function role(Request $request){
        $RoleObject = new Roles();
        $roles = $RoleObject->getRoles();
        if($request->has('ajouterRoles')){
            $roles = $request->roles;
            $codeRole = $request->codeRole;
            $color = $request->color;
            $RoleObject->addRoles($roles,$codeRole,$code);
            return Redirect::back()->with('successMessage',"L'ajout est fait avec succès");
        }
        return view('pages.users.role')->with('roles',$roles);
    }

}
