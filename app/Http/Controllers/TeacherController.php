<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses\CourseType;
use App\Models\Responsible\Staff;
use App\Models\Responsible\Stafftype;
use App\Models\Courses\Subjects;
use Illuminate\Support\Facades\Redirect;

class TeacherController extends Controller
{
    public function teacher(Request $request){
        $Staff = new Staff();
        $Subject = new Subjects();
        $CourseType = new CourseType();
        $subjects = $Subject->getSubjects();
        $courseTypes = $CourseType->selectCourses();
        $teachers = $Staff->getProfesseurs();
        if($request->has('addTeacher')){
            $Staff->addProfesseur($request->cine,$request->prenom,$request->nom,$request->sexe,$request->email,$request->numTel,$request->idSubject);
            return Redirect::back()
                            ->with('successMessage',"L'ajout est fait avec succès")
                            ->with('teachers',$teachers);
        }
        return view('pages.teachers.teachers')
                ->with('subjects',$subjects)
                ->with('courseTypes',$courseTypes)
                ->with('teachers',$teachers);
    }

    public function teacherProfil($idProfesseur){
        $Staff = new Staff();
        $CourseType = new CourseType();
        $Subject = new Subjects();
        $subjects = $Subject->getSubjects();
        $courseTypes = $CourseType->selectCourses();
        $teacher = $Staff->getProfesseur($idProfesseur);
        return view('pages.teachers.teacherprofil')
                ->with('teacher',$teacher)
                ->with('subjects',$subjects)
                ->with('courseTypes',$courseTypes);
    }

    public function updateTeacher(Request $request,$idProfesseur){
        $Staff = new Staff();
        $teacher = $Staff->getProfesseur($idProfesseur);
        if($request->has('updateTeacher')){
            $Staff->updateProfesseur($idProfesseur,$request->cine,$request->prenom,$request->nom,$request->sexe,$request->email,$request->numTel,$request->idStaffType,$request->idSubject);
            return Redirect::back()
                ->with('updateMessage',"La Modification est faite avec succès")
                ->with('teacher',$teacher);
        }
    }

    public function deleteTeacher(Request $request,$idProfesseur){
        $Staff = new Staff();
        $Staff->deleteProfesseur($idProfesseur);
        $teachers = $Staff->getProfesseurs();
        return Redirect::route('teachers.liste')
            ->with('deleteMessage',"La suppression est faite avec succès")
            ->with('teachers',$teachers);;
    }

    public function deleteMultipleTeachers(Request $request){
        $Staff = new Staff();
        if ($request->has('deleteAll')) {
            foreach($request->teachers as $idStaff){
                $Staff->deleteProfesseur($idStaff);
            }
            return Redirect::back()->with('deleteMessage',"Les Professeurs séléctionés ont été supprimer");
        }else
            return Redirect::back();
    }

    // ----------- ARCHIVE ------------- //
    public function archive(){
        $Staff = new Staff();
        $teachers = $Staff->softDeletedTeachers();
        return view('pages.teachers.teacherArchive')->with('teachers',$teachers);
    }

    public function archivedTeacher($idStaff){
        $Staff = new Staff();
        $teacher = $Staff->getDeletedTeacher($idStaff);
        return view('pages.teachers.archivedTeacherProfil')->with('teacher',$teacher);
    }

    public function restoreArchivedTeacher($idStaff){
        $Staff = new Staff();
        $Staff->restoreTeacher($idStaff);
        $teachers = $Staff->softDeletedTeachers();
        return Redirect::route('teachers.archive')->with('restoreMessage',"Le Professeur a été restorer avec succès")->with('teachers',$teachers);
    }

    public function deleteArchivedTeacher($idStaff){
        $Staff = new Staff();
        $Staff->forceDeleteTeacher($idStaff);
        return Redirect::back()->with('deleteMessage',"Le Professeur a été supprimer Définitivement");
    }

    public function multipleArchivedTeachers(Request $request){
        $Staff = new Staff();
        if($request->has('restoreAll')){
            foreach($request->archivedTeachers as $idStaff){
                $Staff->restoreTeacher($idStaff);
            }
            return Redirect::back()->with('restoreMessage',"Les Professeurs séléctionés ont été restorer avec succès");
        }
        if($request->has('deleteAll')){
            foreach($request->archivedTeacher as $idStaff){
                $Staff->forceDeleteTeacher($idStaff);
            }
            return Redirect::back()->with('deleteMessage',"Les Professeurs séléctionés ont été supprimer Définitivement");
        }
    }
}
