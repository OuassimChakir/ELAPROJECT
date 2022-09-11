<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TypestaffController;
use App\Http\Controllers\StudentController;
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

Route::get('/','HomeController@index')->name('acceuil');

// --------------- GRADES ------------ //
Route::get('/niveau','GradesController@grades')->name('grades');
        // Adding New Grade
    Route::post('/niveau/add','GradesController@grades')->name('grades.add');
        // Delete & Update Grade
    Route::get('/niveau/{action}/{idGrade}','GradesController@actionGrade')->name('grades.action');
        // Update a Grade Query
    Route::put('/niveau/update/{idGrade}','GradesController@actionGrade')->name('grades.update');

// --------------- Grades Categories ------------ //
Route::get('/niveau/categories','GradesController@gradesCategory')->name('gradesCategory');
        // Adding New Grade Category
    Route::post('/niveau/categories/add','GradesController@gradesCategory')->name('gradesCategory.add');
        // Delete & Update Category
    Route::get('/niveau/categories/{action}/{idGradeCategory}','GradesController@actionGradeCategory')->name('gradesCategory.action');
        // Update a Category Query
    Route::put('/niveau/categories/update/{idGradeCategory}','GradesController@actionGradeCategory')->name('gradesCategory.update');

// ------------ Course Type ----------- //
Route::get('/matieres/type','SubjectController@courseType')->name('courseType');
        // Add Course Type
    Route::post('/matieres/type/add','SubjectController@courseType')->name('courses.add');
        // Delete & Update Course Type
    Route::get('/matieres/type/{action}/{idCourseType}','SubjectController@actionCourseType')->name('courses.action');
        // Update a Course Type Query
    Route::put('/matieres/type/update/{idCourseType}','SubjectController@actionCourseType')->name('courses.update');

// ---------------- Subjects ------------- //
Route::get('/matieres','SubjectController@subjects')->name('subjects');
    // Add New Subject
    Route::post('/matiere/add','SubjectController@subjects')->name('subjects.add');
    // Delete & Update Subject
    Route::get('/matieres/{action}/{idSubject}','SubjectController@actionSubject')->name('subjects.action');
    // Update a Subject Query
    Route::put('/matieres/update/{idSubject}','SubjectController@actionSubject')->name('subjects.update');

// ------------------ STAFF ----------------------- //
    Route::get('/staff', 'StaffController@staff')->name('staff.liste');
    // Add staff
    Route::post('/staff/add', 'StaffController@staff')->name('staff.add');
    // Update Staff
    Route::put('/staff/update/{idStaff}','StaffController@updateStaff')->name('staff.update');
    // Delete Staff
    Route::get('/staff/delete/{idStaff}','StaffController@deleteStaff')->name('staff.delete');
    Route::delete('/staff/deleteAll','StaffController@deleteMultipleStaff')->name('staff.delete.multiple');
    // Staff Profil
    Route::get('/staff/{idStaff}-{nom}','StaffController@staffProfil')->name('staff.profil');
    
    // ARCHIVED Staff
    Route::get('/archive/staff','StaffController@archive')->name('staff.archive');
    Route::get('/archive/staff/{idStaff}','StaffController@archivedStaff')->name('staff.archive.profil');
    Route::get('/archive/staff/delete/{idStaff}','StaffController@deleteArchivedStaff')->name('staff.archive.delete');
    Route::get('/archive/staff/restore/{idStaff}','StaffController@restoreArchivedStaff')->name('staff.archive.restore');
    Route::post('/archive/staff/action','StaffController@multipleArchivedStaff')->name('staff.archive.multiple');

    
// ------------------ TEACHERS ----------------------- //
    Route::get('/teachers', 'TeacherController@teacher')->name('teachers.liste');
    // Add staff
    Route::post('/teacher/add', 'TeacherController@teacher')->name('teachers.add');
    // Update Staff
    Route::put('/teacher/update/{idProfesseur}','TeacherController@updateTeacher')->name('teachers.update');
    // Delete Staff
    Route::get('/teacher/delete/{idProfesseur}','TeacherController@deleteTeacher')->name('teachers.delete');
    Route::delete('/teacher/delete','TeacherController@deleteMultipleTeachers')->name('teachers.delete.multiple');
    // Staff Profil
    Route::get('/teacher/{idProfesseur}-{nom}','TeacherController@teacherProfil')->name('teachers.profil');

     // ARCHIVED Teachers
    Route::get('/archive/teachers','TeacherController@archive')->name('teachers.archive');
    Route::get('/archive/teacher/{idProfesseur}','TeacherController@archivedTeacher')->name('teachers.archive.profil');
    Route::get('/archive/teachers/delete/{idProfesseur}','TeacherController@deleteArchivedTeacher')->name('teachers.archive.delete');
    Route::get('/archive/teachers/restore/{idProfesseur}','TeacherController@restoreArchivedTeacher')->name('teachers.archive.restore');
    Route::post('/archive/teachers/action','TeacherController@multipleArchivedTeachers')->name('teachers.archive.multiple');

