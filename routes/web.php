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
    // add responsible
    // Student 
    Route::get('/student', 'StudentController@Student')->name('student.liste');

    




?>

//  staff and student 
Route::get('/staff', 'StaffController@staff')->name('staff.liste');
//Route::get('/staff/add', 'StaffController@StaffType')->name('staff.add');
//Route::resource('Stafftype', 'StaffController');
