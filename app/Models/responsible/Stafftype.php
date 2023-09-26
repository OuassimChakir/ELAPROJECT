<?php

namespace App\Models\Responsible;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stafftype extends Model
{
    use HasFactory;
    protected $table = "stafftype";
    protected $primaryKey = "idStaffType";
    public $timestamps = false;
    protected $fillable = ['designation', 'is_moderator'];
    // add new Staff Type
    public static function addStaffType($designation, $is_mod = null)
    {   
        if(!is_null($is_mod))
            Stafftype::create([
                'designation' => $designation,
                'is_moderator' => $is_mod,
            ]);
        else
            Stafftype::create([
                'designation' => $designation
            ]);
    }

    public static function updateStaffType($id, $designation, $is_mod = null)
    {
        $staffType = Stafftype::find($id);
        $staffType->designation = $designation;
        $staffType->is_moderator = $is_mod;
        $staffType->save();
    }

    public static function deleteStaffType($id)
    {
        Stafftype::find($id)->delete();
    }

    public static function getStaffTypes()
    {
        return Stafftype::all();
    }
    public static function getStaffType($id)
    {
        return Stafftype::find($id);
    }
}
