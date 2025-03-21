<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;

// Halaman utama
Route::get('/', function () {
    return view('auth.login');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [UserController::class, 'login'])->name('login.post');

    Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [UserController::class, 'register'])->name('register.post');
});


// Logout hanya bisa diakses oleh user yang sudah login
Route::post('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');

// Task Management Routes (Langsung ke halaman tugas setelah login)
Route::middleware('auth')->group(function () {
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index'); // Menampilkan daftar tugas
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create'); // Form tambah tugas
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store'); // Simpan tugas baru
    Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show'); // Tampilkan detail tugas
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit'); // Form edit tugas
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update'); // Update tugas
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy'); // Hapus tugas
});
