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

Route::get('/student', [App\Http\Controllers\StudentController::class, 'index'])->name('student.index');
Route::get('/student/all', [App\Http\Controllers\StudentController::class, 'allData'])->name('student.allData');
Route::post('/addstudent', [App\Http\Controllers\StudentController::class, 'store'])->name('student.store');
Route::put('/updatestudent', [App\Http\Controllers\StudentController::class, 'update'])->name('student.update');
Route::delete('/deletestudent', [App\Http\Controllers\StudentController::class, 'delete'])->name('student.delete');

// Route::post('/addstudent', [App\Http\Controllers\StudentController::class, 'store']);

Route::get('/ajax', [App\Http\Controllers\TeacherController::class, 'index']);
Route::get('/teacher/all', [App\Http\Controllers\TeacherController::class, 'allData']);
Route::post('/teacher/store', [App\Http\Controllers\TeacherController::class, 'storeData'])->name('teacher.store');
Route::get('/teacher/edit', [App\Http\Controllers\TeacherController::class, 'editData'])->name('teacher.edit');
Route::put('/teacher/update', [App\Http\Controllers\TeacherController::class, 'updateData'])->name('teacher.update');
Route::delete('/teacher/delete', [App\Http\Controllers\TeacherController::class, 'deleteData'])->name('teacher.delete');