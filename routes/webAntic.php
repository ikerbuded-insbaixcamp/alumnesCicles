<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomeController::class);

Route::get('/students', [StudentController::class, 'read'])->name('students.read');

Route::get('/students/show/{id}', [StudentController::class, 'show'])->name('students.show');

Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');

Route::post('/students/store', [StudentController::class, 'store'])->name('students.store');

Route::get('/students/edit/{id}', [StudentController::class, 'edit'])->name('students.edit');

Route::put('/students/update/{id}', [StudentController::class, 'update'])->name('students.update');

Route::get('/students/delete/{id}', [StudentController::class, 'delete'])->name('students.delete');
