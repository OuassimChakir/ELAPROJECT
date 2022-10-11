<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function role(){
        $RoleObject = new Roles();
        $roles = $RoleObject->getRoles();
        return view('pages.users.role')->with('roles',$roles);
    }
}
