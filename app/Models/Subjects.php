<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    use HasFactory;
    protected $table = "subjects";
    protected $primaryKey = "idSubjects";
    public $timestamps = false;

       public function selectSubjects(){
        return $this::all();
       }
}
