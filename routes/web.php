<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TypestaffController;
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
// GRADES
Route::get('/niveau','GradesController@grades')->name('grades');
// Grades Categories
Route::get('/niveau/categories','GradesController@gradesCategory')->name('gradesCategory');
    // Adding New Grade Category
    Route::post('/niveau/categories/add','GradesController@gradesCategory')->name('gradesCategory.add');
// Subjects and Course Type
Route::get('/matieres/type','SubjectController@courseType')->name('courseType');
Route::get('/matieres','SubjectController@subjects')->name('subjects');
        // Add Course Type
    Route::post('/matieres/type/add','SubjectController@courseType')->name('courses.add');
        // Delete & Update Course Type
    Route::get('/matieres/type/{action}/{idCourseType}','SubjectController@actionCourseType')->name('courses.action');
        // Update a Course Type Query
    Route::put('/matieres/type/update/{idCourseType}','SubjectController@actionCourseType')->name('courses.update');

    // Add New Subject
    Route::post('/matiere/add','SubjectController@subjects')->name('subjects.add');
    // Delete & Update Subject
    Route::get('/matieres/{action}/{idSubject}','SubjectController@actionSubject')->name('subjects.action');
    // Update a Subject Query
    Route::put('/matieres/update/{idSubject}','SubjectController@actionSubject')->name('subjects.update');


//  staff and student 
Route::get('/staff', 'StaffController@staff')->name('staff.liste');
//Route::get('/staff/add', 'StaffController@StaffType')->name('staff.add');
//Route::resource('Stafftype', 'StaffController');
