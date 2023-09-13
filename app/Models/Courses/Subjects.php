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
    protected $fillable = ['libelle','idCourseType'];
      // Select of Subjects
       public static function selectSubjects(){
        return Subjects::all();
       }

       public static function getSubject($idSubject){
        return Subjects::select('*')
            ->join('coursetype','subjects.idCourseType','=','coursetype.idCourseType')
            ->where('idSubject',$idSubject)
            ->first();
       }

       public static function getSubjects(){
        return Subjects::select('*')
            ->join('coursetype','subjects.idCourseType','=','coursetype.idCourseType')
            ->orderBy('subjects.idCourseType')
            ->get();
       }

       // INSERT DATA (New Subject)
       public static function addSubject($libelle,$idCourseType){
        Subjects::create([
         'libelle' => $libelle,
         'idCourseType' => $idCourseType
        ]);
       }
      //    Update Subject
       public static function updateSubject($idSubject,$libelle,$idCourseType){
        $subject = Subjects::find($idSubject);
        $subject->libelle = $libelle;
        $subject->idCourseType = $idCourseType;
        $subject->save();
       }
    
       //    Delete Subject
       public static function deleteSubject($idSubject){
        Subjects::find($idSubject)->delete();
       }
       
}
