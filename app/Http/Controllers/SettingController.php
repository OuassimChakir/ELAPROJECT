<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SettingController extends Controller
{
    //
    
    public function index(Request $request){

        if($request->has('addlogo')){

        if($request->hasfile('logo')){
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/chat/', $filename);
           // $chat-> image = $filename;
         
        } 

        return Redirect::back()->with('successMessage',"L'ajout est fait avec succès");
        }
        return view('setting');
        }


}
