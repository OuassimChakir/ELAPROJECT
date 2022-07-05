<?php

use App\Http\Controllers\HomeController;
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
Route::post('/matieres/type/add','SubjectController@courseType')->name('courses.add');
Route::get('/matieres/type/action','SubjectController@courseType')->name('courses.action');