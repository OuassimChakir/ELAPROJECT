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
       public function selectSubjects(){
        return $this::all();
       }
       public function getSubjects(){
        return $this::select('*')
            ->join('courseType','subjects.idCourseType','=','courseType.idCourseType')
            ->where('subjects.idCourseType',1)
            ->first();
       }
}
