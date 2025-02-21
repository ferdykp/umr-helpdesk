<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ManualBookController;
use App\Http\Controllers\SparePartController;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;

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

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login/auth', [AuthController::class, 'loginAuth'])->name('auth.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/report', [ReportController::class, 'index'])->name('report');
Route::get('/report/create', [ReportController::class, 'create'])->name('report.create');
Route::get('/report/export', [ReportController::class, 'export'])->name('report.export');


Route::get('/machine', [MachineController::class, 'index'])->name('machine');

Route::resource('manualbook', ManualBookController::class);
Route::get('manualbook/{id}/preview', [ManualBookController::class, 'preview'])->name('manualbook.preview');
Route::post('manualbook/import', [ManualBookController::class, 'import'])->name('manualbook.import');
Route::get('/testupload', [ManualBookController::class, 'index'])->name('testupload');
Route::get('/manualbook/view/{filename}', function ($filename) {
    $path = storage_path('app/public/uploads/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
})->where('filename', '.*');
