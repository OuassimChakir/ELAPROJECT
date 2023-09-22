<?php

namespace App\Models\Responsible;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Psy\Readline\Hoa\Console;

class Student extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = "students";
    protected $primaryKey = "idStudent";
    public $incrementing = false;
    protected $fillable = ['idStudent','matricule','nom_fr','nom_ar','prenom_fr','prenom_ar','cnie','numTel','sexe','adresse','dateNaissance','created_at','updated_at'];
    
        // Adding a new student 
    public static function addStudent($matricule,$nom_fr,$nom_ar,$prenom_fr,$prenom_ar,$cnie,$numTel,$sexe,$adresse,$dateNaissance){
            $student = Student::insertGetId([
                'matricule' => $matricule,
                'nom_fr' => $nom_fr,
                'nom_ar' => $nom_ar,
                'prenom_fr' => $prenom_fr,
                'prenom_ar' => $prenom_ar,
                'cnie' => $cnie,
                'numTel' => $numTel,
                'sexe' => $sexe,
                'adresse' => $adresse,
                'dateNaissance' => $dateNaissance,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            return $student;
    }

    // Get All Students
    public static function getStudents(){
        return Student::selectRaw("students.*,count(idPayment) - sum(etat) as pendingPayment")
            ->leftjoin('payment','payment.idStudent','=','students.idStudent')
            ->whereNotNull('etat')
            ->groupBy('students.idStudent')
            ->get();
    }
    public static function totalStudents(){
        return Student::select()->get()->count();
    
    }
    public static function selectStudents($matricule){
        return Student::find($matricule);
    }
    public static function selectStudent($matricule){
        return Student::select('*')->where('matricule', $matricule)->get();
    }



    // Select one Student
    public static function getStudent($idStudent){
        return Student::select('students.*',
        'responsibles.nom as responsibleNom',
        'responsibles.prenom as responsiblePrenom',
        'responsibles.cnie as responsibleCnie',
        'responsibles.sexe as responsibleSexe', 
        'responsibles.numTel as responsibleTel',
        'responsibles.created_at as responsibleCreated_at',
        'responsibles.updated_at as responsibleUpdated_at',)
                ->leftJoin('responsibles','students.idResponsible','=','responsibles.idResponsible')
                ->where('students.idStudent',$idStudent)
                ->first();
    }



    // Update Student
    public static function updateStudent($idStudent,$nom_fr,$nom_ar,$prenom_fr,$prenom_ar,$cnie,$numTel,$sexe,$adresse,$dateNaissance){
        Student::where('idStudent',$idStudent)->update([
            'nom_fr' => $nom_fr,
            'nom_ar' => $nom_ar,
            'prenom_fr' => $prenom_fr,
            'prenom_ar' => $prenom_ar,
            'cnie' => $cnie,
            'numTel' => $numTel,
            'sexe' => $sexe,
            'adresse' => $adresse,
            'dateNaissance' => $dateNaissance,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }


    /* ---------------------------------------
    / Archive & Delete
    / ---------------------------------------*/

    // Delete Student
    public static function deleteStudent($matricule){
        Student::find($matricule)->delete();
    }

    public static function softDeletedStudents(){
        return Student::onlyTrashed()->get();
    }

    public static function getDeletedStudent($matricule){
        return Student::onlyTrashed()
            ->select('students.*','responsibles.*','students.sexe as sSexe','students.numTel as sNumTel','students.CREATED_AT as sCREATED_AT','students.UPDATED_AT as sUPDATED_AT','students.deleted_at as sDELETED_AT','responsibles.sexe as rSexe', 'responsibles.numTel as rTel',)
            ->where('students.idStudent',$matricule)
            ->leftJoin('responsibles','students.cnieResponsible','=','responsibles.cnieResponsible')->first();
    }

    public static function restoreStudent($matricule){
        Student::withTrashed()
            ->where('matricule',$matricule)
            ->restore();
    }
   
    public static function forceDeleteStudent($matricule){
        Student::withTrashed()
            ->where('matricule',$matricule)
            ->forceDelete();
    }
    //-------------------- search student --------------//
    public static function searchstudentsbyMatricule($query){
        Student::where('matricule', 'like', '%'.$query.'%')
                    ->orderBy('idStudent', 'desc')
                    ->get();
    }
}
