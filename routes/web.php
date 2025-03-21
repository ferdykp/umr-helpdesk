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
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\TestingController;
use App\Http\Controllers\MaintenanceController;

use App\Models\ManualBook;
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

Route::resource('report', ReportController::class);
Route::get('/report', [ReportController::class, 'index'])->name('report');
/*Route::get('/report', [ReportController::class, 'index'])->name('report');*/
Route::get('/report/create', [ReportController::class, 'create'])->name('report.create');
Route::get('/report-export', [ReportController::class, 'export'])->name('report.export');
Route::post('/report/bulk-delete', [ReportController::class, 'bulkDelete'])->name('report.bulk-delete');

Route::resource('sparepart', SparePartController::class);
Route::get('/sparepart', [SparePartController::class, 'index'])->name('sparepart');
/*Route::get('/sparepart', [SparePartController::class, 'index'])->name('sparepart');*/
Route::get('/sparepart/create', [SparePartController::class, 'create'])->name('sparepart.create');
Route::get('/sparepart-export', [SparePartController::class, 'export'])->name('sparepart.export');
Route::post('/sparepart/bulk-delete', [SparePartController::class, 'bulkDelete'])->name('sparepart.bulk-delete');

Route::resource('tracking', TrackingController::class);
Route::get('/tracking', [TrackingController::class, 'index'])->name('tracking');
Route::get('/tracking/create', [TrackingController::class, 'create'])->name('tracking.create');
Route::post('/tracking/bulk-delete', [TrackingController::class, 'bulkDelete'])->name('tracking.bulk-delete');
Route::get('/tracking-export', [TrackingController::class, 'export'])->name('tracking.export');


Route::get('/machine', [MachineController::class, 'index'])->name('machine');
Route::get('/machine/data', [MachineController::class, 'data'])->name('machine.data');

Route::resource('manualbook', ManualBookController::class);
Route::get('manualbook/{id}/preview', [ManualBookController::class, 'preview'])->name('manualbook.preview');
Route::post('manualbook/import', [ManualBookController::class, 'import'])->name('manualbook.import');
Route::get('/manualbook', [ManualBookController::class, 'index'])->name('manualbook');
Route::get('/manualbook/view/{filename}', function ($filename) {
    $path = storage_path('app/public/uploads/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
})->where('filename', '.*');
Route::get('/manualbook/download/{filename}', function ($filename) {
    $path = storage_path('app/public/uploads/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->download($path);
})->where('filename', '.*')->name('manualbook.download');
Route::get('/manualbook-search', [ManualBookController::class, 'search'])->name('manualbook.search');

Route::middleware([AdminMiddleware::class . ':admin'])->group(function () {
    Route::resource('users', UserController::class);
    // Route::get('userlist', [UserController::class, 'index'])->name('users.list');
});

Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance');
Route::post('/maintenance/add-note', [MaintenanceController::class, 'store']);

Route::get('/dashboard', [MaintenanceController::class, 'dashboard'])->name('dashboard');


Route::get('/testing', [TestingController::class, 'index'])->name('testing');
