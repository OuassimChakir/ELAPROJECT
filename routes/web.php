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

//  staff and student and responsible
    Route::get('/staff', 'StaffController@staff')->name('staff.liste');
    // Add Course staff
    Route::post('/staff/add', 'StaffController@staff')->name('staff.add');
    // Delete & Update Course Type
    Route::get('/staff/add/action','StaffController@staff')->name('staff.action');

    
// -------------- STUDENTS --------------------- //
    Route::get('/students', 'StudentController@student')->name('student.liste');
    Route::get('/students/{matricule}','StudentController@studentProfil')->name('student.profil');
    // Adding Student
    Route::post('/students/add', 'StudentController@student')->name('student.add');
    // Update Student
    Route::put('/students/update/{matricule}','StudentController@updateStudent')->name('student.update');
    // Delete Student
    Route::get('/students/delete/{matricule}','StudentController@deleteStudent')->name('student.delete');

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
    





?>

