<?php

namespace App\Models\Courses;

use App\Models\Courses\CourseType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    use HasFactory;
    protected $table = "subjects";
    protected $primaryKey = "idSubject";
    public $timestamps = false;

           // Select of Subjects
       public function selectSubjects(){
        return $this::all();
       }

       public function getSubject($idSubject){
        return $this::find($idSubject);
       }

       public function getSubjects(){
        return $this::select('*')
            ->join('coursetype','subjects.idCourseType','=','coursetype.idCourseType')
            ->get();
       }

       // INSERT DATA (New Subject)
       public function addSubject($libelle,$idCourseType){
        $this->libelle = $libelle;
        $this->idCourseType = $idCourseType;
        $this->save();
       }

    //    Update Subject
       public function updateSubject($idSubject,$libelle,$idCourseType){
        $subject = $this::find($idSubject);
        $subject->libelle = $libelle;
        $subject->idCourseType = $idCourseType;
        $subject->save();
       }
    
    //    Delete Subject
       public function deleteSubject($idSubject){
        $this::find($idSubject)->delete();
       }
       
}
