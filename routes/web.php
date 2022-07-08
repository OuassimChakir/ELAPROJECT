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
Route::get('/niveau/categories','GradesController@gradesCategory')->name('gradesCategory');

// Subjects and Course Type
Route::get('/matieres/type','SubjectController@courseType')->name('courseType');
Route::get('/matieres','SubjectController@subjects')->name('subjects');
        // Add Course Type
    Route::post('/matieres/type/add','SubjectController@courseType')->name('courses.add');
        // Delete & Update Course Type
    Route::get('/matieres/type/{action}/{idCourseType}','SubjectController@actionCourseType')->name('courses.action');
        // Update a Course Type Query
    Route::put('/matieres/type/update/{idCourseType}','SubjectController@actionCourseType')->name('courses.update');
    Route::get('/matieres/type/action','SubjectController@courseType')->name('courses.action');

//  staff and student 
Route::get('/staff', 'StaffController@staff')->name('staff.liste');
//Route::get('/staff/add', 'StaffController@StaffType')->name('staff.add');
//Route::resource('Stafftype', 'StaffController');
