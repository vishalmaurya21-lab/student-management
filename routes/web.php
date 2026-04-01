<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
 
Route::get('/', function () { return view('welcome'); });
Route::get('/student',          [StudentController::class, 'index'])->name('student.index');
Route::post('/student',         [StudentController::class, 'store'])->name('student.store');
Route::get('student/dashboard', [StudentController::class, 'show'])->name('student.show');
Route::get('student/edit/{id}', [StudentController::class, 'edit'])->name('student.edit');
Route::put('student/{id}',      [StudentController::class, 'update'])->name('student.update');
Route::delete('student/{id}',   [StudentController::class, 'destroy'])->name('student.destroy'); 