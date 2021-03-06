<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('student', [App\Http\Controllers\StudentController::class, 'index']);

// Route::post('/addstudent', [App\Http\Controllers\StudentController::class, 'store']);

Route::get('/ajax', [App\Http\Controllers\TeacherController::class, 'index']);
Route::get('/teacher/all', [App\Http\Controllers\TeacherController::class, 'allData']);
Route::get('/teacher/store', [App\Http\Controllers\TeacherController::class, 'storeData']);