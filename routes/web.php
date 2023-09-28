<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomesController;
use App\Http\Controllers\ActiviteController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\GradesController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SpecialiteController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
|--------------------------------------------------------------------------
| Accounts
|--------------------------------------------------------------------------
|
| admin : admin123
| BMA-S4	 : KDN1bmQX
| BMA9 : dMTprPJv
| BMA-P5 : 9OAiikax
*/


/* --------------------------------------
/ Authentification
/ --------------------------------------- */
// Route::get("/login",[UserController::class, 'login'])->name('login');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('acceuil');

    /* ---------------------------------
    / Students Routes
    / ---------------------------------*/
    Route::middleware(['is_student'])->group(function () {
        Route::get('/student/{idStudent}', [StudentController::class, 'studentProfil'])->name('student.profil');
        Route::get('/student/incomes/{idStudent}', [IncomesController::class, 'studentPaiments'])->name('student.incomes');
        Route::post('/student/incomes/{idStudent}', [IncomesController::class, 'studentPaiments'])->name('student.incomes.query');
    });

    /* ---------------------------------
    / Teacher Routes
    / ---------------------------------*/
    Route::middleware(['is_teacher'])->group(function () {
        Route::get('/teacher/{idProfesseur}', [TeacherController::class, 'teacherProfil'])->name('teachers.profil');
        Route::get('/teacher/factures/{idProfesseur}', [ExpenseController::class, 'profFactures'])->name('teachers.factures');
        Route::post('/teacher/factures/{idProfesseur}', [ExpenseController::class, 'profFactures'])->name('teachers.factures.query');
        Route::get('/teacher/pdf/{idExpensePayment}', [PdfController::class, 'pdf'])->name('teachers.pdf');
        // Mark Attendance
        Route::post('/groupe/{idGroup}/markAttendance', [AttendanceController::class, 'addAbsence'])->name('absence.add');
    });
    /* ---------------------------------
    / Groups
    / ---------------------------------*/
    Route::get('/groupes', [GroupController::class, 'groups'])->name('groups');
    Route::get('/groupe/{idGroup}', [GroupController::class, 'groupPage'])->name('groups.profil');

    //----------------- Absence -------------------//    
    Route::get('/attendance', [AttendanceController::class, 'allAbsences'])->name('absence');
    Route::post('/attendance', [AttendanceController::class, 'allAbsences'])->name('getAttendance');

    // Attendance AJAX
    Route::get('/attendance/{idGroup}/{dateAbsence}', [AttendanceController::class, 'getAttendanceMonthDates']);

    // Expenses AJAX
    Route::get('/teacher/groups/{idProfesseur}',[ExpenseController::class,'teacherGroups'])->name('teacher.groups.ajax');


    // ----- pdf de facture
    Route::get('/pdf/{idExpensePayment}', [PdfController::class, 'pdf'])->name('pdf.generate');


    Route::get('/student/{idStudent}/groupPaiment/{idGroup}', [StudentController::class, 'getInvoicesByGroupAndStudent']);


    Route::get('/dashboard', function () {
        return redirect()->route('acceuil');
    })->name('dashboard');



    // Moderator Permission View
    Route::middleware(['is_moderator'])->group(function () {
        
        // Staff Profil
        Route::get('/staff/{idStaff}', [StaffController::class, 'staffProfil'])->name('staff.profil');

        // Update Attendance
        Route::get('/attendance/update/{idGroup}-{dateAbsence}', [AttendanceController::class, 'updateAttendanceAjax']);
        Route::post('/attendance/update', [AttendanceController::class, 'updateAttendance'])->name('attendance.update');
        Route::post('/attendance/delete', [AttendanceController::class, 'deleteAttendance'])->name('attendance.delete');
        /* -----------------------------------------------
        / GRADES
        / --------------------------------------------- */
        Route::get('/niveau', [GradesController::class, 'grades'])->name('grades');
        // Adding New Grade
        Route::post('/niveau/add', [GradesController::class, 'grades'])->name('grades.add');
        // Update a Grade Query
        Route::get('/niveau/update/{idGrade}', [GradesController::class, 'updateGrade'])->name('grades.update');
        Route::put('/niveau/update/{idGrade}', [GradesController::class, 'updateGrade'])->name('grades.update.query');

        // Delete a Grade
        Route::get('/niveau/delete/{idGrade}', [GradesController::class, 'deleteGrade'])->name('grades.delete');

        /* -----------------------------------------------
        / GRADES Categories
        / --------------------------------------------- */
        Route::get('/niveau/categories', [GradesController::class, 'gradesCategory'])->name('gradesCategory');
        // Adding New Grade Category
        Route::post('/niveau/categories/add', [GradesController::class, 'gradesCategory'])->name('gradesCategory.add');
        // Update Category
        Route::get('/niveau/categories/update/{idGradeCategory}', [GradesController::class, 'updateGradeCategory'])->name('gradesCategory.update');
        Route::put('/niveau/categories/update/{idGradeCategory}', [GradesController::class, 'updateGradeCategory'])->name('gradesCategory.update.query');
        // Delete a Category Query
        Route::get('/niveau/categories/delete/{idGradeCategory}', [GradesController::class, 'deleteGradeCategory'])->name('gradesCategory.delete');


        /* -----------------------------------------------
        / Course Type
        / --------------------------------------------- */
        Route::get('/matieres/type', [SubjectController::class, 'courseType'])->name('courseType');
        // Add Course Type
        Route::post('/matieres/type/add', [SubjectController::class, 'courseType'])->name('courses.add');

        // Delete Course Type
        Route::get('/matieres/type/delete/{idCourseType}', [SubjectController::class, 'deleteCourseType'])->name('courses.delete');

        // Update a Course Type
        Route::get('/matieres/type/update/{idCourseType}', [SubjectController::class, 'updateCourseType'])->name('courses.update');
        Route::put('/matieres/type/update/{idCourseType}', [SubjectController::class, 'updateCourseType'])->name('courses.update.query');


        /* -----------------------------------------------
        / Subjects
        / --------------------------------------------- */
        Route::get('/matieres', [SubjectController::class, 'subjects'])->name('subjects');
        // Add New Subject
        Route::post('/matiere/add', [SubjectController::class, 'subjects'])->name('subjects.add');
        // Delete & Update Subject
        Route::get('/matieres/delete/{idSubject}', [SubjectController::class, 'deleteSubject'])->name('subjects.delete');
        // Update a Subject Query
        Route::get('/matieres/update/{idSubject}', [SubjectController::class, 'updateSubject'])->name('subjects.update');
        Route::put('/matieres/update/{idSubject}', [SubjectController::class, 'updateSubject'])->name('subjects.update.query');

        /* -----------------------------------------------
        / Teachers
        / --------------------------------------------- */
        Route::get('/teachers', [TeacherController::class, 'teacher'])->name('teachers.liste');
        // Add staff
        Route::post('/teacher/add',  [TeacherController::class, 'teacher'])->name('teachers.add');

        /* -----------------------------------------------
        / Students
        / --------------------------------------------- */
        Route::get('/students', [StudentController::class, 'students'])->name('student.liste');
        // Adding Student
        Route::get('/students/add', [StudentController::class, 'addStudent'])->name('student.add.page');
        Route::post('/students/add', [StudentController::class, 'addStudent'])->name('student.add');
        // Update Student
        Route::put('/students/update/{idStudent}', [StudentController::class, 'updateStudent'])->name('student.update');

        /* -----------------------------------------------
        / Responsibles
        / --------------------------------------------- */
        // Adding Responsible
        Route::post('/responsible/add', [StudentController::class, 'addResponsible'])->name('responsible.add');
        // Update Responsible
        Route::put('/responsible/update/{idResponsible}', [StudentController::class, 'updateResponsible'])->name('responsible.update');
        // Delete Responsible
        Route::get('student/{idStudent}/delete/{idResponsible}', [StudentController::class, 'deleteResponsible'])->name('responsible.delete');


        /* -----------------------------------------------
        / Groups
        / --------------------------------------------- */
        Route::post('/groupes/add', [GroupController::class, 'groups'])->name('groups.add');
        Route::get('/groupes/delete/{idGroup}', [GroupController::class, 'deleteGroup'])->name('groups.delete');
        Route::put('/groupe/update/{idGroup}', [GroupController::class, 'updateGroup'])->name('groups.update');
        // Load Data
        Route::get('/groupes/get/{idGradeCategory}', [GroupController::class, 'getGrade'])->name('groups.getData');

        /* -----------------------------------------------
        / Classroom (GroupElement)
        / --------------------------------------------- */
        // Add Student to Group
        Route::get('/groupes/{idGroup}/classroom/{idStudent}', [GroupController::class, 'assignElement']);

        // Remove From Classroom
        Route::get('/classrooms/remove/{idElement}', [GroupController::class, 'cancelAssignment'])->name('classroom.cancelAssignment');

        // multiple remove from classroom
        Route::delete('/classroom/multipleRemove', [GroupController::class, 'multipleCancelAssignment'])->name('classroom.multipleCancel');

        // JSON DATA
        Route::get('/students/get/{idSubject}', [StudentController::class, 'getGroupsByGrade']);
        Route::get('/students/getGroups/{idSubject}/{idStudent}/{idGradeCategory}', [StudentController::class, 'getGroupsBySubject']);

        /* -----------------------------------------------
        / Income Type
        / --------------------------------------------- */
        Route::get('/typeIncome', [IncomesController::class, 'allIncomes'])->name('typeIncome');
        // Add New typeIncomes
        Route::post('/typeIncome/add', [IncomesController::class, 'allIncomes'])->name('typeIncome.add');
        // Serach etudiant
        Route::get('/typeIncome/search', [IncomesController::class, 'searchEtudiant'])->name('search.etudiant');
        Route::get('/typeIncome/search/group', [IncomesController::class, 'searchGroup'])->name('search.group');
        Route::get('/typeIncome/Serach/Recu', [IncomesController::class, 'searchRecu'])->name('search.numRecu');
        // Delete search
        Route::get('/typeIncome/delete/{idIncome}', [IncomesController::class, 'deleteIncome'])->name('typeIncome.delete');
        // Update a typeIncomes
        Route::get('/typeIncome/update/{idIncome}', [IncomesController::class, 'updateIncome'])->name('typeIncome.update.page');
        Route::put('/typeIncome/update/{idIncome}', [IncomesController::class, 'updateIncome'])->name('typeIncome.update');


        /* -----------------------------------------------
        / Incomes Paiments
        / --------------------------------------------- */
        Route::post('/incomePayment/add', [IncomesController::class, 'allPayment'])->name('incomePayment.add');
        // Delete Incomes Payment 
        Route::get('/bmapaiment/delete/{idPayment}', [IncomesController::class, 'deletePayment'])->name('incomePayment.delete');
        Route::get('/bmapaiment/{idPayment}', [IncomesController::class, 'paimentPage'])->name('paiment');
        Route::get('/getbmapaiment/{idPayment}', [IncomesController::class, 'ajaxPaimentModal']);
        Route::post('/bmapaiment/{idPayment}', [IncomesController::class, 'paimentPage'])->name('paiment.validate');


        /* -----------------------------------------------
        / ARCHIVE
        / --------------------------------------------- */
        // ARCHIVED STUDENTS
        Route::get('/archive/students', [StudentController::class, 'archive'])->name('student.archive');
        Route::get('/archive/students/{idStudent}', [StudentController::class, 'archivedStudent'])->name('student.archive.profil');
        Route::get('/archive/students/restore/{idStudent}', [StudentController::class, 'restoreArchivedStudent'])->name('student.archive.restore');
    
        /* -----------------------------------------------
        / Notes
        / --------------------------------------------- */
        Route::post('/notes/',[NotesController::class,'addNote'])->name('notes.add');
        Route::delete('/notes/delete',[NotesController::class,'deleteNote'])->name('notes.delete');
        
    });

    // Admin Permission View
    Route::middleware(['is_admin'])->group(function () {
        /* --------------------------------------
        / Incomes Statistics 
        / --------------------------------------- */
        Route::get('stats', [IncomesController::class, 'incomeStats'])->name('incomes.stats');
        Route::post('stats', [IncomesController::class, 'incomeStats'])->name('incomes.stats.query');

        /* --------------------------------------
        / activites 
        / --------------------------------------- */
        Route::get('/activites', [ActiviteController::class, 'activite'])->name('activite');
        Route::post('/activites', [ActiviteController::class, 'activite'])->name('activite.date');
        Route::delete('/activites/delete', [ActiviteController::class, 'activitedeleteAll'])->name('activite.delete.all');

        /* --------------------------------------
        / Settings 
        / --------------------------------------- */
        Route::get('/settings', [SettingController::class, 'index'])->name('settings');
        Route::post('/settings', [SettingController::class, 'index'])->name('settings.reset');

        /* --------------------------------------
        / Teachers 
        / --------------------------------------- */
        // Update Staff
        Route::put('/teacher/update/{idProfesseur}',  [TeacherController::class, 'updateTeacher'])->name('teachers.update');
        // Delete Staff
        Route::get('/teacher/delete/{idProfesseur}', [TeacherController::class, 'deleteTeacher'])->name('teachers.delete');
        Route::delete('/teacher/delete', [TeacherController::class, 'deleteMultipleTeachers'])->name('teachers.delete.multiple');

        /* --------------------------------------
        / Roles 
        / --------------------------------------- */
        Route::get('/roles', [RolesController::class, 'role'])->name('roles');
        // Delete roles
        Route::get('/roles/delete/{idRole}', [RolesController::class, 'deleteRoles'])->name('roles.delete');
        // Update roles
        Route::get('/roles/update/{idRole}', [RolesController::class, 'updateRoles'])->name('roles.update.page');
        Route::put('/roles/update/{idRole}', [RolesController::class, 'updateRoles'])->name('roles.update');


        /* --------------------------------------
        / Staffs 
        / --------------------------------------- */
        Route::get('/staff', [StaffController::class, 'staff'])->name('staff.liste');
        // Add staff
        Route::post('/staff/add', [StaffController::class, 'staff'])->name('staff.add');
        // Update Staff
        Route::put('/staff/update/{idStaff}', [StaffController::class, 'updateStaff'])->name('staff.update');
        // Delete Staff
        Route::get('/staff/delete/{idStaff}', [StaffController::class, 'deleteStaff'])->name('staff.delete');
        Route::delete('/staff/deleteAll', [StaffController::class, 'deleteMultipleStaff'])->name('staff.delete.multiple');

        // Speciality
        Route::get('/specialites', [SpecialiteController::class, 'staffType'])->name('specialite');
        // Add staff Type
        Route::post('/specialites/add', [SpecialiteController::class, 'staffType'])->name('specialite.add');
        // Update Staff Type
        Route::get('/specialites/update/{idStaffType}', [SpecialiteController::class, 'updateStaffType'])->name('specialite.update');
        Route::put('/specialites/update/{idStaffType}', [SpecialiteController::class, 'updateStaffType'])->name('specialite.update.request');
        Route::get('/specialites/delete/{idStaffType}', [SpecialiteController::class, 'deleteStaffType'])->name('specialite.delete');

        /* --------------------------------------
        / Users 
        / --------------------------------------- */
        Route::get('/utilisateurs', [UserController::class, 'users'])->name('users');
        Route::post('/utilisateurs/add', [UserController::class, 'register'])->name('users.add');
        Route::get('/utilisateur/delete/{id}',[UserController::class,'softDeleteUser'])->name('user.delete');
        /* -----------------------------------------------
        / Expenses
        / --------------------------------------------- */
        Route::get('/typeDepenses', [ExpenseController::class, 'allExpenses'])->name('typeDepenses');
        // Add New Expenses
        Route::post('/typeDepenses/add', [ExpenseController::class, 'allExpenses'])->name('typeDepenses.add');
        // Delete Expenses
        Route::get('/typeDepenses/delete/{idExpense}', [ExpenseController::class, 'deleteExpense'])->name('typeDepenses.delete');
        // Update a Expenses
        Route::get('/typeDepenses/update/{idExpense}', [ExpenseController::class, 'updateExpense'])->name('typeDepenses.update.page');
        Route::put('/typeDepenses/update/{idExpense}', [ExpenseController::class, 'updateExpense'])->name('typeDepenses.update');

        /* -----------------------------------------------
        / Expenses Invoices (Paiment)
        / --------------------------------------------- */
        Route::get('/factureDepenses', [ExpenseController::class, 'allFacture'])->name('factureDepenses');
        // Add New Facture
        Route::post('/factureDepenses/add', [ExpenseController::class, 'allFacture'])->name('factureDepenses.add');
        // Delete Facture
        Route::get('/factureDepenses/delete/{idExpensePayment}', [ExpenseController::class, 'deleteFacture'])->name('factureDepenses.delete');
        // Facture Staff Data Ajax
        Route::get('/factureDepenses/{idExpense}', [ExpenseController::class, 'getStaffData']);

        /* -----------------------------------------------
        / ARCHIVE
        / --------------------------------------------- */
        // Archive Teachers
        Route::get('/archive/teachers/delete/{idProfesseur}', [TeacherController::class, 'deleteArchivedTeacher'])->name('teachers.archive.delete');
        Route::post('/archive/teachers/action', [TeacherController::class, 'multipleArchivedTeachers'])->name('teachers.archive.multiple');

        // Depenses Archive
        Route::get('/archive/factureDepenses', [ExpenseController::class, 'archive'])->name('factureDepenses.archive');
        Route::get('/archive/factureDepenses/restore/{idExpensePayment}', [ExpenseController::class, 'restoreArchivedFacture'])->name('factureDepenses.archive.restore');
        Route::post('/archive/factureDepenses/action', [ExpenseController::class, 'multipleArchivedFacture'])->name('factureDepenses.archive.multiple');
        Route::get('/archive/factureDepenses/delete/{idExpensePayment}', [ExpenseController::class, 'deleteArchivedFacture'])->name('factureDepenses.archive.delete');

        // Incomes
        Route::post('/archive/incomePayment/action', [IncomesController::class, 'multipleArchivedPayment'])->name('incomePayment.archive.multiple');
        Route::get('/archive/incomePayment/delete/{idPayment}', [IncomesController::class, 'deleteArchivedPayment'])->name('incomePayment.archive.delete');

        // Students Archive
        Route::post('/archive/students/action', [StudentController::class, 'multipleArchivedStudents'])->name('student.archive.multiple');
        Route::get('/archive/students/delete/{idStudent}', [StudentController::class, 'deleteArchivedStudent'])->name('student.archive.delete');

        // Delete Student
        Route::get('/students/delete/{idStudent}', [StudentController::class, 'deleteStudent'])->name('student.delete');
        Route::delete('/staff/delete', [StudentController::class, 'deleteMultipleStudents'])->name('student.delete.multiple');

        // Delete & Update Grade
        Route::get('/niveau/{action}/{idGrade}', [GradesController::class, 'actionGrade'])->name('grades.action');

        // Reset user password
        Route::post('/resetPassword/', [UserController::class, 'resetPassword'])->name('resetPassword');

        // ARCHIVED Staff
        Route::get('/archive/staff', [StaffController::class, 'archive'])->name('staff.archive');
        Route::get('/archive/staff/{idStaff}', [StaffController::class, 'archivedStaff'])->name('staff.archive.profil');
        Route::get('/archive/staff/restore/{idStaff}', [StaffController::class, 'restoreArchivedStaff'])->name('staff.archive.restore');
        Route::post('/archive/staff/action', [StaffController::class, 'multipleArchivedStaff'])->name('staff.archive.multiple');
        Route::get('/archive/staff/delete/{idStaff}', [StaffController::class, 'deleteArchivedStaff'])->name('staff.archive.delete');
        
        
        Route::get('/groupe/{idGroup}/revenus/{datePayment}',[IncomesController::class,'groupPayments'])->name('group.incomes');

        Route::get('/incomePayment', [IncomesController::class,'allPayment'])->name('incomePayment');
        // Add New Incomes Payment 
		
		// ARCHIVED Incomes Payment 
        Route::get('/archive/incomePayment',[IncomesController::class, 'archive'])->name('incomePayment.archive');
        Route::get('/archive/incomePayment/restore/{idPayment}',[IncomesController::class, 'restoreArchivedPayment'])->name('incomePayment.archive.restore');
        
        // ARCHIVED Teachers
        Route::get('/archive/teachers', [TeacherController::class, 'archive'])->name('teachers.archive');
        Route::get('/archive/teacher/{idProfesseur}', [TeacherController::class, 'archivedTeacher'])->name('teachers.archive.profil');
        Route::get('/archive/teachers/restore/{idProfesseur}', [TeacherController::class, 'restoreArchivedTeacher'])->name('teachers.archive.restore');
    });
});
