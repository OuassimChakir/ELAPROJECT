<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradesCategory extends Model
{
    use HasFactory;
    protected $table = "gradescategories";
    protected $primaryKey = "idGradeCategory";
    public $timestamps = false;
}