// ----------------- STAFF TYPE ------------------ //
    Route::get('/specialites', 'StaffController@staffType')->name('specialite');
    // Add staff Type
    Route::post('/specialites/add', 'StaffController@staffType')->name('specialite.add');
    // Delete Staff Type
    Route::get('/specialites/delete/{idStaffType}','StaffController@deleteStaffType')->name('specialite.delete');
    // Update Staff Type
    Route::get('/specialites/update/{idStaffType}','StaffController@updateStaffType')->name('specialite.update');
    Route::put('/specialites/update/{idStaffType}','StaffController@updateStaffType')->name('specialite.update.request');

// -------------- STUDENTS --------------------- //
    Route::get('/students', 'StudentController@student')->name('student.liste');
    Route::get('/students/{matricule}','StudentController@studentProfil')->name('student.profil');
    // Adding Student
    Route::post('/students/add', 'StudentController@student')->name('student.add');
    // Update Student
    Route::put('/students/update/{matricule}','StudentController@updateStudent')->name('student.update');
    // Delete Student
    Route::get('/students/delete/{matricule}','StudentController@deleteStudent')->name('student.delete');
    Route::delete('/staff/delete','StudentController@deleteMultipleStudents')->name('student.delete.multiple');


    // ARCHIVED STUDENTS
    Route::get('/archive/students','StudentController@archive')->name('student.archive');
    Route::get('/archive/students/{matricule}','StudentController@archivedStudent')->name('student.archive.profil');
    Route::get('/archive/students/delete/{matricule}','StudentController@deleteArchivedStudent')->name('student.archive.delete');
    Route::get('/archive/students/restore/{matricule}','StudentController@restoreArchivedStudent')->name('student.archive.restore');
    Route::post('/archive/students/action','StudentController@multipleArchivedStudents')->name('student.archive.multiple');
// -------------- Responsibles --------------------- //
    // Adding Responsible
    Route::post('/responsible/add', 'StudentController@addResponsible')->name('responsible.add');
    // Update Responsible
    Route::put('/responsible/update/{cnieResponsible}','StudentController@updateResponsible')->name('responsible.update');
    // Delete Responsible
    Route::get('student/{matricule}/delete/{cnieResponsible}','StudentController@deleteResponsible')->name('responsible.delete');
    

// --------------- Groupes ------------------ //
    Route::get('/groupes','GroupController@groups')->name('groups');
    Route::post('/groupes/add','GroupController@groups')->name('groups.add');
    // Load Data
    Route::get('/groupes/get/{idGradeCategory}','GroupController@getGrade')->name('groups.getData');

    // Group Page
    Route::get('/groupe/{idGroup}','GroupController@groupPage')->name('groups.profil');
    Route::put('/groupe/update/{idGroup}','GroupController@updateGroup')->name('groups.update');
    // Delete Group
    Route::get('/groupes/delete/{idGroup}','GroupController@deleteGroup')->name('groups.delete');
    // Delete Group
    Route::post('/absence/ajout/{idGroup}','GroupController@addAbsence')->name('absence.ajout');

// ------------- Classroom ---------- // 
    // Add Student to Group
    Route::get('/groupes/{idGroup}/classroom/{matricule}','StudentController@assignClassroom');

    // Remove From Classroom
    Route::get('/classrooms/remove/{id}','GroupController@cancelAssignment')->name('classroom.cancelAssignment');
    
    // JSON DATA
    Route::get('/students/get/{idSubject}','StudentController@getGroupsByGrade');
    Route::get('/students/getGroups/{idSubject}-{idGrade}-{matricule}','StudentController@getGroupsByGradeAndSubject');


?>


