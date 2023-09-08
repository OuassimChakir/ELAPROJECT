<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Attendance;
use App\Models\Classrooms;
use App\Models\Grades\Grades;
use App\Models\Grades\GradesCategory;
use App\Models\Group;
use App\Models\Incomes\Income;
use App\Models\Incomes\Payment;
use App\Models\Responsible\Responsible;
use App\Models\responsible\Staff;
use App\Models\responsible\Student;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    // -------------- Students -------------- //
    public function student(Request $request)
    {
        $groupSubjects = Group::existedGroupSubjects();
        $groupCourseTypes = Group::existedGroupCourseTypes();

        // Restart from 0 EACH YEAR
        if (date('d-m') == "01-01")
            Storage::disk('local')->put('student.txt', 0);
        $students = Student::getStudents();
        // New Student
        if ($request->has('addStudent')) {

            // =========== Count nb Student Stock it in student.txt file ============== //
            $studentsCounter = 1;
            if (!Storage::exists('student.txt'))
                Storage::disk('local')->put('student.txt', 0);
            $studentsCounter += Storage::get('student.txt');
            Storage::disk('local')->put('student.txt', $studentsCounter);

            // ========== Create new Student ============= //
            $matricule = "BMA" . $studentsCounter . "-" . date('Y');
            $prenom_fr = $request->prenom_fr;
            $nom_fr = $request->nom_fr;
            $idStudent = Student::addStudent($matricule, $request->nom_fr, $request->nom_ar, $request->prenom_fr, $request->prenom_ar, $request->cnie, $request->numTel, $request->sexe, $request->adresse, $request->dateNaissance);
            User::createStudentAccount($idStudent,ucfirst($prenom_fr).' '.Str::upper($nom_fr),"BMA" . $studentsCounter);
            // ========== Generation Initial Payment ============= //
            $initialIncomes = Income::getInitialIncomes();
            foreach ($initialIncomes as $value) {
                Payment::initialPayment($value->fixedAmount, $value->description . " - " . date('Y'), $idStudent, $value->idIncome, 0);
            }

            // ========== Create new Activity ============= //
            if (session()->get('user')) {
                $typeActivity = 0;
                $activityDescription = 'Le étudiants' . " " . " " . $prenom_fr . " " . $nom_fr;
                Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription);
            }

            return Redirect::back()->with('successMessage', "L'ajout est fait avec succès")->with('students', $students);
        }
        return view('pages.students.students')->with('students', $students)
            ->with('subjects', $groupSubjects)
            ->with('courseTypes', $groupCourseTypes);
    }


    public function studentProfil($idStudent)
    {
        $studentInfo = Student::getStudent($idStudent);
        return view('pages.students.studentprofil')
            ->with('student', $studentInfo);

    }

    public function updateStudent(Request $request, $matricule)
    {
        $studentInfo = Student::getStudent($matricule);
        if ($request->has('updateStudent')) {
            $prenom_fr = $request->prenom_fr;
            $prenom_ar = $request->prenom_ar;
            $nom_fr = $request->nom_fr;
            $nom_ar = $request->nom_ar;
            $email = $request->email;
            $numTel = $request->numTel;
            $dateNaissance = $request->dateNaissance;
            $cnie = $request->cnie;
            $sexe = $request->sexe;
            $adresse = $request->adresse;
            Student::updateStudent($request->matricule, $nom_fr, $nom_ar, $prenom_fr, $prenom_ar, $cnie, $email, $numTel, $sexe, $adresse, $dateNaissance);
            if (session()->get('user')) {
                $typeActivity = 2;
                $activityDescription = 'Le étudiants' . " " . $prenom_fr . " " . $nom_fr . "(" . $matricule . ")";
                Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription);
            }
            return Redirect::back()
                ->with('updateStudent', "La Modification est faite avec succès")
                ->with('student', $studentInfo);
        }
    }

    public function deleteMultipleStudents(Request $request)
    {
        if ($request->has('deleteAll')) {
            foreach ($request->students as $matricule) {
                $stu = Student::selectStudents($matricule);
                if (session()->get('user')) {
                    $typeActivity = 1;
                    $activityDescription = 'Le étudiants' . " " . $stu->prenom_fr . " " . $stu->nom_fr . "(" . $stu->matricule . ")";
                    Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription);
                }
                Student::deleteStudent($matricule);
            }
            return Redirect::back()->with('deleteMessage', "Les étudiants séléctionés ont été supprimer");
        } else
            return Redirect::back();
    }

    public function deleteStudent($matricule)
    {
        $studentInfo = Student::getStudents();
        $stu = Student::selectStudents($matricule);
        if (session()->get('user')) {
            $typeActivity = 1;
            $activityDescription = 'Le étudiants' . " " . $stu->prenom_fr . " " . $stu->nom_fr . "(" . $stu->matricule . ")";
            Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription);
        }
        Student::deleteStudent($matricule);
        return Redirect::route('student.liste')
            ->with('deleteMessage', "La suppression est faite avec succès")
            ->with('students', $studentInfo);
    }

    // -------------- Responsible -------------- //
    public function addResponsible(Request $request)
    {
        if ($request->has('addReponsible')) {
            $idResponsible = Responsible::addResponsible($request->cnie, $request->nom, $request->prenom, $request->numTel, $request->sexe, $request->idStudent);
            // Relate Responsible to Student
            Student::where('idStudent',$request->idStudent)->update(['idResponsible' => $idResponsible]);

            // Make A Reponsible Account
            return Redirect::back()->with('successMessage', "L'ajout du Responsable est faite avec succès");
        }
    }

    public function updateResponsible(Request $request, $cnieResponsible)
    {
        $Responsible = new Responsible();
        $Responsible->updateResponsible($request->cine, $request->nom, $request->prenom, $request->numTel, $request->sexe);
        return Redirect::back()->with('updateMessage', "La Modification du Responsable est faite avec succès");
    }

    public function deleteResponsible(Request $request, $matricule, $cnieResponsible)
    {
        $Responsible = new Responsible();
        $Responsible->deleteResponsible($cnieResponsible, $matricule);
        return Redirect::back()->with('deleteMessage', "La suppression du Responsable est faite avec succès")->with('matricule', $matricule);
    }


    // ----------- ARCHIVE ------------- //
    public function archive()
    {
        $students = Student::softDeletedStudents();
        return view('pages.students.studentArchive')->with('students', $students);
    }

    public function archivedStudent($matricule)
    {
        $studentInfo = Student::getDeletedStudent($matricule);
        return view('pages.students.archivedStudentProfil')->with('student', $studentInfo);
    }

    public function restoreArchivedStudent($matricule)
    {
        Student::restoreStudent($matricule);
        $stu = Student::selectStudents($matricule);
        if (session()->get('user')) {
            $typeActivity = 3;
            $activityDescription = 'Le étudiants' . " " . $stu->prenom_fr . " " . $stu->nom_fr . "(" . $stu->matricule . ")";
            Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription);
        }
        return Redirect::back()->with('restoreMessage', "L'étudiant a été restorer avec succès");
    }

    public function deleteArchivedStudent($matricule)
    {
        $stu = Student::getDeletedStudent($matricule);
        if (session()->get('user')) {
            $typeActivity = 10;
            $activityDescription = 'Le étudiants' . " " . $stu->prenom_fr . " " . $stu->nom_fr . "(" . $stu->matricule . ")";
            Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription);
        }
        Responsible::fordeleteResponsible($stu->cnieResponsible);
        Student::forceDeleteStudent($matricule);
        return Redirect::back()->with('deleteMessage', "L'étudiant a été supprimer Définitivement");
    }

    public function multipleArchivedStudents(Request $request)
    {
        if ($request->has('restoreAll')) {
            foreach ($request->archivedStudents as $matricule) {
                Student::restoreStudent($matricule);
                $stu = Student::selectStudents($matricule);
                if (session()->get('user')) {
                    $typeActivity = 3;
                    $activityDescription = 'Le étudiants' . " " . $stu->prenom_fr . " " . $stu->nom_fr . "(" . $stu->matricule . ")";
                    Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription);
                }
            }
            return Redirect::back()->with('restoreMessage', "Les étudiants séléctionés ont été restorer avec succès");
        }
        if ($request->has('deleteAll')) {
            foreach ($request->archivedStudents as $matricule) {
                $studentInfo = Student::getStudent($matricule);
                $Responsible = new Responsible();
                if ($studentInfo->cnieResponsible != 'NULL')
                    $Responsible->deleteResponsible($studentInfo->cnieResponsible, $matricule);

                $stu = Student::getDeletedStudent($matricule);
                if (session()->get('user')) {
                    $typeActivity = 10;
                    $activityDescription = 'Le étudiants' . " " . $stu->prenom_fr . " " . $stu->nom_fr . "(" . $stu->matricule . ")";
                    Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription);
                }
                Student::forceDeleteStudent($matricule);
            }
            return Redirect::back()->with('deleteMessage', "Les étudiants séléctionés ont été supprimer Définitivement");
        }
    }

    // ------------ GROUPS AND CLASSROOMS -------------- //

    public function getGroupsByGrade($idSubject)
    {
        $gradeData['data'] = Group::existedGroupGradesBySubject($idSubject);
        return response()->json($gradeData);
    }

    public function getGroupsByGradeAndSubject($idSubject, $idGrade, $matricule)
    {
        $groups['data'] = Group::selectGroupsBySubjectAndGrade($idSubject, $idGrade, $matricule);
        return response()->json($groups);
    }


    public function assignClassroom($idGroup, $matricule)
    {
        Classrooms::add2Class($idGroup, $matricule);
        $processResult = 'true';
        return response()->json($processResult);
    }

    //--------- Reçue de pyment------------//

}
