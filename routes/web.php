<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ManualBookController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\SparePartController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\TestingController;
use App\Http\Controllers\MaintenanceController;

use App\Models\ManualBook;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login/auth', [AuthController::class, 'loginAuth'])->name('auth.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/data/machine', [DataController::class, 'getMachines'])->name('data.machines');
Route::get('/data/location', [DataController::class, 'getLocations'])->name('data.locations');
Route::get('/data/shift', [DataController::class, 'getShifts'])->name('data.shifts');

Route::resource('report', ReportController::class);
Route::get('/report', [ReportController::class, 'index'])->name('report');
/*Route::get('/report', [ReportController::class, 'index'])->name('report');*/
// Route::get('/report/create', [ReportController::class, 'create'])->name('report.create');
Route::get('/report-export', [ReportController::class, 'export'])->name('report.export');
Route::post('/report/bulk-delete', [ReportController::class, 'bulkDelete'])->name('report.bulk-delete');
Route::post('/report/search', [ReportController::class, 'search'])->name('report.search');

Route::resource('sparepart', SparePartController::class);
Route::get('/sparepart', [SparePartController::class, 'index'])->name('sparepart');
Route::get('/sparepart/create', [SparePartController::class, 'create'])->name('sparepart.create');
Route::get('/sparepart-export', [SparePartController::class, 'export'])->name('sparepart.export');
Route::post('/sparepart/bulk-delete', [SparePartController::class, 'bulkDelete'])->name('sparepart.bulk-delete');
Route::post('/sparepart/search', [SparepartController::class, 'search'])->name('sparepart.search');

Route::resource('tracking', TrackingController::class);
Route::get('/tracking', [TrackingController::class, 'index'])->name('tracking');
Route::get('/tracking/create', [TrackingController::class, 'create'])->name('tracking.create');
Route::post('/tracking/bulk-delete', [TrackingController::class, 'bulkDelete'])->name('tracking.bulk-delete');
Route::get('/tracking-export', [TrackingController::class, 'export'])->name('tracking.export');
Route::post('/tracking/search', [TrackingController::class, 'search'])->name('tracking.search');

Route::resource('machine', machineController::class)->except(['show']);
Route::get('/machine', [MachineController::class, 'index'])->name('machine');
Route::post('/machine/update/{id}', [machineController::class, 'update'])->name('machine.update');
Route::get('/machine-export', [machineController::class, 'export'])->name('machine.export');
Route::post('/machine/bulk-delete', [machineController::class, 'bulkDelete'])->name('machine.bulk-delete');

Route::resource('location', locationController::class)->except(['show']);
Route::get('/location', [locationController::class, 'index'])->name('location');
Route::post('/location/update/{id}', [locationController::class, 'update'])->name('location.update');
Route::get('/location-export', [locationController::class, 'export'])->name('location.export');
Route::post('/location/bulk-delete', [locationController::class, 'bulkDelete'])->name('location.bulk-delete');

Route::resource('shift', shiftController::class)->except(['show']);
Route::get('/shift', [shiftController::class, 'index'])->name('shift');
Route::post('/shift/update/{id}', [shiftController::class, 'update'])->name('shift.update');
Route::get('/shift-export', [shiftController::class, 'export'])->name('shift.export');
Route::post('/shift/bulk-delete', [shiftController::class, 'bulkDelete'])->name('shift.bulk-delete');

Route::resource('manualbook', ManualBookController::class);
Route::get('manualbook/{id}/preview', [ManualBookController::class, 'preview'])->name('manualbook.preview');
Route::post('manualbook/import', [ManualBookController::class, 'import'])->name('manualbook.import');
Route::get('/manualbook', [ManualBookController::class, 'index'])->name('manualbook');
Route::get('/manualbook-search', [ManualBookController::class, 'search'])->name('manualbook.search');
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

Route::resource('audit', AuditController::class);
Route::get('audit/{id}/preview', [AuditController::class, 'preview'])->name('audit.preview');
Route::post('audit/import', [AuditController::class, 'import'])->name('audit.import');
Route::get('/audit', [AuditController::class, 'index'])->name('audit');
Route::get('/audit-search', [AuditController::class, 'search'])->name('audit.search');
Route::get('/audit/view/{filename}', function ($filename) {
    $path = storage_path('app/public/uploads/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
})->where('filename', '.*');

Route::get('/audit/download/{filename}', function ($filename) {
    $path = storage_path('app/public/uploads/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->download($path);
})->where('filename', '.*')->name('audit.download');

Route::middleware([AdminMiddleware::class . ':admin'])->group(function () {
    Route::resource('users', UserController::class);
    // Route::get('userlist', [UserController::class, 'index'])->name('users.list');
});

Route::resource('maintenance', MaintenanceController::class);
Route::patch('maintenance/{id}/status', [MaintenanceController::class, 'updateStatus'])->name('maintenance.updateStatus');
Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance');
Route::post('/maintenance/add-note', [MaintenanceController::class, 'store']);


Route::get('/testing', [TestingController::class, 'index'])->name('testing');
