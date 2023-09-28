<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    use HasFactory;
    protected $primaryKey = "idNote";
    protected $fillable = ['note','idElement','created_at','updated_at'];

    /*-----------------------------
    /   Add Note
    /------------------------------*/
    public static function addNote($note, $idElement){
        Notes::create([
            'note' => $note,
            'idElement' => $idElement,
            'create_at' => date('Y-m-d H:i:s')
        ]);
    }

    /*-----------------------------
    /   Delete Note
    /------------------------------*/
    public static function deleteNote($idNote){
        Notes::find($idNote)->delete();
    }

    /*-----------------------------
    /   Select Student Notes
    /------------------------------*/
    public static function studentNotes($idStudent){
        return Notes::select('*')
            ->join('groupelements','groupelements.idElement','=','notes.idElement')
            ->join('groups','groups.idGroup','=','groupelements.idGroup')
            ->where('groupelements.idStudent',$idStudent)
            ->orderBy('notes.created_at','DESC')
            ->get();
    }

    public static function deleteGroupNotes($idGroup){
        Notes::select('*')
            ->join('groupelements','groupelements.idElement','=','notes.idElement')
            ->where('idGroup',$idGroup)
            ->delete();
    }
}
