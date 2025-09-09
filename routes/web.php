<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
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



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard')->middleware('auth');;


// Login routes using AuthController
Route::get('/login', [AuthController::class,'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class,'login']);
Route::get('/logout', [AuthController::class,'logout'])->name('logout');
Route::post('/logout', [AuthController::class,'logout']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    Route::resource('employees', EmployeeController::class)->except(['show']);
    Route::get('/profile', [ProfileController::class, 'show'])->name('employee.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('employee.update');
});

// use App\Http\Controllers\ProfileController;
// Route::middleware(['auth', 'role:employee'])->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
// });
