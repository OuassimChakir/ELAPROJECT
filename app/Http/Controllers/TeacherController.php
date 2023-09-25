<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use Illuminate\Http\Request;
use App\Models\Courses\CourseType;
use App\Models\Courses\Subjects;
use App\Models\Expenses\Facture;
use App\Models\Group;
use App\Models\responsible\Professeurs;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TeacherController extends Controller
{
    public function teacher(Request $request)
    {
        $subjects = Subjects::getSubjects();
        $courseTypes = CourseType::selectCourses();
        $teachers = Professeurs::getProfesseurs();

        // Restart from 0 EACH YEAR
        if (date('d-m') == "01-01")
            Storage::disk('local')->put('professeurs.txt', 0);
        if ($request->has('addTeacher')) {
            // =========== Count nb Professeurs Stock it in professeurs.txt file ============== //
            $professeursCounter = 1;
            if (!Storage::exists('professeurs.txt'))
                Storage::disk('local')->put('professeurs.txt', 0);
            $professeursCounter += Storage::get('professeurs.txt');
            Storage::disk('local')->put('professeurs.txt', $professeursCounter);
            $username = "BMA-P" . $professeursCounter;
            $idProfesseur = Professeurs::addProfesseur($request->cine, $request->prenom, $request->nom, $request->sexe, $request->numTel, $request->idSubject);
            $password = User::createProfAccount($idProfesseur->idProfesseur, ucfirst($request->prenom) . ' ' . Str::upper($request->nom), $username);
            $newProfesseur = array(['nom' => $request->nom, 'prenom' => $request->prenom, 'username' => $username, 'password' => $password]);

            if (session()->get('user')) {
                $typeActivity = 0;
                $activityDescription = 'Le profisseur' . " " . $request->prenom . $request->nom . ($request->cine);
                Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription, session()->get('user')->name);
            }
            return Redirect::back()->with('newProfesseur', $newProfesseur);
        }
        return view('pages.teachers.teachers')
            ->with('subjects', $subjects)
            ->with('courseTypes', $courseTypes)
            ->with('teachers', $teachers);
    }

    public function teacherProfil($idProfesseur)
    {
        $subjects = Subjects::getSubjects();
        $courseTypes = CourseType::selectCourses();
        $groups = Group::getProfGroups($idProfesseur);
        $factures = Facture::getFacturesByProf($idProfesseur);
        $teacher = Professeurs::getProfesseur($idProfesseur);
        return view('pages.teachers.teacherprofil')
            ->with('teacher', $teacher)
            ->with('subjects', $subjects)
            ->with('courseTypes', $courseTypes)
            ->with('groups', $groups)
            ->with('factures', $factures);
    }

    public function updateTeacher(Request $request, $idProfesseur)
    {
        $teacher = Professeurs::getProfesseur($idProfesseur);
        if ($request->has('updateTeacher')) {
            Professeurs::updateProfesseur($idProfesseur, $request->cine, $request->prenom, $request->nom, $request->sexe, $request->numTel, $request->idSubject);
            if (session()->get('user')) {
                $typeActivity = 2;
                $activityDescription = 'Le profisseur' . " " . $request->prenom . $request->nom . " (" . $idProfesseur . ")";
                Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription, session()->get('user')->name);
            }
            return Redirect::back()
                ->with('updateMessage', "La Modification est faite avec succès")
                ->with('teacher', $teacher);
        }
    }
    public function deleteTeacher($idProfesseur)
    {
        $teachers = Professeurs::getProfesseurs();
        $teach = Professeurs::getProfesseur($idProfesseur);
        if (session()->get('user')) {
            $typeActivity = 1;
            $activityDescription = 'Le profisseur' . " " . $teach->nom . " " . $teach->prenom . " (" . $teach->idProfesseur . ")";
            Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription, session()->get('user')->name);
        }
        Professeurs::deleteProfesseur($idProfesseur);
        return Redirect::route('teachers.liste')
            ->with('deleteMessage', "La suppression est faite avec succès")
            ->with('teachers', $teachers);;
    }

    public function deleteMultipleTeachers(Request $request)
    {
        if ($request->has('deleteAll')) {
            foreach ($request->teachers as $idProfesseur) {
                $teach = Professeurs::getProfesseur($idProfesseur);
                if (session()->get('user')) {
                    $typeActivity = 1;
                    $activityDescription = 'Le profisseur' . " " . $teach->nom . " " . $teach->prenom . " (" . $teach->idProfesseur . ")";
                    Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription, session()->get('user')->name);
                }
                Professeurs::deleteProfesseur($idProfesseur);
            }
            return Redirect::back()->with('deleteMessage', "Les Professeurs séléctionés ont été supprimer");
        } else
            return Redirect::back();
    }

    // ----------- ARCHIVE ------------- //
    public function archive()
    {
        $teachers = Professeurs::softDeletedTeachers();
        return view('pages.teachers.teacherArchive')->with('teachers', $teachers);
    }

    public function archivedTeacher($idProfesseur)
    {
        $subjects = Subjects::getSubjects();
        $courseTypes = CourseType::selectCourses();
        $groups = Group::getProfGroups($idProfesseur);
        $factures = Facture::getFacturesByProf($idProfesseur);
        $teacher = Professeurs::getDeletedTeacher($idProfesseur);
        return view('pages.teachers.archivedTeacherProfil')           
        ->with('teacher', $teacher)
        ->with('subjects', $subjects)
        ->with('courseTypes', $courseTypes)
        ->with('groups', $groups)
        ->with('factures', $factures);
    }

    public function restoreArchivedTeacher($idProfesseur)
    {
        Professeurs::restoreTeacher($idProfesseur);
        $teachers = Professeurs::softDeletedTeachers();
        $teach = Professeurs::getProfesseur($idProfesseur);
        if (session()->get('user')) {
            $typeActivity = 3;
            $activityDescription = 'Le profisseur' . " " . $teach->nom . " " . $teach->prenom . " (" . $teach->idProfesseur . ")";
            Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription, session()->get('user')->name);
        }
        return Redirect::route('teachers.archive')->with('restoreMessage', "Le Professeur a été restorer avec succès")->with('teachers', $teachers);
    }

    public function deleteArchivedTeacher($idProfesseur)
    {
        $teach = Professeurs::getDeletedTeacher($idProfesseur);
        if (session()->get('user')) {
            $typeActivity = 10;
            $activityDescription = 'Le profisseur' . " " . $teach->nom . " " . $teach->prenom . "(" . $teach->idProfesseur . ")";
            Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription, session()->get('user')->name);
        }
        User::deleteProfAccount($idProfesseur);
        Professeurs::forceDeleteTeacher($idProfesseur);

        return Redirect::back()->with('deleteMessage', "Le Professeur a été supprimer Définitivement");
    }

    public function multipleArchivedTeachers(Request $request)
    {
        if ($request->has('restoreAll')) {
            foreach ($request->archivedTeachers as $idProfesseur) {
                Professeurs::restoreTeacher($idProfesseur);
                $teach = Professeurs::getProfesseur($idProfesseur);
                if (session()->get('user')) {
                    $typeActivity = 3;
                    $activityDescription = 'Le profisseur' . " " . $teach->nom . " " . $teach->prenom . " (" . $teach->idProfesseur . ")";
                    Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription, session()->get('user')->name);
                }
            }
            return Redirect::back()->with('restoreMessage', "Les Professeurs séléctionés ont été restorer avec succès");
        }
        if ($request->has('deleteAll')) {
            foreach ($request->archivedTeachers as $idProfesseur) {
                $teach = Professeurs::getDeletedTeacher($idProfesseur);
                if (session()->get('user')) {
                    $typeActivity = 10;
                    $activityDescription = 'Le profisseur' . " " . $teach->nom . " " . $teach->prenom . " (" . $teach->idProfesseur . ")";
                    Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription, session()->get('user')->name);
                }
                User::deleteProfAccount($idProfesseur);
                Professeurs::forceDeleteTeacher($idProfesseur);
            }
            return Redirect::back()->with('deleteMessage', "Les Professeurs séléctionés ont été supprimer Définitivement");
        }
    }
}
