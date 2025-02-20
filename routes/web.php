<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware(['guest'])->group(function () {
//     Route::get('/', [SesiController::class, 'index']);
//     Route::post('/', [SesiController::class, 'login']);
// });

// Route::middleware(['auth'])->group(function () {

//     Route::get('/allDashboard', function () {
//         return view('allDashboard');
//     })->name('allDashboard');
//     // Dashboard
//     Route::get('/dashboard', function () {
//         // $role = Auth::check() && Auth::user()->role == 'sm';
//         $role = Auth::check() ? Auth::user()->role : null;
//         if ($role === 'admin') {
//             return redirect()->route('adminDashboard');
//         } else {
//             return redirect()->route('userDashboard');
//         }
//     })->name('dashboard');

//     // Users Management (Admin Only)
//     Route::middleware([AdminMiddleware::class . ':admin'])->group(function () {
//         Route::resource('users', UserController::class);
//         // Route::get('userlist', [UserController::class, 'index'])->name('users.list');
//     });

//     // Logout
//     Route::post('/logout', [SesiController::class, 'logout'])->name('logout');
// });

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login/auth', [AuthController::class, 'loginAuth'])->name('auth.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');