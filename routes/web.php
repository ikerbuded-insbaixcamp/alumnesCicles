<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CicleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/

Route::get('/dashboard', HomeController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::get('/students', [StudentController::class, 'read'])->name('students.read');

    Route::get('/students/show/{id}', [StudentController::class, 'show'])->name('students.show');

    Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');

    Route::post('/students/store', [StudentController::class, 'store'])->name('students.store');

    Route::get('/students/edit/{id}', [StudentController::class, 'edit'])->name('students.edit');

    Route::put('/students/update/{id}', [StudentController::class, 'update'])->name('students.update');

    Route::get('/students/delete/{id}', [StudentController::class, 'delete'])->name('students.delete');

    Route::get('/cicles/show/{id}', [CicleController::class, 'show'])->name('cicles.show');

    Route::get('/cicles/create', [CicleController::class, 'create'])->name('cicles.create');

    Route::post('/cicles/store', [CicleController::class, 'store'])->name('cicles.store');

    Route::get('/cicles/edit/{id}', [CicleController::class, 'edit'])->name('cicles.edit');

    Route::put('/cicles/update/{id}', [CicleController::class, 'update'])->name('cicles.update');

    Route::get('/cicles/delete/{id}', [CicleController::class, 'delete'])->name('cicles.delete');

    Route::get('/students/assignarCicle/{id}', [StudentController::class, 'assignarCicle'])->name('student.assignarCicle');

    Route::get('/students/desAssignarCicle', [StudentController::class, 'desAssignarCicle'])->name('student.desAssignarCicle');
});

require __DIR__ . '/auth.php';
