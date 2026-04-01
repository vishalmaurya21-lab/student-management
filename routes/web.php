<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Student routes
Route::get('/student', [StudentController::class, 'index'])->name('student.index');
Route::post('/student', [StudentController::class, 'store'])->name('student.store');
Route::get('/student/dashboard', [StudentController::class, 'show'])->name('student.show');
Route::get('/student/edit/{id}', [StudentController::class, 'edit'])->name('student.edit');
Route::put('/student/{id}', [StudentController::class, 'update'])->name('student.update');
Route::delete('/student/{id}', [StudentController::class, 'destroy'])->name('student.destroy');

// Teacher routes
Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher.index');
Route::get('/teacher/create', [TeacherController::class, 'create'])->name('teacher.create');
Route::post('/teacher', [TeacherController::class, 'store'])->name('teacher.store');
Route::get('/teacher/{id}/edit', [TeacherController::class, 'edit'])->name('teacher.edit');
Route::put('/teacher/{id}', [TeacherController::class, 'update'])->name('teacher.update');
Route::delete('/teacher/{id}', [TeacherController::class, 'destroy'])->name('teacher.destroy');

// Grade routes
Route::get('/grade', [GradeController::class, 'index'])->name('grade.index');
Route::get('/grade/create', [GradeController::class, 'create'])->name('grade.create');
Route::post('/grade', [GradeController::class, 'store'])->name('grade.store');
Route::get('/grade/{id}/edit', [GradeController::class, 'edit'])->name('grade.edit');
Route::put('/grade/{id}', [GradeController::class, 'update'])->name('grade.update');
Route::delete('/grade/{id}', [GradeController::class, 'destroy'])->name('grade.destroy');

// Attendance routes
Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
Route::get('/attendance/report', [AttendanceController::class, 'report'])->name('attendance.report');
Route::delete('/attendance/{id}', [AttendanceController::class, 'destroy'])->name('attendance.destroy');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

// Welcome view (for non-authenticated users)
Route::get('/welcome', function () {
    return view('welcome');
});
