<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SiswaController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SubjectController;

// Siswa Routes
Route::get('/', [SiswaController::class, 'index'])->name('siswa.index');
Route::post('/verify', [SiswaController::class, 'verify'])->name('siswa.verify');
Route::get('/status', [SiswaController::class, 'status'])->name('siswa.status');
Route::get('/download-transcript', [SiswaController::class, 'downloadTranscript'])->name('siswa.download');
Route::post('/siswa-logout', [SiswaController::class, 'logout'])->name('siswa.logout');

// Admin Auth
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login'); // Alias for auth middleware
Route::post('/admin/login', [LoginController::class, 'login']);
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

// Admin Protected Routes
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('students', StudentController::class);
    Route::resource('subjects', SubjectController::class);
    Route::get('students/{student}/grades', [StudentController::class, 'grades'])->name('students.grades');
    Route::post('students/{student}/grades', [StudentController::class, 'updateGrades'])->name('students.grades.update');
});