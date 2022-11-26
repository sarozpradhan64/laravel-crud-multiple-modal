<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
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



Route::get('/', [StudentController::class, 'ShowStudents']);
Route::post('create', [StudentController::class, 'CreateStudent'])->name('student.create');
Route::post('update/{id}', [StudentController::class, 'UpdateStudents'])->name('student.update');
Route::get('delete/{id}', [StudentController::class, 'DeleteStudent'])->name('student.delete');
