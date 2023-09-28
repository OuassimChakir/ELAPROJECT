<?php

namespace App\Http\Controllers;

use App\Models\Notes;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function addNote(Request $request){
        if($request->has('note')){
            Notes::addNote($request->note,$request->idElement);
            return response()->json('true');
        }
        else return response()->json('false');
    }

    public function deleteNote(Request $request){
        if($request->has('idNote')){
            Notes::deleteNote($request->idNote);
            return response()->json('true');
        }
        else
            return response()->json('false');
    }
}
