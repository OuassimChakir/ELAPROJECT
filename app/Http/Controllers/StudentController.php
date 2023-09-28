<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Attendance;
use App\Models\Expenses\Facture;
use App\Models\Grades\GradesCategory;
use App\Models\Group;
use App\Models\GroupElements;
use App\Models\GroupGrades;
use App\Models\Incomes\Income;
use App\Models\Incomes\Payment;
use App\Models\Notes;
use App\Models\Responsible\Responsible;
use App\Models\responsible\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    // -------------- Students -------------- //
    public function students()
    {
        $groupSubjects = Group::existedGroupSubjects();
        $groupCourseTypes = Group::existedGroupCourseTypes();
        $gradesCategories = GradesCategory::getGradeCategories();
        // Restart from 0 EACH YEAR
        if (date('d-m') == "01-01")
            Storage::disk('local')->put('student.txt', 0);
        $students = Student::getStudents();
        return view('pages.students.students')->with('students', $students)
            ->with('subjects', $groupSubjects)
            ->with('courseTypes', $groupCourseTypes)
            ->with('gradesCategories',$gradesCategories);
    }

    public function addStudent(Request $request)
    {
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
            $prenom_ar = $request->prenom_ar;
            $nom_ar = $request->nom_ar;
            $idStudent = Student::addStudent($matricule, $request->nom_fr, $request->nom_ar, $request->prenom_fr, $request->prenom_ar, $request->cnie, $request->numTel, $request->sexe, $request->adresse, $request->dateNaissance);
            $password = User::createStudentAccount($idStudent, $prenom_ar . ' ' . $nom_ar, $matricule);

            $newStudent = array(['nom' => $nom_ar, 'prenom' => $prenom_ar, 'matricule' => $matricule, 'password' => $password]);
            // ========== Generation Initial Payment ============= //
            $initialIncomes = Income::getInitialIncomes();
            foreach ($initialIncomes as $value) {
                Payment::initialPayment($value->fixedAmount, $value->description . " - " . date('Y'), $idStudent, $value->idIncome, 0);
            }

            // ========== Create new Activity ============= //
            if (session()->get('user')) {
                $typeActivity = 0;
                $activityDescription = 'Le étudiants' . " " . " " . $prenom_ar . " " . $nom_ar;
                Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription, session()->get('user')->name);
            }

            return Redirect::route('student.liste')->with([
                'newStudent' => $newStudent,
            ]);
        }
        return view('pages.students.add_student');
    }

    public function studentProfil($idStudent)
    {
        $studentInfo = Student::getStudent($idStudent);
        $subjects = Group::existedGroupSubjects();
        $courseTypes = Group::existedGroupCourseTypes();
        $pendingPaiment = Payment::getStudentPendingPaiment($idStudent);
        $studentGroups = GroupElements::studentGroups($idStudent);
        $lastPaiments = Payment::getStudentLastestPaiments($idStudent);
        $invoiceGroups = Group::getGroupWithStudentInvoices($idStudent);
        $notes = Notes::studentNotes($idStudent);
        $gradesCategories = GradesCategory::getGradeCategories();
        return view('pages.students.studentprofil')->with([
            'student' => $studentInfo,
            'pendingPaiment' => $pendingPaiment,
            'subjects' => $subjects,
            'courseTypes' => $courseTypes,
            'studentGroups' => $studentGroups,
            'lastPaiments' => $lastPaiments,
            'invoiceGroups' => $invoiceGroups,
            'notes' => $notes,
            'gradesCategories' => $gradesCategories,
        ]);
    }

    public function updateStudent(Request $request, $idStudent)
    {
        if ($request->has('updateStudent')) {
            Student::updateStudent($idStudent, $request->nom_fr, $request->nom_ar, $request->prenom_fr, $request->prenom_ar, $request->cnie, $request->numTel, $request->sexe, $request->adresse, $request->dateNaissance);

            if (session()->get('user')) {
                $activityDescription = 'Le étudiants' . " " . $request->prenom_fr . " " . $request->nom_fr . "(" . $request->matricule . ")";
                Activite::addActivity(session()->get('user')->id, 2, $activityDescription, session()->get('user')->name);
            }
            return Redirect::back()->with('updateMessage', "La Modification est faite avec succès");
        }
        return Redirect::back()->with('deteleMessage', "ERREUR");
    }

    public function deleteMultipleStudents(Request $request)
    {
        if ($request->has('deleteAll')) {
            foreach ($request->students as $idStudent) {
                $stu = Student::selectStudents($idStudent);
                if (session()->get('user')) {
                    $typeActivity = 1;
                    $activityDescription = 'Le étudiants' . " " . $stu->prenom_fr . " " . $stu->nom_fr . "(" . $stu->matricule . ")";
                    Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription, session()->get('user')->name);
                }
                $payments = Payment::getPaymentByidStudent($idStudent);
                if ($payments != null) {
                    foreach ($payments as $payment) {
                        Payment::deletePayment($payment->idPayment);
                    }
                }
                Student::deleteStudent($idStudent);
            }
            return Redirect::back()->with('deleteMessage', "Les étudiants séléctionés ont été supprimer");
        } else
            return Redirect::back();
    }

    public function deleteStudent($idStudent)
    {
        $studentInfo = Student::getStudents();
        $stu = Student::selectStudents($idStudent);
        if (session()->get('user')) {
            $typeActivity = 1;
            $activityDescription = 'Le étudiants' . " " . $stu->prenom_fr . " " . $stu->nom_fr . "(" . $stu->matricule . ")";
            Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription, session()->get('user')->name);
        }
        $payments = Payment::getPaymentByidStudent($idStudent);
        if ($payments != null) {
            foreach ($payments as $payment) {
                Payment::deletePayment($payment->idPayment);
            }
        }
        Attendance::deleteGroupAttendancebyidStudent($idStudent);
        GroupElements::cancelStudentAssignments($idStudent);
        User::deleteStudentAccount($idStudent);
        Student::deleteStudent($idStudent);
        return Redirect::route('student.liste')
            ->with('deleteMessage', "La suppression est faite avec succès")
            ->with('students', $studentInfo);
    }

    // -------------- Responsible -------------- //
    public function addResponsible(Request $request)
    {
        if ($request->has('addReponsible')) {
            $idResponsible = Responsible::addResponsible($request->cnie, $request->nom, $request->prenom, $request->numTel, $request->sexe);
            // Relate Responsible to Student
            Student::where('idStudent', $request->idStudent)->update(['idResponsible' => $idResponsible]);
            // Make A Reponsible Account
            return Redirect::back()->with('successMessage', "L'ajout du Responsable est faite avec succès");
        }
    }

    public function updateResponsible(Request $request, $idResponsible)
    {
        $Responsible = new Responsible();
        $Responsible->updateResponsible($idResponsible, $request->cnie, $request->nom, $request->prenom, $request->numTel, $request->sexe);
        return Redirect::back()->with('updateMessage', "La Modification du Responsable est faite avec succès");
    }

    public function deleteResponsible(Request $request, $idStudent, $idResponsible)
    {
        $Responsible = new Responsible();
        Student::where('idStudent', $request->idStudent)->update(['idResponsible' => NULL]);
        $Responsible->deleteResponsible($idResponsible);
        return Redirect::back()->with('deleteMessage', "La suppression du Responsable est faite avec succès");
    }


    // ----------- ARCHIVE ------------- //
    public function archive()
    {
        $groupSubjects = Group::existedGroupSubjects();
        $groupCourseTypes = Group::existedGroupCourseTypes();
        $students = Student::softDeletedStudents();
        return view('pages.students.studentArchive')->with('students', $students)
            ->with('subjects', $groupSubjects)
            ->with('courseTypes', $groupCourseTypes);
    }

    public function archivedStudent($idStudent)
    {
        $subjects = Group::existedGroupSubjects();
        $courseTypes = Group::existedGroupCourseTypes();
        $pendingPaiment = Payment::getStudentPendingPaiment($idStudent);
        $studentGroups = GroupElements::studentGroups($idStudent);
        $lastPaiments = Payment::getStudentLastestPaiments($idStudent);
        $invoiceGroups = Group::getGroupWithStudentInvoices($idStudent);
        $paiment = Payment::getStudentPaiment(101);
        $studentInfo = Student::getDeletedStudent($idStudent);
        return view('pages.students.archivedStudentProfil')->with([
            'student' => $studentInfo,
            'pendingPaiment' => $pendingPaiment,
            'subjects' => $subjects,
            'courseTypes' => $courseTypes,
            'studentGroups' => $studentGroups,
            'lastPaiments' => $lastPaiments,
            'invoiceGroups' => $invoiceGroups,
            'paiment' => $paiment
        ]);
    }

    public function restoreArchivedStudent($idStudent)
    {
        $payments = Payment::ArchivePaymentByidStudent($idStudent);
        if ($payments != null) {
            foreach ($payments as $payment) {
                Payment::restorePayment($payment->idPayment);
            }
        }
        User::restoreStudentAccount($idStudent);
        Student::restoreStudent($idStudent);
        $stu = Student::selectStudents($idStudent);
        if (session()->get('user')) {
            $typeActivity = 3;
            $activityDescription = 'Le étudiants' . " " . $stu->prenom_fr . " " . $stu->nom_fr . "(" . $stu->matricule . ")";
            Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription, session()->get('user')->name);
        }
        return Redirect::back()->with('restoreMessage', "L'étudiant a été restorer avec succès");
    }

    public function deleteArchivedStudent($idStudent)
    {
        $payments = Payment::ArchivePaymentByidStudent($idStudent);
        $stu = Student::getDeletedStudent($idStudent);
        if (session()->get('user')) {
            $typeActivity = 10;
            $activityDescription = 'Le étudiants' . " " . $stu->prenom_fr . " " . $stu->nom_fr . "(" . $stu->matricule . ")";
            Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription, session()->get('user')->name);
        }
        User::forceStudentAccount($idStudent);
        if ($stu->cnieResponsible != null) {
            Responsible::fordeleteResponsible($stu->cnieResponsible);
        }
        if ($payments != null) {
            foreach ($payments as $payment) {
                Payment::forceDeletePayment($payment->idPayment);
            }
        }
        Student::forceDeleteStudent($idStudent);
    
        return Redirect::back()->with('deleteMessage', "L'étudiant a été supprimer Définitivement");
    }

    public function multipleArchivedStudents(Request $request)
    {
        if ($request->has('restoreAll')) {
            foreach ($request->archivedStudents as $idStudent) {
                $payments = Payment::ArchivePaymentByidStudent($idStudent);
                if ($payments != null) {
                    foreach ($payments as $payment) {
                        Payment::restorePayment($payment->idPayment);
                    }
                }
                User::restoreStudentAccount($idStudent);
                Student::restoreStudent($idStudent);
                $stu = Student::selectStudents($idStudent);
                if (session()->get('user')) {
                    $typeActivity = 3;
                    $activityDescription = 'Le étudiants' . " " . $stu->prenom_fr . " " . $stu->nom_fr . "(" . $stu->matricule . ")";
                    Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription, session()->get('user')->name);
                }
            }
            return Redirect::back()->with('restoreMessage', "Les étudiants séléctionés ont été restorer avec succès");
        }
        if ($request->has('deleteAll')) {
            foreach ($request->archivedStudents as $idStudent) {
                $payments = Payment::ArchivePaymentByidStudent($idStudent);
                $studentInfo = Student::getStudent($idStudent);
                $Responsible = new Responsible();
                if ($studentInfo->cnieResponsible != 'NULL')
                    $Responsible->deleteResponsible($studentInfo->cnieResponsible, $idStudent);

                $stu = Student::getDeletedStudent($idStudent);
                if (session()->get('user')) {
                    $typeActivity = 10;
                    $activityDescription = 'Le étudiants' . " " . $stu->prenom_fr . " " . $stu->nom_fr . "(" . $stu->matricule . ")";
                    Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription, session()->get('user')->name);
                }
                User::forceStudentAccount($idStudent);
                if ($stu->cnieResponsible != null) {
                    Responsible::fordeleteResponsible($stu->cnieResponsible);
                }
                if ($payments != null) {
                    foreach ($payments as $payment) {
                        Payment::forceDeletePayment($payment->idPayment);
                    }
                }
                Student::forceDeleteStudent($idStudent);
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

    public function getGroupsBySubject($idSubject, $idStudent, $idGradeCategory)
    {
        $groups = Group::selectGroupsBySubject($idSubject, $idStudent, $idGradeCategory);
        for ($i=0; $i < $groups->count(); $i++) 
            $groups[$i]->grades = GroupGrades::getGroupGrades($groups[$i]->idGroup);
    
        return response()->json($groups);
    }


    //--------- Student ------------//
    public function getInvoicesByGroupAndStudent($idStudent, $idGroup)
    {
        if ($idGroup == 'null')
            $invoices = Payment::getStudentLastestPaiments($idStudent);
        else
            $invoices = Payment::getStudentLastestPaiments($idStudent, $idGroup);
        return response()->json($invoices);
    }
}
